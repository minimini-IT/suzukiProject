<?php
$this->assign("title", "ユーザ管理");

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ManagementUser[]|\Cake\Collection\CollectionInterface $managementUsers
 */
?>
<div class="managementUsers index content">
    <?= $this->Html->link(__('ユーザを登録する'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('ユーザ管理') ?></h3>
    <?= $this->Html->link(__('戻る'), ["controller" => "ManagementUsers", 'action' => 'top']) ?>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>姓</th>
                    <th>名</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($managementUsers as $managementUser): ?>
                <tr>
                    <td><?= h($managementUser->last_name) ?></td>
                    <td><?= h($managementUser->first_name) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('編集'), ['action' => 'edit', $managementUser->management_users_id]) ?>
                        <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $managementUser->management_users_id], ['confirm' => __('Are you sure you want to delete # {0}?', $managementUser->management_users_id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
