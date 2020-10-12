<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MessageBord[]|\Cake\Collection\CollectionInterface $messageBords
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
  <ul class="side-nav">
    <li class="heading"><?= __('Actions') ?></li>
    <li><?= $this->Html->link(__('新規作成'), ['action' => 'add']) ?></li>
    <li><?= $this->Html->link(__('ステータス追加'), ['controller' => 'MessageStatuses', 'action' => 'add']) ?></li>
    <li><?= $this->Html->link(__('TOPに戻る'), ["controller" => "Dairy", 'action' => 'index']) ?></li>
  </ul>
  <p>任意のユーザに対してメッセージを作成できる</p>
  <p>用途としては主にアンケート形式での隊務を想定</p>
  <p>行を選択して詳細を表示できる</p>
  <p>メッセージにファイルを添付できる</p>
  <p>メッセージの返事は選択肢の選択は必須、コメントはなくても可</p>
  <p>選択肢は一つのみ選択可</p>
</nav>
<div class="messageBords index large-9 medium-8 columns content">
  <h3><?= __('メッセージボード') ?></h3>
  <table cellpadding="0" cellspacing="0">
    <thead>
      <tr>
        <th scope="col"><?= $this->Paginator->sort('incident_managements_id', "インシデントID") ?></th>
        <th scope="col"><?= $this->Paginator->sort('message_bords_id', "ID") ?></th>
        <th scope="col"><?= $this->Paginator->sort('users_id', "作成者") ?></th>
        <th scope="col"><?= $this->Paginator->sort('title', "タイトル") ?></th>
        <th scope="col"><?= $this->Paginator->sort('message_statuses_id', "ステータス") ?></th>
        <th scope="col"><?= $this->Paginator->sort('period', "期限") ?></th>
        <th scope="col"><?= $this->Paginator->sort('modified', "作成日時") ?></th>
        <th scope="col" class="actions"><?= __('編集・削除') ?></th>
      </tr>
    </thead>
  </table>
<?php $c = 0 ?>
<?php foreach ($messageBords as $messageBord): ?>
  <table class="branch">
    <tbody>
      <tr>
        <td><?= 
            h($messageBord->incident_management->management_prefix->management_prefix) . "-" .  
            $messageBord->incident_management->created->format("Ymd") . "-" .  
            h($messageBord->incident_management->number)
        ?></td>
        <td><?= $this->Number->format($messageBord->message_bords_id) ?></td>
        <td><?= h($messageBord->user->first_name . $messageBord->user->last_name) ?></td>
        <td><?= h($messageBord->title) ?></td>
        <td><?= $messageBord->message_status->status ?></td>
        <td><?= h($messageBord->period) ?></td>
        <td><?= h($messageBord->modified) ?></td>
        <td class="actions">
          <?= $this->Html->link(__('編集'), ['action' => 'edit', $messageBord->message_bords_id]) ?>
          <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $messageBord->message_bords_id], ['confirm' => __('{0} を削除してよろしいですか？', $messageBord->title)]) ?>
        </td>
      </tr>
    </tbody>
  </table>
  <div class="node">
    <pre><p><?= h($messageBord->message) ?></p></pre>
    <h5>ファイル</h5>
    <hr>
    <table>
  <?php foreach($messageBord->message_files as $file): ?>
      <tr>
        <td>
          <?= $this->Html->link($file->file_name, ["controller" => "Download", 'action' => 'bordFileDownload', $file->message_files_id]) ?>
        </td>
        <td><?= $file->file_size ?></td>
        <td>
          <?= $this->Form->postLink(__('削除'), ["controller" => "MessageFiles", 'action' => 'delete', $file->message_files_id], ['confirm' => __('ファイルを削除しますか？ # {0}?', $file->file_name)]) ?>
        </td>
      </tr>
  <?php endforeach ?>
    </table>
  
    <h5>選択肢</h5>
    <hr>
  <?php 
    $counts = [];
    foreach($messageBord->message_destinations as $destination){
      if(null !== $destination->message_answer){
        $counts[] =  $destination->message_answer->message_choices_id;
      }else{
        $counts[] = 0;
      }
    }
    $count = array_count_values($counts);
  ?>
  
    <table>
  <?php $choices = []; ?>
  <?php foreach($messageBord->message_choices as $choice): ?>
    <?php $choices[$choice->message_choices_id] = $choice->content ?>
      <tr>
    <?php if(array_key_exists($choice->message_choices_id, $count)): ?>
        <td><?= h($choice->content) ?></td>
        <td><?= h($count[$choice->message_choices_id]) ?></td>
        <td>
          <?= $this->Html->link(__('編集'), ["controller" => "message_choices", 'action' => 'edit', $choice->message_choices_id]) ?>
          <?= $this->Form->postLink(__('削除'), ["controller" => "message_choices", 'action' => 'delete', $choice->message_choices_id], ['confirm' => __('{0} この選択肢を削除してよろしいですか？', $choice->content)]) ?>
        </td>
    <?php else: ?>
        <td><?= h($choice->content) ?></td>
        <td><?= 0 ?></td>
        <td>
          <?= $this->Html->link(__('編集'), ["controller" => "message_choices", 'action' => 'edit', $choice->message_choices_id]) ?>
          <?= $this->Form->postLink(__('削除'), ["controller" => "message_choices", 'action' => 'delete', $choice->message_choices_id], ['confirm' => __('Are you sure you want to delete # {0}?', $choice->message_choices_id)]) ?>
        </td>
    <?php endif ?>
      </tr>
  <?php endforeach ?>
    </table>

    <table>
      <tr>
        <th>ユーザ名</th>
        <th>選択肢</th>
        <th>メッセージ</th>
        <th>更新日時</th>
        <th>編集</th>
      </tr>
  <?php $user = [] ?>
  <?php foreach($messageBord->message_destinations as $destination): ?>
    <?php if(null == $destination->message_answer): ?>
      <?php $user[$destination->message_destinations_id] = $destination->user->first_name . $destination->user->last_name ?>
    <?php endif ?>
      <tr>
        <td><?= $destination->user->first_name . $destination->user->last_name ?></td>
    <?php if(null !== $destination->message_answer): ?>
        <td><?= $destination->message_answer->message_choice->content ?></td>
        <td><pre><?= h($destination->message_answer->message) ?></pre></td>
        <td><?= $destination->message_answer->modified ?></td>
        <td><?= $this->Html->link(__('編集'), ["controller" => "message_answers", 'action' => 'edit', $destination->message_answer->message_answers_id]) ?></td>
    <?php else: ?>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    <?php endif ?>
      </tr>
  <?php endforeach ?>
    </table>
  
  <?php
  $flag = false; 
  foreach($messageBord->message_destinations as $destination){
    if(null === $destination->message_answer){
      $flag = true; 
      break;
    }
  } ?>
  <?php if($flag): ?>
    <div>
    <?php
      echo $this->Form->create($messageAnswers, [
        "url" => [
          "controller" => "message_answers",
          "action" => "add"
        ]
      ]); 
      echo "<fieldset>";
      echo $this->Form->control('message_destinations_id', ["type" => "select", "options" => $user, "label" => "ユーザ"]); 
      echo $this->Form->control('message_choices_id', ["type" => "radio", "options" => $choices, "label" => "選択肢"]);
      echo $this->Form->control('message', ["label" => "メッセージ", "type" => "textarea"]);
      echo "</fieldset>";
      echo $this->Form->button(__('Submit'));
      echo $this->Form->end();
    ?>
    </div>
  
  <?php endif ?>
  <?php $c++ ?>
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
