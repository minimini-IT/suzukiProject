<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SymptomsLocation[]|\Cake\Collection\CollectionInterface $symptomsLocations
 */
?>
<div class="symptomsLocations index content">
    <?= $this->Html->link(__('New Symptoms Location'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Symptoms Locations') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('symptoms_locations_id') ?></th>
                    <th><?= $this->Paginator->sort('interview_symptoms_id') ?></th>
                    <th><?= $this->Paginator->sort('locations_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($symptomsLocations as $symptomsLocation): ?>
                <tr>
                    <td><?= $this->Number->format($symptomsLocation->symptoms_locations_id) ?></td>
                    <td><?= $symptomsLocation->has('interview_symptom') ? $this->Html->link($symptomsLocation->interview_symptom->interview_symptoms_id, ['controller' => 'InterviewSymptoms', 'action' => 'view', $symptomsLocation->interview_symptom->interview_symptoms_id]) : '' ?></td>
                    <td><?= $symptomsLocation->has('location') ? $this->Html->link($symptomsLocation->location->location, ['controller' => 'Locations', 'action' => 'view', $symptomsLocation->location->locations_id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $symptomsLocation->symptoms_locations_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $symptomsLocation->symptoms_locations_id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $symptomsLocation->symptoms_locations_id], ['confirm' => __('Are you sure you want to delete # {0}?', $symptomsLocation->symptoms_locations_id)]) ?>
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
