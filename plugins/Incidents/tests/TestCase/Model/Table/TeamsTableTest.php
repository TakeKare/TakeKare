<?php
namespace Incidents\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Incidents\Model\Table\TeamsTable;

/**
 * Incidents\Model\Table\TeamsTable Test Case
 */
class TeamsTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'Teams' => 'plugin.incidents.teams',
        'Areas' => 'plugin.incidents.areas',
        'Leaders' => 'plugin.incidents.leaders',
        'Incidents' => 'plugin.incidents.incidents',
        'Referrals' => 'plugin.incidents.referrals',
        'SupportTypes' => 'plugin.incidents.support_types',
        'SupportTypeSubs' => 'plugin.incidents.support_type_subs',
        'Users' => 'plugin.incidents.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Teams') ? [] : ['className' => 'Incidents\Model\Table\TeamsTable'];
        $this->Teams = TableRegistry::get('Teams', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Teams);

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
