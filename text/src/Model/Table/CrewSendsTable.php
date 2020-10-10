<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CrewSends Model
 *
 * @property \App\Model\Table\CategoriesTable&\Cake\ORM\Association\BelongsTo $Categories
 * @property \App\Model\Table\StatusesTable&\Cake\ORM\Association\BelongsTo $Statuses
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\CrewSend get($primaryKey, $options = [])
 * @method \App\Model\Entity\CrewSend newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CrewSend[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CrewSend|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CrewSend saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CrewSend patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CrewSend[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CrewSend findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CrewSendsTable extends Table
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

        $this->setTable('crew_sends');
        $this->setDisplayField('title');
        $this->setPrimaryKey('crew_sends_id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('IncidentManagements', [
            'foreignKey' => 'incident_managements_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('Categories', [
            'foreignKey' => 'categories_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Statuses', [
            'foreignKey' => 'statuses_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'users_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany("Files", [
            "foreignKey" => "crew_sends_id"
        ]);
        $this->hasMany("CrewSendComments", [
            "foreignKey" => "crew_sends_id"
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
            ->integer('crew_sends_id')
            ->allowEmptyString('crew_sends_id', null, 'create');

        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            //->dateTime('period')
            ->date('period')
            ->allowEmptyDateTime('period');

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
        $rules->add($rules->existsIn(['categories_id'], 'Categories'));
        $rules->add($rules->existsIn(['statuses_id'], 'Statuses'));
        $rules->add($rules->existsIn(['users_id'], 'Users'));

        return $rules;
    }
}
