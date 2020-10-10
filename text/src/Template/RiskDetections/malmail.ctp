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
        <li><?= $this->Html->link(__('新規作成'), ['action' => 'malmailAdd']) ?></li>
        <li><?= $this->Html->link(__('システム追加'), ['controller' => 'Systems', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('基地追加'), ['controller' => 'Bases', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('部隊追加'), ['controller' => 'Units', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('ステータス追加'), ['controller' => 'Statuses', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('報告有無追加'), ['controller' => 'Reports', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('検知状況追加'), ['controller' => 'Positives', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('SecLevel追加'), ['controller' => 'SecLevels', 'action' => 'add']) ?></li>
    </ul>
    <p>値を何も入れずに検索を押すと全検索となる</p>
</nav>
<div class="riskDetections index large-9 medium-8 columns content">
    <h3><?= __('不審メール') ?></h3>
    <h5><?= __('検索') ?></h5>
    <div>
        <?= $this->Form->create("", [
            "type" => "get",
            "url" => [
                "controller" => "risk_detections",
                "action" => "malmail"
            ]
        ]) ?>
        <?= $this->Form->control('response_start_time', ["label" => "対処開始日", "type" => "text", "class" => "datepicker"])?>
        <?= $this->Form->label("から") ?>
        <?= $this->Form->control('response_start_time_end', ["label" => "", "type" => "text", "class" => "datepicker"])?>
        <?= $this->Form->control("systems_id", ["label" => "システム", "options" => $systems, "hiddenField" => false, "empty" => true])?>
        <?= $this->Form->control("bases_id", ["label" => "基地", "options" => $bases, "hiddenField" => false, "empty" => true])?>
        <?= $this->Form->control("units_id", ["label" => "部隊", "options" => $units, "hiddenField" => false, "empty" => true])?>
        <?= $this->Form->control("statuses_id", ["label" => "ステータス", "options" => $statuses, "hiddenField" => false, "empty" => true])?>
        <?= $this->Form->control("reports_id", ["label" => "報告の有無", "options" => $reports, "hiddenField" => false, "empty" => true])?>
        <?= $this->Form->control("positives_id", ["label" => "正・誤検知", "options" => $positives, "hiddenField" => false, "empty" => true])?>
        <?= $this->Form->control("sec_levels_id", ["label" => "Sec Level", "options" => $secLevels, "hiddenField" => false, "empty" => true])?>
        <?= $this->Form->control("attachment", ["label" => "添付ファイル", "options" => [1 => "あり", 0 => "なし"], "hiddenField" => false, "empty" => true])?>
        <?= $this->Form->control("comment", ["label" => "基本情報"])?>
        <?= $this->Form->button(__('検索')) ?>
        <?= $this->Form->end() ?>

        <!-- 検索初期化 -->
        <?= $this->Form->create("", [
            "type" => "post",
            "url" => [
                "controller" => "risk_detections",
                "action" => "malmail"
            ]
        ]) ?>
        <?= $this->Form->button(__('検索初期化')) ?>
        <?= $this->Form->end() ?>

    </div>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('ID') ?></th>
                <th scope="col"><?= $this->Paginator->sort('対処開始時刻') ?></th>
                <th scope="col"><?= $this->Paginator->sort('システム') ?></th>
                <th scope="col"><?= $this->Paginator->sort('基地') ?></th>
                <th scope="col"><?= $this->Paginator->sort('部隊') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ステータス') ?></th>
                <th scope="col"><?= $this->Paginator->sort('報告の有無') ?></th>
                <th scope="col"><?= $this->Paginator->sort('正・誤検知') ?></th>
                <th scope="col"><?= $this->Paginator->sort('SecLevel') ?></th>
                <th scope="col"><?= $this->Paginator->sort('添付ファイルの有無') ?></th>
                <th scope="col"><?= $this->Paginator->sort('リンクの有無') ?></th>
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
                <td><?= h($riskDetection->response_start_time->format("Y-m-d H:i")) ?></td>
                <td><?= $riskDetection->system->system ?></td>
                <td><?= $riskDetection->basis->base ?></td>
                <td><?= $riskDetection->unit->unit ?></td>
                <td><?= $riskDetection->status->status ?></td>
                <td><?= $riskDetection->report->report ?></td>
                <td><?= $riskDetection->positive->positive ?></td>
                <td><?= $riskDetection->sec_level->sec_level ?></td>
                <td><?= $riskDetection->attachment == 1 ? "あり" : "なし" ?></td>
                <td><?= $riskDetection->link == 1 ? "あり" : "なし" ?></td>
<?php /*
                <td><?= h($riskDetection->sim_live_flag) ?></td>
                <td><?= h($riskDetection->samari_flag) ?></td>
                <td><?= h($riskDetection->attachment) ?></td>
*/ ?>
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
                    <th>受信時刻</th>
                    <th>対処完了時刻</th>
                </tr>
                <tr>
                    <td><?= $riskDetection->occurrence_datetime != null ? h($riskDetection->occurrence_datetime->format("Y-m-d H:i")) : "" ?></td>
                    <td><?= $riskDetection->response_end_time != null ? h($riskDetection->response_end_time->format("Y-m-d H:i")) : "" ?></td>
                </tr>
            </table>
            <table>
                <tr>
                    <th>受信者</th>
                </tr>
                <tr>
                    <?php foreach($riskDetection->suspicious_destination_addresses as $address): ?>
                        <td><?= $address->destination_address ?></td>
                    <?php endforeach ?>
                </tr>
            </table>
            <div>
                <?php 
                    echo $this->Form->create($destinationAddress, [
                      "url" => [
                        "controller" => "suspicious_destination_addresses",
                        "action" => "add"
                      ]
                    ]);
                    echo "<fieldset>";
                    echo $this->Form->control('risk_detections_id', ["type" => "hidden", 'value' => $riskDetection->risk_detections_id]);
                    echo $this->Form->control('destination_address', ["label" => "受信者", "class" => "address", "id" => null, "name" => "destination_address[0]"]);
                    echo "<input class='addAddress' type='button' value='追加' />";
                    echo "<input class='removeAddress' type='button' value='削除' />";
                    echo $this->Form->button(__('Submit'));
                    echo $this->Form->end();
                ?>
            </div>
            <table>
                <tr>
                    <th>リンク先</th>
                </tr>
                <tr>
                    <?php foreach($riskDetection->suspicious_links as $suspiciousLink): ?>
                        <td><?= $suspiciousLink->link ?></td>
                    <?php endforeach ?>
                </tr>
            </table>
            <div>
                <?php 
                    echo $this->Form->create($link, [
                      "url" => [
                        "controller" => "suspicious_links",
                        "action" => "add"
                      ]
                    ]);
                    echo "<fieldset>";
                    echo $this->Form->control('risk_detections_id', ["type" => "hidden", 'value' => $riskDetection->risk_detections_id]);
                    //echo $this->Form->control('link', ["type" => "text", "value" => ""]);
                    echo $this->Form->control('link', ["type" => "text", "label" => "リンク", "class" => "link", "id" => null, "name" => "link[0]"]);
                    echo "<input class='addLink' type='button' value='追加' />";
                    echo "<input class='removeLink' type='button' value='削除' />";
                    echo $this->Form->button(__('Submit'));
                    echo $this->Form->end();
                ?>
            </div>
        </div>
        <table>
            <tr>
                <th>ID</th>
                <th>作成日時</th>
                <th>作成者</th>
                <th>処置内容</th>
                <th>備考</th>
            </tr>
            <?php $countID = 1 ?>
            <?php foreach ($riskDetection->incident_chronologies as $incident_chronology): ?>
            <tr>
                <td><?= $countID ?></td>
                <td><?= $incident_chronology->created->format("Y-m-d H:i") ?></td>
                <td><?= h($incident_chronology->user->first_name . $incident_chronology->user->last_name) ?></td>
                <td><?= $incident_chronology->message ?></td>
                <td><?= $incident_chronology->reference ?></td>
            </tr>
            <?php $countID++ ?>
            <?php endforeach ?>
        </table>
        <div>
        <!-- incident_chronology 入力 -->
          <?php
            //ログインしているユーザ
            //$loginUser = $this->request->session()->read("Auth.User.users_id");
            $loginUser = $this->getRequest()->getSession()->read("Auth.User.users_id");

            echo $this->Form->create($incidentChronology, [
              "url" => [
                "controller" => "incident_chronologies",
                "action" => "add"
              ]
            ]); 
            echo "<fieldset>";
            echo str_replace(";", " ", $this->Form->control('users_id', ["value" => $loginUser, "type" => "select", "options" => $users])); 
            echo $this->Form->control('created');
            echo $this->Form->control('message', ["type" => "textarea", "value" => ""]);
            echo $this->Form->control('reference', ["type" => "textarea", "value" => ""]);
            echo $this->Form->control('risk_detections_id', ["type" => "hidden", 'value' => $riskDetection->risk_detections_id]);
            echo $this->Form->button(__('Submit'));
            echo $this->Form->end();
          ?>

        </div>
    </div>

    <?php endforeach ?>

    


    <!-- ここまで -->
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
