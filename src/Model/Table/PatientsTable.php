<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/*
 * beforeRules用
 */
use Cake\Datasource\EntityInterface;
use Cake\Event\EventInterface;

class PatientsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->addBehavior("Timestamp");

        $this->setTable('patients');
        $this->setDisplayField('patients_id');
        $this->setPrimaryKey('patients_id');

        $this->belongsTo('PatientSexes', [
            'foreignKey' => 'patient_sexes_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Diseaseds', [
            'foreignKey' => 'patients_id',
            'joinType' => 'INNER',
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('patients_id')
            ->allowEmptyString('patients_id', null, 'create');

        $validator
            ->scalar('pen_name')
            ->maxLength('pen_name', 10)
            ->requirePresence('pen_name', 'create')
            ->notEmptyString('pen_name');

        $validator
            ->integer('age_of_onset')
            ->requirePresence('age_of_onset', 'create')
            ->notEmptyString('age_of_onset');

        $validator
            ->date('year_of_onset')
            ->requirePresence('year_of_onset', 'create')
            ->notEmptyDate('year_of_onset');

        $validator
            ->date('diagnosis_date')
            ->requirePresence('diagnosis_date', 'create')
            ->notEmptyDate('diagnosis_date');

        $validator
            ->date('cured')
            ->allowEmptyDate('cured');

        $validator
            ->scalar('interview_first')
            ->allowEmptyString('interview_first');

        $validator
            ->scalar('interview_second')
            ->allowEmptyString('interview_second');

        $validator
            ->scalar('interview_third')
            ->allowEmptyString('interview_third');

        $validator
            ->scalar('interview_force')
            ->allowEmptyString('interview_force');

        $validator
            ->scalar('other')
            ->allowEmptyString('other');

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['patient_sexes_id'], 'PatientSexes'), ['errorField' => 'patient_sexes_id']);
        $rules->add($rules->isUnique(["pen_name"], "このペンネームは登録済みです"));

        return $rules;
    }
}
