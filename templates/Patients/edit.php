<?php
$this->assign("title", "編集");
$this->Html->script("ckeditor/ckeditor.js", ["block" => true]);
?>
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

                    ?>

<?php 
$sick_count = 0; 
$symp_count = 0;
?>
                    <p class="uk-text-meta uk-margin-remove">削除する項目をクリック</p>
                    <?php if(!empty($patient->diseaseds)): ?>
                        <table class="uk-table uk-table-divider uk-table-small uk-table-middle uk-margin-medium-bottom uk-margin-remove-top">
                            <thead>
                                <tr>
                                    <th class="uk-text-center uk-width-1-3">病名</th>
                                    <th class="uk-text-center uk-width-1-3">症状</th>
                                    <th class="uk-text-center uk-width-1-3">症状の現れた部位</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($patient->diseaseds as $diseased): ?>
                                    <tr>
                                        <td class="uk-text-center uk-card uk-card-default" rowspan="<?= $diseased->sickness_row ?>"><?= $this->Form->postLink(h($diseased->sickness->sickness_name), ["controller" => "diseaseds", 'action' => 'delete', $diseased->diseaseds_id], ["block" => true, 'confirm' => __('{0}を削除しますか？', $diseased->sickness->sickness_name)]) ?></td>
                                        <?php foreach($diseased->interview_symptoms as $interview): ?>
                                            <?php $sick_count == 0 ? "" : "<tr>" ?>
                                            <td class="uk-text-center uk-tile-muted" rowspan="<?= $interview->symptoms_row ?>"><?= h($interview->symptom->symptoms) ?></td>
                                                <?php foreach($interview->symptoms_locations as $location): ?>
                                                    <?php $symp_count == 0 ? "" : "<tr>" ?>
                                                    <td class="uk-text-center"><?= h($location->location->location) ?></td></tr>
                                                    <?php $symp_count++; ?>
                                                <?php endforeach ?>
                                            <?php $sick_count++; ?>
                                        <?php endforeach ?>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                        <?php if($sickAddFlag): ?>
                            <div class="uk-margin-medium-bottom"><?= $this->Html->link(__('病名を追加'), ["controller" => "diseaseds", 'action' => 'add', $patient->patients_id], ["class" => "uk-button uk-button-default"]) ?></div>
                        <?php endif ?>
                    <?php endif ?>


                    <?php
                        echo $this->Form->control('patient_sexes_id', ["label" => "性別 : ", "class" => "uk-select uk-form-width-medium", 'options' => $patientSexes]);
                        echo $this->Form->control('age_of_onset', ["label" => "発病時の年齢 : ", "class" => "uk-select uk-form-width-medium", "min" => 0]);
                        echo $this->Form->control('year_of_onset', ["label" => "発病年月 : ", "class" => "uk-input uk-form-width-medium"]);
                        echo $this->Form->control('diagnosis_date', ["label" => "診断日 : ", "class" => "uk-input uk-form-width-medium"]);
                        echo $this->Form->control('cured', ["label" => "完治した年月 : ", "class" => "uk-input uk-form-width-medium", 'empty' => true]);
                        echo "</div><div>";
                        echo $this->Form->control('interview_first', ["label" => ["text" => "現在の状況", "class" => "uk-padding uk-padding-remove-top uk-padding-remove-bottom label-background"],  "class" => "ckeditor"]);
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
                <?= $this->fetch("postLink") ?>
            </div>
        </div>
    </div>

    <div class="uk-width-1-4 uk-padding-remove uk-text-center small-remove">
        <ul class="uk-list">
            <li><?= $this->Html->link(__('LOGOUT'), ["controller" => "management_users", 'action' => 'logout'], ['class' => 'uk-button uk-button-primary uk-margin-bottom management-sub-button uk-padding-remove']) ?></li>
            <li class=><?= $this->Html->link(__('戻る'), ["action" => "select"], ['class' => 'uk-button uk-button-primary uk-margin-bottom management-sub-button uk-padding-remove']) ?></li>
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
