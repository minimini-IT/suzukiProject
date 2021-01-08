<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\SaveErrorComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\SaveErrorComponent Test Case
 */
class SaveErrorComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Controller\Component\SaveErrorComponent
     */
    protected $SaveError;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->SaveError = new SaveErrorComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->SaveError);

        parent::tearDown();
    }
}
