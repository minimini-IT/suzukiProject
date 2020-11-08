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

        $this->loadModels(["Sicknesses", "Symptoms", "Locations", "Patients"]);

        /*
         * 最近の記事
         */
        $patients = $this->Patients->find()
            ->order(["modified" => "DESC"])
            ->limit(5);

        $sicknesses = $this->Sicknesses->find('list', ['limit' => 200]);
        $symptoms = $this->Symptoms->find('list', ['limit' => 200]);
        $locations = $this->Locations->find('list', ['limit' => 200]);
        $this->set(compact('sicknesses', "symptoms", "locations", "patients"));
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
