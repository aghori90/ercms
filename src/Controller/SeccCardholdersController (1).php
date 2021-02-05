<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Utility\Text;
use Cake\View\Helper\FormHelper;

/**
 * SeccCardholders Controller
 *
 * @property \App\Model\Table\SeccCardholdersTable $SeccCardholders
 *
 * @method \App\Model\Entity\SeccCardholder[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SeccCardholdersController extends AppController
{
    // var $components = array('Auth','RequestHandler');

    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['logout','nfsaLogin','home', 'login', 'ercmsRequest', 'index']);
    }

    public function home(...$path)
    {
    }
    /**
     * ercmsRequest method
     */

    public function index()
    {
        $this->getRequest()->getSession()->delete('Auth');//die();
    }

    /**
     * Login method
     *
     */

    public function login($user = NULL)
    {
        if ($this->request->is('post')) {
            $this->getRequest()->getSession()->delete('Auth');

            $reg_ration_no  =   filter_var($this->request->data['reg_ration_no'], FILTER_SANITIZE_STRING);
            $password       =   filter_var($this->request->data['password'], FILTER_SANITIZE_NUMBER_INT);

            /*********** Start : Login Check Module if already loggedin ******/
            if ($this->Auth->user('id')) {
                $this->Flash->error(__('You are already logged in!'));
                return $this->redirect(['controller' => 'SeccCardholderTemps', 'action' => 'dashboard']);
            } else {

                /*********** End : Login Check Module if already loggedin ******/

                // $check_ration_record         =   TableRegistry::getTableLocator()->get('SeccCardholders')->find('all', ['fields' => ['id', 'rationcard_no'], 'conditions' => ['rationcard_no' => $reg_ration_no, 'RIGHT(uid,8)' => $password]])->first();
                $check_ration_record = 0;
                $check_reg_record            =   TableRegistry::getTableLocator()->get('SeccCardholderAddTemps')->find('all', ['fields' => ['id', 'ack_no', 'application_status'], 'conditions' => ['ack_no' => $reg_ration_no, 'RIGHT(uid,8)' => $password, 'activity_type_id' => 1, 'applied_through'=>0]])->first();

                if (!empty($check_ration_record) > 0) {

                    $this->getRequest()->getSession()->write([
                        'Auth.User.id'                    => $check_ration_record->id,
                        'Auth.User.rationcard_no'         => $check_ration_record->rationcard_no
                    ]);

                    return $this->redirect(['controller' => 'SeccCardholders', 'action' => 'dashboard']);
                } else if (!empty($check_reg_record) > 0) {
                    $application_status         =   $check_reg_record->application_status;
                    if ($application_status == 1 || $application_status == 2 || $application_status == 3 || $application_status == 4 || $application_status == 5 || $application_status == 6 || $application_status == 7) {
                        $this->getRequest()->getSession()->write([
                            'Auth.User.id'                      => $check_reg_record->id,
                            'Auth.User.ack_no'                  => $check_reg_record->ack_no,
                            'Auth.User.application_status'      => $application_status
                        ]);
                    }

                    if ($application_status == 1) {
                        return $this->redirect(['controller' => 'SeccCardholderAddTemps', 'action' => 'personalDetails']);
                    } else if ($application_status == 2) {
                        return $this->redirect(['controller' => 'SeccCardholderAddTemps', 'action' => 'bankDetails']);
                    } else if ($application_status == 3) {
                        return $this->redirect(['controller' => 'SeccCardholderAddTemps', 'action' => 'additionalDetails']);
                    } else if ($application_status == 4) {
                        return $this->redirect(['controller' => 'SeccCardholderAddTemps', 'action' => 'addFamily']);
                    } else if ($application_status == 5) {
                        return $this->redirect(['controller' => 'SeccCardholderAddTemps', 'action' => 'documentDetails']);
                    } else if ($application_status == 6) {
                        return $this->redirect(['controller' => 'SeccCardholderAddTemps', 'action' => 'preview']);
                    } else if ($application_status == 7) {
                        return $this->redirect(['controller' => 'SeccCardholderAddTemps', 'action' => 'acknowledgement']);
                    } else if ($application_status == 8) { // In case Application is approved
                        $this->Flash->error(__('Your Application has been approved. Please login with your Rationcard No. provided. !!!'));
                        return $this->redirect(['controller' => 'SeccCardholders', 'action' => 'login']);
                    } else if ($application_status == 9) { // In case Application is rejected
                        $this->Flash->error(__('Your Application has been rejected. Please consult authorised person. !!!'));
                        return $this->redirect(['controller' => 'SeccCardholders', 'action' => 'login']);
                    } else {
                        $this->Flash->error(__('Invalid Username & Password. Please try again !!!'));
                    }
                } else {
                    $this->Flash->error(__('Invalid Username & Password. Please try again !!!'));
                }
            }
        }
    }


    /**
     * activityRequest method
     */
 public function searchRationcard()
    {
	if ($this->request->getSession()->check('Auth'))
        {
            $user_id            = $this->request->getSession()->read('Auth.User.id');
            $username           = $this->request->getSession()->read('Auth.User.username');
            $group_id           = $this->request->getSession()->read('Auth.User.group_id');
            $rgi_district_code  = $this->request->getSession()->read('Auth.User.rgi_district_code');
            $rgi_block_code     = $this->request->getSession()->read('Auth.User.rgi_block_code');
        }
        else
        {
            return    $this->redirect($this->Auth->logout());
        }
        $this->viewBuilder()->setLayout('admin');


        $query = TableRegistry::getTableLocator()->get('SeccBlocks');
        $SeccBlocks = $query->find('list',['keyField'=>'rgi_block_code','valueField'=>'name'])->where(['rgi_district_code'=>$rgi_district_code])->toArray();


        $query = TableRegistry::getTableLocator()->get('SeccDistricts');
        $SeccDistricts = $query->find('all')->select(['name'])->where(['rgi_district_code'=>$rgi_district_code])->first()->toArray();

        $districtName=$SeccDistricts['name'];
        $this->set(compact('districtName','vv','SeccBlocks','JsfssSeccCardholders'));

    }
   public function searchRationcardResult()
    {
        if ($this->request->getSession()->check('Auth'))
        {
            $user_id            = $this->request->getSession()->read('Auth.User.id');
            $username           = $this->request->getSession()->read('Auth.User.username');
            $group_id           = $this->request->getSession()->read('Auth.User.group_id');
            $rgi_district_code  = $this->request->getSession()->read('Auth.User.rgi_district_code');
            $rgi_block_code     = $this->request->getSession()->read('Auth.User.rgi_block_code');
        }
        else
        {
            return    $this->redirect($this->Auth->logout());
        }
        $this->viewBuilder()->setLayout('admin');

        if ($this->request->is(['post']))
        {
            $rationcard_no  = $this->request->getData('rationcard_no');

            $query = TableRegistry::getTableLocator()->get('JsfssSeccCardholders');
            $JsfssSeccCardholders = $query->find('all')->select(['name','fathername','rationcard_no','Castes.name'])->where(['rationcard_no'=>$rationcard_no])->contain(['castes']);

            if (!empty($JsfssSeccCardholders))
            {
                $JsfssSeccCardholders=$JsfssSeccCardholders->toArray();
            }
            else
            {
                $this->Flash->error(__('Rationcard does not exist'));
                return $this->redirect(['controller' => 'SeccCardholders', 'action' => 'searchRationcard']);
            }
        }

        $this->set(compact('districtName','vv','SeccBlocks','JsfssSeccCardholders'));
    }
  public function searchRationView()
    {
        if ($this->request->getSession()->check('Auth'))
        {
            $user_id            = $this->request->getSession()->read('Auth.User.id');
            $username           = $this->request->getSession()->read('Auth.User.username');
            $group_id           = $this->request->getSession()->read('Auth.User.group_id');
            $rgi_district_code  = $this->request->getSession()->read('Auth.User.rgi_district_code');
            $rgi_block_code     = $this->request->getSession()->read('Auth.User.rgi_block_code');
        }
        else
        {
            return    $this->redirect($this->Auth->logout());
        }
        $this->viewBuilder()->setLayout('admin');
        $ency_rationcard_no = $this->request->getData('rationcard_no');
        $rationcard_no=$this->appDecryptData($ency_rationcard_no);

        $JsfssSeccCardholdersObj = TableRegistry::getTableLocator()->get('JsfssSeccCardholders');
        $JsfssSeccFamiliesObj = TableRegistry::getTableLocator()->get('JsfssSeccFamilies');
        $SeccBlocksObj = TableRegistry::getTableLocator()->get('SeccBlocks');
        $SeccDistrictsObj = TableRegistry::getTableLocator()->get('SeccDistricts');
        $PanchayatsObj = TableRegistry::getTableLocator()->get('Panchayats');
        $DealersObj = TableRegistry::getTableLocator()->get('Dealers');
        $CardtypesObj = TableRegistry::getTableLocator()->get('Cardtypes');
        $SeccVillageWardsObj = TableRegistry::getTableLocator()->get('SeccVillageWards');
        $RelationsObj = TableRegistry::getTableLocator()->get('Relations');
        $GendersObj = TableRegistry::getTableLocator()->get('Genders');


        $JsfssSeccCardholders = $JsfssSeccCardholdersObj->find('all')->select(['name','name_sl','fathername','fathername_sl','family_count','rgi_district_code','rgi_block_code','rgi_village_code','cardtype_id','rationcard_no','dealer_id','panchayat_id','created'])->where(['rgi_district_code'=>$rgi_district_code,'rationcard_no'=>$rationcard_no])->first()->toArray();

        $JsfssSeccFamilies = $JsfssSeccFamiliesObj->find('all')->select(['name','name_sl','fathername','fathername_sl','mobile','gender_id','dob','relation_id','uid','disability_status','marital_status','health_status'])->where(['rationcard_no'=>$rationcard_no])->toArray();

        $SeccDistricts = $SeccDistrictsObj->find('all')->select('name')->where(['rgi_district_code'=>$JsfssSeccCardholders['rgi_district_code']])->first()->toArray();
        $districtName=$SeccDistricts['name'];

        $SeccBlocks = $SeccBlocksObj->find('all')->select('name')->where(['rgi_block_code'=>$JsfssSeccCardholders['rgi_block_code']])->first()->toArray();
        $blockName=$SeccBlocks['name'];



        if (!empty($JsfssSeccCardholders['panchayat_id']))
        {
            $Panchayats = $PanchayatsObj->find('all')->select('name')->where(['id'=>$JsfssSeccCardholders['panchayat_id']])->first()->toArray();
            $panchayatName=$Panchayats['name'];
        }
        $panchayatName=$Panchayats['name'];

        $Dealers = $DealersObj->find('all')->select(['name','address_hn'])->where(['id'=>$JsfssSeccCardholders['dealer_id']])->first()->toArray();



        $SeccVillageWards = $SeccVillageWardsObj->find('all')->select(['name'])->where(['rgi_village_code'=>$JsfssSeccCardholders['rgi_village_code']])->first()->toArray();
        $villName=$SeccVillageWards['name'];

        $Cardtypes = $CardtypesObj->find('all')->select(['name'])->where(['id'=>$JsfssSeccCardholders['cardtype_id']])->first()->toArray();
        $cardName=$Cardtypes['name'];

        $Relations = $RelationsObj->find('list',['keyField' => 'id','valueField' => 'name_hn'])->toArray();
        $Genders = $GendersObj->find('list',['keyField' => 'id','valueField' => 'name_hn'])->toArray();
        //debug($Relations);
        //die;

        $this->set(compact('districtName','rationcard_no','Relations','Dealers','cardName','JsfssSeccFamilies','villName','blockName','panchayatName','dealerName','dealerName','license_no','Genders','JsfssSeccCardholders'));
    }
    public function activtyRequest()
    {
    }
    public function logout()
    {
        $this->getRequest()->getSession()->delete('Auth');
        $this->Flash->success('You have successfully logged out');
        return $this->redirect(['controller' => 'SeccCardholders', 'action' => 'index']);
        /*if($group_id==0)
            return  $this->redirect('/Pages/display');
        else
            return  $this->redirect($this->Auth->logout());
        */
    }


    /**
     * ercmsRequest method
     */

    public function ercmsRequest()
    {
        $this->viewBuilder()->setLayout('admin');
    }

    /**
     * applicationList method
     */
/*---------------------------------dso-----------------------------------------------------*/
  function dsoSearchApplication()
    {
        if ($this->request->getSession()->check('Auth'))
        {
            $user_id            = $this->request->getSession()->read('Auth.User.id');
            $username           = $this->request->getSession()->read('Auth.User.username');
            $group_id           = $this->request->getSession()->read('Auth.User.group_id');
            $rgi_district_code  = $this->request->getSession()->read('Auth.User.rgi_district_code');
            $rgi_block_code     = $this->request->getSession()->read('Auth.User.rgi_block_code');
        }
        else
        {
            return    $this->redirect($this->Auth->logout());
        }
	if($group_id!='12')
	{
		return    $this->redirect($this->Auth->logout());
	}
        $this->viewBuilder()->setLayout('admin');
        $rgi_district_code  = $this->request->getSession()->read('Auth.User.rgi_district_code');

        $query = TableRegistry::getTableLocator()->get('SeccBlocks');
        $SeccBlocks = $query->find('list',['keyField'=>'rgi_block_code','valueField'=>'name'])->where(['rgi_district_code'=>$rgi_district_code])->toArray();

        $query = TableRegistry::getTableLocator()->get('SeccDistricts');
        $SeccDistricts = $query->find('all')->select(['name'])->where(['rgi_district_code'=>$rgi_district_code])->first()->toArray();

        $districtName=$SeccDistricts['name'];
        $this->set(compact('districtName','vv','SeccBlocks','JsfssSeccCardholders'));
    }
        public function dsoApplicationList($activity_id = NULL)
    {
        $this->viewBuilder()->setLayout('admin');
        if ($this->request->getSession()->check('Auth'))
        {
            $user_id = $this->request->getSession()->read('Auth.User.id');
            $group_id = $this->request->getSession()->read('Auth.User.group_id');
            $rgi_district_code = $this->request->getSession()->read('Auth.User.rgi_district_code');
            $rgi_block_code = $this->request->getSession()->read('Auth.User.rgi_block_code');
        }
        else
        {
            return  $this->redirect($this->Auth->logout());
        }


        if ($group_id!='12')
        {
            return  $this->redirect($this->Auth->logout());
        }
        //-------------------------------------------------------------------


        $rgi_block_code_frm=$this->request->getData('rgi_block_code');
        $rgi_village_code=$this->request->getData('rgi_village_code');
        $ack_no=$this->request->getData('ack_no');
        $activity_id=$this->request->getData('activity_type_id');
        $activity_flag=$this->request->getData('activity_flag');

	//echo $activity_flag;die;
        if (empty($activity_id) || empty($activity_flag)  )
        {
            $this->Flash->error(__('Block/Application status/Application type are mandatory.'));
            return $this->redirect(['controller' => 'SeccCardholders', 'action' => 'dsoSearchApplication']);
        }

	  if (empty($ack_no) && empty($rgi_block_code_frm))
        {
            $this->Flash->error(__('Block is  mandatory.'));
            return $this->redirect(['controller' => 'SeccCardholders', 'action' => 'dsoSearchApplication']);
        }


	if(!empty($ack_no))
        {
            $cardholder_condition = "SeccCardholderAddTemps.rgi_district_code ='" .  $rgi_district_code . "' AND SeccCardholderAddTemps.ack_no ='" .  $ack_no . "' AND SeccCardholderAddTemps.activity_type_id ='" . $activity_id . "'AND  activity_flag = '$activity_flag'";
        }
        elseif (!empty($rgi_block_code_frm) && (empty($ack_no) && empty($rgi_village_code) ) )
        {
            $cardholder_condition = "SeccCardholderAddTemps.rgi_block_code ='" .  $rgi_block_code_frm . "' AND SeccCardholderAddTemps.activity_type_id ='" . $activity_id . "'AND  activity_flag = '$activity_flag'";
        }
        elseif (!empty($rgi_village_code) && empty($ack_no) )
        {
            $cardholder_condition = "SeccCardholderAddTemps.rgi_village_code ='" .  $rgi_village_code . "' AND SeccCardholderAddTemps.activity_type_id ='" . $activity_id . "'AND  activity_flag = '$activity_flag'";
        }

	$seccCardholderAddTemp = TableRegistry::getTableLocator()->get('SeccCardholderAddTemps')
        ->find(
            'all',
            [
                'fields'     =>
                ['id', 'ack_no', 'requested_mobile', 'uid', 'name', 'applicationType', 'fathername', 'fathername_sl', 'cardtype_id', 'caste_id','created','rgi_village_code','family_count'],
                'conditions' => [$cardholder_condition],
                'contain'    => ['cardtypes', 'castes', 'SeccFamilyAddTemps' => ['fields' => ['secc_cardholder_add_temp_id', 'marital_status', 'disability_status', 'health_status', 'dob']]],
                'order' => ['SeccCardholderAddTemps.priority_marks' => 'desc', 'SeccCardholderAddTemps.created' => 'desc'],
                'limit' =>15
            ]
        )
        ->toArray();


        $CardtypesObj = TableRegistry::getTableLocator()->get('Cardtypes');
        $x = $CardtypesObj->find('list',['keyField' => 'id','valueField' => 'name'])->toArray();


	 $SeccVillageWardsObj = TableRegistry::getTableLocator()->get('SeccVillageWards');
        $villageList = $SeccVillageWardsObj->find('list',['keyField' => 'rgi_village_code','valueField','name'])->where(['rgi_block_code'=>$rgi_block_code])->toArray();



        $CastesObj = TableRegistry::getTableLocator()->get('Castes');
        $Castes = $CastesObj->find('list',['keyField' => 'id','valueField' => 'name'])->toArray();


        $this->set(compact('cardtypes ','x','Castes','villageList','seccCardholderAddTemp'));




    }
	function dsoApplicationView()
    {

        // die;
         if ($this->request->getSession()->check('Auth'))
         {
             $user_id            = $this->request->getSession()->read('Auth.User.id');
             $username           = $this->request->getSession()->read('Auth.User.username');
             $group_id           = $this->request->getSession()->read('Auth.User.group_id');
             $rgi_district_code  = $this->request->getSession()->read('Auth.User.rgi_district_code');
             $rgi_block_code     = $this->request->getSession()->read('Auth.User.rgi_block_code');
         }
         else
         {
             return    $this->redirect($this->Auth->logout());
         }


        $this->viewBuilder()->setLayout('admin');
        if ($this->request->is(['patch', 'post', 'put']))
        {
            $application_id = $this->request->getData('application_id');
            $activity_id = 1;
        }

        if ($this->request->getData('submit') == 'verify')
        {
            $secc_family_add_temp_id    = $this->request->data['secc_cardholder_add_temp_id'];

            $seccFamilyMember = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')
                                    ->find(
                                        'all',
                                        [
                                            'fields'     =>
                                            ['id', 'mobile', 'uid'],
                                            'conditions' => ['id' => $secc_family_add_temp_id],
                                        ]
                                    )
                                    ->first();


            $Ercms=new ErcmsValidateController;
            $aadharCount =  $Ercms->checkAadhar_verify($seccFamilyMember->uid);
            $mobileCount =  $Ercms->checkMobile_verify($seccFamilyMember->mobile);

            if ($aadharCount > 0)
            {
                $this->Flash->error(__('This Aadhar Number already exists. Please, try again.'));
            }
            elseif (($mobileCount == 0 && $aadharCount == 0) || ($mobileCount > 0 && $aadharCount == 0))
            {
                if ($mobileCount > 0)
                {
                    $update = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->updateAll(['mobile' => '', 'uid_verified' => 1], ["id" => $secc_family_add_temp_id]);
                }
                else
                {
                    $update = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->updateAll(['uid_verified' => 1], ["id" => $secc_family_add_temp_id]);
                    $this->Flash->success(__('Family Member Verified Successfully. '));
                }
            }
            else
            {
                $this->Flash->error(__('Family Member UID could not be verified. Please try again.'));
            }
        }

        if ($this->request->getData('submit') == 'approve_reject')
        {
            $apprv_status = $this->request->getData('action');
            $remarks = $this->request->getData('remarks');

            if ($apprv_status=='4' && empty($remarks))
            {
                $this->Flash->error(__('Please Fill remarks for rejection'));
                return $this->redirect(['controller' => 'SeccCardholders', 'action' => 'dsoSearchApplication']);
            }
            $application_id = $this->request->getData('application_id');

            if (empty($apprv_status) || empty($application_id) )
            {
                $this->Flash->error(__('Error occured. Please try again.'));
                return $this->redirect(['controller' => 'SeccCardholders', 'action' => 'dsoSearchApplication']);
            }


            $verified_count =   TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->find()->WHERE(['OR' => [
                'uid_verified is null',
                'uid_verified' => 0
            ], 'secc_cardholder_add_temp_id' => $application_id])->count();

            if ($verified_count > 0 &&  $apprv_status == 1)
            {
                $this->Flash->error(__('You need to verify each individual family member first to proceed. Please, try again.'));
                return $this->redirect(['controller' => 'SeccCardholders', 'action' => 'dsoSearchApplication']);
            }

            $datetime = date('Y-m-d H:i:s');

            $cardholder_add_temp_array =  TableRegistry::getTableLocator()->get('SeccCardholderAddTemps')
                                    ->find()
                                    ->select(['rgi_district_code', 'rgi_block_code','activity_flag','rgi_village_code','cardtype_id','ack_no'])
                                    ->where(['id'=>$application_id])
                                    ->first();


            $rgi_district_code_application=$cardholder_add_temp_array['rgi_district_code'];
            $rgi_block_code_application=$cardholder_add_temp_array['rgi_block_code'];
            $rgi_village_code_application=$cardholder_add_temp_array['rgi_village_code'];
            $ack_no=$cardholder_add_temp_array['ack_no'];
	    $activity_flag=$cardholder_add_temp_array['activity_flag'];
            if (empty($rgi_village_code_application) || empty($rgi_block_code_application) || empty($rgi_district_code_application))
            {
                $this->Flash->error(__('Empty Address Details..'));
                return $this->redirect(['controller' => 'SeccCardholders', 'action' => 'dsoSearchApplication']);
            }
            if ($rgi_district_code_application!=$rgi_district_code)
            {
                $this->Flash->error(__('Failed To Approve !.Application  belongs to another District'));
                return $this->redirect(['controller' => 'SeccCardholders', 'action' =>'dsoSearchApplication']);
            }
            $Ercms = new ErcmsValidateController;
            $rationcard_no =  $Ercms->rationcardNo($cardholder_add_temp_array['cardtype_id']);

            if ($rationcard_no != '')
            {
                //die;
                $connection = ConnectionManager::get('default');
                $id=$application_id;

                $connection->begin();
                $condition_seccf1 = ['secc_cardholder_add_temp_id' => $id,'uid_verified'=>'1'];

                $condition_seccf = ['secc_cardholder_add_temp_id' => $id];
                $condition_secc = ['id' => $id];

                if ($apprv_status=='3')
                {
                    $sqlFamilyInsert="insert into jsfss_secc_families (id, rationcard_no,secc_family_add_temp_id,ahl_tin, hhd_unique_no,jsfss_secc_cardholder_id, rgi_district_code, rgi_block_code, rgi_village_code, name, name_sl, fathername, fathername_sl, mothername, mothername_sl, relation_id, relation_sl, gender_id, dob, freeze_status, mobile, uid, uid_verified, bank_master_id, branch_master_id, accountNo, hof , uidFlag, created, modified, created_by, bfd1, bfd2, bfd3, dbtFlag,uidMobileChangeFlag,disability_status,marital_status,health_status) select uuid(), '$rationcard_no',id,ahl_tin, hhd_unique_no, '', rgi_district_code, rgi_block_code, rgi_village_code, name, name_sl, fathername, fathername_sl, mothername, mothername_sl, relation_id, relation_sl, gender_id, dob, freeze_status, mobile, uid,'1',bank_master_id, branch_master_id, accountNo, hof , uidFlag,'$datetime','$datetime','$user_id', bfd1, bfd2, bfd3, dbtFlag,'$datetime',disability_status,marital_status,health_status from secc_family_add_temps where secc_cardholder_add_temp_id=:secc_cardholder_add_temp_id and uid_verified=:uid_verified";
                    $dd=$connection->execute($sqlFamilyInsert, $condition_seccf1);
                    //debug($dd);
                    //die;


                    $sqlCardInsert="insert into jsfss_secc_cardholders(id, rationcard_no, name, name_sl, location_id, cardtype_id, fathername, fathername_sl, mothername, mothername_sl, caste_id, secc_district_id, secc_block_id, panchayat_id, secc_village_ward_id, rgi_district_code, rgi_block_code, rgi_village_code, res_address, res_address_hn, tolla_mohalla, qtr_plot_no, holding_no, dealer_id, status, family_count, mobile_count, uid_count, printFlag, applicationType,applicationType_rule_id,activityFlag, activityType, dbtFlag, liftedCount, created, modified, verified, created_by, modified_by, old_alone,non_gov,above_sixty,marital_status,disability_status,health_status,beggar,rag_picker,worker,street_vendor,pvtg,is_lpg,lpg_company,lpg_consumer_no,is_bank,bank_account_no,bank_master_id,bank_ifsc_code) select uuid(), '$rationcard_no', name, name_sl, location_id, cardtype_id, fathername, fathername_sl, mothername, mothername_sl, caste_id, secc_district_id, secc_block_id, panchayat_id, secc_village_ward_id, rgi_district_code, rgi_block_code, rgi_village_code, res_address, res_address_hn, tolla_mohalla, qtr_plot_no, holding_no,dealer_id,status,family_count, mobile_count, uid_count, printFlag, applicationType,applicationType_rule_id,activityFlag, activityType, dbtFlag, liftedCount,'$datetime','$datetime','$datetime','$user_id','$user_id',old_alone,non_gov,above_sixty,marital_status,disability_status,health_status,beggar,rag_picker,worker,street_vendor,pvtg,is_lpg,lpg_company,lpg_consumer_no,is_bank,bank_account_no,bank_master_id,bank_ifsc_code  from secc_cardholder_add_temps where id=:id ";
                    $results = $connection->execute($sqlCardInsert, $condition_secc);


                    $sqlfamilyStateUpdte="update state_reports set jsfss_ration_sno='$rationcard_no'";
                    $connection->execute($sqlfamilyStateUpdte);



                    $status='approved';
                }
                else
                {
                    $status='rejected';
                }

                $sqlUpdte="update secc_cardholder_add_temps set rationcard_no='$rationcard_no', activity_flag='$apprv_status', modified='$datetime', modified_by='$user_id',dso_modifiedDate='$datetime' where id=:id";
                $connection->execute($sqlUpdte, $condition_secc);

                $sqlfamilyUpdte="update secc_family_add_temps set rationcard_no='$rationcard_no', activity_flag='$apprv_status', modified='$datetime', modified_by='$user_id', dso_modifiedDate='$datetime' where secc_cardholder_add_temp_id=:secc_cardholder_add_temp_id";
                $connection->execute($sqlfamilyUpdte, $condition_seccf);



                $msg = $username . " has $status request for Add New Rationcard of acknowledgement no- " . $cardholder_add_temp_array['ack_no'];
                $query = TableRegistry::getTableLocator()->get('jsfss_ercms_logs')->query();
                $query->insert(['id', 'rgi_district_code', 'user_id', 'user_name', 'group_id', 'activity_type_id', 'activity_flag', 'label', 'message', 'created'])
                        ->values(['id' =>Text::uuid(), 'rgi_district_code' => $rgi_district_code, 'user_id' => $user_id, 'user_name' => $username, 'group_id' => $group_id, 'activity_type_id' => '1', 'activity_flag' => $apprv_status, 'label' => '1', 'message' => $msg,'created' => $datetime])
                        ->execute();

                $connection->commit();

	$connection->begin();
	$connection->execute("insert into jsfss_secc_cardholder_add_temps_backups  select * from secc_cardholder_add_temps where ack_no='$ack_no'");
        $connection->execute("insert into jsfss_secc_family_add_temps_backups  select * from secc_family_add_temps where ack_no_ercms='$ack_no'");
        $connection->execute("delete from secc_cardholder_add_temps where ack_no='$ack_no'");
        $connection->execute("delete from secc_family_add_temps where ack_no_ercms='$ack_no'");
	$connection->commit();

                //-----------------------------------------
                if ($apprv_status=='3')
                {
                    $JsfssSeccCardholdersObj = TableRegistry::getTableLocator()->get('JsfssSeccCardholders');
                    $JsfssSeccCardholders = $JsfssSeccCardholdersObj->find('all')->select(['id'])->where(['rationcard_no'=>$rationcard_no])->first()->toArray();
                    $JsfssSeccCardholdid=$JsfssSeccCardholders['id'];

                    $jsfss_secc_families="update jsfss_secc_families set jsfss_secc_cardholder_id='$JsfssSeccCardholdid' where rationcard_no='$rationcard_no'";
                    $connection->execute($jsfss_secc_families);
                    $this->Flash->success(__("RationCard:-$rationcard_no No generated successfully."));
                }
                else
                {
                    $this->Flash->error(__("Application Rejected"));
                }


                //-----------------------------------------------


                return $this->redirect(['controller' => 'SeccCardholders', 'action' => 'dsoSearchApplication']);
            }
            else
            {
                $this->Flash->error(__('RationCard No generation failed. Please try again.'));
                return $this->redirect(['controller' => 'SeccCardholders', 'action' => 'dsoSearchApplication']);
            }
        }
        //-------------------Application details------------------------------------------
        $seccCardholderAddTempObj = TableRegistry::getTableLocator()->get('SeccCardholderAddTemps');
        $seccFamilyAddTempObj = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps');
        $SeccBlocksObj = TableRegistry::getTableLocator()->get('SeccBlocks');
        $SeccDistrictsObj = TableRegistry::getTableLocator()->get('SeccDistricts');
        $PanchayatsObj = TableRegistry::getTableLocator()->get('Panchayats');
        $DealersObj = TableRegistry::getTableLocator()->get('Dealers');
        $CardtypesObj = TableRegistry::getTableLocator()->get('Cardtypes');
        $SeccVillageWardsObj = TableRegistry::getTableLocator()->get('SeccVillageWards');
        $RelationsObj = TableRegistry::getTableLocator()->get('Relations');

        $BankMastersObj = TableRegistry::getTableLocator()->get('BankMasters');
        $BranchMastersObj = TableRegistry::getTableLocator()->get('BranchMasters');

        $DocumentTypesObj = TableRegistry::getTableLocator()->get('DocumentTypes');
        $SeccFamilyDocumentAddTempsObj = TableRegistry::getTableLocator()->get('SeccFamilyDocumentAddTemps');

        $SeccFamilyDocumentAddTemps = $SeccFamilyDocumentAddTempsObj->find('all')->select(['secc_family_add_temp_id','document_type_id','document'])->where(['secc_cardholder_add_temp_id'=>$application_id])->toArray();
        $DocumentTypes = $DocumentTypesObj->find('list',['keyField' => 'id','valueField' => 'name'])->toArray();



$seccCardholderAddTemp = $seccCardholderAddTempObj->find('all')->select(['name','ack_no','activity_flag','id','location_id','applicationType_rule_id','requested_mobile','fathername','applicationType','rgi_district_code','rgi_block_code','rgi_village_code','cardtype_id','rationcard_no','dealer_id','panchayat_id','is_bank', 'bank_master_id', 'branch_master_id', 'bank_account_no', 'bank_ifsc_code', 'is_lpg','old_alone','marital_status','disability_status','health_status','beggar','rag_picker','worker','street_vendor','pvtg','non_gov','above_sixty','lpg_consumer_no'])->where(['id'=>$application_id])->first();
$cardholder=$seccCardholderAddTemp;
$seccCardholderAddTemp=$seccCardholderAddTemp->toArray();


        $seccFamilyAddTemp = $seccFamilyAddTempObj->find('all')->select(['name','name_sl','fathername','fathername_sl','mobile','gender_id','dob','relation_id','uid','disability_status','marital_status','health_status','id','uid_verified'])->where(['secc_cardholder_add_temp_id'=>$application_id])->toArray();

        $SeccDistricts = $SeccDistrictsObj->find('all')->select('name')->where(['rgi_district_code'=>$seccCardholderAddTemp['rgi_district_code']])->first()->toArray();
        $districtName=$SeccDistricts['name'];

        $SeccBlocks = $SeccBlocksObj->find('all')->select('name')->where(['rgi_block_code'=>$seccCardholderAddTemp['rgi_block_code']])->first()->toArray();
        $blockName=$SeccBlocks['name'];
	$ack_no=$seccCardholderAddTemp['ack_no'];
        if ($seccCardholderAddTemp['is_lpg'] == '1' || $seccCardholderAddTemp['is_bank'] == '1')
        {
            $BankMasters = $BankMastersObj->find('all')->select('name')->where(['id'=>$seccCardholderAddTemp['bank_master_id']])->first()->toArray();
            $bankName=$BankMasters['name'];

            $BranchMasters = $BranchMastersObj->find('all')->select('name')->where(['id'=>$seccCardholderAddTemp['bank_master_id']])->first()->toArray();
            $branchName=$BranchMasters['name'];
        }






        if (!empty($seccCardholderAddTemp['panchayat_id']))
        {
            $Panchayats = $PanchayatsObj->find('all')->select('name')->where(['id'=>$seccCardholderAddTemp['panchayat_id']])->first()->toArray();
            $panchayatName=$Panchayats['name'];
        }
	else
	{
	     $panchayatName='NA';
	}

        $Dealers = $DealersObj->find('all')->select(['name','license_no'])->where(['id'=>$seccCardholderAddTemp['dealer_id']])->first();

        if (!empty($Dealers))
        {
            $Dealers=$Dealers->toArray();
            $dealerName=$Dealers['name'];
            $license_no=$Dealers['license_no'];
        }


        $SeccVillageWards = $SeccVillageWardsObj->find('all')->select(['name'])->where(['rgi_village_code'=>$seccCardholderAddTemp['rgi_village_code']])->first()->toArray();
        $villName=$SeccVillageWards['name'];

        $Cardtypes = $CardtypesObj->find('all')->select(['name'])->where(['id'=>$seccCardholderAddTemp['cardtype_id']])->first()->toArray();
        $cardName=$Cardtypes['name'];

        $Relations = $RelationsObj->find('list',['keyField' => 'id','valueField' => 'name'])->toArray();
        $exclusion_criterias         = TableRegistry::getTableLocator()->get('ExclusionCriterias')->find('all', ['fields' => ['id', 'name']])->toArray();

$inclusion_criterias         = TableRegistry::getTableLocator()->get('InclusionCriterias')->find('all', ['fields' => ['id', 'name', 'cardholder_col'], 'conditions' => ['location_id' => $seccCardholderAddTemp['location_id']]])->toArray();

$hof_gender = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->find('all', ['fields' => ['gender_id'], 'conditions' => ['secc_cardholder_add_temp_id' => $seccCardholderAddTemp['id'], 'hof' => 1]])->first();

//print_r($cardholder);die;
        $this->set(compact('districtName','group_id','activity_flag','SeccFamilyDocumentAddTemps','bankName','branchName','seccFamilyAddTemp','inclusion_criterias','exclusion_criterias','seccCardholderAddTemp','Relations','cardName','JsfssSeccFamilies','villName','blockName','panchayatName','dealerName','dealerName','license_no','JsfssSeccCardholders','apprv_status','ack_no','rgi_district_code','DocumentTypes','cardholder','hof_gender'));
    }
	/*----------------------------------------------------------------------------------------------------------*/
    public function applicationList($activity_id = NULL)
	{
		$this->viewBuilder()->setLayout('admin');
		if ($this->request->getSession()->check('Auth')) {
			$user_id = $this->request->getSession()->read('Auth.User.id');
			$group_id = $this->request->getSession()->read('Auth.User.group_id');
			$rgi_district_code = $this->request->getSession()->read('Auth.User.rgi_district_code');
			$rgi_block_code = $this->request->getSession()->read('Auth.User.rgi_block_code');
		} else {
			return  $this->redirect($this->Auth->logout());
		}
		$activity_id    =   base64_decode($activity_id);
		if ($activity_id != 'NULL') {
			if ($group_id == 12) { //DSO
				$cardholder_condition = "SeccCardholderAddTemps.rgi_district_code ='" .  $rgi_district_code . "'AND SeccCardholderAddTemps.rgi_block_code ='" . $rgi_block_code . "'AND SeccCardholderAddTemps.activity_type_id ='" . $activity_id . "'AND application_status ='7'AND activity_flag = '1'";
				$family_condition = "hof ='1' AND activity_flag = '1' AND activity_type_id = '" . $activity_id . "'";
			} else if ($group_id == 20) { //BSO
				 $cardholder_condition = "SeccCardholderAddTemps.rgi_district_code ='" .  $rgi_district_code . "' AND SeccCardholderAddTemps.rgi_block_code ='" . $rgi_block_code . "' AND SeccCardholderAddTemps.activity_type_id ='" . $activity_id . "' AND application_status ='7' AND activity_flag = '0'";
				 $family_condition = "hof ='1' AND activity_flag = '0' AND activity_type_id = '" . $activity_id . "'";
			} else {
				return  $this->redirect($this->Auth->logout());
			}
			/* Start : Get Cardholder Details*/
			$seccCardholderAddTemp = TableRegistry::getTableLocator()->get('SeccCardholderAddTemps')
				->find(
					'all',
					[
						'fields'     =>
						['id', 'ack_no', 'requested_mobile', 'uid', 'name', 'applicationType', 'fathername', 'fathername_sl', 'Dealers.name', 'Cardtypes.name', 'Caste_id', 'Castes.name','rgi_village_code','created','family_count'],
						'conditions' => [$cardholder_condition],
						'contain'    => ['Dealers', 'Cardtypes', 'Castes', 'SeccFamilyAddTemps' => ['fields' => ['secc_cardholder_add_temp_id', 'marital_status', 'disability_status', 'health_status', 'dob'], 'conditions' => [$family_condition]]],
						'order' => ['SeccCardholderAddTemps.priority_marks' => 'desc', 'SeccCardholderAddTemps.created' => 'desc'],
						'limit' => 15
					]
				)
				->toArray();

 	$SeccVillageWardsObj = TableRegistry::getTableLocator()->get('SeccVillageWards');
        $villageList = $SeccVillageWardsObj->find('list',['keyField' => 'rgi_village_code','valueField','name'])->where(['rgi_block_code'=>$rgi_block_code])->toArray();


			/* End : Get Cardholder Details*/
		} else {
			$this->Flash->error(__('Error Occured Please Try Again.'));
		}
		//$this->set('seccCardholderAddTemp', $seccCardholderAddTemp);
		 $this->set(compact('seccCardholderAddTemp','villageList'));
		 //$this->set('seccCardholderAddTemp', $seccCardholderAddTemp);



	}
    public function nfsaRationcardApproval()
    {
        $connection         = ConnectionManager::get('default');
        $villages   = [];
        $nfsaRationcards = '';
        if ($this->request->getSession()->check('Auth'))
        {
            $user_id            = $this->request->getSession()->read('Auth.User.id');
            $username           = $this->request->getSession()->read('Auth.User.username');
            $group_id           = $this->request->getSession()->read('Auth.User.group_id');
            $rgi_district_code  = $this->request->getSession()->read('Auth.User.rgi_district_code');
            $rgi_block_code     = $this->request->getSession()->read('Auth.User.rgi_block_code');
        }
        else
        {
            return    $this->redirect($this->Auth->logout());
        }
        if($group_id!='12')
        {
            return    $this->redirect($this->Auth->logout());
        }
        $this->viewBuilder()->setLayout('admin');
        $rgi_district_code  = $this->request->getSession()->read('Auth.User.rgi_district_code');

        $query = TableRegistry::getTableLocator()->get('SeccBlocks');
        $SeccBlocks = $query->find('list',['keyField'=>'rgi_block_code','valueField'=>'name'])->where(['rgi_district_code'=>$rgi_district_code])->toArray();

        $query = TableRegistry::getTableLocator()->get('SeccDistricts');
        $SeccDistricts = $query->find('all')->select(['name'])->where(['rgi_district_code'=>$rgi_district_code])->first()->toArray();

        $districtName=$SeccDistricts['name'];
        $applicationType = TableRegistry::get('activity_types');
        $query = $applicationType->find('list', [
            'keyField' => 'id',
            'valueField' => 'name',
            //'conditions'=>['Panchayats.rgi_block_code='."'".$id."'"],
            'order'=>'name'
        ]);
        $activityType = $query->toArray();
        if($this->getRequest()->is('post')){
            $request_data       = $this->getRequest()->getData();
           // echo "<pre>"; print_r($request_data); die();
            $rgi_district_code  = $request_data['rgi_district_code'];
            $rgi_block_code     = $request_data['rgi_block_code'];
            $rgi_village_code   = $request_data['rgi_village_code'];
            $activity_type_id   = $request_data['activity_type_id'];
            $activity_flag      = $request_data['activity_flag'];
            $datas = $connection->prepare("SELECT rationcard_no,ack_no,cardtype_id,name,fathername FROM secc_cardholder_temps WHERE rgi_district_code=? AND rgi_block_code=? AND activity_type_id=? AND activity_flag=?");
            $datas->bindValue(1,$rgi_district_code);
            $datas->bindValue(2,$rgi_block_code);
            $datas->bindValue(3,$activity_type_id);
            $datas->bindValue(4,$activity_flag);
            $datas->execute();
            $nfsaRationcards= $datas->fetchAll('assoc');
            //echo "<pre>"; print_r($nfsaRationcards); die();
        }
        $this->set(compact('districtName','SeccBlocks','villages','activityType','rgi_district_code','nfsaRationcards'));
    }

    public function nfsaRationCardData()
    {
        $connection         = ConnectionManager::get('default');
        $this->viewBuilder()->setLayout('admin');
        if($this->getRequest()->is('post')){
            $request_data       = $this->getRequest()->getData();
            //echo "<pre>"; print_r($request_data); die();
            $ackNo   = $request_data['ackNo'];
            $rationData = $connection->prepare("SELECT ack_no,name,fathername,mothername,cardtype_id,rgi_district_code,rgi_block_code,rgi_village_code,dealer_id FROM secc_cardholder_temps WHERE ack_no=?");
            $rationData->bindValue(1,$ackNo);
            $rationData->execute();
            $nfsaRationcardsDetaild= $rationData->fetchAll('assoc');
//            echo "<pre>"; print_r($nfsaRationcardsDetaild); die();
        }
        $this->set(compact('nfsaRationcardsDetaild'));

    }

    /**
     * bsoNewRationApproval method
     */
    function bsoNewRationApproval()
    {
        $this->viewBuilder()->setLayout('admin');
        if ($this->request->getSession()->check('Auth')) {
            $user_id            = $this->request->getSession()->read('Auth.User.id');
            $username           = $this->request->getSession()->read('Auth.User.username');
            $group_id           = $this->request->getSession()->read('Auth.User.group_id');
            $rgi_district_code  = $this->request->getSession()->read('Auth.User.rgi_district_code');
            $rgi_block_code     = $this->request->getSession()->read('Auth.User.rgi_block_code');
        } else {
            return  $this->redirect($this->Auth->logout());
        }

        if ($group_id == 20) {
            if ($this->request->is(['patch', 'post', 'put'])) {
                $application_id = $this->request->getData('application_id');

                $activity_id = 1;
                if ($application_id != '') {
                    if ($group_id == 20) { //BSO
                        $cardholder_condition = "SeccCardholderAddTemps.rgi_district_code ='" .  $rgi_district_code . "'AND SeccCardholderAddTemps.rgi_block_code ='" . $rgi_block_code . "'AND SeccCardholderAddTemps.id = '" . $application_id . "' AND SeccCardholderAddTemps.activity_type_id ='" . $activity_id . "'AND application_status ='7'AND activity_flag = '0'";
                    } else {
                        //return  $this->redirect($this->Auth->logout());
                        $this->Flash->error(__('You are not authorised to access. Please, try again.'));
                        return $this->redirect(['controller' => 'SeccCardholders', 'action' => 'applicationList/', base64_encode(1)]);
                    }
                    /*************** Start : Get Application Details ********/
                    $seccCardholderAddTemp = TableRegistry::getTableLocator()->get('SeccCardholderAddTemps')
                        ->find(
                            'all',
                            [
                                'fields'     =>
                                ['id', 'ack_no', 'mobileno', 'uid', 'name', 'name_sl', 'fathername', 'fathername_sl', 'caste_id', 'mothername', 'mothername_sl', 'res_address', 'res_address_hn', 'tolla_mohalla', 'rgi_district_code', 'rgi_block_code',  'rgi_village_code', 'application_status', 'applicationType', 'applicationType_rule_id', 'SeccDistricts.name', 'SeccBlocks.name', 'SeccVillageWards.id', 'Panchayats.name', 'SeccVillageWards.name', 'location_id', 'Dealers.name', 'Dealers.License_no', 'cardtype_id', 'Cardtypes.name', 'is_bank', 'bank_master_id', 'branch_master_id', 'bank_account_no', 'bank_ifsc_code', 'is_lpg', 'lpg_consumer_no', 'marital_status', 'disability_status', 'health_status', 'BankMasters.name', 'BranchMasters.name','beggar','rag_picker','worker','street_vendor','pvtg','non_gov','above_sixty'],
                                'conditions' => [$cardholder_condition],
                                'contain'    => ['SeccDistricts', 'SeccBlocks', 'Panchayats', 'SeccVillageWards', 'Dealers', 'Cardtypes', 'BankMasters', 'BranchMasters']
                            ]
                        )
                        ->first();
                    /*************** End : Get Application Details ********/

                    if (!empty($seccCardholderAddTemp)) {
                        $seccFamilyDocument = TableRegistry::getTableLocator()->get('SeccFamilyDocumentAddTemps')->newEntity(['validate' => false]);

                        if (isset($this->request->data['upload'])) {
                            /*************** Start : Upload Documents if Pending ********/
                            $application_id = $this->request->data['application_id'];
                            $datetime = date('Y-m-d H:i:s');
                            //debug($this->request->getData());die;
                            $seccFamilyRegistration = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')
                                                        ->find('all', [
                                                            'fields' => 'id',
                                                            'conditions' => ['SeccFamilyAddTemps.secc_cardholder_add_temp_id=' . "'" . $seccCardholderAddTemp->id . "'", 'hof' => '1'],
                                                            ])
                                                        ->first();
                            $seccFamilyDocument->secc_cardholder_add_temp_id         =    $seccCardholderAddTemp->id;
                            $seccFamilyDocument->secc_family_add_temp_id             =    $seccFamilyRegistration->id;

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

                            if ($this->request->data['upload'] == "upload_passbook") {
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
                            $seccFamilyDocumentAddTemp = TableRegistry::getTableLocator()->get('SeccCardholderAddTemps')->patchEntity($seccFamilyDocument, $seccFamilyDocument->toArray(), ['validate' => 'Document']);

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
                            /*************** End : Upload Documents if Pending ********/
                        } else if (isset($this->request->data['submit'])) {
                            /*************** Start : Approval and verification Process ********/
                            $apprv_status = $this->request->data['action'];


                            if ($apprv_status == 1) {
                                $application_status = 8;
                            } else if ($apprv_status == 2) {
                                $application_status = 9;
                            } else {
                                $application_status = 7;
                            }
                            $remarks = $this->request->data['remarks'];
                            $application_id = $this->request->data['application_id'];
                            $datetime = date('Y-m-d H:i:s');
			    if ($apprv_status=='2' && empty($remarks))
                              {
                               $this->Flash->error(__('Please Fill remarks for rejection'));
                               return $this->redirect(['controller' => 'SeccCardholders', 'action' => 'ercmsRequest']);
                               }
                            if ($this->request->data['submit'] == 'verify') {
                                $secc_family_add_temp_id    = $this->request->data['secc_cardholder_add_temp_id'];
                                $seccFamilyMember = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')
                                    ->find(
                                        'all',
                                        [
                                            'fields'     =>
                                            ['id', 'mobile', 'uid','hof'],
                                            'conditions' => ['id' => $secc_family_add_temp_id],
                                        ]
                                    )
                                    ->first();

                                $Ercms = new ErcmsValidateController;
                                /********** Start : Verify Aadhar Number and Mobile No*********/
                                if ($seccFamilyMember->uid != '') {
									if($seccFamilyMember->hof == 1 && $seccFamilyMember->mobile == ''){
										$this->Flash->error(__('Mobile number of Head of Family cannot not be null.'));
										$update = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->updateAll(['uid_verified' => 2], ["id" => $secc_family_add_temp_id]);
									}else{
										if ((!$uiderror = $Ercms->checkuid($seccFamilyMember->uid)) || strlen($seccFamilyMember->uid) != 12) {
											$this->Flash->error('Invalid Aadhar Number');
											$update = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->updateAll(['uid_verified' => 2], ["id" => $secc_family_add_temp_id]);
										}else{
											$aadharCount =  $Ercms->checkAadhar_verify($seccFamilyMember->uid);
											$mobileCount =  $Ercms->checkMobile_verify($seccFamilyMember->mobile);
											if ($aadharCount > 0) {
												$this->Flash->error(__('This Aadhar Number already exists. Member Rejected for New Ration Card.'));
												$update = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->updateAll(['uid_verified' => 2], ["id" => $secc_family_add_temp_id]);
											}else if (($mobileCount == 0 && $aadharCount == 0) || ($mobileCount > 0 && $aadharCount == 0)) {
												if ($mobileCount > 0 && $seccFamilyMember->hof == 1) {
                                                    $this->Flash->error(__('Mobile number of Head of Family must be unique.'));
                                                    $update = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->updateAll(['uid_verified' => 2], ["id" => $secc_family_add_temp_id]);
												}else if ($mobileCount > 0) {
													$update = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->updateAll(['mobile' => '', 'uid_verified' => 1], ["id" => $secc_family_add_temp_id]);
												} else {
													$update = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->updateAll(['uid_verified' => 1], ["id" => $secc_family_add_temp_id]);
													$this->Flash->success(__('Family Member Verified Successfully. '));
												}
											} else {
												$this->Flash->error(__('Cannot Verify member. Some error occured.'));
											}
										}
									}
								}else {
									$this->Flash->error(__('Family Member UID cannot not be null.'));
									$update = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->updateAll(['uid_verified' => 2], ["id" => $secc_family_add_temp_id]);
								}
                                /********** End :  Verify Aadhar Number and Mobile No*********/
                            } else if ($this->request->data['submit'] == 'approve_reject') {
                                /********** Start :  Approve or Reject Application *********/
                                $verified_count =   TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->find()->WHERE(['OR' => [
                                    'uid_verified is null',
                                    'uid_verified' => 0
                                ], 'secc_cardholder_add_temp_id' => $application_id])->count();
                                $hof_verified_count =   TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->find()
								->WHERE(['hof'=>1,'uid_verified != 1', 'secc_cardholder_add_temp_id' => $application_id])->count();

								if($hof_verified_count > 0 &&  $apprv_status == 1){
									$this->Flash->error(__('The UID for Head of Family is duplicate, therefore the application must be rejected.'));
								}else if ($verified_count > 0 &&  $apprv_status == 1) {
                                    $this->Flash->error(__('You need to verify each individual family member first to proceed. Please, try again.'));
                                } else if($remarks == ''){
                                    $this->Flash->error(__('Please enter remarks and try again.'));
                                } else if($apprv_status == ''){
                                    $this->Flash->error(__('Please select reject/approve status and try again.'));
                                } else {
                                    $update_cardholder_temp =  TableRegistry::getTableLocator()->get('SeccCardholderAddTemps')->updateAll(['application_status' => $application_status, 'activity_flag' => $apprv_status, 'modified' =>  $datetime, 'modified_by' => $user_id, 'requestedBy' => '1', 'created_by' => $user_id, 'bso_remarks' => $remarks, 'bso_modifiedDate' =>  $datetime], ["id" => $seccCardholderAddTemp->id, 'activity_type_id' => '1', 'activity_flag' => '0']);
                                    $update_family_temp = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->updateAll(['activity_flag' => $apprv_status, 'modified' =>  $datetime, 'modified_by' => $user_id, 'requestedBy' => '1', 'created_by' => $user_id, 'bso_remarks' => $remarks, 'bso_modifiedDate' =>  $datetime], ["secc_cardholder_add_temp_id" => $seccCardholderAddTemp->id, 'activity_type_id' => '1', 'activity_flag' => '0']);

                                    if ($update_cardholder_temp && $update_family_temp) {
                                        $msg = $username . " has approved request for Add New Rationcard of acknowledgement no- " . $seccCardholderAddTemp->ack_no;
                                        $query = TableRegistry::getTableLocator()->get('jsfss_ercms_logs')->query();
                                        $query->insert(['id', 'rgi_district_code', 'user_id', 'user_name', 'group_id', 'activity_type_id', 'activity_flag', 'label', 'message', 'created'])
                                            ->values(['id' => Text::uuid(), 'rgi_district_code' => $seccCardholderAddTemp->rgi_district_code, 'user_id' => $user_id, 'group_id' => $username, 'group_id' => $group_id, 'activity_type_id' => '1', 'activity_flag' => $apprv_status, 'label' => '1', 'message' => $msg, 'created' => $datetime])
                                            ->execute();
                                        if($apprv_status == 2){
                                        $connection = ConnectionManager::get('default');
                                        $connection->begin();
                                        $connection->execute("insert into jsfss_secc_cardholder_add_temps_backups  select * from secc_cardholder_add_temps where ack_no='$seccCardholderAddTemp->ack_no'");
                                        $connection->execute("insert into jsfss_secc_family_add_temps_backups  select * from secc_family_add_temps where ack_no_ercms='$seccCardholderAddTemp->ack_no'");
                                        $connection->execute("delete from secc_cardholder_add_temps where ack_no='$seccCardholderAddTemp->ack_no'");
                                        $connection->execute("delete from secc_family_add_temps where ack_no_ercms='$seccCardholderAddTemp->ack_no'");
                                        $connection->commit();
                                        }
                                        if ($query) {
                                            if ($apprv_status == 1) {
                                                $this->Flash->success(__('Application Approved successfully..'));
                                            } else if ($apprv_status == 2) {
                                                $this->Flash->error(__('Application Rejected successfully..'));
                                            }
                                            return $this->redirect(['controller' => 'SeccCardholders', 'action' => 'applicationList/', base64_encode(1)]);
                                        } else {
                                            $this->Flash->error(__('Some Error Occurred. Please, try again.'));
                                        }
                                    } else {
                                        $this->Flash->error(__('Some Error Occurred. Please, try again.'));
                                    }
                                }
                                /********** End :  Approve or Reject Application *********/
                            } else {
                                $this->Flash->error(__('Some Error Occurred. Please, try again.'));
                            }
                            /*************** End : Approval and verification Process ********/
                        }
                        $seccFamilyAddTemp = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')
                            ->find(
                                'all',
                                [
                                    'fields'     =>
                                    [
                                        'id', 'ack_no' => 'ack_no_ercms', 'mobile', 'uid', 'name', 'name_sl', 'fathername', 'fathername_sl', 'mothername', 'mothername_sl', 'gender_id', 'dob', 'uid_verified', 'marital_status', 'disability_status', 'health_status', 'activity_type_id', 'relation_id', 'Relations.name', 'hof', 'rgi_district_code',
                                        'ack_no_ercms'
                                    ],
                                    'conditions' => ['secc_cardholder_add_temp_id' => $seccCardholderAddTemp->id],
                                    'contain'    => ['Relations', 'SeccFamilyDocumentAddTemps' => ['DocumentTypes']]
                                ]
                            )
                            ->toArray();

                        $inclusion_criterias         = TableRegistry::getTableLocator()->get('InclusionCriterias')->find('all', ['fields' => ['id', 'name', 'cardholder_col'], 'conditions' => ['location_id' => $seccCardholderAddTemp->location_id]])->toArray();

                        $hof_gender = TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->find('all', ['fields' => ['gender_id'], 'conditions' => ['secc_cardholder_add_temp_id' => $seccCardholderAddTemp->id, 'hof' => 1]])->first();

                        $member_verified_count =   TableRegistry::getTableLocator()->get('SeccFamilyAddTemps')->find('all')->select([
                            'total_uid' => 'sum(case when secc_cardholder_add_temp_id = "' . $application_id . '" then 1 else 0 end)', 'uid_verified' => 'sum(case when uid_verified = 1 then 1 else 0 end)',
                            'uid_rejected' => 'sum(case when uid_verified = 2 then 1 else 0 end)', 'uid_unverified' => 'sum(case when uid_verified is null then 1  when uid_verified = 0 then 1 else 0 end)'
                        ])
                            ->WHERE(['secc_cardholder_add_temp_id' => $application_id])->first();

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

                        $SeccFamilyDocuments = TableRegistry::getTableLocator()->get('SeccFamilyDocumentAddTemps')->find('list', [
                            'keyField' => 'document_type_id',
                            'valueField' => 'document'
                        ])->where(['SeccFamilyDocumentAddTemps.secc_family_add_temp_id=' . "'" . $seccCardholderAddTemp->id . "'"])->toArray();

                        $this->set(compact('seccCardholderAddTemp', 'inclusion_criterias', 'exclusion_criterias', 'group_id', 'hof_gender', 'member_verified_count', 'seccFamilyAddTemp', 'document_status', 'SeccFamilyDocuments', 'seccFamilyDocument'));
                    } else {
                        $this->Flash->error(__('No Record Found. Please, try again.'));
                    }
                } else {
                    $this->Flash->error(__('Some Error Occurred. Please, try again.'));
                }
            } else {
                return $this->redirect(['controller' => 'SeccCardholders', 'action' => 'applicationList/', base64_encode(1)]);
            }
        } else {
            $this->Flash->error(__('You are not authorised to access. Please, try again.'));
            return $this->redirect(['controller' => 'SeccCardholders', 'action' => 'applicationList/', base64_encode(1)]);
        }
    }

    public function viewRationcardDetail()
    {
        if ($this->request->getSession()->check('Auth'))
        {
            $user_id            = $this->request->getSession()->read('Auth.User.id');
            $username           = $this->request->getSession()->read('Auth.User.username');
            $group_id           = $this->request->getSession()->read('Auth.User.group_id');
            $rgi_district_code  = $this->request->getSession()->read('Auth.User.rgi_district_code');
            $rgi_block_code     = $this->request->getSession()->read('Auth.User.rgi_block_code');
        }
        else
        {
            return    $this->redirect($this->Auth->logout());
        }
        $this->viewBuilder()->setLayout('admin');
        $rgi_district_code  = $this->request->getSession()->read('Auth.User.rgi_district_code');



        $query = TableRegistry::getTableLocator()->get('SeccBlocks');
        $SeccBlocks = $query->find('list',['keyField'=>'rgi_block_code','valueField'=>'name'])->where(['rgi_district_code'=>$rgi_district_code])->toArray();


        $query = TableRegistry::getTableLocator()->get('SeccDistricts');
        $SeccDistricts = $query->find('all')->select(['name'])->where(['rgi_district_code'=>$rgi_district_code])->first()->toArray();

        $districtName=$SeccDistricts['name'];
        $this->set(compact('districtName','vv','SeccBlocks','JsfssSeccCardholders'));
    }

    public function viewRationcard()
    {
        if ($this->request->getSession()->check('Auth'))
        {
            $user_id = $this->request->getSession()->read('Auth.User.id');
            $group_id = $this->request->getSession()->read('Auth.User.group_id');
            $rgi_district_code = $this->request->getSession()->read('Auth.User.rgi_district_code');
            $rgi_block_code = $this->request->getSession()->read('Auth.User.rgi_block_code');
        }
        else
        {
            return  $this->redirect($this->Auth->logout());
        }
        $ency_rationcard_no = $this->request->getData('rationcard_no');

        $rationcard_no=$this->appDecryptData($ency_rationcard_no);

        $this->viewBuilder()->setLayout('admin');
        //die;
        //-------------------Application details------------------------------------------
        $JsfssSeccCardholdersObj = TableRegistry::getTableLocator()->get('JsfssSeccCardholders');
        $JsfssSeccFamiliesObj = TableRegistry::getTableLocator()->get('JsfssSeccFamilies');
        $SeccBlocksObj = TableRegistry::getTableLocator()->get('SeccBlocks');
        $SeccDistrictsObj = TableRegistry::getTableLocator()->get('SeccDistricts');
        $PanchayatsObj = TableRegistry::getTableLocator()->get('Panchayats');
        $DealersObj = TableRegistry::getTableLocator()->get('Dealers');
        $CardtypesObj = TableRegistry::getTableLocator()->get('Cardtypes');
        $SeccVillageWardsObj = TableRegistry::getTableLocator()->get('SeccVillageWards');
        $RelationsObj = TableRegistry::getTableLocator()->get('Relations');

        $BankMastersObj = TableRegistry::getTableLocator()->get('BankMasters');
        $BranchMastersObj = TableRegistry::getTableLocator()->get('BranchMasters');

        $DocumentTypesObj = TableRegistry::getTableLocator()->get('DocumentTypes');
        $SeccFamilyDocumentAddTempsObj = TableRegistry::getTableLocator()->get('SeccFamilyDocumentAddTemps');


        $JsfssSeccCardholders= $JsfssSeccCardholdersObj->find('all')->select(['name','name_sl','applicationType_rule_id','fathername_sl','res_address','fathername','applicationType','rgi_district_code','rgi_block_code','rgi_village_code','cardtype_id','rationcard_no','dealer_id','panchayat_id','is_bank', 'bank_master_id', 'branch_master_id', 'bank_account_no', 'bank_ifsc_code', 'is_lpg', 'lpg_consumer_no'])->where(['rationcard_no'=>$rationcard_no])->first()->toArray();

        $JsfssSeccFamilies = $JsfssSeccFamiliesObj->find('all')->select(['name','name_sl','fathername','fathername_sl','mobile','gender_id','dob','relation_id','uid','disability_status','marital_status','health_status','id','uid_verified'])->where(['rationcard_no'=>$rationcard_no])->toArray();

        $SeccDistricts = $SeccDistrictsObj->find('all')->select('name')->where(['rgi_district_code'=>$JsfssSeccCardholders['rgi_district_code']])->first()->toArray();
        $districtName=$SeccDistricts['name'];

        $SeccBlocks = $SeccBlocksObj->find('all')->select('name')->where(['rgi_block_code'=>$JsfssSeccCardholders['rgi_block_code']])->first()->toArray();
        $blockName=$SeccBlocks['name'];

        if ($JsfssSeccCardholders['is_lpg'] == '1' || $JsfssSeccCardholders['is_bank'] == '1')
        {
            $BankMasters = $BankMastersObj->find('all')->select('name')->where(['id'=>$JsfssSeccCardholders['bank_master_id']])->first();

            $BankMasters=$BankMasters->toArray();
            $bankName=$BankMasters['name'];

            $BranchMasters = $BranchMastersObj->find('all')->select('name')->where(['id'=>$JsfssSeccCardholders['bank_master_id']])->first()->toArray();
            $branchName=$BranchMasters['name'];
        }


        if (!empty($seccCardholderAddTemp['panchayat_id']))
        {
            $Panchayats = $PanchayatsObj->find('all')->select('name')->where(['id'=>$JsfssSeccCardholders['panchayat_id']])->first()->toArray();
            $panchayatName=$Panchayats['name'];
        }


        $Dealers = $DealersObj->find('all')->select(['name','license_no'])->where(['id'=>$JsfssSeccCardholders['dealer_id']])->first();

        if (!empty($Dealers))
        {
            $Dealers=$Dealers->toArray();
            $dealerName=$Dealers['name'];
            $license_no=$Dealers['license_no'];
        }


        $SeccVillageWards = $SeccVillageWardsObj->find('all')->select(['name'])->where(['rgi_village_code'=>$JsfssSeccCardholders['rgi_village_code']])->first()->toArray();
        $villName=$SeccVillageWards['name'];

        $Cardtypes = $CardtypesObj->find('all')->select(['name'])->where(['id'=>$JsfssSeccCardholders['cardtype_id']])->first()->toArray();
        $cardName=$Cardtypes['name'];

        $Relations = $RelationsObj->find('list',['keyField' => 'id','valueField' => 'name'])->toArray();
        $inclusion_criterias         = TableRegistry::getTableLocator()->get('InclusionCriterias')->find('all', ['fields' => ['id', 'name']])->toArray();
        $exclusion_criterias         = TableRegistry::getTableLocator()->get('ExclusionCriterias')->find('all', ['fields' => ['id', 'name']])->toArray();


        $this->set(compact('districtName','rationcard_no','group_id','SeccFamilyDocumentAddTemps','bankName','branchName','seccFamilyAddTemp','inclusion_criterias','exclusion_criterias','JsfssSeccCardholders','Relations','cardName','JsfssSeccFamilies','villName','blockName','panchayatName','dealerName','dealerName','license_no','JsfssSeccCardholders'));
    }





    public function viewRationcardDetailResult()
    {
	if ($this->request->getSession()->check('Auth'))
        {
            $user_id            = $this->request->getSession()->read('Auth.User.id');
            $username           = $this->request->getSession()->read('Auth.User.username');
            $group_id           = $this->request->getSession()->read('Auth.User.group_id');
            $rgi_district_code  = $this->request->getSession()->read('Auth.User.rgi_district_code');
            $rgi_block_code     = $this->request->getSession()->read('Auth.User.rgi_block_code');
        }
        else
        {
            return    $this->redirect($this->Auth->logout());
        }
        $this->viewBuilder()->setLayout('admin');

        if ($this->request->is(['post']))
        {
            $rationcard_no  = $this->request->getData('rationcard_no');
            $dealer_id  = $this->request->getData('dealer_id');
            $rgi_village_code  = $this->request->getData('rgi_village_code');

            $query = TableRegistry::getTableLocator()->get('JsfssSeccCardholders');
            if (!empty($rationcard_no) && empty($rgi_village_code) && empty($dealer_id))
            {
                $JsfssSeccCardholders = $query->find('all')->select(['name','fathername','rationcard_no','Castes.name'])->where(['rgi_district_code'=>$rgi_district_code,'rationcard_no'=>$rationcard_no])->contain(['castes']);
            }
            elseif (empty($rationcard_no) && empty($rgi_village_code) && !empty($dealer_id))
            {
                $JsfssSeccCardholders = $query->find('all')->select(['name','fathername','rationcard_no','Castes.name'])->where(['rgi_district_code'=>$rgi_district_code,'dealer_id'=>$dealer_id])->contain(['castes']);
            }
            elseif (empty($rationcard_no) && !empty($rgi_village_code) && empty($dealer_id))
            {
                $JsfssSeccCardholders = $query->find('all')->select(['name','fathername','rationcard_no','Castes.name'])->where(['rgi_district_code'=>$rgi_district_code,'rgi_village_code'=>$rgi_village_code])->contain(['castes']);
            }


            if (!empty($JsfssSeccCardholders))
            {
                $JsfssSeccCardholders=$JsfssSeccCardholders->toArray();
            }
            else
            {
                $this->Flash->error(__('Rationcard does not exist'));
                return $this->redirect(['controller' => 'SeccCardholders', 'action' => 'viewRationcardDetail']);
            }
            ///debug($JsfssSeccCardholders);
            //die;
        }

        $this->set(compact('districtName','vv','SeccBlocks','JsfssSeccCardholders'));
    }



	public function nfsaLogin($user = NULL)
	{
		if ($this->request->is('post')) {
			$this->getRequest()->getSession()->delete('Auth');

			$reg_ration_no  =   filter_var($this->request->data['reg_ration_no'], FILTER_SANITIZE_STRING);
			$password       =   filter_var($this->request->data['password'], FILTER_SANITIZE_NUMBER_INT);

			/*********** Start : Login Check Module if already loggedin ******/
			if ($this->Auth->user('id')) {
				$this->Flash->error(__('You are already logged in!'));
				return $this->redirect(['controller' => 'NfsaCardholderTemps', 'action' => 'dashboard']);
			} else {

				/*********** End : Login Check Module if already loggedin ******/

				$check_ration_record         =   TableRegistry::getTableLocator()->get('NfsaCardholders')->find('all', ['fields' => ['id', 'rationcard_no', 'cardtype_id','rgi_district_code','rgi_block_code'], 'conditions' => ['rationcard_no' => $reg_ration_no, 'RIGHT(uid,8)' => $password]])->first();
				$check_reg_record            =   TableRegistry::getTableLocator()->get('NfsaCardholderTemps')->find('all', ['fields' => ['id', 'ack_no', 'application_status','rgi_district_code','rgi_block_code'], 'conditions' => ['ack_no' => $reg_ration_no, 'RIGHT(uid,8)' => $password, 'activity_type_id' => 1]])->first();

				if (!empty($check_ration_record) > 0) {
					$this->getRequest()->getSession()->write([
						'Auth.User.id'                  => $check_ration_record->id,
						'Auth.User.rationcard_no'       => $check_ration_record->rationcard_no,
						'Auth.User.cardtype_id'         => $check_ration_record->cardtype_id,
						'Auth.User.rgi_district_code'   => $check_ration_record->rgi_district_code,
						'Auth.User.rgi_block_code'     	=> $check_ration_record->rgi_block_code
					]);

					return $this->redirect(['controller' => 'SeccCardholders', 'action' => 'dashboard']);
				} else if (!empty($check_reg_record) > 0) {
					$application_status         =   $check_reg_record->application_status;
					if ($application_status == 1 || $application_status == 2 || $application_status == 3 || $application_status == 4 || $application_status == 5 || $application_status == 6 || $application_status == 7) {
						$this->getRequest()->getSession()->write([
							'Auth.User.id'                      => $check_reg_record->id,
							'Auth.User.ack_no'                  => $check_reg_record->ack_no,
							'Auth.User.application_status'      => $application_status,
							'Auth.User.rgi_district_code'       => $check_reg_record->rgi_district_code,
							'Auth.User.rgi_block_code'       	=> $check_reg_record->rgi_block_code
						]);
					}

					if ($application_status == 1) {
						return $this->redirect(['controller' => 'NfsaCardholderTemps', 'action' => 'personalDetails']);
					} else if ($application_status == 2) {
						return $this->redirect(['controller' => 'NfsaCardholderTemps', 'action' => 'bankDetails']);
					} else if ($application_status == 3) {
						return $this->redirect(['controller' => 'NfsaCardholderTemps', 'action' => 'additionalDetails']);
					} else if ($application_status == 4) {
						return $this->redirect(['controller' => 'NfsaCardholderTemps', 'action' => 'addFamily']);
					} else if ($application_status == 5) {
						return $this->redirect(['controller' => 'NfsaCardholderTemps', 'action' => 'documentDetails']);
					} else if ($application_status == 6) {
						return $this->redirect(['controller' => 'NfsaCardholderTemps', 'action' => 'preview']);
					} else if ($application_status == 7) {
						return $this->redirect(['controller' => 'NfsaCardholderTemps', 'action' => 'acknowledgement']);
					} else if ($application_status == 8) { // In case Application is approved
						$this->Flash->error(__('Your Application has been approved. Please login with your Rationcard No. provided. !!!'));
						return $this->redirect(['controller' => 'SeccCardholders', 'action' => 'nfsaLogin']);
					} else if ($application_status == 9) { // In case Application is rejected
						$this->Flash->error(__('Your Application has been rejected. Please consult authorised person. !!!'));
						return $this->redirect(['controller' => 'SeccCardholders', 'action' => 'nfsaLogin']);
					} else {
						$this->Flash->error(__('Invalid Username & Password. Please try again !!!'));
					}
				} else {
					$this->Flash->error(__('Invalid Username & Password. Please try again !!!'));
				}
			}
		}
	}


}
