<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Patient $patient
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $patient->patients_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $patient->patients_id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Patients'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="patients form content">
            <?= $this->Form->create($patient) ?>
            <fieldset>
                <legend><?= __('Edit Patient') ?></legend>
                <?php
                    echo $this->Form->control('patients_initial');
                    echo $this->Form->control('sicknesses_id', ['options' => $sicknesses]);
                    echo $this->Form->control('patient_sexes_id', ['options' => $patientSexes]);
                    echo $this->Form->control('age_of_onset');
                    echo $this->Form->control('year_of_onset');
                    echo $this->Form->control('cured', ['empty' => true]);
                    echo $this->Form->control('comment');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
