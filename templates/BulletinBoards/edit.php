<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BulletinBoard $bulletinBoard
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $bulletinBoard->bulletin_boards_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $bulletinBoard->bulletin_boards_id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Bulletin Boards'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="bulletinBoards form content">
            <?= $this->Form->create($bulletinBoard) ?>
            <fieldset>
                <legend><?= __('Edit Bulletin Board') ?></legend>
                <?php
                    echo $this->Form->control('title');
                    echo $this->Form->control('author');
                    echo $this->Form->control('contents');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
