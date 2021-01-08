<?php
declare(strict_types=1);

namespace App\Controller;

class TopController extends AppController
{
    public function index()
    {
        /*
         * 承認不要
         */
        $this->Authorization->skipAuthorization();

        $this->loadModels(["Patients", "Articles"]);

        /*
         * 最近の記事
         */
        //$patients = $this->Patients->find("RecentInterview");
        $recently_patients = $this->Patients->find("RecentInterview");

        /*
         * 最近の記事
         */
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
