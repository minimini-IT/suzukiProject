<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class RelatedSymptomsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('related_symptoms');
        $this->setDisplayField('related_symptoms_id');
        $this->setPrimaryKey('related_symptoms_id');

        $this->belongsTo('Articles', [
            'foreignKey' => 'articles_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Symptoms', [
            'foreignKey' => 'symptoms_id',
            'joinType' => 'INNER',
        ]);
    }

    public function findRelatedSymptoms(Query $query, array $options)
    {
        $articles_id = $options["articles_id"];

        return $query
            ->select(["symptoms_id"])
            ->where(["articles_id" => $articles_id]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('related_symptoms_id')
            ->allowEmptyString('related_symptoms_id', null, 'create');

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['articles_id'], 'Articles'), ['errorField' => 'articles_id']);
        $rules->add($rules->existsIn(['symptoms_id'], 'Symptoms'), ['errorField' => 'symptoms_id']);

        return $rules;
    }
}
