<?php
$this->assign("title", "インタビュー");
?>
<div class="uk-grid">

    <div class="uk-width-3-4@m uk-width-1-1 uk-container uk-position-relative uk-padding-remove-right uk-margin-medium-bottom">

        <div class="uk-margin-medium-bottom patient-view-top-color div-align-left">
            <div class="uk-grid">
                <div class="uk-width-2-3">
                    <h3 class="uk-text-center"><?= h($patient->pen_name) ?>さん</h3>
                </div>

                <div class="uk-width-1-3">
                    <h3><?= h($patient->patient_sex->patient_sex) ?></h3>
                </div>
            </div>
        </div>

<?php 
$sick_count = 0; 
$symp_count = 0;
?>
        <table class="uk-table uk-table-striped uk-table-divider uk-table-small uk-margin-medium-bottom">
            <thead>
                <tr>
                    <th class="uk-text-center">発病時の年齢</th>
                    <th class="uk-text-center">発病年月</th>
                    <th class="uk-text-center">診断日</th>
                    <th class="uk-text-center">完治年月</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="uk-text-center"><?= $this->Number->format($patient->age_of_onset) ?>歳</td>
                    <td class="uk-text-center"><?= h($patient->year_of_onset->format("Y年j月")) ?></td>
                    <td class="uk-text-center"><?= h($patient->diagnosis_date->format("Y年j月")) ?></td>
                    <td class="uk-text-center"><?= $patient->has("cured") ? h($patient->cured->format("Y年j月")) : "-----" ?></td>
                </tr>
            </tbody>
        </table>

        <table class="uk-table uk-table-divider uk-table-small uk-table-middle uk-margin-medium-bottom">
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
                        <td class="uk-text-center uk-card uk-card-default" rowspan="<?= $diseased->sickness_row ?>"><?= h($diseased->sickness->sickness_name) ?></td>
                        <?php foreach($diseased->interview_symptoms as $interview): ?>
                            <?php $sick_count == 0 ? "" : "<tr>" ?>
                            <td class="uk-text-center uk-card uk-card-default" rowspan="<?= $interview->symptoms_row ?>"><?= h($interview->symptom->symptoms) ?></td>
                                <?php foreach($interview->symptoms_locations as $location): ?>
                                    <?php $symp_count == 0 ? "" : "<tr>" ?>
                                    <td class="uk-text-center uk-card uk-card-default"><?= h($location->location->location) ?></td></tr>
                                    <?php $symp_count++; ?>
                                <?php endforeach ?>
                            <?php $sick_count++; ?>
                        <?php endforeach ?>
                <?php endforeach ?>
            </tbody>
        </table>

        <div class="text">
            <h3 class="bgc-h3 uk-margin-remove-bottom">現在の状況</h3>
            <div class="uk-card uk-card-default uk-card-body uk-background-muted">
                <section>
                    <?= $patient->interview_first ?>
                </section>
            </div>
            <h3 class="bgc-h3 uk-margin-remove-bottom">病気がわかった経緯</h3>
            <div class="uk-card uk-card-default uk-card-body">
                <section>
                    <?= $patient->interview_second ?>
                </section>
            </div>
            <h3 class="bgc-h3 uk-margin-remove-bottom">生活が変わったか</h3>
            <div class="uk-card uk-card-default uk-card-body uk-background-muted">
                <section>
                    <?= $patient->interview_third ?>
                </section>
            </div>
            <h3 class="bgc-h3 uk-margin-remove-bottom">同じ病気の人へのアドバイス</h3>
            <div class="uk-card uk-card-default uk-card-body">
                <section>
                    <?= $patient->interview_force ?>
                </section>
            </div>
            <h3 class="bgc-h3 uk-margin-remove-bottom">そのほか伝えたいこと</h3>
            <div class="uk-card uk-card-default uk-card-body uk-background-muted">
                <section>
                    <?= $patient->other ?>
                </section>
            </div>
        </div>

    </div>
    <div class="uk-width-1-4@m uk-width-1-1 uk-padding-remove uk-text-center">
        <div class="medium-padding">
            <div class="uk-margin-medium-bottom">
                <p class="uk-text-lead uk-text-center@m uk-text-left">関連するインタビュー</p>
<?php $this->start("sidebar") ?>
    <p class="uk-text-left">関連するインタビュー</p>
<?php $this->end(); ?>
                <div class="medium-padding uk-margin-large-bottom">
                    <?php foreach($related_patients as $related): ?>
                        <?php $relatedList = $related->AttributeList ?>
<?php $this->append("sidebar") ?>
    <p class="padding-left"><?= $this->Html->link(__($related->pen_name." さん"), ['controller' => 'patients', 'action' => 'view', $related->patients_id]) ?></p>
<?php $this->end(); ?>
                        <div class="uk-card uk-card-default uk-card-hover uk-margin-right uk-margin-left">
                            <p class="uk-text-center"><?= $this->Html->link(__($related->pen_name." さん"), ['controller' => 'patients', 'action' => 'view', $related->patients_id]) ?></p>
                            <p class="uk-margin-small">
                                <?php foreach($relatedList["sickness"] as $sickness): ?>
                                    <span class="uk-text-meta"><?= $sickness ?></span>
                                <?php endforeach ?>
                            </p>
                            <p class="uk-margin-small">
                                <?php foreach($relatedList["symptoms"] as $symptoms): ?>
                                    <span class="uk-text-meta"><?= $symptoms ?></span>
                                <?php endforeach ?>
                            </p>
                            <p class="uk-margin-small">
                                <?php foreach($relatedList["locations"] as $locations): ?>
                                    <span class="uk-text-meta"><?= $locations ?></span>
                                <?php endforeach ?>
                            </p>
                            <p><span class="uk-label"><?= $related->patient_sex->patient_sex ?></span></p>
                        </div>
                    <?php endforeach ?>

                </div>
            </div>
            <div class="uk-margin-medium-bottom">
                <p class="uk-text-lead uk-text-center@m uk-text-left">関連する記事</p>
<?php $this->append("sidebar") ?>
    <p class="uk-text-left">関連する記事</p>
<?php $this->end() ?>
                <div class="medium-padding">
                    <?php foreach($related_articles as $related): ?>
                        <?php $relatedList = $related->AttributeList ?>
<?php $this->append("sidebar") ?>
    <p class="padding-left"><?= $this->Html->link(__($related->title), ['controller' => 'articles', 'action' => 'view', $related->articles_id]) ?></p>
<?php $this->end() ?>
                        <div class="uk-card uk-card-default uk-card-hover uk-margin-right uk-margin-left">
                            <p class="uk-text-center"><?= $this->Html->link(__($related->title), ['controller' => 'articles', 'action' => 'view', $related->articles_id]) ?></p>
                            <p class="uk-margin-small">
                                <?php foreach($relatedList["sickness"] as $sickness): ?>
                                    <span class="uk-text-meta"><?= $sickness ?></span>
                                <?php endforeach ?>
                            </p>
                            <p class="uk-margin-small">
                                <?php foreach($relatedList["symptoms"] as $symptoms): ?>
                                    <span class="uk-text-meta"><?= $symptoms ?></span>
                                <?php endforeach ?>
                            </p>
                            <p class="uk-margin-small">
                                <?php foreach($relatedList["locations"] as $locations): ?>
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


