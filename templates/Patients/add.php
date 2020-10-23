<?php
$this->assign("title", "インタビュー作成");
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Patient $patient
 */
?>
<div class="row">
    <div class="column-responsive column-80">
        <div class="patients form content">
            <?= $this->Form->create($patient) ?>
            <fieldset>
                <legend><?= __('インタビュー作成') ?></legend>
                <?php
                    echo $this->Form->control('pen_name', ["label" => "ペンネーム"]);
                    echo $this->Form->control('sicknesses_id', ["label" => "病名", 'options' => $sicknesses, "multiple" => "checkbox"]);
                    echo $this->Form->control('patient_sexes_id', ["label" => "性別", 'options' => $patientSexes]);
                    echo $this->Form->control('age_of_onset', ["label" => "発病時の年齢", "min" => 0]);
                    echo $this->Form->control('year_of_onset', ["label" => "発病年月"]);
                    echo $this->Form->control('cured', ["label" => "完治した年月", 'empty' => true]);
                    echo $this->Form->control('comment', ["label" => "内容"]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('送信')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
    <aside class="column">
        <div class="side-nav">
            <?= $this->Html->link(__('戻る'), ["controller" => "DashboardManagement", 'action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
</div>
