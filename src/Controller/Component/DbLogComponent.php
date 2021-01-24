<?php
declare(strict_types=1);

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Log\Log;

class DbLogComponent extends Component
{
    protected $_defaultConfig = [];

    public function saveClear(array $params)
    {
        Log::info(print_r($params, true), ["scope" => ["db"]]);
        return;
    }

    public function saveError($controller, $action, $user)
    {
        $params = [
            "controller" => $controller,
            "action" => $action,
            "user" => $user->management_users_id,
            "datetime" => date("Y-m-d H:i:s"),
        ];
        Log::error(print_r($params, true), ["scope" => ["dbError"]]);
        return;
    }

    public function bulletinBoardError($controller, $action, $user)
    {
        $params = [
            "controller" => $controller,
            "action" => $action,
            "datetime" => date("Y-m-d H:i:s"),
        ];
        Log::error(print_r($params, true), ["scope" => ["dbError"]]);
        return;
    }
}
