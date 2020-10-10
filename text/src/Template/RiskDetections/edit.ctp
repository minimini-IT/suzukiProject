<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RiskDetection $riskDetection
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('戻る'), ['controller' => 'RiskDetections', 'action' => 'risk']) ?></li>
        <li><?= $this->Html->link(__('システム追加'), ['controller' => 'Systems', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('基地追加'), ['controller' => 'Bases', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('部隊追加'), ['controller' => 'Units', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('ステータス追加'), ['controller' => 'Statuses', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('報告の有無追加'), ['controller' => 'Reports', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('正・誤検知追加'), ['controller' => 'Positives', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('SecLevel追加'), ['controller' => 'SecLevels', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('侵入経路追加'), ['controller' => 'InfectionRoutes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="riskDetections form large-9 medium-8 columns content">
    <?= $this->Form->create($riskDetection) ?>
    <fieldset>
        <legend><?= __('編集') ?></legend>
        <?php
            echo $this->Form->control('systems_id', ["label" => "システム", 'options' => $systems, 'empty' => true]);
            echo $this->Form->control('bases_id', ["label" => "基地", 'options' => $bases, 'empty' => true]);
            echo $this->Form->control('units_id', ["label" => "部隊", 'options' => $units, 'empty' => true]);
            echo $this->Form->control('occurrence_datetime', ["label" => "発生時刻", 'empty' => true]);
            echo $this->Form->control('response_start_time', ["label" => "対処開始時刻"]);
            echo $this->Form->control('response_end_time', ["label" => "対処完了時刻", 'empty' => true]);
            echo $this->Form->control('statuses_id', ["label" => "ステータス", 'options' => $statuses]);
            echo $this->Form->control('reports_id', ["label" => "報告の有無", 'options' => $reports]);
            echo $this->Form->control('positives_id', ["label" => "正・誤検知", 'options' => $positives]);
            echo $this->Form->control('sec_levels_id', ["label" => "Sec Level", 'options' => $secLevels]);
            echo $this->Form->control('infection_routes_id', ["label" => "侵入経路", 'options' => $infectionRoutes]);
            echo $this->Form->control('sim_live_flag', ["label" => "シムフラグ"]);
            echo $this->Form->control('samari_flag', ["label" => "サマリ強制表示"]);
            echo $this->Form->control('comment', ["label" => "基本情報"]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
