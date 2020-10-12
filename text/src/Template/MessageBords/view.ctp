<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MessageBord $messageBord
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Message Bord'), ['action' => 'edit', $messageBord->message_bords_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Message Bord'), ['action' => 'delete', $messageBord->message_bords_id], ['confirm' => __('Are you sure you want to delete # {0}?', $messageBord->message_bords_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Message Bords'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Message Bord'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Message Statuses'), ['controller' => 'MessageStatuses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Message Status'), ['controller' => 'MessageStatuses', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="messageBords view large-9 medium-8 columns content">
    <h3><?= h($messageBord->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($messageBord->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Message Status') ?></th>
            <td><?= $messageBord->has('message_status') ? $this->Html->link($messageBord->message_status->message_statuses_id, ['controller' => 'MessageStatuses', 'action' => 'view', $messageBord->message_status->message_statuses_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Message Bords Id') ?></th>
            <td><?= $this->Number->format($messageBord->message_bords_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Choice') ?></th>
            <td><?= $this->Number->format($messageBord->choice) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Period') ?></th>
            <td><?= h($messageBord->period) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($messageBord->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($messageBord->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Message') ?></h4>
        <?= $this->Text->autoParagraph(h($messageBord->message)); ?>
    </div>
</div>
