<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sickness $sickness
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $sickness->sicknesses_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $sickness->sicknesses_id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Sicknesses'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="sicknesses form content">
            <?= $this->Form->create($sickness) ?>
            <fieldset>
                <legend><?= __('Edit Sickness') ?></legend>
                <?php
                    echo $this->Form->control('sickness_name');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
