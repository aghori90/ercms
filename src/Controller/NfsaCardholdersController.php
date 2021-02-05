<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Utility\Text;
use Cake\View\Helper\FormHelper;

/**
 * NfsaCardholders Controller
 *
 * @property \App\Model\Table\NfsaCardholdersTable $NfsaCardholders
 *
 * @method \App\Model\Entity\NfsaCardholder[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class NfsaCardholdersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Locations', 'Cardtypes', 'Castes', 'SeccDistricts', 'SeccBlocks', 'Panchayats', 'SeccVillageWards', 'Dealers', 'BankMasters', 'BranchMasters', 'ApplicationTypeRules', 'DeleteReasons'],
        ];
        $nfsaCardholders = $this->paginate($this->NfsaCardholders);

        $this->set(compact('nfsaCardholders'));
    }

  
    /*---------------------------------bso-----------------------------------------------------*/
    function bsoSearchApplication()
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
        if ($group_id!='20')
        {
            return    $this->redirect($this->Auth->logout());
        }
        $this->viewBuilder()->setLayout('admin');
        $rgi_district_code  = $this->request->getSession()->read('Auth.User.rgi_district_code');

        $query = TableRegistry::getTableLocator()->get('SeccBlocks');
        $SeccBlocks = $query->find('all')->select(['name'])->where(['rgi_block_code'=>$rgi_block_code])->first()->toArray();

        $blockName=$SeccBlocks['name'];
        
        $query = TableRegistry::getTableLocator()->get('SeccDistricts');
        $SeccDistricts = $query->find('all')->select(['name'])->where(['rgi_district_code'=>$rgi_district_code])->first()->toArray();
        
         
        $query = TableRegistry::getTableLocator()->get('SeccVillageWards');
        $SeccVillageWards = $query->find('list',['keyField'=>'rgi_village_code','valueField'=>'name'])->where(['rgi_block_code'=>$rgi_block_code])->toArray();
        
        //debug($SeccVillageWards);die;

        $districtName=$SeccDistricts['name'];
        $this->set(compact('districtName','vv','SeccBlocks','SeccVillageWards','blockName','JsfssSeccCardholders'));
    }

    function bsoApplicationView()
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
            //debug($this->request->getData());
            $secc_family_add_temp_id    = $this->request->data['nfsa_family_add_temp_id'];
            
            $seccFamilyMember = TableRegistry::getTableLocator()->get('NfsaFamilyAddTemps')
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
                    $update = TableRegistry::getTableLocator()->get('NfsaFamilyAddTemps')->updateAll(['mobile' => '', 'uid_verified' => 1], ["id" => $secc_family_add_temp_id]);
                }
                else
                {
                    $update = TableRegistry::getTableLocator()->get('NfsaFamilyAddTemps')->updateAll(['uid_verified' => 1], ["id" => $secc_family_add_temp_id]);
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

            if ($apprv_status=='2' && empty($remarks))
            {
                $this->Flash->error(__('Please Fill remarks for rejection'));
                return $this->redirect(['controller' => 'NfsaCardholders', 'action' => 'bsoSearchApplication']);
            }
            $application_id = $this->request->getData('application_id');

            //debug($this->request->getData());
            //die;

            if (empty($apprv_status) || empty($application_id) )
            {
                $this->Flash->error(__('Error occured. Please try again.'));
                return $this->redirect(['controller' => 'NfsaCardholders', 'action' => 'bsoSearchApplication']);
            }


            $verified_count =   TableRegistry::getTableLocator()->get('NfsaFamilyAddTemps')->find()->WHERE(['OR' => [
                'uid_verified is null',
                'uid_verified' => 0
            ], 'nfsa_cardholder_add_temp_id' => $application_id])->count();
          
            if ($verified_count > 0 &&  $apprv_status == 1)
            {
                $this->Flash->error(__('You need to verify each individual family member first to proceed. Please, try again.'));
                return $this->redirect(['controller' => 'NfsaCardholders', 'action' => 'bsoSearchApplication']);
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
                return $this->redirect(['controller' => 'NfsaCardholders', 'action' => 'bsoSearchApplication']);
            }
            if ($rgi_district_code_application!=$rgi_district_code)
            {
                $this->Flash->error(__('Failed To Approve !.Application  belongs to another District'));
                return $this->redirect(['controller' => 'NfsaCardholders', 'action' =>'bsoSearchApplication']);
            }
            
   
            
            //die;
            $connection = ConnectionManager::get('default'); 
            $id=$application_id; 
                                                                   
            $connection->begin();
            $condition_seccf1 = ['nfsa_cardholder_add_temp_id' => $id,'uid_verified'=>'1'];
                   
            $condition_seccf = ['nfsa_cardholder_add_temp_id' => $id];
            $condition_secc = ['id' => $id]; 
               
            if ($apprv_status=='1')
            {
                $status='approved';
            }
            else
            {
                $status='rejected';
            }

            $sqlUpdte="update nfsa_cardholder_add_temps set  activity_flag='$apprv_status', modified='$datetime', modified_by='$user_id',bso_modifiedDate='$datetime' where id=:id";
            $connection->execute($sqlUpdte, $condition_secc); 

            $sqlfamilyUpdte="update nfsa_family_add_temps set  activity_flag='$apprv_status', modified='$datetime', modified_by='$user_id', bso_modifiedDate='$datetime' where nfsa_cardholder_add_temp_id=:nfsa_cardholder_add_temp_id";
            $connection->execute($sqlfamilyUpdte, $condition_seccf);
                    
                 
                    
            $msg = $username . " has $status request for Add New Rationcard of acknowledgement no- " . $cardholder_add_temp_array['ack_no'];
            $query = TableRegistry::getTableLocator()->get('nfsa_ercms_logs')->query();
            $query->insert(['id', 'rgi_district_code', 'user_id', 'user_name', 'group_id', 'activity_type_id', 'activity_flag', 'label', 'message', 'created'])
                        ->values(['id' =>Text::uuid(), 'rgi_district_code' => $rgi_district_code, 'user_id' => $user_id, 'user_name' => $username, 'group_id' => $group_id, 'activity_type_id' => '1', 'activity_flag' => $apprv_status, 'label' => '1', 'message' => $msg,'created' => $datetime])
                        ->execute();

            $connection->commit();

           

            //-----------------------------------------
            if ($apprv_status=='1')
            {
                $this->Flash->success(__("Application approved Successfuly."));
            }
            else
            {
                $connection->begin();
                $connection->execute("insert into nfsa_cardholder_add_temp_backups  select * from nfsa_cardholder_add_temps where ack_no='$ack_no'");
                $connection->execute("insert into nfsa_family_add_temp_backups  select * from nfsa_family_add_temps where ack_no_ercms='$ack_no'");
                $connection->execute("delete from nfsa_cardholder_add_temps where ack_no='$ack_no'");
                $connection->execute("delete from nfsa_family_add_temps where ack_no_ercms='$ack_no'");
                $connection->commit();
                $this->Flash->success(__("Application Rejected"));
            }


            //-----------------------------------------------

                
            return $this->redirect(['controller' => 'NfsaCardholders', 'action' => 'bsoSearchApplication']);
        }
        //-------------------Application details------------------------------------------
        $seccCardholderAddTempObj = TableRegistry::getTableLocator()->get('NfsaCardholderAddTemps');
        $seccFamilyAddTempObj = TableRegistry::getTableLocator()->get('NfsaFamilyAddTemps');
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
        $SeccFamilyDocumentAddTempsObj = TableRegistry::getTableLocator()->get('NfsaFamilyDocumentAddTemps');

        $SeccFamilyDocumentAddTemps = $SeccFamilyDocumentAddTempsObj->find('all')->select(['nfsa_family_add_temp_id','document_type_id','document'])->where(['nfsa_cardholder_add_temp_id'=>$application_id])->toArray();       
        $DocumentTypes = $DocumentTypesObj->find('list',['keyField' => 'id','valueField' => 'name'])->toArray();
 

        


        $seccCardholderAddTemp = $seccCardholderAddTempObj->find('all')->select(['name','ack_no','activity_flag','id','location_id','caste_id','applicationType_rule_id','requested_mobile','fathername','applicationType','rgi_district_code','rgi_block_code','rgi_village_code','cardtype_id','rationcard_no','dealer_id','panchayat_id','is_bank', 'bank_master_id', 'branch_master_id', 'bank_account_no', 'bank_ifsc_code', 'is_lpg','old_alone','marital_status','disability_status','health_status','beggar','rag_picker','worker','street_vendor','pvtg','non_gov','above_sixty','lpg_consumer_no'])->where(['id'=>$application_id])->first();
        $cardholder=$seccCardholderAddTemp;
        $seccCardholderAddTemp=$seccCardholderAddTemp->toArray();

        //echo '<pre/>';
        //print_r($seccCardholderAddTemp);die;
        //-----------------------------------------------------------------------------------
        $seccFamilyDocument = TableRegistry::getTableLocator()->get('NfsaFamilyDocumentAddTemps')->newEntity(['validate' => false]);

        if (isset($this->request->data['upload']))
        {
            // die('ddd');
            $seccFamilyDocument = TableRegistry::getTableLocator()->get('NfsaFamilyDocumentAddTemps')->newEntity(['validate' => false]);
            /*************** Start : Upload Documents if Pending ********/
            $application_id = $this->request->data['application_id'];
            $datetime = date('Y-m-d H:i:s');
          
            $seccFamilyRegistration = TableRegistry::getTableLocator()->get('NfsaFamilyAddTemps')
                                        ->find('all', [
                                            'fields' => 'id', 
                                            'conditions' => ['NfsaFamilyAddTemps.nfsa_cardholder_add_temp_id=' . "'" . $seccCardholderAddTemp['id'] . "'", 'hof' => '1'], 
                                            ])
                                        ->first();
            $seccFamilyDocument['nfsa_cardholder_add_temp_id']         =    $seccCardholderAddTemp['id'];
            $seccFamilyDocument['nfsa_family_add_temp_id']             =    $seccFamilyRegistration['id'];


          
            $rgi_district_code = $seccCardholderAddTemp['rgi_district_code'];
            $ack_no = $seccCardholderAddTemp['ack_no'];
            $district_dir = DOC_NFSA_PATH . $rgi_district_code;
            $application_dir = $district_dir . DS .  $ack_no;
		

	   
            if (!file_exists($district_dir))
            {
                mkdir($district_dir);
            }
            if (!file_exists($application_dir))
            {
                mkdir($application_dir);
                //die('ack created');
            }
            //echo $district_dir.$application_dir;die; 
            if ($this->request->data['upload'] == "upload_passbook")
            {
                $document_type_id = 13;
                $document_upload_field_name = 'bank_passbook';
                $filename_prepend = '_BankDOC';
            }
            else
            {
                if ($this->request->data['upload'] == "upload_caste")
                {
                    $document_type_id = 14;
                    $document_upload_field_name = 'caste_certificate';
                    $filename_prepend = '_CasteDOC';
                }
                else
                {
                    if ($this->request->data['upload'] == "upload_disability")
                    {
                        $document_type_id = 16;
                        $document_upload_field_name = 'disability_certificate';
                        $filename_prepend = '_DisableDOC';
                    }
                    else
                    {
                        if ($this->request->data['upload'] == "upload_health")
                        {
                            $document_type_id = 15;
                            $document_upload_field_name = 'health_certificate';
                            $filename_prepend = '_HealthDOC';
                        }
                        else
                        {
                            if ($this->request->data['upload'] == "upload_death")
                            {
                                $document_type_id = 17;
                                $document_upload_field_name = 'death_certificate';
                                $filename_prepend = '_DeathDOC';
                            }
                        }
                    }
                }
            }
            $seccFamilyDocument['document'] = $this->request->data[$document_upload_field_name];
            $seccFamilyDocumentAddTemp = TableRegistry::getTableLocator()->get('NfsaCardholderAddTemps')->patchEntity($seccFamilyDocument, $seccFamilyDocument->toArray(), ['validate' => 'Document']);
            
            if (!$seccFamilyDocumentAddTemp->getErrors())
            {
                $old_doc_check = TableRegistry::getTableLocator()->get('NfsaFamilyDocumentAddTemps')->find()->where(['NfsaFamilyDocumentAddTemps.nfsa_family_add_temp_id' => $seccFamilyRegistration['id'], 'document_type_id' => $document_type_id])->first();                  
                if ($old_doc_check && $old_doc_check->document != '')
                {
                    if (!empty($this->request->data[$document_upload_field_name]['name']) and $this->request->data[$document_upload_field_name]['error'] == 0)
                    {
                        $extension = explode('.', $this->request->data[$document_upload_field_name]['name']);
                        $extension = end($extension);
                        $fileNewName = $ack_no . $filename_prepend . strtotime(date('d-m-Y H:i:s')) . '.' . $extension;
                        if (file_exists($application_dir . DS . $old_doc_check->document) && unlink($application_dir . DS . $old_doc_check->document))
                        {
                            if (move_uploaded_file($this->request->data[$document_upload_field_name]['tmp_name'], $application_dir . DS . $fileNewName))
                            {
                                $seccFamilyDocument['document'] = $fileNewName;
                                $seccFamilyDocument['document_type_id'] = $document_type_id;

                             
                                if (TableRegistry::getTableLocator()->get('NfsaFamilyDocumentAddTemps')->delete($old_doc_check))
                                {
                                    if (TableRegistry::getTableLocator()->get('NfsaFamilyDocumentAddTemps')->save($seccFamilyDocument))
                                    {
                                        $this->Flash->success(__('Document have been uploaded.'));
                                    }
                                    else
                                    {
                                        $this->Flash->error(__('Document could not be uploaded. Please, try again.'));
                                    }
                                }
                                else
                                {
                                    $this->Flash->error(__('Document not uploaded. Please, try again.'));
                                }
                            }
                            else
                            {
                                $this->Flash->error(__('Document not updated. Please, try again.'));
                            }
                        }
                        else
                        {
                            if (move_uploaded_file($this->request->data[$document_upload_field_name]['tmp_name'], $application_dir . DS . $fileNewName))
                            {
                                if (TableRegistry::getTableLocator()->get('NfsaFamilyDocumentAddTemps')->delete($old_doc_check))
                                {
                                    $seccFamilyDocument->document = $fileNewName;
                                    $seccFamilyDocument->document_type_id = $document_type_id;
                                    if (TableRegistry::getTableLocator()->get('NfsaFamilyDocumentAddTemps')->save($seccFamilyDocument))
                                    {
                                        $this->Flash->success(__('Document have been uploaded.'));
                                    }
                                    else
                                    {
                                        $this->Flash->error(__('Document could not be uploaded. Please, try again.'));
                                    }
                                }
                                else
                                {
                                    $this->Flash->error(__('Document not uploaded. Please, try again.'));
                                }
                            }
                            else
                            {
                                $this->Flash->error(__('Document not updated. Please, try again.'));
                            }
                        }
                    }
                }
                else
                {
                    $seccFamilyDocument->document_type_id = $document_type_id;
                    if (!empty($this->request->data[$document_upload_field_name]['name']) and $this->request->data[$document_upload_field_name]['error'] == 0)
                    {
                        $extension = explode('.', $this->request->data[$document_upload_field_name]['name']);
                        $extension = end($extension);
                        $fileNewName = $ack_no . $filename_prepend . strtotime(date('d-m-Y H:i:s')) . '.' . $extension;
                        if (move_uploaded_file($this->request->data[$document_upload_field_name]['tmp_name'], $application_dir . DS . $fileNewName))
                        {
                            //debug($seccFamilyDocument);
                            //die;
                            $seccFamilyDocument->document = $fileNewName;
                            if (TableRegistry::getTableLocator()->get('NfsaFamilyDocumentAddTemps')->save($seccFamilyDocument))
                            {
                                $this->Flash->success(__('Document have been uploaded.'));
                            }
                            else
                            {
                                $this->Flash->error(__('Document could not be uploaded. Please, try again.'));
                            }
                        }
                        else
                        {
                            $this->Flash->error(__('Document could not be uploaded. Please, try again.'));
                        }
                    }
                }
            }
            else
            {
                $seccFamilyDocument->setError($document_upload_field_name, $seccFamilyDocumentAddTemp->getErrors());
                $this->Flash->error(__('Document could not be uploaded. Please, try again.'));
            }
        }

        /*************** End : Upload Documents if Pending ********/
        
        $document_status = TableRegistry::getTableLocator()->get('NfsaFamilyDocumentAddTemps')
                            ->find(
                                'all',
                                [
                                    'fields' => [
                                        'bank_doc' => 'sum(case when document_type_id = 13 then 1 else 0 end)',
                                        'caste_doc' => 'sum(case when document_type_id = 14 then 1 else 0 end)', 'disablility_doc' => 'sum(case when document_type_id = 16 then 1 else 0 end)', 'health_doc' => 'sum(case when document_type_id = 15 then 1 else 0 end)', 'death_doc' => 'sum(case when document_type_id = 17 then 1 else 0 end)'
                                    ],
                                    'conditions' => ['nfsa_cardholder_add_temp_id' => $seccCardholderAddTemp['id']]
                                ]
                            )->first();
        $SeccFamilyDocuments = TableRegistry::getTableLocator()->get('NfsaFamilyDocumentAddTemps')->find('list', [
                                'keyField' => 'document_type_id',
                                'valueField' => 'document'
                            ])->where(['NfsaFamilyDocumentAddTemps.nfsa_family_add_temp_id=' . "'" .$seccCardholderAddTemp['id'] . "'"])->toArray();
    
        //----------------------------------------------------------------------
        $seccFamilyAddTemp = $seccFamilyAddTempObj->find('all')->select(['name','name_sl','fathername','fathername_sl','mobile','gender_id','dob','relation_id','uid','disability_status','marital_status','health_status','id','uid_verified'])->where(['nfsa_cardholder_add_temp_id'=>$application_id])->toArray();

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
        $hof_gender = TableRegistry::getTableLocator()->get('NfsaFamilyAddTemps')->find('all', ['fields' => ['gender_id'], 'conditions' => ['nfsa_cardholder_add_temp_id' => $seccCardholderAddTemp['id'], 'hof' => 1]])->first();

        $member_verified_count =   TableRegistry::getTableLocator()->get('NfsaFamilyAddTemps')->find('all')->select([
            'total_uid' => 'sum(case when nfsa_cardholder_add_temp_id = "' . $application_id . '" then 1 else 0 end)', 'uid_verified' => 'sum(case when uid_verified = 1 then 1 else 0 end)',
            'uid_rejected' => 'sum(case when uid_verified = 2 then 1 else 0 end)', 'uid_unverified' => 'sum(case when uid_verified is null then 1  when uid_verified = 0 then 1 else 0 end)'
        ])
            ->WHERE(['nfsa_cardholder_add_temp_id' => $application_id])->first();
        $this->set(compact('districtName','member_verified_count','SeccFamilyDocuments','seccFamilyDocument','document_status','cardholder','hof_gender','group_id','activity_flag','SeccFamilyDocumentAddTemps','bankName','branchName','seccFamilyAddTemp','inclusion_criterias','exclusion_criterias','seccCardholderAddTemp','Relations','cardName','JsfssSeccFamilies','villName','blockName','panchayatName','dealerName','dealerName','license_no','JsfssSeccCardholders','apprv_status','ack_no','rgi_district_code','DocumentTypes'));
    }
    public function bsoApplicationList($activity_id = NULL)
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

    
        if ($group_id!='20')
        {
            return  $this->redirect($this->Auth->logout());
        }
        //-------------------------------------------------------------------

      
      
        $rgi_village_code=$this->request->getData('rgi_village_code');
        $ack_no=$this->request->getData('ack_no');
        $activity_id=$this->request->getData('activity_type_id');
        $activity_flag=$this->request->getData('activity_flag');
        
      
        if (empty($activity_id))
        {
            $this->Flash->error(__('Application type are mandatory.'));
            return $this->redirect(['controller' => 'NfsaCardholders', 'action' => 'bsoSearchApplication']);
        }

           
       

        if (!empty($ack_no))
        {
            $cardholder_condition = "NfsaCardholderAddTemps.rgi_district_code ='" .  $rgi_district_code . "' AND NfsaCardholderAddTemps.ack_no ='" .  $ack_no . "' AND NfsaCardholderAddTemps.activity_type_id ='" . $activity_id . "'AND  activity_flag = '$activity_flag'";
        }
        elseif (empty($ack_no) && empty($rgi_village_code))
        {
            //die;
            $cardholder_condition = "NfsaCardholderAddTemps.rgi_block_code ='" .  $rgi_block_code . "' AND NfsaCardholderAddTemps.activity_type_id ='" . $activity_id . "'AND  activity_flag = '$activity_flag'";
        }
        elseif (!empty($rgi_village_code) && empty($ack_no) )
        {
            $cardholder_condition = "NfsaCardholderAddTemps.rgi_village_code ='" .  $rgi_village_code . "' AND NfsaCardholderAddTemps.activity_type_id ='" . $activity_id . "'AND  activity_flag = '$activity_flag'";
        }
        $nfsaCardholderAddTemps = TableRegistry::getTableLocator()->get('NfsaCardholderAddTemps')
        ->find(
            'all',
            [
                'fields'     =>
                ['id', 'ack_no', 'requested_mobile', 'uid', 'name', 'applicationType', 'fathername', 'fathername_sl', 'cardtype_id', 'caste_id'],
                'conditions' => [$cardholder_condition],
                'contain'    => ['cardtypes', 'castes', 'NfsaFamilyAddTemps' => ['fields' => ['nfsa_cardholder_add_temp_id', 'marital_status', 'disability_status', 'health_status', 'dob']]],
                'order' => ['NfsaCardholderAddTemps.priority_marks' => 'desc', 'NfsaCardholderAddTemps.created' => 'desc'],
                'limit' => 10
            ]
        )
        ->toArray();
      
  
        $CardtypesObj = TableRegistry::getTableLocator()->get('Cardtypes');
        $x = $CardtypesObj->find('list',['keyField' => 'id','valueField' => 'name'])->toArray();

        
        

        $CastesObj = TableRegistry::getTableLocator()->get('Castes');
        $Castes = $CastesObj->find('list',['keyField' => 'id','valueField' => 'name'])->toArray();
        

        $this->set(compact('cardtypes ','x','Castes','nfsaCardholderAddTemps'));
    }


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
        if ($group_id!='12')
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
            return $this->redirect(['controller' => 'NfsaCardholders', 'action' => 'dsoSearchApplication']);
        }

        if (empty($ack_no) && empty($rgi_block_code_frm))
        {
            $this->Flash->error(__('Block is  mandatory.'));
            return $this->redirect(['controller' => 'NfsaCardholders', 'action' => 'dsoSearchApplication']);
        }        
       

        if (!empty($ack_no))
        {
            $cardholder_condition = "NfsaCardholderAddTemps.rgi_district_code ='" .  $rgi_district_code . "' AND NfsaCardholderAddTemps.ack_no ='" .  $ack_no . "' AND NfsaCardholderAddTemps.activity_type_id ='" . $activity_id . "'AND  activity_flag = '$activity_flag'";
        }
        elseif (!empty($rgi_block_code_frm) && (empty($ack_no) && empty($rgi_village_code) ) )
        {
            $cardholder_condition = "NfsaCardholderAddTemps.rgi_block_code ='" .  $rgi_block_code_frm . "' AND NfsaCardholderAddTemps.activity_type_id ='" . $activity_id . "'AND  activity_flag = '$activity_flag'";
        }
        elseif (!empty($rgi_village_code) && empty($ack_no) )
        {
            $cardholder_condition = "NfsaCardholderAddTemps.rgi_village_code ='" .  $rgi_village_code . "' AND NfsaCardholderAddTemps.activity_type_id ='" . $activity_id . "'AND  activity_flag = '$activity_flag'";
        }
 
        $seccCardholderAddTemp = TableRegistry::getTableLocator()->get('NfsaCardholderAddTemps')
        ->find(
            'all',
            [
                'fields'     =>
                ['id', 'ack_no', 'requested_mobile', 'uid', 'name', 'applicationType', 'fathername', 'fathername_sl', 'cardtype_id', 'caste_id'],
                'conditions' => [$cardholder_condition],
                'contain'    => ['cardtypes', 'castes', 'NfsaFamilyAddTemps' => ['fields' => ['nfsa_cardholder_add_temp_id', 'marital_status', 'disability_status', 'health_status', 'dob']]],
                'order' => ['NfsaCardholderAddTemps.priority_marks' => 'desc', 'NfsaCardholderAddTemps.created' => 'desc'],
                'limit' => 10
            ]
        )
        ->toArray();
        $CardtypesObj = TableRegistry::getTableLocator()->get('Cardtypes');
        $x = $CardtypesObj->find('list',['keyField' => 'id','valueField' => 'name'])->toArray();

        
        

        $CastesObj = TableRegistry::getTableLocator()->get('Castes');
        $Castes = $CastesObj->find('list',['keyField' => 'id','valueField' => 'name'])->toArray();
        

        $this->set(compact('cardtypes ','x','Castes','seccCardholderAddTemp'));
    }

    function dsoApplicationView()
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
        if ($this->request->is(['patch', 'post', 'put']))
        {
            $application_id = $this->request->getData('application_id');
            $activity_id = 1;
        }
        
        if ($this->request->getData('submit') == 'verify')
        {
            $nfsa_family_add_temp_id    = $this->request->data['nfsa_cardholder_add_temp_id'];
            
            $seccFamilyMember = TableRegistry::getTableLocator()->get('NfsaFamilyAddTemps')
                                    ->find(
                                        'all',
                                        [
                                            'fields'     =>
                                            ['id', 'mobile', 'uid'],
                                            'conditions' => ['id' => $nfsa_family_add_temp_id],
                                        ]
                                    )
                                    ->first();
           
           
            $Ercms=new ErcmsValidateController;
            $aadharCount =  $Ercms->nfsaCheckAadharVerify($seccFamilyMember->uid);
            $mobileCount =  $Ercms->checkMobile_verify($seccFamilyMember->mobile);
            
            if ($aadharCount > 0)
            {
                $this->Flash->error(__('This Aadhar Number already exists. Please, try again.'));
            }
            elseif (($mobileCount == 0 && $aadharCount == 0) || ($mobileCount > 0 && $aadharCount == 0))
            {
                if ($mobileCount > 0)
                {
                    $update = TableRegistry::getTableLocator()->get('NfsaFamilyAddTemps')->updateAll(['mobile' => '', 'uid_verified' => 1], ["id" => $nfsa_family_add_temp_id]);
                }
                else
                {
                    $update = TableRegistry::getTableLocator()->get('NfsaFamilyAddTemps')->updateAll(['uid_verified' => 1], ["id" => $nfsa_family_add_temp_id]);
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
                return $this->redirect(['controller' => 'NfsaCardholders', 'action' => 'dsoSearchApplication']);
            }
            $application_id = $this->request->getData('application_id');

            if (empty($apprv_status) || empty($application_id) )
            {
                $this->Flash->error(__('Error occured. Please try again.'));
                return $this->redirect(['controller' => 'NfsaCardholders', 'action' => 'dsoSearchApplication']);
            }


            $verified_count =   TableRegistry::getTableLocator()->get('NfsaFamilyAddTemps')->find()->WHERE(['OR' => [
                'uid_verified is null',
                'uid_verified' => 0
            ], 'nfsa_cardholder_add_temp_id' => $application_id])->count();
          
            if ($verified_count > 0 &&  $apprv_status == 1)
            {
                $this->Flash->error(__('You need to verify each individual family member first to proceed. Please, try again.'));
                return $this->redirect(['controller' => 'NfsaCardholders', 'action' => 'dsoSearchApplication']);
            }
        
            $datetime = date('Y-m-d H:i:s');

            $cardholder_add_temp_array =  TableRegistry::getTableLocator()->get('NfsaCardholderAddTemps')
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
                return $this->redirect(['controller' => 'NfsaCardholders', 'action' => 'dsoSearchApplication']);
            }
            if ($rgi_district_code_application!=$rgi_district_code)
            {
                $this->Flash->error(__('Failed To Approve !.Application  belongs to another District'));
                return $this->redirect(['controller' => 'NfsaCardholders', 'action' =>'dsoSearchApplication']);
            }
            $Ercms = new ErcmsValidateController;
            $rationcard_no =  $Ercms->rationcardNo($cardholder_add_temp_array['cardtype_id']);

            $cardtype_id=$cardholder_add_temp_array['cardtype_id'];
          

			 $seccDistrictReportObj = TableRegistry::getTableLocator()->get('SeccDistrictReports'); 
	    		if($apprv_status==3)//Approve
			{
				//Check Upper Limit for your district
                        	if($cardtype_id==5 || $cardtype_id==6)
                        	{

                                $seccDistrictReport = $seccDistrictReportObj->find('all')->select(['add_member_upper','add_member_upper_limit'])->where(['rationcard_no'=>$rationcard_no])->first()->toArray();
                                $add_member_upper=$seccDistrictReport['add_member_upper'];
                                $add_member_upper_limit=$seccDistrictReport['add_member_upper_limit'];

                                	if($add_member_upper>=$add_member_upper_limit)
                                	{
                                        	$this->Flash->error(__('Upper Limit for adding Rationcard has been reached for your district.', true));
                                        	return $this->redirect(['controller' => 'NfsaCardholders', 'action' => 'dsoSearchApplication']);
                                	}
                            	}
            		} 
   
            if ($rationcard_no != '')
            {
                //die;
                $connection = ConnectionManager::get('default'); 
                $id=$application_id; 
                                                                   
                $connection->begin();
                $condition_seccf1 = ['nfsa_cardholder_add_temp_id' => $id,'uid_verified'=>'1'];
                   
                $condition_seccf = ['nfsa_cardholder_add_temp_id' => $id];
                $condition_secc = ['id' => $id]; 
               
                if ($apprv_status=='3')
                {
                    $sqlFamilyInsert="insert into nfsa_families (id, rationcard_no,nfsa_family_add_temp_id,ahl_tin, hhd_unique_no,nfsa_cardholder_id, rgi_district_code, rgi_block_code, rgi_village_code, name, name_sl, fathername, fathername_sl, mothername, mothername_sl, relation_id, relation_sl, gender_id, dob, freeze_status, mobile, uid, uid_verified, bank_master_id, branch_master_id, accountNo, hof , uidFlag, created, modified, created_by, bfd1, bfd2, bfd3, dbtFlag,uidMobileChangeFlag,disability_status,marital_status,health_status) select uuid(), '$rationcard_no',id,ahl_tin, hhd_unique_no, '', rgi_district_code, rgi_block_code, rgi_village_code, name, name_sl, fathername, fathername_sl, mothername, mothername_sl, relation_id, relation_sl, gender_id, dob, freeze_status, mobile, uid,'1',bank_master_id, branch_master_id, accountNo, hof , uidFlag,'$datetime','$datetime','$user_id', bfd1, bfd2, bfd3, dbtFlag,'$datetime',disability_status,marital_status,health_status from nfsa_family_add_temps where nfsa_cardholder_add_temp_id=:nfsa_cardholder_add_temp_id and uid_verified=:uid_verified";
                    $dd=$connection->execute($sqlFamilyInsert, $condition_seccf1);
        
                    $sqlCardInsert="insert into nfsa_cardholders(id, rationcard_no, name, name_sl, location_id, cardtype_id, fathername, fathername_sl, mothername, mothername_sl, caste_id, secc_district_id, secc_block_id, panchayat_id, secc_village_ward_id, rgi_district_code, rgi_block_code, rgi_village_code, res_address, res_address_hn, tolla_mohalla, qtr_plot_no, holding_no, dealer_id, status, family_count, mobile_count, uid_count, printFlag, applicationType,applicationType_rule_id,activityFlag, activityType, dbtFlag, liftedCount, created, modified, verified, created_by, modified_by, old_alone,non_gov,above_sixty,marital_status,disability_status,health_status,beggar,rag_picker,worker,street_vendor,pvtg,is_lpg,lpg_company,lpg_consumer_no,is_bank,bank_account_no,bank_master_id,bank_ifsc_code) select uuid(), '$rationcard_no', name, name_sl, location_id, cardtype_id, fathername, fathername_sl, mothername, mothername_sl, caste_id, secc_district_id, secc_block_id, panchayat_id, secc_village_ward_id, rgi_district_code, rgi_block_code, rgi_village_code, res_address, res_address_hn, tolla_mohalla, qtr_plot_no, holding_no,dealer_id,status,family_count, mobile_count, uid_count, printFlag, applicationType,applicationType_rule_id,activityFlag, activityType, dbtFlag, liftedCount,'$datetime','$datetime','$datetime','$user_id','$user_id',old_alone,non_gov,above_sixty,marital_status,disability_status,health_status,beggar,rag_picker,worker,street_vendor,pvtg,is_lpg,lpg_company,lpg_consumer_no,is_bank,bank_account_no,bank_master_id,bank_ifsc_code  from nfsa_cardholder_add_temps where id=:id ";							
                    $results = $connection->execute($sqlCardInsert, $condition_secc);

                    

                    if ($cardtype_id=='5' || $cardtype_id=='6')
                    {
                        $sqlfamilyStateUpdte="update state_reports set rationPhSlno='$rationcard_no'";
                        $connection->execute($sqlfamilyStateUpdte);
                    }
                    elseif ($cardtype_id=='7')
                    {
                        $sqlfamilyStateUpdte="update state_reports set 	rationWhiteSlno='$rationcard_no'";
                        $connection->execute($sqlfamilyStateUpdte);
                    }
                    

                   
                      
                    $status='approved';
                }
                else
                {
                    $status='rejected';
                }

                $sqlUpdte="update nfsa_cardholder_add_temps set rationcard_no='$rationcard_no', activity_flag='$apprv_status', modified='$datetime', modified_by='$user_id',dso_modifiedDate='$datetime' where id=:id";
                $connection->execute($sqlUpdte, $condition_secc); 

                $sqlfamilyUpdte="update nfsa_family_add_temps set rationcard_no='$rationcard_no', activity_flag='$apprv_status', modified='$datetime', modified_by='$user_id', dso_modifiedDate='$datetime' where nfsa_cardholder_add_temp_id=:nfsa_cardholder_add_temp_id";
                $connection->execute($sqlfamilyUpdte, $condition_seccf);
                    
                 
                    
                $msg = $username . " has $status request for Add New Rationcard of acknowledgement no- " . $cardholder_add_temp_array['ack_no'];
                $query = TableRegistry::getTableLocator()->get('nfsa_ercms_logs')->query();
                $query->insert(['id','rationcard_no','rgi_district_code', 'user_id', 'user_name', 'group_id', 'activity_type_id', 'activity_flag', 'label', 'message', 'created'])
                        ->values(['id' =>Text::uuid(),'rationcard_no'=>$rationcard_no, 'rgi_district_code' => $rgi_district_code, 'user_id' => $user_id, 'user_name' => $username, 'group_id' => $group_id, 'activity_type_id' => '1', 'activity_flag' => $apprv_status, 'label' => '1', 'message' => $msg,'created' => $datetime])
                        ->execute();
                
                $connection->commit();

                $connection->begin();
                $connection->execute("insert into nfsa_cardholder_add_temp_backups  select * from nfsa_cardholder_add_temps where ack_no='$ack_no'");
                $connection->execute("insert into nfsa_family_add_temp_backups  select * from nfsa_family_add_temps where ack_no_ercms='$ack_no'");
                $connection->execute("delete from nfsa_cardholder_add_temps where ack_no='$ack_no'");
                $connection->execute("delete from nfsa_family_add_temps where ack_no_ercms='$ack_no'");
                $connection->commit();
               
                //-----------------------------------------
                if ($apprv_status=='3')
                {
                    $NfsaCardholdersObj = TableRegistry::getTableLocator()->get('NfsaCardholders');
                    $NfsaCardholders = $NfsaCardholdersObj->find('all')->select(['id'])->where(['rationcard_no'=>$rationcard_no])->first()->toArray();
                    $JsfssSeccCardholdid=$NfsaCardholders['id'];

                    $jsfss_secc_families="update nfsa_families set nfsa_cardholder_id='$JsfssSeccCardholdid' where rationcard_no='$rationcard_no'";
                    $connection->execute($jsfss_secc_families);
                    $this->Flash->success(__("RationCard:-$rationcard_no No generated successfully."));
                }
                else
                {
                    $this->Flash->error(__("Application Rejected"));
                }


                //-----------------------------------------------

                
                return $this->redirect(['controller' => 'NfsaCardholders', 'action' => 'dsoSearchApplication']);
            }
            else
            {
                $this->Flash->error(__('RationCard No generation failed. Please try again.'));
                return $this->redirect(['controller' => 'NfsaCardholders', 'action' => 'dsoSearchApplication']);
            }
        }
        //-------------------Application details------------------------------------------
        $seccCardholderAddTempObj = TableRegistry::getTableLocator()->get('NfsaCardholderAddTemps');
        $seccFamilyAddTempObj = TableRegistry::getTableLocator()->get('NfsaFamilyAddTemps');
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
        $SeccFamilyDocumentAddTempsObj = TableRegistry::getTableLocator()->get('NfsaFamilyDocumentAddTemps');

        $SeccFamilyDocumentAddTemps = $SeccFamilyDocumentAddTempsObj->find('all')->select(['nfsa_family_add_temp_id','document_type_id','document'])->where(['nfsa_cardholder_add_temp_id'=>$application_id])->toArray();       
        $DocumentTypes = $DocumentTypesObj->find('list',['keyField' => 'id','valueField' => 'name'])->toArray();
 

	
        $seccCardholderAddTemp = $seccCardholderAddTempObj->find('all')->select(['name','ack_no','activity_flag','id','location_id','applicationType_rule_id','requested_mobile','fathername','applicationType','rgi_district_code','rgi_block_code','rgi_village_code','cardtype_id','rationcard_no','dealer_id','panchayat_id','is_bank', 'bank_master_id', 'branch_master_id', 'bank_account_no', 'bank_ifsc_code', 'is_lpg','old_alone','marital_status','disability_status','health_status','beggar','rag_picker','worker','street_vendor','pvtg','non_gov','above_sixty','lpg_consumer_no'])->where(['id'=>$application_id])->first();
        $cardholder=$seccCardholderAddTemp;
        $seccCardholderAddTemp=$seccCardholderAddTemp->toArray();


        $seccFamilyAddTemp = $seccFamilyAddTempObj->find('all')->select(['name','name_sl','fathername','fathername_sl','mobile','gender_id','dob','relation_id','uid','disability_status','marital_status','health_status','id','uid_verified'])->where(['nfsa_cardholder_add_temp_id'=>$application_id])->toArray();

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

        $hof_gender = TableRegistry::getTableLocator()->get('NfsaFamilyAddTemps')->find('all', ['fields' => ['gender_id'], 'conditions' => ['nfsa_cardholder_add_temp_id' => $seccCardholderAddTemp['id'], 'hof' => 1]])->first();
        
        //print_r($cardholder);die;
        $this->set(compact('districtName','group_id','activity_flag','SeccFamilyDocumentAddTemps','bankName','branchName','seccFamilyAddTemp','inclusion_criterias','exclusion_criterias','seccCardholderAddTemp','Relations','cardName','JsfssSeccFamilies','villName','blockName','panchayatName','dealerName','dealerName','license_no','NfsaCardholders','apprv_status','ack_no','rgi_district_code','DocumentTypes','cardholder','hof_gender'));
    }
}
