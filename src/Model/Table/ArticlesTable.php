<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ArticlesTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('articles');
        $this->setDisplayField('title');
        $this->setPrimaryKey('articles_id');

        $this->addBehavior('Timestamp');

        $this->hasMany('RelatedSicknesses', [
            'foreignKey' => 'articles_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('RelatedSymptoms', [
            'foreignKey' => 'articles_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('RelatedLocations', [
            'foreignKey' => 'articles_id',
            'joinType' => 'INNER',
        ]);
    }

    public function findSearchAttribute(Query $query, array $options)
    {
        $values = $options["values"];
        if($options["type"] == "sicknesses")
        {
            $find = "JoinRelatedSicknesses";
            $where = "si.sicknesses_id in";
        }
        elseif($options["type"] == "symptoms")
        {
            $find = "JoinRelatedSymptoms";
            $where = "sy.symptoms_id in";
        }
        elseif($options["type"] == "locations")
        {
            $find = "JoinRelatedLocations";
            $where = "lo.locations_id in";
        }

        return $query
            //->find("JoinRelatedSymptoms")
            ->find($find)
            ->where([$where => $values])
            ->group(["Articles.articles_id"]);
            //->order(["Articles.articles_id"]);
    }

    /*
    public function findSearchSickness(Query $query, array $options)
    {
        $values = $options["values"];

        return $query
            ->find("JoinRelatedSicknesses")
            ->where(["si.sicknesses_id in" => $values])
            ->group(["Articles.articles_id"])
            ->order(["Articles.articles_id"]);
    }
     */

    /*
    public function findArticleAttribute(Query $query, array $options)
    {
        $articles_id = $options["articles_id"];

        return $query
            ->select(["si.sicknesses_id", "sy.symptoms_id", "lo.locations_id"])
            ->find("JoinRelatedSicknesses")
            ->find("JoinRelatedSymptoms")
            ->find("JoinRelatedLocations");
    }
     */

    public function findRelatedList(Query $query, array $options)
    {
        $articles_id = $options["articles_id"];
        $sub_query = $options["sub_query"];
        if($options["type"] == "sicknesses")
        {
            $find = "JoinRelatedSicknesses";
            $where = "si.sicknesses_id in";
        }
        elseif($options["type"] == "symptoms")
        {
            $find = "JoinRelatedSymptoms";
            $where = "sy.symptoms_id in";
        }
        elseif($options["type"] == "locations")
        {
            $find = "JoinRelatedLocations";
            $where = "lo.locations_id in";
        }

        return $query
            ->select(["Articles.articles_id", "Articles.title"])
            ->find("ListContain")
            ->find($find)
            ->where([
                $where => $sub_query,
                "Articles.articles_id !=" => $articles_id,
            ])
            ->limit(5)
            ->group(["Articles.articles_id"])
            ->order(["rand()"]);
    }

    public function findRecentArticles(Query $query, array $options)
    {
        return $query
            ->select(["articles_id", "title"])
            ->find("ListContain")
            ->group(["articles_id"])
            ->order(["modified" => "DESC"])
            ->limit(5);
    }

    public function findUpdateInfo(Query $query, array $options)
    {
        return $query
            ->select(["created", "modified"]);
    }

    public function findListContain(Query $query, array $options)
    {
        return $query
            ->contain([
                "RelatedSicknesses.Sicknesses" => function(Query $q)
                {
                    return $q->where(["Sicknesses.sicknesses_id !=" => 1]);
                },
                "RelatedSymptoms.Symptoms" => function(Query $q)
                {
                    return $q->where(["Symptoms.symptoms_id !=" => 1]);
                },
                "RelatedLocations.Locations" => function(Query $q)
                {
                    return $q->where(["Locations.locations_id !=" => 1]);
                },
            ]);
    }

    public function findDisplayList(Query $query, array $options)
    {
        return $query
            ->contain([
                "RelatedSicknesses.Sicknesses",
                "RelatedSymptoms.Symptoms",
                "RelatedLocations.Locations"
            ]);
    }

    public function findJoinRelatedSicknesses(Query $query, array $options)
    {
        return $query
            ->join([
                "si" => [
                    "table" => "related_sicknesses",
                    "type" => "LEFT",
                    "conditions" => "Articles.articles_id = si.articles_id"
                ],
            ]);
    }

    public function findJoinRelatedSymptoms(Query $query, array $options)
    {
        return $query
            ->join([
                "sy" => [
                    "table" => "related_symptoms",
                    "type" => "LEFT",
                    "conditions" => "Articles.articles_id = sy.articles_id"
                ],
            ]);
    }

    public function findJoinRelatedLocations(Query $query, array $options)
    {
        return $query
            ->join([
                "lo" => [
                    "table" => "related_locations",
                    "type" => "LEFT",
                    "conditions" => "Articles.articles_id = lo.articles_id"
                ],
            ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('articles_id')
            ->allowEmptyString('articles_id', null, 'create');

        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title')
            ->notEmptyString('title', "タイトルを入力してください");

        $validator
            ->scalar('contents')
            ->requirePresence('contents')
            ->notEmptyString('contents', "本文を入力してください");

        return $validator;
    }
}
