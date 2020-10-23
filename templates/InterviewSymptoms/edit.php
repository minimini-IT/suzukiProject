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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $interviewSymptom->interview_symptoms_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $interviewSymptom->interview_symptoms_id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Interview Symptoms'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="interviewSymptoms form content">
            <?= $this->Form->create($interviewSymptom) ?>
            <fieldset>
                <legend><?= __('Edit Interview Symptom') ?></legend>
                <?php
                    echo $this->Form->control('patients_id', ['options' => $patients]);
                    echo $this->Form->control('symptoms_id', ['options' => $symptoms]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
