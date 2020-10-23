<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SymptomsLocationsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SymptomsLocationsTable Test Case
 */
class SymptomsLocationsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SymptomsLocationsTable
     */
    protected $SymptomsLocations;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.SymptomsLocations',
        'app.InterviewSymptoms',
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
        $config = $this->getTableLocator()->exists('SymptomsLocations') ? [] : ['className' => SymptomsLocationsTable::class];
        $this->SymptomsLocations = $this->getTableLocator()->get('SymptomsLocations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->SymptomsLocations);

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
