<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->user_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->user_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Belongs'), ['controller' => 'Belongs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Belong'), ['controller' => 'Belongs', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Ranks'), ['controller' => 'Ranks', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Rank'), ['controller' => 'Ranks', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->Array) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('First Name') ?></th>
            <td><?= h($user->first_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Name') ?></th>
            <td><?= h($user->last_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Belong') ?></th>
            <td><?= $user->has('belong') ? $this->Html->link($user->belong->belong, ['controller' => 'Belongs', 'action' => 'view', $user->belong->belongs_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password') ?></th>
            <td><?= h($user->password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rank') ?></th>
            <td><?= $user->has('rank') ? $this->Html->link($user->rank->ranks_id, ['controller' => 'Ranks', 'action' => 'view', $user->rank->ranks_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User Id') ?></th>
            <td><?= $this->Number->format($user->user_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User Sort Number') ?></th>
            <td><?= $this->Number->format($user->user_sort_number) ?></td>
        </tr>
    </table>
</div>
