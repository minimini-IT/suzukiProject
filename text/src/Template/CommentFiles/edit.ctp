<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CommentFile $commentFile
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $commentFile->comment_files_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $commentFile->comment_files_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Comment Files'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Crew Send Comments'), ['controller' => 'CrewSendComments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Crew Send Comment'), ['controller' => 'CrewSendComments', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="commentFiles form large-9 medium-8 columns content">
    <?= $this->Form->create($commentFile) ?>
    <fieldset>
        <legend><?= __('Edit Comment File') ?></legend>
        <?php
            echo $this->Form->control('crew_send_comments_id', ['options' => $crewSendComments]);
            echo $this->Form->control('comment_files_name');
            echo $this->Form->control('comment_files_size');
            echo $this->Form->control('comment_files_unique_name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
