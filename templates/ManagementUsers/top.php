<?php
$this->assign("title", "管理画面");
?>
<div class="uk-grid grid-margin-remove">

    <div class="small-subbar">
        <nav class="uk-navbar-container" uk-navbar>
            <div class="uk-navbar-right">
                <ul class="uk-navbar-nav">
                    <li class="small-subbar-li"><?= $this->Html->link(__('LOGOUT'), ['action' => 'logout'], ['class' => 'uk-button uk-button-primary management-sub-button uk-padding-remove small-subbar-height']) ?></li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="uk-width-3-4@s uk-width-1-1 grid-child">
        <div class="uk-grid uk-child-width-1-3@s uk-child-width-1-2 grid-margin-remove">

            <div class="uk-padding medium-padding-remove-ud uk-background-muted uk-first-column">
                <h4 class="uk-text-center">ユーザ管理</h4>
                <ul class="uk-list uk-list-square">
                    <li><?= $this->Html->link(__('ユーザ一覧'), ['controller' => 'management_users', 'action' => 'index']) ?></li>
                </ul>
            </div>

            <div class="uk-padding medium-padding-remove-lr">
                <h4 class="uk-text-center">記事</h4>
                <ul class="uk-list uk-list-square">
                    <li><?= $this->Html->link(__('作成'), ['controller' => 'patients', 'action' => 'add']) ?></li>
                    <li><?= $this->Html->link(__('編集一覧'), ['controller' => 'patients', 'action' => 'select']) ?></li>
                </ul>
            </div>

            <div class="uk-padding medium-padding-remove-lr uk-background-muted">
                <h4 class="uk-text-center">インタビュー</h4>
                <ul class="uk-list uk-list-square">
                    <li><?= $this->Html->link(__('作成'), ['controller' => 'Patients', 'action' => 'add']) ?></li>
                    <li><?= $this->Html->link(__('編集一覧'), ['controller' => 'patients', 'action' => 'select']) ?></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="uk-width-1-4 uk-padding-remove uk-text-center small-remove">
        <ul class="uk-list">
            <li><?= $this->Html->link(__('LOGOUT'), ['action' => 'logout'], ['class' => 'uk-button uk-button-primary uk-margin-bottom management-sub-button uk-padding-remove']) ?></li>
        </ul>
    </div>
</div>

