<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\IncidentChronology $incidentChronology
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Incident Chronology'), ['action' => 'edit', $incidentChronology->incident_chronologies_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Incident Chronology'), ['action' => 'delete', $incidentChronology->incident_chronologies_id], ['confirm' => __('Are you sure you want to delete # {0}?', $incidentChronology->incident_chronologies_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Incident Chronologies'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Incident Chronology'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Risk Detections'), ['controller' => 'RiskDetections', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Risk Detection'), ['controller' => 'RiskDetections', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="incidentChronologies view large-9 medium-8 columns content">
    <h3><?= h($incidentChronology->incident_chronologies_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Risk Detection') ?></th>
            <td><?= $incidentChronology->has('risk_detection') ? $this->Html->link($incidentChronology->risk_detection->risk_detections_id, ['controller' => 'RiskDetections', 'action' => 'view', $incidentChronology->risk_detection->risk_detections_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $incidentChronology->has('user') ? $this->Html->link($incidentChronology->user->Array, ['controller' => 'Users', 'action' => 'view', $incidentChronology->user->users_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Incident Chronologies Id') ?></th>
            <td><?= $this->Number->format($incidentChronology->incident_chronologies_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($incidentChronology->created) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Message') ?></h4>
        <?= $this->Text->autoParagraph(h($incidentChronology->message)); ?>
    </div>
    <div class="row">
        <h4><?= __('Reference') ?></h4>
        <?= $this->Text->autoParagraph(h($incidentChronology->reference)); ?>
    </div>
</div>
