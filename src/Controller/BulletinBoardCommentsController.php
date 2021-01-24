<?php
declare(strict_types=1);

namespace App\Controller;

class BulletinBoardCommentsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $controller = $this->request->getParam("controller");
    }

    public function index()
    {
        $this->paginate = [
            'contain' => ['BulletinBoards'],
        ];
        $bulletinBoardComments = $this->paginate($this->BulletinBoardComments);

        $this->set(compact('bulletinBoardComments'));
    }

    public function view($id = null)
    {
        $bulletinBoardComment = $this->BulletinBoardComments->get($id, [
            'contain' => ['BulletinBoards'],
        ]);

        $this->set(compact('bulletinBoardComment'));
    }

    public function add()
    {
        $this->Authorization->skipAuthorization();
        $bulletinBoardComment = $this->BulletinBoardComments->newEmptyEntity();
        if ($this->request->is('post')) {

            $data = $this->request->getData();
            $bulletin_boards_id = $data["bulletin_boards_id"];
            $bulletinBoardComment = $this->BulletinBoardComments->patchEntity($bulletinBoardComment, $data);
            $id = $data["bulletin_boards_id"];
            if ($this->BulletinBoardComments->save($bulletinBoardComment)) {
                return $this->redirect(["controller" => "bulletin_boards", 'action' => "view", $id]);
            }
            $this->DbLog->bulletinBoardError("BulletinBoardComments", "add");
            $this->SaveError->errorFlash();
            return $this->redirect(["controller" => "top", 'action' => "index"]);
        }
        $bulletinBoards = $this->BulletinBoardComments->BulletinBoards->find('list', ['limit' => 200]);
        $this->set(compact('bulletinBoardComment', 'bulletinBoards'));
    }

    public function edit($id = null)
    {
        $bulletinBoardComment = $this->BulletinBoardComments->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bulletinBoardComment = $this->BulletinBoardComments->patchEntity($bulletinBoardComment, $this->request->getData());
            if ($this->BulletinBoardComments->save($bulletinBoardComment)) {
                $this->Flash->success(__('The bulletin board comment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bulletin board comment could not be saved. Please, try again.'));
        }
        $bulletinBoards = $this->BulletinBoardComments->BulletinBoards->find('list', ['limit' => 200]);
        $this->set(compact('bulletinBoardComment', 'bulletinBoards'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bulletinBoardComment = $this->BulletinBoardComments->get($id);
        if ($this->BulletinBoardComments->delete($bulletinBoardComment)) {
            $this->Flash->success(__('The bulletin board comment has been deleted.'));
        } else {
            $this->Flash->error(__('The bulletin board comment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        /*
         * Patientsのindexとviewは認証不要
         */
        $this->Authentication->addUnauthenticatedActions(["add"]);
    }
}
