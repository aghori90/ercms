<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SeccCardholderAddTempsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SeccCardholderAddTempsTable Test Case
 */
class SeccCardholderAddTempsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SeccCardholderAddTempsTable
     */
    public $SeccCardholderAddTemps;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.SeccCardholderAddTemps',
        'app.SeccCardholders',
        'app.Locations',
        'app.Cardtypes',
        'app.Castes',
        'app.SeccDistricts',
        'app.SeccBlocks',
        'app.Panchayats',
        'app.SeccVillageWards',
        'app.Dealers',
        'app.ActivityTypes',
        'app.ActivitiesStatuses',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('SeccCardholderAddTemps') ? [] : ['className' => SeccCardholderAddTempsTable::class];
        $this->SeccCardholderAddTemps = TableRegistry::getTableLocator()->get('SeccCardholderAddTemps', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SeccCardholderAddTemps);

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
