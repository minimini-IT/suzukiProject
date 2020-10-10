<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PatientSex[]|\Cake\Collection\CollectionInterface $patientSexes
 */
?>
<div class="patientSexes index content">
    <?= $this->Html->link(__('New Patient Sex'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Patient Sexes') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('patient_sexes_id') ?></th>
                    <th><?= $this->Paginator->sort('patient_sex') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($patientSexes as $patientSex): ?>
                <tr>
                    <td><?= $this->Number->format($patientSex->patient_sexes_id) ?></td>
                    <td><?= h($patientSex->patient_sex) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $patientSex->patient_sexes_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $patientSex->patient_sexes_id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $patientSex->patient_sexes_id], ['confirm' => __('Are you sure you want to delete # {0}?', $patientSex->patient_sexes_id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
