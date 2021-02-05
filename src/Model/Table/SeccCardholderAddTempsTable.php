<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use ArrayObject;

/**
 * SeccCardholderAddTemps Model
 *
 * @property \App\Model\Table\SeccCardholdersTable&\Cake\ORM\Association\BelongsTo $SeccCardholders
 * @property \App\Model\Table\LocationsTable&\Cake\ORM\Association\BelongsTo $Locations
 * @property \App\Model\Table\CardtypesTable&\Cake\ORM\Association\BelongsTo $Cardtypes
 * @property \App\Model\Table\CastesTable&\Cake\ORM\Association\BelongsTo $Castes
 * @property \App\Model\Table\SeccDistrictsTable&\Cake\ORM\Association\BelongsTo $SeccDistricts
 * @property \App\Model\Table\SeccBlocksTable&\Cake\ORM\Association\BelongsTo $SeccBlocks
 * @property \App\Model\Table\PanchayatsTable&\Cake\ORM\Association\BelongsTo $Panchayats
 * @property \App\Model\Table\SeccVillageWardsTable&\Cake\ORM\Association\BelongsTo $SeccVillageWards
 * @property \App\Model\Table\DealersTable&\Cake\ORM\Association\BelongsTo $Dealers
 * @property \App\Model\Table\ActivityTypesTable&\Cake\ORM\Association\BelongsTo $ActivityTypes
 * @property \App\Model\Table\ActivitiesStatusesTable&\Cake\ORM\Association\BelongsTo $ActivitiesStatuses
 *
 * @method \App\Model\Entity\SeccCardholderAddTemp get($primaryKey, $options = [])
 * @method \App\Model\Entity\SeccCardholderAddTemp newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SeccCardholderAddTemp[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SeccCardholderAddTemp|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SeccCardholderAddTemp saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SeccCardholderAddTemp patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SeccCardholderAddTemp[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SeccCardholderAddTemp findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SeccCardholderAddTempsTable extends Table
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

        $this->setTable('secc_cardholder_add_temps');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('SeccCardholders', [
            'foreignKey' => 'secc_cardholder_id',
        ]);
        $this->belongsTo('Locations', [
            'foreignKey' => 'location_id',
            'joinType' => 'LEFT',
        ]);
        $this->belongsTo('Cardtypes', [
            'foreignKey' => 'cardtype_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Castes', [
            'foreignKey' => 'caste_id',
        ]);
        $this->belongsTo('SeccDistricts', [
            'foreignKey' => false,
            'joinType' => 'LEFT',
            'conditions' => array(
                'SeccCardholderAddTemps.rgi_district_code = SeccDistricts.rgi_district_code'
            ),
        ]);
        $this->belongsTo('SeccBlocks', [
            'foreignKey' => false,
            'joinType' => 'LEFT',
            'conditions' => array(
                'SeccCardholderAddTemps.rgi_block_code = SeccBlocks.rgi_block_code'
            ),
        ]);
        $this->belongsTo('Panchayats', [
            'foreignKey' => false,
            'joinType' => 'LEFT',
            'conditions' => array(
                'SeccCardholderAddTemps.panchayat_id = Panchayats.id'
            ),
        ]);
        $this->belongsTo('BankMasters', [
            'foreignKey' => 'bank_master_id',
            'joinType' => 'LEFT'
        ]);
        $this->belongsTo('BranchMasters', [
            'foreignKey' => 'branch_master_id',
            'joinType' => 'LEFT'
        ]);
        $this->belongsTo('Genders', [
            'foreignKey' => 'gender_id',
        ]);
        $this->belongsTo('SeccVillageWards', [
            'foreignKey' => false,
            'joinType' => 'LEFT',
            'conditions' => array(
                'SeccCardholderAddTemps.rgi_village_code = SeccVillageWards.rgi_village_code'
            ),
        ]);
        $this->belongsTo('Dealers', [
            'foreignKey' => 'dealer_id',
            'joinType' => 'LEFT',
        ]);
        $this->belongsTo('ActivityTypes', [
            'foreignKey' => 'activity_type_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('ActivitiesStatuses', [
            'foreignKey' => 'activities_status_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('SeccFamilyAddTemps', [
            'foreignKey' => 'secc_cardholder_add_temp_id',
        ]);
    }

    /**
     * Removes all dangerous HTML tag
     */
    public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options)
    {
        foreach ($data as $key => $cafein) {
            if (is_string($cafein)) {
                $data[$key] = trim(strip_tags($cafein));
            }
        }
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */

    

    public function validationChangeHof(Validator $validator)
    {
        $validator
            ->scalar('name')
            ->maxLength('name', 100)
            ->notEmptyString('name');

        $validator
            ->scalar('name_sl')
            ->maxLength('name_sl', 100)
            ->notEmptyString('name_sl');

        $validator
            ->scalar('fathername')
            ->maxLength('fathername', 100)
            ->notEmptyString('fathername');

        $validator
            ->scalar('fathername_sl')
            ->maxLength('fathername_sl', 100)
            ->notEmptyString('fathername_sl');

        $validator
            ->scalar('uid')
            ->maxLength('uid', 12)
            ->notEmptyString('uid');

        $validator
            ->scalar('mobileno')
            ->maxLength('mobileno', 10)
            ->notEmptyString('mobileno');

        $validator
            ->integer('rgi_district_code')
            ->requirePresence('rgi_district_code');

        $validator
            ->integer('rgi_block_code')
            ->requirePresence('rgi_block_code');

        $validator
            ->integer('rgi_village_code')
            ->requirePresence('rgi_village_code');

        $validator
            ->scalar('mothername')
            ->maxLength('mothername', 100)
            ->notEmptyString('mothername');

        $validator
            ->scalar('mothername_sl')
            ->maxLength('mothername_sl', 100)
            ->notEmptyString('mothername_sl');

        return $validator;
    }

    public function validationRegister(Validator $validator)
    {
        $validator
            ->scalar('name')
            ->maxLength('name', 100)
            ->add('name', [
                'length' => [
                    'rule' => ['minLength', 3],
                    'message' => 'Name need to be at least 3 characters long',
                ]
            ])
            ->notEmptyString('name')
            ->add('name', 'validFormat', [
                'rule' => array('custom', '/^[a-zA-Z ]*$/i'),
                'message' => 'Please enter only alphabets.'
            ]);

        $validator
            ->scalar('name_sl')
            ->maxLength('name_sl', 100)
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
            ->scalar('dob')
            ->date('dob', 'ymd')
            //->requirePresence('dob', 'create')
            ->notEmptyDate('dob')
            ->lessThan('dob', date('Y-m-d', strtotime('-18 years')), 'Date of Birth should be greater than 18 yrs');

        $validator
            ->scalar('uid')
            ->maxLength('uid', 12)
            ->minLength('uid', 12)
            ->notEmptyString('uid')
            ->numeric( 'uid' , 'Please enter Aadhar No. in integers.' );

        $validator
            ->scalar('mobileno')
            ->maxLength('mobileno', 10)
            ->minLength('mobileno', 10)
            ->notEmptyString('mobileno')
            ->add('mobileno', 'validFormat', [
                'rule' => array('custom', '/^([6789][0-9]{9})$/i'),
                'message' => 'Please enter a valid mobile number.'
            ]);
        $validator
            ->integer('rgi_district_code')
            ->requirePresence('rgi_district_code');

        $validator
            ->integer('rgi_block_code')
            ->requirePresence('rgi_block_code');

        $validator
            ->integer('rgi_village_code')
            ->requirePresence('rgi_village_code');

        return $validator;
    }

    public function validationPersonal(Validator $validator)
    {
        $validator
            //->scalar('mothername')
            ->allowEmptyString('mothername')
            ->maxLength('mothername', 100)
            ->minLength('mothername', 3, 'Mothername need to be at least 3 characters long.', !empty($context['data']['mothername']))
            /* ->add('mothername', [
                    'length' => [
                        'rule' => ['minLength', 3],
                        'message' => 'Mothername need to be at least 3 characters long',
                    ]
                ]) // You can also write in this way*/
            //->notEmptyString('mothername')
            ->add('mothername', 'validFormat', [
                'rule' => array('custom', '/^[a-zA-Z ]*$/i'),
                'message' => 'Please enter only alphabets.',
				'on' => function ($context) {
						return !empty($context['data']['mothername']);
					}
            ]);

        $validator
            //->scalar('mothername_sl')
            ->allowEmptyString('mothername_sl')
            ->maxLength('mothername_sl', 100)
            ->minLength('mothername_sl', 3, 'Mothername need to be at least 3 characters long.', !empty($context['data']['mothername_sl']));

        $validator
            ->integer('marital_status')
            ->requirePresence('marital_status','Please select marital status')
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
            ->scalar('caste_id')
            ->requirePresence('caste_id')
            ->add('caste_id', 'ValidCaste', [
                'rule' => 'isValidCaste',
                'message' => __('You need to provide a valid caste'),
                'provider' => 'table',
            ])
            ->notEmptyString('caste_id');

        $validator
            ->scalar('res_address')
            ->maxLength('res_address', 200)
            ->notEmptyString('res_address');

        $validator
            ->scalar('tolla_mohalla')
            ->maxLength('tolla_mohalla', 50)
            ->notEmptyString('tolla_mohalla');

        $validator
            ->scalar('occupationId')
            ->requirePresence('occupationId')
            ->add('occupationId', 'ValidOccupation', [
                'rule' => 'isValidOccupation',
                'message' => __('You need to provide a valid occupation'),
                'provider' => 'table',
            ]);   

        return $validator;
    }

    public function validationOpregister(Validator $validator)
    {
        //$validator = $this->validationRegister($validator);
        $validator
        ->scalar('name')
        ->maxLength('name', 100)
        ->add('name', [
            'length' => [
                'rule' => ['minLength', 3],
                'message' => 'Name need to be at least 3 characters long',
            ]
        ])
        ->notEmptyString('name')
        ->add('name', 'validFormat', [
            'rule' => array('custom', '/^[a-zA-Z ]*$/i'),
            'message' => 'Please enter only alphabets.'
        ]);

    $validator
        ->scalar('name_sl')
        ->maxLength('name_sl', 100)
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
            //->scalar('mothername')
            ->allowEmptyString('mothername')
            ->maxLength('mothername', 100, 'Mothername can be maximum 100 characters long.', !empty($context['data']['mothername']))
            ->minLength('mothername', 3, 'Mothername need to be at least 3 characters long.', !empty($context['data']['mothername']))
            /* ->add('mothername', [
                    'length' => [
                        'rule' => ['minLength', 3],
                        'message' => 'Mothername need to be at least 3 characters long',
                    ]
                ]) // You can also write in this way*/
           // ->notEmptyString('mothername')
            ->add('mothername', 'validFormat', [
                'rule' => array('custom', '/^[a-zA-Z ]*$/i'),
                'message' => 'Please enter only alphabets.',
				'on' => function ($context) {
						return !empty($context['data']['mothername']);
					}
            ]);

        $validator
            //->scalar('mothername_sl')
            ->allowEmptyString('mothername_sl')
            ->maxLength('mothername_sl', 100, 'Mothername can to be maximum 100 characters long.', !empty($context['data']['mothername_sl']))
            ->minLength('mothername_sl', 3, 'Mothername need to be at least 3 characters long.', !empty($context['data']['mothername_sl']));

        $validator
            ->scalar('dob')
            ->date('dob', 'ymd')
            //->requirePresence('dob', 'create')
            ->notEmptyDate('dob')
            ->lessThan('dob', date('Y-m-d', strtotime('-18 years')), 'Date of Birth should be greater than 18 yrs');

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
            ->scalar('caste_id')
            ->requirePresence('caste_id')
            ->add('caste_id', 'ValidCaste', [
                'rule' => 'isValidCaste',
                'message' => __('You need to provide a valid caste'),
                'provider' => 'table',
            ])
            ->notEmptyString('caste_id');

        $validator
            ->scalar('occupationId')
            ->requirePresence('occupationId')
            ->add('occupationId', 'ValidOccupation', [
                'rule' => 'isValidOccupation',
                'message' => __('You need to provide a valid occupation'),
                'provider' => 'table',
            ]);            

        $validator
            ->scalar('uid')
            ->maxLength('uid', 12)
            ->minLength('uid', 12)
            ->notEmptyString('uid')
            ->numeric( 'uid' , 'Please enter Aadhar No. in integers.' );


        $validator
            ->scalar('res_address')
            ->maxLength('res_address', 200)
            ->notEmptyString('res_address');

        $validator
            ->scalar('tolla_mohalla')
            ->maxLength('tolla_mohalla', 50)
            ->notEmptyString('tolla_mohalla');

        return $validator;
    }

    public function validationBank(Validator $validator)
    {
        $validator
            ->integer('is_lpg')
            ->requirePresence('is_lpg')
            ->notEmptyString('is_lpg');

        $validator
            ->notEmptyString('lpg_consumer_no', 'This field is required', function ($context) {
                return ($context['data']['is_lpg'] == 1);
            });

        $validator
            ->notEmpty('lpg_company', 'This field is required', function ($context) {
                return ($context['data']['is_lpg'] == 1);
            })
            ->add('lpg_company', 'ValidLpgConnection', [
                'rule' => 'isValidLpgConnection',
                'message' => __('You need to provide a valid LPG Connection'),
                'on' => function ($context) {
                    return !empty($context['data']['is_lpg'] == 1);
                },
                'provider' => 'table',
            ]);

            $validator
            ->integer('is_bank')
            ->requirePresence('is_bank')
            ->notEmptyString('is_bank');

        $validator
            ->notEmptyString('bank_account_no', 'This field is required', function ($context) {
                if (isset($context['data']['is_bank'])) {
                    return ($context['data']['is_bank'] == 1);
                }
                return false;
            })
            ->integer('bank_account_no', 'Account Number should be in digits', function ($context) {
                if (isset($context['data']['is_bank'])) {
                    return ($context['data']['is_bank'] == 1);
                }
                return false;
            });

        // $validator
        //     ->notEmptyString('bank_name', 'This field is required', function ($context) {
        //         if (isset($context['data']['is_bank'])) {
        //             return ($context['data']['is_bank'] == 1);
        //         }
        //         return false;
        //     });

        $validator
            ->notEmptyString('bank_master_id', 'This field is required', function ($context) {
                return ($context['data']['is_bank'] == 1);
            });

        $validator
            ->notEmptyString('branch_master_id', 'This field is required', function ($context) {
                return ($context['data']['is_bank'] == 1);
            });

        $validator
            ->notEmptyString('bank_ifsc_code', 'This field is required', function ($context) {
                return ($context['data']['is_bank'] == 1);
            });


        return $validator;
    }

    public function validationAdditional(Validator $validator)
    {
        // $validator
        //     ->integer('cardtype_id')
        //     ->requirePresence('cardtype_id')
        //     ->add('cardtype_id', 'ValidCardtype', [
        //         'rule' => 'isValidCardtype',
        //         'message' => __('You need to provide a valid cardtype'),
        //         'provider' => 'table',
        //     ]);
        // ->notEmptyString('rationcard_no');

        // $validator
        //     ->integer('applicationType')
        //     ->requirePresence('applicationType');


        // $validator
        //     ->allowEmptyString('applicationType_rule_id', function ($context) {
        //         if (isset($context['data']['applicationType'])) {
        //             return (($context['data']['applicationType'] == 1) || ($context['data']['applicationType'] == ''));
        //         }
        //         return false;
        //     }, $message = null)
        //     /*
        //     Validate by either of the method; 'greaterThan' or 'notEmpty'
        //     */
        //     /*->greaterThan('applicationType_rule_id','0', 'Please select at least 1 criteria', function ($context) {
        //         if (isset($context['data']['applicationType'])) {
        //             return ($context['data']['applicationType'] == 2);
        //         }
        //         return false;
        //     })*/
        //     ->notEmptyString('applicationType_rule_id', 'Please select at least 1 criteria', function ($context) {
        //         return ($context['data']['applicationType'] == 2);
        //     });


        $validator
            ->scalar('dealer_id')
            ->requirePresence('dealer_id');


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
					'on' => function ($context) {
						return !empty($context['data']['document']);
					}
				],
				'extension' => [
					'rule' => ['extension', ['jpg', 'jpeg', 'png']], // default  ['gif', 'jpeg', 'png', 'jpg']
					'message' => __('Only jpg/jpeg/png files are allowed.'),
					'on' => function ($context) {
						return !empty($context['data']['document']);
					}
				],
				'mimeType' => [
					'rule' => ['mimeType', ['image/png', 'image/jpg', 'image/jpeg']],
					'message' => __('File Type must be image type.'),
					'on' => function ($context) {
						return !empty($context['data']['document']);
					}
				],
				'fileSize' => [
					'rule' => ['fileSize', '<=', '500KB'],
					'message' => __('File must be less than 500KB.'),
					'on' => function ($context) {
						return !empty($context['data']['document']);
					}

				]
			]);

		return $validator;
    }

    public function isValidGender($value, array $context)
    {
        return in_array($value, ['1', '2', '3'], true);
    }

    public function isValidCaste($value, array $context)
    {
        return in_array($value, ['1', '2', '3', '4', '6', '7', '8'], true);
    }   

    // public function isValidCardtype($value, array $context)
    // {
    //     return in_array($value, ['1', '2', '3', '4', '5', '6', '7'], true);
    // }

    public function isValidLpgConnection($value, array $context)
    {
        return in_array($value, ['1', '2', '3'], true);
    }
    public function isValidMaritalStatus($value, array $context)
    {
        return in_array($value, ['1', '2', '3','4'], true);
    }
    public function isValidHealthStatus($value, array $context)
    {
        return in_array($value, ['0', '1', '2'], true);
    }
    public function isValidDisabilityStatus($value, array $context)
    {
        return in_array($value, ['1', '0'], true);
    }
    public function isValidOccupation($value, array $context)
    {
        return in_array($value, ['0', '1', '6', '7', '8', '9'], true);
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
        //$rules->add($rules->existsIn(['location_id'], 'Locations'));
        //$rules->add($rules->existsIn(['cardtype_id'], 'Cardtypes'));
        //$rules->add($rules->existsIn(['caste_id'], 'Castes'));
        //$rules->add($rules->existsIn(['secc_district_id'], 'SeccDistricts'));
        //$rules->add($rules->existsIn(['secc_block_id'], 'SeccBlocks'));
        //$rules->add($rules->existsIn(['panchayat_id'], 'Panchayats'));
        //$rules->add($rules->existsIn(['secc_village_ward_id'], 'SeccVillageWards'));
        //$rules->add($rules->existsIn(['dealer_id'], 'Dealers'));
        $rules->add($rules->existsIn(['activity_type_id'], 'ActivityTypes'));
        $rules->add($rules->isUnique(
            ['activity_type_id','ack_no'],
            'This Acknowledgement No. already exists.'
        ));

        return $rules;
    }
}
