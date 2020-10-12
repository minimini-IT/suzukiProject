<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MessageStatus $messageStatus
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $messageStatus->message_statuses_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $messageStatus->message_statuses_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Message Statuses'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="messageStatuses form large-9 medium-8 columns content">
    <?= $this->Form->create($messageStatus) ?>
    <fieldset>
        <legend><?= __('Edit Message Status') ?></legend>
        <?php
            echo $this->Form->control('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
