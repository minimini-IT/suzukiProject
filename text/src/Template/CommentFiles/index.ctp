<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CommentFile[]|\Cake\Collection\CollectionInterface $commentFiles
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Comment File'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Crew Send Comments'), ['controller' => 'CrewSendComments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Crew Send Comment'), ['controller' => 'CrewSendComments', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="commentFiles index large-9 medium-8 columns content">
    <h3><?= __('Comment Files') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('comment_files_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('crew_send_comments_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('comment_files_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('comment_files_size') ?></th>
                <th scope="col"><?= $this->Paginator->sort('comment_files_unique_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($commentFiles as $commentFile): ?>
            <tr>
                <td><?= $this->Number->format($commentFile->comment_files_id) ?></td>
                <td><?= $commentFile->has('crew_send_comment') ? $this->Html->link($commentFile->crew_send_comment->crew_send_comments_id, ['controller' => 'CrewSendComments', 'action' => 'view', $commentFile->crew_send_comment->crew_send_comments_id]) : '' ?></td>
                <td><?= h($commentFile->comment_files_name) ?></td>
                <td><?= h($commentFile->comment_files_size) ?></td>
                <td><?= h($commentFile->comment_files_unique_name) ?></td>
                <td><?= h($commentFile->created) ?></td>
                <td><?= h($commentFile->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $commentFile->comment_files_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $commentFile->comment_files_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $commentFile->comment_files_id], ['confirm' => __('Are you sure you want to delete # {0}?', $commentFile->comment_files_id)]) ?>
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
