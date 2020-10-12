<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use RuntimeException;
use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use App\Controller\Component\FileuploadComponent;
use Cake\ORM\TableRegistry;

/**
 * CrewSends Controller
 *
 * @property \App\Model\Table\CrewSendsTable $CrewSends
 *
 * @method \App\Model\Entity\CrewSend[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CrewSendsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    
    public function index()
    {
      $this->paginate = [
          "contain" => [
              "Categories", 
              "Statuses", 
              "Users",
              "Files", 
              "IncidentManagements.ManagementPrefixes",
              "CrewSendComments.Users", 
              "CrewSendComments.CommentFiles"
          ],
          "limit" => 5,
          "order" => ["crew_sends_id" => "desc"]
      ];
      $this->loadModels(["CrewSendComments"]);
      $crewSendComment = $this->CrewSendComments->newEntity();
      $crewSends = $this->paginate($this->CrewSends);
      $users = $this->CrewSends->Users->find('list', ['limit' => 200])
          ->where(["delete_flag" => 0]);
      $this->set(compact('crewSends', "users", "crewSendComment"));
    }

    /**
     * View method
     *
     * @param string|null $id Crew Send id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
      $crewSend = $this->CrewSends->get($id, [
        'contain' => ['Categories', 'Statuses', 'Users']
      ]);

      $this->set('crewSend', $crewSend);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
      $crewSend = $this->CrewSends->newEntity();
      if ($this->request->is('post', "patch", "put")) {
        $this->Fileupload = $this->loadComponent("Fileupload");
        $this->IncidentManagement = $this->loadComponent("IncidentAdd");
        $data = $this->request->getData();

        //crewSend save前にincident_managements更新
        if(is_int($incidentNumber = $this->IncidentManagement->incident_number(4)))
        {
            //インシデント番号生成成功したら
            $data = array_merge($data, ["incident_managements_id" => $incidentNumber]);
            $crewSend = $this->CrewSends->patchEntity($crewSend, $data);


            if ($this->CrewSends->save($crewSend)) {
                $this->Flash->success(__('The crew send has been saved.'));
                $id = $crewSend->crew_sends_id;
                //ファイル有無
                //crew_sends_idが必要なので、saveしてから
                if(!empty($data["file"][0]["tmp_name"])){
                $this->loadModels(["Files"]);

                    //ファイルアップロード
                    //default_upload >> entityが返される
                    $entity = $this->Fileupload->default_upload($data["file"], $id, "crew_sends");
                    try{
                        $file = $this->Files->newEntities($entity);
                        if($this->Files->saveMany($file)) {
                            $this->Flash->success(__('ファイルのアップロードに成功しました。'));
                        }else{
                            $this->Flash->error(__('ファイルのアップロードに失敗しました。'));
                        }
                    }catch(RuntimeException $e){
                        $this->Flash->error(__("ファイルのアップロードができませんでした"));
                        $this->Flash->error(__($e->getMessage()));
                    }
              }
              return $this->redirect(['action' => 'index']);
            }

        }
        $this->Flash->error(__('The crew send could not be saved. Please, try again.'));
      }
      $categories = $this->CrewSends->Categories->find('list', ['limit' => 200]);
      $statuses = $this->CrewSends->Statuses->find('list', ['limit' => 200]);
      $users = $this->CrewSends->Users->find('list', ['limit' => 200])
          ->where(["delete_flag" => 0]);
      $this->set(compact('crewSend', 'categories', 'statuses', 'users', "file_upload"));
    }
    
    /**
     * Edit method
     *
     * @param string|null $id Crew Send id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $crewSend = $this->CrewSends->get($id, [
            'contain' => ["Users"]
        ]);
        //認証
        $this->Authority = $this->loadComponent("Authority");
        if($this->Authority->authorityCheck($crewSend)){
            if ($this->request->is(['patch', 'post', 'put'])) {
                $data = $this->request->getData();
                $crewSend = $this->CrewSends->patchEntity($crewSend, $data);
                if ($this->CrewSends->save($crewSend)) {
                    $this->Flash->success(__('The crew send has been saved.'));
                    if(!empty($data["file"][0]["tmp_name"])){
                        //ファイルアップロード
                        $crewSendsId = $crewSend->crew_sends_id;
                        $this->Fileupload = $this->loadComponent("Fileupload");
                        $entity = $this->Fileupload->default_upload($data["file"], $crewSendsId, "crew_sends");
                        $this->loadModels(["Files"]);
                        try{
                            $file = $this->Files->newEntities($entity);
                            if($this->Files->saveMany($file)) {
                                $this->Flash->success(__('The file has been saved.'));
                            }else{
                                $this->Flash->error(__('ファイルのアップロードに失敗しました。'));
                            }
                        }catch(RuntimeException $e){
                          $this->Flash->error(__("ファイルのアップロードができませんでした"));
                          $this->Flash->error(__($e->getMessage()));
                        }
                    }
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The crew send could not be saved. Please, try again.'));
            }
        }else{
            $this->Flash->error(__('権限がありません'));
            return $this->redirect($this->referer());
        }
        $categories = $this->CrewSends->Categories->find('list', ['limit' => 200]);
        $statuses = $this->CrewSends->Statuses->find('list', ['limit' => 200]);
        $users = $this->CrewSends->Users->find('list', ['limit' => 200])
            ->where(["delete_flag" => 0]);
        $this->set(compact('crewSend', 'categories', 'statuses', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Crew Send id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $crewSend = $this->CrewSends->get($id,[
          "contain" => ["CrewSendComments", "Files", "Users"]
        ]);

        //認証
        $this->Authority = $this->loadComponent("Authority");
        if($this->Authority->authorityCheck($crewSend)){

            $this->FileDelete = $this->loadComponent("FileDelete");
            //コメントのアップロードファイルを削除するために,
            //関連するコメントがあれば、そのcrew_send_comments_idを求める
            if(!empty($crewSend->crew_send_comments)){
                $crewSendComments = $crewSend->crew_send_comments;
                $crewSendCommentsId = array();
                foreach($crewSendComments as $crewSendComment){
                    array_push($crewSendCommentsId, $crewSendComment->crew_send_comments_id);
                }

                //コメントにファイルが添付されているかどうか
                //コメントに添付されているファイルのunique_file_nameを求める
                $this->loadModels(["CommentFiles"]);
                $uniqueFileNames = array();
                foreach($crewSendCommentsId as $id){
                    $commentFiles = $this->CommentFiles->find("all")
                        ->select(["unique_file_name"])
                        ->where(["crew_send_comments_id" => $id]);

                    //$commentFilesがからの場合の条件分岐方法がわからないので、ファイルなくても処置するようにする
                    foreach($commentFiles as $commentFile){
                        array_push($uniqueFileNames, $commentFile->unique_file_name);
                    }
                }
                //ディレクトリ内のファイルを削除
                $this->FileDelete->deleteFiles($uniqueFileNames);
            }
            //ファイルがアップロードされていれば、ディレクトリから削除する
            if(!empty($crewSend->files)){
                //削除するcrewSendsのIDを保持するfilesのunique_file_nameを求める
                $id = $crewSend->crew_sends_id;
                $files = $crewSend->files;
                $uniqueFileNames = array();
                foreach($files as $file){
                  array_push($uniqueFileNames, $file->unique_file_name);
                }
                $this->FileDelete->deleteFiles($uniqueFileNames);
            }
            if($this->CrewSends->delete($crewSend)){
                $this->Flash->success(__('The crew send has been deleted.'));
            }else{
                $this->Flash->error(__('The crew send could not be deleted. Please, try again.'));
            }
            return $this->redirect(["controller" => "crew_sends", 'action' => 'index']);
        }else{
            $this->Flash->error(__('権限がありません'));
            return $this->redirect($this->referer());
        }
    }
}
