<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MessageStatus[]|\Cake\Collection\CollectionInterface $messageStatuses
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Message Status'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="messageStatuses index large-9 medium-8 columns content">
    <h3><?= __('Message Statuses') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('message_statuses_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($messageStatuses as $messageStatus): ?>
            <tr>
                <td><?= $this->Number->format($messageStatus->message_statuses_id) ?></td>
                <td><?= h($messageStatus->status) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $messageStatus->message_statuses_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $messageStatus->message_statuses_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $messageStatus->message_statuses_id], ['confirm' => __('Are you sure you want to delete # {0}?', $messageStatus->message_statuses_id)]) ?>
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
