<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\InterviewSymptom $interviewSymptom
 */
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
    //debug($skip_sicknesses_id_array) 
?>
                <?php
                    //echo $this->Form->control('patients_id', ['options' => $patients]);
                    foreach($symptoms_number as $number)
                    {
                        if(!in_array($number->sicknesses_id, $skip_sicknesses_id_array))
                        {
debug($number); 
                            echo $this->Form->control('patients_id', ['value' => $patients_id, "type" => "hidden"]);
                            echo $this->Form->control('diseaseds_id', ['value' => $number->diseaseds_id, "type" => "hidden"]);
                            echo "<p style='font-size: 25px;'>".$number->sickness->sickness_name."</p>";
                            //echo $this->Form->select('symptoms_id_'.$number->sicknesses_id, ["label" => "症状", 'multiple' => "checkbox", "option" => $symptoms, "id" => "symptoms-".$number->sicknesses_id."-".$number->diseaseds_id]);
                            //echo $this->Form->control('symptoms_id', ["label" => "症状", 'multiple' => "checkbox", "option" => $symptoms]);
                            echo $this->Form->control('symptoms_id_'.$number->sicknesses_id, ["label" => "症状", 'multiple' => "checkbox", "options" => $symptoms, "id" => "symptoms-".$number->sicknesses_id."-".$number->diseaseds_id]);
                        //echo $this->Form->control('symptoms_id', ["label" => "症状", 'multiple' => "checkbox", "option" => $symptoms, "id" => "symptoms-".$number->sicknesses_id."-".$number->diseaseds_id]);
                        }
                    }
                ?>
            </fieldset>
            <?= $this->Form->button(__('送信')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
