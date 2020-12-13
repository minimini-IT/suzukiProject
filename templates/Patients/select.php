<?php
$this->assign("title", "編集するインタビュー");
?>
<div class="uk-grid grid-margin-remove">
    <div class="medium-subbar">
        <nav class="uk-navbar-container" uk-navbar>
            <div class="uk-navbar-right">
                <ul class="uk-navbar-nav">
                   <li class="medium-subbar-li"><?= $this->Html->link(__('戻る'), ["controller" => "management_users", 'action' => 'top'], ['class' => 'uk-button uk-button-primary management-sub-button uk-padding-remove medium-subbar-height']) ?></li>
                   <li class="medium-subbar-li"><?= $this->Html->link(__('LOGOUT'), ['action' => 'logout'], ['class' => 'uk-button uk-button-primary management-sub-button uk-padding-remove medium-subbar-height']) ?></li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="uk-width-3-4@m medium-margin uk-width-1-1 grid-child">

        <div class="uk-first-column uk-card uk-card-default uk-padding-small uk-margin-bottom">
            <?= $this->Form->create(null, [
                "type" => "get",
                "url" => [
                    "controller" => "patients",
                    "action" => "select_search"
                ]
            ]) ?> 
                <?php $this->Form->setTemplates(["inputContainer" => "<div class='input {{type}}{{required}} uk-inline'>{{content}}</div>", ]); ?>
                <?= $this->Form->control("pen_name", ["label" => "ペンネーム : ", "class" => "uk-input uk-form-width-medium"]) ?>
                <?= $this->Form->button('検索', ["class" => "uk-button uk-button-primary uk-position-small uk-position-center-right"]) ?>
            <?= $this->Form->end() ?>
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
                            <td><?= h($patient->pen_name) ?> さん</td>
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
                            <td><?= $this->Html->link(__('編集'), ["controller" => "patients", 'action' => 'edit', $patient->patients_id], ["class" => "uk-button uk-button-default"]) ?></td>
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
                    <td><?= $this->Html->link($patient_link, ['action' => 'edit', $patient->patients_id], ["escape" => false]) ?></td>
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
    <div class="uk-width-1-4 uk-padding-remove uk-text-center medium-remove">
        <ul class="uk-list">
            <li><?= $this->Html->link(__('LOGOUT'), ["controller" => "management_users", 'action' => 'logout'], ['class' => 'uk-button uk-button-primary uk-margin-bottom management-sub-button uk-padding-remove']) ?></li>
            <li class=><?= $this->Html->link(__('戻る'), ["controller" => "management_users", 'action' => 'top'], ['class' => 'uk-button uk-button-primary uk-margin-bottom management-sub-button uk-padding-remove']) ?></li>
        </ul>
    </div>
</div>
