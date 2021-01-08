<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class RelatedSicknessesTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('related_sicknesses');
        $this->setDisplayField('related_sicknesses_id');
        $this->setPrimaryKey('related_sicknesses_id');

        $this->belongsTo('Articles', [
            'foreignKey' => 'articles_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Sicknesses', [
            'foreignKey' => 'sicknesses_id',
            'joinType' => 'INNER',
        ]);
    }

    public function findRelatedSickness(Query $query, array $options)
    {
        $articles_id = $options["articles_id"];

        return $query
            ->select(["sicknesses_id"])
            ->where(["articles_id" => $articles_id]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('related_sicknesses_id')
            ->allowEmptyString('related_sicknesses_id', null, 'create');

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['articles_id'], 'Articles'), ['errorField' => 'articles_id']);
        $rules->add($rules->existsIn(['sicknesses_id'], 'Sicknesses'), ['errorField' => 'sicknesses_id']);

        return $rules;
    }
}
