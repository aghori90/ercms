<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SeccCardholdersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SeccCardholdersTable Test Case
 */
class SeccCardholdersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SeccCardholdersTable
     */
    public $SeccCardholders;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.SeccCardholders',
        'app.Locations',
        'app.Cardtypes',
        'app.Castes',
        'app.SeccDistricts',
        'app.SeccBlocks',
        'app.Panchayats',
        'app.SeccVillageWards',
        'app.Dealers',
        'app.CardholderTransactions',
        'app.SeccCardholderTempBackups',
        'app.SeccCardholderTemps',
        'app.SeccFamilies',
        'app.SeccFamiliesMerge',
        'app.SeccFamiliesRural',
        'app.SeccFamilyTempBackups',
        'app.SeccFamilyTemps',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('SeccCardholders') ? [] : ['className' => SeccCardholdersTable::class];
        $this->SeccCardholders = TableRegistry::getTableLocator()->get('SeccCardholders', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SeccCardholders);

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
