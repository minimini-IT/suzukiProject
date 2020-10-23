<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Symptom $symptom
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Symptom'), ['action' => 'edit', $symptom->symptoms_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Symptom'), ['action' => 'delete', $symptom->symptoms_id], ['confirm' => __('Are you sure you want to delete # {0}?', $symptom->symptoms_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Symptoms'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Symptom'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="symptoms view content">
            <h3><?= h($symptom->symptoms_id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Symptoms') ?></th>
                    <td><?= h($symptom->symptoms) ?></td>
                </tr>
                <tr>
                    <th><?= __('Symptoms Id') ?></th>
                    <td><?= $this->Number->format($symptom->symptoms_id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
