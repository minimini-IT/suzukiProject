<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Belongs', 'Ranks', "Roles"],
            "order" => ["user_sort_number" => "asc"]
        ];
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Belongs', 'Ranks']
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $belongs = $this->Users->Belongs->find('list', ['limit' => 200]);
        $ranks = $this->Users->Ranks->find('list', ['limit' => 200]);
        $roles = $this->authority();

        $this->set(compact('user', 'belongs', 'ranks', "roles"));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        //認証
        $this->Authority = $this->loadComponent("Authority");
        if($this->Authority->userAuthorityCheck($user)){
            if ($this->request->is(['patch', 'post', 'put'])) {
                $user = $this->Users->patchEntity($user, $this->request->getData());
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('The user has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }else{
            $this->Flash->error(__('権限がありません'));
            return $this->redirect($this->referer());
        }
        $belongs = $this->Users->Belongs->find('list', ['limit' => 200]);
        $ranks = $this->Users->Ranks->find('list', ['limit' => 200]);
        $roles = $this->authority();
        $this->set(compact('user', 'belongs', 'ranks', "roles"));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        $this->log("---getしたuser---", LOG_DEBUG);
        $this->log($user, LOG_DEBUG);
/*
        $this->Authority = $this->loadComponent("Authority");
        if($this->Authority->userAuthorityCheck($user)){
 */
          /*
            //削除ではなくdelete_flagを立てる
            $user = $this->Users->get($id, [
                'contain' => []
            ]);
            $user = $this->Users->patchEntity($user, $this->request->getData());
           */


          /*
            if ($this->Users->delete($user)) {
                $this->Flash->success(__('The user has been deleted.'));
            } else {
                $this->Flash->error(__('The user could not be deleted. Please, try again.'));
            }
           */
/*
        }else{
            $this->Flash->error(__('権限がありません'));
            return $this->redirect($this->referer());
        }
 */
        return $this->redirect(['action' => 'index']);
    }

    public function login()
    {
        if($this->request->is("post")){
            $user = $this->Auth->identify();
            if($user){
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__("ユーザ名もしくはパスワードが間違っています。"));
        }
        if(!empty($this->request->session()->read("Auth.User"))){
            return $this->redirect(["controller" => "Dairy", "action" => "index"]);
        }
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    public function authority()
    {
        $authority = $this->request->session()->read("Auth.User.roles_id");
        $authority = $this->Users->Roles->find("all")
            ->select(["role_level"])
            ->where(["roles_id" => $authority]);
        $authority = $authority->first()["role_level"];
        $roles = $this->Users->Roles->find('list', [
            'limit' => 200,
            "order" => ["role_level" => "desc"]
        ])
            ->where(["role_level >=" => $authority]);
        return $roles;
    }
}
