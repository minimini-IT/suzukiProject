<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Sicknesses Model
 *
 * @method \App\Model\Entity\Sickness newEmptyEntity()
 * @method \App\Model\Entity\Sickness newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Sickness[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Sickness get($primaryKey, $options = [])
 * @method \App\Model\Entity\Sickness findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Sickness patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Sickness[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Sickness|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Sickness saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Sickness[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sickness[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sickness[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sickness[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class SicknessesTable extends Table
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

        $this->setTable('sicknesses');
        $this->setDisplayField('sickness_name');
        $this->setPrimaryKey('sicknesses_id');
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
            ->integer('sicknesses_id')
            ->allowEmptyString('sicknesses_id', null, 'create');

        $validator
            ->scalar('sickness_name')
            ->maxLength('sickness_name', 80)
            ->requirePresence('sickness_name', 'create')
            ->notEmptyString('sickness_name');

        return $validator;
    }
}
