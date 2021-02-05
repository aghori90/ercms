<?php
namespace App\Test\TestCase\Controller;

use App\Controller\SeccFamilyAddTempsController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\SeccFamilyAddTempsController Test Case
 *
 * @uses \App\Controller\SeccFamilyAddTempsController
 */
class SeccFamilyAddTempsControllerTest extends TestCase
{
    use IntegrationTestTrait;

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
