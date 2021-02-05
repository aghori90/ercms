<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\Date;
use App\Controller\ErcmsValidateController as Ercms;
//App::import('Controller', 'Ercms');

/**
 * NfsaCardholderTemps Controller
 *
 * @property \App\Model\Table\NfsaCardholderTempsTable $NfsaCardholderTemps
 *
 * @method \App\Model\Entity\NfsaCardholderTemp[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class NfsaCardholderTempsController extends AppController
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
		die('Unauthorised Accesss');
	}


	public function getMemberDetails()
	{
		$request_data = $this->request->getData();
		if ($this->request->is(['ajax'])) {
			$this->autoRender = false;
			$this->viewBuilder()->setLayout('ajax');
			$id = $request_data['member_id'];
		}

		$memberData = TableRegistry::getTableLocator()->get('NfsaFamilyTemps');
		if (!empty($id)) {
			$member = $memberData->find()->select(['id', 'name', 'name_sl', 'fathername', 'fathername_sl', 'gender_id', 'dob', 'relation_id', 'mobile', 'uid', 'disability_status', 'marital_status', 'health_status'])->where(['id' => $id])->first()->toArray();
			$member_doc = TableRegistry::getTableLocator()->get('NfsaFamilyDocumentTemps')->find()->select(['id', 'document'])->where(['nfsa_family_temp_id' => $id])->first();
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


	public function aadhar()
	{
	}



	/**
	 * NFSA Register method
	 *
	 * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
	 */
	public function register()
	{

		$Ercms = new ErcmsValidateController;
		$NfsaCardholderTempReg = $this->NfsaCardholderTemps->newEntity();
		$NfsaFamilyTempsReg = TableRegistry::getTableLocator()->get('NfsaFamilyTemps')->newEntity(); //['validate'=>'Register']
		if ($this->request->is('post')) {
			if (($this->request->getData('Next') !=  null) && $this->request->getData('Next') == 'Next') {
				/**** Start : Aadhar valid format and duplicacy Check ******/
				//$Ercms = new ErcmsValidateController;
				if ($this->request->getData('uid') != '') {
					if (is_numeric($this->request->getData('uid'))) {
						if (!$uiderror = $Ercms->checkuid($this->request->getData('uid'))) {
							$this->Flash->error(__('Invalid Aadhar Number. Please, try again.'));
							return $this->redirect(['controller' => 'NfsaCardholderTemps', 'action' => 'aadhar']);
						} else if (($uiderror = $Ercms->checkaadhar($this->request->getData('uid'))) != null) {
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
								//$this->Flash->error(__('Aadhar Number already exists, Please contact DSO office.'));
								//return $this->redirect(['controller' => 'NfsaCardholderTemps', 'action' => 'aadhar']);
							}
						}
					} else {
						$this->Flash->error(__('Please enter UID in integers.'));
						return $this->redirect(['controller' => 'NfsaCardholderTemps', 'action' => 'aadhar']);
					}
				} else {
					$this->Flash->error(__('This field cannot be left empty. Please, try again.'));
					return $this->redirect(['controller' => 'NfsaCardholderTemps', 'action' => 'aadhar']);
				}
				/**** End : Aadhar valid format Check ******/
			} else {
				$location_query = 	TableRegistry::getTableLocator()->get('SeccBlocks')->find('all', ['fields' => 'location_id', 'conditions' => ['rgi_district_code' => $this->request->getData('rgi_district_code'), 'rgi_block_code' => $this->request->getData('rgi_block_code')]])->first();
				$location_id	=	$location_query->location_id;
				/*Secc Cardholders add temp Entity*/
				/********** Start : Get Acknowledgement Number *********/
				$acknowledgementNo =  $Ercms->nfsaacknowledgementNo($this->request->getData('rgi_district_code'), '1');
				/********** End : Get Acknowledgement Number *********/
				$NfsaCardholderTempRegData = array(
					'ack_no'				=>	$acknowledgementNo,
					'name'					=>	ucwords($this->request->getData('name')),
					'name_sl'				=>	$this->request->getData('name_sl'),
					'fathername'			=>	ucwords($this->request->getData('fathername')),
					'fathername_sl'			=>	$this->request->getData('fathername_sl'),
					'mobileno'				=>	$this->request->getData('mobileno'),
					'requested_mobile'		=>	$this->request->getData('mobileno'),
					'rgi_district_code'		=>	$this->request->getData('rgi_district_code'),
					'rgi_block_code'		=>	$this->request->getData('rgi_block_code'),
					'location_id'			=>	$location_id,
					'rgi_village_code'		=>	$this->request->getData('rgi_village_code'),
					'panchayat_id'			=>	$this->request->getData('panchayat_id'),
					'uid'					=>	$this->request->getData('uid'),
					'aadhar_doc'			=>	$this->request->getData('aadhar_doc'),
					'created'				=>	date('Y-m-d H:i:s'),
					'family_count'			=>	'1',
					'activity_type_id'		=>	'1',
					'activity_flag'			=>	'0',
					'application_status'	=>	'1',
				);
				/*Secc Family add temp Entity*/
				$NfsaFamilyTempsRegData = array(
					'name'					=>	ucwords($this->request->getData('name')),
					'name_sl'				=>	$this->request->getData('name_sl'),
					'fathername'			=>	ucwords($this->request->getData('fathername')),
					'fathername_sl'			=>	$this->request->getData('fathername_sl'),
					'mobile'				=>	$this->request->getData('mobileno'),
					'requested_mobile'		=>	$this->request->getData('mobileno'),
					'dob'					=>	$this->request->getData('dob'),
					'uid'					=>	$this->request->getData('uid'),
					'rgi_district_code'		=>	$this->request->getData('rgi_district_code'),
					'rgi_block_code'		=>	$this->request->getData('rgi_block_code'),
					'rgi_village_code'		=>	$this->request->getData('rgi_village_code'),
					'panchayat_id'			=>	$this->request->getData('panchayat_id'),
					'ack_no_ercms'			=>	$acknowledgementNo,
					'created'				=>	date('Y-m-d H:i:s'),
					'hof'					=>	'1',
					'activity_type_id'		=>	'1',
					'activity_flag'			=>	'0'
				);
				$NfsaCardholderTempReg = $this->NfsaCardholderTemps->patchEntity($NfsaCardholderTempReg, $NfsaCardholderTempRegData, ['validate' => 'Register']);

				/********** Start : Aadhar valid format and duplicacy Check ****************/
				$Ercms = new ErcmsValidateController;
				if ($this->request->data['uid'] != '') {
					if (!$uiderror = $Ercms->checkuid($this->request->getData('uid'))) {
						$NfsaCardholderTempReg->setError('uid', ['Invalid Aadhar Number']);
					} else if (($uiderror = $Ercms->checkaadhar($this->request->getData('uid'))) != null) {
						$obj = json_decode($uiderror, true);
						if ($obj['valid'] != false) {
							if (array_key_exists('Acknowledgement No', $obj['data'])) {
								$head = 'Acknowledgement No';
							} else if (array_key_exists('Ration Card No', $obj['data'])) {
								$head = 'Ration Card No';
							} else {
								$head = '';
							}
							//$NfsaCardholderTempReg->setError('uid', ['Aadhar Number already exists for ' . $head . ' : ' . $obj["data"][$head]]);
							$NfsaCardholderTempReg->setError('uid', ['Aadhar Number already exists, Please contact DSO office.']);
						}
					}
				} else {
					$NfsaCardholderTempReg->setError('uid', ['This field cannot be left empty']);
				}
				/********** End : Aadhar valid format Check ****************/
				/********** End : Mobile duplicacy Check ****************/
				if ($this->request->getData('mobileno') != '') {
					if (($mobile_error = $Ercms->checkDuplicateMobile($this->request->getData('mobileno'))) != null) {
						$mobileobj = json_decode($mobile_error, true);
						if ($mobileobj['valid'] != false) {
							if (array_key_exists('Acknowledgement No', $mobileobj['data'])) {
								$mob_head = 'Acknowledgement No';
							} else if (array_key_exists('Ration Card No', $mobileobj['data'])) {
								$mob_head = 'Ration Card No';
							} else {
								$mob_head = '';
							}
							//$NfsaCardholderTempReg->setError('mobileno', ['Mobile Number already exists for ' . $mob_head . ' : ' . $mobileobj["data"][$mob_head]]);
							$NfsaCardholderTempReg->setError('mobileno', ['Mobile Number already exists, Please contact DSO office.']);
						}
					}
				} else {
					$NfsaCardholderTempReg->setError('mobileno', ['This field cannot be left empty']);
				}
				/********** End : Mobile number duplicacy Check ****************/

				if (!$NfsaCardholderTempReg->getErrors()) {
					$ack_no = $acknowledgementNo;
					$district_dir = DOC_ABS_PATH . $NfsaCardholderTempReg->rgi_district_code;
					$application_dir = $district_dir . DS .  $acknowledgementNo;

					if (!file_exists($district_dir)) {
						mkdir($district_dir);
					}
					if (!file_exists($application_dir)) {
						mkdir($application_dir);
					}
					/********** Start : Uploading Document & saving Data****************/
					$nfsaFamilyDocument 			= TableRegistry::getTableLocator()->get('NfsaFamilyDocumentTemps')->newEntity();
					$nfsaFamilyDocument->document_type_id						= '18';
					if (!empty($this->request->data['aadhar_doc']['name']) and $this->request->data['aadhar_doc']['error'] == 0) {
						$extension = explode('.', $this->request->data['aadhar_doc']['name']);
						$extension = end($extension);
						$fileNewName = $acknowledgementNo . '_UIDDOC' . strtotime(date('d-m-Y H:i:s')) . '.' . $extension;
						if (move_uploaded_file($this->request->data['aadhar_doc']['tmp_name'], $application_dir . DS . $fileNewName)) {
							$nfsaFamilyDocument->document = $fileNewName;
							if ($nfsaCardholderTemp = $this->NfsaCardholderTemps->save($NfsaCardholderTempReg)) {
								$nfsaFamilyDocument->nfsa_cardholder_temp_id			=	$nfsaCardholderTemp->id;

								$NfsaFamilyTempsRegData['nfsa_cardholder_temp_id'] =	$nfsaCardholderTemp->id;
								$NfsaFamilyTempsReg = TableRegistry::getTableLocator()->get('NfsaFamilyTemps')->patchEntity($NfsaFamilyTempsReg, $NfsaFamilyTempsRegData, ['validate' => false]);
								if ($nfsaFamilyTemp = TableRegistry::getTableLocator()->get('NfsaFamilyTemps')->save($NfsaFamilyTempsReg)) {
									//debug($nfsaFamilyTemp->id);
									$nfsaFamilyDocument->nfsa_family_temp_id			=	$nfsaFamilyTemp->id;
									//debug($nfsaFamilyDocument);die;
									TableRegistry::getTableLocator()->get('NfsaFamilyDocumentTemps')->save($nfsaFamilyDocument);
									$this->Flash->success(__('Registration Done Successfully. Please Login with your Acknowledgement No. ' . $acknowledgementNo . ' & Last 8 digits of Aadhar No. as Password.'));
									return $this->redirect(['controller' => 'SeccCardholders', 'action' => 'nfsaLogin']);
								} else {
									$this->Flash->error(__('The Registration could not be done. Please, try again.'));
								}
							} else {
								$this->Flash->error(__('The Registration could not be done. Please, try again.'));
							}
						} else {
							$this->Flash->error(__('The Registration could not be done. Please, try again.'));
						}
					} else {
						$this->Flash->error(__('The Registration could not be done. Please, try again.'));
					}
					/********** End : Uploading Document & saving Data****************/
				} else {
					$this->Flash->error(__('The Registration could not be done. Please, try again.'));
				}
			}
		} else {
			return $this->redirect(['controller' => 'NfsaCardholderTemps', 'action' => 'aadhar']);
		}

		$seccDistricts = TableRegistry::getTableLocator()->get('SeccDistricts')->find('list', [
			'keyField' => 'rgi_district_code',
			'valueField' => 'name'
		]);

		$this->set(compact('user', 'seccDistricts', 'NfsaCardholderTempReg'));
	}


	/**
	 * Add personalDetails method
	 *
	 * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
	 */

	public function personalDetails()
	{
		if ($this->request->getSession()->check('Auth')) {
			$nfsa_cardholder_temp_id 	= $this->request->getSession()->read('Auth.User.id');
			$rgi_district_code 			= $this->request->getSession()->read('Auth.User.rgi_district_code');
			$rgi_block_code 			= $this->request->getSession()->read('Auth.User.rgi_block_code');
		} else {
			return	$this->redirect($this->Auth->logout());
		}

		$nfsaCardholderTemp = $this->NfsaCardholderTemps
			->find(
				'all',
				[
					'fields' 	=>
					['id', 'ack_no', 'mobileno', 'uid', 'name', 'name_sl', 'fathername', 'fathername_sl', 'caste_id', 'mothername', 'mothername_sl', 'marital_status', 'health_status', 'disability_status', 'res_address', 'res_address_hn', 'tolla_mohalla', 'rgi_district_code', 'rgi_block_code', 'rgi_village_code', 'application_status', 'occupationId', 'SeccDistricts.name', 'SeccBlocks.name', 'SeccVillageWards.id',  'SeccVillageWards.name'],
					'conditions' => ['NfsaCardholderTemps.rgi_district_code' => $rgi_district_code, 'NfsaCardholderTemps.rgi_block_code' => $rgi_block_code, 'NfsaCardholderTemps.id' => $nfsa_cardholder_temp_id, 'application_status<>7', 'application_status>=1'],
					'contain'	=> ['SeccDistricts', 'SeccBlocks', 'SeccVillageWards']
				]
			)
			->first();
		//debug($nfsaCardholderTemp);die;
		if ($nfsaCardholderTemp) {
			if ($this->request->is(['patch', 'post', 'put'])) {
				$nfsaCardholderTempData	=	array(
					'caste_id' 				=>	$this->request->getData('caste_id'),
					'res_address'			=>	$this->request->getData('res_address'),
					'tolla_mohalla'			=>	$this->request->getData('tolla_mohalla'),
					'mothername'			=>	$this->request->getData('mothername'),
					'mothername_sl'			=>	$this->request->getData('mothername_sl'),
					'gender_id'				=>	$this->request->getData('gender_id'),
					'marital_status'		=>	$this->request->getData('marital_status'),
					'disability_status'		=>	$this->request->getData('disability_status'),
					'health_status'			=>	$this->request->getData('health_status'),
					'application_status'	=> ($nfsaCardholderTemp->application_status < 2) ? 2 : $nfsaCardholderTemp->application_status,
				);

				$nfsaCardholderTemp = $this->NfsaCardholderTemps->patchEntity($nfsaCardholderTemp, $nfsaCardholderTempData, ['validate' => 'personal']);

				if (!$nfsaCardholderTemp->getErrors()) {
					if ($this->NfsaCardholderTemps->save($nfsaCardholderTemp)) {
						TableRegistry::getTableLocator()->get('NfsaFamilyTemps')->updateAll(['gender_id' => $this->request->getData('gender_id'), 'mothername' => $nfsaCardholderTemp->mothername, 'mothername_sl' => $nfsaCardholderTemp->mothername_sl , 'marital_status' => $this->request->getData('marital_status'), 'disability_status' => $this->request->getData('disability_status'), 'health_status' => $this->request->getData('health_status')], ["nfsa_cardholder_temp_id" => $nfsaCardholderTemp->id, 'hof' => '1']);

						$this->Flash->success(__('The Cardholder\'s personal Detail has been saved.'));
						return $this->redirect(['controller' => 'NfsaCardholderTemps', 'action' => 'personalDetails']);
					}
				} else {
					//debug($seccCardholderAddTemp->errors());
					$this->Flash->error(__('The Cardholder\'s personal Detail  could not be saved. Please, try again.'));
				}
			}
			$castes = TableRegistry::getTableLocator()->get('Castes')->find('list', ['limit' => 200]);
			$family_details = TableRegistry::getTableLocator()->get('NfsaFamilyTemps')->find('all', ['fields' => ['gender_id'], 'conditions' => ['nfsa_cardholder_temp_id' => $nfsaCardholderTemp->id, 'hof' => 1]])->first();
			if ($family_details) {
				$nfsaCardholderTemp->gender_id 			= $family_details->gender_id;
			};
			$this->set(compact('nfsaCardholderTemp', 'castes', 'family_details'));
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
			$nfsa_cardholder_temp_id 	= $this->request->getSession()->read('Auth.User.id');
			$rgi_district_code 			= $this->request->getSession()->read('Auth.User.rgi_district_code');
			$rgi_block_code 			= $this->request->getSession()->read('Auth.User.rgi_block_code');
		} else {
			return	$this->redirect($this->Auth->logout());
		}

		$nfsaCardholderTemp = $this->NfsaCardholderTemps
			->find(
				'all',
				[
					'fields' 	=>
					['id', 'ack_no', 'mobileno', 'uid', 'name', 'name_sl', 'is_lpg', 'lpg_company', 'lpg_consumer_no', 'is_bank', 'caste_id', 'bank_account_no', 'bank_master_id', 'branch_master_id', 'bank_ifsc_code', 'application_status'],
					'conditions' => ['NfsaCardholderTemps.rgi_district_code' => $rgi_district_code, 'NfsaCardholderTemps.rgi_block_code' => $rgi_block_code, 'NfsaCardholderTemps.id' => $nfsa_cardholder_temp_id, 'application_status<>7', 'application_status>=2'],
					'contain' => ['BankMasters', 'BranchMasters']
				]
			)
			->first();
		//debug($nfsaCardholderTemp);die;
		if ($nfsaCardholderTemp) {
			if ($this->request->is(['patch', 'post', 'put'])) {
				$nfsaCardholderTempData = array(
					'is_lpg'		=>	$this->request->getData('is_lpg'),
					'is_bank'		=>	$this->request->getData('is_bank'),
				);

				if ($nfsaCardholderTempData['is_lpg'] == 1) {
					$nfsaCardholderTempData['lpg_company'] 			=	$this->request->getData('lpg_company');
					$nfsaCardholderTempData['lpg_consumer_no'] 		=	$this->request->getData('lpg_consumer_no');
				} else {
					$nfsaCardholderTempData['lpg_company'] 			=	'';
					$nfsaCardholderTempData['lpg_consumer_no'] 		=	'';
				}
				if ($nfsaCardholderTempData['is_bank'] == 1) {
					$nfsaCardholderTempData['bank_account_no']		=	$this->request->getData('bank_account_no');
					$nfsaCardholderTempData['bank_master_id']		=	$this->request->getData('bank_master_id');
					$nfsaCardholderTempData['branch_master_id']		=	$this->request->getData('branch_master_id');
					$nfsaCardholderTempData['bank_ifsc_code']		=	$this->request->getData('bank_ifsc_code');
				} else {
					$nfsaCardholderTempData['bank_account_no'] 		=	'';
					$nfsaCardholderTempData['bank_master_id'] 		=	'';
					$nfsaCardholderTempData['branch_master_id'] 		=	'';
					$nfsaCardholderTempData['bank_ifsc_code'] 		=	'';
				}
				if ($nfsaCardholderTemp->application_status < 3) {
					$nfsaCardholderTempData['application_status']	=	'3';
				}
				//debug($nfsaCardholderTempData);
				$nfsaCardholderTemp = $this->NfsaCardholderTemps->patchEntity($nfsaCardholderTemp, $nfsaCardholderTempData, ['validate' => 'Bank']);
				//debug($nfsaCardholderTemp);
				//die;
				if (!$nfsaCardholderTemp->getErrors()) {
					//$nfsaCardholderTemp->lpg_company 			=	$this->request->getData('lpg_company');
					if ($this->NfsaCardholderTemps->save($nfsaCardholderTemp)) {
						$this->Flash->success(__('The Bank details & LPG Connection Details has been saved.'));
						return $this->redirect(['controller' => 'NfsaCardholderTemps', 'action' => 'bankDetails']);
					} else {
						$this->Flash->error(__('The Bank details & LPG Connection Details could not be saved. Please, try again.'));
					}
				} else {
					$this->Flash->error(__('The Bank details & LPG Connection Details could not be saved. Please, try again.'));
				}
			}

			$bankNames	=	TableRegistry::getTableLocator()->get('BankMasters')->find('list', ['fields' => ['id' => 'BankMasters.bank_code', 'BankMasters.name']])->toArray();
			$this->set(compact('nfsaCardholderTemp', 'bankNames'));
		} else {
			//	return	$this->redirect(['controller' => 'SeccCardholders', 'action' => 'logout']);
		}
	}
	/**
	 * Add additionalDetails method
	 *
	 * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
	 */
	public function additionalDetails()
	{
		if ($this->request->getSession()->check('Auth')) {
			$nfsa_cardholder_temp_id = $this->request->getSession()->read('Auth.User.id');
			$rgi_district_code 			= $this->request->getSession()->read('Auth.User.rgi_district_code');
			$rgi_block_code 			= $this->request->getSession()->read('Auth.User.rgi_block_code');
		} else {
			return	$this->redirect($this->Auth->logout());
		}

		$nfsaCardholderTemp = $this->NfsaCardholderTemps
			->find(
				'all',
				[
					'fields' 	=>
					['id', 'ack_no', 'mobileno', 'uid', 'name', 'name_sl', 'applicationType', 'applicationType_rule_id', 'cardtype_id', 'dealer_id', 'caste_id', 'rgi_block_code', 'rgi_district_code', 'location_id', 'application_status', 'non_gov', 'above_sixty', 'marital_status', 'disability_status', 'health_status', 'beggar', 'rag_picker', 'worker', 'street_vendor', 'pvtg', 'old_alone'],
					'conditions' => ['NfsaCardholderTemps.rgi_district_code' => $rgi_district_code, 'NfsaCardholderTemps.rgi_block_code' => $rgi_block_code, 'NfsaCardholderTemps.id' => $nfsa_cardholder_temp_id, 'application_status<>7', 'application_status>=3']
				]
			)
			->first();

		if ($nfsaCardholderTemp) {
			if ($this->request->is(['patch', 'post', 'put'])) {
				$nfsaCardholderTemp->applicationType 				=	$this->request->getData('applicationType');
				$nfsaCardholderTemp->cardtype_id					=	$this->request->getData('cardtype_id');
				$nfsaCardholderTemp->dealer_id						=	$this->request->getData('dealer_id');
				$nfsaCardholderTemp->non_gov 						= 	0;
				$nfsaCardholderTemp->above_sixty 					= 	0;
			//	$nfsaCardholderTemp->marital_status 				= 	0;
			//	$nfsaCardholderTemp->disability_status 				= 	0;
			//	$nfsaCardholderTemp->health_status 					= 	0;
				$nfsaCardholderTemp->rag_picker 					= 	0;
				$nfsaCardholderTemp->worker 						= 	0;
				$nfsaCardholderTemp->street_vendor 					= 	0;
				$nfsaCardholderTemp->pvtg 							= 	0;
				$nfsaCardholderTemp->old_alone 						= 	0;
				// if ($nfsaCardholderTemp->applicationType == 2) {
				// 	$nfsaCardholderTemp->applicationType_rule_id		=	$this->request->data['applicationType_rule_id'];
				// }
				if (isset($this->request->data['applicationType_rule_id']) && $nfsaCardholderTemp->applicationType == 2) {
					foreach ($this->request->data['applicationType_rule_id'] as $key => $inclusion) {
						$nfsaCardholderTemp->$key						= 	'1'; //$inclusion;
						$nfsaCardholderTemp->applicationType_rule_id	=	$inclusion;
					}
				}
				if ($nfsaCardholderTemp->application_status < 4) {
					$nfsaCardholderTemp->application_status			=	'4';
				}
				if ($nfsaCardholderTemp->pvtg == 1 && $nfsaCardholderTemp->caste_id != 7) {
					$this->Flash->error(__('You cannot select PVTG as you inclusion criteria for Ration Card as you have not selected PVTG as your caste at the time of registration.'));
					return $this->redirect(['controller' => 'NfsaCardholderTemps', 'action' => 'additionalDetails']);
				} else if ($nfsaCardholderTemp->occupation_id != 6 && $nfsaCardholderTemp->beggar == 1) {
					$this->Flash->error(__('You have selected beggar criteria for Ration Card. Please select beggar as your occupation in personal details.'));
					return $this->redirect(['controller' => 'NfsaCardholderTemps', 'action' => 'additionalDetails']);
				} else if ($nfsaCardholderTemp->occupation_id == 1 && $nfsaCardholderTemp->non_gov == 1) {
					$this->Flash->error(__('You have selected non goverment employee criteria for Ration Card. Please select non goverment employee as your occupation in personal details.'));
					return $this->redirect(['controller' => 'NfsaCardholderTemps', 'action' => 'additionalDetails']);
				} else if ($nfsaCardholderTemp->occupation_id != 7 && $nfsaCardholderTemp->rag_picker == 1) {
					$this->Flash->error(__('You have selected ragpicker criteria for Ration Card. Please select ragpicker as your occupation in personal details.'));
					return $this->redirect(['controller' => 'NfsaCardholderTemps', 'action' => 'additionalDetails']);
				} else if ($nfsaCardholderTemp->occupation_id != 8 && $nfsaCardholderTemp->worker == 1) {
					$this->Flash->error(__('You have selected  Construction Worker/Mason/Unskilled Labour/Domestic Worker/Coolie and other head load worker/Rickshaw Puller/Thela Puller criteria for Ration Card. Please select  your occupation same in personal details.'));
					return $this->redirect(['controller' => 'NfsaCardholderTemps', 'action' => 'additionalDetails']);
				} else if ($nfsaCardholderTemp->occupation_id != 9 && $nfsaCardholderTemp->street_vendor == 1) {
					$this->Flash->error(__('You have selected  Street Vendor/Hawker/Peon in Small Establishment/Security Guard/Painter/Welder/Electrician/Mechanic/Tailor/Plumber/Mali/Washermen/cobbler criteria for Ration Card. Please select  your occupation same in personal details.'));
					return $this->redirect(['controller' => 'NfsaCardholderTemps', 'action' => 'additionalDetails']);
				}

				$nfsaCardholderTemp = $this->NfsaCardholderTemps->patchEntity($nfsaCardholderTemp, $nfsaCardholderTemp->toArray(), ['validate' => 'additional']);

				if (!$nfsaCardholderTemp->getErrors()) {
					if ($this->NfsaCardholderTemps->save($nfsaCardholderTemp)) {
						$this->Flash->success(__('The additional details has been saved.'));
						return $this->redirect(['controller' => 'NfsaCardholderTemps', 'action' => 'additionalDetails']);
					}
					$this->Flash->error(__('The additional details could not be saved. Please, try again.'));
				} else {
					$this->Flash->error(__('The additional details could not be saved. Please, try again.'));
				}
			}

			$cardtypes 					= TableRegistry::getTableLocator()->get('Cardtypes')->find('list');
			$inclusion_criterias 		= TableRegistry::getTableLocator()->get('InclusionCriterias')->find('all', ['fields' => ['id', 'name', 'cardholder_col'], 'conditions' => ['location_id' => $nfsaCardholderTemp->location_id]])->toArray();
			$exclusion_criterias 		= TableRegistry::getTableLocator()->get('ExclusionCriterias')->find('all', ['fields' => ['id', 'name']])->toArray();


			$dealers = TableRegistry::getTableLocator()->get('Dealers')->find('list', ['conditions' => ['Dealers.rgi_district_code=' . "'" . $nfsaCardholderTemp->rgi_district_code . "'", 'Dealers.rgi_block_code=' . "'" . $nfsaCardholderTemp->rgi_block_code . "'"]]);
			$hof_gender = TableRegistry::getTableLocator()->get('NfsaFamilyTemps')->find('all', ['fields' => ['gender_id'], 'conditions' => ['nfsa_cardholder_temp_id' => $nfsaCardholderTemp->id, 'hof' => 1]])->first();

			$this->set(compact('nfsaCardholderTemp',  'cardtypes',  'dealers', 'exclusion_criterias', 'inclusion_criterias', 'hof_gender'));
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
			$nfsa_cardholder_temp_id = $this->request->getSession()->read('Auth.User.id');
			$ack_no = $this->request->getSession()->read('Auth.User.ack_no');
			$rgi_district_code = $this->request->getSession()->read('Auth.User.rgi_district_code');
			$rgi_block_code = $this->request->getSession()->read('Auth.User.rgi_block_code');
		} else {
			return	$this->redirect($this->Auth->logout());
		}

		$nfsaCardholderTemp = TableRegistry::getTableLocator()
			->get('NfsaCardholderTemps')
			->find(
				'all',
				[
					'fields' 	=>
					['id', 'ack_no', 'mobileno', 'uid', 'name', 'name_sl', 'application_status', 'applicationType', 'applicationType_rule_id', 'rgi_district_code', 'rgi_block_code', 'rgi_village_code', 'non_gov', 'above_sixty', 'marital_status', 'disability_status', 'health_status', 'beggar', 'rag_picker', 'worker', 'street_vendor', 'pvtg', 'old_alone', 'family_count'],
					'conditions' => ['NfsaCardholderTemps.rgi_district_code' => $rgi_district_code, 'NfsaCardholderTemps.rgi_block_code' => $rgi_block_code, 'NfsaCardholderTemps.id' => $nfsa_cardholder_temp_id, 'rgi_district_code' => $rgi_district_code, 'application_status<>7', 'application_status>=4']
				]
			)
			->first();
		if ($nfsaCardholderTemp) {
			$nfsaFamilyTemp = TableRegistry::getTableLocator()->get('NfsaFamilyTemps')->newEntity();
			if ($this->request->is('post')) {
				$family_count = $nfsaCardholderTemp->family_count;
				$ack_no = $nfsaCardholderTemp->ack_no;
				$district_dir = DOC_ABS_PATH . $rgi_district_code;
				$application_dir = $district_dir . DS .  $ack_no;

				if (!file_exists($district_dir)) {
					mkdir($district_dir);
				}
				if (!file_exists($application_dir)) {
					mkdir($application_dir);
				}
				if ($this->request->data['Submit'] == 'savemember') {
					if ($nfsaCardholderTemp->old_alone != 1) {
						$nfsaFamilyTempData 										= $this->request->getData();
						$nfsaFamilyTempData['nfsa_cardholder_temp_id'] 				= $nfsaCardholderTemp->id;
						$nfsaFamilyTempData['rgi_district_code'] 					= $nfsaCardholderTemp->rgi_district_code;
						$nfsaFamilyTempData['rgi_block_code'] 						= $nfsaCardholderTemp->rgi_block_code;
						$nfsaFamilyTempData['rgi_village_code'] 					= $nfsaCardholderTemp->rgi_village_code;
						$nfsaFamilyTempData['name'] 								= ucwords($this->request->getData('name'));
						$nfsaFamilyTempData['fathername'] 							= ucwords($this->request->getData('fathername'));
						$nfsaFamilyTempData['ack_no_ercms'] 						= $ack_no;
						$nfsaFamilyTempData['activity_type_id'] 					= 1;
						$nfsaFamilyTempData['activity_flag'] 						= 0;
						$nfsaFamilyTempData['document'] 							= $this->request->data['aadhar_doc'];
						$nfsaFamilyTemp = TableRegistry::getTableLocator()->get('NfsaFamilyTemps')->patchEntity($nfsaFamilyTemp, $nfsaFamilyTempData);

						/********** Start : Aadhar valid format and duplicacy Check ****************/
						$Ercms = new ErcmsValidateController;
						if ($nfsaFamilyTempData['uid'] != '') {
							if (!$uiderror = $Ercms->checkuid($this->request->getData('uid'))) {
								$nfsaFamilyTemp->setError('uid', ['Invalid Aadhar Number']);
							} else if (($uiderror = $Ercms->checkaadhar($this->request->getData('uid'))) != null) {
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
									//$nfsaFamilyTemp->setError('uid', ['Aadhar Number already exists, Please contact DSO office.']);
								}
							}
						} else {
							$nfsaFamilyTemp->setError('uid', ['This field cannot be left empty']);
						}
						/********** End : Aadhar valid format nd duplicacy Check ****************/
						/********** Start : Mobile number duplicacy Check ****************/
						if ($nfsaFamilyTempData['mobile'] != '') {
							if (($mobile_error = $Ercms->checkDuplicateMobile($this->request->getData('mobile'))) != null) {
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
									$nfsaFamilyTemp->setError('mobile', ['Mobile Number already exists, Please contact DSO office.']);
								}
							}
						} else {
							$nfsaFamilyTemp->setError('mobile', ['This field cannot be left empty']);
						}
						/********** End : Mobile number duplicacy Check ****************/

						if (!$nfsaFamilyTemp->getErrors()) {
							/********** Start : Uploading Document & saving Data****************/
							$nfsaFamilyDocument 										= TableRegistry::getTableLocator()->get('NfsaFamilyDocumentTemps')->newEntity();
							$nfsaFamilyDocument->nfsa_cardholder_temp_id 			=	$nfsaCardholderTemp->id;
							$nfsaFamilyDocument->document_type_id						= '18';
							if (!empty($this->request->data['aadhar_doc']['name']) and $this->request->data['aadhar_doc']['error'] == 0) {
								$extension = explode('.', $this->request->data['aadhar_doc']['name']);
								$extension = end($extension);
								$fileNewName = $ack_no . '_UIDDOC' . strtotime(date('d-m-Y H:i:s')) . '.' . $extension;
								if (move_uploaded_file($this->request->data['aadhar_doc']['tmp_name'], $application_dir . DS . $fileNewName)) {
									$nfsaFamilyDocument->document = $fileNewName;
									if ($inserted_id = TableRegistry::getTableLocator()->get('NfsaFamilyTemps')->save($nfsaFamilyTemp)) {
										$family_count_add	=	$family_count + 1;
										$nfsaFamilyDocument->nfsa_family_temp_id			=	$inserted_id->id;
										TableRegistry::getTableLocator()->get('NfsaFamilyDocumentTemps')->save($nfsaFamilyDocument);
										$update = TableRegistry::getTableLocator()->get('NfsaCardholderTemps')->updateAll(['family_count' => $family_count_add], ["id" => $nfsaCardholderTemp->id]);
										$this->Flash->success(__('The secc family add temp has been saved.'));
										return $this->redirect(['action' => 'addFamily']);
									} else {
										$this->Flash->error(__('The family Member could not be saved. Please, try again.'));
									}
								} else {
									$this->Flash->error(__('The family Member could not be saved. Please, try again.'));
								}
							} else {
								$this->Flash->error(__('The family Member could not be saved. Please, try again.'));
							}
						}
						/********** End : Uploading Document & Saving Data****************/
					} else {
						$this->Flash->error(__('You cannot add family Member as you have selected single family in inclusion criteria.'));
					}
				} else if ($this->request->getData('Submit') == 'editmember') {
					$member_id								=	$this->request->getData('member_id');
					$nfsaFamilyTemp 						= 	TableRegistry::getTableLocator()->get('NfsaFamilyTemps')->get($member_id);

					$nfsaFamilyTempData						=	$this->request->getData();
					$nfsaFamilyTempData['name'] 			= 	ucwords($this->request->getData('name'));
					$nfsaFamilyTempData['fathername'] 		= 	ucwords($this->request->getData('fathername'));
					$nfsaFamilyTempData['ack_no_ercms'] 	= 	$ack_no;
					if ($this->request->data['aadhar_doc']['error'] != 0) {
						$seccFamilyAddTempData['aadhar_doc'] = '';
					}

					$nfsaFamilyTemp = TableRegistry::getTableLocator()->get('NfsaFamilyTemps')->patchEntity($nfsaFamilyTemp, $nfsaFamilyTempData, ['validate' => 'editmember']);

					/********** Start : Aadhar valid format and duplicacy Check ****************/
					$Ercms = new ErcmsValidateController;
					if ($nfsaFamilyTempData['uid'] != '') {
						if (!$uiderror = $Ercms->checkuid($this->request->getData('uid'))) {
							$nfsaFamilyTemp->setError('uid', ['Invalid Aadhar Number']);
						} else if (($uiderror = $Ercms->checkaadhar($this->request->getData('uid'), $member_id)) != null) {
							$obj = json_decode($uiderror, true);
							if ($obj['valid'] != false) {
								if (array_key_exists('Acknowledgement No', $obj['data'])) {
									$head = 'Acknowledgement No';
								} else if (array_key_exists('Ration Card No', $obj['data'])) {
									$head = 'Ration Card No';
								} else {
									$head = '';
								}
								//$nfsaFamilyTemp->setError('uid', ['Aadhar Number already exists for ' . $head . ' : ' . $obj["data"][$head]]);
								//$nfsaFamilyTemp->setError('uid', ['Aadhar Number already exists, Please contact DSO office.']);
							}
						}
					} else {
						$nfsaFamilyTemp->setError('uid', ['This field cannot be left empty']);
					}
					/********** End : Aadhar valid format nd duplicacy Check ****************/
					/********** Start : Mobile number duplicacy Check ****************/
					if ($nfsaFamilyTempData['mobile'] != '') {
						if (($mobile_error = $Ercms->checkDuplicateMobile($this->request->getData('mobile'))) != null) {
							$mobileobj = json_decode($mobile_error, true);
							if ($mobileobj['valid'] != false) {
								if (array_key_exists('Acknowledgement No', $mobileobj['data'])) {
									$mob_head = 'Acknowledgement No';
								} else if (array_key_exists('Ration Card No', $mobileobj['data'])) {
									$mob_head = 'Ration Card No';
								} else {
									$mob_head = '';
								}
								//$nfsaFamilyTemp->setError('mobile', ['Mobile Number already exists for ' . $mob_head . ' : ' . $mobileobj["data"][$mob_head]]);
								$nfsaFamilyTemp->setError('mobile', ['Mobile Number already exists, Please contact DSO office.']);
							}
						}
					} else {
						$nfsaFamilyTemp->setError('mobile', ['This field cannot be left empty']);
					}
					/********** End : Mobile number duplicacy Check ****************/
					if (!$nfsaFamilyTemp->getErrors()) {
						/********** Start : Uploading Document ****************/
						if (!empty($this->request->data['aadhar_doc']['name']) and $this->request->data['aadhar_doc']['error'] == 0) {
							$nfsaFamilyDocument 										= TableRegistry::getTableLocator()->get('NfsaFamilyDocumentTemps')->newEntity();
							$nfsaFamilyDocument->nfsa_cardholder_temp_id 				= $nfsaCardholderTemp->id;
							$nfsaFamilyDocument->nfsa_family_temp_id 					= $member_id;
							$nfsaFamilyDocument->document_type_id						= '18';
							$old_aadhar_doc												= $this->request->data['old_aadhar_doc'];
							$old_aadhar_doc_id											= $this->request->data['old_aadhar_doc_id'];

							$extension = explode('.', $this->request->data['aadhar_doc']['name']);
							$extension = end($extension);
							$fileNewName = $ack_no . '_UIDDOC' . strtotime(date('d-m-Y H:i:s')) . '.' . $extension;

							if ($old_aadhar_doc_id != '') {
								$del_doc_record = TableRegistry::getTableLocator()->get('NfsaFamilyDocumentTemps')->get($old_aadhar_doc_id);
								if (file_exists($application_dir . DS . $old_aadhar_doc) && unlink($application_dir . DS . $old_aadhar_doc)) {
									if (move_uploaded_file($this->request->data['aadhar_doc']['tmp_name'], $application_dir . DS . $fileNewName)) {
										if (TableRegistry::getTableLocator()->get('NfsaFamilyDocumentTemps')->delete($del_doc_record)) {
											$nfsaFamilyDocument->document = $fileNewName;
											$nfsaFamilyDocument->document_type_id = '18';
										} else {
											//echo 'image not unlinked.....'; 
											$this->Flash->error(__('Image not Unlinked. Please, try again.'));
											return $this->redirect(['action' => 'addFamily']);
										}
									}
								} else {
									if (move_uploaded_file($this->request->data['aadhar_doc']['tmp_name'], $application_dir . DS . $fileNewName)) {
										if (TableRegistry::getTableLocator()->get('NfsaFamilyDocumentTemps')->delete($del_doc_record)) {
											$nfsaFamilyDocument->document = $fileNewName;
											$nfsaFamilyDocument->document_type_id = '18';
										} else {
											//echo 'image not unlinked.....'; 
											$this->Flash->error(__('Image not Unlinked. Please, try again.'));
											return $this->redirect(['action' => 'addFamily']);
										}
									}
								}
							} else {
								if (move_uploaded_file($this->request->data['aadhar_doc']['tmp_name'], $application_dir . DS . $fileNewName)) {
									$nfsaFamilyDocument->document = $fileNewName;
									$nfsaFamilyDocument->document_type_id = '18';
								}
							}
							if (TableRegistry::getTableLocator()->get('NfsaFamilyTemps')->save($nfsaFamilyTemp)) {
								TableRegistry::getTableLocator()->get('NfsaFamilyDocumentTemps')->save($nfsaFamilyDocument);
								$this->Flash->success(__('The member details has been updated.'));
								return $this->redirect(['action' => 'addFamily']);
							}
						} else {
							if (TableRegistry::getTableLocator()->get('NfsaFamilyTemps')->save($nfsaFamilyTemp)) {
								$this->Flash->success(__('The member details has been updated.'));
								return $this->redirect(['action' => 'addFamily']);
							}
						}
						/********** End : Uploading Document ****************/
					} else {
						$this->Flash->error(__('The Family details could not be saved. Please, try again.'));
					}
				} else {
					$check_priority_status = TableRegistry::getTableLocator()->get('NfsaFamilyTemps')->find('all', ['fields' => ['disability_status' => 'sum(case when disability_status = 1 then 1 else 0 end)', 'health_status' => 'sum(case when health_status = 1 then 1 else 0 end)', 'marital_status' => 'sum(case when marital_status = 3 then 1  when marital_status = 4 then 1 else 0 end)', 'age_status' => 'sum(case when (DATE_FORMAT(FROM_DAYS(DATEDIFF(now(),dob)), "%Y")+0)  >=60 then 1 else 0 end)'], 'conditions' => ['nfsa_cardholder_temp_id' => $nfsaCardholderTemp->id]])->first();

					if ($check_priority_status->disability_status <= 0  && $nfsaCardholderTemp->disability_status == 1) {
						$this->Flash->error(__('You have selected disability criteria for Ration Card. Please select disability status as disable.'));
						return $this->redirect(['controller' => 'NfsaCardholderTemps', 'action' => 'addFamily']);
					} else if ($check_priority_status->health_status <= 0 && $nfsaCardholderTemp->health_status == 1) {
						$this->Flash->error(__('You have selected health aid criteria for Ration Card. Please select health aid.'));
						return $this->redirect(['controller' => 'NfsaCardholderTemps', 'action' => 'addFamily']);
					} else if ($check_priority_status->marital_status <= 0 && $nfsaCardholderTemp->marital_status == 1) {
						$this->Flash->error(__('You have selected widow/widower criteria for Ration Card. Please select marital status.'));
						return $this->redirect(['controller' => 'NfsaCardholderTemps', 'action' => 'addFamily']);
					} else if ($check_priority_status->age_status <= 0 && $nfsaCardholderTemp->above_sixty == 1) {
						$this->Flash->error(__('You have selected above sixty criteria for Ration Card. Please input your age above sixty.'));
						return $this->redirect(['controller' => 'NfsaCardholderTemps', 'action' => 'addFamily']);
					} else {
						if ($nfsaCardholderTemp->application_status < 5) {
							$update = TableRegistry::getTableLocator()->get('NfsaCardholderTemps')->updateAll(['application_status' => '5'], ["id" => $nfsaCardholderTemp->id]);
						}
						$this->Flash->success(__('The Family Details have been saved successfully.'));
						return $this->redirect(['controller' => 'NfsaCardholderTemps', 'action' => 'addFamily']);
					}
				}
			}

			$relations 					= TableRegistry::getTableLocator()->get('Relations')->find('list', ['conditions' => ['name !=' => 'SELF'], 'limit' => 200]);
			$genders 					= TableRegistry::getTableLocator()->get('Genders')->find('list', ['limit' => 200])->where([]);
			$nfsaFamilyMember 			= TableRegistry::getTableLocator()->get('NfsaFamilyTemps')->find('all')->where(['nfsa_cardholder_temp_id' => $nfsaCardholderTemp->id])->contain(['NfsaFamilyDocumentTemps' => ['DocumentTypes'], 'Relations', 'Genders'])->toArray();
			$nfsaFamilyMemberCount		= TableRegistry::getTableLocator()->get('NfsaFamilyTemps')->find()->where(['nfsa_cardholder_temp_id' => $nfsaCardholderTemp->id, 'hof is null'])->count();

			$this->set(compact('nfsaFamilyMember', 'nfsaFamilyTemp', 'relations', 'genders', 'nfsaCardholderTemp', 'nfsaFamilyMemberCount'));
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
			$nfsa_cardholder_temp_id 	= $this->request->getSession()->read('Auth.User.id');
			$rgi_district_code 			= $this->request->getSession()->read('Auth.User.rgi_district_code');
			$rgi_block_code 			= $this->request->getSession()->read('Auth.User.rgi_block_code');
		} else {
			return	$this->redirect($this->Auth->logout());
		}

		$nfsaCardholderTemp = $this->NfsaCardholderTemps
			->find(
				'all',
				[
					'fields' 	=>
					['id', 'ack_no', 'rgi_district_code', 'applicationType', 'applicationType_rule_id', 'is_bank', 'caste_id', 'application_status', 'non_gov', 'above_sixty', 'marital_status', 'disability_status', 'health_status', 'beggar', 'rag_picker', 'worker', 'street_vendor', 'pvtg', 'old_alone'],
					'conditions' => ['NfsaCardholderTemps.id=' . "'" . $nfsa_cardholder_temp_id . "'", 'application_status<>7',  'application_status>=5']
				]
			)
			->first();
		if ($nfsaCardholderTemp) {
			$nfsaFamilyRegistration = TableRegistry::getTableLocator()->get('NfsaFamilyTemps')->find('all', ['fields' => 'id', 'conditions' => ['NfsaFamilyTemps.nfsa_cardholder_temp_id=' . "'" . $nfsaCardholderTemp->id . "'", 'hof' => '1'], 'recursive' => -1])->first();
			if ($nfsaFamilyRegistration) {
				//$this->loadModel('SeccFamilyDocuments');
				$NfsaFamilyDocuments = TableRegistry::getTableLocator()->get('NfsaFamilyDocumentTemps')->find('list', [
					'keyField' => 'document_type_id',
					'valueField' => 'document'
				])->where(['NfsaFamilyDocumentTemps.nfsa_family_temp_id=' . "'" . $nfsaFamilyRegistration->id . "'"])->toArray();
			}
			$nfsaFamilyDocument = TableRegistry::getTableLocator()->get('NfsaFamilyDocumentTemps')->newEntity(['validate' => false]);

			if ($this->request->is('post')) {
				$rgi_district_code = $nfsaCardholderTemp->rgi_district_code;
				$ack_no = $nfsaCardholderTemp->ack_no;
				$district_dir = DOC_ABS_PATH . $rgi_district_code;
				$application_dir = $district_dir . DS .  $ack_no;
				if (!file_exists($district_dir)) {
					mkdir($district_dir);
				}
				if (!file_exists($application_dir)) {
					mkdir($application_dir);
				}
				$nfsaFamilyDocument->nfsa_cardholder_temp_id 		=	$nfsaCardholderTemp->id;
				$nfsaFamilyDocument->nfsa_family_temp_id			=	$nfsaFamilyRegistration->id;

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
					$nfsaFamilyDocument->document = $this->request->data[$document_upload_field_name];
					$nfsaFamilyDocumentTemp = $this->NfsaCardholderTemps->patchEntity($nfsaFamilyDocument, $nfsaFamilyDocument->toArray(), ['validate' => 'Document']);

					if (!$nfsaFamilyDocumentTemp->getErrors()) {
						$old_doc_check = TableRegistry::getTableLocator()->get('NfsaFamilyDocumentTemps')->find()->where(['NfsaFamilyDocumentTemps.nfsa_family_temp_id' => $nfsaFamilyRegistration->id, 'document_type_id' => $document_type_id])->first();
						if ($old_doc_check && $old_doc_check->document != '') {
							if (!empty($this->request->data[$document_upload_field_name]['name']) and $this->request->data[$document_upload_field_name]['error'] == 0) {
								$extension = explode('.', $this->request->data[$document_upload_field_name]['name']);
								$extension = end($extension);
								$fileNewName = $ack_no . $filename_prepend . strtotime(date('d-m-Y H:i:s')) . '.' . $extension;
								if (file_exists($application_dir . DS . $old_doc_check->document) && unlink($application_dir . DS . $old_doc_check->document)) {
									if (move_uploaded_file($this->request->data[$document_upload_field_name]['tmp_name'], $application_dir . DS . $fileNewName)) {

										if (TableRegistry::getTableLocator()->get('NfsaFamilyDocumentTemps')->delete($old_doc_check)) {
											$nfsaFamilyDocument->document = $fileNewName;
											$nfsaFamilyDocument->document_type_id = $document_type_id;
											if (TableRegistry::getTableLocator()->get('NfsaFamilyDocumentTemps')->save($nfsaFamilyDocument)) {
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

										if (TableRegistry::getTableLocator()->get('NfsaFamilyDocumentTemps')->delete($old_doc_check)) {
											$nfsaFamilyDocument->document = $fileNewName;
											$nfsaFamilyDocument->document_type_id = $document_type_id;
											if (TableRegistry::getTableLocator()->get('NfsaFamilyDocumentTemps')->save($nfsaFamilyDocument)) {
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
							$nfsaFamilyDocument->document_type_id = $document_type_id;
							if (!empty($this->request->data[$document_upload_field_name]['name']) and $this->request->data[$document_upload_field_name]['error'] == 0) {
								$extension = explode('.', $this->request->data[$document_upload_field_name]['name']);
								$extension = end($extension);
								$fileNewName = time() . $filename_prepend . strtotime(date('d-m-Y')) . '.' . $extension;
								if (move_uploaded_file($this->request->data[$document_upload_field_name]['tmp_name'], $application_dir . DS . $fileNewName)) {
									$nfsaFamilyDocument->document = $fileNewName;
									if (TableRegistry::getTableLocator()->get('NfsaFamilyDocumentTemps')->save($nfsaFamilyDocument)) {
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
						$nfsaFamilyDocument->setError($document_upload_field_name, $nfsaFamilyDocumentTemp->getErrors());
						$this->Flash->error(__('Document could not be uploaded. Please, try again.'));
					}
				} else if ($this->request->data['submit'] == "Save & Next") {
					if (sizeof($NfsaFamilyDocuments) <= 0) {
						$this->Flash->error(__('Uploading Aadhar Card is mandatory. Please, try again.'));
					} else {
						$update = $this->NfsaCardholderTemps->updateAll(['application_status' => '6'], ["id" => $nfsaCardholderTemp->id]);
						$this->Flash->success(__('Documents Uploaded successfully.'));
						return $this->redirect(['action' => 'documentDetails']);
					}
				} else {
					return $this->redirect(['action' => 'documentDetails']);
				}
			}

			$this->set(compact('errors', 'nfsaFamilyRegistration', 'nfsaFamilyMember', 'nfsaFamilyDocument', 'relations', 'genders', 'nfsaCardholderTemp', 'NfsaFamilyDocuments'));
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
			$nfsa_cardholder_temp_id = $this->request->getSession()->read('Auth.User.id');
			$rgi_district_code = $this->request->getSession()->read('Auth.User.rgi_district_code');
			$rgi_block_code = $this->request->getSession()->read('Auth.User.rgi_block_code');
		} else {
			return	$this->redirect($this->Auth->logout());
		}
		$nfsaCardholderTemp = $this->NfsaCardholderTemps
			->find(
				'all',
				[
					'fields' 	=>
					['id', 'ack_no', 'mobileno', 'uid', 'name', 'name_sl', 'fathername', 'fathername_sl', 'caste_id', 'mothername', 'mothername_sl', 'res_address', 'res_address_hn', 'tolla_mohalla', 'rgi_district_code', 'rgi_block_code',  'rgi_village_code', 'location_id', 'application_status', 'applicationType', 'applicationType_rule_id', 'SeccDistricts.name', 'SeccBlocks.name', 'SeccVillageWards.id', 'Panchayats.name', 'SeccVillageWards.name', 'Dealers.name', 'Dealers.License_no', 'Cardtypes.name', 'is_bank', 'bank_master_id', 'branch_master_id', 'bank_account_no', 'bank_ifsc_code', 'is_lpg', 'lpg_company', 'lpg_consumer_no', 'BankMasters.name', 'BranchMasters.name', 'applicationType_rule_id', 'non_gov', 'above_sixty', 'marital_status', 'disability_status', 'health_status', 'beggar', 'rag_picker', 'worker', 'street_vendor', 'pvtg', 'old_alone'],
					'conditions' => ['NfsaCardholderTemps.rgi_district_code' => $rgi_district_code, 'NfsaCardholderTemps.rgi_block_code' => $rgi_block_code, 'NfsaCardholderTemps.id' => $nfsa_cardholder_temp_id, 'application_status<>7', 'application_status>=5'],
					'contain'	=> ['SeccDistricts', 'SeccBlocks', 'Panchayats', 'SeccVillageWards', 'Dealers', 'Cardtypes', 'BankMasters', 'BranchMasters']
				]
			)
			->first();
		if ($nfsaCardholderTemp) {
			$inclusion_criterias 		= TableRegistry::getTableLocator()->get('InclusionCriterias')->find('all', ['fields' => ['id', 'name', 'cardholder_col'], 'conditions' => ['location_id' => $nfsaCardholderTemp->location_id]])->toArray();
			//$exclusion_criterias 		= TableRegistry::getTableLocator()->get('ExclusionCriterias')->find('all', ['fields' => ['id', 'name']])->toArray();

			$nfsaFamilyMember 			= TableRegistry::getTableLocator()->get('NfsaFamilyTemps')->find('all')->where(['nfsa_cardholder_temp_id' => $nfsaCardholderTemp->id])->contain(['Relations', 'Genders'])->toArray();

			if ($this->request->is(['post'])) {
				$nfsaCardholderFamilyDetail = TableRegistry::getTableLocator()->get('NfsaFamilyTemps')
					->find(
						'all',
						[
							'fields' 	=>
							['id', 'gender_id', 'marital_status', 'disability_status', 'health_status', 'dob'],
							'conditions' => ['NfsaFamilyTemps.nfsa_cardholder_temp_id' => $nfsaCardholderTemp->id, 'hof' => 1]
						]
					)
					->first();

				$priority_marks = 0;
				if ($nfsaCardholderTemp->pvtg == 1) {
					$priority_marks = $priority_marks + 100;
				}
				if ($nfsaCardholderTemp->above_sixty == 1) {
					$priority_marks = $priority_marks + 10;
				}
				if ($nfsaCardholderTemp->marital_status == 1) {
					$priority_marks = $priority_marks + 10;
				}
				if ($nfsaCardholderTemp->disability_status == 1) {
					$priority_marks = $priority_marks + 10;
				}
				if ($nfsaCardholderTemp->health_status == 1) {
					$priority_marks = $priority_marks + 10;
				}
				if ($nfsaCardholderTemp->old_alone == 1) {
					$priority_marks = $priority_marks + 10;
				}
				if ($nfsaCardholderTemp->caste_id == 3 || $nfsaCardholderTemp->caste_id == 4) {
					$priority_marks = $priority_marks + 10;
				}

				$update = $this->NfsaCardholderTemps->updateAll(['application_status' => '7', 'activity_type_id' => '1', 'activity_flag' => '0', 'priority_marks' => $priority_marks], ["id" => $nfsaCardholderTemp->id]);
				$update = TableRegistry::getTableLocator()->get('NfsaFamilyTemps')->updateAll(['activity_type_id' => '1', 'activity_flag' => '0'], ["nfsa_cardholder_temp_id" => $nfsaCardholderTemp->id]);
				return $this->redirect(['controller' => 'NfsaCardholderTemps', 'action' => 'acknowledgement']);
			}
			
			$this->set(compact('nfsaCardholderTemp', 'nfsaFamilyMember', 'inclusion_criterias', 'exclusion_criterias'));
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
			$nfsa_cardholder_temp_id = $this->request->getSession()->read('Auth.User.id');
			$rgi_district_code = $this->request->getSession()->read('Auth.User.rgi_district_code');
			$rgi_block_code = $this->request->getSession()->read('Auth.User.rgi_block_code');
		} else {
			return	$this->redirect($this->Auth->logout());
		}
		$nfsaCardholderTemp = $this->NfsaCardholderTemps
			->find(
				'all',
				[
					'fields' 	=>
					['id', 'ack_no', 'mobileno', 'uid', 'name', 'name_sl', 'fathername', 'fathername_sl', 'caste_id', 'mothername', 'mothername_sl', 'res_address', 'res_address_hn', 'tolla_mohalla', 'rgi_district_code', 'rgi_block_code', 'rgi_village_code', 'location_id', 'application_status', 'applicationType', 'applicationType_rule_id', 'SeccDistricts.name', 'SeccBlocks.name', 'SeccVillageWards.id', 'Panchayats.name', 'SeccVillageWards.name', 'Dealers.name', 'Dealers.License_no', 'Cardtypes.name', 'is_bank', 'bank_master_id', 'branch_master_id', 'bank_account_no', 'bank_ifsc_code', 'is_lpg', 'lpg_company', 'lpg_consumer_no', 'BankMasters.name', 'BranchMasters.name', 'non_gov', 'above_sixty', 'marital_status', 'disability_status', 'health_status', 'beggar', 'rag_picker', 'worker', 'street_vendor', 'pvtg', 'old_alone'],
					'conditions' => ['NfsaCardholderTemps.rgi_district_code' => $rgi_district_code, 'NfsaCardholderTemps.rgi_block_code' => $rgi_block_code, 'NfsaCardholderTemps.id=' . "'" . $nfsa_cardholder_temp_id . "'", 'application_status' => 7],
					'contain'	=> ['SeccDistricts', 'SeccBlocks', 'Panchayats', 'SeccVillageWards', 'Dealers', 'Castes', 'Cardtypes', 'BankMasters', 'BranchMasters']
				]
			)
			->first();
		if ($nfsaCardholderTemp) {
			$nfsaFamilyMember 			= TableRegistry::getTableLocator()->get('NfsaFamilyTemps')->find('all')->where(['nfsa_cardholder_temp_id' => $nfsaCardholderTemp->id])->contain(['Relations', 'Genders'])->toArray();

			$hof_age = TableRegistry::getTableLocator()->get('NfsaFamilyTemps')->find('all', ['fields' => ['id', 'dob'], 'conditions' => ['nfsa_cardholder_temp_id' => $nfsa_cardholder_temp_id, 'hof' => 1]])->first();
			$inclusion_criterias 		= TableRegistry::getTableLocator()->get('InclusionCriterias')->find('all', ['fields' => ['id', 'name', 'cardholder_col'], 'conditions' => ['location_id' => $nfsaCardholderTemp->location_id]])->toArray();
			$exclusion_criterias 		= TableRegistry::getTableLocator()->get('ExclusionCriterias')->find('all', ['fields' => ['id', 'name'], 'recursive' => -1])->toArray();

			$this->set(compact('nfsaCardholderTemp', 'nfsaFamilyMember', 'inclusion_criterias', 'exclusion_criterias', 'hof_age'));
		} else {
			return	$this->redirect(['controller' => 'SeccCardholders', 'action' => 'logout']);
		}
	}
}
