<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CrewSendComment[]|\Cake\Collection\CollectionInterface $crewSendComments
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Crew Send Comment'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Crew Sends'), ['controller' => 'CrewSends', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Crew Send'), ['controller' => 'CrewSends', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="crewSendComments index large-9 medium-8 columns content">
    <h3><?= __('Crew Send Comments') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('crew_send_comments_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('crew_sends_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('users_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('file_group') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($crewSendComments as $crewSendComment): ?>
            <tr>
                <td><?= $this->Number->format($crewSendComment->crew_send_comments_id) ?></td>
                <td><?= $crewSendComment->has('crew_send') ? $this->Html->link($crewSendComment->crew_send->title, ['controller' => 'CrewSends', 'action' => 'view', $crewSendComment->crew_send->crew_sends_id]) : '' ?></td>
                <!--<td><?= $crewSendComment->has('user') ? $this->Html->link($crewSendComment->user->Array, ['controller' => 'Users', 'action' => 'view', $crewSendComment->user->first_name . $crewSendComment->user->last_name]) : '' ?></td>-->
                <td><?= h($crewSendComment->user->first_name . $crewSendComment->user->last_name) ?></td>
                <td><?= $this->Number->format($crewSendComment->file_group) ?></td>
                <td><?= h($crewSendComment->created) ?></td>
                <td><?= h($crewSendComment->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $crewSendComment->crew_send_comments_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $crewSendComment->crew_send_comments_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $crewSendComment->crew_send_comments_id], ['confirm' => __('Are you sure you want to delete # {0}?', $crewSendComment->crew_send_comments_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
