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
            <?= $this->Html->link(__('Edit Patient Sex'), ['action' => 'edit', $patientSex->patient_sexes_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Patient Sex'), ['action' => 'delete', $patientSex->patient_sexes_id], ['confirm' => __('Are you sure you want to delete # {0}?', $patientSex->patient_sexes_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Patient Sexes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Patient Sex'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="patientSexes view content">
            <h3><?= h($patientSex->patient_sexes_id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Patient Sex') ?></th>
                    <td><?= h($patientSex->patient_sex) ?></td>
                </tr>
                <tr>
                    <th><?= __('Patient Sexes Id') ?></th>
                    <td><?= $this->Number->format($patientSex->patient_sexes_id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
