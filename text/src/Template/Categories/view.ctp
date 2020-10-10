<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Category'), ['action' => 'edit', $category->categories_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Category'), ['action' => 'delete', $category->categories_id], ['confirm' => __('Are you sure you want to delete # {0}?', $category->categories_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Categories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Category'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="categories view large-9 medium-8 columns content">
    <h3><?= h($category->categories_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Category') ?></th>
            <td><?= h($category->category) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Categories Id') ?></th>
            <td><?= $this->Number->format($category->categories_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Category Sort Number') ?></th>
            <td><?= $this->Number->format($category->category_sort_number) ?></td>
        </tr>
    </table>
</div>
