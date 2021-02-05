<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SeccFamilyAddTemps Model
 *
 * @property \App\Model\Table\SeccFamiliesTable&\Cake\ORM\Association\BelongsTo $SeccFamilies
 * @property \App\Model\Table\SeccCardholdersTable&\Cake\ORM\Association\BelongsTo $SeccCardholders
 * @property \App\Model\Table\SeccCardholderTempsTable&\Cake\ORM\Association\BelongsTo $SeccCardholderTemps
 * @property \App\Model\Table\RelationsTable&\Cake\ORM\Association\BelongsTo $Relations
 * @property \App\Model\Table\GendersTable&\Cake\ORM\Association\BelongsTo $Genders
 * @property \App\Model\Table\BankMastersTable&\Cake\ORM\Association\BelongsTo $BankMasters
 * @property \App\Model\Table\BranchMastersTable&\Cake\ORM\Association\BelongsTo $BranchMasters
 * @property \App\Model\Table\ActivitiesStatusesTable&\Cake\ORM\Association\BelongsTo $ActivitiesStatuses
 * @property \App\Model\Table\ActivityTypesTable&\Cake\ORM\Association\BelongsTo $ActivityTypes
 *
 * @method \App\Model\Entity\SeccFamilyAddTemp get($primaryKey, $options = [])
 * @method \App\Model\Entity\SeccFamilyAddTemp newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SeccFamilyAddTemp[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SeccFamilyAddTemp|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SeccFamilyAddTemp saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SeccFamilyAddTemp patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SeccFamilyAddTemp[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SeccFamilyAddTemp findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SeccFamilyAddTempsTable extends Table
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

		$this->setTable('secc_family_add_temps');
		$this->setDisplayField('name');
		$this->setPrimaryKey('id');

		$this->addBehavior('Timestamp');

		$this->belongsTo('SeccFamilies', [
			'foreignKey' => 'secc_family_id',
		]);
		$this->belongsTo('SeccCardholders', [
			'foreignKey' => 'secc_cardholder_id',
			'joinType' => 'INNER',
		]);
		$this->belongsTo('SeccCardholderAddTemps', [
			'foreignKey' => 'secc_cardholder_add_temp_id',
		]);
		$this->hasMany('SeccFamilyDocumentAddTemps', [
			'foreignKey' => 'secc_family_add_temp_id',
		]);
		$this->belongsTo('Relations', [
			'foreignKey' => 'relation_id',
			'joinType' => 'LEFT',
		]);
		$this->belongsTo('Genders', [
			'foreignKey' => 'gender_id',
			'joinType' => 'LEFT',
		]);
		$this->belongsTo('BankMasters', [
			'foreignKey' => 'bank_master_id',
		]);
		$this->belongsTo('BranchMasters', [
			'foreignKey' => 'branch_master_id',
		]);
	}

	/**
	 * Removes all dangerous HTML tag
	 */
	/* public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options)
    {
        foreach ($data as $key => $cafein) {
            if (is_string($cafein)) {
                $data[$key] = trim(strip_tags($cafein));
            }
        }
    }*/

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
			->scalar('name')
			->maxLength('name', 100)
			->minLength('name', '3', 'Name need to be at least 3 characters long')
			->notEmptyString('name')
			->add('name', 'validFormat', [
				'rule' => array('custom', '/^[a-zA-Z ]*$/i'),
				'message' => 'Please enter only alphabets.'
			]);

			$validator
            ->scalar('uid')
            ->maxLength('uid', 12)
            ->minLength('uid', 12)
            ->notEmptyString('uid')
			->numeric( 'uid' , 'Please enter Aadhar No. in integers.' );
			

		$validator
			->scalar('name_sl')
			->maxLength('name_sl', 100)
			->minLength('name_sl', 3, 'Name need to be at least 3 characters long')
			->notEmptyString('name_sl');

		$validator
			->scalar('fathername')
			->maxLength('fathername', 100)
			->add('fathername', [
				'length' => [
					'rule' => ['minLength', 3],
					'message' => 'FatherName need to be at least 3 characters long',
				]
			])
			->notEmptyString('fathername')
			->add('fathername', 'validFormat', [
				'rule' => array('custom', '/^[a-zA-Z ]*$/i'),
				'message' => 'Please enter only alphabets.'
			]);

		$validator
			->scalar('fathername_sl')
			->maxLength('fathername_sl', 100)
			->add('fathername_sl', [
				'length' => [
					'rule' => ['minLength', 3],
					'message' => 'FatherName need to be at least 3 characters long',
				]
			])
			->notEmptyString('fathername_sl');

		$validator
			->scalar('gender_id')
			->maxLength('gender_id', 1)
			->add('gender_id', 'ValidGender', [
				'rule' => 'isValidGender',
				'message' => __('You need to provide a valid gender'),
				'provider' => 'table',
			])
			->requirePresence('gender_id')
			->notEmptyString('gender_id');

		$validator
			->scalar('relation_id')
			->maxLength('relation_id', 3)
			->notEmptyString('relation_id');

		$validator
			->scalar('dob')
			->date('dob', 'ymd')
			->requirePresence('dob', 'create')
			->notEmptyDate('dob')
			->lessThan('dob', date('Y-m-d', strtotime('-6 years')), 'Date of Birth should be greater than 6 yrs');

		$validator
            ->maxLength('mobile', 10, 'Mobile No need to be maximum 10 characters long.', !empty($context['data']['mobile']))
            ->minLength('mobile', 10, 'Mobile No need to be at least 10 characters long.', !empty($context['data']['mobile']))
            ->notEmptyString('mobile', 'This field is required', function ($context) {
                return !empty($context['data']['mobile']);
            })
            ->add('mobile', 'validFormat', [
                'rule' => array('custom', '/^([6789][0-9]{9})$/i'),
                'on' => function ($context) {
                    return !empty($context['data']['mobile']);
                },
                'message' => 'Please enter a valid mobile number.'
            ]);

		$validator
			->integer('marital_status')
			->requirePresence('marital_status', 'Please select marital status')
			->add('marital_status', 'ValidMaritalStatus', [
				'rule' => 'isValidMaritalStatus',
				'message' => __('You need to provide a valid marital status'),
				'provider' => 'table',
			]);

		$validator
			->integer('disability_status')
			->requirePresence('disability_status')
			->add('disability_status', 'ValidDisabilityStatus', [
				'rule' => 'isValidDisabilityStatus',
				'message' => __('You need to provide a valid disability status'),
				'provider' => 'table',
			]);

		$validator
			->integer('health_status')
			->requirePresence('health_status')
			->add('health_status', 'ValidHealthStatus', [
				'rule' => 'isValidHealthStatus',
				'message' => __('You need to provide a valid health status'),
				'provider' => 'table',
			]);

		$validator
			->requirePresence('aadhar_doc', 'create')
           	->notEmptyString('aadhar_doc')
			//->allowEmptyString('aadhar_doc', 'create')
			->add('aadhar_doc', [
				'uploadError' => [
					'rule' => 'uploadError',
					'message' => __('The document upload failed.'),
					'on' => function ($context) {
						return !empty($context['data']['aadhar_doc']);
					}
				],
				'extension' => [
					'rule' => ['extension', ['jpg', 'jpeg', 'png']], // default  ['gif', 'jpeg', 'png', 'jpg']
					'message' => __('Only jpg/jpeg/png files are allowed.'),
					'on' => function ($context) {
						return !empty($context['data']['aadhar_doc']);
					}
				],
				'mimeType' => [
					'rule' => ['mimeType', ['image/png', 'image/jpg', 'image/jpeg']],
					'message' => __('File Type must be image type.'),
					'on' => function ($context) {
						return !empty($context['data']['aadhar_doc']);
					}
				],
				'fileSize' => [
					'rule' => ['fileSize', '<=', '500KB'],
					'message' => __('File must be less than 500KB.'),
					'on' => function ($context) {
						return !empty($context['data']['aadhar_doc']);
					}

				]
			]);

		return $validator;
	}


	public function validationEditmember(Validator $validator)
	{
		$validator
			->uuid('id')
			->allowEmptyString('id', null, 'create');
			
 		$validator
            ->scalar('uid')
            ->maxLength('uid', 12)
            ->minLength('uid', 12)
            ->notEmptyString('uid')
			->numeric( 'uid' , 'Please enter Aadhar No. in integers.' );
			
		$validator
			->scalar('name')
			->maxLength('name', 100)
			->minLength('name', '3', 'Name need to be at least 3 characters long')
			->notEmptyString('name')
			->add('name', 'validFormat', [
				'rule' => array('custom', '/^[a-zA-Z ]*$/i'),
				'message' => 'Please enter only alphabets.'
			]);

		$validator
			->scalar('name_sl')
			->maxLength('name_sl', 100)
			->minLength('name_sl', 3, 'Name need to be at least 3 characters long')
			->notEmptyString('name_sl');

		$validator
			->scalar('fathername')
			->maxLength('fathername', 100)
			->add('fathername', [
				'length' => [
					'rule' => ['minLength', 3],
					'message' => 'FatherName need to be at least 3 characters long',
				]
			])
			->notEmptyString('fathername')
			->add('fathername', 'validFormat', [
				'rule' => array('custom', '/^[a-zA-Z ]*$/i'),
				'message' => 'Please enter only alphabets.'
			]);

		$validator
			->scalar('fathername_sl')
			->maxLength('fathername_sl', 100)
			->add('fathername_sl', [
				'length' => [
					'rule' => ['minLength', 3],
					'message' => 'FatherName need to be at least 3 characters long',
				]
			])
			->notEmptyString('fathername_sl');

		$validator
			->scalar('gender_id')
			->maxLength('gender_id', 1)
			->add('gender_id', 'ValidGender', [
				'rule' => 'isValidGender',
				'message' => __('You need to provide a valid gender'),
				'provider' => 'table',
			])
			->requirePresence('gender_id')
			->notEmptyString('gender_id');

		$validator
			->scalar('relation_id')
			->maxLength('relation_id', 3)
			->notEmptyString('relation_id');

		$validator
			->scalar('dob')
			->date('dob', 'ymd')
			->requirePresence('dob', 'create')
			->notEmptyDate('dob')
			->lessThan('dob', date('Y-m-d', strtotime('-6 years')), 'Date of Birth should be greater than 6 yrs');

		$validator
			->scalar('mobile')
			->maxLength('mobile', 10)
			->notEmptyString('mobile')
			->add('mobile', 'validFormat', [
				'rule' => array('custom', '/^([6789][0-9]{9})$/i'),
				'message' => 'Please enter a valid mobile number.'
			]);

		$validator
			->integer('marital_status')
			->requirePresence('marital_status', 'Please select marital status')
			->add('marital_status', 'ValidMaritalStatus', [
				'rule' => 'isValidMaritalStatus',
				'message' => __('You need to provide a valid marital status'),
				'provider' => 'table',
			]);

		$validator
			->integer('disability_status')
			->requirePresence('disability_status')
			->add('disability_status', 'ValidDisabilityStatus', [
				'rule' => 'isValidDisabilityStatus',
				'message' => __('You need to provide a valid disability status'),
				'provider' => 'table',
			]);

		$validator
			->integer('health_status')
			->requirePresence('health_status')
			->add('health_status', 'ValidHealthStatus', [
				'rule' => 'isValidHealthStatus',
				'message' => __('You need to provide a valid health status'),
				'provider' => 'table',
			]);

		$validator
			//->requirePresence('aadhar_doc', 'create')
           	//->notEmptyString('aadhar_doc')
			->allowEmptyString('aadhar_doc', 'update')
			->add('aadhar_doc', [
				'uploadError' => [
					'rule' => 'uploadError',
					'message' => __('The document upload failed.'),
					'on' => function ($context) {
						return !empty($context['data']['aadhar_doc']);
					}
				],
				'extension' => [
					'rule' => ['extension', ['jpg', 'jpeg', 'png']], // default  ['gif', 'jpeg', 'png', 'jpg']
					'message' => __('Only jpg/jpeg/png files are allowed.'),
					'on' => function ($context) {
						return !empty($context['data']['aadhar_doc']);
					}
				],
				'mimeType' => [
					'rule' => ['mimeType', ['image/png', 'image/jpg', 'image/jpeg']],
					'message' => __('File Type must be image type.'),
					'on' => function ($context) {
						return !empty($context['data']['aadhar_doc']);
					}
				],
				'fileSize' => [
					'rule' => ['fileSize', '<=', '500KB'],
					'message' => __('File must be less than 500KB.'),
					'on' => function ($context) {
						return !empty($context['data']['aadhar_doc']);
					}

				]
			]);

		return $validator;
	}


	public function validationChangeMobile(Validator $validator)
	{
		$validator
			->uuid('id')
			->allowEmptyString('id', null, 'create');

		$validator
			->scalar('name')
			->maxLength('name', 100)
			->minLength('name', '3', 'Name need to be at least 3 characters long')
			->notEmptyString('name')
			->add('name', 'validFormat', [
				'rule' => array('custom', '/^[a-zA-Z ]*$/i'),
				'message' => 'Please enter only alphabets.'
			]);

		$validator
			->scalar('name_sl')
			->maxLength('name_sl', 100)
			->minLength('name_sl', 3, 'Name need to be at least 3 characters long')
			->notEmptyString('name_sl');

		$validator
			->scalar('fathername')
			->maxLength('fathername', 100)
			->add('fathername', [
				'length' => [
					'rule' => ['minLength', 3],
					'message' => 'FatherName need to be at least 3 characters long',
				]
			])
			->notEmptyString('fathername')
			->add('fathername', 'validFormat', [
				'rule' => array('custom', '/^[a-zA-Z ]*$/i'),
				'message' => 'Please enter only alphabets.'
			]);

		$validator
			->scalar('fathername_sl')
			->maxLength('fathername_sl', 100)
			->add('fathername_sl', [
				'length' => [
					'rule' => ['minLength', 3],
					'message' => 'FatherName need to be at least 3 characters long',
				]
			])
			->notEmptyString('fathername_sl');

		$validator
			->scalar('gender_id')
			->maxLength('gender_id', 1)
			->add('gender_id', 'ValidGender', [
				'rule' => 'isValidGender',
				'message' => __('You need to provide a valid gender'),
				'provider' => 'table',
			])
			->requirePresence('gender_id')
			->notEmptyString('gender_id');

		$validator
			->scalar('relation_id')
			->maxLength('relation_id', 3)
			->notEmptyString('relation_id');

		$validator
			->scalar('mobile')
			->maxLength('mobile', 10)
			->notEmptyString('mobile')
			->add('mobile', 'validFormat', [
				'rule' => array('custom', '/^([6789][0-9]{9})$/i'),
				'message' => 'Please enter a valid mobile number.'
			]);

		return $validator;
	}

	public function isValidGender($value, array $context)
	{
		return in_array($value, ['1', '2', '3']);
	}

	public function isValidMaritalStatus($value, array $context)
	{
		return in_array($value, ['1', '2', '3', '4'], true);
	}
	public function isValidHealthStatus($value, array $context)
	{
		return in_array($value, ['0', '1', '2'], true);
	}
	public function isValidDisabilityStatus($value, array $context)
	{
		return in_array($value, ['1', '0'], true);
	}


	public function age($value, $context)
	{
		if (empty($context['data']['title'])) {
			return false;
		} else {
			return true;
		}
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
		//$rules->add($rules->existsIn(['secc_cardholder_id'], 'SeccCardholders'));
		$rules->add($rules->existsIn(['secc_cardholder_add_temp_id'], 'SeccCardholderAddTemps'));
		//$rules->add($rules->existsIn(['relation_id'], 'Relations'));
		$rules->add($rules->existsIn(['gender_id'], 'Genders'));
		//$rules->add($rules->validCount('secc_cardholder_add_temp_id', 11, '=', 'You can add maximum 10 family members.'));
		// $rules->add($rules->isUnique(
		// 	['uid'],
		// 	'This Aadhar Number already exists.'
		// ));


		return $rules;
	}
}
