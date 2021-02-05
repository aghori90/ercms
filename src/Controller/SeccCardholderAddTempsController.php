<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\Date;
use App\Controller\ErcmsValidateController as Ercms;
//App::import('Controller', 'Ercms');

/**
 * SeccCardholderAddTemps Controller
 *
 * @property \App\Model\Table\SeccCardholderAddTempsTable $SeccCardholderAddTemps
 *
 * @method \App\Model\Entity\SeccCardholderAddTemp[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SeccCardholderAddTempsController extends AppController
{
	public function initialize()
	{
		parent::initialize();
		$this->loadComponent('RequestHandler');
		$this->Auth->allow(['register', 'aadhar']);
	}

	/**
	 * Index method
	 *
	 * @return \Cake\Http\Response|null
	 */
	public function index()
	{
		die('Unauthorised Access');
		$this->paginate = [
			'contain' => ['Locations', 'Cardtypes', 'Castes', 'SeccDistricts', 'SeccBlocks', 'Panchayats', 'SeccVillageWards',],
		];
		$seccCardholderAddTemps = $this->paginate($this->SeccCardholderAddTemps);

		$this->set(compact('seccCardholderAddTemps'));
	}


	public function getMemberDetails()
	{
		$request_data = $this->request->getData();
		if ($this->request->is(['ajax'])) {
			$this->autoRender = false;
			$this->viewBuilder()->setLayout('ajax');
			$id = $request_data['member_id'];
		}

		$memberData = TableRegistry::getTableLocator()->get('secc_family_add_temps');
		if (!empty($id)) {
			$member = $memberData->find()->select(['id', 'name', 'name_sl', 'fathername', 'fathername_sl', 'gender_id', 'dob', 'relation_id', 'mobile', 'uid', 'disability_status', 'marital_status', 'health_status'])->where(['id' => $id])->first()->toArray();
			$member_doc = TableRegistry::getTableLocator()->get('SeccFamilyDocumentAddTemps')->find()->select(['id', 'document'])->where(['secc_family_add_temp_id' => $id])->first();
			if ($member_doc) :
				$member['old_aadhar_doc'] = $member_doc->document;
				$member['old_aadhar_doc_id'] = $member_doc->id;
			else : $member['old_aadhar_doc_id'] = '';
				$member['old_aadhar_doc'] = '';
			endif;
		}

		if ($this->request->is(['ajax'])) {
			echo json_encode($member);

			die;
		} else {
			return $member;
		}
	}

	public function opgetMemberDetails()
	{
		$request_data = $this->request->getData();
		if ($this->request->is(['ajax'])) {
			$this->autoRender = false;
			$this->viewBuilder()->setLayout('ajax');
			$id = $request_data['member_id'];
		}

		$memberData = TableRegistry::getTableLocator()->get('HhdErcmsPendingNews');
		if (!empty($id)) {
			$member = $memberData->find()->select(['id', 'name', 'name_sl', 'fathername', 'fathername_sl', 'gender_id', 'dob', 'relation_id', 'mobile', 'uid'])->where(['id' => $id])->first()->toArray();
		}

		if ($this->request->is(['ajax'])) {
			echo json_encode($member);
			die;
		} else {
			return $member;
		}
	}


	public function aadhar()
	{
	}

	/**
	 * Add method
	 *
	 * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
	 */
	public function register()
	{
		$Ercms = new ErcmsValidateController;
		$SeccCardholderAddReg = $this->SeccCardholderAddTemps->newEntity();
		$SeccFamilyAddTempsReg = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->newEntity(); //['validate'=>'Register']
		if ($this->request->is('post')) {
			if (isset($this->request->data['Next']) && $this->request->data['Next'] == 'Next') {
				/**** Start : Aadhar valid format and duplicacy Check ******/
				//$Ercms = new ErcmsValidateController;
				if ($this->request->data['uid'] != '') {
					if (is_numeric($this->request->data['uid'])) {
						if (!$uiderror = $Ercms->checkuid($this->request->data['uid'])) {
							$this->Flash->error(__('Invalid Aadhar Number. Please, try again.'));
							return $this->redirect(['controller' => 'SeccCardholderAddTemps', 'action' => 'aadhar']);
						} else if (($uiderror = $Ercms->checkaadhar($this->request->data['uid'])) != null) {
							$obj = json_decode($uiderror, true);
							if ($obj['valid'] != false) {
								if (array_key_exists('Acknowledgement No', $obj['data'])) {
									$head = 'Acknowledgement No';
								} else if (array_key_exists('Ration Card No', $obj['data'])) {
									$head = 'Ration Card No';
								} else {
									$head = '';
								}
								//$this->Flash->error(__('Aadhar Number already exists for ' . $head . ' : ' . $obj["data"][$head].' Please, try again.'));
								$this->Flash->error(__('Aadhar Number already exists, Please contact DSO office.'));
								return $this->redirect(['controller' => 'SeccCardholderAddTemps', 'action' => 'aadhar']);
							}
						}
					} else {
						$this->Flash->error(__('Please enter UID in integers.'));
						return $this->redirect(['controller' => 'SeccCardholderAddTemps', 'action' => 'aadhar']);
					}
				} else {
					$this->Flash->error(__('This field cannot be left empty. Please, try again.'));
					return $this->redirect(['controller' => 'SeccCardholderAddTemps', 'action' => 'aadhar']);
				}
				/**** End : Aadhar valid format Check ******/
			} else {
				$location_query = 	TableRegistry::getTableLocator()->get('SeccBlocks')->find('all', ['fields' => 'location_id', 'conditions' => ['rgi_district_code' => $this->request->data['rgi_district_code'], 'rgi_block_code' => $this->request->data['rgi_block_code']]])->first();
				$location_id	=	$location_query->location_id;
				/*Secc Cardholders add temp Entity*/
				/********** Start : Get Acknowledgement Number *********/
				$acknowledgementNo =  $Ercms->acknowledgementNo($this->request->data['rgi_district_code'], '1');
				/********** End : Get Acknowledgement Number *********/

				$SeccCardholderAddRegData = array(
					'ack_no'				=>	$acknowledgementNo,
					'name'					=>	ucwords($this->request->data['name']),
					'name_sl'				=>	$this->request->data['name_sl'],
					'fathername'			=>	ucwords($this->request->data['fathername']),
					'fathername_sl'			=>	$this->request->data['fathername_sl'],
					'mobileno'				=>	$this->request->data['mobileno'],
					'requested_mobile'		=>	$this->request->data['mobileno'],
					'rgi_district_code'		=>	$this->request->data['rgi_district_code'],
					'rgi_block_code'		=>	$this->request->data['rgi_block_code'],
					'location_id'			=>	$location_id,
					'rgi_village_code'		=>	$this->request->data['rgi_village_code'],
					'uid'					=>	$this->request->data['uid'],
					'created'				=>	date('Y-m-d H:i:s'),
					'family_count'			=>	'1',
					'activity_type_id'		=>	'1',
					'activity_flag'			=>	'0',
					'application_status'	=>	'1',
				);
				/*Secc Family add temp Entity*/
				$SeccFamilyAddTempsRegData = array(
					'name'					=>	ucwords($this->request->data['name']),
					'name_sl'				=>	$this->request->data['name_sl'],
					'fathername'			=>	ucwords($this->request->data['fathername']),
					'fathername_sl'			=>	$this->request->data['fathername_sl'],
					'mobile'				=>	$this->request->data['mobileno'],
					'requested_mobile'		=>	$this->request->data['mobileno'],
					'dob'					=>	$this->request->data['dob'],
					'uid'					=>	$this->request->data['uid'],
					'rgi_district_code'		=>	$this->request->data['rgi_district_code'],
					'rgi_block_code'		=>	$this->request->data['rgi_block_code'],
					'rgi_village_code'		=>	$this->request->data['rgi_village_code'],
					'ack_no_ercms'			=>	$acknowledgementNo,
					'created'				=>	date('Y-m-d H:i:s'),
					'hof'					=>	'1',
					'relation_id'			=>	'1',
					'activity_type_id'		=>	'1',
					'activity_flag'			=>	'0',
				);
				$SeccCardholderAddReg = $this->SeccCardholderAddTemps->patchEntity($SeccCardholderAddReg, $SeccCardholderAddRegData, ['validate' => 'Register']);

				/********** Start : Aadhar valid format and duplicacy Check ****************/
				$Ercms = new ErcmsValidateController;
				if ($this->request->data['uid'] != '') {
					if (!$uiderror = $Ercms->checkuid($this->request->data['uid'])) {
						$SeccCardholderAddReg->setError('uid', ['Invalid Aadhar Number']);
					} else if (($uiderror = $Ercms->checkaadhar($this->request->data['uid'])) != null) {
						$obj = json_decode($uiderror, true);
						if ($obj['valid'] != false) {
							if (array_key_exists('Acknowledgement No', $obj['data'])) {
								$head = 'Acknowledgement No';
							} else if (array_key_exists('Ration Card No', $obj['data'])) {
								$head = 'Ration Card No';
							} else {
								$head = '';
							}
							//$SeccCardholderAddReg->setError('uid', ['Aadhar Number already exists for ' . $head . ' : ' . $obj["data"][$head]]);
							$SeccCardholderAddReg->setError('uid', ['Aadhar Number already exists, Please contact DSO office.']);
						}
					}
				} else {
					$SeccCardholderAddReg->setError('uid', ['This field cannot be left empty']);
				}
				/********** End : Aadhar valid format Check ****************/
				/********** End : Mobile duplicacy Check ****************/
				/*if ($this->request->data['mobileno'] != '') {
					if (($mobile_error = $Ercms->checkDuplicateMobile($this->request->data['mobileno'])) != null) {
						$mobileobj = json_decode($mobile_error, true);
						if ($mobileobj['valid'] != false) {
							if (array_key_exists('Acknowledgement No', $mobileobj['data'])) {
								$mob_head = 'Acknowledgement No';
							} else if (array_key_exists('Ration Card No', $mobileobj['data'])) {
								$mob_head = 'Ration Card No';
							} else {
								$mob_head = '';
							}
							//$SeccCardholderAddReg->setError('mobileno', ['Mobile Number already exists for ' . $mob_head . ' : ' . $mobileobj["data"][$mob_head]]);
							$SeccCardholderAddReg->setError('mobileno', ['Mobile Number already exists, Please contact DSO office.']);
						}
					}
				} else {
					$SeccCardholderAddReg->setError('mobileno', ['This field cannot be left empty']);
				}*/

				/********** End : Mobile number duplicacy Check ****************/
				if ($seccCardholderAddTemp = $this->SeccCardholderAddTemps->save($SeccCardholderAddReg)) {
					$SeccFamilyAddTempsRegData['secc_cardholder_add_temp_id'] =	$seccCardholderAddTemp->id;
					$SeccFamilyAddTempsReg = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->patchEntity($SeccFamilyAddTempsReg, $SeccFamilyAddTempsRegData, ['validate' => false]);

					if (TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->save($SeccFamilyAddTempsReg)) {
						$this->Flash->success(__('Registration Done Successfully. Please Login with your Acknowledgement No. ' . $acknowledgementNo . ' & Last 8 digits of Aadhar No. as Password.'));
						return $this->redirect(['controller' => 'SeccCardholders', 'action' => 'login']);
					}
				} else {
					$this->Flash->error(__('The registration could not be done. Please, try again.'));
				}
			}
		} else {
			return $this->redirect(['controller' => 'SeccCardholderAddTemps', 'action' => 'aadhar']);
		}

		$seccDistricts = TableRegistry::getTableLocator()->get('SeccDistricts')->find('list', [
			'keyField' => 'rgi_district_code',
			'valueField' => 'name'
		]);

		$this->set(compact('user', 'seccDistricts', 'SeccCardholderAddReg'));
	}


	/**
	 * Add personalDetails method
	 *
	 * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
	 */

	public function personalDetails()
	{
		if ($this->request->getSession()->check('Auth')) {
			$secc_cardholder_add_temp_id = $this->request->getSession()->read('Auth.User.id');
		} else {
			return	$this->redirect($this->Auth->logout());
		}

		$seccCardholderAddTemp = $this->SeccCardholderAddTemps
			->find(
				'all',
				[
					'fields' 	=>
					['id', 'ack_no', 'mobileno', 'uid', 'name', 'name_sl', 'fathername', 'fathername_sl', 'caste_id', 'mothername', 'mothername_sl', 'marital_status', 'health_status', 'disability_status', 'res_address', 'res_address_hn', 'tolla_mohalla', 'rgi_district_code', 'rgi_block_code', 'rgi_village_code', 'application_status', 'occupationId', 'SeccDistricts.name', 'SeccBlocks.name', 'SeccVillageWards.id',  'SeccVillageWards.name'],
					'conditions' => ['SeccCardholderAddTemps.id=' . "'" . $secc_cardholder_add_temp_id . "'", 'application_status<>7', 'application_status>=1'],
					'contain'	=> ['SeccDistricts', 'SeccBlocks', 'SeccVillageWards']
				]
			)
			->first();
		if ($seccCardholderAddTemp) {
			if ($this->request->is(['patch', 'post', 'put'])) {
				$seccCardholderAddTempData	=	array(
					'caste_id' 				=>	$this->request->data['caste_id'],
					'res_address'			=>	$this->request->data['res_address'],
					'tolla_mohalla'			=>	$this->request->data['tolla_mohalla'],
					'mothername'			=>	$this->request->data['mothername'],
					'mothername_sl'			=>	$this->request->data['mothername_sl'],
					'occupationId'			=>	$this->request->data['occupationId'],
					'gender_id'				=>	$this->request->data['gender_id'],
					'marital_status'		=>	$this->request->data['marital_status'],
					'disability_status'		=>	$this->request->data['disability_status'],
					'health_status'			=>	$this->request->data['health_status'],
					'application_status'	=> ($seccCardholderAddTemp->application_status < 2) ? 2 : $seccCardholderAddTemp->application_status,
				);

				$seccCardholderAddTemp = $this->SeccCardholderAddTemps->patchEntity($seccCardholderAddTemp, $seccCardholderAddTempData, ['validate' => 'personal']);
				if (!$seccCardholderAddTemp->getErrors()) {
					if ($this->SeccCardholderAddTemps->save($seccCardholderAddTemp)) {
						$this->SeccCardholderAddTemps->SeccFamilyAddTemps->updateAll(['gender_id' => $this->request->data['gender_id'], 'mothername' => $seccCardholderAddTemp->mothername, 'mothername_sl' => $seccCardholderAddTemp->mothername_sl, 'marital_status' => $this->request->data['marital_status'], 'disability_status' => $this->request->data['disability_status'], 'health_status' => $this->request->data['health_status']], ["secc_cardholder_add_temp_id" => $seccCardholderAddTemp->id, 'hof' => '1']);

						$this->Flash->success(__('The Cardholder\'s personal Detail has been saved.'));
						return $this->redirect(['controller' => 'SeccCardholderAddTemps', 'action' => 'personalDetails']);
					}
				} else {
					//debug($seccCardholderAddTemp->errors());
					$this->Flash->error(__('The Cardholder\'s personal Detail  could not be saved. Please, try again.'));
				}
			}
			$castes = TableRegistry::getTableLocator()->get('Castes')->find('list', ['limit' => 200]);
			$family_details = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->find('all', ['fields' => ['gender_id'], 'conditions' => ['secc_cardholder_add_temp_id' => $seccCardholderAddTemp->id, 'hof' => 1]])->first();
			if ($family_details) {
				$seccCardholderAddTemp->gender_id 			= $family_details->gender_id;
			};
			$this->set(compact('seccCardholderAddTemp', 'seccCardholders', 'castes', 'family_details'));
		} else {
			return	$this->redirect(['controller' => 'SeccCardholders', 'action' => 'logout']);
		}
	}


	/**
	 * Add bankDetails method
	 *
	 */
	public function bankDetails()
	{
		if ($this->request->getSession()->check('Auth')) {
			$secc_cardholder_add_temp_id = $this->request->getSession()->read('Auth.User.id');
		} else {
			return	$this->redirect($this->Auth->logout());
		}

		$seccCardholderAddTemp = $this->SeccCardholderAddTemps
			->find(
				'all',
				[
					'fields' 	=>
					['id', 'ack_no', 'mobileno', 'uid', 'name', 'name_sl', 'is_lpg', 'lpg_company', 'lpg_consumer_no', 'is_bank', 'caste_id', 'bank_account_no', 'bank_master_id', 'branch_master_id', 'bank_ifsc_code', 'application_status'],
					'conditions' => ['SeccCardholderAddTemps.id=' . "'" . $secc_cardholder_add_temp_id . "'", 'application_status<>7', 'application_status>=2'],
					'contain' => ['BankMasters', 'BranchMasters']
				]
			)
			->first();
		if ($seccCardholderAddTemp) {
			if ($this->request->is(['patch', 'post', 'put'])) {
				$seccCardholderAddTempData = array(
					'is_lpg'		=>	$this->request->data['is_lpg'],
					'is_bank'		=>	$this->request->data['is_bank'],
				);

				if ($seccCardholderAddTempData['is_lpg'] == 1) {
					$seccCardholderAddTempData['lpg_company'] 			=	$this->request->data['lpg_company'];
					$seccCardholderAddTempData['lpg_consumer_no'] 		=	$this->request->data['lpg_consumer_no'];
				} else {
					$seccCardholderAddTempData['lpg_company'] 			=	'';
					$seccCardholderAddTempData['lpg_consumer_no']		=	'';
				}
				if ($seccCardholderAddTempData['is_bank'] == 1) {
					$seccCardholderAddTempData['bank_account_no']		=	$this->request->data['bank_account_no'];
					$seccCardholderAddTempData['bank_master_id']		=	$this->request->data['bank_master_id'];
					$seccCardholderAddTempData['branch_master_id']		=	$this->request->data['branch_master_id'];
					$seccCardholderAddTempData['bank_ifsc_code']		=	$this->request->data['bank_ifsc_code'];
				} else {
					$seccCardholderAddTempData['bank_account_no'] 		=	'';
					$seccCardholderAddTempData['bank_master_id']		=	'';
					$seccCardholderAddTempData['branch_master_id']		=	'';
					$seccCardholderAddTempData['bank_ifsc_code']		=	'';
				}
				if ($seccCardholderAddTemp->application_status < 3) {
					$seccCardholderAddTempData['application_status']	=	'3';
				}
				$seccCardholderAddTemp = $this->SeccCardholderAddTemps->patchEntity($seccCardholderAddTemp, $seccCardholderAddTempData, ['validate' => 'Bank']);

				if ($this->SeccCardholderAddTemps->save($seccCardholderAddTemp)) {
					$this->Flash->success(__('The Bank details & LPG Connection Details has been saved.'));
					return $this->redirect(['controller' => 'SeccCardholderAddTemps', 'action' => 'bankDetails']);
				}
				$this->Flash->error(__('The Bank details & LPG Connection Details could not be saved. Please, try again.'));
			}

			$bankNames	=	TableRegistry::getTableLocator()->get('BankMasters')->find('list', ['fields' => ['id' => 'BankMasters.bank_code', 'BankMasters.name']])->toArray();
			$this->set(compact('seccCardholderAddTemp', 'bankNames'));
		} else {
			return	$this->redirect(['controller' => 'SeccCardholders', 'action' => 'logout']);
		}
	}

	/**
	 * Add personalDetails method
	 *
	 * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
	 */
	public function additionalDetails()
	{
		if ($this->request->getSession()->check('Auth')) {
			$secc_cardholder_add_temp_id = $this->request->getSession()->read('Auth.User.id');
		} else {
			return	$this->redirect($this->Auth->logout());
		}

		$seccCardholderAddTemp = $this->SeccCardholderAddTemps
			->find(
				'all',
				[
					'fields' 	=>
					['id', 'ack_no', 'mobileno', 'uid', 'name', 'name_sl', 'applicationType', 'applicationType_rule_id', 'cardtype_id', 'dealer_id', 'caste_id', 'rgi_block_code', 'rgi_district_code', 'location_id', 'application_status', 'non_gov', 'above_sixty', 'marital_status', 'disability_status', 'health_status', 'beggar', 'rag_picker', 'worker', 'street_vendor', 'pvtg', 'old_alone'],
					'conditions' => ['SeccCardholderAddTemps.id=' . "'" . $secc_cardholder_add_temp_id . "'", 'application_status<>7', 'application_status>=3']
				]
			)
			->first();
		if ($seccCardholderAddTemp) {
			if ($this->request->is(['patch', 'post', 'put'])) {
				//$seccCardholderAddTemp->applicationType 				=	$this->request->data['applicationType'];
				$seccCardholderAddTemp->cardtype_id						=	8; //$this->request->data['cardtype_id'];
				$seccCardholderAddTemp->dealer_id						=	$this->request->data['dealer_id'];
				$seccCardholderAddTemp->applicationType_rule_id			=	'';
				$seccCardholderAddTemp->non_gov 						= 	0;
				$seccCardholderAddTemp->above_sixty 					= 	0;
				$seccCardholderAddTemp->marital_status 					= 	0;
				$seccCardholderAddTemp->disability_status 				= 	0;
				$seccCardholderAddTemp->health_status 					= 	0;
				$seccCardholderAddTemp->rag_picker 						= 	0;
				$seccCardholderAddTemp->worker 							= 	0;
				$seccCardholderAddTemp->street_vendor 					= 	0;
				$seccCardholderAddTemp->pvtg 							= 	0;
				$seccCardholderAddTemp->old_alone 						= 	0;
				if (isset($this->request->data['inclusion_criteria'])) {
					foreach ($this->request->data['inclusion_criteria'] as $key => $inclusion) {
						$seccCardholderAddTemp->$key					= 	'1'; //$inclusion;
					}
				}
				if ($seccCardholderAddTemp->application_status < 4) {
					$seccCardholderAddTemp->application_status			=	'4';
				}
				if ($seccCardholderAddTemp->pvtg == 1 && $seccCardholderAddTemp->caste_id != 7) {
					$this->Flash->error(__('You cannot select PVTG as you inclusion criteria for Ration Card as you have not selected PVTG as your caste at the time of registration.'));
					return $this->redirect(['controller' => 'seccCardholderAddTemps', 'action' => 'additionalDetails']);
				} else if ($seccCardholderAddTemp->occupation_id != 6 && $seccCardholderAddTemp->beggar == 1) {
					$this->Flash->error(__('You have selected beggar criteria for Ration Card. Please select beggar as your occupation in personal details.'));
					return $this->redirect(['controller' => 'seccCardholderAddTemps', 'action' => 'additionalDetails']);
				} else if ($seccCardholderAddTemp->occupation_id == 1 && $seccCardholderAddTemp->non_gov == 1) {
					$this->Flash->error(__('You have selected non goverment employee criteria for Ration Card. Please select non goverment employee as your occupation in personal details.'));
					return $this->redirect(['controller' => 'seccCardholderAddTemps', 'action' => 'additionalDetails']);
				} else if ($seccCardholderAddTemp->occupation_id != 7 && $seccCardholderAddTemp->rag_picker == 1) {
					$this->Flash->error(__('You have selected ragpicker criteria for Ration Card. Please select ragpicker as your occupation in personal details.'));
					return $this->redirect(['controller' => 'seccCardholderAddTemps', 'action' => 'additionalDetails']);
				} else if ($seccCardholderAddTemp->occupation_id != 8 && $seccCardholderAddTemp->worker == 1) {
					$this->Flash->error(__('You have selected  Construction Worker/Mason/Unskilled Labour/Domestic Worker/Coolie and other head load worker/Rickshaw Puller/Thela Puller criteria for Ration Card. Please select  your occupation same in personal details.'));
					return $this->redirect(['controller' => 'seccCardholderAddTemps', 'action' => 'additionalDetails']);
				} else if ($seccCardholderAddTemp->occupation_id != 9 && $seccCardholderAddTemp->street_vendor == 1) {
					$this->Flash->error(__('You have selected  Street Vendor/Hawker/Peon in Small Establishment/Security Guard/Painter/Welder/Electrician/Mechanic/Tailor/Plumber/Mali/Washermen/cobbler criteria for Ration Card. Please select  your occupation same in personal details.'));
					return $this->redirect(['controller' => 'seccCardholderAddTemps', 'action' => 'additionalDetails']);
				}

				$seccCardholderAddTemp = $this->SeccCardholderAddTemps->patchEntity($seccCardholderAddTemp, $seccCardholderAddTemp->toArray(), ['validate' => 'additional']);

				if (!$seccCardholderAddTemp->getErrors()) {
					if ($this->SeccCardholderAddTemps->save($seccCardholderAddTemp)) {
						$this->Flash->success(__('The additional details has been saved.'));
						return $this->redirect(['controller' => 'SeccCardholderAddTemps', 'action' => 'additionalDetails']);
					}
					$this->Flash->error(__('The additional details could not be saved. Please, try again.'));
				} else {
					$this->Flash->error(__('The additional details could not be saved. Please, try again.'));
				}
			}

			$cardtypes 					= TableRegistry::getTableLocator()->get('Cardtypes')->find('list');
			$inclusion_criterias 		= TableRegistry::getTableLocator()->get('InclusionCriterias')->find('all', ['fields' => ['id', 'name', 'cardholder_col'], 'conditions' => ['location_id' => $seccCardholderAddTemp->location_id]])->toArray();
			$exclusion_criterias 		= TableRegistry::getTableLocator()->get('ExclusionCriterias')->find('all', ['fields' => ['id', 'name']])->toArray();


			$dealers = TableRegistry::getTableLocator()->get('Dealers')->find('list', ['conditions' => ['Dealers.rgi_district_code=' . "'" . $seccCardholderAddTemp->rgi_district_code . "'", 'Dealers.rgi_block_code=' . "'" . $seccCardholderAddTemp->rgi_block_code . "'"]]);
			$hof_gender_id = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->find('all', ['fields' => ['gender_id'], 'conditions' => ['secc_cardholder_add_temp_id' => $seccCardholderAddTemp->id, 'hof' => 1]])->first();

			$this->set(compact('seccCardholderAddTemp',  'cardtypes',  'dealers', 'exclusion_criterias', 'inclusion_criterias', 'hof_gender_id'));
		} else {
			return	$this->redirect(['controller' => 'SeccCardholders', 'action' => 'logout']);
		}
	}


	/**
	 * Add Family Member method
	 *
	 * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
	 */
	function addFamily()
	{
		//get registration details---------------				
		if ($this->request->getSession()->check('Auth')) {
			$secc_cardholder_add_temp_id = $this->request->getSession()->read('Auth.User.id');
			$ack_no = $this->request->getSession()->read('Auth.User.ack_no');
		} else {
			return	$this->redirect($this->Auth->logout());
		}

		$seccCardholderAddTemp = TableRegistry::getTableLocator()
			->get('SeccCardholderAddTemps')
			->find(
				'all',
				[
					'fields' 	=>
					['id', 'ack_no', 'mobileno', 'uid', 'name', 'name_sl', 'application_status', 'applicationType', 'applicationType_rule_id', 'rgi_district_code', 'rgi_block_code', 'rgi_village_code', 'non_gov', 'above_sixty', 'marital_status', 'disability_status', 'health_status', 'beggar', 'rag_picker', 'worker', 'street_vendor', 'pvtg', 'old_alone','family_count'],
					'conditions' => ['SeccCardholderAddTemps.id=' . "'" . $secc_cardholder_add_temp_id . "'", 'application_status<>7', 'application_status>=4']
				]
			)
			->first();
		if ($seccCardholderAddTemp) {
			$seccFamilyAddTemp = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->newEntity();
			if ($this->request->is('post')) {
				$family_count = $seccCardholderAddTemp->family_count;
				$rgi_district_code = $seccCardholderAddTemp->rgi_district_code;
				$ack_no = $seccCardholderAddTemp->ack_no;
				$district_dir = DOC_ABS_PATH . $rgi_district_code;
				$application_dir = $district_dir . DS .  $ack_no;
				if (!file_exists($district_dir)) {
					mkdir($district_dir);
				}
				if (!file_exists($application_dir)) {
					mkdir($application_dir);
				}
				if ($this->request->data['Submit'] == 'savemember') {
					if ($seccCardholderAddTemp->old_alone != 1) {
						$seccFamilyAddTempData 										= $this->request->getData();
						$seccFamilyAddTempData['secc_cardholder_add_temp_id'] 		= $seccCardholderAddTemp->id;
						$seccFamilyAddTempData['rgi_district_code'] 				= $seccCardholderAddTemp->rgi_district_code;
						$seccFamilyAddTempData['rgi_block_code'] 					= $seccCardholderAddTemp->rgi_block_code;
						$seccFamilyAddTempData['rgi_village_code'] 					= $seccCardholderAddTemp->rgi_village_code;
						$seccFamilyAddTempData['name'] 								= ucwords($this->request->data['name']);
						$seccFamilyAddTempData['fathername'] 						= ucwords($this->request->data['fathername']);
						$seccFamilyAddTempData['ack_no_ercms'] 						= $ack_no;
						$seccFamilyAddTempData['activity_type_id'] 					= 1;
						$seccFamilyAddTempData['activity_flag'] 					= 0;
						$seccFamilyAddTempData['document'] 							= $this->request->data['aadhar_doc'];

						$seccFamilyAddTemp = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->patchEntity($seccFamilyAddTemp, $seccFamilyAddTempData);

						/********** Start : Aadhar valid format and duplicacy Check ****************/
						$Ercms = new ErcmsValidateController;
						if ($seccFamilyAddTempData['uid'] != '') {
							if (!$uiderror = $Ercms->checkuid($this->request->data['uid'])) {
								$seccFamilyAddTemp->setError('uid', ['Invalid Aadhar Number']);
							} else if (($uiderror = $Ercms->checkaadhar($this->request->data['uid'])) != null) {
								$obj = json_decode($uiderror, true);
								if ($obj['valid'] != false) {
									if (array_key_exists('Acknowledgement No', $obj['data'])) {
										$head = 'Acknowledgement No';
									} else if (array_key_exists('Ration Card No', $obj['data'])) {
										$head = 'Ration Card No';
									} else {
										$head = '';
									}
									//$seccFamilyAddTemp->setError('uid', ['Aadhar Number already exists for ' . $head . ' : ' . $obj["data"][$head]]);
									$seccFamilyAddTemp->setError('uid', ['Aadhar Number already exists, Please contact DSO office.']);
								}
							}
						} else {
							$seccFamilyAddTemp->setError('uid', ['This field cannot be left empty']);
						}
						/********** End : Aadhar valid format nd duplicacy Check ****************/
						/********** Start : Mobile number duplicacy Check ****************/
						/*if ($seccFamilyAddTempData['mobile'] != '') {
							if (($mobile_error = $Ercms->checkDuplicateMobile($this->request->data['mobile'])) != null) {
								$mobileobj = json_decode($mobile_error, true);
								if ($mobileobj['valid'] != false) {
									if (array_key_exists('Acknowledgement No', $mobileobj['data'])) {
										$mob_head = 'Acknowledgement No';
									} else if (array_key_exists('Ration Card No', $mobileobj['data'])) {
										$mob_head = 'Ration Card No';
									} else {
										$mob_head = '';
									}
									//$seccFamilyAddTemp->setError('mobile', ['Mobile Number already exists for ' . $mob_head . ' : ' . $mobileobj["data"][$mob_head]]);
									$seccFamilyAddTemp->setError('mobile', ['Mobile Number already exists, Please contact DSO office.']);
								}
							}
						} else {
							$seccFamilyAddTemp->setError('mobile', ['This field cannot be left empty']);
						}*/
						/********** End : Mobile number duplicacy Check ****************/

						if (!$seccFamilyAddTemp->getErrors()) {
							/********** Start : Uploading Document & saving Data****************/
							$seccFamilyDocument 										= TableRegistry::getTableLocator()->get('SeccFamilyDocumentAddTemps')->newEntity();
							$seccFamilyDocument->secc_cardholder_add_temp_id 			=	$seccCardholderAddTemp->id;
							$seccFamilyDocument->document_type_id						= '18';
							if (!empty($this->request->data['aadhar_doc']['name']) and $this->request->data['aadhar_doc']['error'] == 0) {
								$extension = explode('.', $this->request->data['aadhar_doc']['name']);
								$extension = end($extension);
								$fileNewName = $ack_no . '_UIDDOC' . strtotime(date('d-m-Y H:i:s')) . '.' . $extension;
								if (move_uploaded_file($this->request->data['aadhar_doc']['tmp_name'], $application_dir . DS . $fileNewName)) {
									$seccFamilyDocument->document = $fileNewName;
									if ($inserted_id = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->save($seccFamilyAddTemp)) {
										$seccFamilyDocument->secc_family_add_temp_id			=	$inserted_id->id;
										TableRegistry::getTableLocator()->get('SeccFamilyDocumentAddTemps')->save($seccFamilyDocument);
										$family_count_add	=	$family_count + 1;
										$update = TableRegistry::getTableLocator()->get('seccCardholderAddTemps')->updateAll(['family_count' => $family_count_add], ["id" => $seccCardholderAddTemp->id]);
										$this->Flash->success(__('The secc family add temp has been saved.'));
										return $this->redirect(['action' => 'addFamily']);
									} else {
										$this->Flash->error(__('The family Member could not be saved. Please, try again.'));
									}
								} else {
									$this->Flash->error(__('The family Member could not be saved. Please, try again.'));
								}
							}
						} else {	//if($seccFamilyAddTemp->getErrors()){debug($seccFamilyAddTemp->getError('aadhar_doc'));die;}
							$this->Flash->error(__('The family Member could not be saved. Please, try again.'));
						}
						/********** End : Uploading Document & saving Data****************/
					} else {
						$this->Flash->error(__('You cannot add family Member as you have selected single family in inclusion criteria.'));
					}
				} else if ($this->request->data['Submit'] == 'editmember') {
					$member_id								=	$this->request->data['member_id'];
					$seccFamilyAddTemp 						= 	TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->get($member_id);

					$seccFamilyAddTempData					=	$this->request->getData();
					$seccFamilyAddTempData['name'] 			= 	ucwords($this->request->data['name']);
					$seccFamilyAddTempData['fathername'] 	= 	ucwords($this->request->data['fathername']);
					$seccFamilyAddTempData['ack_no_ercms'] 	= 	$ack_no;
					if ($this->request->data['aadhar_doc']['error'] != 0) {
						$seccFamilyAddTempData['aadhar_doc'] = '';
					}

					$seccFamilyAddTemp = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->patchEntity($seccFamilyAddTemp, $seccFamilyAddTempData, ['validate' => 'editmember']);

					/********** Start : Aadhar valid format and duplicacy Check ****************/
					$Ercms = new ErcmsValidateController;
					if ($seccFamilyAddTempData['uid'] != '') {
						if (!$uiderror = $Ercms->checkuid($this->request->data['uid'])) {
							$seccFamilyAddTemp->setError('uid', ['Invalid Aadhar Number']);
						} else if (($uiderror = $Ercms->checkaadhar($this->request->data['uid'], $member_id)) != null) {
							$obj = json_decode($uiderror, true);
							if ($obj['valid'] != false) {
								if (array_key_exists('Acknowledgement No', $obj['data'])) {
									$head = 'Acknowledgement No';
								} else if (array_key_exists('Ration Card No', $obj['data'])) {
									$head = 'Ration Card No';
								} else {
									$head = '';
								}
								//$seccFamilyAddTemp->setError('uid', ['Aadhar Number already exists for ' . $head . ' : ' . $obj["data"][$head]]);
								$seccFamilyAddTemp->setError('uid', ['Aadhar Number already exists, Please contact DSO office.']);
							}
						}
					} else {
						$seccFamilyAddTemp->setError('uid', ['This field cannot be left empty']);
					}
					/********** End : Aadhar valid format nd duplicacy Check ****************/
					/********** Start : Mobile number duplicacy Check ****************/
					/*if ($seccFamilyAddTempData['mobile'] != '') {
						if (($mobile_error = $Ercms->checkDuplicateMobile($this->request->data['mobile'])) != null) {
							$mobileobj = json_decode($mobile_error, true);
							if ($mobileobj['valid'] != false) {
								if (array_key_exists('Acknowledgement No', $mobileobj['data'])) {
									$mob_head = 'Acknowledgement No';
								} else if (array_key_exists('Ration Card No', $mobileobj['data'])) {
									$mob_head = 'Ration Card No';
								} else {
									$mob_head = '';
								}
								//$seccFamilyAddTemp->setError('mobile', ['Mobile Number already exists for ' . $mob_head . ' : ' . $mobileobj["data"][$mob_head]]);
								$seccFamilyAddTemp->setError('mobile', ['Mobile Number already exists, Please contact DSO office.']);
							}
						}
					} else {
						$seccFamilyAddTemp->setError('mobile', ['This field cannot be left empty']);
					}*/
					/********** End : Mobile number duplicacy Check ****************/

					if (!$seccFamilyAddTemp->getErrors()) {
						/********** Start : Uploading Document ****************/
						if (!empty($this->request->data['aadhar_doc']['name']) and $this->request->data['aadhar_doc']['error'] == 0) {
							$seccFamilyDocument 										= TableRegistry::getTableLocator()->get('SeccFamilyDocumentAddTemps')->newEntity();
							$seccFamilyDocument->secc_cardholder_add_temp_id 			= $seccCardholderAddTemp->id;
							$seccFamilyDocument->secc_family_add_temp_id 				= $member_id;
							$seccFamilyDocument->document_type_id						= '18';
							$old_aadhar_doc												= $this->request->data['old_aadhar_doc'];
							$old_aadhar_doc_id											= $this->request->data['old_aadhar_doc_id'];

							$extension = explode('.', $this->request->data['aadhar_doc']['name']);
							$extension = end($extension);
							$fileNewName = $ack_no . '_UIDDOC' . strtotime(date('d-m-Y H:i:s')) . '.' . $extension;
							//@chmod(WWW_ROOT . 'upload/', 0777);
							//$application_dir . DS . $fileNewName
							if ($old_aadhar_doc_id != '') {
								$del_doc_record = TableRegistry::getTableLocator()->get('SeccFamilyDocumentAddTemps')->get($old_aadhar_doc_id);
								if (file_exists($application_dir . DS . $old_aadhar_doc) && unlink($application_dir . DS . $old_aadhar_doc)) {
									if (move_uploaded_file($this->request->data['aadhar_doc']['tmp_name'], $application_dir . DS . $fileNewName)) {
										if (TableRegistry::getTableLocator()->get('SeccFamilyDocumentAddTemps')->delete($del_doc_record)) {
											$seccFamilyDocument->document = $fileNewName;
											$seccFamilyDocument->document_type_id = '18';
										} else {
											//echo 'image not unlinked.....'; 
											$this->Flash->error(__('Image not Unlinked. Please, try again.'));
											return $this->redirect(['action' => 'addFamily']);
										}
									}
								} else {
									if (move_uploaded_file($this->request->data['aadhar_doc']['tmp_name'], $application_dir . DS . $fileNewName)) {
										if (TableRegistry::getTableLocator()->get('SeccFamilyDocumentAddTemps')->delete($del_doc_record)) {
											$seccFamilyDocument->document = $fileNewName;
											$seccFamilyDocument->document_type_id = '18';
										} else {
											//echo 'image not unlinked.....'; 
											$this->Flash->error(__('Image not Unlinked. Please, try again.'));
											return $this->redirect(['action' => 'addFamily']);
										}
									}
								}
							} else {
								if (move_uploaded_file($this->request->data['aadhar_doc']['tmp_name'], $application_dir . DS . $fileNewName)) {
									$seccFamilyDocument->document = $fileNewName;
									$seccFamilyDocument->document_type_id = '18';
								}
							}
							if (TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->save($seccFamilyAddTemp)) {
								TableRegistry::getTableLocator()->get('SeccFamilyDocumentAddTemps')->save($seccFamilyDocument);
								$this->Flash->success(__('The member details has been updated.'));
								return $this->redirect(['action' => 'addFamily']);
							}
						} else {
							if (TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->save($seccFamilyAddTemp)) {
								$this->Flash->success(__('The member details has been updated.'));
								return $this->redirect(['action' => 'addFamily']);
							}
						}
						/********** End : Uploading Document ****************/
					} else {
						$this->Flash->error(__('The Family details could not be saved. Please, try again.'));
					}
				} else {

					$check_priority_status = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->find('all', ['fields' => ['disability_status' => 'sum(case when disability_status = 1 then 1 else 0 end)', 'health_status' => 'sum(case when health_status = 1 then 1 else 0 end)', 'marital_status' => 'sum(case when marital_status = 3 then 1  when marital_status = 4 then 1 else 0 end)', 'age_status' => 'sum(case when (DATE_FORMAT(FROM_DAYS(DATEDIFF(now(),dob)), "%Y")+0)  >=60 then 1 else 0 end)'], 'conditions' => ['secc_cardholder_add_temp_id' => $seccCardholderAddTemp->id]])->first();

					if ($check_priority_status->disability_status <= 0  && $seccCardholderAddTemp->disability_status == 1) {
						$this->Flash->error(__('You have selected disability criteria for Ration Card. Please select disability status as disable.'));
						return $this->redirect(['controller' => 'seccCardholderAddTemps', 'action' => 'addFamily']);
					} else if ($check_priority_status->health_status <= 0 && $seccCardholderAddTemp->health_status == 1) {
						$this->Flash->error(__('You have selected health aid criteria for Ration Card. Please select health aid.'));
						return $this->redirect(['controller' => 'seccCardholderAddTemps', 'action' => 'addFamily']);
					} else if ($check_priority_status->marital_status <= 0 && $seccCardholderAddTemp->marital_status == 1) {
						$this->Flash->error(__('You have selected widow/widower criteria for Ration Card. Please select marital status.'));
						return $this->redirect(['controller' => 'seccCardholderAddTemps', 'action' => 'addFamily']);
					} else if ($check_priority_status->age_status <= 0 && $seccCardholderAddTemp->above_sixty == 1) {
						$this->Flash->error(__('You have selected above sixty criteria for Ration Card. Please input your age above sixty.'));
						return $this->redirect(['controller' => 'seccCardholderAddTemps', 'action' => 'addFamily']);
					} else {
						if ($seccCardholderAddTemp->application_status < 5) {
							$update = TableRegistry::getTableLocator()->get('seccCardholderAddTemps')->updateAll(['application_status' => '5'], ["id" => $seccCardholderAddTemp->id]);
						}
						$this->Flash->success(__('The Family Details have been saved successfully.'));
						return $this->redirect(['controller' => 'seccCardholderAddTemps', 'action' => 'addFamily']);
					}
				}
			}

			$relations 					= TableRegistry::getTableLocator()->get('Relations')->find('list', ['conditions' => ['name !=' => 'SELF'], 'limit' => 200]);
			$genders 					= TableRegistry::getTableLocator()->get('Genders')->find('list', ['limit' => 200])->where([]);
			$seccFamilyMember 			= TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->find('all')->where(['secc_cardholder_add_temp_id' => $seccCardholderAddTemp->id])->contain(['seccFamilyDocumentAddTemps' => ['DocumentTypes'], 'relations', 'genders'])->toArray();
			$seccFamilyMemberCount		= TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->find()->where(['secc_cardholder_add_temp_id' => $seccCardholderAddTemp->id, 'hof is null'])->count();

			$this->set(compact('seccFamilyMember', 'seccFamilyAddTemp', 'relations', 'genders', 'seccCardholderAddTemp', 'seccFamilyMemberCount'));
		} else {
			return	$this->redirect(['controller' => 'SeccCardholders', 'action' => 'logout']);
		}
	}


	/**
	 * Add documentDetails method
	 *
	 */

	function documentDetails()
	{
		if ($this->request->getSession()->check('Auth')) {
			$secc_cardholder_add_temp_id = $this->request->getSession()->read('Auth.User.id');
		} else {
			return	$this->redirect($this->Auth->logout());
		}

		$seccCardholderAddTemp = $this->SeccCardholderAddTemps
			->find(
				'all',
				[
					'fields' 	=>
					['id', 'ack_no', 'rgi_district_code', 'applicationType', 'applicationType_rule_id', 'is_bank', 'caste_id', 'application_status', 'non_gov', 'above_sixty', 'marital_status', 'disability_status', 'health_status', 'beggar', 'rag_picker', 'worker', 'street_vendor', 'pvtg', 'old_alone'],
					'conditions' => ['SeccCardholderAddTemps.id=' . "'" . $secc_cardholder_add_temp_id . "'", 'application_status<>7', 'application_status>=5']
				]
			)
			->first();
		if ($seccCardholderAddTemp) {
			$seccFamilyRegistration = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->find('all', ['fields' => 'id', 'conditions' => ['SeccFamilyAddTemps.secc_cardholder_add_temp_id=' . "'" . $seccCardholderAddTemp->id . "'", 'hof' => '1'], 'recursive' => -1])->first();
			if ($seccFamilyRegistration) {
				//$this->loadModel('SeccFamilyDocuments');
				$SeccFamilyDocuments = TableRegistry::getTableLocator()->get('SeccFamilyDocumentAddTemps')->find('list', [
					'keyField' => 'document_type_id',
					'valueField' => 'document'
				])->where(['SeccFamilyDocumentAddTemps.secc_family_add_temp_id=' . "'" . $seccFamilyRegistration->id . "'"])->toArray();
			}
			$seccFamilyDocument = TableRegistry::getTableLocator()->get('SeccFamilyDocumentAddTemps')->newEntity(['validate' => false]);

			if ($this->request->is('post')) {
				$rgi_district_code = $seccCardholderAddTemp->rgi_district_code;
				$ack_no = $seccCardholderAddTemp->ack_no;
				$district_dir = DOC_ABS_PATH . $rgi_district_code;
				$application_dir = $district_dir . DS .  $ack_no;
				if (!file_exists($district_dir)) {
					mkdir($district_dir);
				}
				if (!file_exists($application_dir)) {
					mkdir($application_dir);
				}
				$seccFamilyDocument->secc_cardholder_add_temp_id 		=	$seccCardholderAddTemp->id;
				$seccFamilyDocument->secc_family_add_temp_id			=	$seccFamilyRegistration->id;

				if (isset($this->request->data['upload'])) {
					if ($this->request->data['upload'] == "upload_aadhar") {
						$document_type_id = 18;
						$document_upload_field_name = 'aadhar_doc';
						$filename_prepend = '_UIDDOC';
					} else if ($this->request->data['upload'] == "upload_passbook") {
						$document_type_id = 13;
						$document_upload_field_name = 'bank_passbook';
						$filename_prepend = '_BankDOC';
					} else if ($this->request->data['upload'] == "upload_caste") {
						$document_type_id = 14;
						$document_upload_field_name = 'caste_certificate';
						$filename_prepend = '_CasteDOC';
					} else if ($this->request->data['upload'] == "upload_disability") {
						$document_type_id = 16;
						$document_upload_field_name = 'disability_certificate';
						$filename_prepend = '_DisableDOC';
					} else if ($this->request->data['upload'] == "upload_health") {
						$document_type_id = 15;
						$document_upload_field_name = 'health_certificate';
						$filename_prepend = '_HealthDOC';
					} else if ($this->request->data['upload'] == "upload_death") {
						$document_type_id = 17;
						$document_upload_field_name = 'death_certificate';
						$filename_prepend = '_DeathDOC';
					}
					$seccFamilyDocument->document = $this->request->data[$document_upload_field_name];
					$seccFamilyDocumentAddTemp = $this->SeccCardholderAddTemps->patchEntity($seccFamilyDocument, $seccFamilyDocument->toArray(), ['validate' => 'Document']);

					if (!$seccFamilyDocumentAddTemp->getErrors()) {
						$old_doc_check = TableRegistry::getTableLocator()->get('SeccFamilyDocumentAddTemps')->find()->where(['SeccFamilyDocumentAddTemps.secc_family_add_temp_id' => $seccFamilyRegistration->id, 'document_type_id' => $document_type_id])->first();
						if ($old_doc_check && $old_doc_check->document != '') {
							if (!empty($this->request->data[$document_upload_field_name]['name']) and $this->request->data[$document_upload_field_name]['error'] == 0) {
								$extension = explode('.', $this->request->data[$document_upload_field_name]['name']);
								$extension = end($extension);
								$fileNewName = $ack_no . $filename_prepend . strtotime(date('d-m-Y H:i:s')) . '.' . $extension;
								if (file_exists($application_dir . DS . $old_doc_check->document) && unlink($application_dir . DS . $old_doc_check->document)) {
									if (move_uploaded_file($this->request->data[$document_upload_field_name]['tmp_name'], $application_dir . DS . $fileNewName)) {

										if (TableRegistry::getTableLocator()->get('SeccFamilyDocumentAddTemps')->delete($old_doc_check)) {
											$seccFamilyDocument->document = $fileNewName;
											$seccFamilyDocument->document_type_id = $document_type_id;
											if (TableRegistry::getTableLocator()->get('SeccFamilyDocumentAddTemps')->save($seccFamilyDocument)) {
												$this->Flash->success(__('Document have been uploaded.'));
												return $this->redirect(['action' => 'documentDetails']);
											} else {
												$this->Flash->error(__('Document could not be uploaded. Please, try again.'));
											}
										} else {
											$this->Flash->error(__('Document not uploaded. Please, try again.'));
										}
									} else {
										$this->Flash->error(__('Document not updated. Please, try again.'));
									}
								} else {
									if (move_uploaded_file($this->request->data[$document_upload_field_name]['tmp_name'], $application_dir . DS . $fileNewName)) {

										if (TableRegistry::getTableLocator()->get('SeccFamilyDocumentAddTemps')->delete($old_doc_check)) {
											$seccFamilyDocument->document = $fileNewName;
											$seccFamilyDocument->document_type_id = $document_type_id;
											if (TableRegistry::getTableLocator()->get('SeccFamilyDocumentAddTemps')->save($seccFamilyDocument)) {
												$this->Flash->success(__('Document have been uploaded.'));
												return $this->redirect(['action' => 'documentDetails']);
											} else {
												$this->Flash->error(__('Document could not be uploaded. Please, try again.'));
											}
										} else {
											$this->Flash->error(__('Document not uploaded. Please, try again.'));
										}
									} else {
										$this->Flash->error(__('Document not updated. Please, try again.'));
									}
								}
							}
						} else {
							$seccFamilyDocument->document_type_id = $document_type_id;
							if (!empty($this->request->data[$document_upload_field_name]['name']) and $this->request->data[$document_upload_field_name]['error'] == 0) {
								$extension = explode('.', $this->request->data[$document_upload_field_name]['name']);
								$extension = end($extension);
								$fileNewName = $ack_no . $filename_prepend . strtotime(date('d-m-Y H:i:s')) . '.' . $extension;
								if (move_uploaded_file($this->request->data[$document_upload_field_name]['tmp_name'], $application_dir . DS . $fileNewName)) {
									$seccFamilyDocument->document = $fileNewName;

									if (TableRegistry::getTableLocator()->get('SeccFamilyDocumentAddTemps')->save($seccFamilyDocument)) {
										$this->Flash->success(__('Document have been uploaded.'));
										return $this->redirect(['action' => 'documentDetails']);
									} else {
										$this->Flash->error(__('Document could not be uploaded. Please, try again.'));
									}
								} else {
									$this->Flash->error(__('Document could not be uploaded. Please, try again.'));
								}
							}
						}
					} else {
						$seccFamilyDocument->setError($document_upload_field_name, $seccFamilyDocumentAddTemp->getErrors());
						$this->Flash->error(__('Document could not be uploaded. Please, try again.'));
					}
				} else if ($this->request->data['submit'] == "Save & Next") {
					if (sizeof($SeccFamilyDocuments) <= 0) {
						$this->Flash->error(__('Uploading Aadhar Card is mandatory. Please, try again.'));
					} else {
						$update = $this->SeccCardholderAddTemps->updateAll(['application_status' => '6'], ["id" => $seccCardholderAddTemp->id]);
						$this->Flash->success(__('Documents Uploaded successfully.'));
						return $this->redirect(['controller' => 'SeccCardholderAddTemps', 'action' => 'documentDetails']);
					}
				} else {
					return $this->redirect(['action' => 'documentDetails']);
				}
			}

			$this->set(compact('errors', 'seccFamilyRegistration', 'seccFamilyMember', 'seccFamilyDocument', 'relations', 'genders', 'seccCardholderAddTemp', 'SeccFamilyDocuments'));
		} else {
			return	$this->redirect(['controller' => 'SeccCardholders', 'action' => 'logout']);
		}
	}



	/**
	 * Preview method
	 */
	function preview()
	{

		if ($this->request->getSession()->check('Auth')) {
			$secc_cardholder_add_temp_id = $this->request->getSession()->read('Auth.User.id');
		} else {
			return	$this->redirect($this->Auth->logout());
		}
		$seccCardholderAddTemp = $this->SeccCardholderAddTemps
			->find(
				'all',
				[
					'fields' 	=>
					['id', 'ack_no', 'mobileno', 'uid', 'name', 'name_sl', 'fathername', 'fathername_sl', 'caste_id', 'mothername', 'mothername_sl', 'res_address', 'res_address_hn', 'tolla_mohalla', 'rgi_district_code', 'rgi_block_code',  'rgi_village_code', 'location_id', 'application_status', 'applicationType', 'applicationType_rule_id', 'SeccDistricts.name', 'SeccBlocks.name', 'SeccVillageWards.id', 'Panchayats.name', 'SeccVillageWards.name', 'Dealers.name', 'Dealers.License_no', 'Cardtypes.name', 'is_bank', 'bank_master_id', 'branch_master_id', 'bank_account_no', 'bank_ifsc_code', 'is_lpg', 'lpg_company', 'lpg_consumer_no', 'BankMasters.name', 'BranchMasters.name', 'non_gov', 'above_sixty', 'marital_status', 'disability_status', 'health_status', 'beggar', 'rag_picker', 'worker', 'street_vendor', 'pvtg', 'old_alone'],
					'conditions' => ['SeccCardholderAddTemps.id=' . "'" . $secc_cardholder_add_temp_id . "'", 'application_status<>7', 'application_status>=6'],
					'contain'	=> ['SeccDistricts', 'SeccBlocks', 'Panchayats', 'SeccVillageWards', 'Dealers', 'Cardtypes', 'BankMasters', 'BranchMasters', 'SeccFamilyAddTemps' => ['SeccFamilyDocumentAddTemps' => ['DocumentTypes'], 'Relations']]
				]
			)
			->first();
		if ($seccCardholderAddTemp) {
			$inclusion_criterias 		= TableRegistry::getTableLocator()->get('InclusionCriterias')->find('all', ['fields' => ['id', 'name', 'cardholder_col'], 'conditions' => ['location_id' => $seccCardholderAddTemp->location_id]])->toArray();
			$exclusion_criterias 		= TableRegistry::getTableLocator()->get('ExclusionCriterias')->find('all', ['fields' => ['id', 'name']])->toArray();

			if ($this->request->is(['post'])) {
				$seccCardholderFamilyDetail = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')
					->find(
						'all',
						[
							'fields' 	=>
							['id', 'gender_id', 'marital_status', 'disability_status', 'health_status', 'dob'],
							'conditions' => ['SeccFamilyAddTemps.secc_cardholder_add_temp_id' => $seccCardholderAddTemp->id, 'hof' => 1]
						]
					)
					->first();

				$priority_marks = 0;
				if ($seccCardholderAddTemp->pvtg == 1 || $seccCardholderAddTemp->caste_id == 7) {
					$priority_marks = $priority_marks + 100;
				}
				if ($seccCardholderAddTemp->above_sixty == 1) {
					$priority_marks = $priority_marks + 10;
				}
				if ($seccCardholderAddTemp->marital_status == 1) {
					$priority_marks = $priority_marks + 10;
				}
				if ($seccCardholderAddTemp->disability_status == 1) {
					$priority_marks = $priority_marks + 10;
				}
				if ($seccCardholderAddTemp->health_status == 1) {
					$priority_marks = $priority_marks + 10;
				}
				if ($seccCardholderAddTemp->old_alone == 1) {
					$priority_marks = $priority_marks + 10;
				}
				if ($seccCardholderAddTemp->caste_id == 3 || $seccCardholderAddTemp->caste_id == 4) {
					$priority_marks = $priority_marks + 10;
				}

				$update = $this->SeccCardholderAddTemps->updateAll(['application_status' => '7', 'activity_type_id' => '1', 'activity_flag' => '0', 'priority_marks' => $priority_marks], ["id" => $seccCardholderAddTemp->id]);
				$update = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->updateAll(['activity_type_id' => '1', 'activity_flag' => '0'], ["secc_cardholder_add_temp_id" => $seccCardholderAddTemp->id]);
				return $this->redirect(['controller' => 'SeccCardholderAddTemps', 'action' => 'acknowledgement']);
			}

			$this->set(compact('seccCardholderAddTemp', 'inclusion_criterias', 'exclusion_criterias'));
		} else {
			return	$this->redirect(['controller' => 'SeccCardholders', 'action' => 'logout']);
		}
	}

	/**
	 * Acknowledgement method
	 */
	function acknowledgement()
	{
		if ($this->request->getSession()->check('Auth')) {
			$secc_cardholder_add_temp_id = $this->request->getSession()->read('Auth.User.id');
		} else {
			return	$this->redirect($this->Auth->logout());
		}
		$seccCardholderAddTemp = $this->SeccCardholderAddTemps
			->find(
				'all',
				[
					'fields' 	=>
					['id', 'ack_no', 'mobileno', 'uid', 'name', 'name_sl', 'fathername', 'fathername_sl', 'caste_id', 'mothername', 'mothername_sl', 'res_address', 'res_address_hn', 'tolla_mohalla', 'rgi_district_code', 'rgi_block_code', 'rgi_village_code', 'location_id', 'application_status', 'applicationType', 'applicationType_rule_id', 'SeccDistricts.name', 'SeccBlocks.name', 'SeccVillageWards.id', 'Panchayats.name', 'SeccVillageWards.name', 'Dealers.name', 'Dealers.License_no', 'Cardtypes.name', 'is_bank', 'bank_master_id', 'branch_master_id', 'bank_account_no', 'bank_ifsc_code', 'is_lpg', 'lpg_company', 'lpg_consumer_no', 'BankMasters.name', 'BranchMasters.name', 'non_gov', 'above_sixty', 'marital_status', 'disability_status', 'health_status', 'beggar', 'rag_picker', 'worker', 'street_vendor', 'pvtg', 'old_alone'],
					'conditions' => ['SeccCardholderAddTemps.id=' . "'" . $secc_cardholder_add_temp_id . "'", 'application_status' => 7],
					'contain'	=> ['SeccDistricts', 'SeccBlocks', 'Panchayats', 'SeccVillageWards', 'Dealers', 'Castes', 'Cardtypes', 'BankMasters', 'BranchMasters', 'SeccFamilyAddTemps' => ['Relations']]
				]
			)
			->first();
		if ($seccCardholderAddTemp) {
			$hof_age = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->find('all', ['fields' => ['id', 'dob'], 'conditions' => ['secc_cardholder_add_temp_id' => $secc_cardholder_add_temp_id, 'hof' => 1]])->first();
			$inclusion_criterias 		= TableRegistry::getTableLocator()->get('InclusionCriterias')->find('all', ['fields' => ['id', 'name', 'cardholder_col'], 'conditions' => ['location_id' => $seccCardholderAddTemp->location_id]])->toArray();
			$exclusion_criterias 		= TableRegistry::getTableLocator()->get('ExclusionCriterias')->find('all', ['fields' => ['id', 'name'], 'recursive' => -1])->toArray();


			if ($this->request->is(['post'])) {

				$update = $this->SeccCardholderAddTemps->updateAll(['application_status' => '7'], ["id" => $seccCardholderAddTemp->id]);
				return $this->redirect(['controller' => 'SeccCardholderAddTemps', 'action' => 'acknowledgement']);
			}
			$this->set(compact('seccCardholderAddTemp', 'inclusion_criterias', 'exclusion_criterias', 'hof_age'));
		} else {
			return	$this->redirect(['controller' => 'SeccCardholders', 'action' => 'logout']);
		}
	}

	/**
	 * checkAcknowledgement method
	 */
	public function checkAcknowledgement()
	{
		if ($this->request->getSession()->check('Auth')) {
			$group_id           = $this->request->getSession()->read('Auth.User.group_id');
			$rgi_district_code  = $this->request->getSession()->read('Auth.User.rgi_district_code');
			$rgi_block_code     = $this->request->getSession()->read('Auth.User.rgi_block_code');
		} else {
			return    $this->redirect($this->Auth->logout());
		}

		$this->viewBuilder()->setLayout('admin');
		if ($group_id == 20) {
			if ($this->request->is(['post'])) {
				$this->getRequest()->getSession()->delete('OperatorPendingApp');
				$ack_no = $this->request->getData('ack_no'); //print_r($ack_no);die;die('123');
				
				$check_reg_record            =   TableRegistry::getTableLocator()->get('SeccCardholderAddTemps')->find('all', ['fields' => ['id', 'ack_no', 'application_status', 'rgi_block_code', 'rgi_district_code'], 'conditions' => ['ack_no' => $ack_no, 'activity_type_id' => 1, 'applied_through' => 1]])->first();
				
				if (!empty($check_reg_record) > 0) {
					$application_status 							= 	$check_reg_record->application_status;
					$this->getRequest()->getSession()->write([
						'OperatorPendingApp.id'                     => 	$check_reg_record->id,
						'OperatorPendingApp.ack_no'         		=> 	$check_reg_record->ack_no
					]);

					if ($check_reg_record->rgi_block_code != $rgi_block_code) {
						$this->Flash->error(__('This Application does not belong to your Block.'));
					} else {
						if ($application_status == 1) {
							return $this->redirect(['controller' => 'SeccCardholderAddTemps', 'action' => 'opPersonalDetails']);
						} else if ($application_status == 2) {
							return $this->redirect(['controller' => 'SeccCardholderAddTemps', 'action' => 'opBankDetails']);
						} else if ($application_status == 3) {
							return $this->redirect(['controller' => 'SeccCardholderAddTemps', 'action' => 'opAdditionalDetails']);
						} else if ($application_status == 4) {
							return $this->redirect(['controller' => 'SeccCardholderAddTemps', 'action' => 'opDocumentDetails']);
						} else if ($application_status == 5) {
							return $this->redirect(['controller' => 'SeccCardholderAddTemps', 'action' => 'opAddFamily']);
						} else if ($application_status == 6) {
							return $this->redirect(['controller' => 'SeccCardholderAddTemps', 'action' => 'opPreview']);
						} else if ($application_status == 7) {
							$this->Flash->error(__('Acknowledgement No already Mapped.'));
						} else {
							$this->Flash->error(__('Acknowledgement No not found. Please try again !!!'));
						}
					}
				} else {
					$hhdErcmsPendingNews = TableRegistry::getTableLocator()->get('HhdErcmsPendingNews')
						->find(
							'all',
							[
								'fields' 	 => ['id', 'ack_no' => 'ack_no_ercms', 'mapping_status','rgi_block_code', 'rgi_district_code'],
								'conditions' => ['ack_no_ercms=' . "'" . $ack_no . "'"]
							]
						)
						->first();
						
						if ($hhdErcmsPendingNews->rgi_block_code != $rgi_block_code) {
							$this->Flash->error(__('This Application does not belong to your Block.'));
						} else {	
							if ($hhdErcmsPendingNews) {
								$this->getRequest()->getSession()->write([
									'OperatorPendingApp.id'                      => $hhdErcmsPendingNews->id,
									'OperatorPendingApp.ack_no'                  => $hhdErcmsPendingNews->ack_no
								]);
								return $this->redirect(['controller' => 'SeccCardholderAddTemps', 'action' => 'opPersonalDetails']);
							} else {
								$this->Flash->error(__('Acknowledgement No not found.'));
							} 
						}
				}
			}
		} else {
			$this->Flash->error(__('Unauthorised Access.'));
			return  $this->redirect($this->Auth->logout());
		}
	}

	/**
	 * opPersonalDetails method - operator Mapping
	 */
	public function opPersonalDetails()
	{

		//die('module closed');
		$this->viewBuilder()->setLayout('admin');
		if ($this->request->getSession()->check('OperatorPendingApp')) {
			$hhd_ercms_pending_news_id 	= $this->request->getSession()->read('OperatorPendingApp.id');
			$ack_no 					= $this->request->getSession()->read('OperatorPendingApp.ack_no');
			$rgi_district_code  		= $this->request->getSession()->read('Auth.User.rgi_district_code');
			$rgi_block_code     		= $this->request->getSession()->read('Auth.User.rgi_block_code');			
		} else {
			return	$this->redirect(['controller' => 'SeccCardholderAddTemps', 'action' => 'checkAcknowledgement']);
		}
		$Ercms = new ErcmsValidateController;
		$seccCardholderAddTemp = TableRegistry::getTableLocator()->get('SeccCardholderAddTemps')
			->find(
				'all',
				[
					'fields' 	=>
					['id', 'ack_no', 'mobileno' => 'mobileno', 'uid', 'name', 'name_sl', 'fathername', 'fathername_sl', 'mothername', 'mothername_sl', 'rgi_district_code', 'rgi_block_code', 'rgi_village_code', 'marital_status', 'health_status', 'disability_status', 'res_address', 'tolla_mohalla', 'occupationId', 'caste_id', 'application_status'],
					'conditions' => ['SeccCardholderAddTemps.ack_no' => $ack_no,'application_status<>7','SeccCardholderAddTemps.rgi_district_code' => $rgi_district_code, 'SeccCardholderAddTemps.rgi_block_code' => $rgi_block_code]
				]
			)
			->first();
			

		if (!$seccCardholderAddTemp) {
			$seccCardholderAddTemp = TableRegistry::getTableLocator()->get('HhdErcmsPendingNews')
				->find(
					'all',
					[
						'fields' 	=>
						['id', 'ack_no' => 'ack_no_ercms', 'dealer_id', 'rgi_district_code', 'rgi_block_code', 'rgi_village_code', 'name', 'name_sl', 'fathername', 'fathername_sl', 'mothername', 'mothername_sl', 'relation_id', 'relation_sl', 'gender_id', 'dob', 'mobileno' => 'mobile', 'hof', 'accountNo', 'bank_master_id', 'branch_master_id', 'panchayat_id',  'uid', 'districtName', 'blockName', 'villageName'],
						'conditions' => ['HhdErcmsPendingNews.id' => $hhd_ercms_pending_news_id, 'HhdErcmsPendingNews.rgi_district_code' => $rgi_district_code, 'HhdErcmsPendingNews.rgi_block_code' => $rgi_block_code]
					]
				)
				->first();
				
				$seccCardholderAddTemp->dob ='';
				$seccCardholderAddTempNewEntity = TableRegistry::getTableLocator()->get('SeccCardholderAddTemps')->newEntity();
				$SeccFamilyAddTempsReg = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->newEntity();
		} else {						
			$hof_gender_dob = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->find('all', ['fields' => ['id','gender_id', 'dob'], 'conditions' => ['secc_cardholder_add_temp_id' => $seccCardholderAddTemp->id, 'hof' => 1, 'SeccFamilyAddTemps.rgi_district_code' => $rgi_district_code, 'SeccFamilyAddTemps.rgi_block_code' => $rgi_block_code]])->first();
			$secc_family_add_temp_id=$hof_gender_dob->id;
			$seccCardholderAddTemp->gender_id = $hof_gender_dob->gender_id;
			$seccCardholderAddTemp->dob = $hof_gender_dob->dob;

			$seccCardholderAddTemp->districtName = TableRegistry::getTableLocator()->get('SeccDistricts')->find('list', ['fields' => ['name'], 'conditions' => ['rgi_district_code' => $seccCardholderAddTemp->rgi_district_code]])->first();
			$seccCardholderAddTemp->blockName = TableRegistry::getTableLocator()->get('SeccBlocks')->find('list', ['fields' => ['name'], 'conditions' => ['rgi_block_code' => $seccCardholderAddTemp->rgi_block_code]])->first();
			$seccCardholderAddTemp->villageName = TableRegistry::getTableLocator()->get('SeccVillageWards')->find('list', ['fields' => ['name'], 'conditions' => ['rgi_village_code' => $seccCardholderAddTemp->rgi_village_code]])->first();
			$seccCardholderAddTempNewEntity = $seccCardholderAddTemp;
			$SeccFamilyAddTempsReg = $seccCardholderAddTemp;
		}
		
		if ($seccCardholderAddTemp) {
			if ($this->request->is(['patch', 'post', 'put'])) {				
				if ($seccCardholderAddTemp['rgi_district_code'] != '' && $seccCardholderAddTemp['rgi_block_code'] != '') {
					$location_query = 	TableRegistry::getTableLocator()->get('SeccBlocks')->find('all', ['fields' => 'location_id', 'conditions' => ['rgi_district_code' => $seccCardholderAddTemp['rgi_district_code'], 'rgi_block_code' => $seccCardholderAddTemp['rgi_block_code']]])->first();
					$location_id	=	$location_query->location_id;
				} else {
					$location_id = '';
				}

				/*Secc Cardholders add temp Entity*/
				/********** Start : Get Acknowledgement Number *********/
				//$acknowledgementNo =  $Ercms->acknowledgementNo($this->request->data['rgi_district_code'], '1');
				/********** End : Get Acknowledgement Number *********/
				$SeccCardholderAddRegData = array(
					'ack_no'				=>	$ack_no,
					'name'					=>	ucwords($seccCardholderAddTemp['name']),
					'name_sl'				=>	$seccCardholderAddTemp['name_sl'],
					'fathername'			=>	ucwords($seccCardholderAddTemp['fathername']),
					'fathername_sl'			=>	$seccCardholderAddTemp['fathername_sl'],
					'fathername_sl'			=>	$seccCardholderAddTemp['fathername_sl'],
					'mothername'			=>	$seccCardholderAddTemp['mothername'],
					'mothername_sl'			=>	$seccCardholderAddTemp['mothername_sl'],
					'gender_id'				=>	strval($seccCardholderAddTemp['gender_id']),
					'mobileno'				=>	$seccCardholderAddTemp['mobileno'],
					'requested_mobile'		=>	$seccCardholderAddTemp['mobileno'],
					'rgi_district_code'		=>	$seccCardholderAddTemp['rgi_district_code'],
					'rgi_block_code'		=>	$seccCardholderAddTemp['rgi_block_code'],
					'districtName'			=>	$seccCardholderAddTemp['districtName'],
					'blockName'				=>	$seccCardholderAddTemp['blockName'],
					'villageName'			=>	$seccCardholderAddTemp['villageName'],
					'dealer_id'				=>	$seccCardholderAddTemp['dealer_id'],
					'panchayat_id'			=>	$seccCardholderAddTemp['panchayat_id'],
					'location_id'			=>	$location_id,
					'rgi_village_code'		=>	$seccCardholderAddTemp['rgi_village_code'],
					'uid'					=>	$seccCardholderAddTemp['uid'],
					'is_bank'				=> ($seccCardholderAddTemp->accountNo == '') ? 0 : 1,
					'bank_master_id'		=>	$seccCardholderAddTemp['bank_master_id'],
					'branch_master_id'		=>	$seccCardholderAddTemp['branch_master_id'],
					'bank_account_no'		=>	$seccCardholderAddTemp['accountNo'],
					'caste_id' 				=>	$this->request->data['caste_id'],
					'res_address'			=>	$this->request->data['res_address'],
					'tolla_mohalla'			=>	$this->request->data['tolla_mohalla'],
					'occupationId'			=>	$this->request->data['occupationId'],
					'marital_status'		=>	$this->request->data['marital_status'],
					'disability_status'		=>	$this->request->data['disability_status'],
					'health_status'			=>	$this->request->data['health_status'],
					'application_status'	=> ($seccCardholderAddTemp->application_status < 2) ? 2 : $seccCardholderAddTemp->application_status,
					'created'				=>	date('Y-m-d H:i:s'),
					'applied_through'		=>	'1',
					'activity_type_id'		=>	'1',
					'activity_flag'			=>	'0'
				);
				
				/*Secc Family add temp Entity*/
				$SeccFamilyAddTempsRegData = array(
					'name'					=>	ucwords($seccCardholderAddTemp['name']),
					'name_sl'				=>	$seccCardholderAddTemp['name_sl'],
					'fathername'			=>	ucwords($seccCardholderAddTemp['fathername']),
					'fathername_sl'			=>	$seccCardholderAddTemp['fathername_sl'],
					'mothername'			=>	$seccCardholderAddTemp['fathername_sl'],
					'mothername_sl'			=>	$seccCardholderAddTemp['mothername'],
					'relation_id'			=>	$seccCardholderAddTemp['relation_id'],
					'relation_sl'			=>	$seccCardholderAddTemp['relation_sl'],
					'mobile'				=>	$seccCardholderAddTemp['mobileno'],
					'requested_mobile'		=>	$seccCardholderAddTemp['mobileno'],
					'gender_id'				=>	strval($seccCardholderAddTemp['gender_id']),
					'dob'					=>	$this->request->data['dob'],//$seccCardholderAddTemp['dob'],
					'uid'					=>	$seccCardholderAddTemp['uid'],
					'rgi_district_code'		=>	$seccCardholderAddTemp['rgi_district_code'],
					'rgi_block_code'		=>	$seccCardholderAddTemp['rgi_block_code'],
					'rgi_village_code'		=>	$seccCardholderAddTemp['rgi_village_code'],
					'marital_status'		=>	$this->request->data['marital_status'],
					'disability_status'		=>	$this->request->data['disability_status'],
					'health_status'			=>	$this->request->data['health_status'],
					'ack_no_ercms'			=>	$ack_no,
					'created'				=>	date('Y-m-d H:i:s'),
					'hof'					=>	'1',
					'relation_id'			=>	'1',
					'activity_type_id'		=>	'1',
					'activity_flag'			=>	'0',
				);

				$seccCardholderAddTemp = $this->SeccCardholderAddTemps->patchEntity($seccCardholderAddTempNewEntity, $SeccCardholderAddRegData, ['validate' => 'Opregister']);
							
				/********** Start : Aadhar valid format and duplicacy Check ****************/
				
				if ($seccCardholderAddTemp['uid'] != '') {
					if (!$uiderror = $Ercms->checkuid($seccCardholderAddTemp['uid'])) {
						//$seccCardholderAddTemp->setError('uid', ['Invalid Aadhar Number']);
					} else if (($uiderror = $Ercms->checkopaadhar($seccCardholderAddTemp['uid'],$secc_family_add_temp_id)) != null) {debug($seccCardholderAddTemp['uid']);
						$Ercms = new ErcmsValidateController;
						$obj = json_decode($uiderror, true);
						if ($obj['valid'] != false) {
							if (array_key_exists('Acknowledgement No', $obj['data'])) {
								$head = 'Acknowledgement No';
							} else if (array_key_exists('Ration Card No', $obj['data'])) {
								$head = 'Ration Card No';
							} else {
								$head = '';
							}
							//$seccCardholderAddTemp->setError('uid', ['Aadhar Number already exists for ' . $head . ' : ' . $obj["data"][$head]]);
							$seccCardholderAddTemp->setError('uid', ['Aadhar Number already exists, Please contact DSO office.']);
						}
					}
				} else {
					$seccCardholderAddTemp->setError('uid', ['This field cannot be left empty']);
				}
				/********** End : Aadhar valid format Check ****************/
				/********** End : Mobile duplicacy Check ****************/
				if ($seccCardholderAddTemp['mobileno'] != '') {
					if (($mobile_error = $Ercms->checkopDuplicateMobile($seccCardholderAddTemp['mobileno'])) != null) {
						$mobileobj = json_decode($mobile_error, true);
						if ($mobileobj['valid'] != false) {
							if (array_key_exists('Acknowledgement No', $mobileobj['data'])) {
								$mob_head = 'Acknowledgement No';
							} else if (array_key_exists('Ration Card No', $mobileobj['data'])) {
								$mob_head = 'Ration Card No';
							} else {
								$mob_head = '';
							}
							//$seccCardholderAddTemp->setError('mobileno', ['Mobile Number already exists for ' . $mob_head . ' : ' . $mobileobj["data"][$mob_head]]);
							$seccCardholderAddTemp->setError('mobileno', ['Mobile Number already exists, Please contact DSO office.']);
						}
					}
				} else {
					$seccCardholderAddTemp->setError('mobileno', ['This field cannot be left empty']);
				}
				
				/********** End : Mobile number duplicacy Check ****************/
				if (!$seccCardholderAddTemp->getErrors()) {
					if ($seccCardholderAddTemp_insert = $this->SeccCardholderAddTemps->save($seccCardholderAddTemp)) {
						$SeccFamilyAddTempsRegData['secc_cardholder_add_temp_id'] =	$seccCardholderAddTemp_insert->id;
						$SeccFamilyAddTempsReg = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->patchEntity($SeccFamilyAddTempsReg, $SeccFamilyAddTempsRegData, ['validate' => false]);
						if (TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->save($SeccFamilyAddTempsReg)) {
							TableRegistry::getTableLocator()->get('HhdErcmsPendingNews')->updateAll(['mapping_status' => '1'], ["id" => $hhd_ercms_pending_news_id]);
							$this->Flash->success(__('Personal Details Saved Successfully.'));
							return $this->redirect(['controller' => 'SeccCardholderAddTemps', 'action' => 'opPersonalDetails']);
						} else {
							$this->Flash->error(__('The details could not be saved. Please, try again.'));
						}
					} else {
						$this->Flash->error(__('The details could not be saved. Please, try again.'));
					}
				} else {				
					$this->Flash->error(__('The details could not be saved. Please, try again.'));
				}
			}

			$seccDistricts = TableRegistry::getTableLocator()->get('SeccDistricts')->find('list', [
				'keyField' => 'rgi_district_code',
				'valueField' => 'name'
			]);
			$castes = TableRegistry::getTableLocator()->get('Castes')->find('list', ['limit' => 20]);

			$this->set(compact('seccCardholderAddTemp', 'seccDistricts', 'SeccCardholderAddReg', 'castes'));
		} else {
			$this->Flash->error(__('Record Not Found. Please, try again.'));
			return	$this->redirect(['controller' => 'SeccCardholderAddTemps', 'action' => 'checkAcknowledgement']);
		}
	}
	/**
	 * Add opBankDetails method
	 *
	 */
	public function opBankDetails()
	{
		$this->viewBuilder()->setLayout('admin');
		if ($this->request->getSession()->check('OperatorPendingApp')) {
			//$hhd_ercms_pending_news_id = $this->request->getSession()->read('OperatorPendingApp.id');
			$ack_no = $this->request->getSession()->read('OperatorPendingApp.ack_no');
			$rgi_district_code  		= $this->request->getSession()->read('Auth.User.rgi_district_code');
			$rgi_block_code     		= $this->request->getSession()->read('Auth.User.rgi_block_code');
		} else {
			return	$this->redirect(['controller' => 'SeccCardholderAddTemps', 'action' => 'checkAcknowledgement']);
		}

		$seccCardholderAddTemp = $this->SeccCardholderAddTemps
			->find(
				'all',
				[
					'fields' 	=>
					['id', 'ack_no', 'mobileno', 'uid', 'name', 'name_sl', 'is_lpg', 'lpg_company', 'lpg_consumer_no', 'is_bank', 'caste_id', 'bank_account_no', 'bank_master_id', 'branch_master_id', 'bank_ifsc_code', 'application_status'],
					'conditions' => ['SeccCardholderAddTemps.ack_no=' . "'" . $ack_no . "'", 'application_status<>7', 'application_status>=2','SeccCardholderAddTemps.rgi_district_code' => $rgi_district_code, 'SeccCardholderAddTemps.rgi_block_code' => $rgi_block_code],
					'contain' => ['BankMasters', 'BranchMasters']
				]
			)
			->first();
		if ($seccCardholderAddTemp) {
			if ($this->request->is(['patch', 'post', 'put'])) {
				$seccCardholderAddTempData = array(
					'is_lpg'		=>	$this->request->data['is_lpg'],
					'is_bank'		=>	$this->request->data['is_bank'],
				);

				if ($seccCardholderAddTempData['is_lpg'] == 1) {
					$seccCardholderAddTempData['lpg_company'] 			=	$this->request->data['lpg_company'];
					$seccCardholderAddTempData['lpg_consumer_no'] 		=	$this->request->data['lpg_consumer_no'];
				} else {
					$seccCardholderAddTempData['lpg_company'] 			=	'';
					$seccCardholderAddTempData['lpg_consumer_no']		=	'';
				}
				if ($seccCardholderAddTempData['is_bank'] == 1) {
					$seccCardholderAddTempData['bank_account_no']		=	$this->request->data['bank_account_no'];
					$seccCardholderAddTempData['bank_master_id']		=	$this->request->data['bank_master_id'];
					$seccCardholderAddTempData['branch_master_id']		=	$this->request->data['branch_master_id'];
					$seccCardholderAddTempData['bank_ifsc_code']		=	$this->request->data['bank_ifsc_code'];
				} else {
					$seccCardholderAddTempData['bank_account_no'] 		=	'';
					$seccCardholderAddTempData['bank_master_id']		=	'';
					$seccCardholderAddTempData['branch_master_id']		=	'';
					$seccCardholderAddTempData['bank_ifsc_code']		=	'';
				}
				if ($seccCardholderAddTemp->application_status < 3) {
					$seccCardholderAddTempData['application_status']	=	'3';
				}
				$seccCardholderAddTemp = $this->SeccCardholderAddTemps->patchEntity($seccCardholderAddTemp, $seccCardholderAddTempData, ['validate' => 'Bank']);
				
				if ($this->SeccCardholderAddTemps->save($seccCardholderAddTemp)) {
					$this->Flash->success(__('The Bank details & LPG Connection Details has been saved.'));
					return $this->redirect(['controller' => 'SeccCardholderAddTemps', 'action' => 'opBankDetails']);
				}
				$this->Flash->error(__('The Bank details & LPG Connection Details could not be saved. Please, try again.'));
			}

			$bankNames	=	TableRegistry::getTableLocator()->get('BankMasters')->find('list', ['fields' => ['id' => 'BankMasters.bank_code', 'BankMasters.name']])->toArray();
			$this->set(compact('seccCardholderAddTemp', 'bankNames'));
		} else {
			return	$this->redirect(['controller' => 'SeccCardholderAddTemps', 'action' => 'checkAcknowledgement']);
		}
	}

	/**
	 * Add opAdditionalDetails method - operator Mapping
	 *
	 * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
	 */
	public function opAdditionalDetails()
	{
		$this->viewBuilder()->setLayout('admin');
		if ($this->request->getSession()->check('OperatorPendingApp')) {
			$ack_no = $this->request->getSession()->read('OperatorPendingApp.ack_no');
		} else {
			return	$this->redirect(['controller' => 'SeccCardholderAddTemps', 'action' => 'checkAcknowledgement']);
		}

		$seccCardholderAddTemp = $this->SeccCardholderAddTemps
			->find(
				'all',
				[
					'fields' 	=>
					['id', 'ack_no', 'mobileno', 'uid', 'name', 'name_sl', 'applicationType', 'applicationType_rule_id', 'cardtype_id', 'dealer_id', 'caste_id', 'rgi_block_code', 'rgi_district_code', 'location_id', 'application_status', 'non_gov', 'above_sixty', 'marital_status', 'disability_status', 'health_status', 'beggar', 'rag_picker', 'worker', 'street_vendor', 'pvtg', 'old_alone'],
					'conditions' => ['SeccCardholderAddTemps.ack_no=' . "'" . $ack_no . "'", 'application_status<>7', 'application_status>=3']
				]
			)
			->first();

		if ($seccCardholderAddTemp) {
			if ($this->request->is(['patch', 'post', 'put'])) {
				//$seccCardholderAddTemp->applicationType 				=	$this->request->data['applicationType'];
				$seccCardholderAddTemp->cardtype_id						=	8; //$this->request->data['cardtype_id'];
				$seccCardholderAddTemp->dealer_id						=	$this->request->data['dealer_id'];
				$seccCardholderAddTemp->applicationType_rule_id			=	'';
				$seccCardholderAddTemp->non_gov 						= 	0;
				$seccCardholderAddTemp->above_sixty 					= 	0;
				$seccCardholderAddTemp->marital_status 					= 	0;
				$seccCardholderAddTemp->disability_status 				= 	0;
				$seccCardholderAddTemp->health_status 					= 	0;
				$seccCardholderAddTemp->rag_picker 						= 	0;
				$seccCardholderAddTemp->worker 							= 	0;
				$seccCardholderAddTemp->street_vendor 					= 	0;
				$seccCardholderAddTemp->pvtg 							= 	0;
				$seccCardholderAddTemp->old_alone 						= 	0;
				if (isset($this->request->data['inclusion_criteria'])) {
					foreach ($this->request->data['inclusion_criteria'] as $key => $inclusion) {
						$seccCardholderAddTemp->$key					= 	'1'; //$inclusion;
					}
				}
				if ($seccCardholderAddTemp->application_status < 4) {
					$seccCardholderAddTemp->application_status			=	'4';
				}
				if ($seccCardholderAddTemp->pvtg == 1 && $seccCardholderAddTemp->caste_id != 7) {
					$this->Flash->error(__('You cannot select PVTG as you inclusion criteria for Ration Card as you have not selected PVTG as your caste at the time of registration.'));
					return $this->redirect(['controller' => 'seccCardholderAddTemps', 'action' => 'additionalDetails']);
				} else if ($seccCardholderAddTemp->occupation_id != 6 && $seccCardholderAddTemp->beggar == 1) {
					$this->Flash->error(__('You have selected beggar criteria for Ration Card. Please select beggar as your occupation in personal details.'));
					return $this->redirect(['controller' => 'seccCardholderAddTemps', 'action' => 'additionalDetails']);
				} else if ($seccCardholderAddTemp->occupation_id == 1 && $seccCardholderAddTemp->non_gov == 1) {
					$this->Flash->error(__('You have selected non goverment employee criteria for Ration Card. Please select non goverment employee as your occupation in personal details.'));
					return $this->redirect(['controller' => 'seccCardholderAddTemps', 'action' => 'additionalDetails']);
				} else if ($seccCardholderAddTemp->occupation_id != 7 && $seccCardholderAddTemp->rag_picker == 1) {
					$this->Flash->error(__('You have selected ragpicker criteria for Ration Card. Please select ragpicker as your occupation in personal details.'));
					return $this->redirect(['controller' => 'seccCardholderAddTemps', 'action' => 'additionalDetails']);
				} else if ($seccCardholderAddTemp->occupation_id != 8 && $seccCardholderAddTemp->worker == 1) {
					$this->Flash->error(__('You have selected  Construction Worker/Mason/Unskilled Labour/Domestic Worker/Coolie and other head load worker/Rickshaw Puller/Thela Puller criteria for Ration Card. Please select  your occupation same in personal details.'));
					return $this->redirect(['controller' => 'seccCardholderAddTemps', 'action' => 'additionalDetails']);
				} else if ($seccCardholderAddTemp->occupation_id != 9 && $seccCardholderAddTemp->street_vendor == 1) {
					$this->Flash->error(__('You have selected  Street Vendor/Hawker/Peon in Small Establishment/Security Guard/Painter/Welder/Electrician/Mechanic/Tailor/Plumber/Mali/Washermen/cobbler criteria for Ration Card. Please select  your occupation same in personal details.'));
					return $this->redirect(['controller' => 'seccCardholderAddTemps', 'action' => 'additionalDetails']);
				}

				$seccCardholderAddTemp = $this->SeccCardholderAddTemps->patchEntity($seccCardholderAddTemp, $seccCardholderAddTemp->toArray(), ['validate' => 'additional']);

				if (!$seccCardholderAddTemp->getErrors()) {
					if ($this->SeccCardholderAddTemps->save($seccCardholderAddTemp)) {
						$this->Flash->success(__('The additional details has been saved.'));
						return $this->redirect(['controller' => 'SeccCardholderAddTemps', 'action' => 'opAdditionalDetails']);
					}
					$this->Flash->error(__('The additional details could not be saved. Please, try again.'));
				} else {
					$this->Flash->error(__('The additional details could not be saved. Please, try again.'));
				}
			}

			$cardtypes 					= TableRegistry::getTableLocator()->get('Cardtypes')->find('list');
			$inclusion_criterias 		= TableRegistry::getTableLocator()->get('InclusionCriterias')->find('all', ['fields' => ['id', 'name', 'cardholder_col'], 'conditions' => ['location_id' => $seccCardholderAddTemp->location_id]])->toArray();
			$exclusion_criterias 		= TableRegistry::getTableLocator()->get('ExclusionCriterias')->find('all', ['fields' => ['id', 'name']])->toArray();


			$dealers = TableRegistry::getTableLocator()->get('Dealers')->find('list', ['conditions' => ['Dealers.rgi_district_code=' . "'" . $seccCardholderAddTemp->rgi_district_code . "'", 'Dealers.rgi_block_code=' . "'" . $seccCardholderAddTemp->rgi_block_code . "'"]]);
			$hof_gender = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->find('all', ['fields' => ['gender_id'], 'conditions' => ['secc_cardholder_add_temp_id' => $seccCardholderAddTemp->id, 'hof' => 1]])->first();

			$this->set(compact('seccCardholderAddTemp',  'cardtypes',  'dealers', 'exclusion_criterias', 'inclusion_criterias', 'hof_gender'));
		} else {
			return	$this->redirect(['controller' => 'SeccCardholderAddTemps', 'action' => 'checkAcknowledgement']);
		}
	}

	/**
	 * Add Family Member method - operator Mapping
	 *
	 * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
	 */
	function opAddFamily()
	{
		$this->viewBuilder()->setLayout('admin');
		if ($this->request->getSession()->check('OperatorPendingApp')) {
			//$hhd_ercms_pending_news_id = $this->request->getSession()->read('OperatorPendingApp.id');
			$ack_no = $this->request->getSession()->read('OperatorPendingApp.ack_no');
		} else {
			return	$this->redirect(['controller' => 'SeccCardholderAddTemps', 'action' => 'checkAcknowledgement']);
		}

		$seccCardholderAddTemp = TableRegistry::getTableLocator()
			->get('SeccCardholderAddTemps')
			->find(
				'all',
				[
					'fields' 	=>
					['id', 'ack_no', 'mobileno', 'uid', 'name', 'name_sl', 'application_status', 'applicationType', 'applicationType_rule_id', 'rgi_district_code', 'rgi_block_code', 'rgi_village_code', 'non_gov', 'above_sixty', 'marital_status', 'disability_status', 'health_status', 'beggar', 'rag_picker', 'worker', 'street_vendor', 'pvtg', 'old_alone'],
					'conditions' => ['SeccCardholderAddTemps.ack_no=' . "'" . $ack_no . "'", 'application_status<>7', 'application_status>=4']
				]
			)
			->first();
		if ($seccCardholderAddTemp) {
			$seccFamilyAddTemp = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->newEntity();
			if ($this->request->is(['post','put'])) {
				$rgi_district_code = $seccCardholderAddTemp->rgi_district_code;
				$ack_no = $seccCardholderAddTemp->ack_no;
				$district_dir = DOC_ABS_PATH . $rgi_district_code;
				$application_dir = $district_dir . DS .  $ack_no;

				if (!file_exists($district_dir)) {
					mkdir($district_dir);
				}
				if (!file_exists($application_dir)) {
					mkdir($application_dir);
				}
				if ($this->request->data['Submit'] == 'savemember') {
					if ($seccCardholderAddTemp->old_alone != 1) {
						$seccFamilyAddTempData 										= $this->request->getData();
						$seccFamilyAddTempData['secc_cardholder_add_temp_id'] 		= $seccCardholderAddTemp->id;
						$seccFamilyAddTempData['rgi_district_code'] 				= $seccCardholderAddTemp->rgi_district_code;
						$seccFamilyAddTempData['rgi_block_code'] 					= $seccCardholderAddTemp->rgi_block_code;
						$seccFamilyAddTempData['rgi_village_code'] 					= $seccCardholderAddTemp->rgi_village_code;
						$seccFamilyAddTempData['name'] 								= ucwords($this->request->data['name']);
						$seccFamilyAddTempData['fathername'] 						= ucwords($this->request->data['fathername']);
						$seccFamilyAddTempData['ack_no_ercms'] 						= $ack_no;
						$seccFamilyAddTempData['activity_type_id'] 					= 1;
						$seccFamilyAddTempData['activity_flag'] 					= 0;
						$seccFamilyAddTempData['document'] 							= $this->request->data['aadhar_doc'];

						$seccFamilyAddTemp = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->patchEntity($seccFamilyAddTemp, $seccFamilyAddTempData);

						/********** Start : Aadhar valid format and duplicacy Check ****************/
						$Ercms = new ErcmsValidateController;
						if ($seccFamilyAddTempData['uid'] != '') {
							if (!$uiderror = $Ercms->checkuid($this->request->data['uid'])) {
								$seccFamilyAddTemp->setError('uid', ['Invalid Aadhar Number']);
							} else if (($uiderror = $Ercms->checkopaadhar($this->request->data['uid'])) != null) {
								$obj = json_decode($uiderror, true);
								if ($obj['valid'] != false) {
									if (array_key_exists('Acknowledgement No', $obj['data'])) {
										$head = 'Acknowledgement No';
									} else if (array_key_exists('Ration Card No', $obj['data'])) {
										$head = 'Ration Card No';
									} else {
										$head = '';
									}
									//$seccFamilyAddTemp->setError('uid', ['Aadhar Number already exists for ' . $head . ' : ' . $obj["data"][$head]]);
									$seccFamilyAddTemp->setError('uid', ['Aadhar Number already exists, Please contact DSO office.']);
								}
							}
						} else {
							$seccFamilyAddTemp->setError('uid', ['This field cannot be left empty']);
						}
						/********** End : Aadhar valid format nd duplicacy Check ****************/
						/********** Start : Mobile number duplicacy Check ****************/
						if ($seccFamilyAddTempData['mobile'] != '') {
							if (($mobile_error = $Ercms->checkopDuplicateMobile($this->request->data['mobile'])) != null) {
								$mobileobj = json_decode($mobile_error, true);
								if ($mobileobj['valid'] != false) {
									if (array_key_exists('Acknowledgement No', $mobileobj['data'])) {
										$mob_head = 'Acknowledgement No';
									} else if (array_key_exists('Ration Card No', $mobileobj['data'])) {
										$mob_head = 'Ration Card No';
									} else {
										$mob_head = '';
									}
									//$seccFamilyAddTemp->setError('mobile', ['Mobile Number already exists for ' . $mob_head . ' : ' . $mobileobj["data"][$mob_head]]);
									$seccFamilyAddTemp->setError('mobile', ['Mobile Number already exists, Please contact DSO office.']);
								}
							}
						} else {
							$seccFamilyAddTemp->setError('mobile', ['This field cannot be left empty']);
						}
						/********** End : Mobile number duplicacy Check ****************/

						if (!$seccFamilyAddTemp->getErrors()) {
							/********** Start : Uploading Document & saving Data****************/
							$seccFamilyDocument 										= TableRegistry::getTableLocator()->get('SeccFamilyDocumentAddTemps')->newEntity();
							$seccFamilyDocument->secc_cardholder_add_temp_id 			=	$seccCardholderAddTemp->id;
							$seccFamilyDocument->document_type_id						= '18';
							if (!empty($this->request->data['aadhar_doc']['name']) and $this->request->data['aadhar_doc']['error'] == 0) {
								$extension = explode('.', $this->request->data['aadhar_doc']['name']);
								$extension = end($extension);
								$fileNewName = $ack_no . '_UIDDOC' . strtotime(date('d-m-Y H:i:s')) . '.' . $extension;
								if (move_uploaded_file($this->request->data['aadhar_doc']['tmp_name'], $application_dir . DS . $fileNewName)) {
									$seccFamilyDocument->document = $fileNewName;
									if ($inserted_id = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->save($seccFamilyAddTemp)) {
										$seccFamilyDocument->secc_family_add_temp_id			=	$inserted_id->id;
										TableRegistry::getTableLocator()->get('SeccFamilyDocumentAddTemps')->save($seccFamilyDocument);
										$this->Flash->success(__('The secc family add temp has been saved.'));
										return $this->redirect(['action' => 'opAddFamily']);
									} else {
										$this->Flash->error(__('The family Member could not be saved. Please, try again.'));
									}
								} else {
									$this->Flash->error(__('The family Member could not be saved. Please, try again.'));
								}
							}
						} else {
							$this->Flash->error(__('The family Member could not be saved. Please, try again.'));
						}
						/********** End : Uploading Document & saving Data****************/
					} else {
						$this->Flash->error(__('You cannot add family Member as you have selected single family in inclusion criteria.'));
					}
				} else if ($this->request->data['Submit'] == 'saveopmember') {
					if ($seccCardholderAddTemp->old_alone != 1) {
						$seccFamilyAddTempData 										= $this->request->getData();
						$seccFamilyAddTempData['secc_cardholder_add_temp_id'] 		= $seccCardholderAddTemp->id;
						$seccFamilyAddTempData['rgi_district_code'] 				= $seccCardholderAddTemp->rgi_district_code;
						$seccFamilyAddTempData['rgi_block_code'] 					= $seccCardholderAddTemp->rgi_block_code;
						$seccFamilyAddTempData['rgi_village_code'] 					= $seccCardholderAddTemp->rgi_village_code;
						$seccFamilyAddTempData['name'] 								= ucwords($this->request->data['name']);
						$seccFamilyAddTempData['fathername'] 						= ucwords($this->request->data['fathername']);
						$seccFamilyAddTempData['ack_no_ercms'] 						= $ack_no;
						$seccFamilyAddTempData['activity_type_id'] 					= 1;
						$seccFamilyAddTempData['activity_flag'] 					= 0;
						$seccFamilyAddTempData['document'] 							= $this->request->data['aadhar_doc'];

						$seccFamilyAddTemp = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->patchEntity($seccFamilyAddTemp, $seccFamilyAddTempData);

						/********** Start : Aadhar valid format and duplicacy Check ****************/
						$Ercms = new ErcmsValidateController;
						if ($seccFamilyAddTempData['uid'] != '') {
							if (!$uiderror = $Ercms->checkuid($this->request->data['uid'])) {
								$seccFamilyAddTemp->setError('uid', ['Invalid Aadhar Number']);
							} else if (($uiderror = $Ercms->checkopaadhar($this->request->data['uid'])) != null) {
								$obj = json_decode($uiderror, true);
								if ($obj['valid'] != false) {
									if (array_key_exists('Acknowledgement No', $obj['data'])) {
										$head = 'Acknowledgement No';
									} else if (array_key_exists('Ration Card No', $obj['data'])) {
										$head = 'Ration Card No';
									} else {
										$head = '';
									}
									//$seccFamilyAddTemp->setError('uid', ['Aadhar Number already exists for ' . $head . ' : ' . $obj["data"][$head]]);
									$seccFamilyAddTemp->setError('uid', ['Aadhar Number already exists, Please contact DSO office.']);
								}
							}
						} else {
							$seccFamilyAddTemp->setError('uid', ['This field cannot be left empty']);
						}
						/********** End : Aadhar valid format nd duplicacy Check ****************/
						/********** Start : Mobile number duplicacy Check ****************/
						/*if ($seccFamilyAddTempData['mobile'] != '') {
							if (($mobile_error = $Ercms->checkopDuplicateMobile($this->request->data['mobile'])) != null) {
								$mobileobj = json_decode($mobile_error, true);
								if ($mobileobj['valid'] != false) {
									if (array_key_exists('Acknowledgement No', $mobileobj['data'])) {
										$mob_head = 'Acknowledgement No';
									} else if (array_key_exists('Ration Card No', $mobileobj['data'])) {
										$mob_head = 'Ration Card No';
									} else {
										$mob_head = '';
									}
									//$seccFamilyAddTemp->setError('mobile', ['Mobile Number already exists for ' . $mob_head . ' : ' . $mobileobj["data"][$mob_head]]);
									$seccFamilyAddTemp->setError('mobile', ['Mobile Number already exists, Please contact DSO office.']);
								}
							}
						} else {
							$seccFamilyAddTemp->setError('mobile', ['This field cannot be left empty']);
						}*/
						/********** End : Mobile number duplicacy Check ****************/

						if (!$seccFamilyAddTemp->getErrors()) {
							/********** Start : Uploading Document & saving Data****************/
							$seccFamilyDocument 										= TableRegistry::getTableLocator()->get('SeccFamilyDocumentAddTemps')->newEntity();
							$seccFamilyDocument->secc_cardholder_add_temp_id 			=	$seccCardholderAddTemp->id;
							$seccFamilyDocument->document_type_id						= '18';
							if (!empty($this->request->data['aadhar_doc']['name']) and $this->request->data['aadhar_doc']['error'] == 0) {
								$extension = explode('.', $this->request->data['aadhar_doc']['name']);
								$extension = end($extension);
								$fileNewName = $ack_no . '_UIDDOC' . strtotime(date('d-m-Y H:i:s')) . '.' . $extension;
								if (move_uploaded_file($this->request->data['aadhar_doc']['tmp_name'], $application_dir . DS . $fileNewName)) {
									$seccFamilyDocument->document = $fileNewName;
									if ($inserted_id = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->save($seccFamilyAddTemp)) {
										$seccFamilyDocument->secc_family_add_temp_id			=	$inserted_id->id;
										TableRegistry::getTableLocator()->get('SeccFamilyDocumentAddTemps')->save($seccFamilyDocument);
										TableRegistry::getTableLocator()->get('HhdErcmsPendingNews')->updateAll(['mapping_status' => '1'], ["id" => $this->request->data['member_id']]);
										$this->Flash->success(__('The Family Member has been saved.'));
										return $this->redirect(['action' => 'opAddFamily']);
									} else {
										$this->Flash->error(__('The family Member could not be saved. Please, try again.'));
									}
								} else {
									$this->Flash->error(__('The family Member could not be saved. Please, try again.'));
								}
							}
						} else {
							$this->Flash->error(__('The family Member could not be saved. Please, try again.'));
						}
						/********** End : Uploading Document & saving Data****************/
					} else {
						$this->Flash->error(__('You cannot add family Member as you have selected single family in inclusion criteria.'));
					}
				} else if ($this->request->data['Submit'] == 'deleteopmember') {
					$this->Flash->success(__('The Family Member has been removed from Mapping.'));
					TableRegistry::getTableLocator()->get('HhdErcmsPendingNews')->updateAll(['mapping_status' => '2'], ["id" => $this->request->data['del_member_id']]);
				} else if ($this->request->data['Submit'] == 'editmember') {
					
					$member_id								=	$this->request->data['member_id'];
					$seccFamilyAddTemp 						= 	TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->get($member_id);
					
					$seccFamilyAddTempData					=	$this->request->getData();
					$seccFamilyAddTempData['name'] 			= 	ucwords($this->request->data['name']);
					$seccFamilyAddTempData['fathername'] 	= 	ucwords($this->request->data['fathername']);
					$seccFamilyAddTempData['ack_no_ercms'] 	= 	$ack_no;
					if ($this->request->data['aadhar_doc']['error'] != 0) {
						$seccFamilyAddTempData['aadhar_doc'] = '';
					}

					$seccFamilyAddTemp = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->patchEntity($seccFamilyAddTemp, $seccFamilyAddTempData, ['validate' => 'editmember']);
					
					/********** Start : Aadhar valid format and duplicacy Check ****************/
					$Ercms = new ErcmsValidateController;
					if ($seccFamilyAddTempData['uid'] != '') {
						if (!$uiderror = $Ercms->checkuid($this->request->data['uid'])) {
							$seccFamilyAddTemp->setError('uid', ['Invalid Aadhar Number']);
						} else if (($uiderror = $Ercms->checkopaadhar($this->request->data['uid'], $member_id)) != null) {
							$obj = json_decode($uiderror, true);
							if ($obj['valid'] != false) {
								if (array_key_exists('Acknowledgement No', $obj['data'])) {
									$head = 'Acknowledgement No';
								} else if (array_key_exists('Ration Card No', $obj['data'])) {
									$head = 'Ration Card No';
								} else {
									$head = '';
								}
								//$seccFamilyAddTemp->setError('uid', ['Aadhar Number already exists for ' . $head . ' : ' . $obj["data"][$head]]);
								$seccFamilyAddTemp->setError('uid', ['Aadhar Number already exists, Please contact DSO office.']);
							}
						}
					} else {
						$seccFamilyAddTemp->setError('uid', ['This field cannot be left empty']);
					}
					/********** End : Aadhar valid format nd duplicacy Check ****************/
					/********** Start : Mobile number duplicacy Check ****************/
					/*if ($seccFamilyAddTempData['mobile'] != '') {
						if (($mobile_error = $Ercms->checkopDuplicateMobile($this->request->data['mobile'])) != null) {
							$mobileobj = json_decode($mobile_error, true);
							if ($mobileobj['valid'] != false) {
								if (array_key_exists('Acknowledgement No', $mobileobj['data'])) {
									$mob_head = 'Acknowledgement No';
								} else if (array_key_exists('Ration Card No', $mobileobj['data'])) {
									$mob_head = 'Ration Card No';
								} else {
									$mob_head = '';
								}
								$seccFamilyAddTemp->setError('mobile', ['Mobile Number already exists for ' . $mob_head . ' : ' . $mobileobj["data"][$mob_head]]);
								//$seccFamilyAddTemp->setError('mobile', ['Mobile Number already exists, Please contact DSO office.']);
							}
						}
					} else {
						$seccFamilyAddTemp->setError('mobile', ['This field cannot be left empty']);
					}*/
					/********** End : Mobile number duplicacy Check ****************/

					if (!$seccFamilyAddTemp->getErrors()) {
						/********** Start : Uploading Document ****************/
						if (!empty($this->request->data['aadhar_doc']['name']) and $this->request->data['aadhar_doc']['error'] == 0) {
							$seccFamilyDocument 										= TableRegistry::getTableLocator()->get('SeccFamilyDocumentAddTemps')->newEntity();
							$seccFamilyDocument->secc_cardholder_add_temp_id 			= $seccCardholderAddTemp->id;
							$seccFamilyDocument->secc_family_add_temp_id 				= $member_id;
							$seccFamilyDocument->document_type_id						= '18';
							$old_aadhar_doc												= $this->request->data['old_aadhar_doc'];
							$old_aadhar_doc_id											= $this->request->data['old_aadhar_doc_id'];

							$extension = explode('.', $this->request->data['aadhar_doc']['name']);
							$extension = end($extension);
							$fileNewName = $ack_no . '_UIDDOC' . strtotime(date('d-m-Y H:i:s')) . '.' . $extension;
							if ($old_aadhar_doc_id != '') {
								$del_doc_record = TableRegistry::getTableLocator()->get('SeccFamilyDocumentAddTemps')->get($old_aadhar_doc_id);
								if (file_exists($application_dir . DS . $old_aadhar_doc) && unlink($application_dir . DS . $old_aadhar_doc)) {
									if (move_uploaded_file($this->request->data['aadhar_doc']['tmp_name'], $application_dir . DS . $fileNewName)) {
										if (TableRegistry::getTableLocator()->get('SeccFamilyDocumentAddTemps')->delete($del_doc_record)) {
											$seccFamilyDocument->document = $fileNewName;
											$seccFamilyDocument->document_type_id = '18';
										} else {
											//echo 'image not unlinked.....'; 
											$this->Flash->error(__('Image not Unlinked. Please, try again.'));
											return $this->redirect(['action' => 'opAddFamily']);
										}
									}
								} else {
									if (move_uploaded_file($this->request->data['aadhar_doc']['tmp_name'], $application_dir . DS . $fileNewName)) {
										if (TableRegistry::getTableLocator()->get('SeccFamilyDocumentAddTemps')->delete($del_doc_record)) {
											$seccFamilyDocument->document = $fileNewName;
											$seccFamilyDocument->document_type_id = '18';
										} else {
											//echo 'image not unlinked.....'; 
											$this->Flash->error(__('Image not Unlinked. Please, try again.'));
											return $this->redirect(['action' => 'opAddFamily']);
										}
									}
								}
							} else {
								if (move_uploaded_file($this->request->data['aadhar_doc']['tmp_name'], $application_dir . DS . $fileNewName)) {
									$seccFamilyDocument->document = $fileNewName;
									$seccFamilyDocument->document_type_id = '18';
								}
							}
							if (TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->save($seccFamilyAddTemp)) {
								TableRegistry::getTableLocator()->get('SeccFamilyDocumentAddTemps')->save($seccFamilyDocument);
								$this->Flash->success(__('The member details has been updated.'));
								return $this->redirect(['action' => 'opAddFamily']);
							}
						} else {
							if (TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->save($seccFamilyAddTemp)) {
								$this->Flash->success(__('The member details has been updated.'));
								return $this->redirect(['action' => 'opAddFamily']);
							}
						}
						/********** End : Uploading Document ****************/
					} else {
						$this->Flash->error(__('The Family details could not be saved. Please, try again.'));
					}
				} else {
					$seccFamilyMemberPending_count	= TableRegistry::getTableLocator()->get('HhdErcmsPendingNews')->find('all')->where(['ack_no_ercms' => $ack_no, 'or'=>[['hof'=>0],['hof is null']], 'mapping_status' => 0])->count();
					if ($seccFamilyMemberPending_count > 0) {
						$this->Flash->error(__('You need to Edit & Save/ Delete each pending Family Members before proceeding further.'));
						return $this->redirect(['controller' => 'seccCardholderAddTemps', 'action' => 'opAddFamily']);
					} else {
						$check_priority_status = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->find('all', ['fields' => ['disability_status' => 'sum(case when disability_status = 1 then 1 else 0 end)', 'health_status' => 'sum(case when health_status = 1 then 1 else 0 end)', 'marital_status' => 'sum(case when marital_status = 3 then 1  when marital_status = 4 then 1 else 0 end)', 'age_status' => 'sum(case when (DATE_FORMAT(FROM_DAYS(DATEDIFF(now(),dob)), "%Y")+0)  >=60 then 1 else 0 end)'], 'conditions' => ['secc_cardholder_add_temp_id' => $seccCardholderAddTemp->id]])->first();
						$hof_gender_id	= TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->find('all', ['fields' => ['gender_id']])->where(['ack_no_ercms' => $ack_no, 'hof' => 1])->first();

						if ($check_priority_status->disability_status <= 0  && $seccCardholderAddTemp->disability_status == 1) {
							$this->Flash->error(__('You have selected disability criteria for Ration Card. Please select disability status as disable.'));
							return $this->redirect(['controller' => 'seccCardholderAddTemps', 'action' => 'opAddFamily']);
						} else if ($check_priority_status->health_status <= 0 && $seccCardholderAddTemp->health_status == 1) {
							$this->Flash->error(__('You have selected health aid criteria for Ration Card. Please select health aid as Yes.'));
							return $this->redirect(['controller' => 'seccCardholderAddTemps', 'action' => 'opAddFamily']);
						} else if (($check_priority_status->marital_status <= 0 && $hof_gender_id->gender_id != 3) && $seccCardholderAddTemp->marital_status == 1) {
							$this->Flash->error(__('You have selected widow/widower/Transgender criteria for Ration Card. Please select marital status as widow/widower.'));
							return $this->redirect(['controller' => 'seccCardholderAddTemps', 'action' => 'opAddFamily']);
						} else if ($check_priority_status->age_status <= 0 && $seccCardholderAddTemp->above_sixty == 1) {
							$this->Flash->error(__('You have selected above sixty criteria for Ration Card. Please input your age above sixty.'));
							return $this->redirect(['controller' => 'seccCardholderAddTemps', 'action' => 'opAddFamily']);
						} else {
							if ($seccCardholderAddTemp->application_status < 5) {
								$update = TableRegistry::getTableLocator()->get('seccCardholderAddTemps')->updateAll(['application_status' => '5'], ["id" => $seccCardholderAddTemp->id]);
							}
							$this->Flash->success(__('The Family Details have been saved successfully.'));
							return $this->redirect(['controller' => 'seccCardholderAddTemps', 'action' => 'opAddFamily']);
						}
					}
				}
			}

			$relations 					= TableRegistry::getTableLocator()->get('Relations')->find('list', ['conditions' => ['name !=' => 'SELF'], 'limit' => 200]);
			$genders 					= TableRegistry::getTableLocator()->get('Genders')->find('list', ['limit' => 200])->where([]);
			$seccFamilyMemberPending	= TableRegistry::getTableLocator()->get('HhdErcmsPendingNews')->find('all')->where(['ack_no_ercms' => $ack_no, 'mapping_status' => 0,'or'=>[['hof'=>0],['hof is null']]])->toArray();//->contain(['Relations', 'Genders'])
			//print_r($seccFamilyMemberPending);die;
			$seccFamilyMember 			= TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->find('all')->where(['secc_cardholder_add_temp_id' => $seccCardholderAddTemp->id])->contain(['seccFamilyDocumentAddTemps' => ['DocumentTypes'], 'Relations', 'Genders'])->toArray();
			$seccFamilyMemberCount		= TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->find()->where(['secc_cardholder_add_temp_id' => $seccCardholderAddTemp->id, 'hof is null'])->count();

			$this->set(compact('seccFamilyMember', 'seccFamilyAddTemp', 'relations', 'genders', 'seccCardholderAddTemp', 'seccFamilyMemberCount', 'seccFamilyMemberPending'));
		} else {
			return	$this->redirect(['controller' => 'SeccCardholderAddTemps', 'action' => 'checkAcknowledgement']);
		}
	}

	/**
	 * Add documentDetails method - operator Mapping
	 *
	 */

	function opDocumentDetails()
	{
		$this->viewBuilder()->setLayout('admin');
		if ($this->request->getSession()->check('OperatorPendingApp')) {
			$ack_no = $this->request->getSession()->read('OperatorPendingApp.ack_no');
		} else {
			return	$this->redirect(['controller' => 'SeccCardholderAddTemps', 'action' => 'checkAcknowledgement']);
		}

		$seccCardholderAddTemp = $this->SeccCardholderAddTemps
			->find(
				'all',
				[
					'fields' 	=>
					['id', 'ack_no', 'rgi_district_code', 'applicationType', 'applicationType_rule_id', 'is_bank', 'caste_id', 'application_status', 'non_gov', 'above_sixty', 'marital_status', 'disability_status', 'health_status', 'beggar', 'rag_picker', 'worker', 'street_vendor', 'pvtg', 'old_alone'],
					'conditions' => ['SeccCardholderAddTemps.ack_no=' . "'" . $ack_no . "'",  'application_status>=5']
				]
			)
			->first();
		if ($seccCardholderAddTemp) {
			$seccFamilyRegistration = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->find('all', ['fields' => 'id', 'conditions' => ['SeccFamilyAddTemps.secc_cardholder_add_temp_id=' . "'" . $seccCardholderAddTemp->id . "'", 'hof' => '1'], 'recursive' => -1])->first();
			if ($seccFamilyRegistration) {
				//$this->loadModel('SeccFamilyDocuments');
				$SeccFamilyDocuments = TableRegistry::getTableLocator()->get('SeccFamilyDocumentAddTemps')->find('list', [
					'keyField' => 'document_type_id',
					'valueField' => 'document'
				])->where(['SeccFamilyDocumentAddTemps.secc_family_add_temp_id=' . "'" . $seccFamilyRegistration->id . "'"])->toArray();
			}
			$seccFamilyDocument = TableRegistry::getTableLocator()->get('SeccFamilyDocumentAddTemps')->newEntity(['validate' => false]);

			if ($this->request->is('post')) {
				$rgi_district_code = $seccCardholderAddTemp->rgi_district_code;
				$ack_no = $seccCardholderAddTemp->ack_no;
				$district_dir = DOC_ABS_PATH . $rgi_district_code;
				$application_dir = $district_dir . DS .  $ack_no;
				if (!file_exists($district_dir)) {
					mkdir($district_dir);
				}
				if (!file_exists($application_dir)) {
					mkdir($application_dir);
				}
				$seccFamilyDocument->secc_cardholder_add_temp_id 		=	$seccCardholderAddTemp->id;
				$seccFamilyDocument->secc_family_add_temp_id			=	$seccFamilyRegistration->id;

				if (isset($this->request->data['upload'])) {
					if ($this->request->data['upload'] == "upload_aadhar") {
						$document_type_id = 18;
						$document_upload_field_name = 'aadhar_doc';
						$filename_prepend = '_UIDDOC';
					} else if ($this->request->data['upload'] == "upload_passbook") {
						$document_type_id = 13;
						$document_upload_field_name = 'bank_passbook';
						$filename_prepend = '_BankDOC';
					} else if ($this->request->data['upload'] == "upload_caste") {
						$document_type_id = 14;
						$document_upload_field_name = 'caste_certificate';
						$filename_prepend = '_CasteDOC';
					} else if ($this->request->data['upload'] == "upload_disability") {
						$document_type_id = 16;
						$document_upload_field_name = 'disability_certificate';
						$filename_prepend = '_DisableDOC';
					} else if ($this->request->data['upload'] == "upload_health") {
						$document_type_id = 15;
						$document_upload_field_name = 'health_certificate';
						$filename_prepend = '_HealthDOC';
					} else if ($this->request->data['upload'] == "upload_death") {
						$document_type_id = 17;
						$document_upload_field_name = 'death_certificate';
						$filename_prepend = '_DeathDOC';
					}
					$seccFamilyDocument->document = $this->request->data[$document_upload_field_name];
					$seccFamilyDocumentAddTemp = $this->SeccCardholderAddTemps->patchEntity($seccFamilyDocument, $seccFamilyDocument->toArray(), ['validate' => 'Document']);

					if (!$seccFamilyDocumentAddTemp->getErrors()) {
						$old_doc_check = TableRegistry::getTableLocator()->get('SeccFamilyDocumentAddTemps')->find()->where(['SeccFamilyDocumentAddTemps.secc_family_add_temp_id' => $seccFamilyRegistration->id, 'document_type_id' => $document_type_id])->first();
						if ($old_doc_check && $old_doc_check->document != '') {
							if (!empty($this->request->data[$document_upload_field_name]['name']) and $this->request->data[$document_upload_field_name]['error'] == 0) {
								$extension = explode('.', $this->request->data[$document_upload_field_name]['name']);
								$extension = end($extension);
								$fileNewName = $ack_no . $filename_prepend . strtotime(date('d-m-Y H:i:s')) . '.' . $extension;
								if (file_exists($application_dir . DS . $old_doc_check->document) && unlink($application_dir . DS . $old_doc_check->document)) {
									if (move_uploaded_file($this->request->data[$document_upload_field_name]['tmp_name'], $application_dir . DS . $fileNewName)) {

										if (TableRegistry::getTableLocator()->get('SeccFamilyDocumentAddTemps')->delete($old_doc_check)) {
											$seccFamilyDocument->document = $fileNewName;
											$seccFamilyDocument->document_type_id = $document_type_id;
											if (TableRegistry::getTableLocator()->get('SeccFamilyDocumentAddTemps')->save($seccFamilyDocument)) {
												$this->Flash->success(__('Document have been uploaded.'));
												return $this->redirect(['action' => 'opDocumentDetails']);
											} else {
												$this->Flash->error(__('Document could not be uploaded. Please, try again.'));
											}
										} else {
											$this->Flash->error(__('Document not uploaded. Please, try again.'));
										}
									} else {
										$this->Flash->error(__('Document not updated. Please, try again.'));
									}
								} else {
									if (move_uploaded_file($this->request->data[$document_upload_field_name]['tmp_name'], $application_dir . DS . $fileNewName)) {

										if (TableRegistry::getTableLocator()->get('SeccFamilyDocumentAddTemps')->delete($old_doc_check)) {
											$seccFamilyDocument->document = $fileNewName;
											$seccFamilyDocument->document_type_id = $document_type_id;
											if (TableRegistry::getTableLocator()->get('SeccFamilyDocumentAddTemps')->save($seccFamilyDocument)) {
												$this->Flash->success(__('Document have been uploaded.'));
												return $this->redirect(['action' => 'opDocumentDetails']);
											} else {
												$this->Flash->error(__('Document could not be uploaded. Please, try again.'));
											}
										} else {
											$this->Flash->error(__('Document not uploaded. Please, try again.'));
										}
									} else {
										$this->Flash->error(__('Document not updated. Please, try again.'));
									}
								}
							}
						} else {
							$seccFamilyDocument->document_type_id = $document_type_id;
							if (!empty($this->request->data[$document_upload_field_name]['name']) and $this->request->data[$document_upload_field_name]['error'] == 0) {
								$extension = explode('.', $this->request->data[$document_upload_field_name]['name']);
								$extension = end($extension);
								$fileNewName = $ack_no . $filename_prepend . strtotime(date('d-m-Y H:i:s')) . '.' . $extension;
								if (move_uploaded_file($this->request->data[$document_upload_field_name]['tmp_name'], $application_dir . DS . $fileNewName)) {
									$seccFamilyDocument->document = $fileNewName;

									if (TableRegistry::getTableLocator()->get('SeccFamilyDocumentAddTemps')->save($seccFamilyDocument)) {
										$this->Flash->success(__('Document have been uploaded.'));
										return $this->redirect(['action' => 'opDocumentDetails']);
									} else {
										$this->Flash->error(__('Document could not be uploaded. Please, try again.'));
									}
								} else {
									$this->Flash->error(__('Document could not be uploaded. Please, try again.'));
								}
							}
						}
					} else {
						$seccFamilyDocument->setError($document_upload_field_name, $seccFamilyDocumentAddTemp->getErrors());
						$this->Flash->error(__('Document could not be uploaded. Please, try again.'));
					}
				} else if ($this->request->data['submit'] == "Save & Next") {
					$document_no = 0;
					$document_uploaded = 0;
					$document_status = TableRegistry::getTableLocator()->get('SeccFamilyDocumentAddTemps')
						->find(
							'all',
							[
								'fields' => [
									'bank_doc' => 'sum(case when document_type_id = 13 then 1 else 0 end)',
									'caste_doc' => 'sum(case when document_type_id = 14 then 1 else 0 end)', 'disablility_doc' => 'sum(case when document_type_id = 16 then 1 else 0 end)', 'health_doc' => 'sum(case when document_type_id = 15 then 1 else 0 end)', 'death_doc' => 'sum(case when document_type_id = 17 then 1 else 0 end)'
								],
								'conditions' => ['secc_cardholder_add_temp_id' => $seccCardholderAddTemp->id]
							]
						)->first();

					if ($seccCardholderAddTemp->caste_id == 3 || $seccCardholderAddTemp->caste_id == 4 || $seccCardholderAddTemp->caste_id == 7) {
						$caste_id = 1;
					} else {
						$caste_id = 0;
					};
					if ($seccCardholderAddTemp->is_bank == 0) {
						$document_status->bank_doc = 0;
					} else {
						$document_status->bank_doc = 1;
					}

					$document_no = $seccCardholderAddTemp->is_bank + $caste_id + $seccCardholderAddTemp->marital_status + $seccCardholderAddTemp->disability_status + $seccCardholderAddTemp->health_status;
					$document_uploaded = $document_status->bank_doc + $document_status->caste_doc + $document_status->disablility_doc + $document_status->health_doc + $document_status->death_doc;

					if ($document_uploaded != $document_no) {
						$this->Flash->error(__('You need to upload all documents before proceeding.'));
					} else {
						$update = $this->SeccCardholderAddTemps->updateAll(['application_status' => '6'], ["id" => $seccCardholderAddTemp->id]);
						$this->Flash->success(__('Documents Uploaded successfully.'));
						return $this->redirect(['controller' => 'SeccCardholderAddTemps', 'action' => 'opDocumentDetails']);
					}
				} else {
					return $this->redirect(['action' => 'opDocumentDetails']);
				}
			}

			$this->set(compact('errors', 'seccFamilyRegistration', 'seccFamilyMember', 'seccFamilyDocument', 'relations', 'genders', 'seccCardholderAddTemp', 'SeccFamilyDocuments'));
		} else {
			return	$this->redirect(['controller' => 'SeccCardholderAddTemps', 'action' => 'checkAcknowledgement']);
		}
	}


	/**
	 * Preview method - operator Mapping
	 */
	function opPreview()
	{
		$this->viewBuilder()->setLayout('admin');
		if ($this->request->getSession()->check('OperatorPendingApp')) {
			$ack_no = $this->request->getSession()->read('OperatorPendingApp.ack_no');
		} else {
			return	$this->redirect(['controller' => 'SeccCardholderAddTemps', 'action' => 'checkAcknowledgement']);
		}
		$seccCardholderAddTemp = $this->SeccCardholderAddTemps
			->find(
				'all',
				[
					'fields' 	=>
					['id', 'ack_no', 'mobileno', 'uid', 'name', 'name_sl', 'fathername', 'fathername_sl', 'caste_id', 'mothername', 'mothername_sl', 'res_address', 'res_address_hn', 'tolla_mohalla', 'rgi_district_code', 'rgi_block_code',  'rgi_village_code', 'location_id', 'application_status', 'applicationType', 'applicationType_rule_id', 'SeccDistricts.name', 'SeccBlocks.name', 'SeccVillageWards.id', 'Panchayats.name', 'SeccVillageWards.name', 'Dealers.name', 'Dealers.License_no', 'Cardtypes.name', 'is_bank', 'bank_master_id', 'branch_master_id', 'bank_account_no', 'bank_ifsc_code', 'is_lpg', 'lpg_company', 'lpg_consumer_no', 'BankMasters.name', 'BranchMasters.name', 'non_gov', 'above_sixty', 'marital_status', 'disability_status', 'health_status', 'beggar', 'rag_picker', 'worker', 'street_vendor', 'pvtg', 'old_alone'],
					'conditions' => ['SeccCardholderAddTemps.ack_no=' . "'" . $ack_no . "'", 'application_status<>7', 'application_status>=6'],
					'contain'	=> ['SeccDistricts', 'SeccBlocks', 'Panchayats', 'SeccVillageWards', 'Dealers', 'Cardtypes', 'BankMasters', 'BranchMasters', 'SeccFamilyAddTemps' => ['SeccFamilyDocumentAddTemps' => ['DocumentTypes'], 'Relations']]
				]
			)
			->first();
		if ($seccCardholderAddTemp) {
			$inclusion_criterias 		= TableRegistry::getTableLocator()->get('InclusionCriterias')->find('all', ['fields' => ['id', 'name', 'cardholder_col'], 'conditions' => ['location_id' => $seccCardholderAddTemp->location_id]])->toArray();
			//$exclusion_criterias 		= TableRegistry::getTableLocator()->get('ExclusionCriterias')->find('all', ['fields' => ['id', 'name']])->toArray();

			if ($this->request->is(['post'])) {
				$seccCardholderFamilyDetail = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')
					->find(
						'all',
						[
							'fields' 	=>
							['id', 'gender_id', 'marital_status', 'disability_status', 'health_status', 'dob'],
							'conditions' => ['SeccFamilyAddTemps.secc_cardholder_add_temp_id' => $seccCardholderAddTemp->id, 'hof' => 1]
						]
					)
					->first();

				$priority_marks = 0;
				if ($seccCardholderAddTemp->pvtg == 1) {
					$priority_marks = $priority_marks + 100;
				}
				if ($seccCardholderAddTemp->above_sixty == 1) {
					$priority_marks = $priority_marks + 10;
				}
				if ($seccCardholderAddTemp->marital_status == 1) {
					$priority_marks = $priority_marks + 10;
				}
				if ($seccCardholderAddTemp->disability_status == 1) {
					$priority_marks = $priority_marks + 10;
				}
				if ($seccCardholderAddTemp->health_status == 1) {
					$priority_marks = $priority_marks + 10;
				}
				if ($seccCardholderAddTemp->old_alone == 1) {
					$priority_marks = $priority_marks + 10;
				}
				if ($seccCardholderAddTemp->caste_id == 3 || $seccCardholderAddTemp->caste_id == 4) {
					$priority_marks = $priority_marks + 10;
				}

				$update = $this->SeccCardholderAddTemps->updateAll(['application_status' => '8', 'activity_type_id' => '1', 'activity_flag' => '1', 'priority_marks' => $priority_marks], ["id" => $seccCardholderAddTemp->id]);
				$update = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->updateAll(['activity_type_id' => '1', 'activity_flag' => '1','uid_verified'=>'1'], ["secc_cardholder_add_temp_id" => $seccCardholderAddTemp->id]);
				return $this->redirect(['controller' => 'SeccCardholderAddTemps', 'action' => 'opAcknowledgement']);
			}

			$this->set(compact('seccCardholderAddTemp', 'inclusion_criterias', 'exclusion_criterias'));
		} else {
			return	$this->redirect(['controller' => 'SeccCardholderAddTemps', 'action' => 'checkAcknowledgement']);
		}
	}

	/**
	 * opAcknowledgement method - operator Mapping
	 */
	function opAcknowledgement()
	{
		$this->viewBuilder()->setLayout('admin');
		if ($this->request->getSession()->check('OperatorPendingApp')) {
			$ack_no = $this->request->getSession()->read('OperatorPendingApp.ack_no');
		} else {
			return	$this->redirect(['controller' => 'SeccCardholderAddTemps', 'action' => 'checkAcknowledgement']);
		}
		$seccCardholderAddTemp = $this->SeccCardholderAddTemps
			->find(
				'all',
				[
					'fields' 	=>
					['id', 'ack_no', 'mobileno', 'uid', 'name', 'name_sl', 'fathername', 'fathername_sl', 'caste_id', 'mothername', 'mothername_sl', 'res_address', 'res_address_hn', 'tolla_mohalla', 'rgi_district_code', 'rgi_block_code', 'rgi_village_code', 'location_id', 'application_status', 'applicationType', 'applicationType_rule_id', 'SeccDistricts.name', 'SeccBlocks.name', 'SeccVillageWards.id', 'Panchayats.name', 'SeccVillageWards.name', 'Dealers.name', 'Dealers.License_no', 'Cardtypes.name', 'is_bank', 'bank_master_id', 'branch_master_id', 'bank_account_no', 'bank_ifsc_code', 'is_lpg', 'lpg_company', 'lpg_consumer_no', 'BankMasters.name', 'BranchMasters.name', 'non_gov', 'above_sixty', 'marital_status', 'disability_status', 'health_status', 'beggar', 'rag_picker', 'worker', 'street_vendor', 'pvtg', 'old_alone'],
					'conditions' => ['SeccCardholderAddTemps.ack_no=' . "'" . $ack_no . "'", 'application_status' => 7],
					'contain'	=> ['SeccDistricts', 'SeccBlocks', 'Panchayats', 'SeccVillageWards', 'Dealers', 'Castes', 'Cardtypes', 'BankMasters', 'BranchMasters', 'SeccFamilyAddTemps' => ['Relations']]
				]
			)
			->first();
		if ($seccCardholderAddTemp) {
			$hof_age = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->find('all', ['fields' => ['id', 'dob'], 'conditions' => ['ack_no_ercms' => $ack_no, 'hof' => 1]])->first();
			$inclusion_criterias 		= TableRegistry::getTableLocator()->get('InclusionCriterias')->find('all', ['fields' => ['id', 'name', 'cardholder_col'], 'conditions' => ['location_id' => $seccCardholderAddTemp->location_id]])->toArray();
			$exclusion_criterias 		= TableRegistry::getTableLocator()->get('ExclusionCriterias')->find('all', ['fields' => ['id', 'name'], 'recursive' => -1])->toArray();


			if ($this->request->is(['post'])) {

				$update = $this->SeccCardholderAddTemps->updateAll(['application_status' => '7'], ["id" => $seccCardholderAddTemp->id]);
				return $this->redirect(['controller' => 'SeccCardholderAddTemps', 'action' => 'acknowledgement']);
			}
			$this->set(compact('seccCardholderAddTemp', 'inclusion_criterias', 'exclusion_criterias', 'hof_age'));
		} else {
			return	$this->redirect(['controller' => 'SeccCardholderAddTemps', 'action' => 'checkAcknowledgement']);
		}
	}
}
