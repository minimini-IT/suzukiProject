<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ManagementPrefixes Model
 *
 * @method \App\Model\Entity\ManagementPrefix get($primaryKey, $options = [])
 * @method \App\Model\Entity\ManagementPrefix newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ManagementPrefix[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ManagementPrefix|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ManagementPrefix saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ManagementPrefix patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ManagementPrefix[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ManagementPrefix findOrCreate($search, callable $callback = null, $options = [])
 */
class ManagementPrefixesTable extends Table
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

        $this->setTable('management_prefixes');
        $this->setDisplayField('management_prefix');
        $this->setPrimaryKey('management_prefixes_id');
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
            ->integer('management_prefixes_id')
            ->allowEmptyString('management_prefixes_id', null, 'create');

        $validator
            ->scalar('management_prefix')
            ->maxLength('management_prefix', 50)
            ->requirePresence('management_prefix', 'create')
            ->notEmptyString('management_prefix');

        $validator
            ->integer('sort_number')
            ->requirePresence('sort_number', 'create')
            ->notEmptyString('sort_number');

        return $validator;
    }
}
