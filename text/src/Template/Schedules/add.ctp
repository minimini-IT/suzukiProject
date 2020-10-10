<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Schedule $schedule
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Schedules'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="schedules form large-9 medium-8 columns content">
    <?= $this->Form->create($schedule) ?>
    <fieldset>
        <legend><?= __('Add Schedule') ?></legend>
        <?php
            echo $this->Form->control('schedule_start_date');
            echo $this->Form->control('schedule_end_date');
            echo $this->Form->control('repe_flag', ["type" => "checkbox"]);
            echo $this->Form->control('schedule');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
