<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Status[]|\Cake\Collection\CollectionInterface $statuses
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Status'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="statuses index large-9 medium-8 columns content">
    <h3><?= __('Statuses') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('statuses_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status_sort_number') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($statuses as $status): ?>
            <tr>
                <td><?= $this->Number->format($status->statuses_id) ?></td>
                <td><?= h($status->status) ?></td>
                <td><?= $this->Number->format($status->status_sort_number) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $status->statuses_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $status->statuses_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $status->statuses_id], ['confirm' => __('Are you sure you want to delete # {0}?', $status->statuses_id)]) ?>
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
