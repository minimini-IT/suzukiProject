<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DiseasedsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DiseasedsTable Test Case
 */
class DiseasedsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DiseasedsTable
     */
    protected $Diseaseds;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Diseaseds',
        'app.Patients',
        'app.Sicknesses',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Diseaseds') ? [] : ['className' => DiseasedsTable::class];
        $this->Diseaseds = $this->getTableLocator()->get('Diseaseds', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Diseaseds);

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
