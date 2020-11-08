<?php
$this->assign("title", "管理画面");

?>
<div class="row">
    <div class="column-responsive column-80">
        <div class="dashboard_management index content">
            <div style="margin-bottom: 5rem;">
                <h4>ユーザ管理</h4>
                <?= $this->Html->link(__('ユーザ一覧'), ['controller' => 'management_users', 'action' => 'index']) ?>
            </div>
            <div style="margin-bottom: 5rem;">
                <h4>記事を書く</h4>
                <?= $this->Html->link(__('記事作成'), ['controller' => 'patients', 'action' => 'add']) ?>
                <?= $this->Html->link(__('記事編集一覧'), ['controller' => 'DashboardManagement', 'action' => 'select']) ?>
            </div>
            <div style="margin-bottom: 5rem;">
                <h4>インタビューを書く</h4>
                <?= $this->Html->link(__('インタビュー作成'), ['controller' => 'Patients', 'action' => 'add']) ?>
            </div>
        </div>
    </div>
    <div class="column">
        <p><?= $this->Html->link(__('戻る'), ['controller' => 'Top', 'action' => 'index']) ?></p>
        <p><?= $this->Html->link(__('LOGOUT'), ['controller' => 'ManagementUsers', 'action' => 'logout']) ?></p>
    </div>
</div>
