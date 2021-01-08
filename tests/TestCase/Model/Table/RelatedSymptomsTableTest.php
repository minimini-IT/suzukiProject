<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RelatedSymptomsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RelatedSymptomsTable Test Case
 */
class RelatedSymptomsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RelatedSymptomsTable
     */
    protected $RelatedSymptoms;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.RelatedSymptoms',
        'app.Articles',
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
        $config = $this->getTableLocator()->exists('RelatedSymptoms') ? [] : ['className' => RelatedSymptomsTable::class];
        $this->RelatedSymptoms = $this->getTableLocator()->get('RelatedSymptoms', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->RelatedSymptoms);

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
