<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MessageBordChronology $messageBordChronology
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Message Bord Chronologies'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Message Bords'), ['controller' => 'MessageBords', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Message Bord'), ['controller' => 'MessageBords', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="messageBordChronologies form large-9 medium-8 columns content">
    <?= $this->Form->create($messageBordChronology) ?>
    <fieldset>
        <legend><?= __('Add Message Bord Chronology') ?></legend>
        <?php
            echo $this->Form->control('message_bords_id', ['options' => $messageBords]);
            echo $this->Form->control('users_id', ['options' => $users]);
            echo $this->Form->control('message');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
