<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class LocationsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('locations');
        //$this->setDisplayField('locations_id');
        $this->setDisplayField('location');
        $this->setPrimaryKey('locations_id');
    }

    public function findSearchLocationsElement(Query $query, array $options)
    {
        $values = $options["values"];

        return $query
            ->where(["locations_id in" => $values])
            ->select(["alias" => "location"]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('locations_id')
            ->allowEmptyString('locations_id', null, 'create');

        $validator
            ->scalar('location')
            ->maxLength('location', 255)
            ->requirePresence('location', 'create')
            ->notEmptyString('location');

        return $validator;
    }
}
