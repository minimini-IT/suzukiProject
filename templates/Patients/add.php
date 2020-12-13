<?php
$this->assign("title", "インタビュー作成");
$this->Html->script("ckeditor/ckeditor.js", ["block" => true]);
$this->Html->script("addCheckbox.js", ["block" => true]);
?>
<div class="uk-grid grid-margin-remove">
    <div class="small-subbar">
        <nav class="uk-navbar-container" uk-navbar>
            <div class="uk-navbar-right">
                <ul class="uk-navbar-nav">
                   <li class="small-subbar-li"><?= $this->Html->link(__('戻る'), ["controller" => "management_users", 'action' => 'top'], ['class' => 'uk-button uk-button-primary management-sub-button uk-padding-remove small-subbar-height']) ?></li>
                   <li class="small-subbar-li"><?= $this->Html->link(__('LOGOUT'), ['action' => 'logout'], ['class' => 'uk-button uk-button-primary management-sub-button uk-padding-remove small-subbar-height']) ?></li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="small-subbar uk-text-center">
        <div class="uk-container">
            <p><span style="color: red;">基本情報</span><span uk-icon='icon: chevron-right; ratio: 2'></span>症状入力<span uk-icon='icon: chevron-right; ratio: 2'></span>部位入力</p>
        </div>
    </div>

    <div class="uk-width-3-4@s medium-margin uk-width-1-1 grid-child">
        <div class="uk-card uk-card-default">
            <div class="grid-next-margin uk-padding uk-padding-remove-bottom">
                <?= $this->Form->create($patient) ?>
                    <?php
                        $this->Form->setTemplates([
                            "inputContainer" => "<div class='input {{type}}{{required}} uk-margin-medium-bottom'>{{content}}</div>",
                        ]);

                        echo $this->Form->control('pen_name', ["label" => "ペンネーム : ", "class" => "uk-input uk-form-width-medium"]);

                        $this->Form->setTemplates([
                            "inputContainer" => "<div class='input {{type}}{{required}} uk-margin-medium-bottom checkbox-margin checkboxInit'>{{content}}</div>",
                            "checkboxWrapper" => "<div class='checkbox uk-margin-bottom'>{{label}}</div>",
                        ]);

                        echo "<label for='sicknesses-id'>病名 : </label>";
                        echo $this->Form->control('sicknesses_id', ["label" => false, "class" => "uk-checkbox checkboxRequire", 'options' => $sicknesses, "multiple" => "checkbox", "required" => true]);

                        $this->Form->setTemplates([
                            "inputContainer" => "<div class='input {{type}}{{required}} uk-margin-medium-bottom'>{{content}}</div>",
                        ]);

                        echo $this->Form->control('patient_sexes_id', ["label" => "性別 : ", "class" => "uk-select uk-form-width-medium", 'options' => $patientSexes]);
                        echo $this->Form->control('age_of_onset', ["label" => "発病時の年齢 : ", "class" => "uk-select uk-form-width-medium", "min" => 0]);
                        echo $this->Form->control('year_of_onset', ["label" => "発病年月 : ", "class" => "uk-input uk-form-width-medium"]);
                        echo $this->Form->control('diagnosis_date', ["label" => "診断日 : ", "class" => "uk-input uk-form-width-medium"]);
                        echo $this->Form->control('cured', ["label" => "完治した年月 : ", "class" => "uk-input uk-form-width-medium", 'empty' => true]);
                        echo "</div><div>";
                        echo $this->Form->control('interview_first', ["label" => ["text" => "現在の状況", "class" => "uk-padding uk-padding-remove-top uk-padding-remove-bottom label-background"],  "class" => "ckeditor", "required" => true]);
                        echo $this->Form->control('interview_second', ["label" => ["text" => "どんな経緯で病気がわかったか", "class" => "uk-padding uk-padding-remove-top uk-padding-remove-bottom label-background"], "class" => "ckeditor"]);
                        echo $this->Form->control('interview_third', ["label" => ["text" => "病気になったから生活が変わったか", "class" => "uk-padding uk-padding-remove-top uk-padding-remove-bottom label-background"], "class" => "ckeditor"]);
                        echo $this->Form->control('interview_force', ["label" => ["text" => "同じ病気の方へのアドバイス", "class" => "uk-padding uk-padding-remove-top uk-padding-remove-bottom label-background"], "class" => "ckeditor"]);
                        echo $this->Form->control('other', ["label" => ["text" => "その他伝えたいこと", "class" => "uk-padding uk-padding-remove-top uk-padding-remove-bottom label-background"], "class" => "ckeditor"]);
                    ?>
                    <?= $this->Html->scriptStart() ?>
                        var editor = CKEDITOR.replace("ckeditor");
                    <?= $this->Html->scriptEnd() ?>
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
            <li class=><?= $this->Html->link(__('戻る'), ["controller" => "management_users", 'action' => 'top'], ['class' => 'uk-button uk-button-primary uk-margin-bottom management-sub-button uk-padding-remove']) ?></li>
        </ul>
        <div class="uk-position-relative uk-container uk-padding-remove-left">
            <ul class="uk-iconnav uk-iconnav-vertical">
                <li style="color: red;">基本情報入力</li>
                <li><span uk-icon='icon: chevron-down; ratio: 2'></span></li>
                <li>症状入力</li>
                <li><span uk-icon='icon: chevron-down; ratio: 2'></span></li>
                <li>部位入力</li>
            </ul>
        </div>

    </div>
</div>
