<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * IncidentChronologies Model
 *
 * @property \App\Model\Table\RiskDetectionsTable&\Cake\ORM\Association\BelongsTo $RiskDetections
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\IncidentChronology get($primaryKey, $options = [])
 * @method \App\Model\Entity\IncidentChronology newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\IncidentChronology[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\IncidentChronology|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\IncidentChronology saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\IncidentChronology patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\IncidentChronology[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\IncidentChronology findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class IncidentChronologiesTable extends Table
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

        $this->setTable('incident_chronologies');
        $this->setDisplayField('incident_chronologies_id');
        $this->setPrimaryKey('incident_chronologies_id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('RiskDetections', [
            'foreignKey' => 'risk_detections_id',
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
            ->integer('incident_chronologies_id')
            ->allowEmptyString('incident_chronologies_id', null, 'create');

        $validator
            ->scalar('message')
            ->allowEmptyString('message');

        $validator
            ->scalar('reference')
            ->allowEmptyString('reference');

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
        $rules->add($rules->existsIn(['risk_detections_id'], 'RiskDetections'));
        $rules->add($rules->existsIn(['users_id'], 'Users'));

        return $rules;
    }
}
