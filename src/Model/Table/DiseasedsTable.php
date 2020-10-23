<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Diseaseds Model
 *
 * @property \App\Model\Table\PatientsTable&\Cake\ORM\Association\BelongsTo $Patients
 * @property \App\Model\Table\SicknessesTable&\Cake\ORM\Association\BelongsTo $Sicknesses
 *
 * @method \App\Model\Entity\Diseased newEmptyEntity()
 * @method \App\Model\Entity\Diseased newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Diseased[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Diseased get($primaryKey, $options = [])
 * @method \App\Model\Entity\Diseased findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Diseased patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Diseased[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Diseased|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Diseased saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Diseased[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Diseased[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Diseased[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Diseased[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class DiseasedsTable extends Table
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
        $this->hasMany('InterviewSymptoms', [
            'foreignKey' => 'diseaseds_id',
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
