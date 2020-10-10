<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\File $file
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $file->files_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $file->files_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Files'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="files form large-9 medium-8 columns content">
    <?= $this->Form->create($file) ?>
    <fieldset>
        <legend><?= __('Edit File') ?></legend>
        <?php
            echo $this->Form->control('file_group');
            echo $this->Form->control('file_name');
            echo $this->Form->control('file_size');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
