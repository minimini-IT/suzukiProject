<?php
$this->assign("title", "インタビュー");

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Patient $patient
 */
?>
<div class="patients view content">
    <div class="row" style="margin-bottom: 3rem;">
        <div class="column">
            <h4 class="heading"><?= __('基本情報') ?></h4>
            <table>
                <tr>
                    <th>病名</th>
                    <th>性別</th>
                    <th>発病時の年齢</th>
                    <th>発病年月</th>
                    <th>完治年月</th>
                </tr>
                    <td>
                        <?php foreach ($patient->diseaseds as $diseased): ?>
                            <p><?= h($diseased->sickness->sickness_name) ?></p>
                        <?php endforeach ?>
                    </td>
                    <td><?= h($patient->patient_sex->patient_sex) ?></td>
                    <td><?= $this->Number->format($patient->age_of_onset) ?>歳</td>
                    <td><?= h($patient->year_of_onset->format("Y年m月")) ?></td>
                    <td><?= $patient->has("cured") ? h($patient->cured->format("Y年m月")) : "-----" ?></td>
                <tr>
                </tr>
            </table>
            <?php foreach ($patient->diseaseds as $diseased): ?>
                <h5 style="margin-top: 1rem;">病名</h5>
                <h4><?= h($diseased->sickness->sickness_name) ?></h4>

                <h5 style="margin-top: 1rem;">症状</h5>
                <?php foreach($diseased->interview_symptoms as $interview): ?>
                    <p><?= h($interview->symptom->symptoms) ?></p>
                    <p style="color: red;">　部位</p>
                    <?php foreach($interview->symptoms_locations as $location): ?>
                        <p>　<?= h($location->location->location) ?></p>
                    <?php endforeach ?>
                <?php endforeach ?>
            <?php endforeach ?>
        </div>
        <div class="column">
            <div style="text-align: right;">
                <p><?= $this->Html->link(__('TOPへ'), ['controller' => 'Top', 'action' => 'index']) ?></p>
                <p><?= $this->Html->link(__('戻る'), ['controller' => 'Patients', 'action' => 'index']) ?></p>
            </div>
        </div>
    </div>
    <div>
        <div>
            <h3><?= h($patient->pen_name) ?>さん</h3>
            <div class="text">
                <blockquote>
                    <?= $this->Text->autoParagraph(h($patient->comment)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
