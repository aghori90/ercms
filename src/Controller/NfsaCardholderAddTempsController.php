<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * NfsaCardholderAddTemps Controller
 *
 * @property \App\Model\Table\NfsaCardholderAddTempsTable $NfsaCardholderAddTemps
 *
 * @method \App\Model\Entity\NfsaCardholderAddTemp[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class NfsaCardholderAddTempsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['NfsaCardholders', 'Locations', 'Cardtypes', 'Castes', 'SeccDistricts', 'SeccBlocks', 'Panchayats', 'SeccVillageWards', 'Dealers', 'BankMasters', 'BranchMasters', 'ApplicationTypeRules', 'ActivityTypes', 'ActivitiesStatuses'],
        ];
        $nfsaCardholderAddTemps = $this->paginate($this->NfsaCardholderAddTemps);

        $this->set(compact('nfsaCardholderAddTemps'));
    }

    /**
     * View method
     *
     * @param string|null $id Nfsa Cardholder Add Temp id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $nfsaCardholderAddTemp = $this->NfsaCardholderAddTemps->get($id, [
            'contain' => ['NfsaCardholders', 'Locations', 'Cardtypes', 'Castes', 'SeccDistricts', 'SeccBlocks', 'Panchayats', 'SeccVillageWards', 'Dealers', 'BankMasters', 'BranchMasters', 'ApplicationTypeRules', 'ActivityTypes', 'ActivitiesStatuses', 'NfsaFamilyAddTemps'],
        ]);

        $this->set('nfsaCardholderAddTemp', $nfsaCardholderAddTemp);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $nfsaCardholderAddTemp = $this->NfsaCardholderAddTemps->newEntity();
        if ($this->request->is('post')) {
            $nfsaCardholderAddTemp = $this->NfsaCardholderAddTemps->patchEntity($nfsaCardholderAddTemp, $this->request->getData());
            if ($this->NfsaCardholderAddTemps->save($nfsaCardholderAddTemp)) {
                $this->Flash->success(__('The nfsa cardholder add temp has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The nfsa cardholder add temp could not be saved. Please, try again.'));
        }
        $nfsaCardholders = $this->NfsaCardholderAddTemps->NfsaCardholders->find('list', ['limit' => 200]);
        $locations = $this->NfsaCardholderAddTemps->Locations->find('list', ['limit' => 200]);
        $cardtypes = $this->NfsaCardholderAddTemps->Cardtypes->find('list', ['limit' => 200]);
        $castes = $this->NfsaCardholderAddTemps->Castes->find('list', ['limit' => 200]);
        $seccDistricts = $this->NfsaCardholderAddTemps->SeccDistricts->find('list', ['limit' => 200]);
        $seccBlocks = $this->NfsaCardholderAddTemps->SeccBlocks->find('list', ['limit' => 200]);
        $panchayats = $this->NfsaCardholderAddTemps->Panchayats->find('list', ['limit' => 200]);
        $seccVillageWards = $this->NfsaCardholderAddTemps->SeccVillageWards->find('list', ['limit' => 200]);
        $dealers = $this->NfsaCardholderAddTemps->Dealers->find('list', ['limit' => 200]);
        $bankMasters = $this->NfsaCardholderAddTemps->BankMasters->find('list', ['limit' => 200]);
        $branchMasters = $this->NfsaCardholderAddTemps->BranchMasters->find('list', ['limit' => 200]);
        $applicationTypeRules = $this->NfsaCardholderAddTemps->ApplicationTypeRules->find('list', ['limit' => 200]);
        $activityTypes = $this->NfsaCardholderAddTemps->ActivityTypes->find('list', ['limit' => 200]);
        $activitiesStatuses = $this->NfsaCardholderAddTemps->ActivitiesStatuses->find('list', ['limit' => 200]);
        $this->set(compact('nfsaCardholderAddTemp', 'nfsaCardholders', 'locations', 'cardtypes', 'castes', 'seccDistricts', 'seccBlocks', 'panchayats', 'seccVillageWards', 'dealers', 'bankMasters', 'branchMasters', 'applicationTypeRules', 'activityTypes', 'activitiesStatuses'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Nfsa Cardholder Add Temp id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $nfsaCardholderAddTemp = $this->NfsaCardholderAddTemps->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $nfsaCardholderAddTemp = $this->NfsaCardholderAddTemps->patchEntity($nfsaCardholderAddTemp, $this->request->getData());
            if ($this->NfsaCardholderAddTemps->save($nfsaCardholderAddTemp)) {
                $this->Flash->success(__('The nfsa cardholder add temp has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The nfsa cardholder add temp could not be saved. Please, try again.'));
        }
        $nfsaCardholders = $this->NfsaCardholderAddTemps->NfsaCardholders->find('list', ['limit' => 200]);
        $locations = $this->NfsaCardholderAddTemps->Locations->find('list', ['limit' => 200]);
        $cardtypes = $this->NfsaCardholderAddTemps->Cardtypes->find('list', ['limit' => 200]);
        $castes = $this->NfsaCardholderAddTemps->Castes->find('list', ['limit' => 200]);
        $seccDistricts = $this->NfsaCardholderAddTemps->SeccDistricts->find('list', ['limit' => 200]);
        $seccBlocks = $this->NfsaCardholderAddTemps->SeccBlocks->find('list', ['limit' => 200]);
        $panchayats = $this->NfsaCardholderAddTemps->Panchayats->find('list', ['limit' => 200]);
        $seccVillageWards = $this->NfsaCardholderAddTemps->SeccVillageWards->find('list', ['limit' => 200]);
        $dealers = $this->NfsaCardholderAddTemps->Dealers->find('list', ['limit' => 200]);
        $bankMasters = $this->NfsaCardholderAddTemps->BankMasters->find('list', ['limit' => 200]);
        $branchMasters = $this->NfsaCardholderAddTemps->BranchMasters->find('list', ['limit' => 200]);
        $applicationTypeRules = $this->NfsaCardholderAddTemps->ApplicationTypeRules->find('list', ['limit' => 200]);
        $activityTypes = $this->NfsaCardholderAddTemps->ActivityTypes->find('list', ['limit' => 200]);
        $activitiesStatuses = $this->NfsaCardholderAddTemps->ActivitiesStatuses->find('list', ['limit' => 200]);
        $this->set(compact('nfsaCardholderAddTemp', 'nfsaCardholders', 'locations', 'cardtypes', 'castes', 'seccDistricts', 'seccBlocks', 'panchayats', 'seccVillageWards', 'dealers', 'bankMasters', 'branchMasters', 'applicationTypeRules', 'activityTypes', 'activitiesStatuses'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Nfsa Cardholder Add Temp id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $nfsaCardholderAddTemp = $this->NfsaCardholderAddTemps->get($id);
        if ($this->NfsaCardholderAddTemps->delete($nfsaCardholderAddTemp)) {
            $this->Flash->success(__('The nfsa cardholder add temp has been deleted.'));
        } else {
            $this->Flash->error(__('The nfsa cardholder add temp could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
