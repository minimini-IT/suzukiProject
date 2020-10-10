<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * IncidentChronologies Controller
 *
 * @property \App\Model\Table\IncidentChronologiesTable $IncidentChronologies
 *
 * @method \App\Model\Entity\IncidentChronology[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class IncidentChronologiesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['RiskDetections', 'Users']
        ];
        $incidentChronologies = $this->paginate($this->IncidentChronologies);

        $this->set(compact('incidentChronologies'));
    }

    /**
     * View method
     *
     * @param string|null $id Incident Chronology id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $incidentChronology = $this->IncidentChronologies->get($id, [
            'contain' => ['RiskDetections', 'Users']
        ]);

        $this->set('incidentChronology', $incidentChronology);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $incidentChronology = $this->IncidentChronologies->newEntity();
        if ($this->request->is('post')) {
            $incidentChronology = $this->IncidentChronologies->patchEntity($incidentChronology, $this->request->getData());
            if ($this->IncidentChronologies->save($incidentChronology)) {
                $this->Flash->success(__('The incident chronology has been saved.'));
                //risk、malmail来た方へリダイレクト
                $url = $this->referer(null, true);
                preg_match('/detections\/(\w+)/', $url, $match);
                return $this->redirect(["controller" => "riskDetections", 'action' => $match[1]]);
                //return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The incident chronology could not be saved. Please, try again.'));
            return $this->redirect(['action' => 'malmail']);
        }
        $riskDetections = $this->IncidentChronologies->RiskDetections->find('list', ['limit' => 200]);
        $users = $this->IncidentChronologies->Users->find('list', ['limit' => 200]);
        $this->set(compact('incidentChronology', 'riskDetections', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Incident Chronology id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $incidentChronology = $this->IncidentChronologies->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $incidentChronology = $this->IncidentChronologies->patchEntity($incidentChronology, $this->request->getData());
            if ($this->IncidentChronologies->save($incidentChronology)) {
                $this->Flash->success(__('The incident chronology has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The incident chronology could not be saved. Please, try again.'));
        }
        $riskDetections = $this->IncidentChronologies->RiskDetections->find('list', ['limit' => 200]);
        $users = $this->IncidentChronologies->Users->find('list', ['limit' => 200]);
        $this->set(compact('incidentChronology', 'riskDetections', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Incident Chronology id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $incidentChronology = $this->IncidentChronologies->get($id);
        if ($this->IncidentChronologies->delete($incidentChronology)) {
            $this->Flash->success(__('The incident chronology has been deleted.'));
        } else {
            $this->Flash->error(__('The incident chronology could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
