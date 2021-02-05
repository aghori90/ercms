<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * JsfssSeccFamilies Model
 *
 * @property \App\Model\Table\JsfssSeccCardholdersTable&\Cake\ORM\Association\BelongsTo $JsfssSeccCardholders
 * @property \App\Model\Table\RelationsTable&\Cake\ORM\Association\BelongsTo $Relations
 * @property \App\Model\Table\GendersTable&\Cake\ORM\Association\BelongsTo $Genders
 * @property \App\Model\Table\CardtypesTable&\Cake\ORM\Association\BelongsTo $Cardtypes
 * @property \App\Model\Table\BankMastersTable&\Cake\ORM\Association\BelongsTo $BankMasters
 * @property \App\Model\Table\BranchMastersTable&\Cake\ORM\Association\BelongsTo $BranchMasters
 * @property \App\Model\Table\DeleteReasonsTable&\Cake\ORM\Association\BelongsTo $DeleteReasons
 *
 * @method \App\Model\Entity\JsfssSeccFamily get($primaryKey, $options = [])
 * @method \App\Model\Entity\JsfssSeccFamily newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\JsfssSeccFamily[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\JsfssSeccFamily|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\JsfssSeccFamily saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\JsfssSeccFamily patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\JsfssSeccFamily[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\JsfssSeccFamily findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class JsfssSeccFamiliesTable extends Table
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

        $this->setTable('jsfss_secc_families');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('JsfssSeccCardholders', [
            'foreignKey' => 'jsfss_secc_cardholder_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Relations', [
            'foreignKey' => 'relation_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Genders', [
            'foreignKey' => 'gender_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Cardtypes', [
            'foreignKey' => 'cardtype_id',
        ]);
        $this->belongsTo('BankMasters', [
            'foreignKey' => 'bank_master_id',
        ]);
        $this->belongsTo('BranchMasters', [
            'foreignKey' => 'branch_master_id',
        ]);
        $this->belongsTo('DeleteReasons', [
            'foreignKey' => 'delete_reason_id',
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
            ->requirePresence('rationcard_no', 'create')
            ->notEmptyString('rationcard_no');

        $validator
            ->scalar('impdsRationcard')
            ->maxLength('impdsRationcard', 12)
            ->allowEmptyString('impdsRationcard');

        $validator
            ->scalar('impdsRationcardMemberId')
            ->maxLength('impdsRationcardMemberId', 15)
            ->allowEmptyString('impdsRationcardMemberId');

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
            ->requirePresence('dob', 'create')
            ->notEmptyString('dob');

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
            ->integer('nfsa_head')
            ->allowEmptyString('nfsa_head');

        $validator
            ->integer('uidFlag')
            ->allowEmptyString('uidFlag');

        $validator
            ->integer('created_by')
            ->allowEmptyString('created_by');

        $validator
            ->integer('modified_by')
            ->requirePresence('modified_by', 'create')
            ->notEmptyString('modified_by');

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
            ->scalar('pfmsRiceId')
            ->maxLength('pfmsRiceId', 25)
            ->allowEmptyString('pfmsRiceId');

        $validator
            ->scalar('pfmsKoilId')
            ->maxLength('pfmsKoilId', 25)
            ->allowEmptyString('pfmsKoilId');

        $validator
            ->integer('uidVaultFlag')
            ->allowEmptyString('uidVaultFlag');

        $validator
            ->scalar('maskUid')
            ->maxLength('maskUid', 12)
            ->allowEmptyString('maskUid');

        $validator
            ->integer('ekycFlag')
            ->allowEmptyString('ekycFlag');

        $validator
            ->integer('active_inactive')
            ->allowEmptyString('active_inactive');

        $validator
            ->dateTime('uidMobileChangeFlag')
            ->allowEmptyDateTime('uidMobileChangeFlag');

        $validator
            ->integer('disability_status')
            ->requirePresence('disability_status', 'create')
            ->notEmptyString('disability_status');

        $validator
            ->integer('health_status')
            ->requirePresence('health_status', 'create')
            ->notEmptyString('health_status');

        $validator
            ->integer('marital_status')
            ->requirePresence('marital_status', 'create')
            ->notEmptyString('marital_status');

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
        $rules->add($rules->existsIn(['jsfss_secc_cardholder_id'], 'JsfssSeccCardholders'));
        $rules->add($rules->existsIn(['relation_id'], 'Relations'));
        $rules->add($rules->existsIn(['gender_id'], 'Genders'));
        $rules->add($rules->existsIn(['cardtype_id'], 'Cardtypes'));
        $rules->add($rules->existsIn(['bank_master_id'], 'BankMasters'));
        $rules->add($rules->existsIn(['branch_master_id'], 'BranchMasters'));
        $rules->add($rules->existsIn(['delete_reason_id'], 'DeleteReasons'));

        return $rules;
    }
}
