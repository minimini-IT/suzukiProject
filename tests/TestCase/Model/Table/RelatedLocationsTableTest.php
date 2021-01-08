<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RelatedLocationsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RelatedLocationsTable Test Case
 */
class RelatedLocationsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RelatedLocationsTable
     */
    protected $RelatedLocations;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.RelatedLocations',
        'app.Articles',
        'app.Locations',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('RelatedLocations') ? [] : ['className' => RelatedLocationsTable::class];
        $this->RelatedLocations = $this->getTableLocator()->get('RelatedLocations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->RelatedLocations);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
