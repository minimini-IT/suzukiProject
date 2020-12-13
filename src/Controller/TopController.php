<?php
declare(strict_types=1);

namespace App\Controller;

class TopController extends AppController
{
    public function index()
    {
        /*
         * 承認不要
         */
        $this->Authorization->skipAuthorization();

        //$this->loadModels(["Sicknesses", "Symptoms", "Locations", "Patients"]);
        $this->loadModels(["Patients"]);

        /*
         * 最近の記事
         */
        $patients = $this->Patients->find()
            ->select(["patients_id", "pen_name"])
            ->join([
                "d" => [
                    "table" => "diseaseds",
                    "type" => "RIGHT",
                    "conditions" => "Patients.patients_id = d.patients_id"
                ],
                "i" => [
                    "table" => "interview_symptoms",
                    "type" => "RIGHT",
                    "conditions" => "d.diseaseds_id = i.diseaseds_id"
                ],
                "sl" => [
                    "table" => "symptoms_locations",
                    "type" => "RIGHT",
                    "conditions" => "i.interview_symptoms_id = sl.interview_symptoms_id"
                ],
            ])
            ->group(["Patients.patients_id"])
            ->order(["modified" => "DESC"])
            ->limit(5);

        $login_user = $this->Authentication->getIdentity();

        //$sicknesses = $this->Sicknesses->find('list', ['limit' => 200]);
        //$symptoms = $this->Symptoms->find('list', ['limit' => 200]);
        //$locations = $this->Locations->find('list', ['limit' => 200]);
        //$this->set(compact('sicknesses', "symptoms", "locations", "patients"));
        $this->set(compact("patients", "login_user"));
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        /*
         * Topは認証不要
         * すべてのアクション
         */
        $this->Authentication->addUnauthenticatedActions(["index"]);
    }



}
