<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class RelatedLocationsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('related_locations');
        $this->setDisplayField('related_locations_id');
        $this->setPrimaryKey('related_locations_id');

        $this->belongsTo('Articles', [
            'foreignKey' => 'articles_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Locations', [
            'foreignKey' => 'locations_id',
            'joinType' => 'INNER',
        ]);
    }

    public function findRelatedLocation(Query $query, array $options)
    {
        $articles_id = $options["articles_id"];

        return $query
            ->select(["locations_id"])
            ->where(["articles_id" => $articles_id]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('related_locations_id')
            ->allowEmptyString('related_locations_id', null, 'create');

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['articles_id'], 'Articles'), ['errorField' => 'articles_id']);
        $rules->add($rules->existsIn(['locations_id'], 'Locations'), ['errorField' => 'locations_id']);

        return $rules;
    }
}
