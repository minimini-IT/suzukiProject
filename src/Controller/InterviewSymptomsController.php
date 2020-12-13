<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * InterviewSymptoms Controller
 *
 * @property \App\Model\Table\InterviewSymptomsTable $InterviewSymptoms
 * @method \App\Model\Entity\InterviewSymptom[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InterviewSymptomsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            //'contain' => ['Patients', 'Symptoms'],
            'contain' => ['Diseaseds', 'Symptoms'],
        ];
        $interviewSymptoms = $this->paginate($this->InterviewSymptoms);

        $this->set(compact('interviewSymptoms'));
    }

    /**
     * View method
     *
     * @param string|null $id Interview Symptom id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $interviewSymptom = $this->InterviewSymptoms->get($id, [
            //'contain' => ['Patients', 'Symptoms', 'SymptomsLocations'],
            'contain' => ['Diseaseds', 'Symptoms', 'SymptomsLocations'],
        ]);

        $this->set(compact('interviewSymptom'));
    }

    public function add($patients_id = null)
    {
        $count = null;
        $symptoms_number = null;
        $this->loadModels(["Diseaseds"]);

        if ($this->request->is('post')) {
            $data = $this->request->getData();

            /*
             * [key] => diseaseds_id
             * [value] => sicknesses_id
            */
            $diseaseds_sicknesses_id = array();
            
            /*
             * postの場合は$patients_idはnull
             */
            $patients_id = $data["patients_id"];

            $diseaseds = $this->Diseaseds->find()
                ->where(["patients_id" => $patients_id])
                ->all();

            foreach($diseaseds as $diseased)
            {
                $diseaseds_sicknesses_id[$diseased->diseaseds_id] = $diseased->sicknesses_id;
            }

            /*
             * interview_symptoms登録のためのentity作成
             */
            $entity = array();
            $interview_symptoms_entities = array();
            foreach($diseaseds_sicknesses_id as $diseaseds_id => $sicknesses_id)
            {
                foreach($data["symptoms_id_{$sicknesses_id}"] as $symptoms_id)
                {
                    $entity["diseaseds_id"] = $diseaseds_id;
                    $entity["symptoms_id"] = $symptoms_id;
                    array_push($interview_symptoms_entities, $entity);
                }
            }
            $interviewSymptoms = $this->InterviewSymptoms->newEntities($interview_symptoms_entities);
            $interviewSymptoms = $this->InterviewSymptoms->patchEntities($interviewSymptoms, $interview_symptoms_entities);

            if($this->InterviewSymptoms->saveMany($interviewSymptoms))
            {
                $this->log("---save patients-related interview_symptoms clear---", LOG_DEBUG);
                return $this->redirect(["controller" => "symptoms_locations", 'action' => 'add', $patients_id]);

            }
            $this->log("---patients-related interview_symptoms errlr---", LOG_DEBUG);
            $this->Flash->error(__('エラーが発生したので登録できませんでした。'));
            $this->Flash->error(__('管理者へ報告してください。'));
            return $this->redirect(["controller" => "patients", 'action' => 'select']);
        }

        /*
         * 症状が未入力の病名のみ表示
         * select * from diseaseds as d
         * ->left join interview_symptoms as i on d.diseaseds_id = i.diseaseds_id
         * ->where patients_id = $patients_id and symptoms_id is NULL;
         *
         * emptyなら入力
         * 違うならSymptomsLocationsへ
         */
        $sick = $this->Diseaseds->find()
            ->contain(["Sicknesses"])
            ->join([
                "i" => [
                    "table" => "interview_symptoms",
                    "type" => "LEFT",
                    "conditions" => "Diseaseds.diseaseds_id = i.diseaseds_id"
                ],
            ])
            ->where(["patients_id" => $patients_id, "symptoms_id is NULL"]);

        if(empty($sick->toList()))
        {
            /*
             * 入力済みなのでリダイレクト
             */
            return $this->redirect(["controller" => "symptoms_locations", 'action' => 'add', $patients_id]);
        }

        $symptoms = $this->InterviewSymptoms->Symptoms->find('list', ['limit' => 200]);
        $this->set(compact('symptoms', "patients_id", "sick"));
    }

    public function edit($id = null)
    {
        $interviewSymptom = $this->InterviewSymptoms->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $interviewSymptom = $this->InterviewSymptoms->patchEntity($interviewSymptom, $this->request->getData());
            if ($this->InterviewSymptoms->save($interviewSymptom)) {
                $this->Flash->success(__('The interview symptom has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The interview symptom could not be saved. Please, try again.'));
        }
        $patients = $this->InterviewSymptoms->Patients->find('list', ['limit' => 200]);
        $symptoms = $this->InterviewSymptoms->Symptoms->find('list', ['limit' => 200]);
        $this->set(compact('interviewSymptom', 'patients', 'symptoms'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Interview Symptom id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $interviewSymptom = $this->InterviewSymptoms->get($id);
        if ($this->InterviewSymptoms->delete($interviewSymptom)) {
            $this->Flash->success(__('The interview symptom has been deleted.'));
        } else {
            $this->Flash->error(__('The interview symptom could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
