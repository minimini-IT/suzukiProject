<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CrewSendComment $crewSendComment
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('戻る'), ['controller' => 'crew-sends', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="crewSendComments form large-9 medium-8 columns content">
    <?= $this->Form->create($crewSendComment, ["type" => "file"]) ?>
    <fieldset>
        <legend><?= __('コメント編集') ?></legend>
        <?php
            echo $this->Form->control('crew_sends_id', ["type" => "hidden"]);
            echo "<h5>{$crewSendComment->crew_send->title}</h5>";
            echo str_replace(";", " ", $this->Form->control('users_id', ["type" => "hidden"]));
            echo "<h6>{$crewSendComment->user->first_name}{$crewSendComment->user->last_name}</h6>";
            echo $this->Form->control('comment');
            echo $this->Form->file("file[]", ["multiple" => "true", "secure" => false]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
