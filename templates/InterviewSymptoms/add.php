<?php
$this->assign("title", "症状の登録");
$this->Html->script("addCheckbox.js", ["block" => true]);
?>
<div class="uk-grid grid-margin-remove">
    <div class="small-subbar">
        <nav class="uk-navbar-container" uk-navbar>
            <div class="uk-navbar-right">
                <ul class="uk-navbar-nav">
                   <li class="small-subbar-li"><?= $this->Html->link(__('戻る'), ["controller" => "patients", 'action' => 'select'], ['class' => 'uk-button uk-button-primary management-sub-button uk-padding-remove small-subbar-height']) ?></li>
                   <li class="small-subbar-li"><?= $this->Html->link(__('LOGOUT'), ['action' => 'logout'], ['class' => 'uk-button uk-button-primary management-sub-button uk-padding-remove small-subbar-height']) ?></li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="small-subbar uk-text-center">
        <div class="uk-container">
            <p>基本情報入力<span uk-icon='icon: chevron-right; ratio: 2'></span><span style="color: red;">症状入力</span><span uk-icon='icon: chevron-right; ratio: 2'></span>部位入力</p>
        </div>
    </div>
    <div class="uk-width-3-4@s medium-margin uk-width-1-1 grid-child">
        <div class="uk-card uk-card-default">
            <div class="grid-next-margin uk-padding uk-padding-remove-bottom">
                <?= $this->Form->create(null, [
                    "type" => "post",
                    "url" => [
                        "controller" => "InterviewSymptoms",
                        "action" => "add"
                    ],
                    "class" => "uk-padding uk-padding-remove-top"
                ]) ?>
                    <?php
                        $this->Form->setTemplates([
                            "inputContainer" => "<div class='input {{type}} {{required}} uk-margin-medium-bottom'>{{content}}</div>",
                            "checkboxWrapper" => "<div class='checkbox uk-margin-bottom'>{{label}}</div>",
                        ]);
                        foreach($sick as $number)
                        {
                            echo $this->Form->control('patients_id', ['value' => $patients_id, "type" => "hidden"]);
                            echo $this->Form->control('diseaseds_id_'.$number->diseaseds_id, [
                                'value' => $number->diseaseds_id, 
                                "type" => "hidden", 
                                "id" => "diseaseds-".$number->diseaseds_id
                            ]);
                            echo "<p style='font-size: 2rem;' class='uk-margin-remove-top'>".$number->sickness->sickness_name."の症状</p>";
                            echo "<div class='uk-padding uk-padding-remove-top uk-padding-remove-bottom uk-padding-remove-right'>";
                            echo $this->Form->control('symptoms_id_'.$number->sicknesses_id, [
                                "label" => false, 
                                "required" => true,
                                'multiple' => "checkbox", 
                                "options" => $symptoms, 
                                "id" => "symptoms-".$number->sicknesses_id."-".$number->diseaseds_id,
                                "class" => "uk-checkbox checkboxRequire"
                            ]);
                            echo "</div>";
                        }
                    ?>
                    <div class="uk-padding uk-padding-remove-top uk-text-right">
                        <?= $this->Form->button(__('送信'), ["class" => "uk-button uk-button-default uk-margin-medium-top"]) ?>
                    </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>

    <div class="uk-width-1-4 uk-padding-remove uk-text-center small-remove">
        <ul class="uk-list">
            <li><?= $this->Html->link(__('LOGOUT'), ['action' => 'logout'], ['class' => 'uk-button uk-button-primary uk-margin-bottom management-sub-button uk-padding-remove']) ?></li>
            <li class=><?= $this->Html->link(__('戻る'), ["controller" => "patients", 'action' => 'select'], ['class' => 'uk-button uk-button-primary uk-margin-bottom management-sub-button uk-padding-remove']) ?></li>
        </ul>
        <div class="uk-position-relative uk-container uk-padding-remove-left">
            <ul class="uk-iconnav uk-iconnav-vertical">
                <li>基本情報入力</li>
                <li><span uk-icon='icon: chevron-down; ratio: 2'></span></li>
                <li style="color: red;">症状入力</li>
                <li><span uk-icon='icon: chevron-down; ratio: 2'></span></li>
                <li>部位入力</li>
            </ul>
        </div>
    </div>
</div>
