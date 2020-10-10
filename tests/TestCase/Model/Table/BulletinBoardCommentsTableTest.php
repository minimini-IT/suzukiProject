<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BulletinBoardCommentsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BulletinBoardCommentsTable Test Case
 */
class BulletinBoardCommentsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BulletinBoardCommentsTable
     */
    protected $BulletinBoardComments;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.BulletinBoardComments',
        'app.BulletinBoards',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('BulletinBoardComments') ? [] : ['className' => BulletinBoardCommentsTable::class];
        $this->BulletinBoardComments = $this->getTableLocator()->get('BulletinBoardComments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->BulletinBoardComments);

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
