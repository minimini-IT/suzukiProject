<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SymptomsPart $symptomsPart
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $symptomsPart->symptoms_parts_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $symptomsPart->symptoms_parts_id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Symptoms Parts'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="symptomsParts form content">
            <?= $this->Form->create($symptomsPart) ?>
            <fieldset>
                <legend><?= __('Edit Symptoms Part') ?></legend>
                <?php
                    echo $this->Form->control('symptoms_part');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
