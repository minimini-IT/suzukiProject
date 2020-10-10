<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Bases Model
 *
 * @method \App\Model\Entity\Basis get($primaryKey, $options = [])
 * @method \App\Model\Entity\Basis newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Basis[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Basis|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Basis saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Basis patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Basis[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Basis findOrCreate($search, callable $callback = null, $options = [])
 */
class BasesTable extends Table
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

        $this->setTable('bases');
        $this->setDisplayField('base');
        $this->setPrimaryKey('bases_id');
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
            ->integer('bases_id')
            ->allowEmptyString('bases_id', null, 'create');

        $validator
            ->scalar('base')
            ->maxLength('base', 30)
            ->requirePresence('base', 'create')
            ->notEmptyString('base');

        $validator
            ->integer('base_sort_number')
            ->requirePresence('base_sort_number', 'create')
            ->notEmptyString('base_sort_number');

        return $validator;
    }
}
