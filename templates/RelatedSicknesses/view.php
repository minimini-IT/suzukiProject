<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RelatedSickness $relatedSickness
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Related Sickness'), ['action' => 'edit', $relatedSickness->related_sicknesses_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Related Sickness'), ['action' => 'delete', $relatedSickness->related_sicknesses_id], ['confirm' => __('Are you sure you want to delete # {0}?', $relatedSickness->related_sicknesses_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Related Sicknesses'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Related Sickness'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="relatedSicknesses view content">
            <h3><?= h($relatedSickness->related_sicknesses_id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Article') ?></th>
                    <td><?= $relatedSickness->has('article') ? $this->Html->link($relatedSickness->article->title, ['controller' => 'Articles', 'action' => 'view', $relatedSickness->article->articles_id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Sickness') ?></th>
                    <td><?= $relatedSickness->has('sickness') ? $this->Html->link($relatedSickness->sickness->sickness_name, ['controller' => 'Sicknesses', 'action' => 'view', $relatedSickness->sickness->sicknesses_id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Related Sicknesses Id') ?></th>
                    <td><?= $this->Number->format($relatedSickness->related_sicknesses_id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
