<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Worker $worker
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Worker'), ['action' => 'edit', $worker->date]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Worker'), ['action' => 'delete', $worker->date], ['confirm' => __('Are you sure you want to delete # {0}?', $worker->date)]) ?> </li>
        <li><?= $this->Html->link(__('List Workers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Worker'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Classes'), ['controller' => 'Classes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Class'), ['controller' => 'Classes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Positions'), ['controller' => 'Positions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Position'), ['controller' => 'Positions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Shifts'), ['controller' => 'Shifts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Shift'), ['controller' => 'Shifts', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Duties'), ['controller' => 'Duties', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Duty'), ['controller' => 'Duties', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="workers view large-9 medium-8 columns content">
    <h3><?= h($worker->date) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $worker->has('user') ? $this->Html->link($worker->user->user_id, ['controller' => 'Users', 'action' => 'view', $worker->user->user_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Class') ?></th>
            <td><?= $worker->has('class') ? $this->Html->link($worker->class->class, ['controller' => 'Classes', 'action' => 'view', $worker->class->classes_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Position') ?></th>
            <td><?= $worker->has('position') ? $this->Html->link($worker->position->positions_id, ['controller' => 'Positions', 'action' => 'view', $worker->position->positions_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shift') ?></th>
            <td><?= $worker->has('shift') ? $this->Html->link($worker->shift->shifts_id, ['controller' => 'Shifts', 'action' => 'view', $worker->shift->shifts_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Duty') ?></th>
            <td><?= $worker->has('duty') ? $this->Html->link($worker->duty->duties_id, ['controller' => 'Duties', 'action' => 'view', $worker->duty->duties_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($worker->date) ?></td>
        </tr>
    </table>
</div>
