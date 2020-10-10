<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sickness $sickness
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Sickness'), ['action' => 'edit', $sickness->sicknesses_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Sickness'), ['action' => 'delete', $sickness->sicknesses_id], ['confirm' => __('Are you sure you want to delete # {0}?', $sickness->sicknesses_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Sicknesses'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Sickness'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="sicknesses view content">
            <h3><?= h($sickness->sicknesses_id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Sickness Name') ?></th>
                    <td><?= h($sickness->sickness_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Sicknesses Id') ?></th>
                    <td><?= $this->Number->format($sickness->sicknesses_id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
