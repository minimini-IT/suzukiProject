<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RepresentsFixture
 */
class RepresentsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'represents_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'sicknesses_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'symptoms_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'sicknesses_id' => ['type' => 'index', 'columns' => ['sicknesses_id'], 'length' => []],
            'symptoms_id' => ['type' => 'index', 'columns' => ['symptoms_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['represents_id'], 'length' => []],
            'represents_ibfk_2' => ['type' => 'foreign', 'columns' => ['symptoms_id'], 'references' => ['symptoms', 'symptoms_id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'represents_ibfk_1' => ['type' => 'foreign', 'columns' => ['sicknesses_id'], 'references' => ['sicknesses', 'sicknesses_id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
                'represents_id' => 1,
                'sicknesses_id' => 1,
                'symptoms_id' => 1,
            ],
        ];
        parent::init();
    }
}
