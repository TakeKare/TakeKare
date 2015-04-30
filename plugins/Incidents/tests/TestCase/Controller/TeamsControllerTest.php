<?php
namespace Incidents\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestCase;
use Incidents\Controller\TeamsController;

/**
 * Incidents\Controller\TeamsController Test Case
 */
class TeamsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'Teams' => 'plugin.incidents.teams'
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
