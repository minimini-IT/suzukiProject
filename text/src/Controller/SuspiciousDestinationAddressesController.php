<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SuspiciousDestinationAddresses Controller
 *
 * @property \App\Model\Table\SuspiciousDestinationAddressesTable $SuspiciousDestinationAddresses
 *
 * @method \App\Model\Entity\SuspiciousDestinationAddress[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SuspiciousDestinationAddressesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['RiskDetections']
        ];
        $suspiciousDestinationAddresses = $this->paginate($this->SuspiciousDestinationAddresses);

        $this->set(compact('suspiciousDestinationAddresses'));
    }

    /**
     * View method
     *
     * @param string|null $id Suspicious Destination Address id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $suspiciousDestinationAddress = $this->SuspiciousDestinationAddresses->get($id, [
            'contain' => ['RiskDetections']
        ]);

        $this->set('suspiciousDestinationAddress', $suspiciousDestinationAddress);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $data = $this->request->getData();
        foreach($data["destination_address"] as $address)
        {
            $addressEntity[] = [
                "risk_detections_id" => $data["risk_detections_id"],
                "destination_address" => $address
            ];
        }
        $destinationAddresses = $this->SuspiciousDestinationAddresses->newEntities($addressEntity);
        if($this->SuspiciousDestinationAddresses->saveMany($destinationAddresses)){
            $this->Flash->success(__('アドレス登録完了'));
            return $this->redirect(["controller" => "risk_detections", 'action' => 'malmail']);
        }
        $this->Flash->error(__('アドレス登録失敗'));
        return $this->redirect(["controller" => "risk_detections", 'action' => 'malmail']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Suspicious Destination Address id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $suspiciousDestinationAddress = $this->SuspiciousDestinationAddresses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $suspiciousDestinationAddress = $this->SuspiciousDestinationAddresses->patchEntity($suspiciousDestinationAddress, $this->request->getData());
            if ($this->SuspiciousDestinationAddresses->save($suspiciousDestinationAddress)) {
                $this->Flash->success(__('The suspicious destination address has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The suspicious destination address could not be saved. Please, try again.'));
        }
        $riskDetections = $this->SuspiciousDestinationAddresses->RiskDetections->find('list', ['limit' => 200]);
        $this->set(compact('suspiciousDestinationAddress', 'riskDetections'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Suspicious Destination Address id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $suspiciousDestinationAddress = $this->SuspiciousDestinationAddresses->get($id);
        if ($this->SuspiciousDestinationAddresses->delete($suspiciousDestinationAddress)) {
            $this->Flash->success(__('The suspicious destination address has been deleted.'));
        } else {
            $this->Flash->error(__('The suspicious destination address could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
