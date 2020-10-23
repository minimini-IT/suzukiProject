<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * InterviewSymptomsFixture
 */
class InterviewSymptomsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'interview_symptoms_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'patients_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'symptoms_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => false, 'default' => null, 'comment' => ''],
        'modified' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => false, 'default' => null, 'comment' => ''],
        '_indexes' => [
            'patients_id' => ['type' => 'index', 'columns' => ['patients_id'], 'length' => []],
            'symptoms_id' => ['type' => 'index', 'columns' => ['symptoms_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['interview_symptoms_id'], 'length' => []],
            'interview_symptoms_ibfk_2' => ['type' => 'foreign', 'columns' => ['symptoms_id'], 'references' => ['symptoms', 'symptoms_id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'interview_symptoms_ibfk_1' => ['type' => 'foreign', 'columns' => ['patients_id'], 'references' => ['patients', 'patients_id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
                'interview_symptoms_id' => 1,
                'patients_id' => 1,
                'symptoms_id' => 1,
                'created' => '2020-10-13 15:35:42',
                'modified' => '2020-10-13 15:35:42',
            ],
        ];
        parent::init();
    }
}
