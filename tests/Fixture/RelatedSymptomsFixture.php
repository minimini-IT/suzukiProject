<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RelatedSymptomsFixture
 */
class RelatedSymptomsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'related_symptoms_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'articles_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'symptoms_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'articles_id' => ['type' => 'index', 'columns' => ['articles_id'], 'length' => []],
            'symptoms_id' => ['type' => 'index', 'columns' => ['symptoms_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['related_symptoms_id'], 'length' => []],
            'related_symptoms_ibfk_2' => ['type' => 'foreign', 'columns' => ['symptoms_id'], 'references' => ['symptoms', 'symptoms_id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'related_symptoms_ibfk_1' => ['type' => 'foreign', 'columns' => ['articles_id'], 'references' => ['articles', 'articles_id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
                'related_symptoms_id' => 1,
                'articles_id' => 1,
                'symptoms_id' => 1,
            ],
        ];
        parent::init();
    }
}
