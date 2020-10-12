<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sickness[]|\Cake\Collection\CollectionInterface $sicknesses
 */
?>
<div class="sicknesses index content">
    <?= $this->Html->link(__('New Sickness'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Sicknesses') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('sicknesses_id') ?></th>
                    <th><?= $this->Paginator->sort('sickness_name') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sicknesses as $sickness): ?>
                <tr>
                    <td><?= $this->Number->format($sickness->sicknesses_id) ?></td>
                    <td><?= h($sickness->sickness_name) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $sickness->sicknesses_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $sickness->sicknesses_id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $sickness->sicknesses_id], ['confirm' => __('Are you sure you want to delete # {0}?', $sickness->sicknesses_id)]) ?>
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
