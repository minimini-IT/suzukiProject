<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SecLevels Model
 *
 * @method \App\Model\Entity\SecLevel get($primaryKey, $options = [])
 * @method \App\Model\Entity\SecLevel newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SecLevel[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SecLevel|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SecLevel saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SecLevel patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SecLevel[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SecLevel findOrCreate($search, callable $callback = null, $options = [])
 */
class SecLevelsTable extends Table
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

        $this->setTable('sec_levels');
        $this->setDisplayField('sec_level');
        $this->setPrimaryKey('sec_levels_id');
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
            ->integer('sec_levels_id')
            ->allowEmptyString('sec_levels_id', null, 'create');

        $validator
            ->scalar('sec_level')
            ->maxLength('sec_level', 30)
            ->requirePresence('sec_level', 'create')
            ->notEmptyString('sec_level');

        return $validator;
    }
}
