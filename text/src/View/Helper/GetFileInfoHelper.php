<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;
use Cake\datasource\ConnectionManager;

/**
 * GetFileInfo helper
 */
class GetFileInfoHelper extends Helper
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function file_info($entity){
      $sql = "select files_id, file_name, file_size from files where file_group = {$entity->file_group}";
      $connection = ConnectionManager::get("default");
      $files_info = $connection->execute($sql)->fetchAll("assoc");
      return $files_info;
    }

}
