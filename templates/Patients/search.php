<?php
$this->assign("title", "検索結果：");
$this->Html->script("TopCheckbox.js", ["block" => true]);
?>
<div class="uk-grid">
    <div class="uk-width-2-3@m uk-width-1-1">
        <div class="uk-padding-remove uk-first-column uk-grid uk-margin-bottom">
            <div class="uk-width-auto">
                <h3>
                    <?= __('検索：') ?>
                </h3>
            </div>
            <div class="uk-width-auto">
                <h3>
                    <?php foreach($element as $e): ?>
                        <span class="uk-margin-small-right"><?= $e["alias"] ?></span>
                    <?php endforeach ?>
                </h3>
                <h3 class="uk-margin-remove-top">
                    <?php if($location_element != null): ?>
                        <?php foreach($location_element as $le): ?>
                            <span class="uk-margin-small-right"><?= $le["alias"] ?></span>
                        <?php endforeach ?>
                    <?php endif ?>
                </h3>
            </div>
        </div>
        <div class="uk-padding-remove uk-first-column">
            <h3 class="pro-image main-link" id="search_toggle"><?= __('検索') ?></h3>
            <div class="uk-padding-remove uk-width-1-1 uk-margin-medium-top uk-margin-medium-bottom" id="search">
                <div class="uk-padding-remove" uk-grid>
                    <div class="uk-width-1-2 uk-text-center uk-text-left@m">
                        <?= $this->Form->create(null, [
                            "type" => "get",
                            "url" => [
                                "controller" => "patients",
                                "action" => "search"
                            ]
                        ]) ?> 
                            <?php $this->Form->setTemplates(["checkboxWrapper" => "<div class='checkbox uk-margin'>{{label}}</div>" ]); ?>

                            <div class="uk-margin-large-bottom">
                                <?= $this->Form->control("sicknesses_id", ["label" => "病名で検索", "options" => $sicknesses, "hiddenField" => false, "empty" => true, "multiple" => "checkbox", "class" => "uk-checkbox"]) ?>
                            </div>
                            <?= $this->Form->button('検索', ["class" => "uk-button uk-button-primary"]) ?>
                        <?= $this->Form->end() ?>
                    </div>

                    <div class="uk-width-1-2 uk-text-center uk-text-left@m">
                        <?= $this->Form->create(null, [
                            "type" => "get",
                            "url" => [
                                "controller" => "patients",
                                "action" => "search"
                            ]
                        ]) ?> 
                            <div id="symptoms_checkbox" class="uk-margin-large-bottom">
                                <?= $this->Form->control("symptoms_id", ["label" => "症状で検索", "options" => $symptoms, "hiddenField" => false, "empty" => true, "multiple" => "checkbox", "class" => "uk-checkbox symptoms_input_checkbox"]) ?>
                            </div>

                            <div id="locations_checkbox" class="uk-margin-large-bottom">
                                <?= $this->Form->control("locations_id", ["label" => "部位で検索", "options" => $locations, "hiddenField" => false, "empty" => true, "multiple" => "checkbox", "class" => "locations_checkbox", "disabled" => true, "class" => "uk-checkbox"]) ?>
                            </div>
                            <?= $this->Form->button('検索', ["class" => "uk-button uk-button-primary"]) ?>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="uk-text-center medium-table">
            <table class="uk-table uk-table-striped uk-table-middle">
                <thead>
                    <tr>
                        <th class="uk-text-center">ペンネーム</th>
                        <th class="uk-text-center">病名</th>
                        <th class="uk-text-center">性別</th>
                        <th class="uk-text-center">発病時の年齢</th>
                        <th class="uk-text-center">発病年月</th>
                        <th class="uk-text-center">診断日</th>
                        <th class="uk-text-center">完治した年月</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($patients as $patient): ?>
                        <tr>
                            <td><?= h($patient->pen_name) ?></td>
                            <td>
                                <?php foreach ($patient->diseaseds as $diseased): ?>
                                    <?= h($diseased->sickness->sickness_name) ?></br>
                                <?php endforeach ?>
                            </td>
                            <td><?= h($patient->patient_sex->patient_sex) ?></td>
                            <td><?= $this->Number->format($patient->age_of_onset) ?></td>
                            <td><?= h($patient->year_of_onset->format("Y-m-d")) ?></td>
                            <td><?= h($patient->diagnosis_date->format("Y-m-d")) ?></td>
                            <td><?= $patient->has("cured") ? h($patient->cured->format("Y-m-d")) : "-----" ?></td>
                            <td><?= $this->Html->link('<button class="uk-button uk-button-default" type="button">詳細</button>', ['action' => 'view', $patient->patients_id], ["escape" => false]) ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <div class="small-table">

            <?php foreach ($patients as $patient): ?>
<?php 
    $patient_link = "<div class='uk-card-header'><p>{$patient->pen_name} さん</p></div>";
?>
                <div class="uk-text-center uk-margin-bottom uk-card uk-card-default">
                    <td><?= $this->Html->link($patient_link, ['action' => 'view', $patient->patients_id], ["escape" => false]) ?></td>
                    <div class="uk-card-body uk-padding-remove">
                        <table class="uk-table uk-table-small uk-margin-remove uk-table-divider uk-table-middle">
                            <thead>
                                <tr>
                                    <th class="uk-text-center uk-width-1-3">病名</th>
                                    <th class="uk-text-center uk-width-1-3">性別</th>
                                    <th class="uk-text-center uk-width-1-3">発病時の年齢</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td>
                                            <?php foreach ($patient->diseaseds as $diseased): ?>
                                                <?= h($diseased->sickness->sickness_name) ?></br>
                                            <?php endforeach ?>
                                        </td>
                                        <td><?= h($patient->patient_sex->patient_sex) ?></td>
                                        <td><?= $this->Number->format($patient->age_of_onset) ?></td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="uk-card-footer uk-padding-remove">
                        <table class="uk-table uk-table-small uk-margin-remove uk-table-divider uk-table-middle">
                            <thead>
                                <tr>
                                    <th class="uk-text-center uk-width-1-3">発病年月</th>
                                    <th class="uk-text-center uk-width-1-3">診断日</th>
                                    <th class="uk-text-center uk-width-1-3">完治した年月</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?= h($patient->year_of_onset->format("Y-m")) ?></td>
                                    <td><?= h($patient->diagnosis_date->format("Y-m")) ?></td>
                                    <td><?= $patient->has("cured") ? h($patient->cured->format("Y-m")) : "-----" ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
        <div class="paginator">
            <ul class="uk-pagination" uk-margin>
                <?= $this->Paginator->first(__('<< ')) ?>
                <?= $this->Paginator->numbers(["first" => "First page", "last" => 1]) ?>
                <?= $this->Paginator->last(__(' >>')) ?>
            </ul>
        </div>
    </div>
    <div class="uk-width-1-3@m uk-width-1-1 uk-margin-auto-right uk-padding-remove">
        <p class="uk-text-lead uk-text-center">最近の記事</p>
            <?php foreach($recently_patients as $r_patient): ?>
                <p class="uk-text-center"><?= $this->Html->link(__($r_patient->pen_name), ['controller' => 'patients', 'action' => 'view', $r_patient->patients_id]) ?></p>
            <?php endforeach ?>
    </div>
</div>
