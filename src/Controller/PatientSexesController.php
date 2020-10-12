<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * PatientSexes Controller
 *
 * @property \App\Model\Table\PatientSexesTable $PatientSexes
 * @method \App\Model\Entity\PatientSex[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PatientSexesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $patientSexes = $this->paginate($this->PatientSexes);

        $this->set(compact('patientSexes'));
    }

    /**
     * View method
     *
     * @param string|null $id Patient Sex id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $patientSex = $this->PatientSexes->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('patientSex'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $patientSex = $this->PatientSexes->newEmptyEntity();
        if ($this->request->is('post')) {
            $patientSex = $this->PatientSexes->patchEntity($patientSex, $this->request->getData());
            if ($this->PatientSexes->save($patientSex)) {
                $this->Flash->success(__('The patient sex has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The patient sex could not be saved. Please, try again.'));
        }
        $this->set(compact('patientSex'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Patient Sex id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $patientSex = $this->PatientSexes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $patientSex = $this->PatientSexes->patchEntity($patientSex, $this->request->getData());
            if ($this->PatientSexes->save($patientSex)) {
                $this->Flash->success(__('The patient sex has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The patient sex could not be saved. Please, try again.'));
        }
        $this->set(compact('patientSex'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Patient Sex id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $patientSex = $this->PatientSexes->get($id);
        if ($this->PatientSexes->delete($patientSex)) {
            $this->Flash->success(__('The patient sex has been deleted.'));
        } else {
            $this->Flash->error(__('The patient sex could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
