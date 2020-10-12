<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RiskDetection $riskDetection
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Risk Detections'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Systems'), ['controller' => 'Systems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New System'), ['controller' => 'Systems', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Bases'), ['controller' => 'Bases', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Basis'), ['controller' => 'Bases', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Units'), ['controller' => 'Units', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Unit'), ['controller' => 'Units', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Statuses'), ['controller' => 'Statuses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Status'), ['controller' => 'Statuses', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Reports'), ['controller' => 'Reports', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Report'), ['controller' => 'Reports', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Positives'), ['controller' => 'Positives', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Positive'), ['controller' => 'Positives', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Sec Levels'), ['controller' => 'SecLevels', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Sec Level'), ['controller' => 'SecLevels', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Infection Routes'), ['controller' => 'InfectionRoutes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Infection Route'), ['controller' => 'InfectionRoutes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="riskDetections form large-9 medium-8 columns content">
    <?= $this->Form->create($riskDetection) ?>
    <fieldset>
        <legend><?= __('Add Risk Detection') ?></legend>
        <?php
            echo $this->Form->control('occurrence_datetime', ['empty' => true]);
            echo $this->Form->control('response_start_time');
            echo $this->Form->control('response_end_time', ['empty' => true]);
            echo $this->Form->control('systems_id', ['options' => $systems, 'empty' => true]);
            echo $this->Form->control('bases_id', ['options' => $bases, 'empty' => true]);
            echo $this->Form->control('units_id', ['options' => $units, 'empty' => true]);
            echo $this->Form->control('statuses_id', ['options' => $statuses]);
            echo $this->Form->control('reports_id', ['options' => $reports]);
            echo $this->Form->control('positives_id', ['options' => $positives]);
            echo $this->Form->control('sec_levels_id', ['options' => $secLevels]);
            echo $this->Form->control('infection_routes_id', ['options' => $infectionRoutes]);
            echo $this->Form->control('sim_live_flag');
            echo $this->Form->control('samari_flag');
            echo $this->Form->control('attachment');
            echo $this->Form->control('comment');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
