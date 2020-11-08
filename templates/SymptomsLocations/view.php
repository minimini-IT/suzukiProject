<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SymptomsLocation $symptomsLocation
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Symptoms Location'), ['action' => 'edit', $symptomsLocation->symptoms_locations_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Symptoms Location'), ['action' => 'delete', $symptomsLocation->symptoms_locations_id], ['confirm' => __('Are you sure you want to delete # {0}?', $symptomsLocation->symptoms_locations_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Symptoms Locations'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Symptoms Location'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="symptomsLocations view content">
            <h3><?= h($symptomsLocation->symptoms_locations_id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Interview Symptom') ?></th>
                    <td><?= $symptomsLocation->has('interview_symptom') ? $this->Html->link($symptomsLocation->interview_symptom->interview_symptoms_id, ['controller' => 'InterviewSymptoms', 'action' => 'view', $symptomsLocation->interview_symptom->interview_symptoms_id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Location') ?></th>
                    <td><?= $symptomsLocation->has('location') ? $this->Html->link($symptomsLocation->location->location, ['controller' => 'Locations', 'action' => 'view', $symptomsLocation->location->locations_id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Symptoms Locations Id') ?></th>
                    <td><?= $this->Number->format($symptomsLocation->symptoms_locations_id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
