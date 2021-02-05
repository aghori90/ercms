<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * NfsaFamilyDocumentTemp Entity
 *
 * @property string $id
 * @property string $nfsa_cardholder_temp_id
 * @property string $nfsa_family_temp_id
 * @property string|null $document_type_id
 * @property string $document
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $status
 *
 * @property \App\Model\Entity\NfsaCardholderTemp $nfsa_cardholder_temp
 * @property \App\Model\Entity\NfsaFamilyTemp $nfsa_family_temp
 * @property \App\Model\Entity\DocumentType $document_type
 */
class NfsaFamilyDocumentTemp extends Entity
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
        'nfsa_cardholder_temp_id' => true,
        'nfsa_family_temp_id' => true,
        'document_type_id' => true,
        'document' => true,
        'created' => true,
        'modified' => true,
        'status' => true,
        'nfsa_cardholder_temp' => true,
        'nfsa_family_temp' => true,
        'document_type' => true,
    ];
}
