<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * JsfssSeccCardholders Model
 *
 * @property \App\Model\Table\LocationsTable&\Cake\ORM\Association\BelongsTo $Locations
 * @property \App\Model\Table\CardtypesTable&\Cake\ORM\Association\BelongsTo $Cardtypes
 * @property \App\Model\Table\CastesTable&\Cake\ORM\Association\BelongsTo $Castes
 * @property \App\Model\Table\SeccDistrictsTable&\Cake\ORM\Association\BelongsTo $SeccDistricts
 * @property \App\Model\Table\SeccBlocksTable&\Cake\ORM\Association\BelongsTo $SeccBlocks
 * @property \App\Model\Table\PanchayatsTable&\Cake\ORM\Association\BelongsTo $Panchayats
 * @property \App\Model\Table\SeccVillageWardsTable&\Cake\ORM\Association\BelongsTo $SeccVillageWards
 * @property \App\Model\Table\DealersTable&\Cake\ORM\Association\BelongsTo $Dealers
 * @property \App\Model\Table\ApplicationTypeRulesTable&\Cake\ORM\Association\BelongsTo $ApplicationTypeRules
 * @property \App\Model\Table\DeleteReasonsTable&\Cake\ORM\Association\BelongsTo $DeleteReasons
 * @property \App\Model\Table\JsfssSeccFamiliesTable&\Cake\ORM\Association\HasMany $JsfssSeccFamilies
 *
 * @method \App\Model\Entity\JsfssSeccCardholder get($primaryKey, $options = [])
 * @method \App\Model\Entity\JsfssSeccCardholder newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\JsfssSeccCardholder[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\JsfssSeccCardholder|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\JsfssSeccCardholder saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\JsfssSeccCardholder patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\JsfssSeccCardholder[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\JsfssSeccCardholder findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class JsfssSeccCardholdersTable extends Table
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

        $this->setTable('jsfss_secc_cardholders');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Locations', [
            'foreignKey' => 'location_id',
        ]);
        $this->belongsTo('Cardtypes', [
            'foreignKey' => 'cardtype_id',
        ]);
        $this->belongsTo('Castes', [
            'foreignKey' => 'caste_id',
        ]);
        $this->belongsTo('SeccDistricts', [
            'foreignKey' => 'secc_district_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('SeccBlocks', [
            'foreignKey' => 'secc_block_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Panchayats', [
            'foreignKey' => 'panchayat_id',
        ]);
        $this->belongsTo('SeccVillageWards', [
            'foreignKey' => 'secc_village_ward_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Dealers', [
            'foreignKey' => 'dealer_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('ApplicationTypeRules', [
            'foreignKey' => 'applicationType_rule_id',
        ]);
        $this->belongsTo('DeleteReasons', [
            'foreignKey' => 'delete_reason_id',
        ]);
        $this->hasMany('JsfssSeccFamilies', [
            'foreignKey' => 'jsfss_secc_cardholder_id',
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
            ->notEmptyString('rationcard_no')
            ->add('rationcard_no', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('impdsRationcard')
            ->maxLength('impdsRationcard', 12)
            ->allowEmptyString('impdsRationcard');

        $validator
            ->scalar('name')
            ->maxLength('name', 100)
            ->allowEmptyString('name');

        $validator
            ->scalar('name_sl')
            ->maxLength('name_sl', 100)
            ->allowEmptyString('name_sl');

        $validator
            ->scalar('fathername')
            ->maxLength('fathername', 100)
            ->allowEmptyString('fathername');

        $validator
            ->scalar('fathername_sl')
            ->maxLength('fathername_sl', 100)
            ->allowEmptyString('fathername_sl');

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
            ->requirePresence('applicationType', 'create')
            ->notEmptyString('applicationType');

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
            ->integer('maxFamilySlNo')
            ->allowEmptyString('maxFamilySlNo');

        $validator
            ->dateTime('verified')
            ->allowEmptyDateTime('verified');

        $validator
            ->integer('created_by')
            ->requirePresence('created_by', 'create')
            ->notEmptyString('created_by');

        $validator
            ->integer('modified_by')
            ->requirePresence('modified_by', 'create')
            ->notEmptyString('modified_by');

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
            ->integer('pfmsFlag')
            ->allowEmptyString('pfmsFlag');

        $validator
            ->integer('old_alone')
            ->requirePresence('old_alone', 'create')
            ->notEmptyString('old_alone');

        $validator
            ->integer('pfmsKoilFlag')
            ->allowEmptyString('pfmsKoilFlag');

        $validator
            ->dateTime('lastLiftedRation')
            ->allowEmptyDateTime('lastLiftedRation');

        $validator
            ->integer('active_inactive')
            ->allowEmptyString('active_inactive');

        $validator
            ->integer('non_gov')
            ->requirePresence('non_gov', 'create')
            ->notEmptyString('non_gov');

        $validator
            ->integer('above_sixty')
            ->requirePresence('above_sixty', 'create')
            ->notEmptyString('above_sixty');

        $validator
            ->integer('marital_status')
            ->requirePresence('marital_status', 'create')
            ->notEmptyString('marital_status');

        $validator
            ->integer('disability_status')
            ->requirePresence('disability_status', 'create')
            ->notEmptyString('disability_status');

        $validator
            ->integer('health_status')
            ->requirePresence('health_status', 'create')
            ->notEmptyString('health_status');

        $validator
            ->integer('beggar')
            ->requirePresence('beggar', 'create')
            ->notEmptyString('beggar');

        $validator
            ->integer('rag_picker')
            ->requirePresence('rag_picker', 'create')
            ->notEmptyString('rag_picker');

        $validator
            ->integer('worker')
            ->requirePresence('worker', 'create')
            ->notEmptyString('worker');

        $validator
            ->integer('street_vendor')
            ->requirePresence('street_vendor', 'create')
            ->notEmptyString('street_vendor');

        $validator
            ->integer('pvtg')
            ->requirePresence('pvtg', 'create')
            ->notEmptyString('pvtg');

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
        $rules->add($rules->isUnique(['rationcard_no']));
        $rules->add($rules->existsIn(['location_id'], 'Locations'));
        $rules->add($rules->existsIn(['cardtype_id'], 'Cardtypes'));
        $rules->add($rules->existsIn(['caste_id'], 'Castes'));
        $rules->add($rules->existsIn(['secc_district_id'], 'SeccDistricts'));
        $rules->add($rules->existsIn(['secc_block_id'], 'SeccBlocks'));
        $rules->add($rules->existsIn(['panchayat_id'], 'Panchayats'));
        $rules->add($rules->existsIn(['secc_village_ward_id'], 'SeccVillageWards'));
        $rules->add($rules->existsIn(['dealer_id'], 'Dealers'));
        $rules->add($rules->existsIn(['applicationType_rule_id'], 'ApplicationTypeRules'));
        $rules->add($rules->existsIn(['delete_reason_id'], 'DeleteReasons'));

        return $rules;
    }
}
