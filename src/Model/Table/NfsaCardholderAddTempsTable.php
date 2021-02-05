<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * NfsaCardholderAddTemps Model
 *
 * @property \App\Model\Table\NfsaCardholdersTable&\Cake\ORM\Association\BelongsTo $NfsaCardholders
 * @property \App\Model\Table\LocationsTable&\Cake\ORM\Association\BelongsTo $Locations
 * @property \App\Model\Table\CardtypesTable&\Cake\ORM\Association\BelongsTo $Cardtypes
 * @property \App\Model\Table\CastesTable&\Cake\ORM\Association\BelongsTo $Castes
 * @property \App\Model\Table\SeccDistrictsTable&\Cake\ORM\Association\BelongsTo $SeccDistricts
 * @property \App\Model\Table\SeccBlocksTable&\Cake\ORM\Association\BelongsTo $SeccBlocks
 * @property \App\Model\Table\PanchayatsTable&\Cake\ORM\Association\BelongsTo $Panchayats
 * @property \App\Model\Table\SeccVillageWardsTable&\Cake\ORM\Association\BelongsTo $SeccVillageWards
 * @property \App\Model\Table\DealersTable&\Cake\ORM\Association\BelongsTo $Dealers
 * @property \App\Model\Table\BankMastersTable&\Cake\ORM\Association\BelongsTo $BankMasters
 * @property \App\Model\Table\BranchMastersTable&\Cake\ORM\Association\BelongsTo $BranchMasters
 * @property \App\Model\Table\ApplicationTypeRulesTable&\Cake\ORM\Association\BelongsTo $ApplicationTypeRules
 * @property \App\Model\Table\ActivityTypesTable&\Cake\ORM\Association\BelongsTo $ActivityTypes
 * @property \App\Model\Table\ActivitiesStatusesTable&\Cake\ORM\Association\BelongsTo $ActivitiesStatuses
 * @property \App\Model\Table\NfsaFamilyAddTempsTable&\Cake\ORM\Association\HasMany $NfsaFamilyAddTemps
 *
 * @method \App\Model\Entity\NfsaCardholderAddTemp get($primaryKey, $options = [])
 * @method \App\Model\Entity\NfsaCardholderAddTemp newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\NfsaCardholderAddTemp[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\NfsaCardholderAddTemp|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\NfsaCardholderAddTemp saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\NfsaCardholderAddTemp patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\NfsaCardholderAddTemp[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\NfsaCardholderAddTemp findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class NfsaCardholderAddTempsTable extends Table
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

        $this->setTable('nfsa_cardholder_add_temps');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('NfsaCardholders', [
            'foreignKey' => 'nfsa_cardholder_id',
        ]);
        $this->belongsTo('Locations', [
            'foreignKey' => 'location_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Cardtypes', [
            'foreignKey' => 'cardtype_id',
        ]);
        $this->belongsTo('Castes', [
            'foreignKey' => 'caste_id',
        ]);
        $this->belongsTo('SeccDistricts', [
            'foreignKey' => 'secc_district_id',
        ]);
        $this->belongsTo('SeccBlocks', [
            'foreignKey' => 'secc_block_id',
        ]);
        $this->belongsTo('Panchayats', [
            'foreignKey' => 'panchayat_id',
        ]);
        $this->belongsTo('SeccVillageWards', [
            'foreignKey' => 'secc_village_ward_id',
        ]);
        $this->belongsTo('Dealers', [
            'foreignKey' => 'dealer_id',
        ]);
        $this->belongsTo('BankMasters', [
            'foreignKey' => 'bank_master_id',
        ]);
        $this->belongsTo('BranchMasters', [
            'foreignKey' => 'branch_master_id',
        ]);
        $this->belongsTo('ApplicationTypeRules', [
            'foreignKey' => 'applicationType_rule_id',
        ]);
        $this->belongsTo('ActivityTypes', [
            'foreignKey' => 'activity_type_id',
        ]);
        $this->belongsTo('ActivitiesStatuses', [
            'foreignKey' => 'activities_status_id',
        ]);
        $this->hasMany('NfsaFamilyAddTemps', [
            'foreignKey' => 'nfsa_cardholder_add_temp_id',
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
            ->scalar('ack_no')
            ->maxLength('ack_no', 11)
            ->allowEmptyString('ack_no');

        $validator
            ->scalar('mobileno')
            ->maxLength('mobileno', 10)
            ->allowEmptyString('mobileno');

        $validator
            ->scalar('uid')
            ->maxLength('uid', 12)
            ->allowEmptyString('uid');

        $validator
            ->scalar('rationcard_no')
            ->maxLength('rationcard_no', 12)
            ->allowEmptyString('rationcard_no');

        $validator
            ->scalar('name')
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('name_sl')
            ->maxLength('name_sl', 100)
            ->requirePresence('name_sl', 'create')
            ->notEmptyString('name_sl');

        $validator
            ->scalar('fathername')
            ->maxLength('fathername', 100)
            ->requirePresence('fathername', 'create')
            ->notEmptyString('fathername');

        $validator
            ->scalar('fathername_sl')
            ->maxLength('fathername_sl', 100)
            ->requirePresence('fathername_sl', 'create')
            ->notEmptyString('fathername_sl');

        $validator
            ->scalar('mothername')
            ->maxLength('mothername', 100)
            ->allowEmptyString('mothername');

        $validator
            ->scalar('mothername_sl')
            ->maxLength('mothername_sl', 100)
            ->allowEmptyString('mothername_sl');

        $validator
            ->scalar('rgi_district_code')
            ->maxLength('rgi_district_code', 3)
            ->requirePresence('rgi_district_code', 'create')
            ->notEmptyString('rgi_district_code');

        $validator
            ->scalar('rgi_block_code')
            ->maxLength('rgi_block_code', 6)
            ->requirePresence('rgi_block_code', 'create')
            ->notEmptyString('rgi_block_code');

        $validator
            ->scalar('rgi_village_code')
            ->maxLength('rgi_village_code', 10)
            ->requirePresence('rgi_village_code', 'create')
            ->notEmptyString('rgi_village_code');

        $validator
            ->scalar('res_address')
            ->maxLength('res_address', 100)
            ->allowEmptyString('res_address');

        $validator
            ->scalar('res_address_hn')
            ->maxLength('res_address_hn', 200)
            ->allowEmptyString('res_address_hn');

        $validator
            ->scalar('tolla_mohalla')
            ->maxLength('tolla_mohalla', 50)
            ->allowEmptyString('tolla_mohalla');

        $validator
            ->scalar('qtr_plot_no')
            ->maxLength('qtr_plot_no', 50)
            ->allowEmptyString('qtr_plot_no');

        $validator
            ->scalar('holding_no')
            ->maxLength('holding_no', 50)
            ->allowEmptyString('holding_no');

        $validator
            ->allowEmptyString('is_lpg');

        $validator
            ->boolean('lpg_company')
            ->allowEmptyString('lpg_company');

        $validator
            ->scalar('lpg_consumer_no')
            ->maxLength('lpg_consumer_no', 50)
            ->allowEmptyString('lpg_consumer_no');

        $validator
            ->allowEmptyString('is_bank');

        $validator
            ->scalar('bank_account_no')
            ->maxLength('bank_account_no', 50)
            ->allowEmptyString('bank_account_no');

        $validator
            ->scalar('bank_ifsc_code')
            ->maxLength('bank_ifsc_code', 50)
            ->allowEmptyString('bank_ifsc_code');

        $validator
            ->scalar('status')
            ->maxLength('status', 1)
            ->allowEmptyString('status');

        $validator
            ->integer('family_count')
            ->allowEmptyString('family_count');

        $validator
            ->integer('mobile_count')
            ->allowEmptyString('mobile_count');

        $validator
            ->integer('uid_count')
            ->allowEmptyString('uid_count');

        $validator
            ->integer('printFlag')
            ->allowEmptyString('printFlag');

        $validator
            ->integer('applicationType')
            ->allowEmptyString('applicationType');

        $validator
            ->integer('occupationId')
            ->allowEmptyString('occupationId');

        $validator
            ->integer('activity_flag')
            ->allowEmptyString('activity_flag');

        $validator
            ->integer('activityFlag')
            ->allowEmptyString('activityFlag');

        $validator
            ->integer('activityType')
            ->allowEmptyString('activityType');

        $validator
            ->integer('dbtFlag')
            ->allowEmptyString('dbtFlag');

        $validator
            ->integer('liftedCount')
            ->allowEmptyString('liftedCount');

        $validator
            ->dateTime('verified')
            ->allowEmptyDateTime('verified');

        $validator
            ->integer('created_by')
            ->allowEmptyString('created_by');

        $validator
            ->integer('modified_by')
            ->allowEmptyString('modified_by');

        $validator
            ->integer('verified_by')
            ->allowEmptyString('verified_by');

        $validator
            ->integer('printed_by')
            ->allowEmptyString('printed_by');

        $validator
            ->integer('subsidyMonth')
            ->allowEmptyString('subsidyMonth');

        $validator
            ->scalar('remarks')
            ->maxLength('remarks', 100)
            ->allowEmptyString('remarks');

        $validator
            ->integer('priority_marks')
            ->allowEmptyString('priority_marks');

        $validator
            ->scalar('bso_remarks')
            ->maxLength('bso_remarks', 200)
            ->allowEmptyString('bso_remarks');

        $validator
            ->scalar('dso_remarks')
            ->maxLength('dso_remarks', 200)
            ->allowEmptyString('dso_remarks');

        $validator
            ->scalar('requested_mobile')
            ->maxLength('requested_mobile', 10)
            ->allowEmptyString('requested_mobile');

        $validator
            ->integer('requestedBy')
            ->allowEmptyString('requestedBy');

        $validator
            ->scalar('bso_uid')
            ->maxLength('bso_uid', 12)
            ->allowEmptyString('bso_uid');

        $validator
            ->scalar('dso_uid')
            ->maxLength('dso_uid', 12)
            ->allowEmptyString('dso_uid');

        $validator
            ->dateTime('bso_modifiedDate')
            ->allowEmptyDateTime('bso_modifiedDate');

        $validator
            ->dateTime('dso_modifiedDate')
            ->allowEmptyDateTime('dso_modifiedDate');

        $validator
            ->dateTime('dep_modified')
            ->allowEmptyDateTime('dep_modified');

        $validator
            ->scalar('dep_remarks')
            ->maxLength('dep_remarks', 200)
            ->allowEmptyString('dep_remarks');

        $validator
            ->integer('flag')
            ->allowEmptyString('flag');

        $validator
            ->allowEmptyString('application_status');

        $validator
            ->integer('old_alone')
            ->allowEmptyString('old_alone');

        $validator
            ->integer('non_gov')
            ->allowEmptyString('non_gov');

        $validator
            ->integer('above_sixty')
            ->allowEmptyString('above_sixty');

        $validator
            ->integer('marital_status')
            ->allowEmptyString('marital_status');

        $validator
            ->integer('disability_status')
            ->allowEmptyString('disability_status');

        $validator
            ->integer('health_status')
            ->allowEmptyString('health_status');

        $validator
            ->integer('beggar')
            ->allowEmptyString('beggar');

        $validator
            ->integer('rag_picker')
            ->allowEmptyString('rag_picker');

        $validator
            ->integer('worker')
            ->allowEmptyString('worker');

        $validator
            ->integer('street_vendor')
            ->allowEmptyString('street_vendor');

        $validator
            ->integer('pvtg')
            ->allowEmptyString('pvtg');

        $validator
            ->integer('secc_cardholder_add_tempscol')
            ->allowEmptyString('secc_cardholder_add_tempscol');

        return $validator;
    }






 public function validationDocument(Validator $validator)
    {
        $validator
			->requirePresence('document', 'create')
           	->notEmptyString('document')
			//->allowEmptyString('aadhar_doc', 'create')
			->add('document', [
				'uploadError' => [
					'rule' => 'uploadError',
					'message' => __('The document upload failed.'),
					'on' => function ($context)
					{
					    return !empty($context['data']['document']);
					}
				],
				'extension' => [
					'rule' => ['extension', ['jpg', 'jpeg', 'png']], // default  ['gif', 'jpeg', 'png', 'jpg']
					'message' => __('Only jpg/jpeg/png files are allowed.'),
					'on' => function ($context)
					{
					    return !empty($context['data']['document']);
					}
				],
				'mimeType' => [
					'rule' => ['mimeType', ['image/png', 'image/jpg', 'image/jpeg']],
					'message' => __('File Type must be image type.'),
					'on' => function ($context)
					{
					    return !empty($context['data']['document']);
					}
				],
				'fileSize' => [
					'rule' => ['fileSize', '<=', '500KB'],
					'message' => __('File must be less than 500KB.'),
					'on' => function ($context)
					{
					    return !empty($context['data']['document']);
					}
				]
			]);
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
        $rules->add($rules->existsIn(['nfsa_cardholder_id'], 'NfsaCardholders'));
        $rules->add($rules->existsIn(['location_id'], 'Locations'));
        $rules->add($rules->existsIn(['cardtype_id'], 'Cardtypes'));
        $rules->add($rules->existsIn(['caste_id'], 'Castes'));
        $rules->add($rules->existsIn(['secc_district_id'], 'SeccDistricts'));
        $rules->add($rules->existsIn(['secc_block_id'], 'SeccBlocks'));
        $rules->add($rules->existsIn(['panchayat_id'], 'Panchayats'));
        $rules->add($rules->existsIn(['secc_village_ward_id'], 'SeccVillageWards'));
        $rules->add($rules->existsIn(['dealer_id'], 'Dealers'));
        $rules->add($rules->existsIn(['bank_master_id'], 'BankMasters'));
        $rules->add($rules->existsIn(['branch_master_id'], 'BranchMasters'));
        $rules->add($rules->existsIn(['applicationType_rule_id'], 'ApplicationTypeRules'));
        $rules->add($rules->existsIn(['activity_type_id'], 'ActivityTypes'));
        $rules->add($rules->existsIn(['activities_status_id'], 'ActivitiesStatuses'));

        return $rules;
    }
}
