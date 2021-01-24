<?php
$this->assign("title", "闘病者インタビュー");
$this->Html->script("TopCheckbox.js", ["block" => true]);
?>
<div class="uk-grid">
    <div class="uk-width-3-4@m uk-width-1-1">
        <div class="uk-padding-remove uk-first-column uk-text-center uk-margin-small-bottom">
            <?= $this->Html->image("search.JPG", ["id" => "search_toggle", "class" => "search-icon", "alt" => "search"]) ?>
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
                            <div class="uk-padding uk-padding-remove-top uk-text-right">
                                <?= $this->Form->button('検索', ["class" => "uk-button uk-button-primary"]) ?>
                            </div>
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
                            <div class="uk-padding uk-padding-remove-top uk-text-right">
                                <?= $this->Form->button('検索', ["class" => "uk-button uk-button-primary"]) ?>
                            </div>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="medium-padding">

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
    <div class="uk-width-1-4@m uk-width-1-1 uk-margin-auto-right uk-padding-remove uk-text-center">
        <div class="medium-padding">
            <div class="uk-margin-medium-bottom">
                <p class="uk-text-lead uk-text-center@m uk-text-left">最近のインタビュー</p>
<?php $this->start("sidebar") ?>
    <p class="uk-text-left">最近のインタビュー</p>
<?php $this->end(); ?>
                <div class="medium-padding uk-margin-large-bottom">
                    <?php foreach($recently_patients as $recent_patient): ?>
                        <?php $recent_patient_list = $recent_patient->AttributeList ?>
<?php $this->append("sidebar") ?>
    <p class="padding-left"><?= $this->Html->link(__($recent_patient->pen_name." さん"), ['controller' => 'patients', 'action' => 'view', $recent_patient->patients_id]) ?></p>
<?php $this->end(); ?>
                        <div class="uk-card uk-card-default uk-card-hover uk-margin-right uk-margin-left">
                            <p class="uk-text-center"><?= $this->Html->link(__($recent_patient->pen_name." さん"), ['controller' => 'patients', 'action' => 'view', $recent_patient->patients_id]) ?></p>
                            <p class="uk-margin-small">
                            <?php foreach($recent_patient_list["sickness"] as $sickness): ?>
                                <span class="uk-text-meta"><?= $sickness ?></span>
                            <?php endforeach ?>
                            </p>
                            <p class="uk-margin-small">
                            <?php foreach($recent_patient_list["symptoms"] as $symptoms): ?>
                                <span class="uk-text-meta"><?= $symptoms ?></span>
                            <?php endforeach ?>
                            </p>
                            <p class="uk-margin-small">
                            <?php foreach($recent_patient_list["locations"] as $locations): ?>
                                <span class="uk-text-meta"><?= $locations ?></span>
                            <?php endforeach ?>
                            </p>
                            <p><span class="uk-label"><?= $recent_patient->patient_sex->patient_sex ?></span></p>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="uk-margin-medium-bottom">
                <p class="uk-text-lead uk-text-center@m uk-text-left">最近の記事</p>
<?php $this->append("sidebar") ?>
    <p class="uk-text-left">最近の記事</p>
<?php $this->end() ?>
                <div class="medium-padding uk-margin-large-bottom">
                    <?php foreach($recently_articles as $recent_article): ?>
                        <?php $recent_article_list = $recent_article->AttributeList ?>
<?php $this->append("sidebar") ?>
    <p class="padding-left"><?= $this->Html->link(__($recent_article->title), ['controller' => 'articles', 'action' => 'view', $recent_article->articles_id]) ?></p>
<?php $this->end() ?>
                        <div class="uk-card uk-card-default uk-card-hover uk-margin-right uk-margin-left">
                            <p class="uk-text-center"><?= $this->Html->link(__($recent_article->title), ['controller' => 'articles', 'action' => 'view', $recent_article->articles_id]) ?></p>
                            <p class="uk-margin-small">
                            <?php foreach($recent_article_list["sickness"] as $sickness): ?>
                                <span class="uk-text-meta"><?= $sickness ?></span>
                            <?php endforeach ?>
                            </p>
                            <p class="uk-margin-small">
                            <?php foreach($recent_article_list["symptoms"] as $symptoms): ?>
                                <span class="uk-text-meta"><?= $symptoms ?></span>
                            <?php endforeach ?>
                            </p>
                            <p class="uk-margin-small">
                            <?php foreach($recent_article_list["locations"] as $locations): ?>
                                <span class="uk-text-meta"><?= $locations ?></span>
                            <?php endforeach ?>
                            </p>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</div>
