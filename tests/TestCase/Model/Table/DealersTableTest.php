<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DealersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DealersTable Test Case
 */
class DealersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DealersTable
     */
    public $Dealers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Dealers',
        'app.Genders',
        'app.Panchayats',
        'app.BlockCities',
        'app.Districts',
        'app.DepotMasters',
        'app.BankMasters',
        'app.BranchMasters',
        'app.DealerCategories',
        'app.AllocationUpload',
        'app.BankPayments',
        'app.CardholderTransactions',
        'app.CardholderUjjwala',
        'app.CardholderUpload',
        'app.CardholderUpload37Backups',
        'app.Cardholders',
        'app.ComplainRecords',
        'app.CurrentStockStatus',
        'app.CurrentStockStatus116Backups',
        'app.CurrentStockStatus126Backups',
        'app.CurrentStockStatus17Backups',
        'app.CurrentStockStatus27Backups',
        'app.DealerActivityLogs',
        'app.DealerBeneficiaryRegistrations',
        'app.DealerMonthlyCentral115Reports',
        'app.DealerMonthlyCentral56Reports',
        'app.DealerMonthlyCentral66Reports',
        'app.DealerMonthlyCentralReports',
        'app.DealerMonthlyReport2016Backups',
        'app.DealerMonthlyReport2017Backups',
        'app.DealerMonthlyReports',
        'app.DealerMonthlyTransactions',
        'app.DealerUpwads',
        'app.DealerUserDels',
        'app.DealerUserLogs',
        'app.DealerUsers',
        'app.DepotStockOut2017Backups',
        'app.DepotStockOuts',
        'app.DigilockerBackups',
        'app.EntitlementDownloads',
        'app.ErcmsCardholderTransactions',
        'app.FamilyDownload126Backups',
        'app.FamilyDownloads',
        'app.FpsAllocations',
        'app.FpsAllocations2017Backups',
        'app.FpsAllocations2018Backups',
        'app.FpsAllocationsDist',
        'app.FpsRcCounts',
        'app.FpsStockIn2017Backups',
        'app.FpsStockIns',
        'app.FpsStocks',
        'app.Hhd37Cardholders',
        'app.Hhd37Families',
        'app.Hhd47Cardholders',
        'app.Hhd47Families',
        'app.HhdMonthlyStocks',
        'app.ImpdsDuplicateDataInterStates',
        'app.KoilDbtFinalBackups',
        'app.KoilDbtFinals',
        'app.KoilDbtSeconds',
        'app.KoilDbtThird',
        'app.KoilDbts',
        'app.OtpTransactions',
        'app.PfmsRegistrations',
        'app.Portability106Dealers',
        'app.Portability106Transactions',
        'app.Portability116Dealers',
        'app.Portability116Transactions',
        'app.Portability126Dealers',
        'app.Portability126Transactions',
        'app.Portability86Transactions',
        'app.Portability96Transactions',
        'app.PortabilityTransactions',
        'app.RiceDbtNotLifteds',
        'app.RiceDbts',
        'app.SeccCardholderAddTemps',
        'app.SeccCardholderTemps',
        'app.SeccCardholderWhites',
        'app.SeccCardholders',
        'app.SeccCardholdersDels',
        'app.TempTransactions',
        'app.TempTransactions9Backup',
        'app.Transaction2017Backups',
        'app.TransactionCt',
        'app.TransactionUids',
        'app.Transactions',
        'app.UidDetails',
        'app.UidVerifiedDuplicates',
        'app.VigilanceCommittees',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Dealers') ? [] : ['className' => DealersTable::class];
        $this->Dealers = TableRegistry::getTableLocator()->get('Dealers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Dealers);

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
