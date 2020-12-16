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

        $this->loadModels(["Patients"]);

        /*
         * 最近の記事
         */
        $patients = $this->Patients->find("RecentInterview");

        $login_user = $this->Authentication->getIdentity();
        $this->set(compact("patients", "login_user"));
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
