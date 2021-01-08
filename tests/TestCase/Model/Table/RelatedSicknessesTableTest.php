<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RelatedSicknessesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RelatedSicknessesTable Test Case
 */
class RelatedSicknessesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RelatedSicknessesTable
     */
    protected $RelatedSicknesses;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.RelatedSicknesses',
        'app.Articles',
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
        $config = $this->getTableLocator()->exists('RelatedSicknesses') ? [] : ['className' => RelatedSicknessesTable::class];
        $this->RelatedSicknesses = $this->getTableLocator()->get('RelatedSicknesses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->RelatedSicknesses);

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
