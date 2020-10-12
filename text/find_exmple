<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SalonInformation[]|\Cake\Collection\CollectionInterface $salonInformations
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Salon Information'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Municipalities'), ['controller' => 'Municipalities', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Municipality'), ['controller' => 'Municipalities', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="salonInformations index large-9 medium-8 columns content">
    <h3><?= __('Salon Informations') ?></h3>
<div>

<!--　検索　-->
  <h5>検索</h5>
<?= $this->Form->create(null, ["url" => ["action" => "index"]]) ?>
<?php foreach($municipalities as $municipalitie): ?>
    <?= $this->Form->control($municipalitie->name, [
        "type" => "checkbox", 
        "value" => $municipalitie->municipalities_id, 
        "hiddenField" => false
    ]) ?>
<?php endforeach ?>
<?= $this->Form->button("検索") ?>
<?= $this->Form->end() ?>
<!------------>


</div>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('salon_informations_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('municipalities_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tel') ?></th>
                <th scope="col"><?= $this->Paginator->sort('business_hour') ?></th>
                <th scope="col"><?= $this->Paginator->sort('street_address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('regular_holiday') ?></th>
                <th scope="col"><?= $this->Paginator->sort('number_of_staff') ?></th>
                <th scope="col"><?= $this->Paginator->sort('number_of_seat') ?></th>
                <th scope="col"><?= $this->Paginator->sort('number_of_parking') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($salonInformations as $salonInformation): ?>
            <tr>
                <td><?= $this->Number->format($salonInformation->salon_informations_id) ?></td>
                <td><?= h($salonInformation->name) ?></td>
                <td><?= $salonInformation->has('municipality') ? $this->Html->link($salonInformation->municipality->name, ['controller' => 'Municipalities', 'action' => 'view', $salonInformation->municipality->municipalities_id]) : '' ?></td>
                <td><?= h($salonInformation->tel) ?></td>
                <td><?= h($salonInformation->business_hour) ?></td>
                <td><?= h($salonInformation->street_address) ?></td>
                <td><?= h($salonInformation->regular_holiday) ?></td>
                <td><?= $this->Number->format($salonInformation->number_of_staff) ?></td>
                <td><?= $this->Number->format($salonInformation->number_of_seat) ?></td>
                <td><?= $this->Number->format($salonInformation->number_of_parking) ?></td>
                <td><?= h($salonInformation->created) ?></td>
                <td><?= h($salonInformation->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $salonInformation->salon_informations_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $salonInformation->salon_informations_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $salonInformation->salon_informations_id], ['confirm' => __('Are you sure you want to delete # {0}?', $salonInformation->salon_informations_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
