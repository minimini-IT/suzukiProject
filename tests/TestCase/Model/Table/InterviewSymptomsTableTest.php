<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InterviewSymptomsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InterviewSymptomsTable Test Case
 */
class InterviewSymptomsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\InterviewSymptomsTable
     */
    protected $InterviewSymptoms;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.InterviewSymptoms',
        'app.Patients',
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
        $config = $this->getTableLocator()->exists('InterviewSymptoms') ? [] : ['className' => InterviewSymptomsTable::class];
        $this->InterviewSymptoms = $this->getTableLocator()->get('InterviewSymptoms', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->InterviewSymptoms);

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
