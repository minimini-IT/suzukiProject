<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\IncidentChronology $incidentChronology
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Incident Chronologies'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Risk Detections'), ['controller' => 'RiskDetections', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Risk Detection'), ['controller' => 'RiskDetections', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="incidentChronologies form large-9 medium-8 columns content">
    <?= $this->Form->create($incidentChronology) ?>
    <fieldset>
        <legend><?= __('Add Incident Chronology') ?></legend>
        <?php
            echo $this->Form->control('risk_detections_id', ['options' => $riskDetections]);
            echo $this->Form->control('users_id', ['options' => $users]);
            echo $this->Form->control('message');
            echo $this->Form->control('reference');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
