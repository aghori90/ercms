<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * NfsaCardholderAddTemp Entity
 *
 * @property string $id
 * @property string|null $nfsa_cardholder_id
 * @property string|null $ack_no
 * @property string|null $mobileno
 * @property string|null $uid
 * @property string|null $rationcard_no
 * @property string $name
 * @property string $name_sl
 * @property int $location_id
 * @property int|null $cardtype_id
 * @property string $fathername
 * @property string $fathername_sl
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
 * @property string|null $dealer_id
 * @property int|null $is_lpg
 * @property bool|null $lpg_company
 * @property string|null $lpg_consumer_no
 * @property int|null $is_bank
 * @property string|null $bank_account_no
 * @property int|null $bank_master_id
 * @property int|null $branch_master_id
 * @property string|null $bank_ifsc_code
 * @property string|null $status
 * @property int|null $family_count
 * @property int|null $mobile_count
 * @property int|null $uid_count
 * @property int|null $printFlag
 * @property int|null $applicationType
 * @property int|null $applicationType_rule_id
 * @property int|null $occupationId
 * @property int|null $activity_type_id
 * @property int|null $activities_status_id
 * @property int|null $activity_flag
 * @property int|null $activityFlag
 * @property int|null $activityType
 * @property int|null $dbtFlag
 * @property int|null $liftedCount
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property \Cake\I18n\FrozenTime|null $verified
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property int|null $verified_by
 * @property int|null $printed_by
 * @property int|null $subsidyMonth
 * @property string|null $remarks
 * @property int|null $priority_marks
 * @property string|null $bso_remarks
 * @property string|null $dso_remarks
 * @property string|null $requested_mobile
 * @property int|null $requestedBy
 * @property string|null $bso_uid
 * @property string|null $dso_uid
 * @property \Cake\I18n\FrozenTime|null $bso_modifiedDate
 * @property \Cake\I18n\FrozenTime|null $dso_modifiedDate
 * @property \Cake\I18n\FrozenTime|null $dep_modified
 * @property string|null $dep_remarks
 * @property int|null $flag
 * @property int|null $application_status
 * @property int|null $old_alone
 * @property int|null $non_gov
 * @property int|null $above_sixty
 * @property int|null $marital_status
 * @property int|null $disability_status
 * @property int|null $health_status
 * @property int|null $beggar
 * @property int|null $rag_picker
 * @property int|null $worker
 * @property int|null $street_vendor
 * @property int|null $pvtg
 * @property int|null $secc_cardholder_add_tempscol
 *
 * @property \App\Model\Entity\NfsaCardholder $nfsa_cardholder
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
 * @property \App\Model\Entity\ActivityType $activity_type
 * @property \App\Model\Entity\ActivitiesStatus $activities_status
 * @property \App\Model\Entity\NfsaFamilyAddTemp[] $nfsa_family_add_temps
 */
class NfsaCardholderAddTemp extends Entity
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
        'nfsa_cardholder_id' => true,
        'ack_no' => true,
        'mobileno' => true,
        'uid' => true,
        'rationcard_no' => true,
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
        'is_bank' => true,
        'bank_account_no' => true,
        'bank_master_id' => true,
        'branch_master_id' => true,
        'bank_ifsc_code' => true,
        'status' => true,
        'family_count' => true,
        'mobile_count' => true,
        'uid_count' => true,
        'printFlag' => true,
        'applicationType' => true,
        'applicationType_rule_id' => true,
        'occupationId' => true,
        'activity_type_id' => true,
        'activities_status_id' => true,
        'activity_flag' => true,
        'activityFlag' => true,
        'activityType' => true,
        'dbtFlag' => true,
        'liftedCount' => true,
        'created' => true,
        'modified' => true,
        'verified' => true,
        'created_by' => true,
        'modified_by' => true,
        'verified_by' => true,
        'printed_by' => true,
        'subsidyMonth' => true,
        'remarks' => true,
        'priority_marks' => true,
        'bso_remarks' => true,
        'dso_remarks' => true,
        'requested_mobile' => true,
        'requestedBy' => true,
        'bso_uid' => true,
        'dso_uid' => true,
        'bso_modifiedDate' => true,
        'dso_modifiedDate' => true,
        'dep_modified' => true,
        'dep_remarks' => true,
        'flag' => true,
        'application_status' => true,
        'old_alone' => true,
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
        'secc_cardholder_add_tempscol' => true,
        'nfsa_cardholder' => true,
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
        'activity_type' => true,
        'activities_status' => true,
        'nfsa_family_add_temps' => true,
    ];
}
