<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RiskDetection $riskDetection
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Risk Detection'), ['action' => 'edit', $riskDetection->risk_detections_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Risk Detection'), ['action' => 'delete', $riskDetection->risk_detections_id], ['confirm' => __('Are you sure you want to delete # {0}?', $riskDetection->risk_detections_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Risk Detections'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Risk Detection'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Systems'), ['controller' => 'Systems', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New System'), ['controller' => 'Systems', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Bases'), ['controller' => 'Bases', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Basis'), ['controller' => 'Bases', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Units'), ['controller' => 'Units', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Unit'), ['controller' => 'Units', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Statuses'), ['controller' => 'Statuses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Status'), ['controller' => 'Statuses', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Reports'), ['controller' => 'Reports', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Report'), ['controller' => 'Reports', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Positives'), ['controller' => 'Positives', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Positive'), ['controller' => 'Positives', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Sec Levels'), ['controller' => 'SecLevels', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sec Level'), ['controller' => 'SecLevels', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Infection Routes'), ['controller' => 'InfectionRoutes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Infection Route'), ['controller' => 'InfectionRoutes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="riskDetections view large-9 medium-8 columns content">
    <h3><?= h($riskDetection->risk_detections_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('System') ?></th>
            <td><?= $riskDetection->has('system') ? $this->Html->link($riskDetection->system->systems_id, ['controller' => 'Systems', 'action' => 'view', $riskDetection->system->systems_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Basis') ?></th>
            <td><?= $riskDetection->has('basis') ? $this->Html->link($riskDetection->basis->bases_id, ['controller' => 'Bases', 'action' => 'view', $riskDetection->basis->bases_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Unit') ?></th>
            <td><?= $riskDetection->has('unit') ? $this->Html->link($riskDetection->unit->units_id, ['controller' => 'Units', 'action' => 'view', $riskDetection->unit->units_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $riskDetection->has('status') ? $this->Html->link($riskDetection->status->status, ['controller' => 'Statuses', 'action' => 'view', $riskDetection->status->statuses_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Report') ?></th>
            <td><?= $riskDetection->has('report') ? $this->Html->link($riskDetection->report->reports_id, ['controller' => 'Reports', 'action' => 'view', $riskDetection->report->reports_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Positive') ?></th>
            <td><?= $riskDetection->has('positive') ? $this->Html->link($riskDetection->positive->positives_id, ['controller' => 'Positives', 'action' => 'view', $riskDetection->positive->positives_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sec Level') ?></th>
            <td><?= $riskDetection->has('sec_level') ? $this->Html->link($riskDetection->sec_level->sec_levels_id, ['controller' => 'SecLevels', 'action' => 'view', $riskDetection->sec_level->sec_levels_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Infection Route') ?></th>
            <td><?= $riskDetection->has('infection_route') ? $this->Html->link($riskDetection->infection_route->infection_routes_id, ['controller' => 'InfectionRoutes', 'action' => 'view', $riskDetection->infection_route->infection_routes_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Risk Detections Id') ?></th>
            <td><?= $this->Number->format($riskDetection->risk_detections_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Occurrence Datetime') ?></th>
            <td><?= h($riskDetection->occurrence_datetime) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Response Start Time') ?></th>
            <td><?= h($riskDetection->response_start_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Response End Time') ?></th>
            <td><?= h($riskDetection->response_end_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sim Live Flag') ?></th>
            <td><?= $riskDetection->sim_live_flag ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Samari Flag') ?></th>
            <td><?= $riskDetection->samari_flag ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Attachment') ?></th>
            <td><?= $riskDetection->attachment ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Comment') ?></h4>
        <?= $this->Text->autoParagraph(h($riskDetection->comment)); ?>
    </div>
</div>
