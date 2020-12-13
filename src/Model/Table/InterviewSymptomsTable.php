<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class InterviewSymptomsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('interview_symptoms');
        $this->setDisplayField('interview_symptoms_id');
        $this->setPrimaryKey('interview_symptoms_id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Diseaseds', [
            'foreignKey' => 'diseaseds_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Symptoms', [
            'foreignKey' => 'symptoms_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('SymptomsLocations', [
            'foreignKey' => 'interview_symptoms_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('interview_symptoms_id')
            ->allowEmptyString('interview_symptoms_id', null, 'create');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['diseaseds_id'], 'Diseaseds'), ['errorField' => 'diseaseds_id']);
        $rules->add($rules->existsIn(['symptoms_id'], 'Symptoms'), ['errorField' => 'symptoms_id']);

        return $rules;
    }
}
