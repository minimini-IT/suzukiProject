<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MessageBordChronology $messageBordChronology
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('戻る'), ['controller' => 'MessageBords', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('TOPへ戻る'), ['controller' => 'Dairy', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="messageBordChronologies form large-9 medium-8 columns content">
    <?= $this->Form->create($messageBordChronology) ?>
    <fieldset>
        <legend><?= __('編集') ?></legend>
        <?php
            echo $this->Form->control('message_bords_id', ['options' => $messageBords]);
            echo $this->Form->control('users_id', ['options' => $users]);
            echo $this->Form->control('message');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
