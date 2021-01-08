<?php
declare(strict_types=1);

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

class SaveErrorComponent extends Component
{
    protected $_defaultConfig = [];

    public $components = ["Flash"];

    public function errorFlash()
    {
        $this->Flash->error(__('エラーが発生したので登録できませんでした。'));
        $this->Flash->error(__('管理者へ報告してください。'));
        return;
    }
}
