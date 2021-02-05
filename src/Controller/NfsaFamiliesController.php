<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * NfsaFamilies Controller
 *
 * @property \App\Model\Table\NfsaFamiliesTable $NfsaFamilies
 *
 * @method \App\Model\Entity\NfsaFamily[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class NfsaFamiliesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['NfsaCardholders', 'NfsaFamilyAddTemps', 'Relations', 'Genders', 'Cardtypes', 'BankMasters', 'BranchMasters', 'DeleteReasons'],
        ];
        $nfsaFamilies = $this->paginate($this->NfsaFamilies);

        $this->set(compact('nfsaFamilies'));
    }

    /**
     * View method
     *
     * @param string|null $id Nfsa Family id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $nfsaFamily = $this->NfsaFamilies->get($id, [
            'contain' => ['NfsaCardholders', 'NfsaFamilyAddTemps', 'Relations', 'Genders', 'Cardtypes', 'BankMasters', 'BranchMasters', 'DeleteReasons'],
        ]);

        $this->set('nfsaFamily', $nfsaFamily);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $nfsaFamily = $this->NfsaFamilies->newEntity();
        if ($this->request->is('post')) {
            $nfsaFamily = $this->NfsaFamilies->patchEntity($nfsaFamily, $this->request->getData());
            if ($this->NfsaFamilies->save($nfsaFamily)) {
                $this->Flash->success(__('The nfsa family has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The nfsa family could not be saved. Please, try again.'));
        }
        $nfsaCardholders = $this->NfsaFamilies->NfsaCardholders->find('list', ['limit' => 200]);
        $nfsaFamilyAddTemps = $this->NfsaFamilies->NfsaFamilyAddTemps->find('list', ['limit' => 200]);
        $relations = $this->NfsaFamilies->Relations->find('list', ['limit' => 200]);
        $genders = $this->NfsaFamilies->Genders->find('list', ['limit' => 200]);
        $cardtypes = $this->NfsaFamilies->Cardtypes->find('list', ['limit' => 200]);
        $bankMasters = $this->NfsaFamilies->BankMasters->find('list', ['limit' => 200]);
        $branchMasters = $this->NfsaFamilies->BranchMasters->find('list', ['limit' => 200]);
        $deleteReasons = $this->NfsaFamilies->DeleteReasons->find('list', ['limit' => 200]);
        $this->set(compact('nfsaFamily', 'nfsaCardholders', 'nfsaFamilyAddTemps', 'relations', 'genders', 'cardtypes', 'bankMasters', 'branchMasters', 'deleteReasons'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Nfsa Family id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $nfsaFamily = $this->NfsaFamilies->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $nfsaFamily = $this->NfsaFamilies->patchEntity($nfsaFamily, $this->request->getData());
            if ($this->NfsaFamilies->save($nfsaFamily)) {
                $this->Flash->success(__('The nfsa family has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The nfsa family could not be saved. Please, try again.'));
        }
        $nfsaCardholders = $this->NfsaFamilies->NfsaCardholders->find('list', ['limit' => 200]);
        $nfsaFamilyAddTemps = $this->NfsaFamilies->NfsaFamilyAddTemps->find('list', ['limit' => 200]);
        $relations = $this->NfsaFamilies->Relations->find('list', ['limit' => 200]);
        $genders = $this->NfsaFamilies->Genders->find('list', ['limit' => 200]);
        $cardtypes = $this->NfsaFamilies->Cardtypes->find('list', ['limit' => 200]);
        $bankMasters = $this->NfsaFamilies->BankMasters->find('list', ['limit' => 200]);
        $branchMasters = $this->NfsaFamilies->BranchMasters->find('list', ['limit' => 200]);
        $deleteReasons = $this->NfsaFamilies->DeleteReasons->find('list', ['limit' => 200]);
        $this->set(compact('nfsaFamily', 'nfsaCardholders', 'nfsaFamilyAddTemps', 'relations', 'genders', 'cardtypes', 'bankMasters', 'branchMasters', 'deleteReasons'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Nfsa Family id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $nfsaFamily = $this->NfsaFamilies->get($id);
        if ($this->NfsaFamilies->delete($nfsaFamily)) {
            $this->Flash->success(__('The nfsa family has been deleted.'));
        } else {
            $this->Flash->error(__('The nfsa family could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
