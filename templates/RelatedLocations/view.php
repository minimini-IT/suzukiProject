<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RelatedLocation $relatedLocation
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Related Location'), ['action' => 'edit', $relatedLocation->related_locations_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Related Location'), ['action' => 'delete', $relatedLocation->related_locations_id], ['confirm' => __('Are you sure you want to delete # {0}?', $relatedLocation->related_locations_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Related Locations'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Related Location'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="relatedLocations view content">
            <h3><?= h($relatedLocation->related_locations_id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Article') ?></th>
                    <td><?= $relatedLocation->has('article') ? $this->Html->link($relatedLocation->article->title, ['controller' => 'Articles', 'action' => 'view', $relatedLocation->article->articles_id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Location') ?></th>
                    <td><?= $relatedLocation->has('location') ? $this->Html->link($relatedLocation->location->location, ['controller' => 'Locations', 'action' => 'view', $relatedLocation->location->locations_id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Related Locations Id') ?></th>
                    <td><?= $this->Number->format($relatedLocation->related_locations_id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
