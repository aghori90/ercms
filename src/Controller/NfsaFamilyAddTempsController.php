<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * NfsaFamilyAddTemps Controller
 *
 * @property \App\Model\Table\NfsaFamilyAddTempsTable $NfsaFamilyAddTemps
 *
 * @method \App\Model\Entity\NfsaFamilyAddTemp[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class NfsaFamilyAddTempsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['NfsaSeccFamilies', 'NfsaCardholders', 'NfsaCardholderAddTemps', 'Relations', 'Genders', 'BankMasters', 'BranchMasters', 'ActivitiesStatuses', 'ActivityTypes'],
        ];
        $nfsaFamilyAddTemps = $this->paginate($this->NfsaFamilyAddTemps);

        $this->set(compact('nfsaFamilyAddTemps'));
    }

    /**
     * View method
     *
     * @param string|null $id Nfsa Family Add Temp id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $nfsaFamilyAddTemp = $this->NfsaFamilyAddTemps->get($id, [
            'contain' => ['NfsaSeccFamilies', 'NfsaCardholders', 'NfsaCardholderAddTemps', 'Relations', 'Genders', 'BankMasters', 'BranchMasters', 'ActivitiesStatuses', 'ActivityTypes'],
        ]);

        $this->set('nfsaFamilyAddTemp', $nfsaFamilyAddTemp);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $nfsaFamilyAddTemp = $this->NfsaFamilyAddTemps->newEntity();
        if ($this->request->is('post')) {
            $nfsaFamilyAddTemp = $this->NfsaFamilyAddTemps->patchEntity($nfsaFamilyAddTemp, $this->request->getData());
            if ($this->NfsaFamilyAddTemps->save($nfsaFamilyAddTemp)) {
                $this->Flash->success(__('The nfsa family add temp has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The nfsa family add temp could not be saved. Please, try again.'));
        }
        $nfsaSeccFamilies = $this->NfsaFamilyAddTemps->NfsaSeccFamilies->find('list', ['limit' => 200]);
        $nfsaCardholders = $this->NfsaFamilyAddTemps->NfsaCardholders->find('list', ['limit' => 200]);
        $nfsaCardholderAddTemps = $this->NfsaFamilyAddTemps->NfsaCardholderAddTemps->find('list', ['limit' => 200]);
        $relations = $this->NfsaFamilyAddTemps->Relations->find('list', ['limit' => 200]);
        $genders = $this->NfsaFamilyAddTemps->Genders->find('list', ['limit' => 200]);
        $bankMasters = $this->NfsaFamilyAddTemps->BankMasters->find('list', ['limit' => 200]);
        $branchMasters = $this->NfsaFamilyAddTemps->BranchMasters->find('list', ['limit' => 200]);
        $activitiesStatuses = $this->NfsaFamilyAddTemps->ActivitiesStatuses->find('list', ['limit' => 200]);
        $activityTypes = $this->NfsaFamilyAddTemps->ActivityTypes->find('list', ['limit' => 200]);
        $this->set(compact('nfsaFamilyAddTemp', 'nfsaSeccFamilies', 'nfsaCardholders', 'nfsaCardholderAddTemps', 'relations', 'genders', 'bankMasters', 'branchMasters', 'activitiesStatuses', 'activityTypes'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Nfsa Family Add Temp id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $nfsaFamilyAddTemp = $this->NfsaFamilyAddTemps->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $nfsaFamilyAddTemp = $this->NfsaFamilyAddTemps->patchEntity($nfsaFamilyAddTemp, $this->request->getData());
            if ($this->NfsaFamilyAddTemps->save($nfsaFamilyAddTemp)) {
                $this->Flash->success(__('The nfsa family add temp has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The nfsa family add temp could not be saved. Please, try again.'));
        }
        $nfsaSeccFamilies = $this->NfsaFamilyAddTemps->NfsaSeccFamilies->find('list', ['limit' => 200]);
        $nfsaCardholders = $this->NfsaFamilyAddTemps->NfsaCardholders->find('list', ['limit' => 200]);
        $nfsaCardholderAddTemps = $this->NfsaFamilyAddTemps->NfsaCardholderAddTemps->find('list', ['limit' => 200]);
        $relations = $this->NfsaFamilyAddTemps->Relations->find('list', ['limit' => 200]);
        $genders = $this->NfsaFamilyAddTemps->Genders->find('list', ['limit' => 200]);
        $bankMasters = $this->NfsaFamilyAddTemps->BankMasters->find('list', ['limit' => 200]);
        $branchMasters = $this->NfsaFamilyAddTemps->BranchMasters->find('list', ['limit' => 200]);
        $activitiesStatuses = $this->NfsaFamilyAddTemps->ActivitiesStatuses->find('list', ['limit' => 200]);
        $activityTypes = $this->NfsaFamilyAddTemps->ActivityTypes->find('list', ['limit' => 200]);
        $this->set(compact('nfsaFamilyAddTemp', 'nfsaSeccFamilies', 'nfsaCardholders', 'nfsaCardholderAddTemps', 'relations', 'genders', 'bankMasters', 'branchMasters', 'activitiesStatuses', 'activityTypes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Nfsa Family Add Temp id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $nfsaFamilyAddTemp = $this->NfsaFamilyAddTemps->get($id);
        if ($this->NfsaFamilyAddTemps->delete($nfsaFamilyAddTemp)) {
            $this->Flash->success(__('The nfsa family add temp has been deleted.'));
        } else {
            $this->Flash->error(__('The nfsa family add temp could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
