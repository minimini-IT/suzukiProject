<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Patient[]|\Cake\Collection\CollectionInterface $patients
 */
?>
<div class="patients index content">
<!--
    <?= $this->Html->link(__('闘病者を追加する'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    -->
    <h3><?= __('闘病者') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>イニシャル</th>
                    <th>病名</th>
                    <th>性別</th>
                    <th>発病時の年齢</th>
                    <th>発病年月</th>
                    <th>完治した年月</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($patients as $patient): ?>
                <tr>
                    <td><?= h($patient->patients_initial) ?></td>
                    <td><?= h($patient->sickness->sickness_name) ?></td>
                    <td><?= h($patient->patient_sex->patient_sex) ?></td>
                    <td><?= $this->Number->format($patient->age_of_onset) ?></td>
                    <td><?= h($patient->year_of_onset->format("Y-m-d")) ?></td>
                    <td><?= $patient->has("cured") ? h($patient->cured->format("Y-m-d")) : "-----" ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('詳細'), ['action' => 'view', $patient->patients_id]) ?>
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
