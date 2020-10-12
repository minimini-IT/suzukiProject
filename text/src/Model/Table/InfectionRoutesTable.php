<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * InfectionRoutes Model
 *
 * @method \App\Model\Entity\InfectionRoute get($primaryKey, $options = [])
 * @method \App\Model\Entity\InfectionRoute newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\InfectionRoute[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\InfectionRoute|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\InfectionRoute saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\InfectionRoute patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\InfectionRoute[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\InfectionRoute findOrCreate($search, callable $callback = null, $options = [])
 */
class InfectionRoutesTable extends Table
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

        $this->setTable('infection_routes');
        $this->setDisplayField('infection_route');
        $this->setPrimaryKey('infection_routes_id');
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
            ->integer('infection_routes_id')
            ->allowEmptyString('infection_routes_id', null, 'create');

        $validator
            ->scalar('infection_route')
            ->maxLength('infection_route', 50)
            ->requirePresence('infection_route', 'create')
            ->notEmptyString('infection_route');

        return $validator;
    }
}
