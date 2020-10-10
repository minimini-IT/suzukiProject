<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rank[]|\Cake\Collection\CollectionInterface $ranks
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Rank'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="ranks index large-9 medium-8 columns content">
    <h3><?= __('Ranks') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('ranks_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('rank') ?></th>
                <th scope="col"><?= $this->Paginator->sort('abb_rank') ?></th>
                <th scope="col"><?= $this->Paginator->sort('rank_sort_number') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ranks as $rank): ?>
            <tr>
                <td><?= $this->Number->format($rank->ranks_id) ?></td>
                <td><?= h($rank->rank) ?></td>
                <td><?= h($rank->abb_rank) ?></td>
                <td><?= $this->Number->format($rank->rank_sort_number) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $rank->ranks_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $rank->ranks_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $rank->ranks_id], ['confirm' => __('Are you sure you want to delete # {0}?', $rank->ranks_id)]) ?>
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
