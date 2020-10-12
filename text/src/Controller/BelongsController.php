<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Belongs Controller
 *
 * @property \App\Model\Table\BelongsTable $Belongs
 *
 * @method \App\Model\Entity\Belong[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BelongsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $belongs = $this->paginate($this->Belongs);

        $this->set(compact('belongs'));
    }

    /**
     * View method
     *
     * @param string|null $id Belong id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $belong = $this->Belongs->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('belong', $belong);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $belong = $this->Belongs->newEntity();
        if ($this->request->is('post')) {
            $belong = $this->Belongs->patchEntity($belong, $this->request->getData());
            if ($this->Belongs->save($belong)) {
                $this->Flash->success(__('The belong has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The belong could not be saved. Please, try again.'));
        }
        $this->set(compact('belong'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Belong id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $belong = $this->Belongs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $belong = $this->Belongs->patchEntity($belong, $this->request->getData());
            if ($this->Belongs->save($belong)) {
                $this->Flash->success(__('The belong has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The belong could not be saved. Please, try again.'));
        }
        $this->set(compact('belong'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Belong id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $belong = $this->Belongs->get($id);
        if ($this->Belongs->delete($belong)) {
            $this->Flash->success(__('The belong has been deleted.'));
        } else {
            $this->Flash->error(__('The belong could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
