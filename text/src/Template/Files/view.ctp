<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\File $file
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit File'), ['action' => 'edit', $file->files_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete File'), ['action' => 'delete', $file->files_id], ['confirm' => __('Are you sure you want to delete # {0}?', $file->files_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Files'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New File'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="files view large-9 medium-8 columns content">
    <h3><?= h($file->files_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('File Name') ?></th>
            <td><?= h($file->file_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Files Id') ?></th>
            <td><?= $this->Number->format($file->files_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('File Group') ?></th>
            <td><?= $this->Number->format($file->file_group) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('File Size') ?></th>
            <td><?= $this->Number->format($file->file_size) ?></td>
        </tr>
    </table>
</div>
