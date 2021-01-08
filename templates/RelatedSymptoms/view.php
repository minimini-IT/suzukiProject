<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RelatedSymptom $relatedSymptom
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Related Symptom'), ['action' => 'edit', $relatedSymptom->related_symptoms_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Related Symptom'), ['action' => 'delete', $relatedSymptom->related_symptoms_id], ['confirm' => __('Are you sure you want to delete # {0}?', $relatedSymptom->related_symptoms_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Related Symptoms'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Related Symptom'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="relatedSymptoms view content">
            <h3><?= h($relatedSymptom->related_symptoms_id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Article') ?></th>
                    <td><?= $relatedSymptom->has('article') ? $this->Html->link($relatedSymptom->article->title, ['controller' => 'Articles', 'action' => 'view', $relatedSymptom->article->articles_id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Symptom') ?></th>
                    <td><?= $relatedSymptom->has('symptom') ? $this->Html->link($relatedSymptom->symptom->symptoms, ['controller' => 'Symptoms', 'action' => 'view', $relatedSymptom->symptom->symptoms_id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Related Symptoms Id') ?></th>
                    <td><?= $this->Number->format($relatedSymptom->related_symptoms_id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
