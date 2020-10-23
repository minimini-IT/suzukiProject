<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * DiseasedsFixture
 */
class DiseasedsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'diseaseds_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'patients_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'sicknesses_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'patients_id' => ['type' => 'index', 'columns' => ['patients_id'], 'length' => []],
            'sicknesses_id' => ['type' => 'index', 'columns' => ['sicknesses_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['diseaseds_id'], 'length' => []],
            'diseaseds_ibfk_2' => ['type' => 'foreign', 'columns' => ['sicknesses_id'], 'references' => ['sicknesses', 'sicknesses_id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'diseaseds_ibfk_1' => ['type' => 'foreign', 'columns' => ['patients_id'], 'references' => ['patients', 'patients_id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
                'diseaseds_id' => 1,
                'patients_id' => 1,
                'sicknesses_id' => 1,
            ],
        ];
        parent::init();
    }
}
