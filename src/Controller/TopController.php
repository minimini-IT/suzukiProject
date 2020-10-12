<?php
declare(strict_types=1);

namespace App\Controller;

class TopController extends AppController
{
    public function index()
    {
        $this->loadModels(["Sicknesses"]);
        $sicknesses = $this->Sicknesses->find('list', ['limit' => 200]);
        $this->set(compact('sicknesses'));
    }

}
