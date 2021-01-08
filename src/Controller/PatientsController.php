<?php
declare(strict_types=1);

namespace App\Controller;

class PatientsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $controller = $this->request->getParam("controller");
    }

    public function index()
    {
        $this->Authorization->skipAuthorization();

        $this->loadModels(["Sicknesses", "Symptoms", "Locations", "Articles"]);
        $patients = $this->Patients->find("PatientsDisplayList");
        $this->paginate = [
            "limit" => 5,
            "order" => ["patients_id" => "desc"],
        ];
        $patients = $this->paginate($patients);
        $recently_patients = $this->Patients->find("RecentInterview");
        $recently_articles = $this->Articles->find("RecentArticles");

        $sicknesses = $this->Sicknesses->find('list', ['limit' => 200]);
        $symptoms = $this->Symptoms->find('list', ['limit' => 200]);
        $locations = $this->Locations->find('list', ['limit' => 200]);

        $this->set(compact('patients', "recently_patients", "recently_articles", "sicknesses", "symptoms", "locations"));
    }

    public function view($id = null)
    {
        $this->Authorization->skipAuthorization();
        $this->loadModels(["Diseaseds", "Articles"]);
        $patient = $this->Patients->get($id, [
            "finder" => "ContainAll"
        ]);

        /*
         * 関連するインタビュー、記事は
         * 病名から検索する
         */
        $sickness_list = array();
        foreach($patient->diseaseds as $d)
        {
            array_push($sickness_list, $d->sicknesses_id);
        }

        $related_patients = $this->Patients
            ->find("RelatedList", ["patients_id" => $id, "sub_query" => $sickness_list, "type" => "sicknesses"]);
        $related_articles = $this->Articles
            ->find("RelatedList", ["articles_id" => 0, "sub_query" => $sickness_list, "type" => "sicknesses"]);

        $this->set(compact('patient', "related_patients", "related_articles"));
    }

    public function add()
    {
        $patient = $this->Patients->newEmptyEntity();
        if ($this->request->is('post')) {
            global $controller;
            $user = $this->Authentication->getIdentity();
            $action = $this->request->getParam("action");

            $data = $this->request->getData();
            $sicknesses_id = $data["sicknesses_id"];
            unset($data["sicknesses_id"]);

            $patient = $this->Patients->patchEntity($patient, $data);
            if ($this->Patients->save($patient)) {

                $patients_id = $patient->patients_id;
                $updateTime = $patient->modified;
                $saveLog = [
                    "patients_id" => $patients_id,
                    "action" => $action,
                    "management_users_id" => $user->management_users_id,
                    "datetime" => $updateTime->format("Y-m-d H:i:s"),
                ];
                $this->DbLog->saveClear($saveLog);

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
                    return $this->redirect(["controller" => "interview_symptoms", 'action' => 'add', $patients_id]);
                }
                else
                {
                    $this->DbLog->saveError("Diseaseds", "add", $user);
                    $this->SaveError->errorFlash();
                }
            }
            else
            {
                $this->DbLog->saveError($controller, $action, $user);
                $this->SaveError->errorFlash();
            }
            return $this->redirect(["controller" => "top", 'action' => 'index']);
        }
        $this->loadModels(["Sicknesses", "PatientSexes"]);
        $sicknesses = $this->Sicknesses
            ->find("AddPatientsSicknesses")->find('list', ['limit' => 200]);
        $patient_sexes = $this->PatientSexes
            ->find('list', ['limit' => 200]);
        $this->set(compact('patient', 'sicknesses', 'patient_sexes'));
    }

    public function edit($id = null)
    {
        $patient = $this->Patients->get($id, [
            "finder" => "ContainEdit"
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            global $controller;
            $user = $this->Authentication->getIdentity();
            $action = $this->request->getParam("action");

            $patient = $this->Patients->patchEntity($patient, $this->request->getData());
            if ($this->Patients->save($patient)) {
                $updateTime = $patient->modified;
                $saveLog = [
                    "patients_id" => $id,
                    "action" => $action,
                    "management_users_id" => $user->management_users_id,
                    "datetime" => $updateTime->format("Y-m-d H:i:s"),
                ];
                $this->DbLog->saveClear($saveLog);
                return $this->redirect(['action' => 'view', $id]);
            }
            $this->DbLog->saveError($controller, $action, $user);
            $this->SaveError->errorFlash();
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
        $this->loadModels(["Sicknesses", "Diseaseds", "PatientSexes"]);
        $sick_count = $this->Sicknesses
            ->find("SickCount")->count();
        $patient_sick_count = $this->Diseaseds
            ->find("PatientsSickCount", ["patients_id" => $id])->count();
        $sick_add_flag = $sick_count > $patient_sick_count ? true : false;

        $sicknesses = $this->Sicknesses->find('list', ['limit' => 200]);
        $patient_sexes = $this->PatientSexes->find('list', ['limit' => 200]);
        $this->set(compact('patient', 'patient_sexes', "sicknesses", "sick_add_flag"));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        global $controller;
        $user = $this->Authentication->getIdentity();
        $action = $this->request->getParam("action");
        $patient = $this->Patients->get($id);
        $patients_id = $patient->patients_id;

        if ($this->Patients->delete($patient)) {
            $params = [
                "patients_id" => $patients_id,
                "action" => $action,
                "management_users_id" => $user->management_users_id,
                "datetime" => date("Y-m-d H:i:s"),
            ];
            $this->DbLog->saveClear($params);
            return $this->redirect(['action' => 'select']);
        }
        $this->DbLog->saveError($controller, $action, $user);
        $this->SaveError->errorFlash();
        return $this->redirect(["controller" => "top", 'action' => 'index']);
    }

    public function search()
    {
        $this->Authorization->skipAuthorization();

        $data = $this->request->getQuery();
        if($this->request->is("get") && $data != null)
        {
            if(array_key_exists("locations_id", $data))
            {
                $locations_flag = true;
            }
            else
            {
                $locations_flag = false;
                $location_element = null;
            }

            foreach($data as $key => $value)
            {
                if($key == "sicknesses_id")
                {
                    /*
                     * 病名はOR検索
                     */
                    $values = array_map("intval", $value);

                    $this->loadModels(["Sicknesses"]);
                    $element = $this->Sicknesses
                        ->find("GetSicknessesName", ["values" => $values]);

                    $patients = $this->Patients->find("SearchedBySicknesses", ["values" => $values]);

                    break;
                }
                else if($key == "symptoms_id")
                {
                    /*
                     * 症状のみではAND検索
                     * 部位ありなら症状は１つのみ
                     * 症状複数なら部位無し
                     */
                    $values = array_map("intval", $value);

                    $this->loadModels(["Symptoms"]);
                    $element = $this->Symptoms
                        ->find("GetSymptomsName", ["values" => $values]);

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
                        $patients = $this->Patients->find("SearchedBySymptoms", ["values" => $values]);
                    }

                }
                else if($key == "locations_id")
                {
                    $values = array_map("intval", $value);

                    /*
                     * 部位検索要素 表示用
                     */
                    $this->loadModels(["Locations"]);
                    $location_element = $this->Locations
                        ->find("GetLocationsName", ["values" => $values]);

                    $locations_values = $values;
                }
            }
            if($locations_flag)
            {
                /*
                 * 症状１、部位複数の時の処理
                 */
                $patients = $this->Patients
                    ->find("SearchSymptomsLocations", [
                        "symptoms_id" => $symptoms_values, 
                        "values" => $locations_values
                    ]);
            }
            $this->paginate = [
                'contain' => [
                    'PatientSexes', 
                    "Diseaseds.Sicknesses",
                ],
                "limit" => 5,
                "order" => ["patients_id" => "desc"],
            ];
            $patients = $this->paginate($patients);
        }
        else
        {
            return $this->redirect(["controller" => "top", 'action' => 'index']);
        }

        $this->loadModels(["Articles", "Sicknesses", "Symptoms", "Locations"]);
        $recently_patients = $this->Patients->find("RecentInterview");
        $recently_articles = $this->Articles->find("RecentArticles");
        $sicknesses = $this->Sicknesses->find('list', ['limit' => 200]);
        $symptoms = $this->Symptoms->find('list', ['limit' => 200]);
        $locations = $this->Locations->find('list', ['limit' => 200]);

        $this->set(compact("patients", "recently_patients", "recently_articles", "element", "location_element", "sicknesses", "symptoms", "locations"));
    }

    public function select()
    {
        $this->paginate = [
            'contain' => [
                'PatientSexes', 
                "Diseaseds.Sicknesses",
            ],
            "limit" => 5,
            "order" => ["patients_id" => "desc"],
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
                "limit" => 5,
                "order" => ["patients_id" => "desc"],

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
