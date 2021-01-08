<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class SicknessesTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('sicknesses');
        $this->setDisplayField('sickness_name');
        $this->setPrimaryKey('sicknesses_id');

        $this->hasMany('Diseaseds', [
            'foreignKey' => 'sicknesses_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('RelatedSicknesses', [
            'foreignKey' => 'sicknesses_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Represents', [
            'foreignKey' => 'sicknesses_id',
            'joinType' => 'INNER',
        ]);
    }

    public function findAddPatientsSicknesses(Query $query, array $options)
    {
        return $query
            ->where(["sicknesses_id !=" => 1]);
    }

    public function findNotIncluded(Query $query, array $options)
    {
        $sub_query = $options["sub_query"];

        return $query
            ->where(["sicknesses_id not in" => $sub_query]);
    }

    //public function findSearchSicknessesElement(Query $query, array $options)
    public function findGetSicknessesName(Query $query, array $options)
    {
        $values = $options["values"];

        return $query
            ->where(["sicknesses_id in" => $values])
            ->select(["alias" => "sickness_name"]);
    }

    public function findSickCount(Query $query, array $options)
    {
        return $query
            ->select("sicknesses_id");
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('sicknesses_id')
            ->allowEmptyString('sicknesses_id', null, 'create');

        $validator
            ->scalar('sickness_name')
            ->maxLength('sickness_name', 80)
            ->requirePresence('sickness_name', 'create')
            ->notEmptyString('sickness_name');

        return $validator;
    }
}
