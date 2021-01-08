<?php
declare(strict_types=1);

namespace App\Controller;

class RelatedSymptomsController extends AppController
{
    public function add()
    {
        $relatedSymptom = $this->RelatedSymptoms->newEmptyEntity();
        if ($this->request->is('post')) {
            $relatedSymptom = $this->RelatedSymptoms->patchEntity($relatedSymptom, $this->request->getData());
            if ($this->RelatedSymptoms->save($relatedSymptom)) {
                $this->Flash->success(__('The related symptom has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The related symptom could not be saved. Please, try again.'));
        }
        $articles = $this->RelatedSymptoms->Articles->find('list', ['limit' => 200]);
        $symptoms = $this->RelatedSymptoms->Symptoms->find('list', ['limit' => 200]);
        $this->set(compact('relatedSymptom', 'articles', 'symptoms'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $relatedSymptom = $this->RelatedSymptoms->get($id);
        $articles_id = $relatedSymptom->articles_id;
        if ($this->RelatedSymptoms->delete($relatedSymptom)) 
        {
            $this->log("---delete article-related-symptoms clear---", LOG_DEBUG);
            return $this->redirect(["controller" => "articles", "action" => "edit", $articles_id]);
        }
        $this->log("---delete article-related-symptoms error---", LOG_DEBUG);
        $this->Flash->error(__('エラーが発生したので登録できませんでした。'));
        $this->Flash->error(__('管理者へ報告してください。'));
        return $this->redirect(["controller" => "top", 'action' => 'index']);
    }
}
