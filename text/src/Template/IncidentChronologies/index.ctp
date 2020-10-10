<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\IncidentChronology[]|\Cake\Collection\CollectionInterface $incidentChronologies
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Incident Chronology'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Risk Detections'), ['controller' => 'RiskDetections', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Risk Detection'), ['controller' => 'RiskDetections', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="incidentChronologies index large-9 medium-8 columns content">
    <h3><?= __('Incident Chronologies') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('incident_chronologies_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('risk_detections_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('users_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($incidentChronologies as $incidentChronology): ?>
            <tr>
                <td><?= $this->Number->format($incidentChronology->incident_chronologies_id) ?></td>
                <td><?= $incidentChronology->has('risk_detection') ? $this->Html->link($incidentChronology->risk_detection->risk_detections_id, ['controller' => 'RiskDetections', 'action' => 'view', $incidentChronology->risk_detection->risk_detections_id]) : '' ?></td>
                <td><?= h($incidentChronology->created) ?></td>
                <td><?= $incidentChronology->has('user') ? $this->Html->link($incidentChronology->user->Array, ['controller' => 'Users', 'action' => 'view', $incidentChronology->user->users_id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $incidentChronology->incident_chronologies_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $incidentChronology->incident_chronologies_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $incidentChronology->incident_chronologies_id], ['confirm' => __('Are you sure you want to delete # {0}?', $incidentChronology->incident_chronologies_id)]) ?>
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
