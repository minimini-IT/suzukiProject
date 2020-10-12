<?php
$this->assign("title", "管理画面");
?>
<div class="dashboard_management index content">
    <div style="margin-bottom: 5rem;">
        <h4>ユーザ管理</h4>
        <?= $this->Html->link(__('ユーザ一覧'), ['controller' => 'management_users', 'action' => 'index']) ?>
    </div>
</div>
