<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SeccFamiliesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SeccFamiliesTable Test Case
 */
class SeccFamiliesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SeccFamiliesTable
     */
    public $SeccFamilies;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.SeccFamilies',
        'app.SeccCardholders',
        'app.Relations',
        'app.Genders',
        'app.BankMasters',
        'app.BranchMasters',
        'app.BankBackups',
        'app.DelUidBackups',
        'app.DelUidSeccFamilies',
        'app.DigilockerBackups',
        'app.ErcmsLogs',
        'app.GenderFlags',
        'app.KoilDbtFinalBackups',
        'app.KoilDbtFinals',
        'app.KoilDbtSeconds',
        'app.KoilDbtThird',
        'app.KoilDbts',
        'app.MobileBackups',
        'app.OtpTransactions',
        'app.PfmsRegistrations',
        'app.Portability106Transactions',
        'app.Portability116Transactions',
        'app.Portability126Transactions',
        'app.Portability86Transactions',
        'app.Portability96Transactions',
        'app.PortabilityTransactions',
        'app.RiceDbts',
        'app.SeccCardholderActivityRequests',
        'app.SeccCardholderPfms',
        'app.SeccFamilyAddTemps',
        'app.SeccFamilyFlag',
        'app.SeccFamilyFlagBackup',
        'app.SeccFamilyTempBackups',
        'app.SeccFamilyTemps',
        'app.TempTransactions',
        'app.TempTransactions9Backup',
        'app.Transaction2017Backups',
        'app.TransactionCt',
        'app.TransactionUids',
        'app.Transactions',
        'app.UidBackupLogOnes',
        'app.UidBackups',
        'app.UidVaultBackups',
        'app.UidVaultChangeDeleteBackups',
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
        $config = TableRegistry::getTableLocator()->exists('SeccFamilies') ? [] : ['className' => SeccFamiliesTable::class];
        $this->SeccFamilies = TableRegistry::getTableLocator()->get('SeccFamilies', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SeccFamilies);

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
