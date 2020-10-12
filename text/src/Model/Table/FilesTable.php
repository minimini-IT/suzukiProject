<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Files Model
 *
 * @method \App\Model\Entity\File get($primaryKey, $options = [])
 * @method \App\Model\Entity\File newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\File[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\File|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\File saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\File patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\File[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\File findOrCreate($search, callable $callback = null, $options = [])
 */
class FilesTable extends Table
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

        $this->setTable('files');
        $this->setDisplayField('files_id');
        $this->setPrimaryKey('files_id');

        $this->belongsTo('CrewSends', [
            'foreignKey' => 'crew_sends_id',
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
            ->integer('files_id')
            ->allowEmptyFile('files_id', null, 'create');

        $validator
            ->scalar('file_name')
            ->maxLength('file_name', 255)
            ->requirePresence('file_name', 'create')
            ->notEmptyFile('file_name');

        $validator
            ->scalar('file_size')
            ->maxLength('file_size', 10)
            ->requirePresence('file_size', 'create')
            ->notEmptyFile('file_size');

        $validator
            ->scalar('unique_file_name')
            ->maxLength('unique_file_name', 255)
            ->requirePresence('unique_file_name', 'create')
            ->notEmptyFile('unique_file_name');

        $validator
            ->integer('crew_sends_id')
            ->requirePresence('crew_sends_id', 'create')
            ->notEmptyFile('crew_sends_id');

        return $validator;
    }

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['crew_sends_id'], 'CrewSends'));

        return $rules;
    }
}
