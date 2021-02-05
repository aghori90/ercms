<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

/**
 * JsfssDistrictReports Controller
 *
 * @property \App\Model\Table\JsfssDistrictReportsTable $JsfssDistrictReports
 *
 * @method \App\Model\Entity\JsfssDistrictReport[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class JsfssDistrictReportsController extends AppController
{

	function districtWiseReport()
	{	
		if ($this->request->getSession()->check('Auth')) {
			$group_id = $this->request->getSession()->read('Auth.User.group_id');
		} else {
			return	$this->redirect($this->Auth->logout());
		}
		if($group_id == 12 || $group_id == 13){
		$this->viewBuilder()->setLayout('admin');
		$datas = TableRegistry::getTableLocator()->get('jsfssDistrictReports')->find('all', ['fields' => ['rgi_district_code', 'districtName', 'greenCardHeadCount', 'greenCardMemberCount','bso_approved','bso_reject','dso_approved','dso_reject']])->toArray();
		$this->set(compact('datas'));
		}else{
			die("Unauthorised Access");
		}
	}

	

function BlockWiseReport($rgi_district_code)
	{	
		$this->viewBuilder()->setLayout('admin');
		$datas = TableRegistry::getTableLocator()->get('jsfss_block_reports')->find('all', ['fields' => ['blockName','rgi_district_code', 'districtName', 'rgi_block_code','blockName','greenCardHeadCount', 'greenCardMemberCount','bso_approved','bso_reject','dso_approved','dso_reject'],'conditions'=>['rgi_district_code'=>$rgi_district_code]])->toArray();
		$this->set(compact('datas'));
		
	}

	
	function villageWiseReport($rgi_block_code)
	{
		$this->viewBuilder()->setLayout('admin');
		$datas = TableRegistry::getTableLocator()->get('jsfss_village_reports')->find('all', ['fields' => ['rgi_block_code', 'rgi_village_code', 'blockName','villageName','greenCardHeadCount', 'greenCardMemberCount','bso_approved','bso_reject','dso_approved','dso_reject'],'conditions'=>['rgi_block_code'=>$rgi_block_code]])->toArray();
		$this->set(compact('datas'));
	}
	
	function villageWiseApplication($rgi_village_code)
	{
		$this->viewBuilder()->setLayout('admin');
		$datas = TableRegistry::getTableLocator()->get('SeccCardholderAddTemps')
				->find(
					'all',
					[
						'fields'     =>
						['id', 'ack_no', 'requested_mobile', 'uid', 'name', 'applicationType', 'fathername', 'fathername_sl', 'activity_flag','created', 'family_count',  'Cardtypes.name', 'caste_id', 'Castes.name'],
						'conditions' => ['rgi_village_code'=>$rgi_village_code, 'activity_type_id' => '1'],
						'contain'    => ['Cardtypes', 'Castes', 'SeccFamilyAddTemps' => ['fields' => ['secc_cardholder_add_temp_id', 'marital_status', 'disability_status', 'health_status', 'dob'], 'conditions' => ['hof' => '1', 'activity_type_id' => '1']]],
						'order' => ['SeccCardholderAddTemps.priority_marks' => 'desc', 'SeccCardholderAddTemps.created' => 'desc']						
					]
				)
				->toArray();
				
				//print_r($datas);die;
		
		//$datas = TableRegistry::getTableLocator()->get('secc_cardholder_add_temps')->find('all', ['fields' => ['id', 'ack_no', 'requested_mobile', 'uid', 'name', 'applicationType', 'fathername', 'fathername_sl',  'caste_id','Castes.name', 'Cardtypes.name',],'contain' => ['Cardtypes', 'Castes'],'conditions'=>['rgi_village_code'=>$rgi_village_code]])->toArray();
		
		$this->set(compact('datas'));
	}

	function villageWiseCron()
	{
		$this->autoRender = false;
				
		$connection = ConnectionManager::get('default'); 
		
		// Village wise BSO DSO Approved Report 		
		 $qrybsodso = "UPDATE jsfss_village_reports a JOIN (

			 with rec as (select case when activity_flag=1 then count(id) end as bso_approved,case when activity_flag=2 then count(id) end as bso_reject,case when activity_flag=3 then count(id) end as dso_approved,case when activity_flag=4 then count(id) end as dso_reject,rgi_village_code from secc_cardholder_add_temps where activity_type_id=1 group by rgi_village_code,activity_flag) 
			 select sum(bso_approved) as bso_approved,sum(bso_reject) as bso_reject,sum(dso_approved) as dso_approved,sum(dso_reject) as dso_reject,rgi_village_code from rec group by rgi_village_code
			 ) b ON a.rgi_village_code = b.rgi_village_code 
			 SET a.bso_approved=b.bso_approved, a.bso_reject = b.bso_reject, a.dso_approved = b.dso_approved, a.dso_reject = b.dso_reject";
		 $connection->execute($qrybsodso);
		
		//End  Village wise BSO DSO Approved Report 


		// Village wise Report 		
		$qry = "UPDATE jsfss_village_reports a JOIN (select rgi_village_code,count(id) as total from secc_cardholder_add_temps group by rgi_village_code ) b ON a.rgi_village_code = b.rgi_village_code SET greenCardHeadCount = total";
		$connection->execute($qry);
		
		$qry_fam = "UPDATE jsfss_village_reports a JOIN (select rgi_village_code,count(id) as total from secc_family_add_temps group by rgi_village_code ) b ON a.rgi_village_code = b.rgi_village_code SET greenCardMemberCount = total";
		$connection->execute($qry_fam);
		//End  Village wise Report 	
		
		
		// Block wise Report 		
		$qry_block = "UPDATE jsfss_block_reports a JOIN (select rgi_block_code,sum(greenCardHeadCount) as total_head,sum(greenCardMemberCount) as total_member,sum(bso_approved) as bso_approved,sum(bso_reject) as bso_reject,sum(dso_approved) as dso_approved,sum(dso_reject) as dso_reject from jsfss_village_reports group by rgi_block_code ) b ON a.rgi_block_code = b.rgi_block_code 
		SET greenCardHeadCount = total_head ,greenCardMemberCount = total_member, a.bso_approved = b.bso_approved ,a.bso_reject =b.bso_reject, a.dso_reject = b.dso_reject ,a.dso_approved = b.dso_approved";
		$connection->execute($qry_block);
	  // End Block wise Report 	
	  
	  // District wise Report 		
		$qry_dist = "UPDATE jsfss_district_reports a JOIN (select rgi_district_code,sum(greenCardHeadCount) as total_head,sum(greenCardMemberCount) as total_member,sum(bso_approved) as bso_approved,sum(bso_reject) as bso_reject,sum(dso_approved) as dso_approved,sum(dso_reject) as dso_reject from jsfss_block_reports group by rgi_district_code ) b ON a.rgi_district_code = b.rgi_district_code 
		SET greenCardHeadCount = total_head ,greenCardMemberCount = total_member , a.bso_approved = b.bso_approved ,a.bso_reject =b.bso_reject, a.dso_reject = b.dso_reject ,a.dso_approved = b.dso_approved";
		$connection->execute($qry_dist);
	  // End District wise Report 		
	
	}

	

}
