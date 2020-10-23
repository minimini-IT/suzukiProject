<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SymptomsLocationsFixture
 */
class SymptomsLocationsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'symptoms_locations_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'interview_symptoms_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'locations_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'interview_symptoms_id' => ['type' => 'index', 'columns' => ['interview_symptoms_id'], 'length' => []],
            'locations_id' => ['type' => 'index', 'columns' => ['locations_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['symptoms_locations_id'], 'length' => []],
            'symptoms_locations_ibfk_2' => ['type' => 'foreign', 'columns' => ['locations_id'], 'references' => ['locations', 'locations_id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'symptoms_locations_ibfk_1' => ['type' => 'foreign', 'columns' => ['interview_symptoms_id'], 'references' => ['interview_symptoms', 'interview_symptoms_id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // phpcs:enable
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'symptoms_locations_id' => 1,
                'interview_symptoms_id' => 1,
                'locations_id' => 1,
            ],
        ];
        parent::init();
    }
}
