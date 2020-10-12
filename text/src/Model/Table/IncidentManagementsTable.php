<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * IncidentManagements Model
 *
 * @property \App\Model\Table\ManagementPrefixesTable&\Cake\ORM\Association\BelongsTo $ManagementPrefixes
 *
 * @method \App\Model\Entity\IncidentManagement get($primaryKey, $options = [])
 * @method \App\Model\Entity\IncidentManagement newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\IncidentManagement[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\IncidentManagement|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\IncidentManagement saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\IncidentManagement patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\IncidentManagement[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\IncidentManagement findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class IncidentManagementsTable extends Table
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

        $this->setTable('incident_managements');
        $this->setDisplayField('incident_managements_id');
        $this->setPrimaryKey('incident_managements_id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('ManagementPrefixes', [
            'foreignKey' => 'management_prefixes_id',
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
            ->integer('incident_managements_id')
            ->allowEmptyString('incident_managements_id', null, 'create');

        $validator
            ->integer('number')
            ->requirePresence('number', 'create')
            ->notEmptyString('number');

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
        $rules->add($rules->existsIn(['management_prefixes_id'], 'ManagementPrefixes'));

        return $rules;
    }
}
