<?php
$this->assign("title", "ユーザ追加");
$this->Html->script("passwordHidden.js", ["block" => true]);
$this->Html->css("https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css", ["block" => true]);
?>
<div class="row">
    <div class="column-responsive column-80">
        <div class="managementUsers form content">
            <?= $this->Form->create($managementUser) ?>
            <fieldset>
                <legend><?= __('ユーザ追加') ?></legend>
                <?php
                    echo $this->Form->control('last_name', ["label" => "性"]);
                    echo $this->Form->control('first_name', ["label" => "名"]);
                    echo $this->Form->control('mail', ["label" => "メールアドレス"]);
                    echo $this->Form->control('password', ["label" => "パスワード"]);
                    //$this->Form->setTemplates(["inputContainer" => '<div class="input {{type}}{{required}}"> {{content}} <span class="field-icon">{{help}}</span></div>']);
                    //echo $this->Form->control('password', [
                    //    "label" => "パスワード", 
                    //    "templateVars" => [
                    //        "help" => "<img style='hight: 50px;' src='/img/eye.png' toggle='password-field' class='mdi mdi-eye toggle-password'>"
                    //    ]
                    //]);
                    //echo $this->Form->control('password', ["label" => "パスワード"]);
                    //パスワードはデザインの時に
                ?>
            </fieldset>
            <?= $this->Form->button(__('送信')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
    <aside class="column">
        <div class="side-nav">
            <?= $this->Html->link(__('戻る'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
</div>
