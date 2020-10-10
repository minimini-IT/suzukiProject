<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Belong[]|\Cake\Collection\CollectionInterface $belongs
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Belong'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="belongs index large-9 medium-8 columns content">
    <h3><?= __('Belongs') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('belongs_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('belong') ?></th>
                <th scope="col"><?= $this->Paginator->sort('belong_sort_number') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($belongs as $belong): ?>
            <tr>
                <td><?= $this->Number->format($belong->belongs_id) ?></td>
                <td><?= h($belong->belong) ?></td>
                <td><?= $this->Number->format($belong->belong_sort_number) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $belong->belongs_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $belong->belongs_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $belong->belongs_id], ['confirm' => __('Are you sure you want to delete # {0}?', $belong->belongs_id)]) ?>
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
