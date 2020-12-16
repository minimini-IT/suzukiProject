<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class SymptomsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('symptoms');
        $this->setDisplayField('symptoms');
        $this->setPrimaryKey('symptoms_id');

        $this->hasMany('InterviewSymptoms', [
            'foreignKey' => 'symptoms_id',
            'joinType' => 'INNER',
        ]);
    }

    public function findSearchSymptomsElement(Query $query, array $options)
    {
        $values = $options["values"];

        return $query
            ->where(["symptoms_id in" => $values])
            ->select(["alias" => "symptoms"]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('symptoms_id')
            ->allowEmptyString('symptoms_id', null, 'create');

        $validator
            ->scalar('symptoms')
            ->maxLength('symptoms', 255)
            ->requirePresence('symptoms', 'create')
            ->notEmptyString('symptoms');

        return $validator;
    }
}
