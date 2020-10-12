<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * BulletinBoardComments Controller
 *
 * @property \App\Model\Table\BulletinBoardCommentsTable $BulletinBoardComments
 * @method \App\Model\Entity\BulletinBoardComment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BulletinBoardCommentsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['BulletinBoards'],
        ];
        $bulletinBoardComments = $this->paginate($this->BulletinBoardComments);

        $this->set(compact('bulletinBoardComments'));
    }

    /**
     * View method
     *
     * @param string|null $id Bulletin Board Comment id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $bulletinBoardComment = $this->BulletinBoardComments->get($id, [
            'contain' => ['BulletinBoards'],
        ]);

        $this->set(compact('bulletinBoardComment'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $bulletinBoardComment = $this->BulletinBoardComments->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $bulletinBoardComment = $this->BulletinBoardComments->patchEntity($bulletinBoardComment, $data);
            /*
            $debugData = print_r($data, true);
            $this->log($debugData, LOG_DEBUG);
            $this->log($data["bulletin_boards_id"], LOG_DEBUG);
            $a = print_r($a, true);
             */
            $id = $data["bulletin_boards_id"];
            if ($this->BulletinBoardComments->save($bulletinBoardComment)) {
                $this->Flash->success(__('The bulletin board comment has been saved.'));
                //return $this->redirect(["controller" => "bulletin_boards", 'action' => "index"]);
                return $this->redirect(["controller" => "bulletin_boards", 'action' => "view", $id]);
            }
            $this->Flash->error(__('The bulletin board comment could not be saved. Please, try again.'));
            return $this->redirect(["controller" => "bulletin_boards", 'action' => "index"]);
        }
        $bulletinBoards = $this->BulletinBoardComments->BulletinBoards->find('list', ['limit' => 200]);
        $this->set(compact('bulletinBoardComment', 'bulletinBoards'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Bulletin Board Comment id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
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

    /**
     * Delete method
     *
     * @param string|null $id Bulletin Board Comment id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
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
}
