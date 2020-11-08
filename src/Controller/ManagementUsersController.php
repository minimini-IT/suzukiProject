<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Auth\DefaultPasswordHasher;

/*
 * 404表示用
 */
use Cake\Http\Exception\NotFoundException;
//use Cake\Network\Exception\NotFoundException;

class ManagementUsersController extends AppController
{
    public function index()
    {
        /*
         * 承認用
         */
        $managementUser = $this->ManagementUsers->newEmptyEntity();
        try{
            $this->Authorization->authorize($managementUser);
        }
        catch(\Exception $e)
        {
            return $this->redirect(['action' => 'login']);
        }

        $managementUsers = $this->ManagementUsers->find()
            ->where(["management_users_id !=" => 1]);
        $managementUsers = $this->paginate($managementUsers);

        $this->set(compact('managementUsers'));
    }

    /*
    public function view($id = null)
    {
        $managementUser = $this->ManagementUsers->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('managementUser'));
    }
     */

    public function add()
    {

        /*
         * 承認用
         */
        $managementUser = $this->ManagementUsers->newEmptyEntity();
        try{
            $this->Authorization->authorize($managementUser);
        }
        catch(\Exception $e)
        {
            return $this->redirect(['action' => 'login']);
        }

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            //$data["password"] = $this->_setPassword($data["password"]);
            $managementUser = $this->ManagementUsers->patchEntity($managementUser, $data);

            if ($this->ManagementUsers->save($managementUser)) {
                $this->Flash->success(__('The management user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The management user could not be saved. Please, try again.'));
        }
        $this->set(compact('managementUser'));
    }

    public function edit($id = null)
    {

        /*
         * 該当ユーザがいなければエラーページ
         */
        $managementUser = $this->ManagementUsers->find()
            ->where(["management_users_id" => $id])
            ->first();
        if(empty($managementUser))
        {
            throw new NotFoundException(__("該当ユーザがいません"));
        }

        /*
        try
        {
            $managementUser = $this->ManagementUsers->get($id, [
                'contain' => [],
            ]);
        }
        catch(\Exception $e)
        {
            return $this->redirect(['action' => 'index']);
        }
         */
        $managementUser = $this->ManagementUsers->get($id, [
            'contain' => [],
        ]);


        /*
         * 承認用
         */
        try{
            $this->Authorization->authorize($managementUser);
        }
        catch(\Exception $e)
        {
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            //$data["password"] = $this->_setPassword($data["password"]);
            $managementUser = $this->ManagementUsers->patchEntity($managementUser, $data);
            if ($this->ManagementUsers->save($managementUser)) {
                $this->Flash->success(__('The management user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The management user could not be saved. Please, try again.'));
        }
        $this->set(compact('managementUser'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        $managementUser = $this->ManagementUsers->get($id);

        /*
         * 承認用
         */
        $this->Authorization->authorize($managementUser);

        if ($this->ManagementUsers->delete($managementUser)) {
            $this->Flash->success(__('The management user has been deleted.'));
        } else {
            $this->Flash->error(__('The management user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function top()
    {
        /*
         * 承認用
         */
        $this->Authorization->skipAuthorization();
    }

    /*
     * パスワードハッシュ
     * Entityでやるので不要かも（2重にかけちゃうことになる）
     */
    /*
    protected function _setPassword(string $value) : ?string
    {
        if(strlen($value) > 0)
        {
            return (new DefaultPasswordHasher())->hash($value);
        }
    }
     */

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        /*
         * ログイン画面では認証は不要にする設定
         * ないと無限リダイレクトとなる
         */
        $this->Authentication->addUnauthenticatedActions(["login", "logout"]);
    }

    public function login()
    {
        /*
         * 承認スキップ
         */
        $this->Authorization->skipAuthorization();
        
        $this->request->allowMethod(["get", "post"]);
        $result = $this->Authentication->getResult();
        /*
         * POST,GETに関係なく、ログイン済みであればリダイレクト
         */
        if($result->isValid())
        {
            /*
             * ログイン成功後に管理画面にリダイレクト
             */
            $redirect = $this->request->getQuery("redirect", [
                "controller" => "ManagementUsers",
                "action" => "index",
            ]);

            return $this->redirect($redirect);
        }
        /*
         * ユーザの送信と認証に失敗した場合はエラー表示
         */
        if($this->request->is("post") && !$result->isValid())
        {
            $this->Flash->error(__("Invalid email or password"));
        }
    }

    public function logout()
    {
        $result = $this->Authentication->getResult();
        if($result->isValid())
        {
            $this->Authentication->logout();
            return $this->redirect(["controller" => "Top", "action" => "index"]);
        }
    }
}
