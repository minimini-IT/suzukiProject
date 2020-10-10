<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MessageStatus $messageStatus
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('戻る'), ["controller" => "MessageBords", 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('TOPへ'), ['controller' => 'Dairy', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="messageStatuses form large-9 medium-8 columns content">
    <?= $this->Form->create($messageStatus) ?>
    <fieldset>
        <legend><?= __('メッセージステータス追加') ?></legend>
        <?php
            echo $this->Form->control('status', ["label" => "ステータス"]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->form->end() ?>
</div>
