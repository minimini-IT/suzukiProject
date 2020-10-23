<?php
$this->assign("title", "ユーザ追加");

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ManagementUser $managementUser
 */
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
                    echo $this->Form->control('password', ["label" => "パスワード"]);
                    echo $this->Form->control('mail', ["label" => "メールアドレス"]);
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
