<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Patients Controller
 *
 * @property \App\Model\Table\PatientsTable $Patients
 * @method \App\Model\Entity\Patient[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PatientsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['PatientSexes', "Diseaseds.Sicknesses"],
        ];
        $patients = $this->paginate($this->Patients);

        $this->set(compact('patients'));
    }

    /**
     * View method
     *
     * @param string|null $id Patient id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        //患者の各病気の症状が記入されているか確認
            //patients_idから病気の症状を取得
        //$this->loadModels(["InterviewSymptoms"]);
        $sub_query = $this->Patients->Diseaseds->find()
            //->select(["sicknesses_id"])
            ->select(["diseaseds_id"])
            ->where(["patients_id" => $id]);
        $symptoms = $this->Patients->Diseaseds->InterviewSymptoms->find()
            ->where(["diseaseds_id in" => $sub_query]);
        //$symptoms = $this->Patients->InterviewSymptoms->find()
        //    ->where(["patients_id" => $id]);

        /*
        if(empty($symptoms))
        {
            $this->log("---empty---", LOG_DEBUG);
        }
        else
        {
            $this->log("---not empty---", LOG_DEBUG);
        }
         */
        /*
        $sub_query_test = $sub_query;
        $this->log("---sub_query_test---", LOG_DEBUG);
        $this->log(print_r($sub_query_test->all(), true), LOG_DEBUG);
        $symptoms_test = $symptoms;
        $this->log("---symptoms_test---", LOG_DEBUG);
        $this->log(print_r($symptoms_test->all(), true), LOG_DEBUG);
         */

        $diseaseds_id = array();
        $interview_symptoms_diseased = array();
        //diseaseds_idに対してそれぞれinterview_symptoms_idが付与されているか
        /*
        foreach($sub_query as $diseased)
        {
            $this->log("---diseaseds_id---", LOG_DEBUG);
            $this->log(print_r($diseased->diseaseds_id, true), LOG_DEBUG);
            array_push($diseaseds_id, diseased);
        }
         */

        //各patientsのsicknessに対するsymptomsが入力されているかのフラグ
        $not_entered_flag = false;

        foreach($symptoms as $interview_symptoms)
        {
            //$this->log("---interview_symptoms---", LOG_DEBUG);
            //$this->log(print_r($interview_symptoms->diseaseds_id, true), LOG_DEBUG);
            array_push($interview_symptoms_diseased, $interview_symptoms->diseaseds_id);
        }
        //$debug_diseased = $interview_symptoms_diseased;
        //$this->log("---interview_symptoms_diseased---", LOG_DEBUG);
        //$this->log(print_r($debug_diseased, true), LOG_DEBUG);
        //$this->log("---interview_symptoms_diseased---", LOG_DEBUG);
        //$this->log(print_r($interview_symptoms_diseased, true), LOG_DEBUG);
        foreach($sub_query as $diseased)
        {
            $debug_sub_query_diseased = $diseased;
            //$this->log("---sub_query_diseased---", LOG_DEBUG);
            //$this->log(print_r($debug_sub_query_diseased->diseaseds_id, true), LOG_DEBUG);
            if(!in_array($diseased->diseaseds_id, $interview_symptoms_diseased))
            {
                $not_entered_flag = true;
                break;
            }
            //array_push($diseaseds_id, diseased);
        }

        //症状未記入の場合は症状を記入
        //if(count($symptoms->toList()) == 0)
        if($not_entered_flag)
        {
            return $this->redirect(["controller" => "InterviewSymptoms", 'action' => 'add', $id]);
        }

            
        $patient = $this->Patients->get($id, [
            'contain' => [
                'PatientSexes', 
                "Diseaseds.InterviewSymptoms.Symptoms", 
                "Diseaseds.Sicknesses", 
                "Diseaseds.InterviewSymptoms.SymptomsLocations.Locations"
            ],
        ]);

        $this->set(compact('patient'));
        //$this->set(compact('patient', "symptoms"));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $patient = $this->Patients->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $sicknesses_id = $data["sicknesses_id"];
            unset($data["sicknesses_id"]);
            $patient = $this->Patients->patchEntity($patient, $data);
            $patient_r = $patient;
            $this->log("---patient---", LOG_DEBUG);
            $this->log(print_r($patient_r, true), LOG_DEBUG);
            if ($this->Patients->save($patient)) {
                $this->Flash->success(__('The patient has been saved.'));
                $patients_id = $patient->patients_id;
                //Diseasedsにpatients_idとsicknesses_idをsave
                //$this->log("---data---", LOG_DEBUG);
                //$this->log(print_r($data["sicknesses_id"], true), LOG_DEBUG);
                $this->loadModels(["Diseaseds"]);
                //$diseased = array();
                $diseased_entity = array();
                foreach($sicknesses_id as $id)
                {
                    $entity = ["patients_id" => $patients_id, "sicknesses_id" => $id];
                    array_push($diseased_entity, $entity);
                }
                //$diseased = $this->Diseaseds->newEnptyEntity();
                $diseased = $this->Diseaseds->newEntities($diseased_entity);
                //$file = $this->MessageFiles->newEntities($entity);
                //$diseased = $this->Diseaseds->patchEntity($diseased, $diseased_entity);
                $diseased = $this->Diseaseds->patchEntities($diseased, $diseased_entity);
                if($this->Diseaseds->saveMany($diseased))
                {
                    $this->Flash->success(__('The diseased has been saved.'));
                }
                else
                {
                    $this->Flash->error(__('The diseased could not be saved. Please, try again.'));
                }
                //$this->log("---diseased---", LOG_DEBUG);
                //$this->log(print_r($diseased, true), LOG_DEBUG);
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The patient could not be saved. Please, try again.'));
        }
        $sicknesses = $this->Patients->Diseaseds->Sicknesses->find('list', ['limit' => 200]);
        $patientSexes = $this->Patients->PatientSexes->find('list', ['limit' => 200]);
        $this->set(compact('patient', 'sicknesses', 'patientSexes'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Patient id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $patient = $this->Patients->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $patient = $this->Patients->patchEntity($patient, $this->request->getData());
            if ($this->Patients->save($patient)) {
                $this->Flash->success(__('The patient has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The patient could not be saved. Please, try again.'));
        }
        $sicknesses = $this->Patients->Sicknesses->find('list', ['limit' => 200]);
        $patientSexes = $this->Patients->PatientSexes->find('list', ['limit' => 200]);
        $this->set(compact('patient', 'sicknesses', 'patientSexes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Patient id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $patient = $this->Patients->get($id);
        if ($this->Patients->delete($patient)) {
            $this->Flash->success(__('The patient has been deleted.'));
        } else {
            $this->Flash->error(__('The patient could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function search()
    {
        //検索結果用
        //get取得
        $data = $this->request->getQuery();
        $data_p = print_r($this->request->getQuery(), true);
        if($this->request->is("get") && $data != null)
        {
            $sicknesses_flag = false;
            $symptoms_flag = false;
            $this->loadModels(["Sicknesses", "InterviewSymptoms", "SymptomsLocations", "Diseaseds"]);
        
            //部位が含まれていれば
            $locations_id_search = array_key_exists("locations_id", $data);
            if($locations_id_search)
            {
                $locations_flag = true;
                //$this->log("---location true---", LOG_DEBUG);
                $locations_values = "null";
            }
            else
            {
                $locations_flag = false;
                //$this->log("---location false---", LOG_DEBUG);
            }

            foreach($data as $key => $value)
            {

                if($key == "sicknesses_id")
                {
                    //病名はOR検索
                    
                    $values = array_map("intval", $value);

                    //サブクエリー
                    $sub_query = $this->Patients->getAssociation("Diseaseds")->find()
                        ->select(["patients_id"])
                        ->distinct()
                        ->where(["Diseaseds.sicknesses_id in" => $values]);

                    //クエリー
                    $patients = $this->Patients->find()
                        ->where(["patients_id in" => $sub_query]);

                    $sicknesses_flag = true;

                }
                else if($key == "symptoms_id")
                {
                    //症状のみではAND検索
                    //部位ありなら症状は１つのみ
                    //症状複数なら部位無し
                    $values = array_map("intval", $value);

                    if($locations_flag)
                    {
                        //部位ありなら部位の値も含めてクエリ作成するのでforeach()後
                        $symptoms_values = $values;
                    }
                    else
                    {
                        //select diseaseds.diseaseds_id from diseaseds right join interview_symptoms on diseaseds.diseaseds_id = interview_symptoms.diseaseds_id where interview_symptoms.symptoms_id in ($values) group by diseaseds.diseaseds_id having count(diseaseds.diseaseds_id >= count($values));
                        //$this->log("---not symptoms_values---", LOG_DEBUG);
                        //サブクエリー
                        //$sub_query = $this->Diseaseds->find()
                        $sub_sub_query = $this->Diseaseds->find()
                            ->select(["Diseaseds.diseaseds_id"])
                            ->join([
                                "i" => [
                                    "table" => "interview_symptoms",
                                    "type" => "RIGHT",
                                    //"conditions" => "Diseaseds.diseaseds_id = i.diseaseds_id"
                                    "conditions" => "Diseaseds.diseaseds_id = i.diseaseds_id"
                                ],
                            ])
                            //->where(["interview_symptoms.symptoms_id in" => $values]);
                            ->group(["Diseaseds.diseaseds_id"])
                            ->having(["count(Diseaseds.diseaseds_id) >=" => count($values)])
                            ->where(["i.symptoms_id in" => $values]);

                        //select diseaseds.patients_id from diseaseds right join interview_symptoms on diseaseds.diseaseds_id = interview_symptoms.diseaseds_id where diseaseds.diseaseds_id in ($sub_sub_query) and interview_symptoms.symptoms_id in ($values) group by diseaseds.patients_id having count(diseaseds.patients_id) >= count($values);
                        //$patients = $this->Diseaseds->find()
                        $sub_query = $this->Diseaseds->find()
                            ->select(["Diseaseds.patients_id"])
                            ->join([
                                "i" => [
                                    "table" => "interview_symptoms",
                                    "type" => "RIGHT",
                                    "conditions" => "Diseaseds.diseaseds_id = i.diseaseds_id"
                                ],
                            ])
                            ->group(["Diseaseds.patients_id"])
                            ->having(["count(Diseaseds.patients_id) >=" => count($values)])
                            ->where(["Diseaseds.diseaseds_id in" => $sub_sub_query])
                            //->where(["InterviewSymptoms.symptoms_id in" => $values]);
                            ->where(["i.symptoms_id in" => $values]);
                        
                        /*
                        $query_test = $this->Patients->find()
                            ->select(["Patients.patients_id"])
                            ->join([
                                "d" => [
                                    "table" => "diseaseds",
                                    "type" => "RIGHT",
                                    "conditions" => "Patients.patients_id = d.patients_id"
                                ],
                                "i" => [
                                    "table" => "interview_symptoms",
                                    "type" => "RIGHT",
                                    //"conditions" => "Diseaseds.diseaseds_id = i.diseaseds_id"
                                    "conditions" => "d.diseaseds_id = i.diseaseds_id"
                                ],
                            ]);
                         */

                            /*
                            ->rightJoin(
                                ["d" => "diseaseds"],
                                ["patients.patients_id = d.patients_id"],
                            )
                             */
                            /*
                            ->join([
                                "table" => "diseaseds",
                                "type" => "RIGHT",
                                "conditions" => "patients.patients_id = diseaseds.patients_id",
                            ])
                             */
                        /*
                        $sub_query = $this->InterviewSymptoms->find()
                            ->select(["diseaseds_id"])
                            ->where(["symptoms_id in" => $valuse])
                            ->group(["diseaseds_id"]);
                        $sub_sub_query = $this->Diseaseds->find()
                            ->select(["patients_id"])
                            ->where(["diseaseds_id in" => $sub_query])
                            ->group(["patients_id"]);
                         */


//                        $sub_query = $this->Patients->getAssociation("InterviewSymptoms")->find()
//                            ->select(["patients_id"])
//                            ->where(["InterviewSymptoms.symptoms_id in" => $values])
//                            ->group(["patients_id"])
//                            ->having(["count(patients_id) >=" => count($values)]);
//
//                        //クエリー
//                        $patients = $this->Patients->find()
//                            ->where(["patients_id in" => $sub_query]);
//
//
                        $patients = $this->Patients->find()
                            //->where(["patients_id in" => $query_test]);
                            ->where(["patients_id in" => $sub_query]);

                        $symptoms_flag = true;
                    }

                }
                else if($key == "locations_id")
                {
                    //なにする？
                    $values = array_map("intval", $value);
                    $locations_values = $values;
                    $locations_values_p = $values;
                    //$this->log("---locations_values---", LOG_DEBUG);
                    //$this->log(print_r($locations_values_p, true), LOG_DEBUG);
                }

                if($locations_flag)
                {
                    //ここから
                    $sub_sub_query = $this->SymptomsLocations->find()
                        ->select(["interview_symptoms_id"])
                        ->distinct()
                        ->where(["SymptomsLocations.locations_id in" => $locations_values]);

                    $sub_query = $this->InterviewSymptoms->find()
                        ->select(["patients_id"])
                        ->distinct()
                        ->where(["interview_symptoms_id in" => $sub_sub_query])
                        ->where(["InterviewSymptoms.symptoms_id in" => $symptoms_values]);

                    //クエリー
                    $patients = $this->Patients->find()
                        ->where(["patients_id in" => $sub_query]);

                }
            }
            /*
            if($sicknesses_flag)
            {
                $this->paginate = [
                    'contain' => ['PatientSexes', "Diseaseds.Sicknesses"],
                ];
                $patients = $this->paginate($patients);
            }
            else if($symptoms_flag)
            {
                $this->paginate = [
                    'contain' => ['PatientSexes', "Diseaseds.Sicknesses"],
                ];
                $patients = $this->paginate($patients);
            }
             */
            $this->paginate = [
                'contain' => ['PatientSexes', "Diseaseds.Sicknesses"],
            ];
            $patients = $this->paginate($patients);
        }
        else
        {
            return $this->redirect(["controller" => "Top", 'action' => 'index']);
        }

        //$this->set(compact("patients", "flag"));
        $this->set(compact("patients"));
    }
}
