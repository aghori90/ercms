<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Routing\Router;
use Cake\Mailer\Email;
use Cake\Validation\Validation;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Database\Connection;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['logout','login']);
        
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {   
        $this->viewBuilder()->setLayout('admin');        
    }

    // Login ----------------------------------------------------------------------
    public function login()
    {
        $this->set("title", "Login");
        if ($this->request->is('post')) {
            if ($this->Auth->user('id')) { //if already loggedin
                $this->Flash->error(__('You are already logged in!'));
                return $this->redirect(['controller' => 'Users', 'action' => 'index']);
            } else {
                $user = $this->Auth->identify();
                // echo $user['id'];
                $this->request->getSession()->write('loggedinUser.id', $user['id']);
                $this->request->getSession()->write('loggedinUser.username', $user['username']);
                // For correct  Login
                if ($user) {
                    $this->Auth->setUser($user); 
                    $this->Flash->success(__('Login Successfull'));
                    return $this->redirect(['controller' => 'users', 'action' => 'index']);
                }
                // For incorrect Login
                $this->Flash->error(__('Incorrect Login'));
            }
        }     
    }
    // *logout*-----------------------------------------------------------
    public function logout()
    {
        //$this->Flash->success(__('Logout successfully'));
        $this->getRequest()->getSession()->delete('Auth');
        $this->Flash->success('You have successfully logged out'); 
       // return $this->redirect(['controller'=>'Users','action' => 'ercmsRequest']); 
        return $this->redirect($this->Auth->logout());
    }
}
