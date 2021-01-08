<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RelatedSickness[]|\Cake\Collection\CollectionInterface $relatedSicknesses
 */
?>
<div class="relatedSicknesses index content">
    <?= $this->Html->link(__('New Related Sickness'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Related Sicknesses') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('related_sicknesses_id') ?></th>
                    <th><?= $this->Paginator->sort('articles_id') ?></th>
                    <th><?= $this->Paginator->sort('sicknesses_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($relatedSicknesses as $relatedSickness): ?>
                <tr>
                    <td><?= $this->Number->format($relatedSickness->related_sicknesses_id) ?></td>
                    <td><?= $relatedSickness->has('article') ? $this->Html->link($relatedSickness->article->title, ['controller' => 'Articles', 'action' => 'view', $relatedSickness->article->articles_id]) : '' ?></td>
                    <td><?= $relatedSickness->has('sickness') ? $this->Html->link($relatedSickness->sickness->sickness_name, ['controller' => 'Sicknesses', 'action' => 'view', $relatedSickness->sickness->sicknesses_id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $relatedSickness->related_sicknesses_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $relatedSickness->related_sicknesses_id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $relatedSickness->related_sicknesses_id], ['confirm' => __('Are you sure you want to delete # {0}?', $relatedSickness->related_sicknesses_id)]) ?>
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
