<?php
namespace App\Controller;

use App\Controller\AppController;

//deleteのみ使用

/**
 * CommentFiles Controller
 *
 * @property \App\Model\Table\CommentFilesTable $CommentFiles
 *
 * @method \App\Model\Entity\CommentFile[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CommentFilesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['CrewSendComments']
        ];
        $commentFiles = $this->paginate($this->CommentFiles);

        $this->set(compact('commentFiles'));
    }

    /**
     * View method
     *
     * @param string|null $id Comment File id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $commentFile = $this->CommentFiles->get($id, [
            'contain' => ['CrewSendComments']
        ]);

        $this->set('commentFile', $commentFile);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $commentFile = $this->CommentFiles->newEntity();
        if ($this->request->is('post')) {
            $commentFile = $this->CommentFiles->patchEntity($commentFile, $this->request->getData());
            if ($this->CommentFiles->save($commentFile)) {
                $this->Flash->success(__('The comment file has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The comment file could not be saved. Please, try again.'));
        }
        $crewSendComments = $this->CommentFiles->CrewSendComments->find('list', ['limit' => 200]);
        $this->set(compact('commentFile', 'crewSendComments'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Comment File id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $commentFile = $this->CommentFiles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $commentFile = $this->CommentFiles->patchEntity($commentFile, $this->request->getData());
            if ($this->CommentFiles->save($commentFile)) {
                $this->Flash->success(__('The comment file has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The comment file could not be saved. Please, try again.'));
        }
        $crewSendComments = $this->CommentFiles->CrewSendComments->find('list', ['limit' => 200]);
        $this->set(compact('commentFile', 'crewSendComments'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Comment File id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->log("---start comment files delete---", LOG_DEBUG);
        $this->request->allowMethod(['post', 'delete']);
        $commentFile = $this->CommentFiles->get($id);
        //ディレクトリ内のファイルを削除
        $this->FileDelete = $this->loadComponent("FileDelete");

        $this->log("---unique file name---", LOG_DEBUG);
        $this->log($commentFile->unique_file_name, LOG_DEBUG);

        if($this->FileDelete->deleteFiles($commentFile->unique_file_name)){
          if ($this->CommentFiles->delete($commentFile)) {
              $this->Flash->success(__('The comment file has been deleted.'));
          } else {
              $this->Flash->error(__('添付ファイル自体は削除できたが、DBのデータでは削除できなかった。管理者に報告してください'));
              $this->log("---comment_files delete error---", LOG_DEBUG);
              $this->log($commentFile, LOG_DEBUG);
          }
        }else{
          $this->Flash->error(__('添付ファイルの削除失敗。以降の動作は行いません'));
        }
        $this->log("---comment fileの削除動作完了---", LOG_DEBUG);
        return $this->redirect(["controller" => "crew_sends", 'action' => 'index']);
    }
}
