<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * NfsaFamilyDocumentTemps Model
 *
 * @property \App\Model\Table\NfsaCardholderTempsTable&\Cake\ORM\Association\BelongsTo $NfsaCardholderTemps
 * @property \App\Model\Table\NfsaFamilyTempsTable&\Cake\ORM\Association\BelongsTo $NfsaFamilyTemps
 * @property \App\Model\Table\DocumentTypesTable&\Cake\ORM\Association\BelongsTo $DocumentTypes
 *
 * @method \App\Model\Entity\NfsaFamilyDocumentTemp get($primaryKey, $options = [])
 * @method \App\Model\Entity\NfsaFamilyDocumentTemp newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\NfsaFamilyDocumentTemp[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\NfsaFamilyDocumentTemp|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\NfsaFamilyDocumentTemp saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\NfsaFamilyDocumentTemp patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\NfsaFamilyDocumentTemp[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\NfsaFamilyDocumentTemp findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class NfsaFamilyDocumentTempsTable extends Table
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

        $this->setTable('nfsa_family_document_temps');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('NfsaCardholderTemps', [
            'foreignKey' => 'nfsa_cardholder_temp_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('NfsaFamilyTemps', [
            'foreignKey' => 'nfsa_family_temp_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('DocumentTypes', [
            'foreignKey' => 'document_type_id',
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
            ->uuid('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('document')
            ->maxLength('document', 50)
            ->requirePresence('document', 'create')
            ->notEmptyString('document');

        $validator
            ->notEmptyString('status');

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
        $rules->add($rules->existsIn(['nfsa_cardholder_temp_id'], 'NfsaCardholderTemps'));
        $rules->add($rules->existsIn(['nfsa_family_temp_id'], 'NfsaFamilyTemps'));
        $rules->add($rules->existsIn(['document_type_id'], 'DocumentTypes'));

        return $rules;
    }
}
