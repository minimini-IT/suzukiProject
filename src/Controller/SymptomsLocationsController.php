<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * SymptomsLocations Controller
 *
 * @property \App\Model\Table\SymptomsLocationsTable $SymptomsLocations
 * @method \App\Model\Entity\SymptomsLocation[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SymptomsLocationsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['InterviewSymptoms', 'Locations'],
        ];
        $symptomsLocations = $this->paginate($this->SymptomsLocations);

        $this->set(compact('symptomsLocations'));
    }

    /**
     * View method
     *
     * @param string|null $id Symptoms Location id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $symptomsLocation = $this->SymptomsLocations->get($id, [
            'contain' => ['InterviewSymptoms', 'Locations'],
        ]);

        $this->set(compact('symptomsLocation'));
    }

    public function add($patients_id = null)
    {
        $this->response = $this->response->withDisabledCache();

        $this->loadModels(["Diseaseds", "InterviewSymptoms"]);
        $symptomsLocation = $this->SymptomsLocations->newEmptyEntity();
        if ($this->request->is('post')) 
        {
            $data = $this->request->getData();

            $patients_id = $data["patients_id"];

            /*
             * interview_symptoms_idを取得
             */
            $interviewSymptoms = $this->InterviewSymptoms->find()
                ->select(["interview_symptoms_id"])
                ->join([
                    "d" => [
                        "table" => "diseaseds",
                        "type" => "RIGHT",
                        "conditions" => "d.diseaseds_id = InterviewSymptoms.diseaseds_id"
                    ],
                ])
                ->where(["d.patients_id" => $patients_id]);
            
            /*
             * 重複防止用
             * 今後要実装
             */
            /*

            /*
             * SymptomsLocationsへsaveする用のentityを作成
             */
            $entity = array();
            $symptomsLocationsEntities = array();
            foreach($interviewSymptoms as $id)
            {
                foreach($data["locations_id_{$id->interview_symptoms_id}"] as $location)
                {
                    $entity["interview_symptoms_id"] = $data["interview_symptoms_id_{$id->interview_symptoms_id}"];
                    $entity["locations_id"] = $location;
                    array_push($symptomsLocationsEntities, $entity);
                }
            }
            $symptomsLocationsEntities_r = $symptomsLocationsEntities;

            $symptomsLocations = $this->SymptomsLocations->newEntities($symptomsLocationsEntities);
            $symptomsLocations = $this->SymptomsLocations->patchEntities($symptomsLocations, $symptomsLocationsEntities);

            if($this->SymptomsLocations->saveMany($symptomsLocations))
            {
                $this->Flash->success(__('The symptoms location has been saved.'));

                return $this->redirect(["controller" => "patients", 'action' => 'view', $patients_id]);
            }
            $this->Flash->error(__('The symptoms location could not be saved. Please, try again.'));
        }

        /*
         * 部位が入力済みの場合はリダイレクト
         */
        $inputRequired = $this->Diseaseds->find()
            ->select(["i.symptoms_id"])
            ->join([
                "i" => [
                    "table" => "interview_symptoms",
                    "type" => "RIGHT",
                    "conditions" => "Diseaseds.diseaseds_id = i.diseaseds_id"
                ],
                "sl" => [
                    "table" => "symptoms_locations",
                    "type" => "RIGHT",
                    "conditions" => "i.interview_symptoms_id = sl.interview_symptoms_id"
                ],
            ])
            ->where(["patients_id" => $patients_id]);

        $entered = $this->Diseaseds->find()
            ->select(["i.symptoms_id"])
            ->join([
                "i" => [
                    "table" => "interview_symptoms",
                    "type" => "LEFT",
                    "conditions" => "Diseaseds.diseaseds_id = i.diseaseds_id"
                ],
                "sl" => [
                    "table" => "symptoms_locations",
                    "type" => "LEFT",
                    "conditions" => "i.interview_symptoms_id = sl.interview_symptoms_id"
                ],
            ])
            ->where(["patients_id" => $patients_id]);

        if($inputRequired->count() >= $entered->count())
        {
            return $this->redirect(["controller" => "patients", 'action' => 'view', $patients_id]);
        }





        $interviewSymptoms = $this->Diseaseds->find()
            ->contain([
                "Patients",
                "Sicknesses", 
                "InterviewSymptoms", 
                "InterviewSymptoms.Symptoms", 
                "InterviewSymptoms.SymptomsLocations"
            ])
            ->where(["Diseaseds.patients_id" => $patients_id]);
        
        $locations = $this->SymptomsLocations->Locations->find('list', ['limit' => 200]);
        $this->set(compact('symptomsLocation', 'interviewSymptoms', 'locations'));
        
    }

    public function edit($id = null)
    {
        $symptomsLocation = $this->SymptomsLocations->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $symptomsLocation = $this->SymptomsLocations->patchEntity($symptomsLocation, $this->request->getData());
            if ($this->SymptomsLocations->save($symptomsLocation)) {
                $this->Flash->success(__('The symptoms location has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The symptoms location could not be saved. Please, try again.'));
        }
        $interviewSymptoms = $this->SymptomsLocations->InterviewSymptoms->find('list', ['limit' => 200]);
        $locations = $this->SymptomsLocations->Locations->find('list', ['limit' => 200]);
        $this->set(compact('symptomsLocation', 'interviewSymptoms', 'locations'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Symptoms Location id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $symptomsLocation = $this->SymptomsLocations->get($id);
        if ($this->SymptomsLocations->delete($symptomsLocation)) {
            $this->Flash->success(__('The symptoms location has been deleted.'));
        } else {
            $this->Flash->error(__('The symptoms location could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
