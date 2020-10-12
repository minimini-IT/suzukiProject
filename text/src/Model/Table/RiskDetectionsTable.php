<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RiskDetections Model
 *
 * @property &\Cake\ORM\Association\BelongsTo $IncidentManagements
 * @property \App\Model\Table\SystemsTable&\Cake\ORM\Association\BelongsTo $Systems
 * @property \App\Model\Table\BasesTable&\Cake\ORM\Association\BelongsTo $Bases
 * @property \App\Model\Table\UnitsTable&\Cake\ORM\Association\BelongsTo $Units
 * @property \App\Model\Table\StatusesTable&\Cake\ORM\Association\BelongsTo $Statuses
 * @property \App\Model\Table\ReportsTable&\Cake\ORM\Association\BelongsTo $Reports
 * @property \App\Model\Table\PositivesTable&\Cake\ORM\Association\BelongsTo $Positives
 * @property \App\Model\Table\SecLevelsTable&\Cake\ORM\Association\BelongsTo $SecLevels
 * @property &\Cake\ORM\Association\BelongsTo $IncidentCases
 * @property \App\Model\Table\InfectionRoutesTable&\Cake\ORM\Association\BelongsTo $InfectionRoutes
 *
 * @method \App\Model\Entity\RiskDetection get($primaryKey, $options = [])
 * @method \App\Model\Entity\RiskDetection newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RiskDetection[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RiskDetection|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RiskDetection saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RiskDetection patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RiskDetection[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RiskDetection findOrCreate($search, callable $callback = null, $options = [])
 */
class RiskDetectionsTable extends Table
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

        $this->setTable('risk_detections');
        $this->setDisplayField('risk_detections_id');
        $this->setPrimaryKey('risk_detections_id');

        $this->belongsTo('IncidentManagements', [
            'foreignKey' => 'incident_managements_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Systems', [
            'foreignKey' => 'systems_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Bases', [
            'foreignKey' => 'bases_id'
        ]);
        $this->belongsTo('Units', [
            'foreignKey' => 'units_id'
        ]);
        $this->belongsTo('Statuses', [
            'foreignKey' => 'statuses_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Reports', [
            'foreignKey' => 'reports_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Positives', [
            'foreignKey' => 'positives_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('SecLevels', [
            'foreignKey' => 'sec_levels_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('IncidentCases', [
            'foreignKey' => 'incident_cases_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('InfectionRoutes', [
            'foreignKey' => 'infection_routes_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('IncidentChronologies', [
            'foreignKey' => 'risk_detections_id'
        ]);
        $this->hasMany('SuspiciousDestinationAddresses', [
            'foreignKey' => 'risk_detections_id'
        ]);
        $this->hasMany('SuspiciousLinks', [
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
            ->integer('risk_detections_id')
            ->allowEmptyString('risk_detections_id', null, 'create');

        $validator
            ->dateTime('occurrence_datetime')
            ->allowEmptyDateTime('occurrence_datetime');

        $validator
            ->dateTime('response_start_time')
            ->requirePresence('response_start_time', 'create')
            ->notEmptyDateTime('response_start_time');

        $validator
            ->dateTime('response_end_time')
            ->allowEmptyDateTime('response_end_time');

        $validator
            ->boolean('sim_live_flag')
            ->notEmptyString('sim_live_flag');

        $validator
            ->boolean('samari_flag')
            ->notEmptyString('samari_flag');

        $validator
            ->boolean('attachment')
            ->notEmptyString('attachment');

        $validator
            ->scalar('comment')
            ->allowEmptyString('comment');

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
        $rules->add($rules->existsIn(['incident_managements_id'], 'IncidentManagements'));
        $rules->add($rules->existsIn(['systems_id'], 'Systems'));
        $rules->add($rules->existsIn(['bases_id'], 'Bases'));
        $rules->add($rules->existsIn(['units_id'], 'Units'));
        $rules->add($rules->existsIn(['statuses_id'], 'Statuses'));
        $rules->add($rules->existsIn(['reports_id'], 'Reports'));
        $rules->add($rules->existsIn(['positives_id'], 'Positives'));
        $rules->add($rules->existsIn(['sec_levels_id'], 'SecLevels'));
        $rules->add($rules->existsIn(['incident_cases_id'], 'IncidentCases'));
        $rules->add($rules->existsIn(['infection_routes_id'], 'InfectionRoutes'));

        return $rules;
    }
}
