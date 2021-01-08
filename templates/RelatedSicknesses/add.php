<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RelatedSickness $relatedSickness
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Related Sicknesses'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="relatedSicknesses form content">
            <?= $this->Form->create($relatedSickness) ?>
            <fieldset>
                <legend><?= __('Add Related Sickness') ?></legend>
                <?php
                    echo $this->Form->control('articles_id', ['options' => $articles]);
                    echo $this->Form->control('sicknesses_id', ['options' => $sicknesses]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
