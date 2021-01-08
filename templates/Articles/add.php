<?php
$this->assign("title", "記事作成");
$this->Html->script("ckeditor/ckeditor.js", ["block" => true]);
$this->Html->script("addCheckbox.js", ["block" => true]);
?>
<div class="uk-grid grid-margin-remove">
    <div class="small-subbar">
        <nav class="uk-navbar-container" uk-navbar>
            <div class="uk-navbar-right">
                <ul class="uk-navbar-nav">
                   <li class="small-subbar-li"><?= $this->Html->link(__('戻る'), ["controller" => "management_users", 'action' => 'top'], ['class' => 'uk-button uk-button-primary management-sub-button uk-padding-remove small-subbar-height']) ?></li>
                   <li class="small-subbar-li"><?= $this->Html->link(__('LOGOUT'), ["controller" => "management_users", 'action' => 'logout'], ['class' => 'uk-button uk-button-primary management-sub-button uk-padding-remove small-subbar-height']) ?></li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="uk-width-3-4@s medium-margin uk-width-1-1 grid-child">
        <div class="uk-card uk-card-default">
            <?= $this->Form->create($article) ?>
                <div class="grid-next-margin uk-padding uk-padding-remove-bottom">
                    <?php
                        $this->Form->setTemplates(["inputContainer" => "<div class='input {{type}}{{required}} uk-margin-medium-bottom'>{{content}}</div>"]) ?>

                    <?= $this->Form->error("title") ?>
                    <?= $this->Form->control('title', ["label" => "タイトル ：", "class" => "uk-input uk-form-width-large"]) ?>

                    <?php $this->Form->setTemplates(["inputContainer" => "<div class='input {{type}}{{required}} uk-margin-medium-bottom checkbox-margin checkboxInit'>{{content}}</div>","checkboxWrapper" => "<div class='checkbox uk-margin-bottom'>{{label}}</div>"]) ?>

                    <?= "<p class='uk-margin-remove-bottom'><span class='uk-text-danger'>それぞれ一つ以上必須</span></p>" ?>
                    <div class='uk-grid uk-child-width-1-3'>

                        <?= $this->Form->control('sicknesses_id', ["label" => "関連する病気", "class" => "uk-checkbox checkboxRequire", 'options' => $sicknesses, "multiple" => "checkbox", "required" => true]) ?>

                        <?= $this->Form->control('symptoms_id', ["label" => "関連する症状", "class" => "uk-checkbox checkboxRequire", 'options' => $symptoms, "multiple" => "checkbox", "required" => true]) ?>

                        <?= $this->Form->control('locations_id', ["label" => "関連する部位", "class" => "uk-checkbox checkboxRequire", 'options' => $locations, "multiple" => "checkbox", "required" => true]) ?>

                    </div>

                    <?php $this->Form->setTemplates(["inputContainer" => "<div class='input {{type}}{{required}} uk-margin-medium-bottom'>{{content}}</div>"]) ?>

                    </div>
                    <div>
                    <p class="uk-text-danger">注意：先頭(30文字程度)でtableを使用すると、スマホ画面で一覧を表示した場合にレイアウトが崩れす恐れがあります。</p>
                    <?= $this->Form->error("contents") ?>
                    <?= $this->Form->control('contents', ["label" => false, "class" => "ckeditor"]) ?>
                    <?= $this->Html->scriptStart() ?>
                        var editor = CKEDITOR.replace("ckeditor");
                    <?= $this->Html->scriptEnd() ?>
                    <div class="uk-padding uk-padding-remove-top uk-text-right">
                        <?= $this->Form->button(__('送信'), ["class" => "uk-button uk-button-default"]) ?>
                    </div>
                </div>
            <?= $this->Form->end() ?>
        </div>
    </div>

    <div class="uk-width-1-4 uk-padding-remove uk-text-center small-remove">
        <ul class="uk-list">
            <li><?= $this->Html->link(__('LOGOUT'), ["controller" => "management_users", 'action' => 'logout'], ['class' => 'uk-button uk-button-primary uk-margin-bottom management-sub-button uk-padding-remove']) ?></li>
            <li class=><?= $this->Html->link(__('戻る'), ["controller" => "management_users", 'action' => 'top'], ['class' => 'uk-button uk-button-primary uk-margin-bottom management-sub-button uk-padding-remove']) ?></li>
        </ul>
    </div>

</div>
