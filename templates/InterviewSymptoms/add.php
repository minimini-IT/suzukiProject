<?php
$this->assign("title", "症状の登録");
$this->Html->script("addCheckbox.js", ["block" => true]);
?>

<div class="row">
    <div class="column-responsive">
        <div class="interviewSymptoms form content">
            <?= $this->Html->link(__('戻る'), ["controller" => "patients", 'action' => 'index']) ?>
            <?= $this->Form->create(null, [
                "type" => "post",
                "url" => [
                    "controller" => "InterviewSymptoms",
                    "action" => "add"
                ]
            ]) ?>
            <fieldset>
                <h3><?= __('症状の部位を選択してください') ?></h3>
                <?php
                    foreach($sick as $number)
                    {
                        //debug($number);
                        echo $this->Form->control('patients_id', ['value' => $patients_id, "type" => "hidden"]);
                        echo $this->Form->control('diseaseds_id_'.$number->diseaseds_id, [
                            'value' => $number->diseaseds_id, 
                            "type" => "hidden", 
                            "id" => "diseaseds-".$number->diseaseds_id
                        ]);
                        echo "<p style='font-size: 25px;'>".$number->sickness->sickness_name."</p>";
                        echo $this->Form->control('symptoms_id_'.$number->sicknesses_id, [
                            "label" => "症状", 
                            'multiple' => "checkbox", 
                            "options" => $symptoms, 
                            "id" => "symptoms-".$number->sicknesses_id."-".$number->diseaseds_id
                        ]);
                    }
                ?>
            </fieldset>
            <?= $this->Form->button(__('送信')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
