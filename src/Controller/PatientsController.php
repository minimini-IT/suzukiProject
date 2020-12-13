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

        $this->loadModels(["Sicknesses", "Symptoms", "Locations"]);

        /*
         * 病名、症状、部位が未記入の場合は一覧に出ない
         */
        $patients = $this->Patients->find()
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
            ->group(["Patients.patients_id"]);

        $this->paginate = [
            'contain' => [
                'PatientSexes', 
                "Diseaseds.Sicknesses",
                "Diseaseds.InterviewSymptoms.Symptoms",
                "Diseaseds.InterviewSymptoms.SymptomsLocations.Locations",
            ],
            "limit" => 10,
            "order" => ["patients_id" => "asc"],
        ];
        $patients = $this->paginate($patients);

        $recently_patients = $this->Patients->find()
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

        /*
         * 検索用
         */
        $sicknesses = $this->Sicknesses->find('list', ['limit' => 200]);
        $symptoms = $this->Symptoms->find('list', ['limit' => 200]);
        $locations = $this->Locations->find('list', ['limit' => 200]);

        $this->set(compact('patients', "recently_patients", "sicknesses", "symptoms", "locations"));
    }

    public function view($id = null)
    {
        /*
         * 承認不要
         */
        $this->Authorization->skipAuthorization();

            
        $patient = $this->Patients->get($id, [
            'contain' => [
                'PatientSexes', 
                "Diseaseds.InterviewSymptoms.Symptoms", 
                "Diseaseds.Sicknesses", 
                "Diseaseds.InterviewSymptoms.SymptomsLocations.Locations"
            ],
        ]);
        
        /*
         * 病名が登録されているか
         */


        /*
         * 病名に対する部位の数と
         * 症状に対する部位の数を調べる
         */
        $this->loadModels(["Diseaseds"]);
        $diseaseds = $this->Diseaseds;
        $table_sickness_row = $this->table_sickness_row($diseaseds, $id);
        $table_symptoms_row = $this->table_symptoms_row($diseaseds, $id);

        /*
         * 同じ病気、症状の人を取得
         */
        $sub_sickness_query = $this->Diseaseds->find()
            ->select(["sicknesses_id"])
            ->where(["patients_id" => $id]);

        $sub_symptoms_query = $this->Diseaseds->find()
            ->select(["i.symptoms_id"])
            ->join([
                "i" => [
                    "table" => "interview_symptoms",
                    "type" => "LEFT",
                    "conditions" => "Diseaseds.diseaseds_id = i.diseaseds_id"
                ],
            ])
            ->where(["patients_id" => $id]);

        $relation_patients = $this->Patients->find()
            ->select(["Patients.patients_id", "pen_name"])
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
            ->where(["OR" => ["d.sicknesses_id in" => $sub_sickness_query, "i.symptoms_id in" => $sub_symptoms_query]])
            ->where(["Patients.patients_id !=" => $id])
            ->group(["Patients.patients_id"])
            ->limit(10)
            ->order(["rand()"]);

        $this->set(compact('patient', "relation_patients", "table_sickness_row", "table_symptoms_row"));
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

                $this->log("---patinet save clear---", LOG_DEBUG);

                //$this->Flash->success(__('The patient has been saved.'));
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
                    $this->log("---save patinet-related diseaseds clear---", LOG_DEBUG);
                    //$this->Flash->success(__('The diseased has been saved.'));
                    return $this->redirect(["controller" => "interview_symptoms", 'action' => 'add', $patients_id]);
                }
                else
                {
                    $this->log("---patinet-related diseaseds error---", LOG_DEBUG);
                    $this->Flash->error(__('エラーが発生したので登録できませんでした。'));
                    $this->Flash->error(__('管理者へ報告してください。'));
                }
            }
            else
            {
                $this->log("---patinet save error---", LOG_DEBUG);
                $this->Flash->error(__('エラーが発生したので登録できませんでした。'));
                $this->Flash->error(__('管理者へ報告してください。'));
            }
        }
        $sicknesses = $this->Patients->Diseaseds->Sicknesses->find('list', ['limit' => 200]);
        $patientSexes = $this->Patients->PatientSexes->find('list', ['limit' => 200]);
        $this->set(compact('patient', 'sicknesses', 'patientSexes'));
    }

    public function edit($id = null)
    {
        /*
         * 病名の登録状況確認
         * 未記入であれば入力フォームへ飛ぶ
         */
        $sick = $this->Patients->Diseaseds->find()
            ->select(["diseaseds_id"])
            ->where(["patients_id" => $id])
            ->count();
        /*
         * 病名未登録の場合は入力フォームへ
         */
        if($sick == 0)
        {
            return $this->redirect(["controller" => "diseaseds", 'action' => 'add', $id]);
        }

        /*
         * 症状の登録状態の確認
         * 未記入であれば入力フォームへ飛ぶ
         * patients_idから病気の症状を取得
         *
         * 症状の次は各症状に対する部位の確認
         * すべて入力済みならばview表示
         */
        $sub_query = $this->Patients->Diseaseds->find()
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
                "Diseaseds.InterviewSymptoms.Symptoms", 
                "Diseaseds.Sicknesses", 
                "Diseaseds.InterviewSymptoms.SymptomsLocations.Locations"
            ],
        ]);

        /*
         * 病名、症状、部位のテーブル用
         *
         * sicknessesの数
         * symptoms_locationsの数
         */
        $this->loadModels(["Diseaseds"]);
        $diseaseds = $this->Diseaseds;
        $table_sickness_row = $this->table_sickness_row($diseaseds, $id);
        $table_symptoms_row = $this->table_symptoms_row($diseaseds, $id);


        if ($this->request->is(['patch', 'post', 'put'])) {
            $patient = $this->Patients->patchEntity($patient, $this->request->getData());
            if ($this->Patients->save($patient)) {
                $this->Flash->success(__('The patient has been saved.'));

                return $this->redirect(['action' => 'select']);
            }
            $this->Flash->error(__('The patient could not be saved. Please, try again.'));
        }
        /*
         * 病名の登録数
         */
        $sickCount = $this->Patients->Diseaseds->Sicknesses->find()
            ->select("sicknesses_id")
            ->count();
        $sicknesses = $this->Patients->Diseaseds->Sicknesses->find('list', ['limit' => 200]);
        $patientSexes = $this->Patients->PatientSexes->find('list', ['limit' => 200]);
        $this->set(compact('patient', 'patientSexes', "sicknesses", "table_sickness_row", "table_symptoms_row", "sickCount"));
    }

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
        //$data_p = print_r($this->request->getQuery(), true);
        //$this->log("---data---", LOG_DEBUG);
        //$this->log(print_r($data_p, true), LOG_DEBUG);
        if($this->request->is("get") && $data != null)
        {
            $sicknesses_flag = false;
            $symptoms_flag = false;
            $location_element = null;
            $this->loadModels(["Sicknesses", "Symptoms", "Locations", "InterviewSymptoms", "SymptomsLocations", "Diseaseds"]);
        
            /*
             * 部位が含まれていれば(location)
             */
            $locations_id_search = array_key_exists("locations_id", $data);
            if($locations_id_search)
            {
                $locations_flag = true;
                $locations_values = "null";
            }
            else
            {
                $locations_flag = false;
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
                     * 検索要素 表示用
                     */
                    $element = $this->Sicknesses->find()
                        ->where(["sicknesses_id in" => $values])
                        ->select(["alias" => "sickness_name"]);

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
                     * 検索要素 表示用
                     */
                    $element = $this->Symptoms->find()
                        ->where(["symptoms_id in" => $values])
                        ->select(["alias" => "symptoms"]);
                    //$this->log("---element---", LOG_DEBUG);
                    //$this->log(print_r($element, true), LOG_DEBUG);

                    /*
                     * 症状が選択されている場合
                     */
                    if($locations_flag)
                    {
                        /*
                         * 部位ありなら部位の値も含めてクエリ作成するのでforeach()後
                         */
                        $symptoms_values = array_pop($values);

                        //$location_add_element = array();
                        //$location_add_element["alias"] = array();
                        //foreach($element as $val)
                        //{
                        //    array_push($location_add_element["alias"], $val);
                        //}
                        //$element = $location_add_element;
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
                        $sub_sub_query = $this->Diseaseds->find()
                            ->select(["Diseaseds.diseaseds_id"])
                            ->join([
                                "i" => [
                                    "table" => "interview_symptoms",
                                    "type" => "RIGHT",
                                    "conditions" => "Diseaseds.diseaseds_id = i.diseaseds_id"
                                ],
                            ])
                            ->group(["Diseaseds.diseaseds_id"])
                            ->having(["count(Diseaseds.diseaseds_id) >=" => count($values)])
                            ->where(["i.symptoms_id in" => $values]);

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
                            ->where(["i.symptoms_id in" => $values]);
                        
                        $patients = $this->Patients->find()
                            ->where(["patients_id in" => $sub_query]);

                        $symptoms_flag = true;
                    }

                }
                else if($key == "locations_id")
                {
                    $values = array_map("intval", $value);

                    /*
                     * 検索要素 表示用
                     */
                    $location_element = $this->Locations->find()
                        ->where(["locations_id in" => $values])
                        ->select(["alias" => "location"]);

                    $locations_values = $values;
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

                    $patients = $this->Patients->find()
                        ->where(["patients_id in" => $sub_query]);

                }
            }
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

        $recently_patients = $this->Patients->find()
            ->order(["modified" => "DESC"])
            ->limit(5);

        /*
         * 検索用
         */
        $sicknesses = $this->Sicknesses->find('list', ['limit' => 200]);
        $symptoms = $this->Symptoms->find('list', ['limit' => 200]);
        $locations = $this->Locations->find('list', ['limit' => 200]);

        $this->set(compact("patients", "recently_patients", "element", "location_element", "sicknesses", "symptoms", "locations"));
    }

    /*
     * 編集選択用
     */
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

    public function selectSearch()
    {
        $data = $this->request->getQuery();
        //$this->log("---data---", LOG_DEBUG);
        //$this->log(print_r($data, true), LOG_DEBUG);
        if($this->request->is("get") && $data["pen_name"] != null)
        {
            $patients = $this->Patients->find()
                ->where(["pen_name" => $data["pen_name"]]);

            $this->paginate = [
                'contain' => [
                    'PatientSexes', 
                    "Diseaseds.Sicknesses",
                    "Diseaseds.InterviewSymptoms.Symptoms",
                    "Diseaseds.InterviewSymptoms.SymptomsLocations.Locations",
                ],
            ];
            $patients = $this->paginate($patients);

            $this->set(compact('patients'));
        }
        else
        {
            return $this->redirect(['action' => 'select']);
        }

    }

    public function table_sickness_row($diseaseds, $id)
    {
        $query = $diseaseds->find()
            ->select(["diseaseds_id" => "Diseaseds.diseaseds_id", "count_locations_id" => "count(sl.locations_id)"])
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
            ->where(["patients_id" => $id])
            ->group(["Diseaseds.diseaseds_id"]);

        $table_row = array();
        foreach($query as $row)
        {
            $table_row[$row->diseaseds_id] = $row->count_locations_id;
        }

        return $table_row;
    }

    public function table_symptoms_row($diseaseds, $id)
    {
        $query = $diseaseds->find()
            ->select(["interview_symptoms_id" => "i.interview_symptoms_id", "count_locations_id" => "count(sl.locations_id)"])
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
            ->where(["patients_id" => $id])
            ->group(["i.interview_symptoms_id"]);

        $table_row = array();
        foreach($query as $row)
        {
            $table_row[$row->interview_symptoms_id] = $row->count_locations_id;
        }
        return $table_row;
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
