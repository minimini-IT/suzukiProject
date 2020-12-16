<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Auth\DefaultPasswordHasher;

/*
 * 404表示用
 */
use Cake\Http\Exception\NotFoundException;

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

        $this->paginate = [
            "limit" => 10,
        ];

        $managementUsers = $this->ManagementUsers->find("ManagementUsersList");

        $managementUsers = $this->paginate($managementUsers);

        $this->set(compact('managementUsers'));
    }

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
            $managementUser = $this->ManagementUsers->patchEntity($managementUser, $data);

            if ($this->ManagementUsers->save($managementUser)) {
                $this->log("---add ManagementUsers save clear---", LOG_DEBUG);
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The management user could not be saved. Please, try again.'));
                $this->log("---add ManagementUsers error---", LOG_DEBUG);
                $this->Flash->error(__('エラーが発生したので登録できませんでした。'));
                $this->Flash->error(__('管理者へ報告してください。'));
                return $this->redirect(["controller" => "top", 'action' => 'index']);
        }
        $this->set(compact('managementUser'));
    }

    public function edit($id = null)
    {
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

        /*
         * 該当ユーザがいなければエラーページ
         */
        $managementUser = $this->ManagementUsers
            ->find("ManagementUsersCheck", ["management_users_id" => $id])
            ->first();
        if(empty($managementUser))
        {
            throw new NotFoundException(__("該当ユーザがいません"));
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $managementUser = $this->ManagementUsers->patchEntity($managementUser, $data);
            if ($this->ManagementUsers->save($managementUser)) {
                $this->log("---edit ManagementUsers save clear---", LOG_DEBUG);
                return $this->redirect(['action' => 'index']);
            }
            $this->log("---edit ManagementUsers error---", LOG_DEBUG);
            $this->Flash->error(__('エラーが発生したので登録できませんでした。'));
            $this->Flash->error(__('管理者へ報告してください。'));
            return $this->redirect(["controller" => "top", 'action' => 'index']);
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
            $this->log("---delete ManagementUsers clear---", LOG_DEBUG);
            return $this->redirect(['action' => 'index']);
        } else {
            $this->log("---delete ManagementUsers error---", LOG_DEBUG);
            $this->Flash->error(__('エラーが発生したので登録できませんでした。'));
            $this->Flash->error(__('管理者へ報告してください。'));
            return $this->redirect(["controller" => "top", 'action' => 'index']);
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
