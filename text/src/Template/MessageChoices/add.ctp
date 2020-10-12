<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MessageChoice $messageChoice
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Message Choices'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Message Bords'), ['controller' => 'MessageBords', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Message Bord'), ['controller' => 'MessageBords', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Message Answers'), ['controller' => 'MessageAnswers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Message Answer'), ['controller' => 'MessageAnswers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="messageChoices form large-9 medium-8 columns content">
    <?= $this->Form->create($messageChoice) ?>
    <fieldset>
        <legend><?= __('Add Message Choice') ?></legend>
        <?php
            echo $this->Form->control('message_bords_id', ['options' => $messageBords]);
            echo $this->Form->control('content');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
