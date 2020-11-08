<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Controller\Controller;

class AppController extends Controller
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        /*
         * 認証用　追加
         */
        /*
         * AuthじゃなくてAuthenticationとAuthorizationをつかう
        $this->loadComponent("Auth", [
            "loginRedirect" => [
                "controller" => "DashboardManagement",
                "action" => "index"
            ],
            "logoutRedirect" => [
                "controller" => "Top",
                "action" => "index"
            ],
            "loginAction" => [
                "controller" => "ManagementUsers",
                "action" => "login"
            ],
            "authError" => "認証不可",
        ]);
         */

        $this->loadComponent("Authentication.Authentication");

        /*
         * 承認用　追加
         */
        $this->loadComponent("Authorization.Authorization");


        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');
    }

    //loadModules使用可能
    public function loadModels($models=[]){
        foreach($models as $model){
            $this->loadModel($model);
      }
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        /*
         * ここで指定したアクションは、
         * すべてのコントローラーで認証なしで参照できる
         */
        //$this->Authentication->addUnauthenticatedActions(["index", "view", "search"]);
    }
}
