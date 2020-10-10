<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * MessageBords Controller
 *
 * @property \App\Model\Table\MessageBordsTable $MessageBords
 *
 * @method \App\Model\Entity\MessageBord[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MessageBordsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->loadModels(["MessageAnswers", "PrivateMessages"]);
        $messageAnswers = $this->MessageAnswers->newEntity();

        $this->paginate = [
            'contain' => [
              "MessageBords.Users",
              "MessageBords.IncidentManagements.ManagementPrefixes",
              'MessageBords.MessageStatuses', 
              "MessageBords.MessageDestinations.Users", 
              "MessageBords.MessageDestinations.MessageAnswers.MessageChoices", 
              "MessageBords.MessageChoices", 
              "MessageBords.MessageFiles"
            ],
            "order" => ["message_bords_id" => "desc"],
            "maxLimit" => 5
          ];
        /*
        $this->paginate = [
            'contain' => [
              "Users",
              "IncidentManagements.ManagementPrefixes",
              'MessageStatuses', 
              "MessageDestinations.Users", 
              "MessageDestinations.MessageAnswers.MessageChoices", 
              "MessageChoices", 
              "MessageFiles"
            ],
            "order" => ["message_bords_id" => "desc"],
            "maxLimit" => 5
          ];
         */
        $loginUser = $this->request->session()->read("Auth.User.users_id");
        $privateMessages = $this->PrivateMessages->find("all")
            ->where(["OR" => [["PrivateMessages.users_id" => $loginUser], ["PrivateMessages.users_id" => 7]]]);
        $messageBords = $this->paginate($privateMessages);
        //$messageBords = $this->MessageBords->find("all")
        //    ->where(["MessageBords.users_id" => 4]);
        //$messageBords = $this->paginate($messageBords);
        //$messageBords = $this->paginate($this->MessageBords);
        $this->set(compact('messageBords', "messageAnswers"));
    }

    /**
     * View method
     *
     * @param string|null $id Message Bord id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $messageBord = $this->MessageBords->get($id, [
            'contain' => ['MessageStatuses']
        ]);

        $this->set('messageBord', $messageBord);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $messageBord = $this->MessageBords->newEntity();
        $this->loadModels(["MessageChoices", "MessageDestinations", "Users", "MessageFiles"]);
        if ($this->request->is('post')) {
            $this->IncidentManagement = $this->loadComponent("IncidentAdd");
            $data = $this->request->getdata();
            $messageBord = $this->MessageBords->patchEntity($messageBord, $data);

            //MessageBord save前にincident_managements更新
            if(is_int($incidentNumber = $this->IncidentManagement->incident_number(4)))
            {
                //インシデント番号生成成功したら
                $data = array_merge($data, ["incident_managements_id" => $incidentNumber]);
                $messageBord = $this->MessageBords->patchEntity($messageBord, $data);
                if ($this->MessageBords->save($messageBord)) 
                {
                    $this->Flash->success(__('The message bord has been saved.'));
                    $bordId = $messageBord->message_bords_id;

                    //privateMessage保存
                    if(!empty($data["private"][0]))
                    {
                        $this->privateSave($data["private"], $bordId);
                    }

                    //choiceを保存
                    if(!empty($data["content"][0]))
                    {
                        $this->choiceSave($data["content"], $bordId);
                    }

                    //destination保存
                    if(!empty($data["user"][0]))
                    {
                        $this->destinationSave($data["user"], $bordId);
                    }

                    //file保存
                    if(!empty($data["file"][0]["tmp_name"]))
                    {
                        //ファイルアップロード
                        $this->Fileupload = $this->loadComponent("Fileupload");
                        $entity = $this->Fileupload->default_upload($data["file"], $bordId, "message_bords");
                        $file = $this->MessageFiles->newEntities($entity);
                        if($this->MessageFiles->saveMany($file)) 
                        {
                          $this->Flash->success(__('ファイルのアップロードに成功しました。'));
                        }
                        else
                        {
                          $this->Flash->error(__('ファイルのアップロードに失敗しました。'));
                        }
                        return $this->redirect(['action' => 'index']);
                    }
                    else
                    {
                        return $this->redirect(['action' => 'index']);
                    }
                }
            }
            $this->Flash->error(__('The message bord could not be saved. Please, try again.'));
            return $this->redirect(['action' => 'index']);

        }
        $messageStatuses = $this->MessageBords->MessageStatuses->find('list', ['limit' => 200]);
        //destination用
        $soukatu = $this->Users->find("list", ["limit" => 200])
            ->where(["belongs_id" => 1])
            ->where(["users_id !=" => 7])
            ->where(["delete_flag" => 0]);
        $kenkyo = $this->Users->find("list", ["limit" => 200])
            ->where(["belongs_id" => 2])
            ->where(["users_id !=" => 7])
            ->where(["delete_flag" => 0]);
        $sistem = $this->Users->find("list", ["limit" => 200])
            ->where(["belongs_id" => 3])
            ->where(["users_id !=" => 7])
            ->where(["delete_flag" => 0]);
        $kintai = $this->Users->find("list", ["limit" => 200])
            ->where(["belongs_id" => 4])
            ->where(["users_id !=" => 7])
            ->where(["delete_flag" => 0]);
        $users = $this->Users->find('list', ['limit' => 200])
            ->where(["users_id !=" => 7])
            ->where(["delete_flag" => 0]);
        $allUser = $this->Users->find("list", ["limit" => 200])
            ->where(["users_id" => 7]);
        //$this->set(compact('messageBord', 'messageStatuses', "users", "allUser"));
        $this->set(compact('messageBord', 'messageStatuses', "users", "allUser", "soukatu", "kenkyo", "sistem", "kintai"));
    }

    /**
     * Edit method
     *
     * @param string|null $id Message Bord id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $messageBord = $this->MessageBords->get($id, [
            'contain' => ["MessageChoices", "MessageDestinations", "Users"]
        ]);
        //認証
        $this->Authority = $this->loadComponent("Authority");
        if($this->Authority->authorityCheck($messageBord)){
            $this->loadModels(["Users", "MessageFiles", "MessageDestinations"]);
            if ($this->request->is(['patch', 'post', 'put'])) {
                $data = $this->request->getdata();
                $this->log($data, LOG_DEBUG);
                $messageBord = $this->MessageBords->patchEntity($messageBord, $data);
                if ($this->MessageBords->save($messageBord)) {
                    $this->Flash->success(__('The message bord has been saved.'));
                    $bordId = $messageBord->message_bords_id;

                    //destination
                    //いっぺん全消し
                    $this->MessageDestinations->deleteAll(["message_bords_id" => $bordId]);
                    $this->destinationSave($data["user"], $bordId);

                    //file保存
                    if(!empty($data["file"][0]["tmp_name"])){
                      $this->Fileupload = $this->loadComponent("Fileupload");
                      $entity = $this->Fileupload->default_upload($data["file"], $bordId, "message_bords");
                      $file = $this->MessageFiles->newEntities($entity);
                      if($this->MessageFiles->saveMany($file)) {
                        $this->Flash->success(__('ファイルのアップロードに成功しました。'));
                      }else{
                        $this->Flash->error(__('ファイルのアップロードに失敗しました。'));
                      }
                    }
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The message bord could not be saved. Please, try again.'));
            }
        }else{
            $this->Flash->error(__('権限がありません'));
            return $this->redirect($this->referer());
        }

        $messageStatuses = $this->MessageBords->MessageStatuses->find('list', ['limit' => 200]);
        $messageDestinations = $messageBord->message_destinations;
        $users = $this->Users->find('list', ['limit' => 200])
            ->where(["delete_flag" => 0]);
        $this->set(compact('messageBord', 'messageStatuses', "users", "messageDestinations"));
    }

    /**
     * Delete method
     *
     * @param string|null $id Message Bord id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $messageBord = $this->MessageBords->get($id,[
            "contain" => ["MessageFiles", "Users"]
        ]);
        $this->Authority = $this->loadComponent("Authority");
        if($this->Authority->authorityCheck($messageBord)){
            if ($this->MessageBords->delete($messageBord)) {
                //ファイルあれば
                if(!empty($messageBord->message_files)){
                    foreach($messageBord->message_files as $file){
                        $uniqueFileNames[] = $file->unique_file_name;
                    }
                    //ディレクトリ内のファイルを削除
                    $this->FileDelete->deleteFiles($uniqueFileNames);
                }
                $this->Flash->success(__('The message bord has been deleted.'));
            } else {
                $this->Flash->error(__('The message bord could not be deleted. Please, try again.'));
            }
            return $this->redirect(['action' => 'index']);
        }else{
            $this->Flash->error(__('権限がありません'));
            return $this->redirect($this->referer());
        }
    }

    public function choiceSave($data = null, $id = null)
    {
        $this->loadModels(["MessageChoices"]);
        //choiceのentity作成
        foreach($data as $content){
            $choiceEntity[] = [
                "message_bords_id" => $id,
                "content" => $content
            ];
        }
        $messageChoice = $this->MessageChoices->newEntities($choiceEntity);
        if($this->MessageChoices->saveMany($messageChoice)){
            return true;
        }
        return false;
    }

    public function destinationSave($data = null, $id = null)
    {
        $this->loadModels(["MessageDestinations"]);
        foreach($data as $user){
            $destinationEntity[] = [
                "message_bords_id" => $id,
                "users_id" => $user
            ];
        }
        $messageDestination = $this->MessageDestinations->newEntities($destinationEntity);
        if($this->MessageDestinations->saveMany($messageDestination)){
            return true;
        }
        return false;
    }

    public function privateSave($data = null, $id = null)
    {
        $this->loadModels(["PrivateMessages"]);
        foreach($data as $user){
            $privateEntity[] = [
                "message_bords_id" => $id,
                "users_id" => $user
            ];
        }
        $privateMessages = $this->PrivateMessages->newEntities($privateEntity);
        if($this->PrivateMessages->saveMany($privateMessages)){
            return true;
        }
        return false;
    }
}
