<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/*
 * beforeRules用
 */
use Cake\Datasource\EntityInterface;
use Cake\Event\EventInterface;

class ManagementUsersTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->addBehavior("Timestamp");

        $this->setTable('management_users');
        $this->setDisplayField('management_users_id');
        $this->setPrimaryKey('management_users_id');
    }

    public function findManagementUsersCheck(Query $query, array $options)
    {
        $management_users_id = $options["management_users_id"];

        return $query
            ->where(["management_users_id" => $management_users_id])
            ->select(["management_users_id", "last_name", "first_name", "mail"]);
    }

    public function findManagementUsersList(Query $query, array $options)
    {
        return $query
            ->where(["management_users_id !=" => 1]);
    }

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

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        /*
         * add()で作成、更新で適用
         * 同じメールアドレスは登録不可
         */
        $rules->add($rules->isUnique(["mail"], "このメールアドレスは登録済みです"));
        return $rules;
    }
}
