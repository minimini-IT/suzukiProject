<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ranks Model
 *
 * @method \App\Model\Entity\Rank get($primaryKey, $options = [])
 * @method \App\Model\Entity\Rank newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Rank[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Rank|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Rank saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Rank patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Rank[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Rank findOrCreate($search, callable $callback = null, $options = [])
 */
class RanksTable extends Table
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

        $this->setTable('ranks');
        $this->setDisplayField('rank');
        $this->setPrimaryKey('ranks_id');
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
            ->integer('ranks_id')
            ->allowEmptyString('ranks_id', null, 'create');

        $validator
            ->scalar('rank')
            ->maxLength('rank', 8)
            ->requirePresence('rank', 'create')
            ->notEmptyString('rank');

        $validator
            ->scalar('abb_rank')
            ->maxLength('abb_rank', 8)
            ->requirePresence('abb_rank', 'create')
            ->notEmptyString('abb_rank');

        $validator
            ->integer('rank_sort_number')
            ->requirePresence('rank_sort_number', 'create')
            ->notEmptyString('rank_sort_number');

        return $validator;
    }
}
