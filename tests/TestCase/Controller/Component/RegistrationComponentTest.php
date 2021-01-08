<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\RegistrationComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\RegistrationComponent Test Case
 */
class RegistrationComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Controller\Component\RegistrationComponent
     */
    protected $Registration;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Registration = new RegistrationComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Registration);

        parent::tearDown();
    }
}
