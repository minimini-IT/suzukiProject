<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\InterviewSymptom $interviewSymptom
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Interview Symptom'), ['action' => 'edit', $interviewSymptom->interview_symptoms_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Interview Symptom'), ['action' => 'delete', $interviewSymptom->interview_symptoms_id], ['confirm' => __('Are you sure you want to delete # {0}?', $interviewSymptom->interview_symptoms_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Interview Symptoms'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Interview Symptom'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="interviewSymptoms view content">
            <h3><?= h($interviewSymptom->interview_symptoms_id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Patient') ?></th>
                    <td><?= $interviewSymptom->has('patient') ? $this->Html->link($interviewSymptom->patient->patients_id, ['controller' => 'Patients', 'action' => 'view', $interviewSymptom->patient->patients_id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Symptom') ?></th>
                    <td><?= $interviewSymptom->has('symptom') ? $this->Html->link($interviewSymptom->symptom->symptoms, ['controller' => 'Symptoms', 'action' => 'view', $interviewSymptom->symptom->symptoms_id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Interview Symptoms Id') ?></th>
                    <td><?= $this->Number->format($interviewSymptom->interview_symptoms_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($interviewSymptom->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($interviewSymptom->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Symptoms Locations') ?></h4>
                <?php if (!empty($interviewSymptom->symptoms_locations)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Symptoms Locations Id') ?></th>
                            <th><?= __('Interview Symptoms Id') ?></th>
                            <th><?= __('Locations Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($interviewSymptom->symptoms_locations as $symptomsLocations) : ?>
                        <tr>
                            <td><?= h($symptomsLocations->symptoms_locations_id) ?></td>
                            <td><?= h($symptomsLocations->interview_symptoms_id) ?></td>
                            <td><?= h($symptomsLocations->locations_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'SymptomsLocations', 'action' => 'view', $symptomsLocations->symptoms_locations_id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'SymptomsLocations', 'action' => 'edit', $symptomsLocations->symptoms_locations_id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'SymptomsLocations', 'action' => 'delete', $symptomsLocations->symptoms_locations_id], ['confirm' => __('Are you sure you want to delete # {0}?', $symptomsLocations->symptoms_locations_id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
