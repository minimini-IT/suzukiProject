<?php
$this->assign("title", "ユーザ追加");
$this->Html->script("p_toggle.js", ["block" => true]);
?>
<div class="uk-grid grid-margin-remove">

    <div class="small-subbar">
        <nav class="uk-navbar-container" uk-navbar>
            <div class="uk-navbar-right">
                <ul class="uk-navbar-nav">
                   <li class="small-subbar-li"><?= $this->Html->link(__('戻る'), ['action' => 'top'], ['class' => 'uk-button uk-button-primary management-sub-button uk-padding-remove small-subbar-height']) ?></li>
                   <li class="small-subbar-li"><?= $this->Html->link(__('LOGOUT'), ['action' => 'logout'], ['class' => 'uk-button uk-button-primary management-sub-button uk-padding-remove small-subbar-height']) ?></li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="uk-width-3-4@s medium-margin uk-width-1-1 grid-child">
        <div class="grid-next-margin uk-card uk-card-default uk-padding">
            <?= $this->Form->create($managementUser) ?>
            <?php $this->Form->setTemplates([
                "inputContainer" => "<div class='input {{type}} {{required}} uk-margin-bottom'>{{content}}</div>",
            ]); ?>
            <?= $this->Form->control('last_name', ["label" => "姓 : ", "class" => "uk-input uk-form-width-medium"]) ?>
            <?= $this->Form->control('first_name', ["label" => "名 : ", "class" => "uk-input uk-form-width-medium"]) ?>
            <?= $this->Form->control('mail', ["label" => "メールアドレス : ", "class" => "uk-input uk-form-width-large"]) ?>

            <?php $this->Form->setTemplates([
                "inputContainer" => "<div class='input {{type}} {{required}} uk-margin-large-bottom'><div class='uk-inline'>{{content}}</div></div>",
                'formGroup' => "{{label}}<div class='uk-inline'><a href='#' class='uk-form-icon uk-form-icon-flip toggle-password' uk-icon='icon: lock'></a>{{input}}</div>",
            ]); ?>
            <?= $this->Form->control('password', ["label" => "パスワード : ", "class" => "uk-input uk-form-width-large"]) ?>

            <div class="uk-padding uk-padding-remove-top uk-text-right">
                <?= $this->Form->button(__('送信'), ["class" => "uk-button uk-button-default"]) ?>
            </div>
        <?= $this->Form->end() ?>
        </div>
    </div>
    <div class="uk-width-1-4 uk-padding-remove uk-text-center small-remove">
        <ul class="uk-list">
            <li><?= $this->Html->link(__('LOGOUT'), ['action' => 'logout'], ['class' => 'uk-button uk-button-primary uk-margin-bottom management-sub-button uk-padding-remove']) ?></li>
            <li class=><?= $this->Html->link(__('戻る'), ['action' => 'index'], ['class' => 'uk-button uk-button-primary uk-margin-bottom management-sub-button uk-padding-remove']) ?></li>
        </ul>
    </div>
</div>
