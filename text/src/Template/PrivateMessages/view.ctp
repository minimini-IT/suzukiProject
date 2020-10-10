<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PrivateMessage $privateMessage
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Private Message'), ['action' => 'edit', $privateMessage->private_messages_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Private Message'), ['action' => 'delete', $privateMessage->private_messages_id], ['confirm' => __('Are you sure you want to delete # {0}?', $privateMessage->private_messages_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Private Messages'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Private Message'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Message Bords'), ['controller' => 'MessageBords', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Message Bord'), ['controller' => 'MessageBords', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="privateMessages view large-9 medium-8 columns content">
    <h3><?= h($privateMessage->private_messages_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Message Bord') ?></th>
            <td><?= $privateMessage->has('message_bord') ? $this->Html->link($privateMessage->message_bord->title, ['controller' => 'MessageBords', 'action' => 'view', $privateMessage->message_bord->message_bords_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $privateMessage->has('user') ? $this->Html->link($privateMessage->user->Array, ['controller' => 'Users', 'action' => 'view', $privateMessage->user->users_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Private Messages Id') ?></th>
            <td><?= $this->Number->format($privateMessage->private_messages_id) ?></td>
        </tr>
    </table>
</div>
