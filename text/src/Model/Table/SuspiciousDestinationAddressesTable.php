<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SuspiciousDestinationAddresses Model
 *
 * @property \App\Model\Table\RiskDetectionsTable&\Cake\ORM\Association\BelongsTo $RiskDetections
 *
 * @method \App\Model\Entity\SuspiciousDestinationAddress get($primaryKey, $options = [])
 * @method \App\Model\Entity\SuspiciousDestinationAddress newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SuspiciousDestinationAddress[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SuspiciousDestinationAddress|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SuspiciousDestinationAddress saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SuspiciousDestinationAddress patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SuspiciousDestinationAddress[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SuspiciousDestinationAddress findOrCreate($search, callable $callback = null, $options = [])
 */
class SuspiciousDestinationAddressesTable extends Table
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

        $this->setTable('suspicious_destination_addresses');
        $this->setDisplayField('suspicious_destination_addresses_id');
        $this->setPrimaryKey('suspicious_destination_addresses_id');

        $this->belongsTo('RiskDetections', [
            'foreignKey' => 'risk_detections_id',
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
            ->integer('suspicious_destination_addresses_id')
            ->allowEmptyString('suspicious_destination_addresses_id', null, 'create');

        $validator
            ->scalar('destination_address')
            ->maxLength('destination_address', 255)
            ->requirePresence('destination_address', 'create')
            ->notEmptyString('destination_address');

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

        return $rules;
    }
}
