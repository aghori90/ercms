<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SeccFamilyDocumentAddTemps Model
 *
 * @property \App\Model\Table\SeccCardholderAddTempsTable&\Cake\ORM\Association\BelongsTo $SeccCardholderAddTemps
 * @property \App\Model\Table\SeccFamilyAddTempsTable&\Cake\ORM\Association\BelongsTo $SeccFamilyAddTemps
 *
 * @method \App\Model\Entity\SeccFamilyDocumentAddTemp get($primaryKey, $options = [])
 * @method \App\Model\Entity\SeccFamilyDocumentAddTemp newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SeccFamilyDocumentAddTemp[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SeccFamilyDocumentAddTemp|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SeccFamilyDocumentAddTemp saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SeccFamilyDocumentAddTemp patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SeccFamilyDocumentAddTemp[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SeccFamilyDocumentAddTemp findOrCreate($search, callable $callback = null, $options = [])
 */
class SeccFamilyDocumentAddTempsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('secc_family_document_add_temps');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('SeccCardholderAddTemps', [
            'foreignKey' => 'secc_cardholder_add_temp_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('SeccFamilyAddTemps', [
            'foreignKey' => 'secc_family_add_temp_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('DocumentTypes', [
            'foreignKey' => 'document_type_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->scalar('id')
            ->maxLength('id', 50)
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('document_type')
            ->maxLength('document_type', 50)
            ->allowEmptyString('document_type');

        $validator
            ->scalar('document_name')
            ->maxLength('document_name', 50)
            ->allowEmptyString('document_name');

     
        return $validator;
    }

   

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['secc_cardholder_add_temp_id'], 'SeccCardholderAddTemps'));
        $rules->add($rules->existsIn(['secc_family_add_temp_id'], 'SeccFamilyAddTemps'));

        return $rules;
    }
}
