<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ExclusionCriteriasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ExclusionCriteriasTable Test Case
 */
class ExclusionCriteriasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ExclusionCriteriasTable
     */
    public $ExclusionCriterias;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ExclusionCriterias',
        'app.Locations',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ExclusionCriterias') ? [] : ['className' => ExclusionCriteriasTable::class];
        $this->ExclusionCriterias = TableRegistry::getTableLocator()->get('ExclusionCriterias', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ExclusionCriterias);

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
