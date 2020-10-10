<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MessageChoices Model
 *
 * @property \App\Model\Table\MessageBordsTable&\Cake\ORM\Association\BelongsTo $MessageBords
 *
 * @method \App\Model\Entity\MessageChoice get($primaryKey, $options = [])
 * @method \App\Model\Entity\MessageChoice newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MessageChoice[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MessageChoice|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MessageChoice saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MessageChoice patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MessageChoice[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MessageChoice findOrCreate($search, callable $callback = null, $options = [])
 */
class MessageChoicesTable extends Table
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

        $this->setTable('message_choices');
        $this->setDisplayField('message_choices_id');
        $this->setPrimaryKey('message_choices_id');

        $this->belongsTo('MessageBords', [
            'foreignKey' => 'message_bords_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('MessageAnswers', [
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
            ->integer('message_choices_id')
            ->allowEmptyString('message_choices_id', null, 'create');

        $validator
            ->scalar('content')
            ->maxLength('content', 255)
            ->requirePresence('content', 'create')
            ->notEmptyString('content');

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

        return $rules;
    }
}
