<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CrewSend $crewSend
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('戻る'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="crewSends form large-9 medium-8 columns content">
    <?= $this->Form->create($crewSend, ["type" => "file"]); ?>
    <fieldset>
        <legend><?= __('クルー申し送り 編集') ?></legend>
        <?php
            echo $this->Form->control('categories_id', ["label" => "カテゴリー", 'options' => $categories]);
            echo $this->Form->control('title', ["label" => "タイトル"]);
            echo $this->Form->control('statuses_id', ["label" => "ステータス", 'options' => $statuses]);
            echo str_replace(";", " ", $this->Form->control('users_id', ["label" => "作成者", "type" => "select", "options" => $users]));
            echo $this->Form->control('period', ["label" => "期限"]);
            echo $this->Form->control('comment', ["label" => "コメント"]);
            echo $this->Form->file("file[]", ["multiple" => "true", "secure" => false]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
