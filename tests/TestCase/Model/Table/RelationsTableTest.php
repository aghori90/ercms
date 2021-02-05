<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RelationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RelationsTable Test Case
 */
class RelationsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RelationsTable
     */
    public $Relations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Relations',
        'app.Genders',
        'app.DelUidSeccFamilies',
        'app.Families',
        'app.Hhd37Families',
        'app.Hhd47Families',
        'app.MobDels',
        'app.SeccFamilies',
        'app.SeccFamiliesDels',
        'app.SeccFamilyAddTemps',
        'app.SeccFamilyTempBackups',
        'app.SeccFamilyTemps',
        'app.SeccFamilyWhites',
        'app.UidVerifiedDuplicates',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Relations') ? [] : ['className' => RelationsTable::class];
        $this->Relations = TableRegistry::getTableLocator()->get('Relations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Relations);

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
