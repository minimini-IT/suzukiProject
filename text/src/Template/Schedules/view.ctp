<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Schedule $schedule
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Schedule'), ['action' => 'edit', $schedule->schedules_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Schedule'), ['action' => 'delete', $schedule->schedules_id], ['confirm' => __('Are you sure you want to delete # {0}?', $schedule->schedules_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Schedules'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Schedule'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="schedules view large-9 medium-8 columns content">
    <h3><?= h($schedule->schedules_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Schedules Id') ?></th>
            <td><?= $this->Number->format($schedule->schedules_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Repe Flag') ?></th>
            <td><?= $this->Number->format($schedule->repe_flag) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Schedule Start Date') ?></th>
            <td><?= h($schedule->schedule_start_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Schedule End Date') ?></th>
            <td><?= h($schedule->schedule_end_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($schedule->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($schedule->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Schedule') ?></h4>
        <?= $this->Text->autoParagraph(h($schedule->schedule)); ?>
    </div>
</div>
