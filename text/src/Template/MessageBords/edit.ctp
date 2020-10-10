<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MessageBord $messageBord
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('戻る'), ['controller' => 'MessageBords', 'action' => 'index']) ?></li>
    </ul>
    <p>編集する場合、ユーザは選択しなおし</p>
    <p>選択肢のみ一覧から編集</p>
</nav>

<div class="messageBords form large-9 medium-8 columns content">
    <?= $this->Form->create($messageBord, ["type" => "file"]); ?>
    <fieldset>
        <legend><?= __('メッセージボード編集') ?></legend>
        <?php
            echo $this->Form->control('title', ["label" => "タイトル"]);
            echo str_replace(";", " ", $this->Form->control('users_id', ["label" => "作成者", "type" => "select", "options" => $users]));
            echo $this->Form->control('message_statuses_id', ["label" => "ステータス", 'options' => $messageStatuses]);
            echo $this->Form->control('message', ["label" => "メッセージ"]);
            echo $this->Form->control('period', ["label" => "期限"]);
            echo "<p style='color: red'>※ユーザ選び直し</p>";
            echo str_replace(";", " ", $this->Form->control("user", ["label" => "ユーザ", "multiple" => "checkbox", "options" => $users]));
            //filesへの入力
            echo $this->Form->file("file[]", ["multiple" => "true", "secure" => false]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
