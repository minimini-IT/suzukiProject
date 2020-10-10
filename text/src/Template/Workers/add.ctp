<?php
    $this->assign("title", "勤務者"); 
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('TOPへ戻る'), ['controller' => 'Dairy', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('ユーザ追加'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('勤務体系追加'), ['controller' => 'Positions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('シフト追加'), ['controller' => 'Shifts', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('特別勤務追加'), ['controller' => 'Duties', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="workers form large-9 medium-8 columns content">
    <?php $today = date("Y年m月d日"); ?>
    <h3><?= $today ?>の勤務者</h3>
    <table>
        <?php foreach($todayWorkers as $todayWorker): ?>
            <tr>
                <td><?= $todayWorker->user->first_name . $todayWorker->user->last_name ?></td>
                <td><?= $todayWorker->position->position ?></td>
                <?php if($todayWorker->shift === null): ?>
                    <td></td>
                <?php else: ?>
                    <td><?= $todayWorker->shift->shift ?></td>
                <?php endif ?>
                <?php if($todayWorker->duty != null): ?>
                    <td><?= $todayWorker->duty->duty ?></td>
                <?php endif ?>
                <!--
                    <td><?= $this->Form->postLink(__('削除'), ['action' => 'delete', [$todayWorker->date, $todayWorker->users_id]], ['confirm' => __('{0} この申し送りを削除してよろしいですか？', $todayWorker->user->first_name . $todayWorker->user->last_name)]) ?></td>
-->
            </tr>
        <?php endforeach ?>
    </table>
    <?= $this->Form->create($worker) ?>
    <fieldset>
        <legend><?= __('勤務者追加') ?></legend>
        <?php
            echo $this->Form->hidden('date', ["value" => date("Y-m-d")]);
            echo str_replace(";", " ", $this->Form->control('users_id', ["type" => "select", "options" => $users]));
            echo $this->Form->control('positions_id', ['options' => $positions]);
            echo $this->Form->control('shifts_id', ['options' => $shifts, "empty" => true]);
            echo $this->Form->control('duties_id', ['options' => $duties, "empty" => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
