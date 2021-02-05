<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SeccCardholderAddTemp Entity
 *
 * @property string $id
 * @property string|null $secc_cardholder_id
 * @property string|null $registration_no
 * @property string|null $mobile_no
 * @property string|null $uid
 * @property string|null $rationcard_no
 * @property string $name
 * @property string $name_sl
 * @property int $location_id
 * @property int $cardtype_id
 * @property string $fathername
 * @property string $fathername_sl
 * @property string|null $mothername
 * @property string|null $mothername_sl
 * @property int|null $caste_id
 * @property string $secc_district_id
 * @property string $secc_block_id
 * @property string|null $panchayat_id
 * @property string $secc_village_ward_id
 * @property string $rgi_district_code
 * @property string $rgi_block_code
 * @property string $rgi_village_code
 * @property string|null $res_address
 * @property string|null $res_address_hn
 * @property string|null $tolla_mohalla
 * @property string|null $qtr_plot_no
 * @property string|null $holding_no
 * @property string $dealer_id
 * @property string|null $status
 * @property int|null $family_count
 * @property int|null $mobile_count
 * @property int|null $uid_count
 * @property int|null $printFlag
 * @property int $applicationType
 * @property int $activity_type_id
 * @property int $activities_status_id
 * @property int $activity_flag
 * @property int|null $activityFlag
 * @property int|null $activityType
 * @property int|null $dbtFlag
 * @property int|null $liftedCount
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime|null $verified
 * @property int $created_by
 * @property int $modified_by
 * @property int|null $verified_by
 * @property int|null $printed_by
 * @property int|null $subsidyMonth
 * @property string|null $remarks
 * @property string|null $bso_remarks
 * @property string|null $dso_remarks
 * @property string|null $requested_mobile
 * @property string|null $ack_no
 * @property int|null $requestedBy
 * @property string|null $bso_uid
 * @property string|null $dso_uid
 * @property \Cake\I18n\FrozenTime|null $bso_modifiedDate
 * @property \Cake\I18n\FrozenTime|null $dso_modifiedDate
 * @property \Cake\I18n\FrozenTime|null $dep_modified
 * @property string|null $dep_remarks
 * @property int|null $flag
 *
 * @property \App\Model\Entity\SeccCardholder $secc_cardholder
 * @property \App\Model\Entity\Location $location
 * @property \App\Model\Entity\Cardtype $cardtype
 * @property \App\Model\Entity\Caste $caste
 * @property \App\Model\Entity\SeccDistrict $secc_district
 * @property \App\Model\Entity\SeccBlock $secc_block
 * @property \App\Model\Entity\Panchayat $panchayat
 * @property \App\Model\Entity\SeccVillageWard $secc_village_ward
 * @property \App\Model\Entity\Dealer $dealer
 * @property \App\Model\Entity\ActivityType $activity_type
 * @property \App\Model\Entity\ActivitiesStatus $activities_status
 */
class SeccCardholderAddTemp extends Entity
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
        'secc_cardholder_id' => true,
        'mobileno' => true,
        'uid' => true,
        'gender_id' => true,
        'is_lpg' => true,
        'lpg_company' => true,
		'lpg_consumer_no' => true,
		'is_bank' => true,
		'bank_account_no' => true,
        'bank_master_id' => true,
        'branch_master_id' => true,
		'bank_ifsc_code' => true,
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
		'districtName' => true,
		'blockName' => true,
		'villageName' => true,
        'res_address' => true,
        'res_address_hn' => true,
        'tolla_mohalla' => true,
        'qtr_plot_no' => true,
        'holding_no' => true,
        'dealer_id' => true,
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
        'bso_remarks' => true,
        'dso_remarks' => true,
        'requested_mobile' => true,
        'ack_no' => true,
        'requestedBy' => true,
        'bso_uid' => true,
        'dso_uid' => true,
        'bso_modifiedDate' => true,
        'dso_modifiedDate' => true,
        'dep_modified' => true,
        'dep_remarks' => true,
        'flag' => true,
        'secc_cardholder' => true,
        'location' => true,
        'cardtype' => true,
        'caste' => true,
        'secc_district' => true,
        'secc_block' => true,
        'panchayat' => true,
        'secc_village_ward' => true,
        'dealer' => true,
        'activity_type' => true,
        'activities_status' => true,
        'application_status' => true,
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
        'old_alone' => true,
        'applied_through' => true,
    ];
}
