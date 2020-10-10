<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MessageAnswers Model
 *
 * @property \App\Model\Table\MessageDestinationsTable&\Cake\ORM\Association\BelongsTo $MessageDestinations
 * @property &\Cake\ORM\Association\BelongsTo $MessageChoices
 *
 * @method \App\Model\Entity\MessageAnswer get($primaryKey, $options = [])
 * @method \App\Model\Entity\MessageAnswer newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MessageAnswer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MessageAnswer|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MessageAnswer saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MessageAnswer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MessageAnswer[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MessageAnswer findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MessageAnswersTable extends Table
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

        $this->setTable('message_answers');
        $this->setDisplayField('message_answers_id');
        $this->setPrimaryKey('message_answers_id');

        $this->addBehavior('Timestamp');

        $this->hasOne('MessageDestinations', [
            'foreignKey' => 'message_destinations_id',
            'bindingKey' => 'message_destinations_id'
        ]);
        $this->belongsTo('MessageChoices', [
            'foreignKey' => 'message_choices_id'
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
            ->integer('message_answers_id')
            ->allowEmptyString('message_answers_id', null, 'create');

        $validator
            ->requirePresence("message_choices_id");

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
        $rules->add($rules->existsIn(['message_destinations_id'], 'MessageDestinations'));
        $rules->add($rules->existsIn(['message_choices_id'], 'MessageChoices'));

        return $rules;
    }
}
