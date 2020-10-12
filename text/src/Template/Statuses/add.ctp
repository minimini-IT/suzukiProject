<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Status $status
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('戻る'), ["controller" => "CrewSends", 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('TOPへ'), ['controller' => 'Dairy', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="statuses form large-9 medium-8 columns content">
    <?= $this->Form->create($status) ?>
    <fieldset>
        <legend><?= __('ステータス追加') ?></legend>
        <?php
            echo $this->Form->control('status', ["label" => "ステータス"]);
            echo $this->Form->control('status_sort_number', ["label" => "ソート番号"]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
