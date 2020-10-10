<?php
namespace App\Model\Validation;

use Cake\Validation\Validation;

class CustomValidation extends Validation{
  /**
   * ファイル容量は200Mまで
   * @param $files
   * @return bool
   */
  public static function limitFileSize($files){
    return($files["size"] < 200);
  }
}
