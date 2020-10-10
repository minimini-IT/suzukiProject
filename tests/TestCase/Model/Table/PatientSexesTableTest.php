<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PatientSexesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PatientSexesTable Test Case
 */
class PatientSexesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PatientSexesTable
     */
    protected $PatientSexes;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.PatientSexes',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('PatientSexes') ? [] : ['className' => PatientSexesTable::class];
        $this->PatientSexes = $this->getTableLocator()->get('PatientSexes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->PatientSexes);

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
}
