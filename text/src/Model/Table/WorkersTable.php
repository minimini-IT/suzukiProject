<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Workers Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\ClassesTable&\Cake\ORM\Association\BelongsTo $Classes
 * @property \App\Model\Table\PositionsTable&\Cake\ORM\Association\BelongsTo $Positions
 * @property \App\Model\Table\ShiftsTable&\Cake\ORM\Association\BelongsTo $Shifts
 * @property \App\Model\Table\DutiesTable&\Cake\ORM\Association\BelongsTo $Duties
 *
 * @method \App\Model\Entity\Worker get($primaryKey, $options = [])
 * @method \App\Model\Entity\Worker newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Worker[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Worker|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Worker saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Worker patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Worker[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Worker findOrCreate($search, callable $callback = null, $options = [])
 */
class WorkersTable extends Table
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

        $this->setTable('workers');
        $this->setDisplayField('date');
        $this->setPrimaryKey(['date', 'users_id']);

        $this->belongsTo('Users', [
            'foreignKey' => 'users_id'
            //'joinType' => 'INNER'
        ]);
        $this->belongsTo('Positions', [
            'foreignKey' => 'positions_id'
        ]);
        $this->belongsTo('Shifts', [
            'foreignKey' => 'shifts_id'
            //'joinType' => 'INNER'
        ]);
        $this->belongsTo('Duties', [
            'foreignKey' => 'duties_id'
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
            ->date('date')
            ->allowEmptyDate('date', null, 'create');

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
        $rules->add($rules->existsIn(['users_id'], 'Users'));
        $rules->add($rules->existsIn(['positions_id'], 'Positions'));
        $rules->add($rules->existsIn(['shifts_id'], 'Shifts'));
        $rules->add($rules->existsIn(['duties_id'], 'Duties'));

        return $rules;
    }
}
