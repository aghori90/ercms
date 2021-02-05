<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * NfsaFamilyAddTemps Model
 *
 * @property \App\Model\Table\NfsaSeccFamiliesTable&\Cake\ORM\Association\BelongsTo $NfsaSeccFamilies
 * @property \App\Model\Table\NfsaCardholdersTable&\Cake\ORM\Association\BelongsTo $NfsaCardholders
 * @property \App\Model\Table\NfsaCardholderAddTempsTable&\Cake\ORM\Association\BelongsTo $NfsaCardholderAddTemps
 * @property \App\Model\Table\RelationsTable&\Cake\ORM\Association\BelongsTo $Relations
 * @property \App\Model\Table\GendersTable&\Cake\ORM\Association\BelongsTo $Genders
 * @property \App\Model\Table\BankMastersTable&\Cake\ORM\Association\BelongsTo $BankMasters
 * @property \App\Model\Table\BranchMastersTable&\Cake\ORM\Association\BelongsTo $BranchMasters
 * @property \App\Model\Table\ActivitiesStatusesTable&\Cake\ORM\Association\BelongsTo $ActivitiesStatuses
 * @property \App\Model\Table\ActivityTypesTable&\Cake\ORM\Association\BelongsTo $ActivityTypes
 *
 * @method \App\Model\Entity\NfsaFamilyAddTemp get($primaryKey, $options = [])
 * @method \App\Model\Entity\NfsaFamilyAddTemp newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\NfsaFamilyAddTemp[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\NfsaFamilyAddTemp|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\NfsaFamilyAddTemp saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\NfsaFamilyAddTemp patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\NfsaFamilyAddTemp[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\NfsaFamilyAddTemp findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class NfsaFamilyAddTempsTable extends Table
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

        $this->setTable('nfsa_family_add_temps');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('NfsaSeccFamilies', [
            'foreignKey' => 'nfsa_secc_family_id',
        ]);
        $this->belongsTo('NfsaCardholders', [
            'foreignKey' => 'nfsa_cardholder_id',
        ]);
        $this->belongsTo('NfsaCardholderAddTemps', [
            'foreignKey' => 'nfsa_cardholder_add_temp_id',
        ]);
        $this->belongsTo('Relations', [
            'foreignKey' => 'relation_id',
        ]);
        $this->belongsTo('Genders', [
            'foreignKey' => 'gender_id',
        ]);
        $this->belongsTo('BankMasters', [
            'foreignKey' => 'bank_master_id',
        ]);
        $this->belongsTo('BranchMasters', [
            'foreignKey' => 'branch_master_id',
        ]);
        $this->belongsTo('ActivitiesStatuses', [
            'foreignKey' => 'activities_status_id',
        ]);
        $this->belongsTo('ActivityTypes', [
            'foreignKey' => 'activity_type_id',
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
            ->scalar('rationcard_no')
            ->maxLength('rationcard_no', 12)
            ->allowEmptyString('rationcard_no');

        $validator
            ->scalar('ahl_tin')
            ->maxLength('ahl_tin', 255)
            ->allowEmptyString('ahl_tin');

        $validator
            ->scalar('hhd_unique_no')
            ->maxLength('hhd_unique_no', 50)
            ->allowEmptyString('hhd_unique_no');

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
            ->scalar('relation_sl')
            ->maxLength('relation_sl', 100)
            ->allowEmptyString('relation_sl');

        $validator
            ->scalar('dob')
            ->maxLength('dob', 10)
            ->allowEmptyString('dob');

        $validator
            ->integer('freeze_status')
            ->allowEmptyString('freeze_status');

        $validator
            ->scalar('mobile')
            ->maxLength('mobile', 10)
            ->allowEmptyString('mobile');

        $validator
            ->scalar('uid')
            ->maxLength('uid', 12)
            ->allowEmptyString('uid');

        $validator
            ->scalar('uid_verified')
            ->maxLength('uid_verified', 2)
            ->allowEmptyString('uid_verified');

        $validator
            ->scalar('accountNo')
            ->maxLength('accountNo', 20)
            ->allowEmptyString('accountNo');

        $validator
            ->integer('hof')
            ->allowEmptyString('hof');

        $validator
            ->integer('disability_status')
            ->allowEmptyString('disability_status');

        $validator
            ->integer('marital_status')
            ->allowEmptyString('marital_status');

        $validator
            ->integer('health_status')
            ->allowEmptyString('health_status');

        $validator
            ->integer('uidFlag')
            ->allowEmptyString('uidFlag');

        $validator
            ->integer('created_by')
            ->allowEmptyString('created_by');

        $validator
            ->integer('modified_by')
            ->allowEmptyString('modified_by');

        $validator
            ->scalar('bfd1')
            ->maxLength('bfd1', 20)
            ->allowEmptyString('bfd1');

        $validator
            ->scalar('bfd2')
            ->maxLength('bfd2', 20)
            ->allowEmptyString('bfd2');

        $validator
            ->scalar('bfd3')
            ->maxLength('bfd3', 20)
            ->allowEmptyString('bfd3');

        $validator
            ->integer('dbtFlag')
            ->allowEmptyString('dbtFlag');

        $validator
            ->scalar('bso_remarks')
            ->maxLength('bso_remarks', 100)
            ->allowEmptyString('bso_remarks');

        $validator
            ->scalar('dso_remarks')
            ->maxLength('dso_remarks', 100)
            ->allowEmptyString('dso_remarks');

        $validator
            ->integer('activity_flag')
            ->allowEmptyString('activity_flag');

        $validator
            ->scalar('requested_mobile')
            ->maxLength('requested_mobile', 10)
            ->allowEmptyString('requested_mobile');

        $validator
            ->numeric('ack_no_ercms')
            ->allowEmptyString('ack_no_ercms');

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
            ->integer('requestedBy')
            ->allowEmptyString('requestedBy');

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
        $rules->add($rules->existsIn(['nfsa_secc_family_id'], 'NfsaSeccFamilies'));
        $rules->add($rules->existsIn(['nfsa_cardholder_id'], 'NfsaCardholders'));
        $rules->add($rules->existsIn(['nfsa_cardholder_add_temp_id'], 'NfsaCardholderAddTemps'));
        $rules->add($rules->existsIn(['relation_id'], 'Relations'));
        $rules->add($rules->existsIn(['gender_id'], 'Genders'));
        $rules->add($rules->existsIn(['bank_master_id'], 'BankMasters'));
        $rules->add($rules->existsIn(['branch_master_id'], 'BranchMasters'));
        $rules->add($rules->existsIn(['activities_status_id'], 'ActivitiesStatuses'));
        $rules->add($rules->existsIn(['activity_type_id'], 'ActivityTypes'));

        return $rules;
    }
}
