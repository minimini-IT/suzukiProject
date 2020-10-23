<?php
declare(strict_types=1);

namespace App\Controller;

class TopController extends AppController
{
    public function index()
    {
        //$this->loadModels(["Sicknesses", "Symptoms", "SymptomsParts"]);
        $this->loadModels(["Sicknesses", "Symptoms", "Locations"]);
        $sicknesses = $this->Sicknesses->find('list', ['limit' => 200]);
        $symptoms = $this->Symptoms->find('list', ['limit' => 200]);
        $locations = $this->Locations->find('list', ['limit' => 200]);
        $this->set(compact('sicknesses', "symptoms", "locations"));
    }

}
