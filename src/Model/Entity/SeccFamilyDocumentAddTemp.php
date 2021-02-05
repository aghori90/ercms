<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SeccFamilyDocumentAddTemp Entity
 *
 * @property string $id
 * @property string $secc_cardholder_add_temp_id
 * @property string $secc_family_add_temp_id
 * @property string|null $document_type_id
 * @property string $document
 * @property int $status
 *
 * @property \App\Model\Entity\SeccCardholderAddTemp $secc_cardholder_add_temp
 * @property \App\Model\Entity\SeccFamilyAddTemp $secc_family_add_temp
 */
class SeccFamilyDocumentAddTemp extends Entity
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
        'secc_cardholder_add_temp_id' => true,
        'secc_family_add_temp_id' => true,
        'document_type_id' => true,
        'document' => true,
        'status' => true,
        'secc_cardholder_add_temp' => true,
        'secc_family_add_temp' => true,
    ];
}
