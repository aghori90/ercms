<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * NfsaFamily Entity
 *
 * @property string $id
 * @property string $rationcard_no
 * @property string|null $impdsRationcard
 * @property string|null $impdsRationcardMemberId
 * @property string|null $ahl_tin
 * @property string|null $hhd_unique_no
 * @property string $nfsa_cardholder_id
 * @property string $nfsa_family_add_temp_id
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
 * @property int|null $cardtype_id
 * @property string $dob
 * @property int|null $freeze_status
 * @property string|null $mobile
 * @property string|null $uid
 * @property string|null $uid_verified
 * @property int|null $bank_master_id
 * @property int|null $branch_master_id
 * @property string|null $accountNo
 * @property int|null $hof
 * @property int|null $nfsa_head
 * @property int|null $uidFlag
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int|null $created_by
 * @property int|null $modified_by
 * @property string|null $bfd1
 * @property string|null $bfd2
 * @property string|null $bfd3
 * @property int|null $dbtFlag
 * @property string|null $pfmsRiceId
 * @property string|null $pfmsKoilId
 * @property int|null $uidVaultFlag
 * @property string|null $maskUid
 * @property int|null $ekycFlag
 * @property int|null $active_inactive
 * @property int|null $delete_reason_id
 * @property \Cake\I18n\FrozenTime|null $uidMobileChangeFlag
 * @property int $disability_status
 * @property int $health_status
 * @property int $marital_status
 *
 * @property \App\Model\Entity\NfsaCardholder $nfsa_cardholder
 * @property \App\Model\Entity\NfsaFamilyAddTemp $nfsa_family_add_temp
 * @property \App\Model\Entity\Relation $relation
 * @property \App\Model\Entity\Gender $gender
 * @property \App\Model\Entity\Cardtype $cardtype
 * @property \App\Model\Entity\BankMaster $bank_master
 * @property \App\Model\Entity\BranchMaster $branch_master
 * @property \App\Model\Entity\DeleteReason $delete_reason
 */
class NfsaFamily extends Entity
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
        'impdsRationcardMemberId' => true,
        'ahl_tin' => true,
        'hhd_unique_no' => true,
        'nfsa_cardholder_id' => true,
        'nfsa_family_add_temp_id' => true,
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
        'cardtype_id' => true,
        'dob' => true,
        'freeze_status' => true,
        'mobile' => true,
        'uid' => true,
        'uid_verified' => true,
        'bank_master_id' => true,
        'branch_master_id' => true,
        'accountNo' => true,
        'hof' => true,
        'nfsa_head' => true,
        'uidFlag' => true,
        'created' => true,
        'modified' => true,
        'created_by' => true,
        'modified_by' => true,
        'bfd1' => true,
        'bfd2' => true,
        'bfd3' => true,
        'dbtFlag' => true,
        'pfmsRiceId' => true,
        'pfmsKoilId' => true,
        'uidVaultFlag' => true,
        'maskUid' => true,
        'ekycFlag' => true,
        'active_inactive' => true,
        'delete_reason_id' => true,
        'uidMobileChangeFlag' => true,
        'disability_status' => true,
        'health_status' => true,
        'marital_status' => true,
        'nfsa_cardholder' => true,
        'nfsa_family_add_temp' => true,
        'relation' => true,
        'gender' => true,
        'cardtype' => true,
        'bank_master' => true,
        'branch_master' => true,
        'delete_reason' => true,
    ];
}
