<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SicknessesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SicknessesTable Test Case
 */
class SicknessesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SicknessesTable
     */
    protected $Sicknesses;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
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
        $config = $this->getTableLocator()->exists('Sicknesses') ? [] : ['className' => SicknessesTable::class];
        $this->Sicknesses = $this->getTableLocator()->get('Sicknesses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Sicknesses);

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
