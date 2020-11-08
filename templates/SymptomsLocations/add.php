<?php
$this->assign("title", "部位の入力");
$this->Html->script("addCheckbox.js", ["block" => true]);
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <?= $this->Html->link(__('戻る'), ["controller" => "patients", 'action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="symptomsLocations form content">
            <?= $this->Form->create($symptomsLocation) ?>
            <fieldset>
                <legend><?= __('各症状に対する部位を入力してください') ?></legend>
                <?php
                    foreach($interviewSymptoms as $is)
                    {
                        echo $this->Form->control('patients_id', [
                            "type" => "hidden", 
                            'value' => $is->patients_id,
                        ]);
                        //debug($is);
                        echo "<p>".$is->sickness->sickness_name."</p>";
                        foreach($is->interview_symptoms as $i)
                        {
                            //debug($i);
                            if(empty($i->symptoms_locations))
                            {
                                echo "<p>".$i->symptom->symptoms."</p>";
                                echo $this->Form->control('interview_symptoms_id_'.$i->interview_symptoms_id, [
                                    "type" => "hidden", 
                                    'value' => $i->interview_symptoms_id,
                                ]);
                                echo $this->Form->control('locations_id_'.$i->interview_symptoms_id, [
                                    "label" => "部位", 
                                    'options' => $locations, 
                                    "multiple" => "checkbox",
                                    "required" => true,
                                ]);
                            }
                        }
                        echo "</br>";
                    }
                ?>
            </fieldset>
            <?= $this->Form->button(__('送信')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
