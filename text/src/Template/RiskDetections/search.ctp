<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RiskDetection[]|\Cake\Collection\CollectionInterface $riskDetections
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('一覧へ戻る'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('TOPへ戻る'), ['controller' => 'Dairy', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('新規作成'), ['action' => 'riskAdd']) ?></li>
        <li><?= $this->Html->link(__('システム追加'), ['controller' => 'Systems', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('基地追加'), ['controller' => 'Bases', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('部隊追加'), ['controller' => 'Units', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('ステータス追加'), ['controller' => 'Statuses', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('報告有無追加'), ['controller' => 'Reports', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('検知状況追加'), ['controller' => 'Positives', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('SecLevel追加'), ['controller' => 'SecLevels', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('感染経路追加'), ['controller' => 'InfectionRoutes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="riskDetections index large-9 medium-8 columns content">
    <h3><?= __('リスク検知') ?></h3>
<?php /*
    <h5><?= __('検索') ?></h5>
    <div>
        <?= $this->Form->create("", [
            "type" => "get",
            "url" => [
                "controller" => "risk_detections",
                "action" => "search"
            ]
        ]) ?>
        <?= $this->Form->control('response_start_time', ["label" => "対処開始時刻"])?>
        <?= $this->Form->control("systems_id", ["label" => "システム", "options" => $systems, "hiddenField" => false, "empty" => true])?>
        <?= $this->Form->control("bases_id", ["label" => "基地", "options" => $bases, "hiddenField" => false, "empty" => true])?>
        <?= $this->Form->control("units_id", ["label" => "部隊", "options" => $units, "hiddenField" => false, "empty" => true])?>
        <?= $this->Form->control("statuses_id", ["label" => "ステータス", "options" => $statuses, "hiddenField" => false, "empty" => true])?>
        <?= $this->Form->control("reports_id", ["label" => "報告の有無", "options" => $reports, "hiddenField" => false, "empty" => true])?>
        <?= $this->Form->control("positives_id", ["label" => "正・誤検知", "options" => $positives, "hiddenField" => false, "empty" => true])?>
        <?= $this->Form->control("sec_levels_id", ["label" => "Sec Level", "options" => $secLevels, "hiddenField" => false, "empty" => true])?>
        <?= $this->Form->control("infection_routes_id", ["label" => "侵入経路", "options" => $infectionRoutes, "hiddenField" => false, "empty" => true])?>
        <?= $this->Form->control("comment", ["label" => "基本情報"])?>
        <?= $this->Form->button(__('検索')) ?>
        <?= $this->Form->end() ?>
    </div>
 */ ?>


    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('ID') ?></th>
<?php /*
                <th scope="col"><?= $this->Paginator->sort('発生時刻') ?></th>
 */ ?>
                <th scope="col"><?= $this->Paginator->sort('対処開始時刻') ?></th>
<?php /*
                <th scope="col"><?= $this->Paginator->sort('対処完了時刻') ?></th>
 */ ?>
                <th scope="col"><?= $this->Paginator->sort('システム') ?></th>
                <th scope="col"><?= $this->Paginator->sort('基地') ?></th>
                <th scope="col"><?= $this->Paginator->sort('部隊') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ステータス') ?></th>
                <th scope="col"><?= $this->Paginator->sort('報告の有無') ?></th>
                <th scope="col"><?= $this->Paginator->sort('正・誤検知') ?></th>
                <th scope="col"><?= $this->Paginator->sort('SecLevel') ?></th>
                <th scope="col"><?= $this->Paginator->sort('基本情報') ?></th>
<?php /*
                <th scope="col"><?= $this->Paginator->sort('感染経路') ?></th>
 */ ?>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
    </table>
    <?php foreach ($riskDetections as $riskDetection): ?>
    <table class="branch">
        <tbody>
            <tr>
                <td><?= 
                    h($riskDetection->incident_management->management_prefix->management_prefix) . "-" .  
                    $riskDetection->incident_management->created->format("Ymd") . "-" .  
                    h($riskDetection->incident_management->number)
                ?></td>
<?php /*
                <td><?= h($riskDetection->occurrence_datetime) ?></td>
 */ ?>
                <td><?= h($riskDetection->response_start_time->format("Y-m-d H:i")) ?></td>
<?php /*
                <td><?= h($riskDetection->response_end_time) ?></td>
 */ ?>
                <td><?= $riskDetection->system->system ?></td>
                <td><?= $riskDetection->basis->base ?></td>
                <td><?= $riskDetection->unit->unit ?></td>
                <td><?= $riskDetection->status->status ?></td>
                <td><?= $riskDetection->report->report ?></td>
                <td><?= $riskDetection->positive->positive ?></td>
                <td><?= $riskDetection->sec_level->sec_level ?></td>
<?php /*
                <td><?= $riskDetection->infection_route->infection_route ?></td>
 */ ?>
                <td><?= $riskDetection->comment ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $riskDetection->risk_detections_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $riskDetection->risk_detections_id], ['confirm' => __('Are you sure you want to delete # {0}?', $riskDetection->risk_detections_id)]) ?>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="node">
        <div id="detection">
            <table>
                <tr>
                    <th>発生時刻</th>
                    <th>対処完了時刻</th>
                    <th>侵入経路</th>
                </tr>
                <tr>
                    <td><?= $riskDetection->occurrence_datetime != null ? h($riskDetection->occurrence_datetime->format("Y-m-d H:i")) : "" ?></td>
                    <td><?= $riskDetection->response_end_time != null ? h($riskDetection->response_end_time->format("Y-m-d H:i")) : "" ?></td>
                    <td><?= h($riskDetection->infection_route->infection_route) ?></td>
                </tr>
            </table>
        </div>
        <table>
            <tr>
                <th>ID</th>
                <th>作成日時</th>
                <th>作成者</th>
                <th>処置内容</th>
                <th>備考</th>
            </tr>
            <?php foreach ($riskDetection->incident_chronologies as $incident_chronology): ?>
            <tr>
                <td><?= 
                    h($riskDetection->incident_management->management_prefix->management_prefix) . "-" .  
                    $riskDetection->incident_management->created->format("Ymd") . "-" .  
                    h($riskDetection->incident_management->number)
                ?></td>
                <td><?= $incident_chronology->created->format("Y-m-d H:i") ?></td>
                <td><?= h($incident_chronology->user->first_name . $incident_chronology->user->last_name) ?></td>
                <td><?= $incident_chronology->message ?></td>
                <td><?= $incident_chronology->reference ?></td>
            </tr>
            <?php endforeach ?>
        </table>
    </div>
    <?php endforeach ?>




    <?php /*






        <tbody>
            <?php foreach ($riskDetections as $riskDetection): ?>
            <tr>
                <td><?= 
                    h($riskDetection->incident_management->management_prefix->management_prefix) . "-" .  
                    $riskDetection->incident_management->created->format("Ymd") . "-" .  
                    h($riskDetection->incident_management->number)
                ?></td>
<?php /*
                <td><?= h($riskDetection->occurrence_datetime) ?></td>

                <td><?= h($riskDetection->response_start_time) ?></td>
<?php /*
                <td><?= h($riskDetection->response_end_time) ?></td>

                <td><?= $riskDetection->system->system ?></td>
                <td><?= $riskDetection->basis->base ?></td>
                <td><?= $riskDetection->unit->unit ?></td>
                <td><?= $riskDetection->status->status ?></td>
                <td><?= $riskDetection->report->report ?></td>
                <td><?= $riskDetection->positive->positive ?></td>
                <td><?= $riskDetection->sec_level->sec_level ?></td>
<?php /*
                <td><?= $riskDetection->infection_route->infection_route ?></td>

                <td><?= $riskDetection->comment ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $riskDetection->risk_detections_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $riskDetection->risk_detections_id], ['confirm' => __('Are you sure you want to delete # {0}?', $riskDetection->risk_detections_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
 */ ?>
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
