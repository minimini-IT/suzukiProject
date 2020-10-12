<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rank $rank
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Rank'), ['action' => 'edit', $rank->ranks_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Rank'), ['action' => 'delete', $rank->ranks_id], ['confirm' => __('Are you sure you want to delete # {0}?', $rank->ranks_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Ranks'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Rank'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="ranks view large-9 medium-8 columns content">
    <h3><?= h($rank->ranks_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Rank') ?></th>
            <td><?= h($rank->rank) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Abb Rank') ?></th>
            <td><?= h($rank->abb_rank) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ranks Id') ?></th>
            <td><?= $this->Number->format($rank->ranks_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rank Sort Number') ?></th>
            <td><?= $this->Number->format($rank->rank_sort_number) ?></td>
        </tr>
    </table>
</div>
