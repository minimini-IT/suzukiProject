<?php
$this->assign("title", "ログイン");
$this->Html->script("p_toggle.js", ["block" => true]);
?>
<div>
    <!--<div class="uk-width-2-5 uk-margin-auto-left uk-margin-auto-right uk-padding uk-first-column">-->
    <div class="login-form-width uk-margin-auto-right uk-margin-auto-left uk-first-column uk-padding">
    <?= $this->Flash->render() ?>
        <div>
            <?= $this->Form->create() ?>
                <legend><?= __("ユーザIDとパスワードを入力してくだい") ?></legend>

                <?php $this->Form->setTemplates([
                    "inputContainer" => "<div class='input {{type}} {{required}} uk-margin'><div class='uk-position-relative'><span class='uk-form-icon uk-form-icon-flip' uk-icon='icon: user'></span>{{content}}</div></div>",
                ]); ?>
                <?= $this->Form->control("email", ["label" => false, "required" => true, "class" => "uk-input"]) ?>

                <?php $this->Form->setTemplates(["inputContainer" => "<div class='input {{type}} {{required}} uk-margin'><div class='uk-position-relative'><a href='#' class='uk-form-icon uk-form-icon-flip toggle-password' uk-icon='icon: lock'></a>{{content}}</div></div>"]); ?>
                <?= $this->Form->control("password", ["label" => false , "required" => true, "class" => "uk-input"]) ?>

            <?= $this->Form->submit(__("Login"), ["class" => "uk-button uk-button-defaule"]); ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
