<?php
declare(strict_types=1);

namespace App\Controller;

class BulletinBoardsController extends AppController
{
    public function index()
    {
        $this->Authorization->skipAuthorization();

        $this->loadModels(["Patients", "Articles", "BulletinBoardComments"]);
        $bulletinBoards = $this->BulletinBoards->find("ContainCommentModified");
        $this->paginate = [
            "limit" => 20,
        ];
        $bulletinBoards = $this->paginate($bulletinBoards);
        $recently_patients = $this->Patients->find("RecentInterview");
        $recently_articles = $this->Articles->find("RecentArticles");

        $this->set(compact('bulletinBoards', "recently_patients", "recently_articles"));
    }

    public function view($id = null)
    {
        $this->Authorization->skipAuthorization();
        $bulletinBoard = $this->BulletinBoards->get($id);
        $this->loadModels(["BulletinBoardComments"]);
        $bulletinBoardComments = $this->BulletinBoardComments->find()
            ->where(["bulletin_boards_id" => $id]);
        $this->paginate = [
            "limit" => 20,
        ];
        $page_number = $this->request->getQuery("page");
        $bulletinBoardComments = $this->paginate($bulletinBoardComments);
        $this->loadModels(["Patients", "Articles", "BulletinBoardComments"]);
        $bulletinBoardComment = $this->BulletinBoardComments->newEmptyEntity();
        $recently_patients = $this->Patients->find("RecentInterview");
        $recently_articles = $this->Articles->find("RecentArticles");

        $this->set(compact('bulletinBoard', "bulletinBoardComment", "bulletinBoardComments", "recently_patients", "recently_articles", "page_number"));
    }

    public function add()
    {
        $this->Authorization->skipAuthorization();
        $bulletinBoard = $this->BulletinBoards->newEmptyEntity();
        if ($this->request->is('post')) {
            $bulletinBoard = $this->BulletinBoards->patchEntity($bulletinBoard, $this->request->getData());
            if ($this->BulletinBoards->save($bulletinBoard)) {
                return $this->redirect(['action' => 'index']);
            }
            $this->DbLog->bulletinBoardError("BulletinBoards", "add");
            $this->SaveError->errorFlash();
            return $this->redirect(["controller" => "top", 'action' => "index"]);
        }
        $this->loadModels(["Patients", "Articles"]);
        $recently_patients = $this->Patients->find("RecentInterview");
        $recently_articles = $this->Articles->find("RecentArticles");
        $this->set(compact('bulletinBoard', "recently_patients", "recently_articles"));
    }

    public function edit($id = null)
    {
        $bulletinBoard = $this->BulletinBoards->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bulletinBoard = $this->BulletinBoards->patchEntity($bulletinBoard, $this->request->getData());
            if ($this->BulletinBoards->save($bulletinBoard)) {
                $this->Flash->success(__('The bulletin board has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bulletin board could not be saved. Please, try again.'));
        }
        $this->set(compact('bulletinBoard'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bulletinBoard = $this->BulletinBoards->get($id);
        if ($this->BulletinBoards->delete($bulletinBoard)) {
            $this->Flash->success(__('The bulletin board has been deleted.'));
        } else {
            $this->Flash->error(__('The bulletin board could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        /*
         * Patientsのindexとviewは認証不要
         */
        $this->Authentication->addUnauthenticatedActions(["index", "view", "add"]);
    }
}
