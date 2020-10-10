<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CrewSendComment $crewSendComment
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Crew Send Comment'), ['action' => 'edit', $crewSendComment->crew_send_comments_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Crew Send Comment'), ['action' => 'delete', $crewSendComment->crew_send_comments_id], ['confirm' => __('Are you sure you want to delete # {0}?', $crewSendComment->crew_send_comments_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Crew Send Comments'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Crew Send Comment'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Crew Sends'), ['controller' => 'CrewSends', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Crew Send'), ['controller' => 'CrewSends', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="crewSendComments view large-9 medium-8 columns content">
    <h3><?= h($crewSendComment->crew_send_comments_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Crew Send') ?></th>
            <td><?= $crewSendComment->has('crew_send') ? $this->Html->link($crewSendComment->crew_send->title, ['controller' => 'CrewSends', 'action' => 'view', $crewSendComment->crew_send->crew_sends_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $crewSendComment->has('user') ? $this->Html->link($crewSendComment->user->Array, ['controller' => 'Users', 'action' => 'view', $crewSendComment->user->user_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Crew Send Comments Id') ?></th>
            <td><?= $this->Number->format($crewSendComment->crew_send_comments_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('File Group') ?></th>
            <td><?= $this->Number->format($crewSendComment->file_group) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($crewSendComment->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($crewSendComment->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Comment') ?></h4>
        <?= $this->Text->autoParagraph(h($crewSendComment->comment)); ?>
    </div>
</div>
