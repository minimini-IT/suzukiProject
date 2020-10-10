<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CommentFile $commentFile
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Comment File'), ['action' => 'edit', $commentFile->comment_files_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Comment File'), ['action' => 'delete', $commentFile->comment_files_id], ['confirm' => __('Are you sure you want to delete # {0}?', $commentFile->comment_files_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Comment Files'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Comment File'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Crew Send Comments'), ['controller' => 'CrewSendComments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Crew Send Comment'), ['controller' => 'CrewSendComments', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="commentFiles view large-9 medium-8 columns content">
    <h3><?= h($commentFile->comment_files_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Crew Send Comment') ?></th>
            <td><?= $commentFile->has('crew_send_comment') ? $this->Html->link($commentFile->crew_send_comment->crew_send_comments_id, ['controller' => 'CrewSendComments', 'action' => 'view', $commentFile->crew_send_comment->crew_send_comments_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Comment Files Name') ?></th>
            <td><?= h($commentFile->comment_files_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Comment Files Size') ?></th>
            <td><?= h($commentFile->comment_files_size) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Comment Files Unique Name') ?></th>
            <td><?= h($commentFile->comment_files_unique_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Comment Files Id') ?></th>
            <td><?= $this->Number->format($commentFile->comment_files_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($commentFile->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($commentFile->modified) ?></td>
        </tr>
    </table>
</div>
