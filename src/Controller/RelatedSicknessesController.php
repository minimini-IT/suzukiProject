<?php
declare(strict_types=1);

namespace App\Controller;

class RelatedSicknessesController extends AppController
{
    public function add()
    {
        $relatedSickness = $this->RelatedSicknesses->newEmptyEntity();
        if ($this->request->is('post')) {
            $relatedSickness = $this->RelatedSicknesses->patchEntity($relatedSickness, $this->request->getData());
            if ($this->RelatedSicknesses->save($relatedSickness)) {
                $this->Flash->success(__('The related sickness has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The related sickness could not be saved. Please, try again.'));
        }
        $articles = $this->RelatedSicknesses->Articles->find('list', ['limit' => 200]);
        $sicknesses = $this->RelatedSicknesses->Sicknesses->find('list', ['limit' => 200]);
        $this->set(compact('relatedSickness', 'articles', 'sicknesses'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $relatedSickness = $this->RelatedSicknesses->get($id);
        $articles_id = $relatedSickness->articles_id;
        if ($this->RelatedSicknesses->delete($relatedSickness)) 
        {
            $this->log("---delete article-related-sicknesses clear---", LOG_DEBUG);
            return $this->redirect(["controller" => "articles", "action" => "edit", $articles_id]);
        }
        $this->log("---delete article-related-sicknesses error---", LOG_DEBUG);
        $this->Flash->error(__('エラーが発生したので登録できませんでした。'));
        $this->Flash->error(__('管理者へ報告してください。'));
        return $this->redirect(["controller" => "top", 'action' => 'index']);
    }
}
