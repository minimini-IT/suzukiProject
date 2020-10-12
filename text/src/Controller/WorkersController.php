<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Workers Controller
 *
 * @property \App\Model\Table\WorkersTable $Workers
 *
 * @method \App\Model\Entity\Worker[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class WorkersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Positions', 'Shifts', 'Duties']
        ];
        $workers = $this->paginate($this->Workers);

        $this->set(compact('workers'));
    }

    /**
     * View method
     *
     * @param string|null $id Worker id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $worker = $this->Workers->get($id, [
            'contain' => ['Users', 'Positions', 'Shifts', 'Duties']
        ]);

        $this->set('worker', $worker);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $worker = $this->Workers->newEntity();
        if ($this->request->is('post')) {
            $worker = $this->Workers->patchEntity($worker, $this->request->getData());
            if ($this->Workers->save($worker)) {
                $this->Flash->success(__('The worker has been saved.'));

                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('The worker could not be saved. Please, try again.'));
        }

        $this->paginate = [
            'contain' => [
                'Users', 
                'Positions', 
                'Shifts', 
                'Duties', 
            ]
        ];
        $users = $this->Workers->Users->find('list', ['limit' => 200]);
        $positions = $this->Workers->Positions->find('list', ['limit' => 200]);
        $shifts = $this->Workers->Shifts->find('list', ['limit' => 200]);
        $duties = $this->Workers->Duties->find('list', ['limit' => 200]);
        $today = date("Y-m-d");
        $todayWorkers = $this->Workers->find("all")
            ->where(["date" => $today]);
        $todayWorkers = $this->paginate($todayWorkers);
        $this->set(compact('worker', 'users', 'positions', 'shifts', 'duties', "todayWorkers"));
    }

    /**
     * Edit method
     *
     * @param string|null $id Worker id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $worker = $this->Workers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $worker = $this->Workers->patchEntity($worker, $this->request->getData());
            if ($this->Workers->save($worker)) {
                $this->Flash->success(__('The worker has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The worker could not be saved. Please, try again.'));
        }
        $users = $this->Workers->Users->find('list', ['limit' => 200]);
        //$classes = $this->Workers->Classes->find('list', ['limit' => 200]);
        $positions = $this->Workers->Positions->find('list', ['limit' => 200]);
        $shifts = $this->Workers->Shifts->find('list', ['limit' => 200]);
        $duties = $this->Workers->Duties->find('list', ['limit' => 200]);
        //$this->set(compact('worker', 'users', 'classes', 'positions', 'shifts', 'duties'));
        $this->set(compact('worker', 'users', 'positions', 'shifts', 'duties'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Worker id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $worker = $this->Workers->get($id);
        if ($this->Workers->delete($worker)) {
            $this->Flash->success(__('The worker has been deleted.'));
        } else {
            $this->Flash->error(__('The worker could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
