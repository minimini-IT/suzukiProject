<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Positives Model
 *
 * @method \App\Model\Entity\Positive get($primaryKey, $options = [])
 * @method \App\Model\Entity\Positive newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Positive[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Positive|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Positive saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Positive patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Positive[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Positive findOrCreate($search, callable $callback = null, $options = [])
 */
class PositivesTable extends Table
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

        $this->setTable('positives');
        $this->setDisplayField('positive');
        $this->setPrimaryKey('positives_id');
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
            ->integer('positives_id')
            ->allowEmptyString('positives_id', null, 'create');

        $validator
            ->scalar('positive')
            ->maxLength('positive', 30)
            ->requirePresence('positive', 'create')
            ->notEmptyString('positive');

        return $validator;
    }
}
