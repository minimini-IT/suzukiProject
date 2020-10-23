<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SymptomsPart[]|\Cake\Collection\CollectionInterface $symptomsParts
 */
?>
<div class="symptomsParts index content">
    <?= $this->Html->link(__('New Symptoms Part'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Symptoms Parts') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('symptoms_parts_id') ?></th>
                    <th><?= $this->Paginator->sort('symptoms_part') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($symptomsParts as $symptomsPart): ?>
                <tr>
                    <td><?= $this->Number->format($symptomsPart->symptoms_parts_id) ?></td>
                    <td><?= h($symptomsPart->symptoms_part) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $symptomsPart->symptoms_parts_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $symptomsPart->symptoms_parts_id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $symptomsPart->symptoms_parts_id], ['confirm' => __('Are you sure you want to delete # {0}?', $symptomsPart->symptoms_parts_id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
