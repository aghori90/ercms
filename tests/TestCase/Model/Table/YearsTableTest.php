<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\YearsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\YearsTable Test Case
 */
class YearsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\YearsTable
     */
    public $Years;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Years',
        'app.AllocationUpload',
        'app.Allocationrules',
        'app.Allocationrules2018Backups',
        'app.BlockCityMonthlyReports',
        'app.BlockPolicies',
        'app.BlockStockReports',
        'app.CardholderTransactions',
        'app.CardholderUpload',
        'app.CardholderUpload37Backups',
        'app.ComplainRecords',
        'app.DealerMonthlyCentral115Reports',
        'app.DealerMonthlyCentral56Reports',
        'app.DealerMonthlyCentral66Reports',
        'app.DealerMonthlyCentralReports',
        'app.DealerMonthlyReport2016Backups',
        'app.DealerMonthlyReport2017Backups',
        'app.DealerMonthlyReports',
        'app.DealerMonthlyTransactions',
        'app.DelUidBackups',
        'app.DelUidSeccFamilies',
        'app.DepartmentSecurityAudits',
        'app.DepotAllocation3Backups',
        'app.DepotAllocation4Backups',
        'app.DepotAllocations',
        'app.DepotStockIn2017Backups',
        'app.DepotStockIns',
        'app.DepotStockOut2017Backups',
        'app.DepotStockOuts',
        'app.DistrictMonthlyReports',
        'app.DistrictSteps',
        'app.DistrictStockReports',
        'app.EligibleImpdsBeneficiaries7',
        'app.EntitlementDownloads',
        'app.ErcmsBlockDailyReports',
        'app.ErcmsCardholderTransactions',
        'app.ErcmsDailyReports',
        'app.FamilyDownload126Backups',
        'app.FamilyDownloads',
        'app.FciDepotDispatch2017Backups',
        'app.FciDepotDispatches',
        'app.FpsAllocations',
        'app.FpsAllocations2017Backups',
        'app.FpsAllocations2018Backups',
        'app.FpsAllocationsDist',
        'app.FpsRcCounts',
        'app.FpsStockIn2017Backups',
        'app.FpsStockIns',
        'app.FpsStocks',
        'app.KoilDbtFinalBackups',
        'app.KoilDbtFinals',
        'app.KoilDbtSeconds',
        'app.KoilDbtThird',
        'app.KoilDbts',
        'app.OtpTransactions',
        'app.Pdsreceiveauthdailycommoditystats',
        'app.Pdsreceiveauthdailytransactionstats',
        'app.Pdsreceivedistrictwisedailycommoditystats',
        'app.Pdsreceivedistrictwisemonthlystats',
        'app.Pdsreceivefailedtransactions',
        'app.Pdsreceivestatewisemonthlystats',
        'app.PfmsRegistrations',
        'app.PolicyTemps',
        'app.Portability106Transactions',
        'app.Portability116Transactions',
        'app.Portability126Transactions',
        'app.Portability86Transactions',
        'app.Portability96Transactions',
        'app.PortabilityTransactions',
        'app.RiceDbtNotLifteds',
        'app.RiceDbtSteps',
        'app.RiceDbts',
        'app.RoDetails',
        'app.StateRcCounts',
        'app.TempTransactions',
        'app.TempTransactions9Backup',
        'app.Transaction2017Backups',
        'app.TransactionCt',
        'app.TransactionUids',
        'app.Transactions',
        'app.UidVerficationReports',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Years') ? [] : ['className' => YearsTable::class];
        $this->Years = TableRegistry::getTableLocator()->get('Years', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Years);

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
