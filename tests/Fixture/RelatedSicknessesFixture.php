<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RelatedSicknessesFixture
 */
class RelatedSicknessesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'related_sicknesses_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'articles_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'sicknesses_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'articles_id' => ['type' => 'index', 'columns' => ['articles_id'], 'length' => []],
            'sicknesses_id' => ['type' => 'index', 'columns' => ['sicknesses_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['related_sicknesses_id'], 'length' => []],
            'related_sicknesses_ibfk_2' => ['type' => 'foreign', 'columns' => ['sicknesses_id'], 'references' => ['sicknesses', 'sicknesses_id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'related_sicknesses_ibfk_1' => ['type' => 'foreign', 'columns' => ['articles_id'], 'references' => ['articles', 'articles_id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
                'related_sicknesses_id' => 1,
                'articles_id' => 1,
                'sicknesses_id' => 1,
            ],
        ];
        parent::init();
    }
}
