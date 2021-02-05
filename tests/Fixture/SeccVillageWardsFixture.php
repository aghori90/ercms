<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SeccVillageWardsFixture
 */
class SeccVillageWardsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'string', 'length' => 5, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'name' => ['type' => 'string', 'length' => 100, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'name_hi' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'secc_panchayat_id' => ['type' => 'string', 'length' => 5, 'null' => false, 'default' => '', 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'secc_block_id' => ['type' => 'string', 'length' => 5, 'null' => false, 'default' => '', 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'secc_district_id' => ['type' => 'string', 'length' => 5, 'null' => false, 'default' => '', 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'rgi_village_code' => ['type' => 'string', 'length' => 10, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'rgi_block_code' => ['type' => 'string', 'length' => 6, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'panchayat_id' => ['type' => 'uuid', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'state_code' => ['type' => 'string', 'length' => 2, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'flag' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'DeleteCount' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'phHead' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'phMember' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'aayHead' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'aayMember' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'white_ration_counts' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'white_member_counts' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'districtBlockIndex' => ['type' => 'index', 'columns' => ['secc_district_id', 'secc_block_id'], 'length' => []],
            'rgiBlockIndex' => ['type' => 'index', 'columns' => ['rgi_block_code'], 'length' => []],
            'RgiVillageIndex' => ['type' => 'index', 'columns' => ['rgi_village_code'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id', 'secc_block_id', 'secc_district_id'], 'length' => []],
            'rgiVillageUnique' => ['type' => 'unique', 'columns' => ['rgi_village_code'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd
    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id' => '6d953b26-437f-41c2-82f1-aca1654c7c53',
                'name' => 'Lorem ipsum dolor sit amet',
                'name_hi' => 'Lorem ipsum dolor sit amet',
                'secc_panchayat_id' => 'Lor',
                'secc_block_id' => '3820125e-5159-48ca-8d74-c2bb9e3c1168',
                'secc_district_id' => 'bcd00982-4168-4642-8e38-9eccbf55876d',
                'rgi_village_code' => 'Lorem ip',
                'rgi_block_code' => 'Lore',
                'panchayat_id' => '9284d439-b7cd-4e97-9cf7-45408fedc9dd',
                'state_code' => 'Lo',
                'flag' => 1,
                'DeleteCount' => 1,
                'phHead' => 1,
                'phMember' => 1,
                'aayHead' => 1,
                'aayMember' => 1,
                'white_ration_counts' => 1,
                'white_member_counts' => 1,
            ],
        ];
        parent::init();
    }
}
