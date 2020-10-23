<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SymptomsLocations Model
 *
 * @property \App\Model\Table\InterviewSymptomsTable&\Cake\ORM\Association\BelongsTo $InterviewSymptoms
 * @property \App\Model\Table\LocationsTable&\Cake\ORM\Association\BelongsTo $Locations
 *
 * @method \App\Model\Entity\SymptomsLocation newEmptyEntity()
 * @method \App\Model\Entity\SymptomsLocation newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\SymptomsLocation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SymptomsLocation get($primaryKey, $options = [])
 * @method \App\Model\Entity\SymptomsLocation findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\SymptomsLocation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SymptomsLocation[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\SymptomsLocation|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SymptomsLocation saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SymptomsLocation[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\SymptomsLocation[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\SymptomsLocation[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\SymptomsLocation[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class SymptomsLocationsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('symptoms_locations');
        $this->setDisplayField('symptoms_locations_id');
        $this->setPrimaryKey('symptoms_locations_id');

        $this->belongsTo('InterviewSymptoms', [
            'foreignKey' => 'interview_symptoms_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Locations', [
            'foreignKey' => 'locations_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('symptoms_locations_id')
            ->allowEmptyString('symptoms_locations_id', null, 'create');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['interview_symptoms_id'], 'InterviewSymptoms'), ['errorField' => 'interview_symptoms_id']);
        $rules->add($rules->existsIn(['locations_id'], 'Locations'), ['errorField' => 'locations_id']);

        return $rules;
    }
}
