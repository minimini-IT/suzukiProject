<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class DownloadController extends AppController{

  public function downloadFile($id = null, $table = null, $primary){

      //idからファイル名を取得
      $query = TableRegistry::get($table);
      $query = $query->find()
        ->select(["file_name", "unique_file_name"])
        ->where(["{$primary}_id" => $id])
        ->first();
      $file_name = $query->file_name;
      $unique_file_name = $query->unique_file_name;

      //ダウンロード
      $this->autoRender = false;
      $this->response->file("upload_file/" . $unique_file_name);
      $this->response->download($file_name);
  }

  public function bordFileDownload($id = null){
    if ($this->request->is(["get"])) {
      $this->downloadFile($id, "MessageFiles", "message_files");
    }
  }

  public function sendFileDownload($id = null){
    if ($this->request->is(["get"])) {
      $this->downloadFile($id, "Files", "files");
    }
  }

  public function commentFileDownload($id = null){
    if ($this->request->is(["get"])) {
      $this->downloadFile($id, "CommentFiles", "comment_files");
    }
  }
}
