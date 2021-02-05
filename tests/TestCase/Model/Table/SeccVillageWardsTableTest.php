<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SeccVillageWardsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SeccVillageWardsTable Test Case
 */
class SeccVillageWardsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SeccVillageWardsTable
     */
    public $SeccVillageWards;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.SeccVillageWards',
        'app.SeccPanchayats',
        'app.SeccBlocks',
        'app.SeccDistricts',
        'app.Panchayats',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('SeccVillageWards') ? [] : ['className' => SeccVillageWardsTable::class];
        $this->SeccVillageWards = TableRegistry::getTableLocator()->get('SeccVillageWards', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SeccVillageWards);

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
