<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ManagementUsers Model
 *
 * @method \App\Model\Entity\ManagementUser newEmptyEntity()
 * @method \App\Model\Entity\ManagementUser newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ManagementUser[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ManagementUser get($primaryKey, $options = [])
 * @method \App\Model\Entity\ManagementUser findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ManagementUser patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ManagementUser[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ManagementUser|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ManagementUser saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ManagementUser[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ManagementUser[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ManagementUser[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ManagementUser[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ManagementUsersTable extends Table
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

        $this->setTable('management_users');
        $this->setDisplayField('management_users_id');
        $this->setPrimaryKey('management_users_id');
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
            ->integer('management_users_id')
            ->allowEmptyString('management_users_id', null, 'create');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 16)
            ->requirePresence('last_name', 'create')
            ->notEmptyString('last_name');

        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 16)
            ->requirePresence('first_name', 'create')
            ->notEmptyString('first_name');

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->notEmptyString('password');

        $validator
            ->scalar('mail')
            ->maxLength('mail', 100)
            ->requirePresence('mail', 'create')
            ->notEmptyString('mail');

        return $validator;
    }
}
