<?php
$this->assign("title", "掲示板：".h($bulletinBoard->contents));

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BulletinBoard $bulletinBoard
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h6><?= $this->Html->link(__('戻る'), ['action' => 'index']) ?></h6>
            <h4 class="heading"><?= __('基本情報') ?></h4>
            <p><?= __('スレッドNo.：').$this->Number->format($bulletinBoard->bulletin_boards_id) ?></p>
            <p><?= __('作成者：').h($bulletinBoard->author) ?></p>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="bulletinBoards view content">
            <h3><?= h($bulletinBoard->title) ?></h3>
            <div class="text" style="margin-bottom: 5rem;">
                <blockquote>
                    <?= $this->Text->autoParagraph(h($bulletinBoard->contents)); ?>
                </blockquote>
            </div>
            <?php foreach ($bulletinBoard->bulletin_board_comments as $comment): ?>
                <div class="comment" style="margin-bottom: 3rem;">
                    <p><?= __('名前：').h($comment->comment_author) ?></p>
                    <p><?= __('コメント：').h($comment->comment_contents) ?></p>
                </div>
            <?php endforeach; ?>
            <div class="comment_add" style="margin-bottom: 3rem;">
                <?= $this->Form->create($bulletinBoardComment, [
                    "type" => "post",
                    "url" => [
                        "controller" => "bulletin_board_comments",
                        "action" => "add"
                    ]
                ]) ?> 
                <fieldset>
                    <legend><?= __('コメントする') ?></legend>
                    <?php
                        echo $this->Form->control('bulletin_boards_id', ["type" => "hidden", "value" => $bulletinBoard->bulletin_boards_id]);
                        echo $this->Form->control('comment_author', ["label" => "名前"]);
                        echo $this->Form->control('comment_contents', ["label" => "コメント"]);
                    ?>
                    </fieldset>
                <?= $this->Form->button(__('コメントする')) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
