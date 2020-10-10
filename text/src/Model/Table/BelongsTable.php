<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Belongs Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\HasMany $Users
 *
 * @method \App\Model\Entity\Belong get($primaryKey, $options = [])
 * @method \App\Model\Entity\Belong newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Belong[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Belong|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Belong saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Belong patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Belong[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Belong findOrCreate($search, callable $callback = null, $options = [])
 */
class BelongsTable extends Table
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

        $this->setTable('belongs');
        $this->setDisplayField('belong');
        $this->setPrimaryKey('belongs_id');

        $this->hasMany('Users', [
            'foreignKey' => 'belong_id'
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
            ->integer('belongs_id')
            ->allowEmptyString('belongs_id', null, 'create');

        $validator
            ->scalar('belong')
            ->maxLength('belong', 20)
            ->requirePresence('belong', 'create')
            ->notEmptyString('belong');

        $validator
            ->integer('belong_sort_number')
            ->allowEmptyString('belong_sort_number');

        return $validator;
    }
}
