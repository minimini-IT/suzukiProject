<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MessageBords Model
 *
 * @property \App\Model\Table\MessageStatusesTable&\Cake\ORM\Association\BelongsTo $MessageStatuses
 *
 * @method \App\Model\Entity\MessageBord get($primaryKey, $options = [])
 * @method \App\Model\Entity\MessageBord newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MessageBord[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MessageBord|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MessageBord saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MessageBord patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MessageBord[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MessageBord findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MessageBordsTable extends Table
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

        $this->setTable('message_bords');
        $this->setDisplayField('title');
        $this->setPrimaryKey('message_bords_id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('IncidentManagements', [
            'foreignKey' => 'incident_managements_id',
            'joinType' => 'INNER'
        ]);

        /*
        $this->belongsTo('MessageStatuses', [
            'foreignKey' => 'message_statuses_id',
            'joinType' => 'INNER'
        ]);
         */
        $this->hasOne('MessageStatuses', [
            'foreignKey' => 'message_statuses_id',
            'bindingKey' => 'message_statuses_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'users_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('MessageDestinations', [
            'foreignKey' => 'message_bords_id',
        ]);
        $this->hasMany('MessageChoices', [
            'foreignKey' => 'message_bords_id',
        ]);
        $this->hasMany('MessageFiles', [
            'foreignKey' => 'message_bords_id',
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
            ->integer('message_bords_id')
            ->allowEmptyString('message_bords_id', null, 'create');

        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->integer('choice')
            ->notEmptyString('choice');

        $validator
            ->scalar('message')
            ->allowEmptyString('message');

        $validator
            ->date('period')
            ->requirePresence('period', 'create')
            ->notEmptyDate('period');

        $validator
            ->notEmptyDate('private[]');

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
        $rules->add($rules->existsIn(['message_statuses_id'], 'MessageStatuses'));
        $rules->add($rules->existsIn(['users_id'], 'Users'));

        return $rules;
    }
}
