<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Sicknesses Controller
 *
 * @property \App\Model\Table\SicknessesTable $Sicknesses
 * @method \App\Model\Entity\Sickness[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SicknessesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $sicknesses = $this->paginate($this->Sicknesses);

        $this->set(compact('sicknesses'));
    }

    /**
     * View method
     *
     * @param string|null $id Sickness id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $sickness = $this->Sicknesses->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('sickness'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $sickness = $this->Sicknesses->newEmptyEntity();
        if ($this->request->is('post')) {
            $sickness = $this->Sicknesses->patchEntity($sickness, $this->request->getData());
            if ($this->Sicknesses->save($sickness)) {
                $this->Flash->success(__('The sickness has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sickness could not be saved. Please, try again.'));
        }
        $this->set(compact('sickness'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Sickness id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $sickness = $this->Sicknesses->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sickness = $this->Sicknesses->patchEntity($sickness, $this->request->getData());
            if ($this->Sicknesses->save($sickness)) {
                $this->Flash->success(__('The sickness has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The sickness could not be saved. Please, try again.'));
        }
        $this->set(compact('sickness'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sickness id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $sickness = $this->Sicknesses->get($id);
        if ($this->Sicknesses->delete($sickness)) {
            $this->Flash->success(__('The sickness has been deleted.'));
        } else {
            $this->Flash->error(__('The sickness could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
