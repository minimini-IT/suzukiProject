<?php
$this->assign("title", "インタビュー");
?>
<div class="uk-grid">
    <div class="main uk-width-2-5 uk-margin-auto-left uk-container uk-position-relative">

        <div class="uk-grid uk-child-width-1-2">
            <div>
                <h3 class="uk-text-right"><?= h($patient->pen_name) ?>さん</h3>
            </div>
            <div>
                <h3><?= h($patient->patient_sex->patient_sex) ?></h3>
            </div>
        </div>

<?php 
$sick_count = 0; 
$symp_count = 0;
?>
        <table class="uk-table uk-table-striped uk-table-divider uk-margin-remove-bottom uk-table-small">
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

        <table class="uk-table uk-margin-remove-bottom uk-table-divider uk-table-small uk-table-middle">
            <thead>
                <tr>
                    <th class="uk-text-center uk-table-expand">病名</th>
                    <th class="uk-text-center uk-table-expand">症状</th>
                    <th class="uk-text-center uk-table-expand">症状の現れた部位</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($patient->diseaseds as $diseased): ?>
                    <tr>
                        <td class="uk-text-center uk-card uk-card-default" rowspan="<?= $sicknessesToLocations[$diseased->sicknesses_id] ?>"><?= h($diseased->sickness->sickness_name) ?></td>
                        <?php foreach($diseased->interview_symptoms as $interview): ?>
                            <?php $sick_count == 0 ? "" : "<tr>" ?>
                            <td class="uk-text-center uk-tile-muted" rowspan="<?= $symptomsToLocations[$diseased->sicknesses_id][$interview->symptoms_id] ?>"><?= h($interview->symptom->symptoms) ?></td>
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




        <div class="uk-flex uk-margin-medium-bottom">
            <div class="uk-margin-right">
                <table class="uk-table uk-table-striped uk-table-divider uk-margin-remove-bottom uk-table-small">
                    <thead>
                        <tr>
                            <th class="uk-text-center">発病時の年齢</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="uk-text-center"><?= $this->Number->format($patient->age_of_onset) ?>歳</td>
                        </tr>
                    </tbody>
                </table>
                <table class="uk-table uk-table-striped uk-table-divider uk-margin-remove-bottom uk-table-small">
                    <thead>
                        <tr>
                            <th class="uk-text-center">発病年月</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="uk-text-center"><?= h($patient->year_of_onset->format("Y年j月")) ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="uk-margin-right">
                <table class="uk-table uk-table-striped uk-table-divider uk-margin-remove-bottom uk-table-small">
                    <thead>
                        <tr>
                            <th class="uk-text-center">診断日</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="uk-text-center"><?= h($patient->diagnosis_date->format("Y年j月")) ?></td>
                        </tr>
                    </tbody>
                </table>
                <table class="uk-table uk-table-striped uk-table-divider uk-margin-remove-bottom uk-table-small">
                    <thead>
                        <tr>
                            <th class="uk-text-center">完治年月</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="uk-text-center"><?= $patient->has("cured") ? h($patient->cured->format("Y年j月")) : "-----" ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div>
                <table class="uk-table uk-margin-remove-bottom uk-table-divider uk-table-small uk-table-middle">
                    <thead>
                        <tr>
                            <th class="uk-text-center uk-table-expand">病名</th>
                            <th class="uk-text-center uk-table-expand">症状</th>
                            <th class="uk-text-center uk-table-expand">症状の現れた部位</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($patient->diseaseds as $diseased): ?>
                            <tr>
                                <td class="uk-text-center uk-card uk-card-default" rowspan="<?= $sicknessesToLocations[$diseased->sicknesses_id] ?>"><?= h($diseased->sickness->sickness_name) ?></td>
                                <?php foreach($diseased->interview_symptoms as $interview): ?>
                                    <?php $sick_count == 0 ? "" : "<tr>" ?>
                                    <td class="uk-text-center uk-tile-muted" rowspan="<?= $symptomsToLocations[$diseased->sicknesses_id][$interview->symptoms_id] ?>"><?= h($interview->symptom->symptoms) ?></td>
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
            </div>
        </div>


        <div class="text">
            <div class="uk-card uk-card-default uk-card-body uk-background-muted">
                <h3 class="uk-card-title">現在の状況</h3>
                <blockquote>
                    <?= $patient->interview_first ?>
                </blockquote>
            </div>
            <div class="uk-card uk-card-default uk-card-body">
                <h3 class="uk-card-title">病気がわかった経緯</h3>
                <blockquote>
                    <?= $patient->interview_second ?>
                </blockquote>
            </div>
            <div class="uk-card uk-card-default uk-card-body uk-background-muted">
                <h3 class="uk-card-title">生活が変わったか</h3>
                <blockquote>
                    <?= $patient->interview_third ?>
                </blockquote>
            </div>
            <div class="uk-card uk-card-default uk-card-body">
                <h3 class="uk-card-title">同じ病気の人へのアドバイス</h3>
                <blockquote>
                    <?= $patient->interview_force ?>
                </blockquote>
            </div>
            <div class="uk-card uk-card-default uk-card-body uk-background-muted">
                <h3 class="uk-card-title">そのほか伝えたいこと</h3>
                <blockquote>
                    <?= $patient->other ?>
                </blockquote>
            </div>
        </div>

    </div>
    <div class="sub uk-width-1-6 uk-margin-auto-right uk-padding-remove uk-text-center">
        <p class="uk-text-lead">関連する記事</p>
        <h4>同じ病気、症状の方</h4>
        <?php foreach($relation_patients as $relation): ?>
            <p><?= $this->Html->link(__($relation->pen_name." さん"), ['controller' => 'patients', 'action' => 'view', $relation->patients_id]) ?></p>
        <?php endforeach ?>

    </div>
</div>


