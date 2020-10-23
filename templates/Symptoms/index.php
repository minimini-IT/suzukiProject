<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Symptom[]|\Cake\Collection\CollectionInterface $symptoms
 */
?>
<div class="symptoms index content">
    <?= $this->Html->link(__('New Symptom'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Symptoms') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('symptoms_id') ?></th>
                    <th><?= $this->Paginator->sort('symptoms') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($symptoms as $symptom): ?>
                <tr>
                    <td><?= $this->Number->format($symptom->symptoms_id) ?></td>
                    <td><?= h($symptom->symptoms) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $symptom->symptoms_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $symptom->symptoms_id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $symptom->symptoms_id], ['confirm' => __('Are you sure you want to delete # {0}?', $symptom->symptoms_id)]) ?>
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
