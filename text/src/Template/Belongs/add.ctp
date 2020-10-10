<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Belong $belong
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('戻る'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('TOPへ'), ["controller" => "Dairy", 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="belongs form large-9 medium-8 columns content">
    <?= $this->Form->create($belong) ?>
    <fieldset>
        <legend><?= __('班追加') ?></legend>
        <?php
            echo $this->Form->control('belong', ["label" => "班"]);
            echo $this->Form->control('belong_sort_number', ["label" => "ソート番号"]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
