<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MessageAnswer $messageAnswer
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Message Answer'), ['action' => 'edit', $messageAnswer->message_answers_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Message Answer'), ['action' => 'delete', $messageAnswer->message_answers_id], ['confirm' => __('Are you sure you want to delete # {0}?', $messageAnswer->message_answers_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Message Answers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Message Answer'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Message Choices'), ['controller' => 'MessageChoices', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Message Choice'), ['controller' => 'MessageChoices', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Message Destinations'), ['controller' => 'MessageDestinations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Message Destination'), ['controller' => 'MessageDestinations', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="messageAnswers view large-9 medium-8 columns content">
    <h3><?= h($messageAnswer->message_answers_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Message Choice') ?></th>
            <td><?= $messageAnswer->has('message_choice') ? $this->Html->link($messageAnswer->message_choice->message_choices_id, ['controller' => 'MessageChoices', 'action' => 'view', $messageAnswer->message_choice->message_choices_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Message Destination') ?></th>
            <td><?= $messageAnswer->has('message_destination') ? $this->Html->link($messageAnswer->message_destination->message_destinations_id, ['controller' => 'MessageDestinations', 'action' => 'view', $messageAnswer->message_destination->message_destinations_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Message Answers Id') ?></th>
            <td><?= $this->Number->format($messageAnswer->message_answers_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Message Destinations Id') ?></th>
            <td><?= $this->Number->format($messageAnswer->message_destinations_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($messageAnswer->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($messageAnswer->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Message') ?></h4>
        <?= $this->Text->autoParagraph(h($messageAnswer->message)); ?>
    </div>
</div>
