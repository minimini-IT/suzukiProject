<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * MessageAnswers Controller
 *
 * @property \App\Model\Table\MessageAnswersTable $MessageAnswers
 *
 * @method \App\Model\Entity\MessageAnswer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MessageAnswersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['MessageChoices']
        ];
        $messageAnswers = $this->paginate($this->MessageAnswers);

        $this->set(compact('messageAnswers'));
    }

    /**
     * View method
     *
     * @param string|null $id Message Answer id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $messageAnswer = $this->MessageAnswers->get($id, [
            'contain' => ['MessageChoices', 'MessageDestinations']
        ]);

        $this->set('messageAnswer', $messageAnswer);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if ($this->request->is(['post', "put"])) {
            $messageAnswer = $this->MessageAnswers->newEntity();
            $this->log("---getData---", LOG_DEBUG);
            $this->log($this->request->getData(), LOG_DEBUG);
            $messageAnswer = $this->MessageAnswers->patchEntity($messageAnswer, $this->request->getData());
            $this->log("---messageAnswer---", LOG_DEBUG);
            $this->log($messageAnswer, LOG_DEBUG);
            if ($this->MessageAnswers->save($messageAnswer)) {
                $this->Flash->success(__('The message answer has been saved.'));

                return $this->redirect(["controller" => "message_bords", 'action' => 'index']);
            }
            $this->Flash->error(__('The message answer could not be saved. Please, try again.'));
            return $this->redirect(["controller" => "message_bords", 'action' => 'index']);
        }
        $messageChoices = $this->MessageAnswers->MessageChoices->find('list', ['limit' => 200]);
        $this->set(compact('messageAnswer', 'messageChoices'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Message Answer id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $messageAnswer = $this->MessageAnswers->get($id, [
          'contain' => [
            "MessageDestinations.MessageBords.MessageDestinations.Users",
            "MessageDestinations.MessageBords.MessageDestinations.MessageAnswers",
            "MessageDestinations.MessageBords.MessageChoices"
          ]
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $messageAnswer = $this->MessageAnswers->patchEntity($messageAnswer, $this->request->getData());
            if ($this->MessageAnswers->save($messageAnswer)) {
                $this->Flash->success(__('The message answer has been saved.'));

                return $this->redirect(["controller" => "message_bords", 'action' => 'index']);
            }
            $this->Flash->error(__('The message answer could not be saved. Please, try again.'));
        }
        $messageChoices = $this->MessageAnswers->MessageChoices->find('list', ['limit' => 200]);
        $this->set(compact('messageAnswer', 'messageChoices'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Message Answer id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $messageAnswer = $this->MessageAnswers->get($id);
        if ($this->MessageAnswers->delete($messageAnswer)) {
            $this->Flash->success(__('The message answer has been deleted.'));
        } else {
            $this->Flash->error(__('The message answer could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
