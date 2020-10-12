<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MessageStatus $messageStatus
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Message Status'), ['action' => 'edit', $messageStatus->message_statuses_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Message Status'), ['action' => 'delete', $messageStatus->message_statuses_id], ['confirm' => __('Are you sure you want to delete # {0}?', $messageStatus->message_statuses_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Message Statuses'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Message Status'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="messageStatuses view large-9 medium-8 columns content">
    <h3><?= h($messageStatus->status) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($messageStatus->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Message Statuses Id') ?></th>
            <td><?= $this->Number->format($messageStatus->message_statuses_id) ?></td>
        </tr>
    </table>
</div>
