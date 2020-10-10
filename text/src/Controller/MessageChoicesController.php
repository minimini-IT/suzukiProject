<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * MessageChoices Controller
 *
 * @property \App\Model\Table\MessageChoicesTable $MessageChoices
 *
 * @method \App\Model\Entity\MessageChoice[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MessageChoicesController extends AppController
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
        $messageChoices = $this->paginate($this->MessageChoices);

        $this->set(compact('messageChoices'));
    }

    /**
     * View method
     *
     * @param string|null $id Message Choice id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $messageChoice = $this->MessageChoices->get($id, [
            'contain' => ['MessageBords', 'MessageAnswers']
        ]);

        $this->set('messageChoice', $messageChoice);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $messageChoice = $this->MessageChoices->newEntity();
        if ($this->request->is('post')) {
            $messageChoice = $this->MessageChoices->patchEntity($messageChoice, $this->request->getData());
            if ($this->MessageChoices->save($messageChoice)) {
                $this->Flash->success(__('The message choice has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The message choice could not be saved. Please, try again.'));
        }
        $messageBords = $this->MessageChoices->MessageBords->find('list', ['limit' => 200]);
        $this->set(compact('messageChoice', 'messageBords'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Message Choice id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $messageChoice = $this->MessageChoices->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $messageChoice = $this->MessageChoices->patchEntity($messageChoice, $this->request->getData());
            if ($this->MessageChoices->save($messageChoice)) {
                $this->Flash->success(__('The message choice has been saved.'));

                return $this->redirect(["controller" => "message_bords", 'action' => 'index']);
            }
            $this->Flash->error(__('The message choice could not be saved. Please, try again.'));
        }
        $messageBords = $this->MessageChoices->MessageBords->find('list', ['limit' => 200]);
        $this->set(compact('messageChoice', 'messageBords'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Message Choice id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $messageChoice = $this->MessageChoices->get($id);
        if ($this->MessageChoices->delete($messageChoice)) {
            $this->Flash->success(__('The message choice has been deleted.'));
        } else {
            $this->Flash->error(__('The message choice could not be deleted. Please, try again.'));
        }

        return $this->redirect(["controller" => "message_bords", 'action' => 'index']);
    }
}
