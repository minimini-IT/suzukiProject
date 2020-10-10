<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Patient $patient
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('基本情報') ?></h4>
            <p><?= h($patient->sickness->sickness_name) ?></p>
            <p><?= h($patient->patient_sex->patient_sex) ?></p>
            <p><?= $this->Number->format($patient->age_of_onset) ?>歳</p>
            <p><?= h($patient->year_of_onset->format("Y-m-d")) ?></p>
            <p><?= $patient->has("cured") ? h($patient->cured->format("Y-m-d")) : "-----" ?></p>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="patients view content">
            <h3><?= h($patient->patients_initial) ?>さん</h3>
            <div class="text">
                <blockquote>
                    <?= $this->Text->autoParagraph(h($patient->comment)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
