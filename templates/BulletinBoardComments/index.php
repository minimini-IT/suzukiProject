<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BulletinBoardComment[]|\Cake\Collection\CollectionInterface $bulletinBoardComments
 */
?>
<div class="bulletinBoardComments index content">
    <?= $this->Html->link(__('New Bulletin Board Comment'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Bulletin Board Comments') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('bulletin_board_comments_id') ?></th>
                    <th><?= $this->Paginator->sort('bulletin_boards_id') ?></th>
                    <th><?= $this->Paginator->sort('comment_author') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bulletinBoardComments as $bulletinBoardComment): ?>
                <tr>
                    <td><?= $this->Number->format($bulletinBoardComment->bulletin_board_comments_id) ?></td>
                    <td><?= $bulletinBoardComment->has('bulletin_board') ? $this->Html->link($bulletinBoardComment->bulletin_board->title, ['controller' => 'BulletinBoards', 'action' => 'view', $bulletinBoardComment->bulletin_board->bulletin_boards_id]) : '' ?></td>
                    <td><?= h($bulletinBoardComment->comment_author) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $bulletinBoardComment->bulletin_board_comments_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $bulletinBoardComment->bulletin_board_comments_id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $bulletinBoardComment->bulletin_board_comments_id], ['confirm' => __('Are you sure you want to delete # {0}?', $bulletinBoardComment->bulletin_board_comments_id)]) ?>
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
