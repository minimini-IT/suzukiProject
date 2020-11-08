<?php
declare(strict_types=1);

namespace App\Controller;

class DashboardManagementController extends AppController
{
    public function index()
    {
        $dashboardManagement = $this->DashboardManagement->newEmptyEntity();
        /*
         * 承認用
         */
        $this->Authorization->authoriza($dashboardManagement);
    }

    public function select()
    {
        $this->loadModels(["Patients"]);
        $this->paginate = [
            'contain' => [
                'PatientSexes', 
                "Diseaseds.Sicknesses",
                "Diseaseds.InterviewSymptoms.Symptoms",
                "Diseaseds.InterviewSymptoms.SymptomsLocations.Locations",
            ],
        ];
        $patients = $this->paginate($this->Patients);

        $this->set(compact('patients'));
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
    }

}
