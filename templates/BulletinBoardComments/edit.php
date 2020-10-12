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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $bulletinBoardComment->bulletin_board_comments_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $bulletinBoardComment->bulletin_board_comments_id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Bulletin Board Comments'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="bulletinBoardComments form content">
            <?= $this->Form->create($bulletinBoardComment) ?>
            <fieldset>
                <legend><?= __('Edit Bulletin Board Comment') ?></legend>
                <?php
                    echo $this->Form->control('bulletin_boards_id', ['options' => $bulletinBoards]);
                    echo $this->Form->control('comment_author');
                    echo $this->Form->control('comment_contents');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
