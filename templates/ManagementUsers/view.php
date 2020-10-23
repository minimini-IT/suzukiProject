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
            <?= $this->Html->link(__('Edit Management User'), ['action' => 'edit', $managementUser->management_users_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Management User'), ['action' => 'delete', $managementUser->management_users_id], ['confirm' => __('Are you sure you want to delete # {0}?', $managementUser->management_users_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Management Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Management User'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="managementUsers view content">
            <h3><?= h($managementUser->management_users_id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Last Name') ?></th>
                    <td><?= h($managementUser->last_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('First Name') ?></th>
                    <td><?= h($managementUser->first_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Password') ?></th>
                    <td><?= h($managementUser->password) ?></td>
                </tr>
                <tr>
                    <th><?= __('Mail') ?></th>
                    <td><?= h($managementUser->mail) ?></td>
                </tr>
                <tr>
                    <th><?= __('Management Users Id') ?></th>
                    <td><?= $this->Number->format($managementUser->management_users_id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
