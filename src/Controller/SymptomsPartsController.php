<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * SymptomsParts Controller
 *
 * @property \App\Model\Table\SymptomsPartsTable $SymptomsParts
 * @method \App\Model\Entity\SymptomsPart[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SymptomsPartsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $symptomsParts = $this->paginate($this->SymptomsParts);

        $this->set(compact('symptomsParts'));
    }

    /**
     * View method
     *
     * @param string|null $id Symptoms Part id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $symptomsPart = $this->SymptomsParts->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('symptomsPart'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $symptomsPart = $this->SymptomsParts->newEmptyEntity();
        if ($this->request->is('post')) {
            $symptomsPart = $this->SymptomsParts->patchEntity($symptomsPart, $this->request->getData());
            if ($this->SymptomsParts->save($symptomsPart)) {
                $this->Flash->success(__('The symptoms part has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The symptoms part could not be saved. Please, try again.'));
        }
        $this->set(compact('symptomsPart'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Symptoms Part id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $symptomsPart = $this->SymptomsParts->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $symptomsPart = $this->SymptomsParts->patchEntity($symptomsPart, $this->request->getData());
            if ($this->SymptomsParts->save($symptomsPart)) {
                $this->Flash->success(__('The symptoms part has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The symptoms part could not be saved. Please, try again.'));
        }
        $this->set(compact('symptomsPart'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Symptoms Part id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $symptomsPart = $this->SymptomsParts->get($id);
        if ($this->SymptomsParts->delete($symptomsPart)) {
            $this->Flash->success(__('The symptoms part has been deleted.'));
        } else {
            $this->Flash->error(__('The symptoms part could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
