<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;


class ErcmsValidateController extends AppController
{
	public function initialize()
	{
		parent::initialize();
		$this->loadComponent('RequestHandler');
		$this->Auth->allow(['checkaadhar', 'checkDuplicateMobile']);
	}
	/**
	 * Create Aadhar Format at the time of server Side
	 *
	 */
	function d($j, $k)
	{
		$table = array(
			array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9),
			array(1, 2, 3, 4, 0, 6, 7, 8, 9, 5),
			array(2, 3, 4, 0, 1, 7, 8, 9, 5, 6),
			array(3, 4, 0, 1, 2, 8, 9, 5, 6, 7),
			array(4, 0, 1, 2, 3, 9, 5, 6, 7, 8),
			array(5, 9, 8, 7, 6, 0, 4, 3, 2, 1),
			array(6, 5, 9, 8, 7, 1, 0, 4, 3, 2),
			array(7, 6, 5, 9, 8, 2, 1, 0, 4, 3),
			array(8, 7, 6, 5, 9, 3, 2, 1, 0, 4),
			array(9, 8, 7, 6, 5, 4, 3, 2, 1, 0),
		);

		return $table[$j][$k];
	}

	function p($pos, $num)
	{
		$table = array(
			array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9),
			array(1, 5, 7, 6, 2, 8, 3, 0, 9, 4),
			array(5, 8, 0, 3, 7, 9, 6, 1, 4, 2),
			array(8, 9, 1, 6, 0, 4, 3, 5, 2, 7),
			array(9, 4, 5, 3, 1, 2, 6, 8, 7, 0),
			array(4, 2, 8, 6, 5, 7, 3, 9, 0, 1),
			array(2, 7, 9, 3, 8, 0, 6, 4, 1, 5),
			array(7, 0, 4, 6, 9, 1, 3, 2, 5, 8),
		);

		return $table[$pos % 8][$num];
	}

	function checkuid($number)
	{
		$c = 0;
		$n = strrev($number);
		$len = strlen($n);
		for ($i = 0; $i < $len; $i++)
			$c = $this->d($c, $this->p($i, $n[$i]));

		if ($c == 0) {
			return true;
		}
		return false;
	}
	/**
	 * Create Aadhar No at the time of registration
	 *
	 */
	public function checkaadhar($aadhar = NULL, $member_id = NULL)
	{
		$connection = ConnectionManager::get('default');
		$dbRationBackup_conn = ConnectionManager::get('dbRationBackup');
		
		$aadhar_data = $this->request->getData();
		if ($this->request->is(['ajax'])) {
			$this->autoRender = false;
			$this->viewBuilder()->setLayout('ajax');
			$aadhar = $aadhar_data['aadhar'];
			if (array_key_exists('member_id', $aadhar_data)) {
				$member_id = $aadhar_data['member_id'];
			} else {
				$member_id = '';
			}
		}

		if (!empty($aadhar)) {
			if ($member_id != '') {
				$aadhar_count1 = $connection
					->newQuery()
					->select(['Acknowledgement No' => 'ack_no_ercms'])
					->from('secc_family_add_temps')
					->WHERE(['uid' => $aadhar, 'id<>"' . $member_id . '"','OR' => [['activity_flag'=>0], ['activity_flag'=>1]]])->execute();
				if ($aadhar_count1 && count($aadhar_count1) > 0) {
					$aadhar_count1 = $aadhar_count1->fetch('assoc');
					$result = array("valid" => true, "data" => $aadhar_count1);
					if ($this->request->is(['ajax'])) {
						echo json_encode($result);
						die;
					} else {
						return json_encode($result);
					}
				}
			} else {
				//$aadhar_count1 = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->find()->select(['Acknowledgement No'=>'ack_no_ercms'])->WHERE(['uid' => $aadhar, 'OR' => ['activity_flag<>0', 'activity_flag<>1']])->first();
				$aadhar_count1 = $connection
					->newQuery()
					->select(['Acknowledgement No' => 'ack_no_ercms'])
					->from('secc_family_add_temps')
					->WHERE(['uid' => $aadhar,'OR' => [['activity_flag'=>0], ['activity_flag'=>1]]])->execute();

				if ($aadhar_count1 && count($aadhar_count1) > 0) {
					$aadhar_count1 = $aadhar_count1->fetch('assoc');
					$result = array("valid" => true, "data" => $aadhar_count1);
					if ($this->request->is(['ajax'])) {
						echo json_encode($result);
						die;
					} else {
						return json_encode($result);
					}
				}
			}
			$aadhar_count2 = $dbRationBackup_conn
				->newQuery()
				->select(['Acknowledgement No' => 'ack_no_ercms'])
				->from('secc_family_temps')
				->WHERE(['uid' => $aadhar,'OR' => [['activity_flag'=>0], ['activity_flag'=>1]]])
				->execute();
			if ($aadhar_count2 && count($aadhar_count2) > 0) {
				$aadhar_count2 = $aadhar_count2->fetch('assoc');
				$result = array("valid" => true, "data" => $aadhar_count2);
				if ($this->request->is(['ajax'])) {
					echo json_encode($result);
					die;
				} else {
					return json_encode($result);
				}
			}
			$aadhar_count3 = $dbRationBackup_conn
				->newQuery()
				->select(['Ration Card No' => 'rationcard_no'])
				->from('secc_families')
				->WHERE(['uid' => $aadhar])
				->execute();
			if ($aadhar_count3 && count($aadhar_count3) > 0) {
				$aadhar_count3 = $aadhar_count3->fetch('assoc');
				$result = array("valid" => true, "data" => $aadhar_count3);
				if ($this->request->is(['ajax'])) {
					echo json_encode($result);
					die;
				} else {
					return json_encode($result);
				}
			}else {
				$result = array("valid" => false);
				if ($this->request->is(['ajax'])) {
					echo json_encode($result);
					die;
				} else {
					return json_encode($result);
				}
			}
		} else {
			$result = array("valid" => false);
			if ($this->request->is(['ajax'])) {
				echo json_encode($result);
				die;
			} else {
				return json_encode($result);
			}
		}
	}

	/**
	 * Check Aadhar No at the time of mapping from Operator
	 *
	 */
	public function checkopaadhar($aadhar = NULL, $member_id = NULL)
	{
		$connection = ConnectionManager::get('default');
		$dbRationBackup_conn = ConnectionManager::get('dbRationBackup');
		
		$aadhar_data = $this->request->getData();
		if ($this->request->is(['ajax'])) {
			$this->autoRender = false;
			$this->viewBuilder()->setLayout('ajax');
			$aadhar = $aadhar_data['aadhar'];
			if (array_key_exists('member_id', $aadhar_data)) {
				$member_id = $aadhar_data['member_id'];
			} else {
				$member_id = '';
			}
		}

		if (!empty($aadhar)) {
			if ($member_id != '') {
				$aadhar_count1 = $connection
					->newQuery()
					->select(['Acknowledgement No' => 'ack_no_ercms'])
					->from('secc_family_add_temps')
					->WHERE(['uid' => $aadhar, 'id<>"' . $member_id . '"','OR' => [['activity_flag'=>0], ['activity_flag'=>1]]])->execute();
				if ($aadhar_count1 && count($aadhar_count1) > 0) {
					$aadhar_count1 = $aadhar_count1->fetch('assoc');
					$result = array("valid" => true, "data" => $aadhar_count1);
					if ($this->request->is(['ajax'])) {
						echo json_encode($result);
						die;
					} else {
						return json_encode($result);
					}
				}
			} else {
				//$aadhar_count1 = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->find()->select(['Acknowledgement No'=>'ack_no_ercms'])->WHERE(['uid' => $aadhar, 'OR' => ['activity_flag<>0', 'activity_flag<>1']])->first();
				$aadhar_count1 = $connection
					->newQuery()
					->select(['Acknowledgement No' => 'ack_no_ercms'])
					->from('secc_family_add_temps')
					->WHERE(['uid' => $aadhar,'OR' => [['activity_flag'=>0], ['activity_flag'=>1]]])->execute();

				if ($aadhar_count1 && count($aadhar_count1) > 0) {
					$aadhar_count1 = $aadhar_count1->fetch('assoc');
					$result = array("valid" => true, "data" => $aadhar_count1);
					if ($this->request->is(['ajax'])) {
						echo json_encode($result);
						die;
					} else {
						return json_encode($result);
					}
				}
			}
			
			// $aadhar_count2 = $dbRationBackup_conn
			// 	->newQuery()
			// 	->select(['Acknowledgement No' => 'ack_no_ercms'])
			// 	->from('hhd_ercms_pending_news')
			// 	->WHERE(['uid' => $aadhar])
			// 	->execute();
			// if ($aadhar_count2 && count($aadhar_count2) > 0) {
			// 	$aadhar_count2 = $aadhar_count2->fetch('assoc');
			// 	$result = array("valid" => true, "data" => $aadhar_count2);
			// 	if ($this->request->is(['ajax'])) {
			// 		echo json_encode($result);
			// 		die;
			// 	} else {
			// 		return json_encode($result);
			// 	}
			// }
			$aadhar_count3 = $dbRationBackup_conn
				->newQuery()
				->select(['Ration Card No' => 'rationcard_no'])
				->from('secc_families')
				->WHERE(['uid' => $aadhar])
				->execute();
			if ($aadhar_count3 && count($aadhar_count3) > 0) {
				$aadhar_count3 = $aadhar_count3->fetch('assoc');
				$result = array("valid" => true, "data" => $aadhar_count3);
				if ($this->request->is(['ajax'])) {
					echo json_encode($result);
					die;
				} else {
					return json_encode($result);
				}
			}else {
				$result = array("valid" => false);
				if ($this->request->is(['ajax'])) {
					echo json_encode($result);
					die;
				} else {
					return json_encode($result);
				}
			}
		} else {
			$result = array("valid" => false);
			if ($this->request->is(['ajax'])) {
				echo json_encode($result);
				die;
			} else {
				return json_encode($result);
			}
		}
	}
	/**
	 * check Duplicate Mobile No at the time of registration
	 *
	 */

	public function checkDuplicateMobile($mobile = NULL)
	{
		$connection = ConnectionManager::get('default');
		$dbRationBackup_conn = ConnectionManager::get('dbRationBackup');
		$mobile_data = $this->request->getData();
		if ($this->request->is(['ajax'])) {
			$this->autoRender = false;
			$this->viewBuilder()->setLayout('ajax');
			$mobile = $mobile_data['mobile'];
		}
		if ($this->request->getSession()->check('Auth')) {
			$secc_cardholder_add_temp_id = $this->request->getSession()->read('Auth.User.id');
		} else {
			$secc_cardholder_add_temp_id = '';
		}
		if (!empty($mobile)) {
			if ($secc_cardholder_add_temp_id != '') {
				$mobile_count1 = $connection
					->newQuery()
					->select(['Acknowledgement No' => 'ack_no_ercms'])
					->from('secc_family_add_temps')
					->WHERE(['mobile' => $mobile, 'secc_cardholder_add_temp_id<>"' . $secc_cardholder_add_temp_id . '"', 'OR' => [['activity_flag'=>0], ['activity_flag'=>1]]])->execute();
				if ($mobile_count1 && count($mobile_count1) > 0) {
					$mobile_count1 = $mobile_count1->fetch('assoc');
					$result = array("valid" => true, "data" => $mobile_count1);
					if ($this->request->is(['ajax'])) {
						echo json_encode($result);
						die;
					} else {
						return json_encode($result);
					}
				}
			} else {
				$mobile_count1 = $connection
					->newQuery()
					->select(['Acknowledgement No' => 'ack_no_ercms'])
					->from('secc_family_add_temps')
					->WHERE(['mobile' => $mobile, 'OR' => [['activity_flag'=>0], ['activity_flag'=>1]]])->execute();
				if ($mobile_count1 && count($mobile_count1) > 0) {
					$mobile_count1 = $mobile_count1->fetch('assoc');
					$result = array("valid" => true, "data" => $mobile_count1);
					if ($this->request->is(['ajax'])) {
						echo json_encode($result);
						die;
					} else {
						return json_encode($result);
					}
				}
			}
			$mobile_count2 = $dbRationBackup_conn
				->newQuery()
				->select(['Acknowledgement No' => 'ack_no_ercms'])				
				->from('secc_family_temps')
				->WHERE(['mobile' => $mobile,'OR' => [['activity_flag'=>0], ['activity_flag'=>1]]])->execute();
			if ($mobile_count2 && count($mobile_count2) > 0) {
				$mobile_count2 = $mobile_count2->fetch('assoc');
				$result = array("valid" => true, "data" => $mobile_count2);
				if ($this->request->is(['ajax'])) {
					echo json_encode($result);
					die;
				} else {
					return json_encode($result);
				}
			}

			// $mobile_count3 = $dbRationBackup_conn
			// 	->newQuery()
			// 	->select(['Ration Card No' => 'rationcard_no'])
			// 	->from('mobile_backups')
			// 	->WHERE(['mobile' => $mobile])->execute();
			// if ($mobile_count3 && count($mobile_count3) > 0) {
			// 	$mobile_count3 = $mobile_count3->fetch('assoc');
			// 	$result = array("valid" => true, "data" => $mobile_count3);
			// 	if ($this->request->is(['ajax'])) {
			// 		echo json_encode($result);
			// 		die;
			// 	} else {
			// 		return json_encode($result);
			// 	}
			// } else {
			// 	$result = array("valid" => false);
			// 	if ($this->request->is(['ajax'])) {
			// 		echo json_encode($result);
			// 		die;
			// 	} else {
			// 		return json_encode($result);
			// 	}
			// }
		} else {
			$result = array("valid" => false);
			if ($this->request->is(['ajax'])) {
				echo json_encode($result);
				die;
			} else {
				return json_encode($result);
			}
		}
	}

	/**
	 * check Duplicate Mobile No at the time of registration
	 *
	 */

	public function checkopDuplicateMobile($mobile = NULL)
	{
		$connection = ConnectionManager::get('default');
		$dbRationBackup_conn = ConnectionManager::get('dbRationBackup');
		$mobile_data = $this->request->getData();
		if ($this->request->is(['ajax'])) {
			$this->autoRender = false;
			$this->viewBuilder()->setLayout('ajax');
			$mobile = $mobile_data['mobile'];
		}
		if ($this->request->getSession()->check('OperatorPendingApp')) {
			$secc_cardholder_add_temp_ack_no = $this->request->getSession()->read('OperatorPendingApp.ack_no');
		} else {
			$secc_cardholder_add_temp_ack_no = '';
		}
		if (!empty($mobile)) {
			if ($secc_cardholder_add_temp_ack_no != '') {
				$mobile_count1 = $connection
					->newQuery()
					->select(['Acknowledgement No' => 'ack_no_ercms'])
					->from('secc_family_add_temps')
					->WHERE(['mobile' => $mobile, 'ack_no_ercms <>"' . $secc_cardholder_add_temp_ack_no . '"', 'OR' => [['activity_flag'=>0], ['activity_flag'=>1]]])->execute();
				if ($mobile_count1 && count($mobile_count1) > 0) {
					$mobile_count1 = $mobile_count1->fetch('assoc');
					$result = array("valid" => true, "data" => $mobile_count1);
					if ($this->request->is(['ajax'])) {
						echo json_encode($result);
						die;
					} else {
						return json_encode($result);
					}
				}
			} else {
				$mobile_count1 = $connection
					->newQuery()
					->select(['Acknowledgement No' => 'ack_no_ercms'])
					->from('secc_family_add_temps')
					->WHERE(['mobile' => $mobile, 'OR' => [['activity_flag'=>0], ['activity_flag'=>1]]])->execute();
				if ($mobile_count1 && count($mobile_count1) > 0) {
					$mobile_count1 = $mobile_count1->fetch('assoc');
					$result = array("valid" => true, "data" => $mobile_count1);
					if ($this->request->is(['ajax'])) {
						echo json_encode($result);
						die;
					} else {
						return json_encode($result);
					}
				}
			}
			// $mobile_count2 = $dbRationBackup_conn
			// 	->newQuery()
			// 	->select(['Acknowledgement No' => 'ack_no_ercms'])				
			// 	->from('hhd_ercms_pending_news')
			// 	->WHERE(['mobile' => $mobile])->execute();
			// if ($mobile_count2 && count($mobile_count2) > 0) {
			// 	$mobile_count2 = $mobile_count2->fetch('assoc');
			// 	$result = array("valid" => true, "data" => $mobile_count2);
			// 	if ($this->request->is(['ajax'])) {
			// 		echo json_encode($result);
			// 		die;
			// 	} else {
			// 		return json_encode($result);
			// 	}
			// }

			// $mobile_count3 = $dbRationBackup_conn
			// 	->newQuery()
			// 	->select(['Ration Card No' => 'rationcard_no'])
			// 	->from('mobile_backups')
			// 	->WHERE(['mobile' => $mobile])->execute();
			// if ($mobile_count3 && count($mobile_count3) > 0) {
			// 	$mobile_count3 = $mobile_count3->fetch('assoc');
			// 	$result = array("valid" => true, "data" => $mobile_count3);
			// 	if ($this->request->is(['ajax'])) {
			// 		echo json_encode($result);
			// 		die;
			// 	} else {
			// 		return json_encode($result);
			// 	}
			// } else {
			// 	$result = array("valid" => false);
			// 	if ($this->request->is(['ajax'])) {
			// 		echo json_encode($result);
			// 		die;
			// 	} else {
			// 		return json_encode($result);
			// 	}
			// }
		} else {
			$result = array("valid" => false);
			if ($this->request->is(['ajax'])) {
				echo json_encode($result);
				die;
			} else {
				return json_encode($result);
			}
		}
	}

	/**
	 * Create acknowledgement No
	 *
	 */

	public function acknowledgementNo($rgi_district_code = NULL, $activity_id = NULL)
	{   $card_type_id=8;
		if ($activity_id == 2 || $activity_id == 6) {
			$seccCardholderAddTemps     = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')
				->find('all')
				->select(['ack_no' => 'IFNULL(max(ack_no_ercms),0)'])
				->where(['rgi_district_code' => $rgi_district_code, 'activity_type_id' => $activity_id])
				->first();
		} else {
			$seccCardholderAddTemps 	= TableRegistry::getTableLocator()->get('SeccCardholderAddTemps')
				->find('all')
				->select(['ack_no' => 'IFNULL(max(ack_no),0)'])
				->where(['rgi_district_code' => $rgi_district_code, 'activity_type_id' => $activity_id])
				->first();
		}
		
		if ($seccCardholderAddTemps) {
			$ack_no = $seccCardholderAddTemps->ack_no;
			$lenAck = strlen($ack_no);
			$ackCount = str_pad(substr($ack_no, 6, $lenAck) + 1, 6, '0', STR_PAD_LEFT);
			$ack_no = $rgi_district_code . str_pad($card_type_id, 1, '0', STR_PAD_LEFT) . $ackCount;
		} else {
			$ack_no = '';
			$lenAck = strlen($ack_no);
			$ackCount = str_pad(substr($ack_no, 6, $lenAck) + 1, 6, '0', STR_PAD_LEFT);
			$ack_no = $rgi_district_code . str_pad($card_type_id, 1, '0', STR_PAD_LEFT) . $ackCount;
		}

		// $con = ConnectionManager::get('default');
		// $result=$con->execute("select MAX(cast(ack_no as signed)) as ack_no from  secc_cardholder_temps where rgi_district_code='$rgi_district_code' and activity_type_id ='1'")->fetch('assoc');
		// if(!$result){
		// 	$lenAck = strlen($result['ack_no']);
		// }else{
		// 	$lenAck = 0;
		// }	

		//$lenAck = strlen($result['ack_no']);}
		//$ackCount = str_pad(substr($result['ack_no'], 5, $lenAck) + 1, 5, '0', STR_PAD_LEFT);
		//$ack_no = $rgi_district_code . str_pad($activity_id, 2, '0', STR_PAD_LEFT) . $ackCount;
		// $sqlAck = mysql_query("select MAX(cast(ack_no as signed)) as ack_no from  secc_cardholder_temps where rgi_district_code='$rgi_district_code' and activity_type_id ='1'");
		//$recAck = mysql_fetch_array($sqlAck);

		return $ack_no;
	}

	/**
	 * Create RationCard No
	 *
	 */
	
	
	public function rationcardNo($cardtype_id = NULL)
    {
        if ($cardtype_id=='5' || $cardtype_id=='6')
        {
            $sqlRationcardNo = TableRegistry::getTableLocator()->get('state_reports')->find('all')->select(['rationPhSlno'])->first()->toArray();
            
            $sqlRationcardNo=$sqlRationcardNo['rationPhSlno'];
        }
        elseif ($cardtype_id=='7')
        {
            $sqlRationcardNo = TableRegistry::getTableLocator()->get('state_reports')->find('all')->select(['rationWhiteSlno'])->first()->toArray();
            $sqlRationcardNo=$sqlRationcardNo['rationWhiteSlno'];
        }
        else
        {
            $sqlRationcardNo = TableRegistry::getTableLocator()->get('state_reports')->find('all')->select(['jsfss_ration_sno'])->first()->toArray();
            $sqlRationcardNo=$sqlRationcardNo['jsfss_ration_sno'];
        }
       
        $rationcard_no=$sqlRationcardNo+1;
        return $rationcard_no;
    }

	/**
	 * Get Branch Name on change of Bank Name
	 *
	 */
	public function getBranchByBank($bank_id = null)
	{
		$request_data = $this->request->getData();
		if ($this->request->is(['ajax'])) {
			$this->autoRender = false;
			$this->viewBuilder()->setLayout('ajax');
			$bank_id = $request_data['bank_id'];
		}
		$branchData = TableRegistry::getTableLocator()->get('BranchMasters');
		if (!empty($bank_id)) {
			$query = $branchData->find('list', [
				'keyField' => 'id',
				'valueField' => 'name',
				'conditions' => ['bank_master_id=' . "'" . $bank_id . "'"]

			]);
		} else {
			$query = $branchData->find('list', [
				'keyField' => 'id',
				'valueField' => 'name'
			]);
		}
		$bank_branch = $query->toArray();
		if ($this->request->is(['ajax'])) {
			echo json_encode($bank_branch);
			die;
		} else {
			return $bank_branch;
		}
	}
	/**
	 * Get IFSC Code on change of Bank and Branch Name
	 *
	 */
	public function getIfscByBankAndBranch($bank_id = null, $branch_id = null)
	{
		$request_data = $this->request->getData();
		if ($this->request->is(['ajax'])) {
			$this->autoRender = false;
			$this->viewBuilder()->setLayout('ajax');
			$bank_id = $request_data['bank_id'];
			$branch_id = $request_data['branch_id'];
		}

		$branchTable = TableRegistry::getTableLocator()->get('BranchMasters');
		if (!empty($bank_id) && !empty($branch_id)) {
			$query = $branchTable->find('all', [
				'field' => ['ifsc_code'],
				'conditions' => ['id' => $branch_id, 'bank_master_id=' . "'" . $bank_id . "'"]
			])->first();
		} else {
			$ifsc_code = '';
		}

		$ifsc_code = $query->toArray();
		if ($this->request->is(['ajax'])) {
			echo json_encode($ifsc_code);
			die;
		} else {
			return $ifsc_code;
		}
	}

	/**
	 * Get Bank and Branch Name on IFSC Code
	 * @param null $ifsc_code
	 */
	public function getBankBranchDataByIfsc($ifsc_code = null)
	{
		$request_data = $this->request->getData();
		$branchMasters = array();
		$bankBranchData = array();
		$branchData = array();
		$bankData = array();
		if ($this->request->is('ajax')) {
			$this->autoRender = false;
			$this->viewBuilder()->setLayout('ajax');
			$ifsc_code = $request_data['ifsc_code'];
		}
		$branchData = TableRegistry::getTableLocator()->get('BranchMasters')
			->find('all', [
				'fields' => ['BranchMasters.id', 'BranchMasters.name', 'BranchMasters.bank_master_id'],
				'conditions' => ['BranchMasters.ifsc_code=' . "'" . $ifsc_code . "'"]
			]);
		$branchMasters = $branchData->toArray();
		$branches = '';
		$banks = '';
		if (!empty($branchMasters)) {
			$branch_id = $branchMasters[0]->id;
			$branch_name = $branchMasters[0]->name;
			$branches .= '<option value="' . $branch_id . '">' . $branch_name . '</option>';

			// Start : to get Bank Details
			$getBankData = TableRegistry::getTableLocator()->get('BankMasters')->find('all', array('fields' => array('BankMasters.id', 'BankMasters.name'), 'conditions' => array('BankMasters.id=' . "'" . $branchMasters[0]->bank_master_id . "'"), 'recursive' => -1));
			$bankMasters = $getBankData->toArray();
			//echo "<pre>";print_r($bankMasters);die;

			if (!empty($bankMasters)) {
				//echo "<pre>";print_r($bankMasters);die;
				$bank_id = $bankMasters[0]->id;
				$bank_name = $bankMasters[0]->name;
				$banks .= '<option value="' . $bank_id . '">' . $bank_name . '</option>';
			}
			// Ended : to get Bak Details
		}

		echo $banks . '***' . $branches;
		die;
	}
	/**
	 * Get Account Digit Count
	 * @param null $ifsc_code
	 */
	public function getBankAccDigit($bank_id = null)
	{
		$request_data = $this->request->getData();
		$this->autoRender = false;
		if ($this->request->is('ajax')) {
			// $this ->autoRender=false;
			$this->viewBuilder()->setLayout('ajax');
			$bank_id = $request_data['bank_id'];
			$branch_id = $request_data['branch_id'];
		}
		echo $accDigit = 0;
		$bankData = TableRegistry::getTableLocator()->get('BankMasters')->find('all', array('fields' => array('BankMasters.acc_digit'), 'conditions' => array('BankMasters.id=' . "'" . $bank_id . "'"), 'recursive' => -1));
		$obj_to_array_bankData = $bankData->toArray();
		$accDigit = $obj_to_array_bankData[0]->acc_digit;
		if ($this->request->is('ajax')) {
			echo $accDigit;
		} else {
			echo $accDigit;
		}
	}

	/**
	 *  Check Aadhar at the time of bso & dso verification in SeccFamilies & SeccFamilies Add Temps
	 *
	 */
	public function checkAadhar_verify($aadhar = NULL)
	{	
		$dbRationBackup_conn = ConnectionManager::get('dbRationBackup');
		$connection = ConnectionManager::get('default');
		if (!empty($aadhar)) {
			$aadhar_count = $dbRationBackup_conn
							->newQuery()
							->select(['count'=>'count(uid)'])
							->from('secc_families')
							->WHERE(['uid' => $aadhar])
							->execute()
							->fetch('assoc');
				if($aadhar_count['count'] > 0){
					return $aadhar_count['count'];
				}else{
					$aadhar_count1 = $dbRationBackup_conn
									->newQuery()
									->select(['count'=>'count(uid)','activity_flag'])
									->from('secc_family_temps')
									->WHERE(['uid' => $aadhar])
									->execute()
									->fetch('assoc');									
					if($aadhar_count1['count'] > 0){
						//$res=$aadhar_count1->fetchAll('assoc');
						if ($aadhar_count1['activity_flag']=='0' || $aadhar_count1['activity_flag']=='1') {
							return 1;
						} else {
							return 0;
						}
						return $aadhar_count1['count'];
					} else {
						$aadhar_count2 = $connection
										->newQuery()
										->select(['count'=>'count(uid)'])
										->from('jsfss_secc_families')
										->WHERE(['uid' => $aadhar])
										->execute()
										->fetch('assoc');
						if($aadhar_count2['count']){
							return $aadhar_count2['count'];
						}else{
							$aadhar_count = 0;
						}
					}
				}		
		} else {
			$aadhar_count = 0;
		}
		return $aadhar_count;
	}

	/**
	 *  Check Mobile in SeccFamilies & SeccFamilies Add Temps
	 *
	 */
	public function checkMobile_verify1($mobile = NULL, $secc_cardholder_add_temp_id = NULL)
	{	
		$dbRationBackup_conn = ConnectionManager::get('dbRationBackup');
		
		if (!empty($mobile) && !empty($secc_cardholder_add_temp_id)) {
			$mobile_count = $dbRationBackup_conn
							->newQuery()
							->select(['mobile'])
							->from('secc_families')
							->WHERE(['mobile' => $mobile])
							->execute();
				if($mobile_count){
					return $mobile_count->rowCount();
				}else{
					$mobile_count = 0;
				}
			//$mobile_count = $mobile_count1 + $mobile_count2;
		} else {
			$mobile_count = 0;
		}
		return $mobile_count;
	}

	public function checkMobile_verify($mobile = NULL)
	{
		return 0;	
		$dbRationBackup_conn = ConnectionManager::get('dbRationBackup');
		$connection = ConnectionManager::get('default');
		if(!empty($mobile)) {
			$mobile_count = $dbRationBackup_conn
							->newQuery()
							->select(['mobile'])
							->from('secc_families')
							->WHERE(['mobile' => $mobile])
							->execute();
				if($mobile_count){
					return $mobile_count->rowCount();
				}else{
					$mobile_count1= $connection
								->newQuery()
								->select(['mobile'])
								->from('jsfss_secc_families')
								->WHERE(['mobile' => $mobile])								
								->execute();
					if($mobile_count1){
						return $mobile_count1->rowCount();
					}else{
						$mobile_count = 0;
					}
				}
			//$mobile_count = $mobile_count1 + $mobile_count2;
		} else {
			$mobile_count = 0;
		}
		return $mobile_count;
	}
	
	/**********Nfsa**************/

public function nfsaacknowledgementNo($rgi_district_code = NULL, $activity_id = NULL)
    {   

 
        if ($activity_id == 2 || $activity_id == 6) {
            $nfsaCardholderTemps     = TableRegistry::getTableLocator()->get('NfsaFamilyTemps')
                ->find('all')
                ->select(['ack_no' => 'IFNULL(max(ack_no_ercms),0)'])
                ->where(['rgi_district_code' => $rgi_district_code, 'activity_type_id' => $activity_id])
                ->first();
        } else {
            $nfsaCardholderTemps    = TableRegistry::getTableLocator()->get('NfsaCardholderTemps')
                ->find('all')
                ->select(['ack_no' => 'IFNULL(max(ack_no),0)'])
                ->where(['rgi_district_code' => $rgi_district_code, 'activity_type_id' => $activity_id])
                ->first();
        }

        if ($nfsaCardholderTemps) {
            $ack_no = $nfsaCardholderTemps->ack_no;
            $lenAck = strlen($ack_no);
            $ackCount = str_pad(substr($ack_no, 5, $lenAck) + 1, 5, '0', STR_PAD_LEFT);
            $ack_no = $rgi_district_code . str_pad($activity_id, 2, '0', STR_PAD_LEFT) . $ackCount;
        } else {
            $ack_no = '';
            $lenAck = strlen($ack_no);
            $ackCount = str_pad(substr($ack_no, 5, $lenAck) + 1, 5, '0', STR_PAD_LEFT);
            $ack_no = $rgi_district_code . str_pad($activity_id, 2, '0', STR_PAD_LEFT) . $ackCount;
        }

        return $ack_no;
    }
public function nfsaCheckAadharVerify($aadhar = NULL)
    {
        /**********
         * return 
         * 1:invlaid uid
         * 2:uid exist in secc_families
         * 3:uid exist in jsfss_secc_families
         * 4:uid exist in secc_family_add_temps green card request
         * 5:empty uid
         **********/
       
        $dbRationBackup_conn = ConnectionManager::get('dbRationBackup');
        $connection = ConnectionManager::get('default');
        if (empty($aadhar))
        {
            return 5;
        }
     
        $seccfamilies = $dbRationBackup_conn
							->newQuery()
							->select(['uid'])
							->from('secc_families')
							->WHERE(['uid' => $aadhar])
                            ->execute();

        $seccfamiliesRes=$seccfamilies->fetchAll('assoc');
        if (empty($seccfamiliesRes[0]['uid']))
        {
            $jsfssseccfamilies = $connection
                                    ->newQuery()
                                    ->select(['uid'])
                                    ->from('jsfss_secc_families')
                                    ->WHERE(['uid' => $aadhar])
                                    ->execute();

            $jsfssseccfamiliesRes=$jsfssseccfamilies->fetchAll('assoc');
            if (empty($jsfssseccfamiliesRes[0]['uid']))
            {
                $nfsafamilyaddtemps = $connection
                                    ->newQuery()
                                    ->select(['uid'])
                                    ->from('secc_family_add_temps')
                                    ->WHERE(['uid' => $aadhar])
                                    ->execute();

                $nfsafamilyaddtempsRes=$nfsafamilyaddtemps->fetchAll('assoc');
                if ($nfsafamilyaddtempsRes[0]['activity_flag']=='0' || $nfsafamilyaddtempsRes[0]['activity_flag']=='1')
                {
                    return 4;
                }
                else
                {
                    return 0;
                }
            }
            else
            {
                return 3;
            }
        }
        else
        {
            return 2;
        }

        return 0;
    }


}
