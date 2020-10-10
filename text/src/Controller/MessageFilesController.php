<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * MessageFiles Controller
 *
 * @property \App\Model\Table\MessageFilesTable $MessageFiles
 *
 * @method \App\Model\Entity\MessageFile[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MessageFilesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['MessageBords']
        ];
        $messageFiles = $this->paginate($this->MessageFiles);

        $this->set(compact('messageFiles'));
    }

    /**
     * View method
     *
     * @param string|null $id Message File id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $messageFile = $this->MessageFiles->get($id, [
            'contain' => ['MessageBords']
        ]);

        $this->set('messageFile', $messageFile);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $messageFile = $this->MessageFiles->newEntity();
        if ($this->request->is('post')) {
            $messageFile = $this->MessageFiles->patchEntity($messageFile, $this->request->getData());
            if ($this->MessageFiles->save($messageFile)) {
                $this->Flash->success(__('The message file has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The message file could not be saved. Please, try again.'));
        }
        $messageBords = $this->MessageFiles->MessageBords->find('list', ['limit' => 200]);
        $this->set(compact('messageFile', 'messageBords'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Message File id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $messageFile = $this->MessageFiles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $messageFile = $this->MessageFiles->patchEntity($messageFile, $this->request->getData());
            if ($this->MessageFiles->save($messageFile)) {
                $this->Flash->success(__('The message file has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The message file could not be saved. Please, try again.'));
        }
        $messageBords = $this->MessageFiles->MessageBords->find('list', ['limit' => 200]);
        $this->set(compact('messageFile', 'messageBords'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Message File id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $messageFile = $this->MessageFiles->get($id);
        if ($this->MessageFiles->delete($messageFile)) {
            $uniqueFileNames[] = $messageFile->unique_file_name;
            //ディレクトリ内のファイルを削除
            $this->FileDelete = $this->loadComponent("FileDelete");
            $this->FileDelete->deleteFiles($uniqueFileNames);
            $this->Flash->success(__('The message file has been deleted.'));
        } else {
            $this->Flash->error(__('The message file could not be deleted. Please, try again.'));
        }

        return $this->redirect(["controller" => "message_bords", 'action' => 'index']);
    }
}
