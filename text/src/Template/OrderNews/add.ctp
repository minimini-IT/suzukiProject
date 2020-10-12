<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderNews $orderNews
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Order News'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="orderNews form large-9 medium-8 columns content">
    <?= $this->Form->create($orderNews) ?>
    <fieldset>
        <legend><?= __('Add Order News') ?></legend>
        <?php
            echo $this->Form->control('order_news_date');
            echo $this->Form->control('title');
            echo $this->Form->control('comment');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
