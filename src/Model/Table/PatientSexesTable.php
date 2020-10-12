<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PatientSexes Model
 *
 * @method \App\Model\Entity\PatientSex newEmptyEntity()
 * @method \App\Model\Entity\PatientSex newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\PatientSex[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PatientSex get($primaryKey, $options = [])
 * @method \App\Model\Entity\PatientSex findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\PatientSex patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PatientSex[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PatientSex|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PatientSex saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PatientSex[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PatientSex[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\PatientSex[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PatientSex[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PatientSexesTable extends Table
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

        $this->setTable('patient_sexes');
        $this->setDisplayField('patient_sexes_id');
        $this->setPrimaryKey('patient_sexes_id');
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
            ->integer('patient_sexes_id')
            ->allowEmptyString('patient_sexes_id', null, 'create');

        $validator
            ->scalar('patient_sex')
            ->maxLength('patient_sex', 16)
            ->requirePresence('patient_sex', 'create')
            ->notEmptyString('patient_sex');

        return $validator;
    }
}
