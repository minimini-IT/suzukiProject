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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $symptomsLocation->symptoms_locations_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $symptomsLocation->symptoms_locations_id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Symptoms Locations'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="symptomsLocations form content">
            <?= $this->Form->create($symptomsLocation) ?>
            <fieldset>
                <legend><?= __('Edit Symptoms Location') ?></legend>
                <?php
                    echo $this->Form->control('interview_symptoms_id', ['options' => $interviewSymptoms]);
                    echo $this->Form->control('locations_id', ['options' => $locations]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
