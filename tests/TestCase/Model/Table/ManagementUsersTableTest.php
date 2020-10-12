<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ManagementUsersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ManagementUsersTable Test Case
 */
class ManagementUsersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ManagementUsersTable
     */
    protected $ManagementUsers;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.ManagementUsers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ManagementUsers') ? [] : ['className' => ManagementUsersTable::class];
        $this->ManagementUsers = $this->getTableLocator()->get('ManagementUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->ManagementUsers);

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
