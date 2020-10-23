<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SymptomsPart $symptomsPart
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Symptoms Part'), ['action' => 'edit', $symptomsPart->symptoms_parts_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Symptoms Part'), ['action' => 'delete', $symptomsPart->symptoms_parts_id], ['confirm' => __('Are you sure you want to delete # {0}?', $symptomsPart->symptoms_parts_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Symptoms Parts'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Symptoms Part'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="symptomsParts view content">
            <h3><?= h($symptomsPart->symptoms_parts_id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Symptoms Part') ?></th>
                    <td><?= h($symptomsPart->symptoms_part) ?></td>
                </tr>
                <tr>
                    <th><?= __('Symptoms Parts Id') ?></th>
                    <td><?= $this->Number->format($symptomsPart->symptoms_parts_id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
