<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RiskDetection $riskDetection
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('戻る'), ['action' => 'risk']) ?></li>
        <li><?= $this->Html->link(__('TOPへ'), ['controller' => 'Dairy', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="riskDetections form large-9 medium-8 columns content">
    <?= $this->Form->create($riskDetection) ?>
    <fieldset>
        <legend><?= __('新規作成') ?></legend>
        <?php
            echo $this->Form->control('systems_id', ["label" => "システム", 'options' => $systems, 'empty' => true]);
            echo $this->Form->control('occurrence_datetime', ["label" => "発生時刻", 'empty' => true]);
            echo $this->Form->control('response_start_time', ["label" => "対処開始時刻"]);
            echo $this->Form->control('response_end_time', ["label" => "対処終了時刻", 'empty' => true]);
            echo $this->Form->control('bases_id', ["label" => "基地", 'options' => $bases, 'empty' => true]);
            echo $this->Form->control('units_id', ["label" => "部隊", 'options' => $units, 'empty' => true]);
            echo $this->Form->control('statuses_id', ["label" => "ステータス", 'options' => $statuses]);
            echo $this->Form->control('reports_id', ["label" => "報告の有無", 'options' => $reports]);
            echo $this->Form->control('positives_id', ["label" => "正/誤検知", 'options' => $positives]);
            echo $this->Form->control('sec_levels_id', ["label" => "SecLevel", 'options' => $secLevels]);
            echo $this->Form->control('infection_routes_id', ["label" => "侵入経路", 'options' => $infectionRoutes]);
            echo $this->Form->control('sim_live_flag', ["label" => "シム/ライブ"]);
            echo $this->Form->control('samari_flag', ["label" => "サマリ強制表示"]);
            echo $this->Form->control('attachment', ["type" => "hidden", "value" => 0]);
            echo $this->Form->control('incident_cases_id', ["type" => "hidden", "value" => 2]);
            echo $this->Form->control('comment', ["label" => "基本情報", "type" => "textarea"]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
