<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ManagementUser $managementUser
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $managementUser->management_users_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $managementUser->management_users_id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Management Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="managementUsers form content">
            <?= $this->Form->create($managementUser) ?>
            <fieldset>
                <legend><?= __('Edit Management User') ?></legend>
                <?php
                    echo $this->Form->control('last_name');
                    echo $this->Form->control('first_name');
                    echo $this->Form->control('password');
                    echo $this->Form->control('mail');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
