<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SymptomsParts Model
 *
 * @method \App\Model\Entity\SymptomsPart newEmptyEntity()
 * @method \App\Model\Entity\SymptomsPart newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\SymptomsPart[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SymptomsPart get($primaryKey, $options = [])
 * @method \App\Model\Entity\SymptomsPart findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\SymptomsPart patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SymptomsPart[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\SymptomsPart|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SymptomsPart saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SymptomsPart[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\SymptomsPart[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\SymptomsPart[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\SymptomsPart[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class SymptomsPartsTable extends Table
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

        $this->setTable('symptoms_parts');
        $this->setDisplayField('symptoms_part');
        $this->setPrimaryKey('symptoms_parts_id');
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
            ->integer('symptoms_parts_id')
            ->allowEmptyString('symptoms_parts_id', null, 'create');

        $validator
            ->scalar('symptoms_part')
            ->maxLength('symptoms_part', 255)
            ->requirePresence('symptoms_part', 'create')
            ->notEmptyString('symptoms_part');

        return $validator;
    }
}
