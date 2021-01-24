<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class BulletinBoardCommentsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->addBehavior("Timestamp");

        $this->setTable('bulletin_board_comments');
        $this->setDisplayField('bulletin_board_comments_id');
        $this->setPrimaryKey('bulletin_board_comments_id');

        $this->belongsTo('BulletinBoards', [
            'foreignKey' => 'bulletin_boards_id',
            'joinType' => 'INNER',
        ]);
    }

    public function findBulletinBoardComments(Query $query, array $options)
    {
        $id = $options["id"];

        return $query
            ->where(["BulletinBoardComments.bulletin_boards_id" => $id]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('bulletin_board_comments_id')
            ->allowEmptyString('bulletin_board_comments_id', null, 'create');

        $validator
            ->scalar('comment_author')
            ->maxLength('comment_author', 80)
            ->requirePresence('comment_author', 'create')
            ->notEmptyString('comment_author');

        $validator
            ->scalar('comment_contents')
            ->requirePresence('comment_contents', 'create')
            ->notEmptyString('comment_contents');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['bulletin_boards_id'], 'BulletinBoards'), ['errorField' => 'bulletin_boards_id']);

        return $rules;
    }
}
