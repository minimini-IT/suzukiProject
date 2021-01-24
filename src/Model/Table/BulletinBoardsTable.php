<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class BulletinBoardsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->addBehavior("Timestamp");

        $this->setTable('bulletin_boards');
        $this->setDisplayField('title');
        $this->setPrimaryKey('bulletin_boards_id');

        $this->hasMany('BulletinBoardComments', [
            'foreignKey' => 'bulletin_boards_id',
            'joinType' => 'INNER',
        ]);
    }

    public function findContainCommentModified(Query $query, array $options)
    {
        return $query
            ->order(["bulletin_boards_id" => "DESC"])
            ->contain([
                "BulletinBoardComments" => function(Query $q)
                {
                    return $q
                        ->select(["bulletin_boards_id", "modified"])
                        ->order(["modified" => "DESC"]);
                        //->limit(1);
                },
            ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('bulletin_boards_id')
            ->allowEmptyString('bulletin_boards_id', null, 'create');

        $validator
            ->scalar('title')
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('author')
            ->maxLength('author', 80)
            ->requirePresence('author', 'create')
            ->notEmptyString('author');

        $validator
            ->scalar('contents')
            ->requirePresence('contents', 'create')
            ->notEmptyString('contents');

        return $validator;
    }
}
