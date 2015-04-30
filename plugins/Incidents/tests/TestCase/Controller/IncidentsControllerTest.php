<?php
namespace Incidents\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use Incidents\Controller\IncidentsController;

/**
 * Incidents\Controller\IncidentsController Test Case
 */
class IncidentsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'Incidents' => 'plugin.incidents.incidents'
    ];

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
