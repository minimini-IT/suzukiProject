<?php
namespace App\Error;

use Cake\Error\ExceptionRenderer;

class AppExceptionRenderer extends ExceptionRenderer
{
    public function missingWidget($error)
    {
        $response = $this->controller->response;
        return $response->withStringBody("なし");
    }

    public function notFound($error)
    {
        /*
         * NotFoundExceptionオブジェクトでの処理
         * $errorは例外
         * $Responseオブジェクトをreturnする
         */
    }

    //protected function _getController()
    //{
    //    /*
    //     * コントローラの指定
    //     * _getController()をオーバーライドして使用
    //     */
    //    return new SuperCustomErrorController();
    //}

    public function render()
    {
        $this->controller->viewBuilder()->setLayout("error_layout");
        return parent::render();
    }
}
