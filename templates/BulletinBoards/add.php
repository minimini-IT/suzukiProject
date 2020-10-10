<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BulletinBoard $bulletinBoard
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <p><?= $this->Html->link(__('TOPへ'), ["controller" => "Top", 'action' => 'index']) ?></p>
            <p><?= $this->Html->link(__('戻る'), ['action' => 'index']) ?></p>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="bulletinBoards form content">
            <?= $this->Form->create($bulletinBoard) ?>
            <fieldset>
                <legend><?= __('スレッド作成') ?></legend>
                <?php
                    echo $this->Form->control('title', ["label" => "タイトル"]);
                    echo $this->Form->control('author', ["label" => "名前"]);
                    echo $this->Form->control('contents', ["label" => "コメント"]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('作成')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
