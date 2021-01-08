<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RelatedSymptom[]|\Cake\Collection\CollectionInterface $relatedSymptoms
 */
?>
<div class="relatedSymptoms index content">
    <?= $this->Html->link(__('New Related Symptom'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Related Symptoms') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('related_symptoms_id') ?></th>
                    <th><?= $this->Paginator->sort('articles_id') ?></th>
                    <th><?= $this->Paginator->sort('symptoms_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($relatedSymptoms as $relatedSymptom): ?>
                <tr>
                    <td><?= $this->Number->format($relatedSymptom->related_symptoms_id) ?></td>
                    <td><?= $relatedSymptom->has('article') ? $this->Html->link($relatedSymptom->article->title, ['controller' => 'Articles', 'action' => 'view', $relatedSymptom->article->articles_id]) : '' ?></td>
                    <td><?= $relatedSymptom->has('symptom') ? $this->Html->link($relatedSymptom->symptom->symptoms, ['controller' => 'Symptoms', 'action' => 'view', $relatedSymptom->symptom->symptoms_id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $relatedSymptom->related_symptoms_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $relatedSymptom->related_symptoms_id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $relatedSymptom->related_symptoms_id], ['confirm' => __('Are you sure you want to delete # {0}?', $relatedSymptom->related_symptoms_id)]) ?>
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
