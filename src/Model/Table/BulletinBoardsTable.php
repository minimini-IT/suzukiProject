<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BulletinBoards Model
 *
 * @method \App\Model\Entity\BulletinBoard newEmptyEntity()
 * @method \App\Model\Entity\BulletinBoard newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\BulletinBoard[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BulletinBoard get($primaryKey, $options = [])
 * @method \App\Model\Entity\BulletinBoard findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\BulletinBoard patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BulletinBoard[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\BulletinBoard|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BulletinBoard saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BulletinBoard[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\BulletinBoard[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\BulletinBoard[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\BulletinBoard[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class BulletinBoardsTable extends Table
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

        $this->setTable('bulletin_boards');
        $this->setDisplayField('title');
        $this->setPrimaryKey('bulletin_boards_id');

        $this->hasMany('BulletinBoardComments', [
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
