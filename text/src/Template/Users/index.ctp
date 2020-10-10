<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('ユーザ追加'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('班追加'), ['controller' => 'Belongs', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('階級追加'), ['controller' => 'Ranks', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('TOPへ戻る'), ['controller' => 'Dairy', 'action' => 'index']) ?></li>
    </ul>
    <p>転出、退職者を含めたユーザ一覧</p>
    <p>権限は現段階で４つ</p>
    <p>基本的に編集、削除は各ユーザの権限と同等以下のものしか許可されない</p>
    <p>ユーザを作成する場合は、作成を行うユーザと同等以下の権限しかあたえられない</p>
</nav>
<div class="users index large-9 medium-8 columns content">
    <h3><?= __('Users') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('username', "ユーザID") ?></th>
                <th scope="col"><?= $this->Paginator->sort('first_name', "姓") ?></th>
                <th scope="col"><?= $this->Paginator->sort('last_name', "名") ?></th>
                <th scope="col"><?= $this->Paginator->sort('belongs_id', "所属班") ?></th>
                <th scope="col"><?= $this->Paginator->sort('ranks_id', "階級") ?></th>
                <th scope="col"><?= $this->Paginator->sort('roles_id', "権限") ?></th>
                <th scope="col"><?= $this->Paginator->sort('delete_flag', "転出") ?></th>
                <th scope="col" class="actions"><?= __('編集・削除') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= h($user->username) ?></td>
                <td><?= h($user->first_name) ?></td>
                <td><?= h($user->last_name) ?></td>
                <td><?= h($user->belong->belong) ?></td>
                <td><?= h($user->rank->rank) ?></td>
                <td><?= h($user->role->role_jp) ?></td>
                <td><?= h($user->delete_flag) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('編集'), ['action' => 'edit', $user->users_id]) ?>
                    <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $user->users_id], ['confirm' => __('{0} このユーザを削除しますか？', $user->username)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
