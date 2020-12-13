<?php
declare(strict_types=1);

namespace App\Controller;

class DiseasedsController extends AppController
{
    public function add($patients_id)
    {
        $diseased = $this->Diseaseds->newEmptyEntity();

        if ($this->request->is('post')) {
            //$this->log("---post---", LOG_DEBUG);
            $data = $this->request->getData();
            //$sicknesses_id = $data["sicknesses_id"];
            //unset($data["sicknesses_id"]);
            $diseased = $this->Diseaseds->patchEntity($diseased, $data);
            $this->log("---data---", LOG_DEBUG);
            $this->log(print_r($data, true), LOG_DEBUG);

            /*
             * 複数save
             */
            $diseased_entity = array();
            foreach($data["sicknesses_id"] as $id)
            {
                $entity = ["patients_id" => $patients_id, "sicknesses_id" => $id];
                array_push($diseased_entity, $entity);
            }
            //$this->log("---diseased_entity---", LOG_DEBUG);
            //$this->log(print_r($diseased_entity, true), LOG_DEBUG);
            $diseased = $this->Diseaseds->newEntities($diseased_entity);
            $diseased = $this->Diseaseds->patchEntities($diseased, $diseased_entity);
            if($this->Diseaseds->saveMany($diseased))
            {
                //$this->Flash->success(__('The diseased has been saved.'));
                $this->log("---save patients-related diseaseds clear---", LOG_DEBUG);
                return $this->redirect(["controller" => "interview_symptoms", 'action' => 'add', $patients_id]);
            }
            else
            {
                //$this->Flash->error(__('The diseased could not be saved. Please, try again.'));
                $this->log("---save patients-related diseaseds error---", LOG_DEBUG);
                $this->Flash->error(__('エラーが発生したので登録できませんでした。'));
                $this->Flash->error(__('管理者へ報告してください。'));
                return $this->redirect(["controller" => "top", 'action' => 'index']);
            }
        }
        $sub_query = $this->Diseaseds->find()
            ->select(["sicknesses_id"])
            ->where(["patients_id" => $patients_id]);
        $sicknesses = $this->Diseaseds->Sicknesses->find('list', ['limit' => 200])
            ->where(["sicknesses_id not in" => $sub_query]);
        $this->set(compact("diseased", 'sicknesses', "patients_id"));
    }

    public function delete($diseaseds_id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $diseased = $this->Diseaseds->get($diseaseds_id);
        $patients_id = $diseased->patients_id;
        if ($this->Diseaseds->delete($diseased)) {
            $this->log("---delete patients-related diseaseds clear---", LOG_DEBUG);
            return $this->redirect(["controller" => "patients", 'action' => 'edit', $patients_id]);
        }
        $this->log("---delete patients-related diseaseds error---", LOG_DEBUG);
        $this->Flash->error(__('エラーが発生したので登録できませんでした。'));
        $this->Flash->error(__('管理者へ報告してください。'));
        return $this->redirect(["controller" => "top", 'action' => 'index']);
    }
}
