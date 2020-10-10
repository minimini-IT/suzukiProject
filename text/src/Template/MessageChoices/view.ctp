<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MessageChoice $messageChoice
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Message Choice'), ['action' => 'edit', $messageChoice->message_choices_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Message Choice'), ['action' => 'delete', $messageChoice->message_choices_id], ['confirm' => __('Are you sure you want to delete # {0}?', $messageChoice->message_choices_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Message Choices'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Message Choice'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Message Bords'), ['controller' => 'MessageBords', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Message Bord'), ['controller' => 'MessageBords', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Message Answers'), ['controller' => 'MessageAnswers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Message Answer'), ['controller' => 'MessageAnswers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="messageChoices view large-9 medium-8 columns content">
    <h3><?= h($messageChoice->message_choices_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Message Bord') ?></th>
            <td><?= $messageChoice->has('message_bord') ? $this->Html->link($messageChoice->message_bord->title, ['controller' => 'MessageBords', 'action' => 'view', $messageChoice->message_bord->message_bords_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Content') ?></th>
            <td><?= h($messageChoice->content) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Message Choices Id') ?></th>
            <td><?= $this->Number->format($messageChoice->message_choices_id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Message Answers') ?></h4>
        <?php if (!empty($messageChoice->message_answers)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Message Answers Id') ?></th>
                <th scope="col"><?= __('Message Destinations Id') ?></th>
                <th scope="col"><?= __('Message Choices Id') ?></th>
                <th scope="col"><?= __('Message') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($messageChoice->message_answers as $messageAnswers): ?>
            <tr>
                <td><?= h($messageAnswers->message_answers_id) ?></td>
                <td><?= h($messageAnswers->message_destinations_id) ?></td>
                <td><?= h($messageAnswers->message_choices_id) ?></td>
                <td><?= h($messageAnswers->message) ?></td>
                <td><?= h($messageAnswers->created) ?></td>
                <td><?= h($messageAnswers->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'MessageAnswers', 'action' => 'view', $messageAnswers->message_answers_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'MessageAnswers', 'action' => 'edit', $messageAnswers->message_answers_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'MessageAnswers', 'action' => 'delete', $messageAnswers->message_answers_id], ['confirm' => __('Are you sure you want to delete # {0}?', $messageAnswers->message_answers_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
