<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SuspiciousLinks Model
 *
 * @property \App\Model\Table\RiskDetectionsTable&\Cake\ORM\Association\BelongsTo $RiskDetections
 *
 * @method \App\Model\Entity\SuspiciousLink get($primaryKey, $options = [])
 * @method \App\Model\Entity\SuspiciousLink newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SuspiciousLink[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SuspiciousLink|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SuspiciousLink saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SuspiciousLink patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SuspiciousLink[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SuspiciousLink findOrCreate($search, callable $callback = null, $options = [])
 */
class SuspiciousLinksTable extends Table
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

        $this->setTable('suspicious_links');
        $this->setDisplayField('suspicious_links_id');
        $this->setPrimaryKey('suspicious_links_id');

        $this->belongsTo('RiskDetections', [
            'foreignKey' => 'risk_detections_id'
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
            ->integer('suspicious_links_id')
            ->allowEmptyString('suspicious_links_id', null, 'create');

        $validator
            ->scalar('link')
            ->requirePresence('link', 'create')
            ->notEmptyString('link');

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
