<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SeccFamilyAddTempsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SeccFamilyAddTempsTable Test Case
 */
class SeccFamilyAddTempsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SeccFamilyAddTempsTable
     */
    public $SeccFamilyAddTemps;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.SeccFamilyAddTemps',
        'app.SeccFamilies',
        'app.SeccCardholders',
        'app.SeccCardholderTemps',
        'app.Relations',
        'app.Genders',
        'app.BankMasters',
        'app.BranchMasters',
        'app.ActivitiesStatuses',
        'app.ActivityTypes',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('SeccFamilyAddTemps') ? [] : ['className' => SeccFamilyAddTempsTable::class];
        $this->SeccFamilyAddTemps = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SeccFamilyAddTemps);

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
