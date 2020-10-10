<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CrewSendComment $crewSendComment
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Crew Send Comments'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Crew Sends'), ['controller' => 'CrewSends', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Crew Send'), ['controller' => 'CrewSends', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="crewSendComments form large-9 medium-8 columns content">
    <?= $this->Form->create($crewSendComment) ?>
    <fieldset>
        <legend><?= __('Add Crew Send Comment') ?></legend>
        <?php
            echo $this->Form->control('crew_sends_id', ['value' => $crewSends->crew_sends_id]);
            echo $this->Form->control('users_id', ['options' => $users]);
            echo $this->Form->control('file_group');
            echo $this->Form->control('comment');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
