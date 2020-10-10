<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Duties Model
 *
 * @method \App\Model\Entity\Duty get($primaryKey, $options = [])
 * @method \App\Model\Entity\Duty newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Duty[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Duty|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Duty saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Duty patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Duty[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Duty findOrCreate($search, callable $callback = null, $options = [])
 */
class DutiesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('duties');
        $this->setDisplayField('duty');
        $this->setPrimaryKey('duties_id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('duties_id')
            ->allowEmptyString('duties_id', null, 'create');

        $validator
            ->scalar('duty')
            ->maxLength('duty', 20)
            ->requirePresence('duty', 'create')
            ->notEmptyString('duty');

        $validator
            ->integer('duty_sort_number')
            ->requirePresence('duty_sort_number', 'create')
            ->notEmptyString('duty_sort_number');

        return $validator;
    }
}
