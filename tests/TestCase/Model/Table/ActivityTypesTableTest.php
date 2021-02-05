<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ActivityTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ActivityTypesTable Test Case
 */
class ActivityTypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ActivityTypesTable
     */
    public $ActivityTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ActivityTypes',
        'app.DsoActivityOtps',
        'app.ErcmsLogs',
        'app.SeccCardholderTempBackups',
        'app.SeccCardholderTemps',
        'app.SeccFamilyTempBackups',
        'app.SeccFamilyTemps',
        'app.UidVaultChangeDeleteBackups',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ActivityTypes') ? [] : ['className' => ActivityTypesTable::class];
        $this->ActivityTypes = TableRegistry::getTableLocator()->get('ActivityTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ActivityTypes);

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
