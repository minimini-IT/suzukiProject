<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use Cake\Log\DbLog;

class ArticlesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $controller = $this->request->getParam("controller");
    }

    public function index()
    {
        $this->Authorization->skipAuthorization();

        $this->loadModels(["Patients", "Sicknesses", "Symptoms", "Locations"]);

        $articles = $this->Articles->find("ListContain");

        $this->paginate = [
            "limit" => 5,
            "order" => ["articles_id" => "desc"],
        ];

        $articles = $this->paginate($articles);

        $recently_patients = $this->Patients->find("RecentInterview");
        $recently_articles = $this->Articles->find("RecentArticles");

        $sicknesses = $this->Sicknesses->find('list', ['limit' => 200]);
        $symptoms = $this->Symptoms->find('list', ['limit' => 200]);
        $locations = $this->Locations->find('list', ['limit' => 200]);

        $this->set(compact('articles', "sicknesses", "symptoms", "locations", "recently_patients", "recently_articles"));
    }

    public function view($id = null)
    {
        $article = $this->Articles->get($id, [
            "finder" => "ListContain"
        ]);

        $attr_list = array();
        if(count($article->related_sicknesses) > 0)
        {
            foreach($article->related_sicknesses as $sick) 
            {
                $type = "sicknesses";
                array_push($attr_list, $sick->sicknesses_id);
            }
        }
        elseif(count($article->related_symptoms) > 0)
        {
            foreach($article->related_symptoms as $symptoms) 
            {
                $type = "symptoms";
                array_push($attr_list, $symptoms->symptoms_id);
            }
        }
        elseif(count($article->related_locations) > 0)
        {
            foreach($article->related_locations as $location) 
            {
                $type = "locations";
                array_push($attr_list, $location->locations_id);
            }
        }

        $this->loadModels(["RelatedSicknesses", "RelatedSymptoms", "RelatedLocations", "Patients"]);
        $related_articles = $this->Articles
            ->find("RelatedList", ["articles_id" => $id, "sub_query" => $attr_list, "type" => $type]);
        $related_patients = $this->Patients
            ->find("RelatedList", ["patients_id" => 0, "sub_query" => $attr_list, "type" => $type]);
        $this->set(compact('article', "related_patients", "related_articles"));
    }

    public function add()
    {
        $article = $this->Articles->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();

            global $controller;
            $user = $this->Authentication->getIdentity();
            $action = $this->request->getParam("action");
            
            /*
             * RelatedSicknesses
             * RelatedSymptoms
             * RelatedLocations 
             * それぞれの登録用にデータを加工
             */
            $attribute = [
                "relatedSicknessesAdd" => "sicknesses_id", 
                "relatedSymptomsAdd" => "symptoms_id", 
                "relatedLocationsAdd" => "locations_id"
            ];
            $post_id = $this->relatedGet($data, $attribute);

            $article = $this->Articles->patchEntity($article, $data);
            if ($this->Articles->save($article)) 
            {
                $update_time = $article->modified;
                $save_log = [
                    "articles_id" => $article->articles_id,
                    "action" => $action,
                    "management_users_id" => $user->management_users_id,
                    "datetime" => $update_time->format("Y-m-d H:i:s"),
                ];
                $this->DbLog->saveClear($save_log);
                $articles_id = $article->articles_id;

                /*
                 * RelatedSicknesses
                 * RelatedSymptoms
                 * RelatedLocations
                 * に関連する病名を登録
                 */
                $this->relatedProcessing($articles_id, $user, $attribute, $post_id);

                return $this->redirect(['action' => 'view', $articles_id]);
            }
            $this->DbLog->saveError($controller, $action, $user);
            $this->SaveError->errorFlash();

            return $this->redirect(["controller" => "top", 'action' => 'index']);
        }
        $this->loadModels(["Sicknesses", "Symptoms", "Locations"]);
        $sicknesses = $this->Sicknesses->find('list', ['limit' => 200]);
        $symptoms = $this->Symptoms->find('list', ['limit' => 200]);
        $locations = $this->Locations->find('list', ['limit' => 200]);
        $this->set(compact('article', "sicknesses", "symptoms", "locations"));
    }

    public function edit($id = null)
    {
        $article = $this->Articles->get($id, [
            "finder" => "DisplayList"
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) 
        {
            global $controller;
            $user = $this->Authentication->getIdentity();
            $action = $this->request->getParam("action");

            $data = $this->request->getData();
            /*
             * RelatedSicknesses
             * RelatedSymptoms
             * RelatedLocations 
             * それぞれの登録用にデータを加工
             */
            $attribute = [
                "relatedSicknessesAdd" => "sicknesses_id", 
                "relatedSymptomsAdd" => "symptoms_id", 
                "relatedLocationsAdd" => "locations_id"
            ];
            $post_id = $this->relatedGet($data, $attribute);

            $article = $this->Articles->patchEntity($article, $data);
            if ($this->Articles->save($article)) {
                $update_time = $article->modified;
                $save_log = [
                    "articles_id" => $id,
                    "action" => $action,
                    "management_users_id" => $user->management_users_id,
                    "datetime" => $update_time->format("Y-m-d H:i:s"),
                ];
                $this->DbLog->saveClear($save_log);

                $articles_id = $article->articles_id;

                /*
                 * RelatedSicknesses
                 * RelatedSymptoms
                 * RelatedLocations
                 * に関連する病名を登録
                 */
                $this->relatedProcessing($articles_id, $user, $attribute, $post_id);

                return $this->redirect(['action' => 'index']);
            }
            $this->DbLog->saveError($controller, $action, $user);
            $this->SaveError->errorFlash();
        }

        $this->loadModels(["Sicknesses", "RelatedSicknesses","Symptoms", "RelatedSymptoms","Locations","RelatedLocations"]);

        $sub_query = $this->RelatedSicknesses->find("RelatedSickness", ["articles_id" => $id]);
        $not_entered_sicknesses = $this->Sicknesses
            ->find("NotIncluded", ["sub_query" => $sub_query])->find('list', ['limit' => 200]);

        $sub_query = $this->RelatedSymptoms->find("RelatedSymptoms", ["articles_id" => $id]);
        $not_entered_symptoms = $this->Symptoms
            ->find("NotEnteredSymptoms", ["sub_query" => $sub_query])->find('list', ['limit' => 200]);

        $sub_query = $this->RelatedLocations->find("RelatedLocation", ["articles_id" => $id]);
        $not_entered_locations = $this->Locations
            ->find("NotEnteredLocations", ["sub_query" => $sub_query])->find('list', ['limit' => 200]);

        $this->set(compact('article', "not_entered_sicknesses", "not_entered_symptoms", "not_entered_locations"));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        global $controller;
        $user = $this->Authentication->getIdentity();
        $action = $this->request->getParam("action");
        $article = $this->Articles->get($id);
        $articles_id = $article->articles_id;

        if ($this->Articles->delete($article)) 
        {
            $params = [
                "articles_id" => $articles_id,
                "action" => $action,
                "management_users_id" => $user->management_users_id,
                "datetime" => date("Y-m-d H:i:s"),
            ];
            $this->DbLog->saveClear($params);
        } else {
            $this->DbLog->saveError($controller, $action, $user);
            $this->SaveError->errorFlash();
            return $this->redirect(["controller" => "top", 'action' => 'index']);
        }

        return $this->redirect(['action' => 'select']);
    }

    public function search()
    {
        $this->Authorization->skipAuthorization();

        $data = $this->request->getQuery();
        if($this->request->is("get") && $data != null)
        {

            $this->loadModels(["Patients", "Sicknesses", "Symptoms", "Locations"]);
            $attr_list = [
                "sicknesses_id" => "Sicknesses", 
                "symptoms_id" => "Symptoms", 
                "locations_id" => "Locations"
            ];

            /*
             * elementは
             * sickness, symptoms, locaitonsのいずれか
             */
            foreach($attr_list as $id => $model)
            {
                if(array_key_exists($id, $data))
                {
                    $values = array_map("intval", $data[$id]);

                    //$element = $this->$model->find("Search{$model}Element", ["values" => $values]);
                    $element = $this->$model->find("Get{$model}Name", ["values" => $values]);
                    $articles = $this->Articles->find("SearchAttribute", ["values" => $values, "type" => mb_strtolower($model)])->find("DisplayList");
                    break;
                }
            }
            $this->paginate = [
                "limit" => 5,
                "order" => ["articles_id" => "desc"],
            ];

            $articles = $this->paginate($articles);
        }
        else
        {
            return $this->redirect(["controller" => "Top", 'action' => 'index']);
        }

        $recently_patients = $this->Patients->find("RecentInterview");
        $recently_articles = $this->Articles->find("RecentArticles");

        $sicknesses = $this->Sicknesses->find('list', ['limit' => 200]);
        $symptoms = $this->Symptoms->find('list', ['limit' => 200]);
        $locations = $this->Locations->find('list', ['limit' => 200]);

        $this->set(compact("articles", "recently_patients", "recently_articles", "element", "sicknesses", "symptoms", "locations"));
    }

    public function select()
    {
        $articles = $this->Articles->find("ListContain");

        $this->paginate = [
            "limit" => 10,
            "order" => ["articles_id" => "desc"],
        ];
        $articles = $this->paginate($articles);

        $this->set(compact('articles'));
    }

    public function selectSearch()
    {
        $data = $this->request->getQuery();
        if($this->request->is("get") && $data["title"] != null)
        {
            $title = $data["title"];
            $articles = $this->Articles->find("TitleSearch", ["title" => $title]);

            $this->paginate = [
                "limit" => 5,
                "order" => ["articles_id" => "desc"],
            ];
            $articles = $this->paginate($articles);

            $this->set(compact('articles'));
        }
        else
        {
            return $this->redirect(['action' => 'select']);
        }
    }

    public function relatedLocationsAdd(int $articles_id, array $locations_id, $user)
    {
        global $controller;
        $action = $this->request->getParam("action");
        $this->loadModels(["RelatedLocations"]);

        $locations_entity = array();
        foreach($locations_id as $id)
        {
            $entity = ["articles_id" => $articles_id, "locations_id" => $id];
            array_push($locations_entity, $entity);
        }
        $related_locations = $this->RelatedLocations->newEntities($locations_entity);
        $related_locations = $this->RelatedLocations->patchEntities($related_locations, $locations_entity);

        if(!$this->RelatedLocations->saveMany($related_locations))
        {
            $this->DbLog->saveError($controller, $action, $user);
            $this->SaveError->errorFlash();
            return $this->redirect(["controller" => "top", 'action' => 'index']);
        }

        return;
    }

    public function relatedSymptomsAdd(int $articles_id, array $symptoms_id, $user)
    {
        global $controller;
        $action = $this->request->getParam("action");
        $this->loadModels(["RelatedSymptoms"]);

        $symptoms_entity = array();
        foreach($symptoms_id as $id)
        {
            $entity = ["articles_id" => $articles_id, "symptoms_id" => $id];
            array_push($symptoms_entity, $entity);
        }
        $related_symptoms = $this->RelatedSymptoms->newEntities($symptoms_entity);
        $related_symptoms = $this->RelatedSymptoms->patchEntities($related_symptoms, $symptoms_entity);

        if(!$this->RelatedSymptoms->saveMany($related_symptoms))
        {
            $this->DbLog->saveError($controller, $action, $user);
            $this->SaveError->errorFlash();
            return $this->redirect(["controller" => "top", 'action' => 'index']);
        }

        return;
    }

    public function relatedSicknessesAdd(int $articles_id, array $sicknesses_id, $user)
    {
        global $controller;
        $action = $this->request->getParam("action");
        $this->loadModels(["RelatedSicknesses"]);

        $sickness_entity = array();
        foreach($sicknesses_id as $id)
        {
            $entity = ["articles_id" => $articles_id, "sicknesses_id" => $id];
            array_push($sickness_entity, $entity);
        }
        $related_sickness = $this->RelatedSicknesses->newEntities($sickness_entity);
        $related_sickness = $this->RelatedSicknesses->patchEntities($related_sickness, $sickness_entity);

        if(!$this->RelatedSicknesses->saveMany($related_sickness))
        {
            $this->DbLog->saveError($controller, $action, $user);
            $this->SaveError->errorFlash();
            return $this->redirect(["controller" => "top", 'action' => 'index']);
        }

        return;
    }

    public function relatedGet($data, $attribute)
    {
        $post_id = null;
        foreach($attribute as $attr)
        {
            if(!empty($data[$attr]))
            {
                $post_id[$attr] = $data[$attr];
            }
        }
        return $post_id;
    }

    public function relatedProcessing($articles_id, $user, $attribute, $post_id)
    {
        if(!is_null($post_id))
        {
            foreach($attribute as $func => $attr)
            {
                if(array_key_exists($attr, $post_id))
                {
                    $this->$func($articles_id, $post_id[$attr], $user);
                }
            }
        }

        return;
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
