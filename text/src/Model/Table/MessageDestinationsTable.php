<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MessageDestinations Model
 *
 * @property \App\Model\Table\MessageBordsTable&\Cake\ORM\Association\BelongsTo $MessageBords
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\MessageDestination get($primaryKey, $options = [])
 * @method \App\Model\Entity\MessageDestination newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MessageDestination[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MessageDestination|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MessageDestination saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MessageDestination patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MessageDestination[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MessageDestination findOrCreate($search, callable $callback = null, $options = [])
 */
class MessageDestinationsTable extends Table
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

        $this->setTable('message_destinations');
        $this->setDisplayField('message_destinations_id');
        $this->setPrimaryKey('message_destinations_id');

        $this->belongsTo('MessageBords', [
            'foreignKey' => 'message_bords_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'users_id',
            'joinType' => 'INNER'
        ]);
        $this->hasOne("MessageAnswers", [
            "foreignKey" => "message_destinations_id"
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
            ->integer('message_destinations_id')
            ->allowEmptyString('message_destinations_id', null, 'create');

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
        $rules->add($rules->existsIn(['message_bords_id'], 'MessageBords'));
        $rules->add($rules->existsIn(['users_id'], 'Users'));

        return $rules;
    }
}
