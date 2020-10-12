<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * OrderNews Controller
 *
 * @property \App\Model\Table\OrderNewsTable $OrderNews
 *
 * @method \App\Model\Entity\OrderNews[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OrderNewsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $orderNews = $this->paginate($this->OrderNews);

        $this->set(compact('orderNews'));
    }

    /**
     * View method
     *
     * @param string|null $id Order News id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $orderNews = $this->OrderNews->get($id, [
            'contain' => []
        ]);

        $this->set('orderNews', $orderNews);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $orderNews = $this->OrderNews->newEntity();
        if ($this->request->is('post')) {
            $orderNews = $this->OrderNews->patchEntity($orderNews, $this->request->getData());
            if ($this->OrderNews->save($orderNews)) {
                $this->Flash->success(__('The order news has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order news could not be saved. Please, try again.'));
        }
        $this->set(compact('orderNews'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Order News id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $orderNews = $this->OrderNews->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $orderNews = $this->OrderNews->patchEntity($orderNews, $this->request->getData());
            if ($this->OrderNews->save($orderNews)) {
                $this->Flash->success(__('The order news has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order news could not be saved. Please, try again.'));
        }
        $this->set(compact('orderNews'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Order News id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $orderNews = $this->OrderNews->get($id);
        if ($this->OrderNews->delete($orderNews)) {
            $this->Flash->success(__('The order news has been deleted.'));
        } else {
            $this->Flash->error(__('The order news could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
