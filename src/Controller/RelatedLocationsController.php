<?php
declare(strict_types=1);

namespace App\Controller;

class RelatedLocationsController extends AppController
{
    public function add()
    {
        $relatedLocation = $this->RelatedLocations->newEmptyEntity();
        if ($this->request->is('post')) {
            $relatedLocation = $this->RelatedLocations->patchEntity($relatedLocation, $this->request->getData());
            if ($this->RelatedLocations->save($relatedLocation)) {
                $this->Flash->success(__('The related location has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The related location could not be saved. Please, try again.'));
        }
        $articles = $this->RelatedLocations->Articles->find('list', ['limit' => 200]);
        $locations = $this->RelatedLocations->Locations->find('list', ['limit' => 200]);
        $this->set(compact('relatedLocation', 'articles', 'locations'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $relatedLocation = $this->RelatedLocations->get($id);
        $articles_id = $relatedLocation->articles_id;
        if ($this->RelatedLocations->delete($relatedLocation)) 
        {
            $this->log("---delete article-related-locations clear---", LOG_DEBUG);
            return $this->redirect(["controller" => "articles", "action" => "edit", $articles_id]);
        }
        $this->log("---delete article-related-locations error---", LOG_DEBUG);
        $this->Flash->error(__('エラーが発生したので登録できませんでした。'));
        $this->Flash->error(__('管理者へ報告してください。'));
        return $this->redirect(["controller" => "top", 'action' => 'index']);
    }
}
