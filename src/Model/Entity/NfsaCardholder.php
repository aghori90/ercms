<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * NfsaCardholder Entity
 *
 * @property string $id
 * @property string $rationcard_no
 * @property string|null $impdsRationcard
 * @property string|null $name
 * @property string|null $name_sl
 * @property int|null $location_id
 * @property int|null $cardtype_id
 * @property string|null $fathername
 * @property string|null $fathername_sl
 * @property string|null $mothername
 * @property string|null $mothername_sl
 * @property int|null $caste_id
 * @property string|null $secc_district_id
 * @property string|null $secc_block_id
 * @property string|null $panchayat_id
 * @property string|null $secc_village_ward_id
 * @property string $rgi_district_code
 * @property string $rgi_block_code
 * @property string $rgi_village_code
 * @property string|null $res_address
 * @property string|null $res_address_hn
 * @property string|null $tolla_mohalla
 * @property string|null $qtr_plot_no
 * @property string|null $holding_no
 * @property string $dealer_id
 * @property int|null $is_lpg
 * @property bool|null $lpg_company
 * @property string|null $lpg_consumer_no
 * @property string|null $bank_account_no
 * @property int|null $bank_master_id
 * @property int|null $branch_master_id
 * @property int|null $is_bank
 * @property string|null $status
 * @property int|null $family_count
 * @property int|null $mobile_count
 * @property int|null $uid_count
 * @property int|null $printFlag
 * @property int|null $applicationType
 * @property int|null $applicationType_rule_id
 * @property int|null $activityFlag
 * @property int|null $activityType
 * @property int|null $dbtFlag
 * @property int|null $liftedCount
 * @property int|null $maxFamilySlNo
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property \Cake\I18n\FrozenTime|null $verified
 * @property int $created_by
 * @property int|null $modified_by
 * @property int|null $verified_by
 * @property int|null $printed_by
 * @property int|null $subsidyMonth
 * @property int|null $pfmsFlag
 * @property int $old_alone
 * @property int|null $pfmsKoilFlag
 * @property \Cake\I18n\FrozenTime|null $lastLiftedRation
 * @property int|null $active_inactive
 * @property int|null $delete_reason_id
 * @property int $non_gov
 * @property int $above_sixty
 * @property int $marital_status
 * @property int $disability_status
 * @property int $health_status
 * @property int $beggar
 * @property int $rag_picker
 * @property int $worker
 * @property int $street_vendor
 * @property int $pvtg
 * @property int|null $bank_ifsc_code
 *
 * @property \App\Model\Entity\Location $location
 * @property \App\Model\Entity\Cardtype $cardtype
 * @property \App\Model\Entity\Caste $caste
 * @property \App\Model\Entity\SeccDistrict $secc_district
 * @property \App\Model\Entity\SeccBlock $secc_block
 * @property \App\Model\Entity\Panchayat $panchayat
 * @property \App\Model\Entity\SeccVillageWard $secc_village_ward
 * @property \App\Model\Entity\Dealer $dealer
 * @property \App\Model\Entity\BankMaster $bank_master
 * @property \App\Model\Entity\BranchMaster $branch_master
 * @property \App\Model\Entity\ApplicationTypeRule $application_type_rule
 * @property \App\Model\Entity\DeleteReason $delete_reason
 * @property \App\Model\Entity\NfsaCardholderAddTemp[] $nfsa_cardholder_add_temps
 * @property \App\Model\Entity\NfsaFamily[] $nfsa_families
 * @property \App\Model\Entity\NfsaFamilyAddTemp[] $nfsa_family_add_temps
 */
class NfsaCardholder extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'rationcard_no' => true,
        'impdsRationcard' => true,
        'name' => true,
        'name_sl' => true,
        'location_id' => true,
        'cardtype_id' => true,
        'fathername' => true,
        'fathername_sl' => true,
        'mothername' => true,
        'mothername_sl' => true,
        'caste_id' => true,
        'secc_district_id' => true,
        'secc_block_id' => true,
        'panchayat_id' => true,
        'secc_village_ward_id' => true,
        'rgi_district_code' => true,
        'rgi_block_code' => true,
        'rgi_village_code' => true,
        'res_address' => true,
        'res_address_hn' => true,
        'tolla_mohalla' => true,
        'qtr_plot_no' => true,
        'holding_no' => true,
        'dealer_id' => true,
        'is_lpg' => true,
        'lpg_company' => true,
        'lpg_consumer_no' => true,
        'bank_account_no' => true,
        'bank_master_id' => true,
        'branch_master_id' => true,
        'is_bank' => true,
        'status' => true,
        'family_count' => true,
        'mobile_count' => true,
        'uid_count' => true,
        'printFlag' => true,
        'applicationType' => true,
        'applicationType_rule_id' => true,
        'activityFlag' => true,
        'activityType' => true,
        'dbtFlag' => true,
        'liftedCount' => true,
        'maxFamilySlNo' => true,
        'created' => true,
        'modified' => true,
        'verified' => true,
        'created_by' => true,
        'modified_by' => true,
        'verified_by' => true,
        'printed_by' => true,
        'subsidyMonth' => true,
        'pfmsFlag' => true,
        'old_alone' => true,
        'pfmsKoilFlag' => true,
        'lastLiftedRation' => true,
        'active_inactive' => true,
        'delete_reason_id' => true,
        'non_gov' => true,
        'above_sixty' => true,
        'marital_status' => true,
        'disability_status' => true,
        'health_status' => true,
        'beggar' => true,
        'rag_picker' => true,
        'worker' => true,
        'street_vendor' => true,
        'pvtg' => true,
        'bank_ifsc_code' => true,
        'location' => true,
        'cardtype' => true,
        'caste' => true,
        'secc_district' => true,
        'secc_block' => true,
        'panchayat' => true,
        'secc_village_ward' => true,
        'dealer' => true,
        'bank_master' => true,
        'branch_master' => true,
        'application_type_rule' => true,
        'delete_reason' => true,
        'nfsa_cardholder_add_temps' => true,
        'nfsa_families' => true,
        'nfsa_family_add_temps' => true,
    ];
}