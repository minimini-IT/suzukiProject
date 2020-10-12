<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BulletinBoardComment $bulletinBoardComment
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Bulletin Board Comment'), ['action' => 'edit', $bulletinBoardComment->bulletin_board_comments_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Bulletin Board Comment'), ['action' => 'delete', $bulletinBoardComment->bulletin_board_comments_id], ['confirm' => __('Are you sure you want to delete # {0}?', $bulletinBoardComment->bulletin_board_comments_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Bulletin Board Comments'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Bulletin Board Comment'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="bulletinBoardComments view content">
            <h3><?= h($bulletinBoardComment->bulletin_board_comments_id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Bulletin Board') ?></th>
                    <td><?= $bulletinBoardComment->has('bulletin_board') ? $this->Html->link($bulletinBoardComment->bulletin_board->title, ['controller' => 'BulletinBoards', 'action' => 'view', $bulletinBoardComment->bulletin_board->bulletin_boards_id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Comment Author') ?></th>
                    <td><?= h($bulletinBoardComment->comment_author) ?></td>
                </tr>
                <tr>
                    <th><?= __('Bulletin Board Comments Id') ?></th>
                    <td><?= $this->Number->format($bulletinBoardComment->bulletin_board_comments_id) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Comment Contents') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($bulletinBoardComment->comment_contents)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
