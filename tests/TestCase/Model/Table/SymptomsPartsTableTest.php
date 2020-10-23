<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SymptomsPartsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SymptomsPartsTable Test Case
 */
class SymptomsPartsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SymptomsPartsTable
     */
    protected $SymptomsParts;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.SymptomsParts',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('SymptomsParts') ? [] : ['className' => SymptomsPartsTable::class];
        $this->SymptomsParts = $this->getTableLocator()->get('SymptomsParts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->SymptomsParts);

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
