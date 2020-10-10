<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Belong $belong
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Belong'), ['action' => 'edit', $belong->belongs_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Belong'), ['action' => 'delete', $belong->belongs_id], ['confirm' => __('Are you sure you want to delete # {0}?', $belong->belongs_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Belongs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Belong'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="belongs view large-9 medium-8 columns content">
    <h3><?= h($belong->belong) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Belong') ?></th>
            <td><?= h($belong->belong) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Belongs Id') ?></th>
            <td><?= $this->Number->format($belong->belongs_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Belong Sort Number') ?></th>
            <td><?= $this->Number->format($belong->belong_sort_number) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Users') ?></h4>
        <?php if (!empty($belong->users)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('First Name') ?></th>
                <th scope="col"><?= __('Last Name') ?></th>
                <th scope="col"><?= __('Class Id') ?></th>
                <th scope="col"><?= __('Belong Id') ?></th>
                <th scope="col"><?= __('Password') ?></th>
                <th scope="col"><?= __('User Sort Number') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($belong->users as $users): ?>
            <tr>
                <td><?= h($users->user_id) ?></td>
                <td><?= h($users->first_name) ?></td>
                <td><?= h($users->last_name) ?></td>
                <td><?= h($users->class_id) ?></td>
                <td><?= h($users->belong_id) ?></td>
                <td><?= h($users->password) ?></td>
                <td><?= h($users->user_sort_number) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->user_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->user_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->user_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
