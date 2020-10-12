<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Status $status
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $status->statuses_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $status->statuses_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Statuses'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="statuses form large-9 medium-8 columns content">
    <?= $this->Form->create($status) ?>
    <fieldset>
        <legend><?= __('Edit Status') ?></legend>
        <?php
            echo $this->Form->control('status');
            echo $this->Form->control('status_sort_number');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
