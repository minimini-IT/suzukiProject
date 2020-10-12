<?php 
    $this->assign("title", "日誌"); 
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
  <ul class="side-nav">
    <li class="heading"><?= __('Actions') ?></li>
    <li><?= $this->Html->link(__('サイバー攻撃等'), ['controller' => 'RiskDetections', 'action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('クルー申し送り'), ["controller" => "CrewSends", 'action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('メッセージボード'), ['controller' => 'MessageBords', 'action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('勤務者入力'), ['controller' => 'Workers', 'action' => 'add']) ?></li>
    <li><?= $this->Html->link(__('ユーザ一覧'), ['controller' => 'Users', 'action' => 'index']) ?></li>
  </ul>
<!--説明-->
  <p>日誌的なページ</p>
  <p>最終的には</p>
  <ul>
    <li>今日の予定</li>
    <li>今週の予定</li>
    <li>命令</li>
    <li>日付</li>
    <li>今日の勤務者</li>
    <li>対処中のインシデント</li>
    <li>対処状況</li>
    <li>班内アナウンス</li>
  </ul>
  <p>を表示予定</p>
</nav>

<div class="schedules index large-9 medium-8 columns content">
                <h4><?= $today ?></h4>
    <table cellpadding="0" cellspacing="0">
        <tbody>
            <tr>
                <th>今日の予定</th>
            </tr>
            <?php foreach ($today_schedules as $schedule): ?>
            <tr>
<!--
                <td><?= $this->Number->format($schedule["schedules_id"]) ?></td>
                <td><?= h($schedule["schedule_start_date"]) ?></td>
                <td><?= h($schedule["schedule_end_date"]) ?></td>
                <td><?= $this->Number->format($schedule["repe_flag"]) ?></td>
                <td><?= h($schedule["schedule"]) ?></td>
                <td><?= h($schedule["created"]) ?></td>
                <td><?= h($schedule["modified"]) ?></td>
-->
                <td><?= h($schedule["schedule"]) ?></td>
                <?php if($schedule["schedule_start_date"] != $schedule["schedule_end_date"]){ ?>
                    <td><?= h($schedule["schedule_start_date"]) . "〜" . h($schedule["schedule_end_date"]) ?></td>
                <?php }else{ ?>
                    <td></td>
                <?php } ?>
                <!--
                <td>
                    <?= $this->Html->link(__('View'), ['action' => 'view', $schedule["schedules_id"]]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $schedule["schedules_id"]]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $schedule["schedules_id"]], ['confirm' => __('Are you sure you want to delete # {0}?', $schedule["schedules_id"])]) ?>
                </td>
-->
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <th>今週の予定</th>
            </tr>

            <?php foreach ($weekry_schedules as $schedule): ?>
              <!--
            <tr>
                <td>Weekly Schedules</td>
            </tr>
            <tr>
                <td><?= $this->Number->format($schedule["schedules_id"]) ?></td>
                <td><?= h($schedule["schedule_start_date"]) ?></td>
                <td><?= h($schedule["schedule_end_date"]) ?></td>
                <td><?= $this->Number->format($schedule["repe_flag"]) ?></td>
                <td><?= h($schedule["schedule"]) ?></td>
                <td><?= h($schedule["created"]) ?></td>
                <td><?= h($schedule["modified"]) ?></td>
                <td>
                    <?= $this->Html->link(__('View'), ['action' => 'view', $schedule["schedules_id"]]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $schedule["schedules_id"]]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $schedule["schedules_id"]], ['confirm' => __('Are you sure you want to delete # {0}?', $schedule["schedules_id"])]) ?>
                </td>
-->
            <tr>
                <td><?= h($schedule["schedule"]) ?></td>
                <td><?= h($schedule["schedule_start_date"]) . "〜" . h($schedule["schedule_end_date"]) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <th>命令会報等</th>
            </tr>

            <?php foreach ($orderNews as $ordernews): ?>
            <!--
            <tr>
                <td>orderNews</td>
            </tr>
-->
            <tr>
<!--
                <td><?= $this->Number->format($ordernews->order_news_id) ?></td>
                <td><?= h($ordernews->order_news_date) ?></td>
                <td><?= h($ordernews->title) ?></td>
                <td><?= h($ordernews->comment) ?></td>
                <td><?= h($ordernews->created) ?></td>
                <td><?= h($ordernews->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $ordernews->order_news_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $ordernews->order_news_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $ordernews->order_news_id], ['confirm' => __('Are you sure you want to delete # {0}?', $ordernews->order_news_id)]) ?>
                </td>
-->
                <td><?= h($ordernews->title) ?></td>
                <td><?= h($ordernews->comment) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <th>勤務者</th>
            </tr>
            <?php foreach ($workers as $worker): ?>
                <tr>
                    <td><?= h($worker->user->first_name . $worker->user->last_name) ?></td>
                    <td><?= h($worker->position->position) ?></td>
                    <?php if($worker->shift == null): ?>
                        <td></td>
                    <?php else: ?>
                        <td><?= h($worker->shift->shift) ?></td>
                    <?php endif ?>
                    <?php if($worker->duty == null): ?>
                        <td></td>
                    <?php else: ?>
                        <td><?= h($worker->duty->duty) ?></td>
                    <?php endif ?>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <th>サイバー攻撃等対処状況</th>
            </tr>
            <?php foreach ($nowStatus as $key=>$value): ?>
                <tr>
                    <td><?= h($key) ?></td>
                    <td><?= h($value) ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
