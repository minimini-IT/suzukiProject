<?php
$this->assign("title", "記事編集");
$this->Html->script("ckeditor/ckeditor.js", ["block" => true]);
$this->Html->script("editCheckbox.js", ["block" => true]);
?>
<?php $this->start("sidebar") ?>
    <p>ユーザ管理</p>
    <ul class="uk-list">
        <li><?= $this->Html->link(__('作成'), ['controller' => 'management_users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('編集'), ['controller' => 'management_users', 'action' => 'index']) ?></li>
    </ul>
    <p>インタビュー管理</p>
    <ul class="uk-list">
        <li><?= $this->Html->link(__('作成'), ['controller' => 'patients', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('編集'), ['controller' => 'patients', 'action' => 'select']) ?></li>
    </ul>
    <p>記事管理</p>
    <ul class="uk-list">
        <li><?= $this->Html->link(__('作成'), ['controller' => 'articles', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('編集'), ['controller' => 'articles', 'action' => 'select']) ?></li>
    </ul>
<?php $this->end(); ?>
<div class="uk-grid grid-margin-remove">
    <div class="small-subbar">
        <nav class="uk-navbar-container" uk-navbar>
            <div class="uk-navbar-right">
                <ul class="uk-navbar-nav">
                   <li class="small-subbar-li"><?= $this->Html->link(__('戻る'), ["action" => "select"], ['class' => 'uk-button uk-button-primary management-sub-button uk-padding-remove small-subbar-height']) ?></li>
                   <li class="small-subbar-li"><?= $this->Html->link(__('LOGOUT'), ['action' => 'logout'], ['class' => 'uk-button uk-button-primary management-sub-button uk-padding-remove small-subbar-height']) ?></li>
                </ul>
            </div>
        </nav>
    </div>


    <div class="uk-width-3-4@s medium-margin uk-width-1-1 grid-child">
        <div class="uk-card uk-card-default">
            <?= $this->Form->create($article) ?>
                <div class="grid-next-margin uk-padding uk-padding-remove-bottom">
                    <?php $this->Form->setTemplates([
                        "inputContainer" => 
                            "<div class='input {{type}}{{required}} uk-margin-medium-bottom'>{{content}}</div>",
                    ]) ?>
                    <?= $this->Form->control('title', ["label" => "タイトル : ", "class" => "uk-input uk-form-width-large"]) ?>

                    <p class="uk-text-meta uk-margin-remove">削除する項目をクリック</p>
                    <div class="uk-grid uk-child-width-1-3 uk-margin">
                        <div>
                            <p>関連する病気</p>
                            <ul class="uk-list">
                                <?php foreach($article->related_sicknesses as $sickness): ?>
                                    <li class="related_sicknesses"><?= $this->Form->postLink(h($sickness->sickness->sickness_name), ["controller" => "RelatedSicknesses", 'action' => 'delete', $sickness->related_sicknesses_id], ["block" => true, 'confirm' => __('{0}を削除しますか？', $sickness->sickness->sickness_name)])?></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                        <div>
                            <p>関連する症状</p>
                            <ul class="uk-list">
                                <?php foreach($article->related_symptoms as $symptoms): ?>
                                    <li class="related_symptoms"><?= $this->Form->postLink(h($symptoms->symptom->symptoms), ["controller" => "RelatedSymptoms", 'action' => 'delete', $symptoms->related_symptoms_id], ["block" => true, 'confirm' => __('{0}を削除しますか？', $symptoms->symptom->symptoms)])?></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                        <div>
                            <p>関連する部位</p>
                            <ul class="uk-list">
                                <?php foreach($article->related_locations as $location): ?>
                                    <li class="related_locations"><?= $this->Form->postLink(h($location->location->location), ["controller" => "RelatedLocations", 'action' => 'delete', $location->related_locations_id], ["block" => true, 'confirm' => __('{0}を削除しますか？', $location->location->location)])?></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    </div>
                    <?php $this->Form->setTemplates(["inputContainer" => "<div class='input {{type}}{{required}} uk-margin-medium-bottom checkbox-margin checkboxInit'>{{content}}</div>","checkboxWrapper" => "<div class='checkbox uk-margin-bottom'>{{label}}</div>"]) ?>
                    <div class='uk-grid uk-child-width-1-3'>

                        <?= $this->Form->control('sicknesses_id', ["label" => "関連する病気追加", "class" => "uk-checkbox sicknesses_checkbox", 'options' => $not_entered_sicknesses, "multiple" => "checkbox"]) ?>

                        <?= $this->Form->control('symptoms_id', ["label" => "関連する症状追加", "class" => "uk-checkbox symptoms_checkbox", 'options' => $not_entered_symptoms, "multiple" => "checkbox"]) ?>

                        <?= $this->Form->control('locations_id', ["label" => "関連する部位追加", "class" => "uk-checkbox locations_checkbox", 'options' => $not_entered_locations, "multiple" => "checkbox"]) ?>

                    </div>
                    <?php $this->Form->setTemplates(["inputContainer" => "<div class='input {{type}}{{required}} uk-margin-medium-bottom'>{{content}}</div>"]) ?>
                </div>
                <div>
                    <p class="uk-text-danger">注意：先頭(30文字程度)でtableを使用すると、スマホ画面で一覧を表示した場合にレイアウトが崩れす恐れがあります。</p>
                    <?= $this->Form->control('contents', ["label" => false, "class" => "ckeditor"]) ?>
                    <?= $this->Html->scriptStart() ?>
                        var editor = CKEDITOR.replace("ckeditor");
                    <?= $this->Html->scriptEnd() ?>
                    <div class="uk-padding uk-padding-remove-top uk-text-right">
                        <?= $this->Form->button(__('送信'), ["class" => "uk-button uk-button-default"]) ?>
                    </div>
                <?= $this->Form->end() ?>
                <?= $this->fetch("postLink") ?>
            </div>
        </div>
    </div>
    <div class="uk-width-1-4 uk-padding-remove uk-text-center small-remove">
        <ul class="uk-list">
            <li><?= $this->Html->link(__('LOGOUT'), ["controller" => "management_users", 'action' => 'logout'], ['class' => 'uk-button uk-button-primary uk-margin-bottom management-sub-button uk-padding-remove']) ?></li>
            <li class=><?= $this->Html->link(__('戻る'), ["action" => "select"], ['class' => 'uk-button uk-button-primary uk-margin-bottom management-sub-button uk-padding-remove']) ?></li>
        </ul>
    </div>
</div>
