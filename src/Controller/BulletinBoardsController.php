<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * BulletinBoards Controller
 *
 * @property \App\Model\Table\BulletinBoardsTable $BulletinBoards
 * @method \App\Model\Entity\BulletinBoard[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BulletinBoardsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $bulletinBoards = $this->paginate($this->BulletinBoards);

        $this->set(compact('bulletinBoards'));
    }

    /**
     * View method
     *
     * @param string|null $id Bulletin Board id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $bulletinBoard = $this->BulletinBoards->get($id, [
            'contain' => ['BulletinBoardComments'],
        ]);

        $this->loadModels(["BulletinBoardComments"]);
        $bulletinBoardComment = $this->BulletinBoardComments->newEmptyEntity();

        $this->set(compact('bulletinBoard', "bulletinBoardComment"));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $bulletinBoard = $this->BulletinBoards->newEmptyEntity();
        if ($this->request->is('post')) {
            $bulletinBoard = $this->BulletinBoards->patchEntity($bulletinBoard, $this->request->getData());
            if ($this->BulletinBoards->save($bulletinBoard)) {
                $this->Flash->success(__('The bulletin board has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bulletin board could not be saved. Please, try again.'));
        }
        $this->set(compact('bulletinBoard'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Bulletin Board id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
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

    /**
     * Delete method
     *
     * @param string|null $id Bulletin Board id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
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
}
