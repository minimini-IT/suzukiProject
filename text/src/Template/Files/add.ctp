<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\File $file
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Files'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="files form large-9 medium-8 columns content">
<!--    <?= $this->Form->create($file, ["type" => "file", "enctype" => "multipart/form-data"]) ?> -->
    <?= $this->Form->create($file, ["type" => "file"]) ?> 
    <fieldset>
        <legend><?= __('Add File') ?></legend>
        <?php
            //echo $this->Form->control("file", ["type" => "file"]);
            echo $this->Form->file("file[]", ["multiple" => "true", "secure" => false]);
            //echo $this->Form->control('file_group', ["type" => "hidden", "value" => (int)$max_file_group->max_group + 1]);
            //echo $this->Form->control('file_name', ["type" => "hidden"]);
            //echo $this->Form->control('file_size', ["type" => "hidden", "value" => ]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
