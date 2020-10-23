<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RepresentsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RepresentsTable Test Case
 */
class RepresentsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RepresentsTable
     */
    protected $Represents;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Represents',
        'app.Sicknesses',
        'app.Symptoms',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Represents') ? [] : ['className' => RepresentsTable::class];
        $this->Represents = $this->getTableLocator()->get('Represents', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Represents);

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
