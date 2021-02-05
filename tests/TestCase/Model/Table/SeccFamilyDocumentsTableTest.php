<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SeccFamilyDocumentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SeccFamilyDocumentsTable Test Case
 */
class SeccFamilyDocumentsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SeccFamilyDocumentsTable
     */
    public $SeccFamilyDocuments;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.SeccFamilyDocuments',
        'app.SeccCardholderAddTemps',
        'app.SeccFamilyAddTemps',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('SeccFamilyDocuments') ? [] : ['className' => SeccFamilyDocumentsTable::class];
        $this->SeccFamilyDocuments = TableRegistry::getTableLocator()->get('SeccFamilyDocuments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SeccFamilyDocuments);

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
