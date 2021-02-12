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

use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Routing\Router;
use Cake\Utility\Security;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /** Start : Define global variables*/
    public $base_url;
    /** End : Define global variables*/

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        define("DOC_ABS_PATH", "/opt/jsfss_data/ercms/");
        //define("DOC_NFSA_PATH","/opt/nfsa_data/ercms/");
        define("ENCY_KEY", "pnk2horncursgw$@e%oecje^xjwien@de$*wewegwe");
        define("iv_KEY", '3237567841016626');
        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');
        $this->base_url = Router::url("/", true);
        $this->set("baseurl", $this->base_url);
        $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'username',
                        'password' => 'password'
                    ]
                ]
            ],
            'loginRedirect' => [
                'controller' => 'SeccCardholders',
                'action' => 'index'
            ],
            'logoutRedirect' => [
                'controller' => 'SeccCardholders',
                'action' => 'index'
            ],
            'loginAction' => [
                'controller' => 'SeccCardholders',
                'action' => 'index'
            ],
            'logoutAction' => [
                'controller' => 'SeccCardholders',
                'action' => 'index'
            ]
        ]);
        $this->set('auth', $this->request->getSession()->read('Auth'));

        $this->Auth->allow(['checkaadhar', 'getPanchayatsByBlock', 'getBlocksByDistrict', 'getVillagesByBlock', 'getVillagesByPanchayat', 'villageWiseCron']);


        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
    }

    /**
     * getBlocksByDistrict Method
     *
     */
    public function showfile($docurl)
    {

        $this->autoRender = false;
        $filename = base64_decode($docurl);
        $exp1 = explode('.', $filename);
        $exp = $exp1[(count($exp1) - 1)];
        $getInfo = getimagesize($filename);
        header('Content-type: ' . $getInfo['mime']);
        header('Content-Length: ' . filesize($filename));
        header('Cache-Control: no-cache');
        //ob_clean();
        flush();
        readfile($filename);
    }

    public function getBlocksByDistrict($id = null)
    {
        $request_data = $this->request->getData();
        if ($this->request->is(['ajax'])) {
            $this->autoRender = false;
            $this->viewBuilder()->setLayout('ajax');
            $id = $request_data['id'];
        }
        $blockCityData = TableRegistry::getTableLocator()->get('SeccBlocks');
        if (!empty($id)) {
            $query = $blockCityData->find('list', [
                'keyField' => 'rgi_block_code',
                'valueField' => 'name',
                'conditions' => ['rgi_district_code=' . "'" . $id . "'"]

            ]);
        } else {
            $query = $blockCityData->find('list', [
                'keyField' => 'rgi_block_code',
                'valueField' => 'name'
            ]);
        }
        $blocks = $query->toArray();
        //array_unshift($blocks, '--Select Block--');
        if ($this->request->is(['ajax'])) {
            echo json_encode($blocks);
            die;
        } else {
            return $blocks;
        }
    }

    /**
     * method getVillagesByBlock
     * @return type
     */

    public function getVillagesByBlock($id = null)
    {
        $request_data = $this->request->getData();
        if ($this->request->is(['ajax'])) {
            $this->autoRender = false;
            $this->viewBuilder()->setLayout('ajax');
            $id = $request_data['id'];
        }
        $villageData = TableRegistry::get('SeccVillageWards');
        //$villageData = TableRegistry::getTableLocator()->get('SeccVillageWards');
        $query = $villageData->find('list', [
            'keyField' => 'rgi_village_code',
            'valueField' => 'name',
            'conditions' => ['SeccVillageWards.rgi_block_code=' . "'" . $id . "'"]
        ]);
        $villages = $query->toArray();
        if ($this->request->is(['ajax'])) {
            echo json_encode($villages);
            die;
        } else {
            return $villages;
        }
    }

    public function appEncryptData($value)
    {
        $key = ENCY_KEY;
        $plaintext = $value;
        $cipher = "aes-128-ctr";
        if (in_array($cipher, openssl_get_cipher_methods())) {
            $ivlen = openssl_cipher_iv_length($cipher);
            $iv = iv_KEY;
            $ciphertext = openssl_encrypt($plaintext, $cipher, $key, $options = 0, $iv);
        }
        return $ciphertext;
    }

    public function appDecryptData($value)
    {
        $key = ENCY_KEY;
        $ciphertext = $value;
        $cipher = "aes-128-ctr";
        if (in_array($cipher, openssl_get_cipher_methods())) {
            $ivlen = openssl_cipher_iv_length($cipher);
            $iv = iv_KEY;

            $original_plaintext = openssl_decrypt($ciphertext, $cipher, $key, $options = 0, $iv);
        }
        return $original_plaintext;
    }

    public function getDealersByBlock($id = null)
    {
        $request_data = $this->request->getData();
        if ($this->request->is(['ajax'])) {
            $this->autoRender = false;
            $this->viewBuilder()->setLayout('ajax');
            $id = $request_data['id'];
        }

        $Dealers = TableRegistry::getTableLocator()->get('Dealers');
        if (!empty($id)) {
            $query = $Dealers->find('list', [
                'keyField' => 'id',
                'valueField' => 'name',
                'conditions' => ['Dealers.rgi_block_code=' . "'" . $id . "'"]
            ]);
        } else {
            $query = $Dealers->find('list', [
                'keyField' => 'id',
                'valueField' => 'name'

            ]);
        }
        $Dealers = $query->toArray();

        if ($this->request->is(['ajax'])) {
            echo json_encode($Dealers);
            die;
        } else {
            return $Dealers;
        }
    }

    public function getPanchayatsByBlock($id = null)
    {
        $request_data = $this->request->getData();
        if ($this->request->is(['ajax'])) {
            $this->autoRender = false;
            $this->viewBuilder()->setLayout('ajax');
            $id = $request_data['id'];
        }

        $panchayatData = TableRegistry::getTableLocator()->get('panchayats');
        if (!empty($id)) {
            $query = $panchayatData->find('list', [
                'keyField' => 'id',
                'valueField' => 'name',
                'conditions' => ['panchayats.rgi_block_code=' . "'" . $id . "'"]
            ]);
        } else {
            $query = $panchayatData->find('list', [
                'keyField' => 'id',
                'valueField' => 'name'
            ]);
        }

        $panchayats = $query->toArray();

        if ($this->request->is(['ajax'])) {
            echo json_encode($panchayats);
            die;
        } else {
            return $panchayats;
        }
    }

    public function getVillagesByPanchayat($id = null)
    {

        $request_data = $this->request->getData();
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $this->viewBuilder()->layout('ajax');
            $id = $request_data['id']; //echo $id;die;
        }
        $villageData = TableRegistry::get('SeccVillageWards');
        if (!empty($id)) {
            $query = $villageData->find('list', [
                'keyField' => 'rgi_village_code',
                'valueField' => 'name',
                'conditions' => ['SeccVillageWards.rgi_block_code=' . "'" . $id . "'"],
                'order' => 'name'

            ]);
        } else {
            $query = $villageData->find('list', [
                'keyField' => 'rgi_village_code',
                'valueField' => 'name',
                'order' => 'name'

            ]);
        }
        $villages = $query->toArray();
        if ($this->request->is('ajax')) {
            echo json_encode($villages);
            die;
        } else {
            return $villages;
        }
    }

    public function checkExistMobile()
    {
        $connection = ConnectionManager::get('default');
        $mobil = $connection->prepare("select mobile from jsfss_secc_families where mobile is not null");
        $mobil->execute();
        $mob = $mobil->fetchAll('assoc');
        //echo "<pre>"; print_r($mob); "<pre>"; die;
        $phone = [];
        if (!empty($mob)) {
            foreach ($mob as $mkey => $mVal) {
                $phone[] = $mVal['mobile'];
            }
        }
        return $phone;
    }

    public function checkExistBankAcc($bank_master_id=null, $accNo=null)
    {
        $connection = ConnectionManager::get('default');
        $bankQry = $connection->prepare("select bank_account_no from jsfss_secc_cardholders where bank_master_id='$bank_master_id' and bank_account_no='$accNo'");
        $bankQry->execute();
        $bank = $bankQry->fetchAll('assoc');
        //echo "<pre>"; print_r($mob); "<pre>"; die;
        $bankArr = [];
        if (!empty($bank)) {
            foreach ($bank as $bkey => $bVal) {
                $bankArr[] = $bVal['bank_account_no'];
            }
        }
        return $bankArr;
    }
}
