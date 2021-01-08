<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RelatedLocationsFixture
 */
class RelatedLocationsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'related_locations_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'articles_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'locations_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'articles_id' => ['type' => 'index', 'columns' => ['articles_id'], 'length' => []],
            'locations_id' => ['type' => 'index', 'columns' => ['locations_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['related_locations_id'], 'length' => []],
            'related_locations_ibfk_2' => ['type' => 'foreign', 'columns' => ['locations_id'], 'references' => ['locations', 'locations_id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'related_locations_ibfk_1' => ['type' => 'foreign', 'columns' => ['articles_id'], 'references' => ['articles', 'articles_id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
                'related_locations_id' => 1,
                'articles_id' => 1,
                'locations_id' => 1,
            ],
        ];
        parent::init();
    }
}
