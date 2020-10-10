<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use App\Controller\Component\FileDeleteComponent;
use Cake\ORM\TableRegistry;

/**
 * CrewSendComments Controller
 *
 * @property \App\Model\Table\CrewSendCommentsTable $CrewSendComments
 *
 * @method \App\Model\Entity\CrewSendComment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CrewSendCommentsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['CrewSends', 'Users']
        ];
        $crewSendComments = $this->paginate($this->CrewSendComments);

        $this->set(compact('crewSendComments'));
    }

    /**
     * View method
     *
     * @param string|null $id Crew Send Comment id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $crewSendComment = $this->CrewSendComments->get($id, [
            'contain' => ['CrewSends', 'Users']
        ]);

        $this->set('crewSendComment', $crewSendComment);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if ($this->request->is(['post', "put"])) {
            $crewSendComment = $this->CrewSendComments->newEntity();
            $data = $this->request->getData();
            $crewSendComment = $this->CrewSendComments->patchEntity($crewSendComment, $data);
            if ($this->CrewSendComments->save($crewSendComment)) {
                $this->Flash->success(__('The crew send comment has been saved.'));

                //ファイルあればアップロード処理
                if(!empty($data["file"][0]["tmp_name"])){
                    $commentId = $crewSendComment->crew_send_comments_id;
                    $this->Fileupload = $this->loadComponent("Fileupload");
                    $this->loadModels(["CommentFiles"]);

                    //ファイルアップロード
                    $entity = $this->Fileupload->default_upload($data["file"], $commentId, "crew_send_comments");
                    $file = $this->CommentFiles->newEntities($entity);
                    if($this->CommentFiles->saveMany($file)) {
                        $this->Flash->success(__('The file has been saved.'));
                    }else{
                        $this->Flash->error(__('ファイルのアップロードに失敗しました。'));
                    }
                }
                return $this->redirect(["controller" => "CrewSends", 'action' => 'index']);
            }
            $this->Flash->error(__('The crew send comment could not be saved. Please, try again.'));
        }
        return $this->redirect(["controller" => "CrewSends", 'action' => 'index']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Crew Send Comment id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {

        $crewSendComment = $this->CrewSendComments->get($id, [
            'contain' => ["CrewSends", "Users"]
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->log("---start comment edit---", LOG_DEBUG);
            $data = $this->request->getData();
            $crewSendComment = $this->CrewSendComments->patchEntity($crewSendComment, $data);
            if ($this->CrewSendComments->save($crewSendComment)) {
                $this->Flash->success(__('The crew send comment has been saved.'));
                if(!empty($data["file"][0]["tmp_name"])){
                  $this->log("---ファイル有り---", LOG_DEBUG);
                  $comments_id = $crewSendComment->crew_send_comments_id;
                  $this->Fileupload = $this->loadComponent("Fileupload");
                  $entity = $this->Fileupload->default_upload($data["file"], $comments_id, "crew_send_comments");
                  $this->loadModels(["CommentFiles"]);
                  try{
                    $file = $this->CommentFiles->newEntities($entity);
                    if($this->CommentFiles->saveMany($file)) {
                      $this->log("---ファイルアップロード成功---", LOG_DEBUG);
                      $this->Flash->success(__('The file has been saved.'));
                    }else{
                      $this->Flash->error(__('ファイルのアップロードに失敗しました。'));
                    }
                  }catch(RuntimeException $e){
                    $this->Flash->error(__("ファイルのアップロードができませんでした"));
                    $this->Flash->error(__($e->getMessage()));
                  }
                }else{
                  $this->log("---ファイル無し---", LOG_DEBUG);
                }
                $this->log("---end comment edit---", LOG_DEBUG);
                return $this->redirect(["controller" => "CrewSends", 'action' => 'index']);
            }else{
              $this->Flash->error(__('The crew send comment could not be saved. Please, try again.'));
            }
        }
        $crewSends = $this->CrewSendComments->CrewSends->find('list', ['limit' => 200]);
        $users = $this->CrewSendComments->Users->find('list', ['limit' => 200]);
        $this->set(compact('crewSendComment', 'crewSends', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Crew Send Comment id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
      $this->log("---start comment delete---", LOG_DEBUG);
      $this->loadModels(["CommentFiles"]);
      $this->request->allowMethod(['post', 'delete']);
      $crewSendComment = $this->CrewSendComments->get($id,[
        "contain" => ["CommentFiles"]
      ]);
      //ディレクトリ内のファイルを削除
      $this->FileDelete = $this->loadComponent("FileDelete");
      //コメントに関連するファイルがあれば、そのunique_file_nameを求める
      if(!empty($crewSendComment->comment_files)){
        $this->log("---comment file 有り 削除開始---", LOG_DEBUG);
        $commentFiles = $crewSendComment->comment_files;
        $uniqueFileNames = array();
        foreach($commentFiles as $commentFile){
          array_push($uniqueFileNames, $commentFile->unique_file_name);
        }
        //if($this->FileDelete->deleteFile($commentFile->unique_file_name)){
        $this->log("---uniqueFileNames---", LOG_DEBUG);
        $this->log($uniqueFileNames, LOG_DEBUG);
        $this->FileDelete->deleteFiles($uniqueFileNames);
        /*
        if ($this->CommentFiles->delete($commentFile)) {
            $this->log("---ファイル削除完了---", LOG_DEBUG);
            $this->Flash->success(__('The comment file has been deleted.'));
        } else {
            $this->log("---ファイル削除失敗---", LOG_DEBUG);
            $this->Flash->error(__('The crew send comment could not be deleted. Please, try again.'));
        }
         */
      }else{
        $this->log("---comment file 無し---", LOG_DEBUG);
      }
      if ($this->CrewSendComments->delete($crewSendComment)) {
          $this->log("---削除完了---", LOG_DEBUG);
          $this->Flash->success(__('The crew send comment has been deleted.'));
      } else {
          $this->log("---削除失敗---", LOG_DEBUG);
          $this->Flash->error(__('The crew send comment could not be deleted. Please, try again.'));
      }
      $this->log("---end comment delete---", LOG_DEBUG);
      return $this->redirect(["controller" => "crew_sends", 'action' => 'index']);
    }
}
