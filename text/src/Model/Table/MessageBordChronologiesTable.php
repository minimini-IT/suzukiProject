<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MessageBordChronologies Model
 *
 * @property \App\Model\Table\MessageBordsTable&\Cake\ORM\Association\BelongsTo $MessageBords
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\MessageBordChronology get($primaryKey, $options = [])
 * @method \App\Model\Entity\MessageBordChronology newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MessageBordChronology[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MessageBordChronology|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MessageBordChronology saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MessageBordChronology patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MessageBordChronology[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MessageBordChronology findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MessageBordChronologiesTable extends Table
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

        $this->setTable('message_bord_chronologies');
        $this->setDisplayField('message_bord_chronologies_id');
        $this->setPrimaryKey('message_bord_chronologies_id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('MessageBords', [
            'foreignKey' => 'message_bords_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'users_id',
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
            ->integer('message_bord_chronologies_id')
            ->allowEmptyString('message_bord_chronologies_id', null, 'create');

        $validator
            ->scalar('message')
            ->allowEmptyString('message');

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
