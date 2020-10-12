<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MessageChoice[]|\Cake\Collection\CollectionInterface $messageChoices
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Message Choice'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Message Bords'), ['controller' => 'MessageBords', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Message Bord'), ['controller' => 'MessageBords', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Message Answers'), ['controller' => 'MessageAnswers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Message Answer'), ['controller' => 'MessageAnswers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="messageChoices index large-9 medium-8 columns content">
    <h3><?= __('Message Choices') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('message_choices_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('message_bords_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('content') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($messageChoices as $messageChoice): ?>
            <tr>
                <td><?= $this->Number->format($messageChoice->message_choices_id) ?></td>
                <td><?= $messageChoice->has('message_bord') ? $this->Html->link($messageChoice->message_bord->title, ['controller' => 'MessageBords', 'action' => 'view', $messageChoice->message_bord->message_bords_id]) : '' ?></td>
                <td><?= h($messageChoice->content) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $messageChoice->message_choices_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $messageChoice->message_choices_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $messageChoice->message_choices_id], ['confirm' => __('Are you sure you want to delete # {0}?', $messageChoice->message_choices_id)]) ?>
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
