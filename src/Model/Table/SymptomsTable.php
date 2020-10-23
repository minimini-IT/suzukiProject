<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Symptoms Model
 *
 * @method \App\Model\Entity\Symptom newEmptyEntity()
 * @method \App\Model\Entity\Symptom newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Symptom[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Symptom get($primaryKey, $options = [])
 * @method \App\Model\Entity\Symptom findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Symptom patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Symptom[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Symptom|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Symptom saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Symptom[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Symptom[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Symptom[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Symptom[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class SymptomsTable extends Table
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

        $this->setTable('symptoms');
        $this->setDisplayField('symptoms');
        $this->setPrimaryKey('symptoms_id');

        /*
        $this->hasMany('InterviewSymptoms', [
            'foreignKey' => 'symptoms_id',
            'joinType' => 'INNER',
        ]);
         */
        $this->hasMany('Represents', [
            'foreignKey' => 'symptoms_id',
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
