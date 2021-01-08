<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\DbLogComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\DbLogComponent Test Case
 */
class DbLogComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Controller\Component\DbLogComponent
     */
    protected $DbLog;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->DbLog = new DbLogComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->DbLog);

        parent::tearDown();
    }
}
