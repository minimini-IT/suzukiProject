<?php
$this->assign("title", "病名追加");
$this->Html->script("addCheckbox.js", ["block" => true]);
?>
<div class="uk-grid grid-margin-remove">
    <div class="small-subbar">
        <nav class="uk-navbar-container" uk-navbar>
            <div class="uk-navbar-right">
                <ul class="uk-navbar-nav">
                   <li class="small-subbar-li"><?= $this->Html->link(__('戻る'), $this->request->referer(), ['class' => 'uk-button uk-button-primary management-sub-button uk-padding-remove small-subbar-height']) ?></li>
                   <li class="small-subbar-li"><?= $this->Html->link(__('LOGOUT'), ['action' => 'logout'], ['class' => 'uk-button uk-button-primary management-sub-button uk-padding-remove small-subbar-height']) ?></li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="small-subbar uk-text-center">
        <div class="uk-container">
            <p><span style="color: red;">病名入力</span><span uk-icon='icon: chevron-right; ratio: 2'></span>症状入力<span uk-icon='icon: chevron-right; ratio: 2'></span>部位入力</p>
        </div>
    </div>
    <div class="uk-width-3-4@s medium-margin uk-width-1-1 grid-child">
        <div class="uk-card uk-card-default">
            <div class="grid-next-margin uk-padding-large">
                <?= $this->Form->create($diseased) ?>
                    <?php $this->Form->setTemplates([
                        "inputContainer" => "<div class='input {{type}}{{required}} uk-margin-medium-bottom'>{{content}}</div>",
                        "checkboxWrapper" => "<div class='checkbox uk-margin-bottom'>{{label}}</div>",
                    ]) ?>
                    <?= $this->Form->control('patients_id', ["type" => "hidden", "value" => $patients_id]) ?>
                    <?= $this->Form->control('sicknesses_id', ["label" => false, "class" => "uk-checkbox checkboxRequire", 'options' => $sicknesses, "multiple" => "checkbox", "required" => true]) ?>
                    <div class="uk-padding uk-padding-remove-top uk-text-right">
                        <?= $this->Form->button(__('送信'), ["class" => "uk-button uk-button-default"]) ?>
                    </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>

    <div class="uk-width-1-4 uk-padding-remove uk-text-center small-remove">
        <ul class="uk-list">
            <li><?= $this->Html->link(__('LOGOUT'), ["controller" => "management_users", 'action' => 'logout'], ['class' => 'uk-button uk-button-primary uk-margin-bottom management-sub-button uk-padding-remove']) ?></li>
            <li><?= $this->Html->link(__('戻る'), $this->request->referer(), ['class' => 'uk-button uk-button-primary uk-margin-bottom management-sub-button uk-padding-remove']) ?></li>
        </ul>
        <div class="uk-position-relative uk-container uk-padding-remove-left">
            <ul class="uk-iconnav uk-iconnav-vertical">
                <li style="color: red;">病名入力</li>
                <li><span uk-icon='icon: chevron-down; ratio: 2'></span></li>
                <li>症状入力</li>
                <li><span uk-icon='icon: chevron-down; ratio: 2'></span></li>
                <li>部位入力</li>
            </ul>
        </div>

    </div>
</div>
