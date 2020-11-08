<?php
$this->assign("title", "病気の人の交流サイト");
$this->Html->script("TopCheckbox.js", ["block" => true]);

?>
<div class="row">

    <div class="top index content column-responsive column-80" style="padding: 2rem;">
        <div style="margin-bottom: 5rem;">
            <h4>サイトの説明</h4>
            <p>サイトの説明</p>
        </div>
        <div style="margin-bottom: 5rem;">
            <h4>サイト作成の経緯</h4>
            <p>サイト作成の経緯の説明</p>
        </div>
        <div style="margin-bottom: 5rem;">
            <h4>闘病者へのインタビュー</h4>
            <?= $this->Html->link(__('インタビュー一覧'), ['controller' => 'patients', 'action' => 'index']) ?>
        </div>
        <div style="margin-bottom: 5rem;">

            <?= $this->Form->create(null, [
                "type" => "get",
                "url" => [
                    "controller" => "patients",
                    "action" => "search"
                ]
            ]) ?> 
                <?= $this->Form->control("sicknesses_id", ["label" => "病名で検索", "options" => $sicknesses, "hiddenField" => false, "empty" => true, "multiple" => "checkbox"]) ?>
                <?= $this->Form->button('検索') ?>
            <?= $this->Form->end() ?>

            <?= $this->Form->create(null, [
                "type" => "get",
                "url" => [
                    "controller" => "patients",
                    "action" => "search"
                ]
            ]) ?> 
                <div id="symptoms_checkbox">
                    <?= $this->Form->control("symptoms_id", ["label" => "症状で検索", "options" => $symptoms, "hiddenField" => false, "empty" => true, "multiple" => "checkbox"]) ?>
                </div>

                <?= $this->Form->control("locations_id", ["label" => "部位で検索", "options" => $locations, "hiddenField" => false, "empty" => true, "multiple" => "checkbox", "class" => "locations_checkbox", "disabled" => true]) ?>
                <?= $this->Form->button('検索') ?>
            <?= $this->Form->end() ?>
        </div>
        <div style="margin-bottom: 5rem;">
            <h4><?= $this->Html->link(__('掲示板'), ['controller' => 'bulletin_boards', 'action' => 'index']) ?></h4>
        </div>
    </div>

    <aside class="column">
        <div class="side-nav">
            <?= $this->Html->link(__('*管理者用* 管理メニュー'), ['controller' => 'ManagementUsers', 'action' => 'top']) ?>
            <h3>最近の記事</h3>
            <?php foreach($patients as $patient): ?>
                <p><?= $this->Html->link(__($patient->pen_name), ['controller' => 'patients', 'action' => 'view', $patient->patients_id]) ?></p>
                
            <?php endforeach ?>
        </div>
    </aside>

</div>



