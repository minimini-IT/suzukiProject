<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RelatedLocation[]|\Cake\Collection\CollectionInterface $relatedLocations
 */
?>
<div class="relatedLocations index content">
    <?= $this->Html->link(__('New Related Location'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Related Locations') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('related_locations_id') ?></th>
                    <th><?= $this->Paginator->sort('articles_id') ?></th>
                    <th><?= $this->Paginator->sort('locations_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($relatedLocations as $relatedLocation): ?>
                <tr>
                    <td><?= $this->Number->format($relatedLocation->related_locations_id) ?></td>
                    <td><?= $relatedLocation->has('article') ? $this->Html->link($relatedLocation->article->title, ['controller' => 'Articles', 'action' => 'view', $relatedLocation->article->articles_id]) : '' ?></td>
                    <td><?= $relatedLocation->has('location') ? $this->Html->link($relatedLocation->location->location, ['controller' => 'Locations', 'action' => 'view', $relatedLocation->location->locations_id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $relatedLocation->related_locations_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $relatedLocation->related_locations_id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $relatedLocation->related_locations_id], ['confirm' => __('Are you sure you want to delete # {0}?', $relatedLocation->related_locations_id)]) ?>
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
