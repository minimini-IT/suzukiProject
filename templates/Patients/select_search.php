<?php
$this->assign("title", "編集するインタビュー");
?>
<div class="uk-grid">
    <div class="main uk-width-3-4">

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
        <div class="uk-text-center">

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
        <div class="paginator">
            <ul class="uk-pagination" uk-margin>
                <?= $this->Paginator->first(__('<< ')) ?>
                <?= $this->Paginator->numbers(["first" => "First page", "last" => 1]) ?>
                <?= $this->Paginator->last(__(' >>')) ?>
            </ul>
        </div>
    </div>
    <div class="sub uk-width-1-4 uk-padding-remove uk-text-center">
        <ul class="uk-list">
            <li><?= $this->Html->link(__('LOGOUT'), ["controller" => "management_users", 'action' => 'logout'], ['class' => 'uk-button uk-button-primary uk-margin-bottom management-sub-button uk-padding-remove']) ?></li>
            <li class=><?= $this->Html->link(__('戻る'), ["controller" => "management_users", 'action' => 'top'], ['class' => 'uk-button uk-button-primary uk-margin-bottom management-sub-button uk-padding-remove']) ?></li>
        </ul>
    </div>
</div>


