<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PrivateMessage[]|\Cake\Collection\CollectionInterface $privateMessages
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Private Message'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Message Bords'), ['controller' => 'MessageBords', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Message Bord'), ['controller' => 'MessageBords', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="privateMessages index large-9 medium-8 columns content">
    <h3><?= __('Private Messages') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('private_messages_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('message_bords_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('users_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($privateMessages as $privateMessage): ?>
            <tr>
                <td><?= $this->Number->format($privateMessage->private_messages_id) ?></td>
                <td><?= $privateMessage->has('message_bord') ? $this->Html->link($privateMessage->message_bord->title, ['controller' => 'MessageBords', 'action' => 'view', $privateMessage->message_bord->message_bords_id]) : '' ?></td>
                <td><?= $privateMessage->has('user') ? $this->Html->link($privateMessage->user->Array, ['controller' => 'Users', 'action' => 'view', $privateMessage->user->users_id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $privateMessage->private_messages_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $privateMessage->private_messages_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $privateMessage->private_messages_id], ['confirm' => __('Are you sure you want to delete # {0}?', $privateMessage->private_messages_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
