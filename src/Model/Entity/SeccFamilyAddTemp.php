<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SeccFamilyAddTemp Entity
 *
 * @property string $id
 * @property string|null $secc_family_id
 * @property string $rationcard_no
 * @property string|null $ahl_tin
 * @property string|null $hhd_unique_no
 * @property string $secc_cardholder_id
 * @property string|null $secc_cardholder_temp_id
 * @property string $rgi_district_code
 * @property string $rgi_block_code
 * @property string $rgi_village_code
 * @property string $name
 * @property string $name_sl
 * @property string $fathername
 * @property string $fathername_sl
 * @property string|null $mothername
 * @property string|null $mothername_sl
 * @property int $relation_id
 * @property string|null $relation_sl
 * @property int $gender_id
 * @property string $dob
 * @property int|null $freeze_status
 * @property string|null $mobile
 * @property string|null $uid
 * @property string|null $uid_verified
 * @property int|null $bank_master_id
 * @property int|null $branch_master_id
 * @property string|null $accountNo
 * @property int|null $hof
 * @property int|null $uidFlag
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int|null $created_by
 * @property int $modified_by
 * @property string|null $bfd1
 * @property string|null $bfd2
 * @property string|null $bfd3
 * @property int|null $dbtFlag
 * @property string|null $bso_remarks
 * @property string|null $dso_remarks
 * @property int|null $activity_flag
 * @property int|null $activities_status_id
 * @property int|null $activity_type_id
 * @property string|null $requested_mobile
 * @property float $ack_no_ercms
 * @property string|null $bso_uid
 * @property string|null $dso_uid
 * @property \Cake\I18n\FrozenTime|null $bso_modifiedDate
 * @property \Cake\I18n\FrozenTime|null $dso_modifiedDate
 * @property \Cake\I18n\FrozenTime|null $dep_modified
 * @property string|null $dep_remarks
 * @property int|null $requestedBy
 *
 * @property \App\Model\Entity\SeccFamily $secc_family
 * @property \App\Model\Entity\SeccCardholder $secc_cardholder
 * @property \App\Model\Entity\SeccCardholderTemp $secc_cardholder_temp
 * @property \App\Model\Entity\Relation $relation
 * @property \App\Model\Entity\Gender $gender
 * @property \App\Model\Entity\BankMaster $bank_master
 * @property \App\Model\Entity\BranchMaster $branch_master
 * @property \App\Model\Entity\ActivitiesStatus $activities_status
 * @property \App\Model\Entity\ActivityType $activity_type
 */
class SeccFamilyAddTemp extends Entity
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
        'secc_family_id' => true,
        'rationcard_no' => true,
        'ahl_tin' => true,
        'hhd_unique_no' => true,
        'secc_cardholder_id' => true,
        'secc_cardholder_add_temp_id' => true,
        'rgi_district_code' => true,
        'rgi_block_code' => true,
        'rgi_village_code' => true,
        'name' => true,
        'name_sl' => true,
        'fathername' => true,
        'fathername_sl' => true,
        'mothername' => true,
        'mothername_sl' => true,
        'relation_id' => true,
        'relation_sl' => true,
        'gender_id' => true,
        'dob' => true,
        'freeze_status' => true,
        'mobile' => true,
        'uid' => true,
        'uid_verified' => true,
        'bank_master_id' => true,
        'branch_master_id' => true,
        'accountNo' => true,
        'hof' => true,
        'marital_status' => true,
        'disability_status' => true,
        'health_status' => true,
        'uidFlag' => true,
        'created' => true,
        'modified' => true,
        'created_by' => true,
        'modified_by' => true,
        'bfd1' => true,
        'bfd2' => true,
        'bfd3' => true,
        'dbtFlag' => true,
        'bso_remarks' => true,
        'dso_remarks' => true,
        'activity_flag' => true,
        'activities_status_id' => true,
        'activity_type_id' => true,
        'requested_mobile' => true,
        'ack_no_ercms' => true,
        'bso_uid' => true,
        'dso_uid' => true,
        'bso_modifiedDate' => true,
        'dso_modifiedDate' => true,
        'dep_modified' => true,
        'dep_remarks' => true,
        'requestedBy' => true,
        'secc_family' => true,
        'secc_cardholder' => true,
        'secc_cardholder_temp' => true,
        'relation' => true,
        'gender' => true,
        'bank_master' => true,
        'branch_master' => true,
        'activities_status' => true,
        'activity_type' => true,
    ];
}
