<?php
namespace App\Test\TestCase\Controller;

use App\Controller\SeccCardholdersController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\SeccCardholdersController Test Case
 *
 * @uses \App\Controller\SeccCardholdersController
 */
class SeccCardholdersControllerTest extends TestCase
{
    use IntegrationTestTrait;

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
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
