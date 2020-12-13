<?php
declare(strict_types=1);

namespace App\Controller;

class SymptomsLocationsController extends AppController
{
    public function index()
    {
        $this->paginate = [
            'contain' => ['InterviewSymptoms', 'Locations'],
        ];
        $symptomsLocations = $this->paginate($this->SymptomsLocations);

        $this->set(compact('symptomsLocations'));
    }

    public function view($id = null)
    {
        $symptomsLocation = $this->SymptomsLocations->get($id, [
            'contain' => ['InterviewSymptoms', 'Locations'],
        ]);

        $this->set(compact('symptomsLocation'));
    }

    public function add($patients_id = null)
    {
        $this->loadModels(["Diseaseds", "InterviewSymptoms"]);
        $symptomsLocation = $this->SymptomsLocations->newEmptyEntity();
        if ($this->request->is('post')) 
        {
            $data = $this->request->getData();

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
                $this->log("---save patients-related symptoms_locations clear---", LOG_DEBUG);
                return $this->redirect(["controller" => "patients", 'action' => 'edit', $patients_id]);
            }
            $this->log("---patients-related symptoms_locations error---", LOG_DEBUG);
            $this->Flash->error(__('エラーが発生したので登録できませんでした。'));
            $this->Flash->error(__('管理者へ報告してください。'));
            return $this->redirect(["controller" => "patients", 'action' => 'select']);
        }

        /*
         * 部位が未入力の症状のみ表示
         * select * from diseaseds as d
         * ->left join interview_symptoms as i on d.diseaseds_id = i.diseaseds_id
         * ->left join symptoms_locations as sl on i.interview_symptoms_id = sl.interview_symptoms_id
         * ->where patients_id = $patients_id and locations_id is NULL;
         *
         * containでInterviewSymptoms=>Symptomsで取得できなかったのでムリヤリ
         */
        $interviewSymptoms = $this->Diseaseds->find()
            ->contain([
                "Sicknesses",
                "InterviewSymptoms.Symptoms",
            ])
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
            ->where(["Diseaseds.patients_id" => $patients_id, "locations_id is NULL"])
            ->group(["Diseaseds.diseaseds_id"]);

        if(empty($interviewSymptoms->toList()))
        {
            /*
             * 入力済みなのでリダイレクト
             */
            return $this->redirect(["controller" => "patients", 'action' => 'view', $patients_id]);
        }

        $locations = $this->SymptomsLocations->Locations->find('list', ['limit' => 200]);
        $this->set(compact('symptomsLocation', 'interviewSymptoms', 'locations', "patients_id"));
        
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
