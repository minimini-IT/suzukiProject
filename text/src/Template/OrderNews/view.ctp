<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderNews $orderNews
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Order News'), ['action' => 'edit', $orderNews->order_news_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Order News'), ['action' => 'delete', $orderNews->order_news_id], ['confirm' => __('Are you sure you want to delete # {0}?', $orderNews->order_news_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Order News'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Order News'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="orderNews view large-9 medium-8 columns content">
    <h3><?= h($orderNews->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($orderNews->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Order News Id') ?></th>
            <td><?= $this->Number->format($orderNews->order_news_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Order News Date') ?></th>
            <td><?= h($orderNews->order_news_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($orderNews->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($orderNews->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Comment') ?></h4>
        <?= $this->Text->autoParagraph(h($orderNews->comment)); ?>
    </div>
</div>
