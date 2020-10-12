<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderNews[]|\Cake\Collection\CollectionInterface $orderNews
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Order News'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="orderNews index large-9 medium-8 columns content">
    <h3><?= __('Order News') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('order_news_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('order_news_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orderNews as $orderNews): ?>
            <tr>
                <td><?= $this->Number->format($orderNews->order_news_id) ?></td>
                <td><?= h($orderNews->order_news_date) ?></td>
                <td><?= h($orderNews->title) ?></td>
                <td><?= h($orderNews->created) ?></td>
                <td><?= h($orderNews->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $orderNews->order_news_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $orderNews->order_news_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $orderNews->order_news_id], ['confirm' => __('Are you sure you want to delete # {0}?', $orderNews->order_news_id)]) ?>
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
