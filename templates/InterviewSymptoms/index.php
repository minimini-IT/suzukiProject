<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\InterviewSymptom[]|\Cake\Collection\CollectionInterface $interviewSymptoms
 */
?>
<div class="interviewSymptoms index content">
    <?= $this->Html->link(__('New Interview Symptom'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Interview Symptoms') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('interview_symptoms_id') ?></th>
                    <th><?= $this->Paginator->sort('patients_id') ?></th>
                    <th><?= $this->Paginator->sort('symptoms_id') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($interviewSymptoms as $interviewSymptom): ?>
                <tr>
                    <td><?= $this->Number->format($interviewSymptom->interview_symptoms_id) ?></td>
                    <td><?= $interviewSymptom->has('patient') ? $this->Html->link($interviewSymptom->patient->patients_id, ['controller' => 'Patients', 'action' => 'view', $interviewSymptom->patient->patients_id]) : '' ?></td>
                    <td><?= $interviewSymptom->has('symptom') ? $this->Html->link($interviewSymptom->symptom->symptoms, ['controller' => 'Symptoms', 'action' => 'view', $interviewSymptom->symptom->symptoms_id]) : '' ?></td>
                    <td><?= h($interviewSymptom->created) ?></td>
                    <td><?= h($interviewSymptom->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $interviewSymptom->interview_symptoms_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $interviewSymptom->interview_symptoms_id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $interviewSymptom->interview_symptoms_id], ['confirm' => __('Are you sure you want to delete # {0}?', $interviewSymptom->interview_symptoms_id)]) ?>
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
