<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * MessageBordChronologies Controller
 *
 * @property \App\Model\Table\MessageBordChronologiesTable $MessageBordChronologies
 *
 * @method \App\Model\Entity\MessageBordChronology[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MessageBordChronologiesController extends AppController
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
        $messageBordChronologies = $this->paginate($this->MessageBordChronologies);

        $this->set(compact('messageBordChronologies'));
    }

    /**
     * View method
     *
     * @param string|null $id Message Bord Chronology id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $messageBordChronology = $this->MessageBordChronologies->get($id, [
            'contain' => ['MessageBords', 'Users']
        ]);

        $this->set('messageBordChronology', $messageBordChronology);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $messageBordChronology = $this->MessageBordChronologies->newEntity();
        if ($this->request->is('post')) {
            $messageBordChronology = $this->MessageBordChronologies->patchEntity($messageBordChronology, $this->request->getData());
            if ($this->MessageBordChronologies->save($messageBordChronology)) {
                $this->Flash->success(__('The message bord chronology has been saved.'));

                return $this->redirect(["controller" => "message_bords", 'action' => 'index']);
            }
            $this->Flash->error(__('The message bord chronology could not be saved. Please, try again.'));
            return $this->redirect(["controller" => "message_bords", 'action' => 'index']);
        }
        return $this->redirect(["controller" => "message_bords", 'action' => 'index']);
        $messageBords = $this->MessageBordChronologies->MessageBords->find('list', ['limit' => 200]);
        $this->set(compact('messageBordChronology', 'messageBords', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Message Bord Chronology id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $messageBordChronology = $this->MessageBordChronologies->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $messageBordChronology = $this->MessageBordChronologies->patchEntity($messageBordChronology, $this->request->getData());
            if ($this->MessageBordChronologies->save($messageBordChronology)) {
                $this->Flash->success(__('The message bord chronology has been saved.'));

                return $this->redirect(["controller" => "MessageBords", 'action' => 'index']);
            }
            $this->Flash->error(__('The message bord chronology could not be saved. Please, try again.'));
            return $this->redirect(["controller" => "MessageBords", 'action' => 'index']);
        }
        $messageBords = $this->MessageBordChronologies->MessageBords->find('list', ['limit' => 200]);
        $users = $this->MessageBordChronologies->Users->find('list', ['limit' => 200]);
        $this->set(compact('messageBordChronology', 'messageBords', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Message Bord Chronology id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $messageBordChronology = $this->MessageBordChronologies->get($id);
        if ($this->MessageBordChronologies->delete($messageBordChronology)) {
            $this->Flash->success(__('The message bord chronology has been deleted.'));
        } else {
            $this->Flash->error(__('The message bord chronology could not be deleted. Please, try again.'));
        }

        return $this->redirect(["controller" => "MessageBords", 'action' => 'index']);
    }
}
