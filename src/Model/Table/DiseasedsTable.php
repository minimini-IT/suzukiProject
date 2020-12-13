<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
class DiseasedsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('diseaseds');
        $this->setDisplayField('diseaseds_id');
        $this->setPrimaryKey('diseaseds_id');

        $this->belongsTo('Patients', [
            'foreignKey' => 'patients_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Sicknesses', [
            'foreignKey' => 'sicknesses_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany("InterviewSymptoms", [
            'foreignKey' => 'diseaseds_id',
            'joinType' => 'INNER',
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('diseaseds_id')
            ->allowEmptyString('diseaseds_id', null, 'create');

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
        $rules->add($rules->existsIn(['patients_id'], 'Patients'), ['errorField' => 'patients_id']);
        $rules->add($rules->existsIn(['sicknesses_id'], 'Sicknesses'), ['errorField' => 'sicknesses_id']);

        return $rules;
    }
}
