<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InclusionCriteriasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InclusionCriteriasTable Test Case
 */
class InclusionCriteriasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\InclusionCriteriasTable
     */
    public $InclusionCriterias;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.InclusionCriterias',
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
        $config = TableRegistry::getTableLocator()->exists('InclusionCriterias') ? [] : ['className' => InclusionCriteriasTable::class];
        $this->InclusionCriterias = TableRegistry::getTableLocator()->get('InclusionCriterias', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->InclusionCriterias);

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
