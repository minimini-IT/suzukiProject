<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CrewSendComments Model
 *
 * @property \App\Model\Table\CrewSendsTable&\Cake\ORM\Association\BelongsTo $CrewSends
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\CrewSendComment get($primaryKey, $options = [])
 * @method \App\Model\Entity\CrewSendComment newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CrewSendComment[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CrewSendComment|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CrewSendComment saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CrewSendComment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CrewSendComment[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CrewSendComment findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CrewSendCommentsTable extends Table
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

        $this->setTable('crew_send_comments');
        $this->setDisplayField('crew_send_comments_id');
        $this->setPrimaryKey('crew_send_comments_id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('CrewSends', [
            'foreignKey' => 'crew_sends_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'users_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('CommentFiles', [
            'foreignKey' => 'crew_send_comments_id',
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
            ->integer('crew_send_comments_id')
            ->allowEmptyString('crew_send_comments_id', null, 'create');

        $validator
            ->scalar('comment')
            ->requirePresence('comment', 'create')
            ->notEmptyString('comment');

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
        $rules->add($rules->existsIn(['crew_sends_id'], 'CrewSends'));
        $rules->add($rules->existsIn(['users_id'], 'Users'));

        return $rules;
    }
}
