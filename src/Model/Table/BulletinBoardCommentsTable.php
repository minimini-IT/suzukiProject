<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BulletinBoardComments Model
 *
 * @property \App\Model\Table\BulletinBoardsTable&\Cake\ORM\Association\BelongsTo $BulletinBoards
 *
 * @method \App\Model\Entity\BulletinBoardComment newEmptyEntity()
 * @method \App\Model\Entity\BulletinBoardComment newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\BulletinBoardComment[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BulletinBoardComment get($primaryKey, $options = [])
 * @method \App\Model\Entity\BulletinBoardComment findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\BulletinBoardComment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BulletinBoardComment[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\BulletinBoardComment|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BulletinBoardComment saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BulletinBoardComment[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\BulletinBoardComment[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\BulletinBoardComment[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\BulletinBoardComment[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class BulletinBoardCommentsTable extends Table
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

        $this->setTable('bulletin_board_comments');
        $this->setDisplayField('bulletin_board_comments_id');
        $this->setPrimaryKey('bulletin_board_comments_id');

        $this->belongsTo('BulletinBoards', [
            'foreignKey' => 'bulletin_boards_id',
            'joinType' => 'INNER',
        ]);
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
