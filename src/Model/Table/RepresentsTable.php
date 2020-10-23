<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Represents Model
 *
 * @property \App\Model\Table\SicknessesTable&\Cake\ORM\Association\BelongsTo $Sicknesses
 * @property \App\Model\Table\SymptomsTable&\Cake\ORM\Association\BelongsTo $Symptoms
 *
 * @method \App\Model\Entity\Represent newEmptyEntity()
 * @method \App\Model\Entity\Represent newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Represent[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Represent get($primaryKey, $options = [])
 * @method \App\Model\Entity\Represent findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Represent patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Represent[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Represent|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Represent saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Represent[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Represent[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Represent[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Represent[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class RepresentsTable extends Table
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

        $this->setTable('represents');
        $this->setDisplayField('represents_id');
        $this->setPrimaryKey('represents_id');

        $this->belongsTo('Sicknesses', [
            'foreignKey' => 'sicknesses_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Symptoms', [
            'foreignKey' => 'symptoms_id',
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
            ->integer('represents_id')
            ->allowEmptyString('represents_id', null, 'create');

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
        $rules->add($rules->existsIn(['sicknesses_id'], 'Sicknesses'), ['errorField' => 'sicknesses_id']);
        $rules->add($rules->existsIn(['symptoms_id'], 'Symptoms'), ['errorField' => 'symptoms_id']);

        return $rules;
    }
}
