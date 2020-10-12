<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PatientSex $patientSex
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $patientSex->patient_sexes_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $patientSex->patient_sexes_id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Patient Sexes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="patientSexes form content">
            <?= $this->Form->create($patientSex) ?>
            <fieldset>
                <legend><?= __('Edit Patient Sex') ?></legend>
                <?php
                    echo $this->Form->control('patient_sex');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
