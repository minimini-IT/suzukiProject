<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * FileDelete component
 */
class FileDeleteComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function deleteFiles($uniqueFileNames = null){
      $dir = realpath(WWW_ROOT . "/upload_file");
      foreach($uniqueFileNames as $uniqueFileName){
        $file_path = $dir . "/" . $uniqueFileName;
        $this->log("file delete component deleteFiles", LOG_DEBUG);
        if(unlink($file_path)){
          //ログ
          $this->log("{$uniqueFileName}を削除しました。", LOG_DEBUG);
        }else{
          $this->log("{$uniqueFileName}の削除に失敗しました。", LOG_DEBUG);
        }
      }
      return true;
    }
}
