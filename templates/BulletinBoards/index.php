<?php
$this->assign("title", "掲示板");

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BulletinBoard[]|\Cake\Collection\CollectionInterface $bulletinBoards
 */
?>
<div class="bulletinBoards index content">
    <?= $this->Html->link(__('スレッド作成'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('掲示板') ?></h3>
    <?= $this->Html->link(__('戻る'), ["controller" => "Top", 'action' => 'index']) ?>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>スレッドNo.</th>
                    <th>作成者</th>
                    <th>タイトル</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bulletinBoards as $bulletinBoard): ?>
                <tr>
                    <td><?= $this->Number->format($bulletinBoard->bulletin_boards_id) ?></td>
                    <td><?= h($bulletinBoard->author) ?></td>
                    <td><?= h($bulletinBoard->title) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('詳細'), ['action' => 'view', $bulletinBoard->bulletin_boards_id]) ?>
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
