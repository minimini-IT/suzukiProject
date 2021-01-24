<?php
declare(strict_types=1);

namespace App\Controller;

class TopController extends AppController
{
    public function index()
    {
        $this->Authorization->skipAuthorization();

        $this->loadModels(["Patients", "Articles"]);

        $recently_patients = $this->Patients->find("RecentInterview");
        $recently_articles = $this->Articles->find("RecentArticles");

        $login_user = $this->Authentication->getIdentity();
        $this->set(compact("recently_patients", "login_user", "recently_articles"));
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        /*
         * Topは認証不要
         * すべてのアクション
         */
        $this->Authentication->addUnauthenticatedActions(["index"]);
    }
}
