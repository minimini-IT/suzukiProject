<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RelatedLocation $relatedLocation
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Related Locations'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="relatedLocations form content">
            <?= $this->Form->create($relatedLocation) ?>
            <fieldset>
                <legend><?= __('Add Related Location') ?></legend>
                <?php
                    echo $this->Form->control('articles_id', ['options' => $articles]);
                    echo $this->Form->control('locations_id', ['options' => $locations]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
