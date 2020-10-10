<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MessageChoice $messageChoice
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('戻る'), ['controller' => 'MessageBords', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('TOPへ戻る'), ['controller' => 'Dairy', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="messageChoices form large-9 medium-8 columns content">
    <?= $this->Form->create($messageChoice) ?>
    <fieldset>
        <legend><?= __('選択肢 編集') ?></legend>
        <?php
            echo $this->Form->control('message_bords_id', ["label" => "メッセージボード", 'options' => $messageBords, "disabled" => true]);
            echo $this->Form->control('content', ["label" => "選択肢"]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
