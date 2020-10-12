<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SuspiciousLinks Controller
 *
 * @property \App\Model\Table\SuspiciousLinksTable $SuspiciousLinks
 *
 * @method \App\Model\Entity\SuspiciousLink[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SuspiciousLinksController extends AppController
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
        $suspiciousLinks = $this->paginate($this->SuspiciousLinks);

        $this->set(compact('suspiciousLinks'));
    }

    /**
     * View method
     *
     * @param string|null $id Suspicious Link id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $suspiciousLink = $this->SuspiciousLinks->get($id, [
            'contain' => ['RiskDetections']
        ]);

        $this->set('suspiciousLink', $suspiciousLink);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $data = $this->request->getData();
        foreach($data["link"] as $link)
        {
            $linkEntity[] = [
                "risk_detections_id" => $data["risk_detections_id"],
                "link" => $link
            ];
        }
        $links = $this->SuspiciousLinks->newEntities($linkEntity);
        if($this->SuspiciousLinks->saveMany($links)){
            $this->Flash->success(__('リンク登録完了'));
            return $this->redirect(["controller" => "risk_detections", 'action' => 'malmail']);
        }
        $this->Flash->error(__('リンク登録失敗'));
        return $this->redirect(["controller" => "risk_detections", 'action' => 'malmail']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Suspicious Link id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $suspiciousLink = $this->SuspiciousLinks->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $suspiciousLink = $this->SuspiciousLinks->patchEntity($suspiciousLink, $this->request->getData());
            if ($this->SuspiciousLinks->save($suspiciousLink)) {
                $this->Flash->success(__('The suspicious link has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The suspicious link could not be saved. Please, try again.'));
        }
        $riskDetections = $this->SuspiciousLinks->RiskDetections->find('list', ['limit' => 200]);
        $this->set(compact('suspiciousLink', 'riskDetections'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Suspicious Link id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $suspiciousLink = $this->SuspiciousLinks->get($id);
        if ($this->SuspiciousLinks->delete($suspiciousLink)) {
            $this->Flash->success(__('The suspicious link has been deleted.'));
        } else {
            $this->Flash->error(__('The suspicious link could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
