<?php
namespace Incidents\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Incidents\Model\Table\SupportTypesTable;

/**
 * Incidents\Model\Table\SupportTypesTable Test Case
 */
class SupportTypesTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'SupportTypes' => 'plugin.incidents.support_types',
        'Incidents' => 'plugin.incidents.incidents',
        'Areas' => 'plugin.incidents.areas',
        'Teams' => 'plugin.incidents.teams',
        'Leaders' => 'plugin.incidents.leaders',
        'Users' => 'plugin.incidents.users',
        'Referrals' => 'plugin.incidents.referrals',
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
        $config = TableRegistry::exists('SupportTypes') ? [] : ['className' => 'Incidents\Model\Table\SupportTypesTable'];
        $this->SupportTypes = TableRegistry::get('SupportTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SupportTypes);

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
