<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Auth\DefaultPasswordHasher;

/**
 * ManagementUsers Controller
 *
 * @property \App\Model\Table\ManagementUsersTable $ManagementUsers
 * @method \App\Model\Entity\ManagementUser[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ManagementUsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $managementUsers = $this->paginate($this->ManagementUsers);

        $this->set(compact('managementUsers'));
    }

    /**
     * View method
     *
     * @param string|null $id Management User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $managementUser = $this->ManagementUsers->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('managementUser'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $managementUser = $this->ManagementUsers->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data["password"] = $this->_setPassword($data["password"]);
            $managementUser = $this->ManagementUsers->patchEntity($managementUser, $data);

            /*
            $data_p = print_r($this->request->getData(), true);
            $this->log($data_p, LOG_DEBUG);
            $password = $this->request->getData()["password"];
            $this->log($password, LOG_DEBUG);

            $data["password"] = $this->_setPassword($data["password"]);
            $data_p = print_r($data, true);
            $this->log($data_p, LOG_DEBUG);
            "password" => $this->_setPassword("123456"),
            return $this->redirect(['action' => 'add']);
            */


            if ($this->ManagementUsers->save($managementUser)) {
                $this->Flash->success(__('The management user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The management user could not be saved. Please, try again.'));
        }
        $this->set(compact('managementUser'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Management User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $managementUser = $this->ManagementUsers->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $data["password"] = $this->_setPassword($data["password"]);
            $managementUser = $this->ManagementUsers->patchEntity($managementUser, $data);
            if ($this->ManagementUsers->save($managementUser)) {
                $this->Flash->success(__('The management user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The management user could not be saved. Please, try again.'));
        }
        $this->set(compact('managementUser'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Management User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $managementUser = $this->ManagementUsers->get($id);
        if ($this->ManagementUsers->delete($managementUser)) {
            $this->Flash->success(__('The management user has been deleted.'));
        } else {
            $this->Flash->error(__('The management user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    //パスワードハッシュ
    protected function _setPassword(string $value)
    {
        /*
      $hasher = new DefaultPasswordHasher();
      return $hasher->hash($value);
         */
        return (new DefaultPasswordHasher)->hash($value);
    }
}
