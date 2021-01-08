<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RelatedSymptom $relatedSymptom
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $relatedSymptom->related_symptoms_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $relatedSymptom->related_symptoms_id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Related Symptoms'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="relatedSymptoms form content">
            <?= $this->Form->create($relatedSymptom) ?>
            <fieldset>
                <legend><?= __('Edit Related Symptom') ?></legend>
                <?php
                    echo $this->Form->control('articles_id', ['options' => $articles]);
                    echo $this->Form->control('symptoms_id', ['options' => $symptoms]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
