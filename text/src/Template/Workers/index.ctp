<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Worker[]|\Cake\Collection\CollectionInterface $workers
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Worker'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Classes'), ['controller' => 'Classes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Class'), ['controller' => 'Classes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Positions'), ['controller' => 'Positions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Position'), ['controller' => 'Positions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Shifts'), ['controller' => 'Shifts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Shift'), ['controller' => 'Shifts', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Duties'), ['controller' => 'Duties', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Duty'), ['controller' => 'Duties', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="workers index large-9 medium-8 columns content">
    <h3><?= __('Workers') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('users_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('classes_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('positions_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shifts_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('duties_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($workers as $worker): ?>
            <tr>
                <td><?= h($worker->date) ?></td>
                <!--<td><?= $worker->has('user') ? $this->Html->link($worker->user->user_id, ['controller' => 'Users', 'action' => 'view', $worker->user->user_id]) : '' ?></td>-->
                <td><?= h($worker->user->first_name . $worker->user->last_name) ?></td>
                <td><?= $worker->has('position') ? $this->Html->link($worker->position->position, ['controller' => 'Positions', 'action' => 'view', $worker->position->position]) : '' ?></td>
                <td><?= $worker->has('shift') ? $this->Html->link($worker->shift->shift, ['controller' => 'Shifts', 'action' => 'view', $worker->shift->shift]) : '' ?></td>
                <td><?= $worker->has('duty') ? $this->Html->link($worker->duty->duty, ['controller' => 'Duties', 'action' => 'view', $worker->duty->duties_id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $worker->date]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $worker->date]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $worker->date], ['confirm' => __('Are you sure you want to delete # {0}?', $worker->date)]) ?>
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
