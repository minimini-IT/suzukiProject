<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Systems Model
 *
 * @method \App\Model\Entity\System get($primaryKey, $options = [])
 * @method \App\Model\Entity\System newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\System[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\System|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\System saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\System patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\System[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\System findOrCreate($search, callable $callback = null, $options = [])
 */
class SystemsTable extends Table
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

        $this->setTable('systems');
        $this->setDisplayField('system');
        $this->setPrimaryKey('systems_id');
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
            ->integer('systems_id')
            ->allowEmptyString('systems_id', null, 'create');

        $validator
            ->scalar('system')
            ->maxLength('system', 50)
            ->requirePresence('system', 'create')
            ->notEmptyString('system');

        $validator
            ->scalar('abb_system')
            ->maxLength('abb_system', 30)
            ->requirePresence('abb_system', 'create')
            ->notEmptyString('abb_system');

        $validator
            ->integer('system_sort_number')
            ->requirePresence('system_sort_number', 'create')
            ->notEmptyString('system_sort_number');

        return $validator;
    }
}
