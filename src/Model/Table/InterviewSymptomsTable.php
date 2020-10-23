<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * InterviewSymptoms Model
 *
 * @property \App\Model\Table\PatientsTable&\Cake\ORM\Association\BelongsTo $Patients
 * @property \App\Model\Table\SymptomsTable&\Cake\ORM\Association\BelongsTo $Symptoms
 *
 * @method \App\Model\Entity\InterviewSymptom newEmptyEntity()
 * @method \App\Model\Entity\InterviewSymptom newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\InterviewSymptom[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\InterviewSymptom get($primaryKey, $options = [])
 * @method \App\Model\Entity\InterviewSymptom findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\InterviewSymptom patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\InterviewSymptom[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\InterviewSymptom|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\InterviewSymptom saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\InterviewSymptom[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\InterviewSymptom[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\InterviewSymptom[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\InterviewSymptom[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
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

        /*
        $this->belongsTo('Patients', [
            'foreignKey' => 'patients_id',
            'joinType' => 'INNER',
        ]);
         */
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
