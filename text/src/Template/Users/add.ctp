<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('戻る'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('TOPに戻る'), ["controller" => "Dairy", 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('ユーザ追加') ?></legend>
        <?php
            echo $this->Form->control('username', ["label" => "ユーザID"]);
            echo $this->Form->control('first_name', ["label" => "姓"]);
            echo $this->Form->control('last_name', ["label" => "名"]);
            echo $this->Form->control('belongs_id', ["label" => "所属班", 'options' => $belongs]);
            echo $this->Form->control('roles_id', ["label" => "ロール", 'options' => $roles]);
            echo $this->Form->control('password', ["label" => "パスワード"]);
            echo $this->Form->control('user_sort_number', ["label" => "ソート番号"]);
            echo $this->Form->control('ranks_id', ["label" => "階級", 'options' => $ranks]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
