<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rank $rank
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $rank->ranks_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $rank->ranks_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Ranks'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="ranks form large-9 medium-8 columns content">
    <?= $this->Form->create($rank) ?>
    <fieldset>
        <legend><?= __('Edit Rank') ?></legend>
        <?php
            echo $this->Form->control('rank');
            echo $this->Form->control('abb_rank');
            echo $this->Form->control('rank_sort_number');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
