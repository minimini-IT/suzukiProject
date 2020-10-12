<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CrewSend $crewSend
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Crew Send'), ['action' => 'edit', $crewSend->crew_sends_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Crew Send'), ['action' => 'delete', $crewSend->crew_sends_id], ['confirm' => __('Are you sure you want to delete # {0}?', $crewSend->crew_sends_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Crew Sends'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Crew Send'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Categories'), ['controller' => 'Categories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Statuses'), ['controller' => 'Statuses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Status'), ['controller' => 'Statuses', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="crewSends view large-9 medium-8 columns content">
    <h3><?= h($crewSend->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('File Group') ?></th>
            <td><?= $this->Number->format($crewSend->file_group) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Comment') ?></th>
            <td><?= h($crewSend->comment) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Comment') ?></h4>
        <?= $this->Text->autoParagraph(h($crewSend->comment)); ?>
    </div>
</div>
