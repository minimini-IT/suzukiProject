<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MessageAnswer $messageAnswer
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Message Answers'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Message Choices'), ['controller' => 'MessageChoices', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Message Choice'), ['controller' => 'MessageChoices', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Message Destinations'), ['controller' => 'MessageDestinations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Message Destination'), ['controller' => 'MessageDestinations', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="messageAnswers form large-9 medium-8 columns content">
    <?= $this->Form->create($messageAnswer) ?>
    <fieldset>
        <legend><?= __('Add Message Answer') ?></legend>
        <?php
            echo $this->Form->control('message_destinations_id');
            echo $this->Form->control('message_choices_id', ['options' => $messageChoices]);
            echo $this->Form->control('message');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
