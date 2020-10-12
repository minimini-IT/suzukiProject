<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use RuntimeException;
use Cake\ORM\TableRegistry;
use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use App\Controller\Component\FileDeleteComponent;

/**
 * Files Controller
 *
 * @property \App\Model\Table\FilesTable $Files
 *
 * @method \App\Model\Entity\File[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FilesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['CrewSends']
        ];
        $files = $this->paginate($this->Files);

        $this->set(compact('files'));
    }

    /**
     * View method
     *
     * @param string|null $id File id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $file = $this->Files->get($id, [
            'contain' => ["CrewSends"]
        ]);

        $this->set('file', $file);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $file = $this->Files->newEntity();
        if ($this->request->is(["patch", 'post', "put"])) {

            //file_group取得
            $file_group = $this->next_file_group();

            //格納するディレクトリ 
            $dir = realpath(WWW_ROOT . "/upload_file");

            //容量200M
            $limitFileSize = 1024 * 1024 * 200;

            try {
              //file_uploadメソッドのアウトプット用
              $file_detail = array();
              //$fileエンティティに一括でデータを埋め込む用
              $file_entity = array();

              foreach($this->request->data["file"] as $upload_file){
                $file_detail = $this->file_upload($upload_file, $dir, $limitFileSize);
                $file_entity[] = [
                  "file_group" => $file_group, 
                  "file_name" => $file_detail[0], 
                  "file_size" => $file_detail[1], 
                  "unique_file_name" => $file_detail[2]
                ];
              }
              $file = $this->Files->newEntities($file_entity);
              $file = $this->Files->patchEntities($file, $file_entity);

            }catch(RuntimeException $e){
              $this->Flash->error(__("ファイルのアップロードができませんでした"));
              $this->Flash->error(__($e->getMessage()));
            }

            if ($this->Files->saveMany($file)) {
                $this->Flash->success(__('The file has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The file could not be saved. Please, try again.'));
        }

        $this->set(compact('file', "max_file_group"));
    }

    /**
     * Edit method
     *
     * @param string|null $id File id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $file = $this->Files->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $file = $this->Files->patchEntity($file, $this->request->getData());
            if ($this->Files->save($file)) {
                $this->Flash->success(__('The file has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The file could not be saved. Please, try again.'));
        }
        $this->set(compact('file'));
    }

    /**
     * Delete method
     *
     * @param string|null $id File id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
      $this->request->allowMethod(['post', 'delete']);
      $File = $this->Files->get($id);
      //ディレクトリ内のファイルを削除
      $this->FileDelete = $this->loadComponent("FileDelete");
      if($this->FileDelete->deleteFile($File->unique_file_name)){
        $this->Flash->success(__('添付ファイルの削除成功'));
        if ($this->Files->delete($File)) {
            $this->Flash->success(__('The comment file has been deleted.'));
        } else {
            $this->Flash->error(__('添付ファイル自体は削除できたが、DBのデータでは削除できなかった。管理者に報告してください'));
            $this->log("---files delete error---", LOG_DEBUG);
            $this->log($File, LOG_DEBUG);
        }
      }else{
        $this->Flash->error(__('添付ファイルの削除失敗。DBの削除は行いません'));
      }

      return $this->redirect(["controller" => "crew_sends", 'action' => 'index']);
      /*
        $session = $this->request->session();
        //redirectのdeleteからかどうか
        if($session->check("delete.file")){
            $this->log("---session check true---", LOG_DEBUG);
            $ids = $session->consume("delete.file");
            foreach($ids as $id){
                $file = $this->Files->get($id);
                if ($this->Files->delete($file)) {
                    //ファイル削除
                    $this->FileDelete = $this->loadComponent("FileDelete");
                    if($this->FileDelete->deleteFile($file["unique_file_name"])){
                        $this->log("---{$file['unique_file_name']} delete true---", LOG_DEBUG);
                    }else{
                        $this->log("---{$file['unique_file_name']} delete false---", LOG_DEBUG);
                    }
                    $this->Flash->success(__('The file has been deleted.'));
                } else {
                    $this->Flash->error(__('The file could not be deleted. Please, try again.'));
                }
            }
            $controller = $session->consume("delete.controller");
            $action = $session->consume("delete.action");
            return $this->redirect(["controller" => $controller, "action" => $action]);

        }else{
            $this->log("---session check false---", LOG_DEBUG);
            $this->request->allowMethod(['post', 'delete']);
            $file = $this->Files->get($id);
            if ($this->Files->delete($file)) {
                //ファイル削除
                $this->FileDelete = $this->loadComponent("FileDelete");
                if($this->FileDelete->deleteFile($file["unique_file_name"])){
                    $this->log("---{$file['unique_file_name']} delete true---", LOG_DEBUG);
                }else{
                    $this->log("---{$file['unique_file_name']} delete false---", LOG_DEBUG);
                }
                $this->Flash->success(__('The file has been deleted.'));
            } else {
                $this->Flash->error(__('The file could not be deleted. Please, try again.'));
            }
        }
        return $this->redirect(["controller" => "CrewSends", 'action' => 'index']);
      */
    }

//おそらくいらない↓
    public function redirectDelete($ids = null)
    {
        $session = $this->request->session();
        $ids = $session->read("delete_files.id");
        //get()->主キーで検索してる？
        foreach($ids as $id){
            $file = $this->Files->get($id);
            if ($this->Files->delete($file)) {
                $this->Flash->success(__('The file has been deleted.'));
                $this->log("---redirectDelete true---", LOG_DEBUG);
            } else {
                $this->Flash->error(__('The file could not be deleted. Please, try again.'));
                $this->log("---redirectDelete false---", LOG_DEBUG);
            }
        }
        $session->destroy();
        return $this->redirect(["controller" => "CrewSends", 'action' => 'index']);
    }

}
