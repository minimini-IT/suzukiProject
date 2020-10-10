<?php 
    $this->assign("title", "ログイン"); 
?>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Flash->render() ?>
    <h3><?= __('ログイン') ?></h3>
    <p>ユーザID ： nagano</p>
    <p>パスワード ： 123456</p>
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('ユーザIDとパスワードを入力してください') ?></legend>
        <?php
            echo $this->Form->control('username', ["label" => "ユーザID"]);
            echo $this->Form->control('password', ["label" => "パスワード"]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
