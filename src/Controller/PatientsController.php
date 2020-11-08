<?php
declare(strict_types=1);

namespace App\Controller;

class PatientsController extends AppController
{
    public function index()
    {
        /*
         * 承認不要
         */
        $this->Authorization->skipAuthorization();

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

    public function view($id = null)
    {
        /*
         * 承認不要
         */
        $this->Authorization->skipAuthorization();

        /*
         * 症状の記入状態の確認
         * 未記入であれば入力フォームへ飛ぶ
         * patients_idから病気の症状を取得
         *
         * 症状の次は各症状に対する部位の確認
         * すべて入力済みならばview表示
         */
        //$this->loadModels(["InterviewSymptoms"]);
        $sub_query = $this->Patients->Diseaseds->find()
            //->select(["sicknesses_id"])
            ->select(["diseaseds_id"])
            ->where(["patients_id" => $id]);
        $symptoms = $this->Patients->Diseaseds->InterviewSymptoms->find()
            ->where(["diseaseds_id in" => $sub_query]);

        $diseaseds_id = array();
        $interview_symptoms_diseased = array();

        /*
         * 各patientsのsicknessに対するsymptomsが入力されているかのフラグ
         */
        $not_entered_flag = false;

        foreach($symptoms as $interview_symptoms)
        {
            array_push($interview_symptoms_diseased, $interview_symptoms->diseaseds_id);
        }
        foreach($sub_query as $diseased)
        {
            $debug_sub_query_diseased = $diseased;
            if(!in_array($diseased->diseaseds_id, $interview_symptoms_diseased))
            {
                $not_entered_flag = true;
                break;
            }
        }

        /*
         * 症状未記入の場合は症状を記入
         */
        if($not_entered_flag)
        {
            return $this->redirect(["controller" => "InterviewSymptoms", 'action' => 'add', $id]);
        }

        /*
         * 部位未記入の場合は部位を記入
         */
        $this->loadModels(["Diseaseds", "InterviewSymptoms"]);
        $sub_query = $this->Diseaseds->find()
            ->select(["diseaseds_id"])
            ->join([
                "i" => [
                    "table" => "interview_symptoms",
                    "type" => "RIGHT",
                    "conditions" => "Diseaseds.diseaseds_id = i.diseaseds_id"
                ],
            ])
            ->where(["patients_id" => $id])
            ->group(["Diseaseds.diseaseds_id"]);

        $locations = $this->InterviewSymptoms->find()
            ->join([
                "d" => [
                    "table" => "diseaseds",
                    "type" => "INNER",
                    "conditions" => "d.diseaseds_id = InterviewSymptoms.diseaseds_id"
                ],
                "sy" => [
                    "table" => "symptoms_locations",
                    "type" => "INNER",
                    "conditions" => "InterviewSymptoms.interview_symptoms_id = sy.interview_symptoms_id"
                ]
            ])
            ->where(["InterviewSymptoms.diseaseds_id in" => $sub_query]);

        if(empty($locations->toList()))
        {
            return $this->redirect(["controller" => "SymptomsLocations", 'action' => 'add', $id]);
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
    }

    public function add()
    {
        $patient = $this->Patients->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $sicknesses_id = $data["sicknesses_id"];
            unset($data["sicknesses_id"]);
            $patient = $this->Patients->patchEntity($patient, $data);

            if ($this->Patients->save($patient)) {
                $this->Flash->success(__('The patient has been saved.'));
                $patients_id = $patient->patients_id;
                /*
                 * Diseasedsにpatients_idとsicknesses_idをsave
                 */
                $this->loadModels(["Diseaseds"]);
                $diseased_entity = array();
                foreach($sicknesses_id as $id)
                {
                    $entity = ["patients_id" => $patients_id, "sicknesses_id" => $id];
                    array_push($diseased_entity, $entity);
                }
                $diseased = $this->Diseaseds->newEntities($diseased_entity);
                $diseased = $this->Diseaseds->patchEntities($diseased, $diseased_entity);
                if($this->Diseaseds->saveMany($diseased))
                {
                    $this->Flash->success(__('The diseased has been saved.'));
                }
                else
                {
                    $this->Flash->error(__('The diseased could not be saved. Please, try again.'));
                }
                return $this->redirect(['action' => 'view', $patients_id]);
            }
            $this->Flash->error(__('The patient could not be saved. Please, try again.'));
        }
        $sicknesses = $this->Patients->Diseaseds->Sicknesses->find('list', ['limit' => 200]);
        $patientSexes = $this->Patients->PatientSexes->find('list', ['limit' => 200]);
        $this->set(compact('patient', 'sicknesses', 'patientSexes'));
    }

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
        $patientSexes = $this->Patients->PatientSexes->find('list', ['limit' => 200]);
        $this->set(compact('patient', 'patientSexes'));
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
        /*
         * 承認不要
         */
        $this->Authorization->skipAuthorization();

        //検索結果用
        //get取得
        $data = $this->request->getQuery();
        $data_p = print_r($this->request->getQuery(), true);
        if($this->request->is("get") && $data != null)
        {
            $sicknesses_flag = false;
            $symptoms_flag = false;
            $this->loadModels(["Sicknesses", "InterviewSymptoms", "SymptomsLocations", "Diseaseds"]);
        
            /*
             * 部位が含まれていれば(location)
             */
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
                    /*
                     * 病名はOR検索
                     */
                    
                    $values = array_map("intval", $value);

                    /*
                     * サブクエリー
                     */
                    $sub_query = $this->Patients->getAssociation("Diseaseds")->find()
                        ->select(["patients_id"])
                        ->distinct()
                        ->where(["Diseaseds.sicknesses_id in" => $values]);

                    /*
                     *クエリー
                     */
                    $patients = $this->Patients->find()
                        ->where(["patients_id in" => $sub_query]);

                    $sicknesses_flag = true;

                }
                else if($key == "symptoms_id")
                {
                    /*
                     * 症状のみではAND検索
                     * 部位ありなら症状は１つのみ
                     * 症状複数なら部位無し
                     */
                    $values = array_map("intval", $value);

                    /*
                     * 症状が選択されている場合
                     */
                    if($locations_flag)
                    {
                        /*
                         * 部位ありなら部位の値も含めてクエリ作成するのでforeach()後
                         */
                        $symptoms_values = array_pop($values);
                        //$symptoms_values_r = $symptoms_values;
                        //$this->log("---symptoms_values---", LOG_DEBUG);
                        //$this->log(print_r($symptoms_values_r, true), LOG_DEBUG);
                    }
                    else
                    {
                        /*
                         * サブクエリー
                         * select diseaseds.diseaseds_id from diseaseds 
                         *   -> right join interview_symptoms 
                         *        on diseaseds.diseaseds_id = interview_symptoms.diseaseds_id 
                         *   -> where interview_symptoms.symptoms_id in ($values) 
                         *   -> group by diseaseds.diseaseds_id 
                         *   -> having count(diseaseds.diseaseds_id >= count($values));
                         */
                        //$this->log("---not symptoms_values---", LOG_DEBUG);
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

                        /*
                         * select diseaseds.patients_id from diseaseds 
                         *   -> right join interview_symptoms 
                         *        on diseaseds.diseaseds_id = interview_symptoms.diseaseds_id 
                         *   -> where diseaseds.diseaseds_id in ($sub_sub_query) 
                         *        and interview_symptoms.symptoms_id in ($values) 
                         *   -> group by diseaseds.patients_id 
                         *   -> having count(diseaseds.patients_id) >= count($values);
                         */
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
                    $values = array_map("intval", $value);
                    $locations_values = $values;
                    //$locations_values_p = $values;
                    //$this->log("---locations_values---", LOG_DEBUG);
                    //$this->log(print_r($locations_values_p, true), LOG_DEBUG);
                }

                if($locations_flag)
                {
                    $sub_query = $this->Diseaseds->find()
                        ->select(["patients_id"])
                        ->join([
                            "i" => [
                                "table" => "interview_symptoms",
                                "type" => "INNER",
                                "conditions" => "Diseaseds.diseaseds_id = i.diseaseds_id"
                            ],
                            "sl" => [
                                "table" => "symptoms_locations",
                                "type" => "INNER",
                                "conditions" => "i.interview_symptoms_id = sl.interview_symptoms_id"
                            ],
                        ])
                        ->where(["i.symptoms_id" => $symptoms_values])
                        ->where(["sl.locations_id in" => $locations_values])
                        ->group(["patients_id"]);
                    /*
                    $sub_sub_query = $this->SymptomsLocations->find()
                        ->select(["interview_symptoms_id"])
                        ->distinct()
                        ->where(["SymptomsLocations.locations_id in" => $locations_values]);

                    $sub_query = $this->InterviewSymptoms->find()
                        ->select(["patients_id"])
                        ->distinct()
                        ->where(["interview_symptoms_id in" => $sub_sub_query])
                        ->where(["InterviewSymptoms.symptoms_id in" => $symptoms_values]);
                     */

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
            //$this->paginate = [
            //    'contain' => ['PatientSexes', "Diseaseds.Sicknesses"],
            //];
            $this->paginate = [
                'contain' => [
                    'PatientSexes', 
                    "Diseaseds.Sicknesses",
                    "Diseaseds.InterviewSymptoms.Symptoms",
                    "Diseaseds.InterviewSymptoms.SymptomsLocations.Locations",
                ],
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

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        /*
         * Patientsのindexとviewは認証不要
         */
        $this->Authentication->addUnauthenticatedActions(["index", "view", "search"]);
    }
}
