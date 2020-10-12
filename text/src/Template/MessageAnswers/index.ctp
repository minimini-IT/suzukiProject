<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MessageAnswer[]|\Cake\Collection\CollectionInterface $messageAnswers
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Message Answer'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Message Choices'), ['controller' => 'MessageChoices', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Message Choice'), ['controller' => 'MessageChoices', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Message Destinations'), ['controller' => 'MessageDestinations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Message Destination'), ['controller' => 'MessageDestinations', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="messageAnswers index large-9 medium-8 columns content">
    <h3><?= __('Message Answers') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('message_answers_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('message_destinations_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('message_choices_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($messageAnswers as $messageAnswer): ?>
            <tr>
                <td><?= $this->Number->format($messageAnswer->message_answers_id) ?></td>
                <td><?= $this->Number->format($messageAnswer->message_destinations_id) ?></td>
                <td><?= $messageAnswer->has('message_choice') ? $this->Html->link($messageAnswer->message_choice->message_choices_id, ['controller' => 'MessageChoices', 'action' => 'view', $messageAnswer->message_choice->message_choices_id]) : '' ?></td>
                <td><?= h($messageAnswer->created) ?></td>
                <td><?= h($messageAnswer->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $messageAnswer->message_answers_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $messageAnswer->message_answers_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $messageAnswer->message_answers_id], ['confirm' => __('Are you sure you want to delete # {0}?', $messageAnswer->message_answers_id)]) ?>
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
