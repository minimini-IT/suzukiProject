<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * MessageStatuses Controller
 *
 * @property \App\Model\Table\MessageStatusesTable $MessageStatuses
 *
 * @method \App\Model\Entity\MessageStatus[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MessageStatusesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $messageStatuses = $this->paginate($this->MessageStatuses);

        $this->set(compact('messageStatuses'));
    }

    /**
     * View method
     *
     * @param string|null $id Message Status id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $messageStatus = $this->MessageStatuses->get($id, [
            'contain' => []
        ]);

        $this->set('messageStatus', $messageStatus);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $messageStatus = $this->MessageStatuses->newEntity();
        if ($this->request->is('post')) {
            $messageStatus = $this->MessageStatuses->patchEntity($messageStatus, $this->request->getData());
            if ($this->MessageStatuses->save($messageStatus)) {
                $this->Flash->success(__('The message status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The message status could not be saved. Please, try again.'));
        }
        $this->set(compact('messageStatus'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Message Status id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $messageStatus = $this->MessageStatuses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $messageStatus = $this->MessageStatuses->patchEntity($messageStatus, $this->request->getData());
            if ($this->MessageStatuses->save($messageStatus)) {
                $this->Flash->success(__('The message status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The message status could not be saved. Please, try again.'));
        }
        $this->set(compact('messageStatus'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Message Status id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $messageStatus = $this->MessageStatuses->get($id);
        if ($this->MessageStatuses->delete($messageStatus)) {
            $this->Flash->success(__('The message status has been deleted.'));
        } else {
            $this->Flash->error(__('The message status could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
