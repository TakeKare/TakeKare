<?php
namespace Incidents\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Incidents\Model\Table\ReferralsTable;

/**
 * Incidents\Model\Table\ReferralsTable Test Case
 */
class ReferralsTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'Referrals' => 'plugin.incidents.referrals',
        'Incidents' => 'plugin.incidents.incidents',
        'Areas' => 'plugin.incidents.areas',
        'Teams' => 'plugin.incidents.teams',
        'Leaders' => 'plugin.incidents.leaders',
        'Users' => 'plugin.incidents.users',
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
        $config = TableRegistry::exists('Referrals') ? [] : ['className' => 'Incidents\Model\Table\ReferralsTable'];
        $this->Referrals = TableRegistry::get('Referrals', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Referrals);

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
}
