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
        $patients = $this->Patients->find("PatientsDisplayList");

        $this->paginate = [
            "limit" => 10,
            "order" => ["patients_id" => "asc"],
        ];
        $patients = $this->paginate($patients);

        /*
         * 最近の記事
         */
        $recently_patients = $this->Patients->find("RecentInterview");

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

            
        /*
         * patientsの詳細
         */
        $patient = $this->Patients->get($id, [
            "finder" => "ContainAll"
        ]);

        /*
         * 同じ病気の人を取得
         */
        $sub_query = $this->Patients->find("RelatedSicknessSub", ["patients_id" => $id]);
        $related_sickness = $this->Patients->find("RelatedSickness", ["patients_id" => $id, "sub_query" => $sub_query]);

        /*
         * 同じ症状の人を取得
         */
        $sub_query = $this->Patients->find("RelatedSymptomsSub", ["patients_id" => $id]);
        $related_symptoms = $this->Patients->find("RelatedSymptoms", ["patients_id" => $id, "sub_query" => $sub_query]);

        $this->set(compact('patient', "related_sickness", "related_symptoms"));
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

                $this->log("---add patinet save clear---", LOG_DEBUG);
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
                    $this->log("---add save patinet-related diseaseds clear---", LOG_DEBUG);
                    //$this->Flash->success(__('The diseased has been saved.'));
                    return $this->redirect(["controller" => "interview_symptoms", 'action' => 'add', $patients_id]);
                }
                else
                {
                    $this->log("---add patinet-related diseaseds error---", LOG_DEBUG);
                    $this->Flash->error(__('エラーが発生したので登録できませんでした。'));
                    $this->Flash->error(__('管理者へ報告してください。'));
                }
            }
            else
            {
                $this->log("---add patinet save error---", LOG_DEBUG);
                $this->Flash->error(__('エラーが発生したので登録できませんでした。'));
                $this->Flash->error(__('管理者へ報告してください。'));
            }
            return $this->redirect(["controller" => "top", 'action' => 'index']);
        }
        $sicknesses = $this->Patients->Diseaseds->Sicknesses->find('list', ['limit' => 200]);
        $patientSexes = $this->Patients->PatientSexes->find('list', ['limit' => 200]);
        $this->set(compact('patient', 'sicknesses', 'patientSexes'));
    }

    public function edit($id = null)
    {
        $patient = $this->Patients->get($id, [
            "finder" => "ContainEdit"
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $patient = $this->Patients->patchEntity($patient, $this->request->getData());
            if ($this->Patients->save($patient)) {
                $this->log("---edit save patients clear---", LOG_DEBUG);
                return $this->redirect(['action' => 'edit', $id]);
            }
            $this->log("---edit patinets error---", LOG_DEBUG);
            $this->Flash->error(__('エラーが発生したので登録できませんでした。'));
            $this->Flash->error(__('管理者へ報告してください。'));
            return $this->redirect(["controller" => "top", 'action' => 'index']);
        }

        /*
         * 病名、症状、部位
         * いずれかが未登録の場合は入力画面へリダイレクト
         */
        $attribute_status = $this->Patients->find("AttributeStatus", ["patients_id" => $id]);
        if($attribute_status->count() != 0)
        {
            foreach($attribute_status as $status)
            {
                if(is_null($status->d["diseaseds_id"]))
                {
                    return $this->redirect(["controller" => "diseaseds", 'action' => 'add', $id]);
                }
                else if(is_null($status->i["interview_symptoms_id"]))
                {
                    return $this->redirect(["controller" => "interview_symptoms", 'action' => 'add', $id]);
                }
                else if(is_null($status->sl["symptoms_locations_id"]))
                {
                    return $this->redirect(["controller" => "symptoms_locations", 'action' => 'add', $id]);
                }
            }
        }

        /*
         * 病名の登録数
         */
        $sickCount = $this->Patients->Diseaseds->Sicknesses->find("SickCount")->count();
        $patientSickCount = $this->Patients->Diseaseds->find("PatientsSickCount", ["patients_id" => $id])->count();
        $sickAddFlag = $sickCount > $patientSickCount ? true : false;

        $sicknesses = $this->Patients->Diseaseds->Sicknesses->find('list', ['limit' => 200]);
        $patientSexes = $this->Patients->PatientSexes->find('list', ['limit' => 200]);
        $this->set(compact('patient', 'patientSexes', "sicknesses", "sickAddFlag"));
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
        if($this->request->is("get") && $data != null)
        {
            $sicknesses_flag = false;
            $symptoms_flag = false;

            /*
             * location_element
             *   部位の検索要素
             *   病名のみ、症状のみの場合はいらないのでここで宣言
             */
            $location_element = null;

            /*
             * 部位が含まれていれば(location)
             */
            $locations_id_search = array_key_exists("locations_id", $data);
            if($locations_id_search)
            {
                $locations_flag = true;
                $locations_values = null;
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
                     * 検索要素
                     */
                    $element = $this->Patients
                        ->Diseaseds
                        ->Sicknesses
                        ->find("SearchSicknessElement", ["values" => $values]);

                    $patients = $this->Patients->find("SearchSickness", ["values" => $values]);

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
                     * 症状の検索要素 表示用
                     */
                    $element = $this->Patients
                        ->Diseaseds
                        ->InterviewSymptoms
                        ->Symptoms
                        ->find("SearchSymptomsElement", ["values" => $values]);

                    /*
                     * 部位が選択されている場合
                     */
                    if($locations_flag)
                    {
                        /*
                         * 部位ありなら部位の値も含めてクエリ作成するのでforeach()後
                         */
                        $symptoms_values = array_pop($values);
                    }
                    else
                    {
                        /*
                         * 症状のみの検索
                         * and検索
                         */
                        $sub_sub_query = $this->Patients
                            ->Diseaseds
                            ->find("SearchSymptomsOnrySubSub", ["values" => $values]);

                        $sub_query = $this->Patients
                            ->Diseaseds
                            ->find("SearchSymptomsOnrySub", [
                                "values" => $values, 
                                "sub_sub_query" => $sub_sub_query
                            ]);
                        
                        $patients = $this->Patients->find("SearchSymptomsOnry", ["sub_query" => $sub_query]);

                        $symptoms_flag = true;
                    }

                }
                else if($key == "locations_id")
                {
                    $values = array_map("intval", $value);

                    /*
                     * 部位検索要素 表示用
                     */
                    $location_element = $this->Patients
                        ->Diseaseds
                        ->InterviewSymptoms
                        ->SymptomsLocations
                        ->Locations
                        ->find("SearchLocationsElement", ["values" => $values]);

                    $locations_values = $values;
                }

                if($locations_flag)
                {
                    /*
                     * 症状１、部位複数の時の処理
                     */
                    $patients = $this->Patients
                        ->find("SearchSymptomsLocations", [
                            "symptoms_id" => $symptoms_values, 
                            "values" => $locations_values]
                        );
                }
            }
            $this->paginate = [
                'contain' => [
                    'PatientSexes', 
                    "Diseaseds.Sicknesses",
                ],
            ];
            $patients = $this->paginate($patients);
        }
        else
        {
            return $this->redirect(["controller" => "Top", 'action' => 'index']);
        }

        $recently_patients = $this->Patients->find("RecentInterview");

        /*
         * 検索用
         */
        $sicknesses = $this->Patients
            ->Diseaseds
            ->Sicknesses
            ->find('list', ['limit' => 200]);
        $symptoms = $this->Patients
            ->Diseaseds
            ->InterviewSymptoms
            ->Symptoms
            ->find('list', ['limit' => 200]);
        $locations = $this->Patients
            ->Diseaseds
            ->InterviewSymptoms
            ->SymptomsLocations
            ->Locations
            ->find('list', ['limit' => 200]);

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
            ],
        ];
        $patients = $this->paginate($this->Patients);

        $this->set(compact('patients'));
    }

    public function selectSearch()
    {
        $data = $this->request->getQuery();
        if($this->request->is("get") && $data["pen_name"] != null)
        {
            $pen_name = $data["pen_name"];
            $patients = $this->Patients->find("SelectSearch", ["pen_name" => $pen_name]);

            $this->paginate = [
                'contain' => [
                    'PatientSexes', 
                    "Diseaseds.Sicknesses",
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

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        /*
         * Patientsのindexとviewは認証不要
         */
        $this->Authentication->addUnauthenticatedActions(["index", "view", "search"]);
    }
}
