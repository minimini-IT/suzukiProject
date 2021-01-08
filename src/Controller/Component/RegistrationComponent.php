<?php
declare(strict_types=1);

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

class RegistrationComponent extends Component
{
    /*
     * 他コンポーネント使用
     */
    public $components = ["Flash"];

    /*
    public function initialize(array $config)
    {
        $this->loadComponent('Flash');
    }
     */

    protected $_defaultConfig = [];

    public function saveClear(array $options)
    {
        $controller = $options["controller"];
        $action = $options["action"];
        //$redirect = $options["redirect"];

        $this->log("--- {$action} {$controller} clear---", LOG_DEBUG);
        //if($redirect)
        //{
        //    return $this->redirect($this->request->referer());
        //}
    }

    public function saveError(array $options)
    {
        $controller = $options["controller"];
        $action = $options["action"];

        $this->log("--- {$action} {$controller} error---", LOG_DEBUG);
        $this->Flash->error(__('エラーが発生したので削除できませんでした。'));
        $this->Flash->error(__('管理者へ報告してください。'));
        //return $this->redirect(["controller" => "top", 'action' => 'index']);
    }
}
