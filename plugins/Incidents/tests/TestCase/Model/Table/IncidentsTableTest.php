<?php
namespace Incidents\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Incidents\Model\Table\IncidentsTable;

/**
 * Incidents\Model\Table\IncidentsTable Test Case
 */
class IncidentsTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'Incidents' => 'plugin.incidents.incidents',
        'Areas' => 'plugin.incidents.areas',
        'Teams' => 'plugin.incidents.teams',
        'Referrals' => 'plugin.incidents.referrals',
        'SupportTypes' => 'plugin.incidents.support_types',
        'SupportTypeSubs' => 'plugin.incidents.support_type_subs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Incidents') ? [] : ['className' => 'Incidents\Model\Table\IncidentsTable'];
        $this->Incidents = TableRegistry::get('Incidents', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Incidents);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
