<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MessageAnswer $messageAnswer
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('戻る'), ['controller' => 'MessageBords', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="messageAnswers form large-9 medium-8 columns content">
<?php
  foreach($messageAnswer->message_destination->message_bord->message_destinations as $destination){
    if(null !== $destination->message_answer){
      $user[$destination->message_destinations_id] = $destination->user->first_name . $destination->user->last_name;
    }
  }
  foreach($messageAnswer->message_destination->message_bord->message_choices as $choice){
    $choices[$choice->message_choices_id] = $choice->content;
  }
?>
  <?= $this->Form->create($messageAnswer); ?>
    <fieldset>
        <legend><?= __('回答編集') ?></legend>
        <?php
            echo $this->Form->control('message_destinations_id', ["type" => "select", "options" => $user, "label" => "ユーザ"]); 
            echo $this->Form->control('message_choices_id', ["type" => "radio", "options" => $choices, "label" => "選択肢"]);
            echo $this->Form->control('message', ["type" => "textarea", "label" => "メッセージ"]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
