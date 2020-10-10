<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CommentFiles Model
 *
 * @property \App\Model\Table\CrewSendCommentsTable&\Cake\ORM\Association\BelongsTo $CrewSendComments
 *
 * @method \App\Model\Entity\CommentFile get($primaryKey, $options = [])
 * @method \App\Model\Entity\CommentFile newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CommentFile[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CommentFile|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CommentFile saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CommentFile patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CommentFile[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CommentFile findOrCreate($search, callable $callback = null, $options = [])
 */
class CommentFilesTable extends Table
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

        $this->setTable('comment_files');
        $this->setDisplayField('comment_files_id');
        $this->setPrimaryKey('comment_files_id');

        $this->belongsTo('CrewSendComments', [
            'foreignKey' => 'crew_send_comments_id',
            'joinType' => 'INNER'
        ]);
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
            ->integer('comment_files_id')
            ->allowEmptyFile('comment_files_id', null, 'create');

        $validator
            ->scalar('file_name')
            ->maxLength('file_name', 255)
            ->requirePresence('file_name', 'create')
            ->notEmptyFile('file_name');

        $validator
            ->scalar('file_size')
            ->maxLength('file_size', 255)
            ->requirePresence('file_size', 'create')
            ->notEmptyFile('file_size');

        $validator
            ->scalar('unique_file_name')
            ->maxLength('unique_file_name', 255)
            ->requirePresence('unique_file_name', 'create')
            ->notEmptyFile('unique_file_name');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['crew_send_comments_id'], 'CrewSendComments'));

        return $rules;
    }
}
