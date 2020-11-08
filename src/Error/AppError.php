<?php
namespace App\Error;

use Cake\Error\BaseErrorHandler;

/*
 * エラーハンドルを置き換えてエラー、例外処理プロセス全体をカスタマイズ可能にする
 */

class AppError extends BaseErrorHandler
{
    /*
     * エラー時
     */
    public function _displayError($error, $debug)
    {
        echo "エラーあり";
    }

    /*
     * キャッチされなかった例外がある場合
     */
    public function _displayException($exception)
    {
        echo "例外あり";
    }

    public function handleFatalError($code, $description, $file, $line)
    {
        echo "致命的なエラーあり";
    }
}
