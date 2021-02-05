<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * JsfssDistrictReport Entity
 *
 * @property int $id
 * @property string|null $rgi_district_code
 * @property string|null $districtName
 * @property int|null $greenCardHeadCount
 * @property int|null $greenCardMemberCount
 */
class JsfssDistrictReport extends Entity
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
        'rgi_district_code' => true,
        'districtName' => true,
        'greenCardHeadCount' => true,
        'greenCardMemberCount' => true,
    ];
}
