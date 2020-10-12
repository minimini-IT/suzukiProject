<?php
use Cake\datasource\ConnectionManager;

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CrewSend[]|\Cake\Collection\CollectionInterface $crewSends
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
  <ul class="side-nav">
    <li class="heading"><?= __('Actions') ?></li>
    <li><?= $this->Html->link(__('新規作成'), ['action' => 'add']) ?></li>
    <li><?= $this->Html->link(__('カテゴリー追加'), ['controller' => 'Categories', 'action' => 'add']) ?></li>
    <li><?= $this->Html->link(__('ステータス追加'), ['controller' => 'Statuses', 'action' => 'add']) ?></li>
    <li><?= $this->Html->link(__('TOPへ戻る'), ['controller' => 'Dairy', 'action' => 'index']) ?></li>
  </ul>
  <p>申し送り事項のページ</p>
  <p>行をクリックすると詳細が表示される</p>
  <p>詳細からその申し送りに対してコメントを作成できる</p>
  <p>詳細、コメントに対してファイルを添付できる</p>
  <p>左側のACTIONSから必要に応じてカテゴリー、ステータスを追加できる</p>
  <p>作成者の欄はデフォルトでログイン中のユーザが選ばれている</p>
</nav>
<div class="crewSends index large-9 medium-8 columns content">
  <h3><?= __('クルー申し送り') ?></h3>
  <table cellpadding="0" cellspacing="0">
    <thead>
      <tr>
        <th scope="col"><?= $this->Paginator->sort('incident_managements_id', "インシデントID") ?></th>
        <th scope="col"><?= $this->Paginator->sort('crew_sends_id', "申し送りID") ?></th>
        <th scope="col"><?= $this->Paginator->sort('categories_id', "カテゴリー") ?></th>
        <th scope="col"><?= $this->Paginator->sort('title', "タイトル") ?></th>
        <th scope="col"><?= $this->Paginator->sort('statuses_id', "ステータス") ?></th>
        <th scope="col"><?= $this->Paginator->sort('users_id', "作成者") ?></th>
        <th scope="col"><?= $this->Paginator->sort('period', "期限") ?></th>
        <th scope="col" class="actions"><?= __('編集・削除') ?></th>
      </tr>
    </thead>
  </table>
<?php foreach ($crewSends as $crewSend): ?>
  <table class="branch">
    <tbody>
      <tr>
        <td><?= 
            h($crewSend->incident_management->management_prefix->management_prefix) . "-" .  
            $crewSend->incident_management->created->format("Ymd") . "-" .  
            h($crewSend->incident_management->number)
        ?></td>
        <td><?= $this->Number->format($crewSend->crew_sends_id) ?></td>
        <td><?= $crewSend->category->category ?></td>
        <td><?= h($crewSend->title) ?></td>
        <td><?= $crewSend->status->status ?></td>
        <td><?= h($crewSend->user->first_name . $crewSend->user->last_name) ?></td>
        <td><?= h($crewSend->period) ?></td>
        <td class="actions">
          <?= $this->Html->link(__('編集'), ['action' => 'edit', $crewSend->crew_sends_id]) ?>
          <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $crewSend->crew_sends_id], ['confirm' => __('{0} この申し送りを削除してよろしいですか？', $crewSend->title)]) ?>
        </td>
      </tr>
    </tbody>
  </table>
  <div class="node">
    <pre><p><?= h($crewSend->comment) ?></p></pre>
    <h5>ファイル</h5>
    <hr>
    <table>
  <!--実装はtableではなくbootstrapのrowとcolで行う-->
    <?php foreach($crewSend->files as $file): ?>
      <tr>
        <td>
          <?= $this->Html->link($file->file_name, ["controller" => "Download", 'action' => 'sendFileDownload', $file->files_id]) ?>
        </td>
        <td><?= $file->file_size ?></td>
        <td>
          <?= $this->Form->postLink(__('Delete'), ["controller" => "Files", 'action' => 'delete', $file->files_id], ['confirm' => __('ファイルを削除しますか？ # {0}?', $file->file_name)]) ?>
        </td>
      </tr>
    <?php endforeach ?>
    </table>
  
    <h5>コメント</h5>
    <hr>
    <?php foreach ($crewSend->crew_send_comments as $crewSendComment): ?>
    <table>
      <tr>
        <th><?= h($crewSendComment->user->first_name . $crewSendComment->user->last_name) ?></th>
        <th><?= h($crewSendComment->created) ?></th>
        <td><?= $this->Html->link(__('編集'), ["controller" => "CrewSendComments", 'action' => 'edit', $crewSendComment->crew_send_comments_id]) ?></td>
        <td><?= $this->Form->postLink(__('削除'), ["controller" => "CrewSendComments", 'action' => 'delete', $crewSendComment->crew_send_comments_id], ['confirm' => __('コメントを削除しますか？', $crewSendComment->crew_send_comments_id)]) ?></td>
      </tr>
    </table>
    <pre><?= $crewSendComment->comment ?></pre>  
        <?php foreach($crewSendComment->comment_files as $file): ?>
    <table>
      <tr>
        <td>
          <?= $this->Html->link($file->file_name, ["controller" => "Download", 'action' => 'commentFileDownload', $file->comment_files_id]) ?>
        </td>
        <td><?= $file->file_size ?></td>
        <td>
          <?= $this->Form->postLink(__('Delete'), ["controller" => "CommentFiles", 'action' => 'delete', $file->comment_files_id], ['confirm' => __('ファイルを削除しますか？ # {0}?', $file->file_name)]) ?>
        </td>
      </tr>
    </table> 
        <?php endforeach ?>
    <?php endforeach ?>
  
  
    <div>
    <!-- コメント書き込み -->
      <?php
        //ログインしているユーザ
        $loginUser = $this->request->session()->read("Auth.User.users_id");

        echo $this->Form->create($crewSendComment, [
          "url" => [
            "controller" => "crew_send_comments",
            "action" => "add"
          ],
          "type" => "file"
        ]); 
        echo "<fieldset>";
        echo str_replace(";", " ", $this->Form->control('users_id', ["value" => $loginUser, "type" => "select", "options" => $users])); 
        echo $this->Form->control('comment', ["type" => "textarea", "value" => ""]);
        echo $this->Form->control('crew_sends_id', ["type" => "hidden", 'value' => $crewSend->crew_sends_id]);
        //filesへの入力
        echo $this->Form->file("file[]", ["multiple" => "true", "secure" => false]);
        echo "</fieldset>";
        echo $this->Form->button(__('Submit'));
        echo $this->Form->end();
      ?>
    </div>
  </div>
<?php endforeach ?>
  <div class="paginator">
    <ul class="pagination">
      <?= $this->Paginator->first('<< ' . __('first')) ?>
      <?= $this->Paginator->prev('< ' . __('previous')) ?>
      <?= $this->Paginator->numbers() ?>
      <?= $this->Paginator->next(__('next') . ' >') ?>
      <?= $this->Paginator->last(__('last') . ' >>') ?>
    </ul>
    <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
  </div>
</div>
