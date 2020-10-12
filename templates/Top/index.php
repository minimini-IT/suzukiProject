<?php
$this->assign("title", "病気の人の交流サイト");
?>
<div class="top index content">
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
        <h6>検索</h6>
        <?= $this->Form->create(null, [
            "type" => "get",
            "url" => [
                "controller" => "patients",
                "action" => "search"
            ]
        ]) ?> 
            <?= $this->Form->control("sicknesses_id", ["label" => "病名で検索", "options" => $sicknesses, "hiddenField" => false, "empty" => true]) ?>
            <?= $this->Form->control("comment", ["label" => "症状で検索", "class" => "form-control"]) ?>
            <?= $this->Form->button('検索', ["disabled" => true]) ?>
        <?= $this->Form->end() ?>
    </div>
    <div style="margin-bottom: 5rem;">
        <h4><?= $this->Html->link(__('掲示板'), ['controller' => 'bulletin_boards', 'action' => 'index']) ?></h4>
    </div>
</div>



