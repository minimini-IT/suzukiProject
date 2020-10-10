<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PrivateMessages Controller
 *
 * @property \App\Model\Table\PrivateMessagesTable $PrivateMessages
 *
 * @method \App\Model\Entity\PrivateMessage[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PrivateMessagesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['MessageBords', 'Users']
        ];
        $privateMessages = $this->paginate($this->PrivateMessages);

        $this->set(compact('privateMessages'));
    }

    /**
     * View method
     *
     * @param string|null $id Private Message id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $privateMessage = $this->PrivateMessages->get($id, [
            'contain' => ['MessageBords', 'Users']
        ]);

        $this->set('privateMessage', $privateMessage);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $privateMessage = $this->PrivateMessages->newEntity();
        if ($this->request->is('post')) {
            $privateMessage = $this->PrivateMessages->patchEntity($privateMessage, $this->request->getData());
            if ($this->PrivateMessages->save($privateMessage)) {
                $this->Flash->success(__('The private message has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The private message could not be saved. Please, try again.'));
        }
        $messageBords = $this->PrivateMessages->MessageBords->find('list', ['limit' => 200]);
        $users = $this->PrivateMessages->Users->find('list', ['limit' => 200]);
        $this->set(compact('privateMessage', 'messageBords', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Private Message id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $privateMessage = $this->PrivateMessages->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $privateMessage = $this->PrivateMessages->patchEntity($privateMessage, $this->request->getData());
            if ($this->PrivateMessages->save($privateMessage)) {
                $this->Flash->success(__('The private message has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The private message could not be saved. Please, try again.'));
        }
        $messageBords = $this->PrivateMessages->MessageBords->find('list', ['limit' => 200]);
        $users = $this->PrivateMessages->Users->find('list', ['limit' => 200]);
        $this->set(compact('privateMessage', 'messageBords', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Private Message id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $privateMessage = $this->PrivateMessages->get($id);
        if ($this->PrivateMessages->delete($privateMessage)) {
            $this->Flash->success(__('The private message has been deleted.'));
        } else {
            $this->Flash->error(__('The private message could not be deleted. Please, try again.'));
        }

        return $this->redirect(["controller" => "MessageBords", 'action' => 'index']);
    }
}
