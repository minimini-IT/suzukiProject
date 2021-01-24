<?php
$this->assign("title", "編集する記事");
?>
<?php $this->start("sidebar") ?>
    <p>ユーザ管理</p>
    <ul class="uk-list">
        <li><?= $this->Html->link(__('作成'), ['controller' => 'management_users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('編集'), ['controller' => 'management_users', 'action' => 'index']) ?></li>
    </ul>
    <p>インタビュー管理</p>
    <ul class="uk-list">
        <li><?= $this->Html->link(__('作成'), ['controller' => 'patients', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('編集'), ['controller' => 'patients', 'action' => 'select']) ?></li>
    </ul>
    <p>記事管理</p>
    <ul class="uk-list">
        <li><?= $this->Html->link(__('作成'), ['controller' => 'articles', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('編集'), ['controller' => 'articles', 'action' => 'select']) ?></li>
    </ul>
<?php $this->end(); ?>
<div class="uk-grid">
    <div class="main uk-width-3-4">

        <div class="uk-first-column uk-card uk-card-default uk-padding-small uk-margin-bottom">
            <?= $this->Form->create(null, [
                "type" => "get",
                "url" => [
                    "controller" => "articles",
                    "action" => "select_search"
                ]
            ]) ?> 
                <?php $this->Form->setTemplates(["inputContainer" => "<div class='input {{type}}{{required}} uk-inline'>{{content}}</div>", ]); ?>
                <?= $this->Form->control("title", ["label" => "タイトル ：", "class" => "uk-input uk-form-width-medium"]) ?>
                <?= $this->Form->button('検索', ["class" => "uk-button uk-button-primary uk-position-small uk-position-center-right"]) ?>
            <?= $this->Form->end() ?>
        </div>
        <div class="uk-text-center">

            <?php foreach ($articles as $article): ?>
                <div class="uk-card uk-card-default uk-margin-bottom">
                    <div class="padding-top">
                        <p class="uk-text-lead"><?= $this->Html->link(h($article->title), ['action' => 'edit', $article->articles_id], ['class' => 'button float-right']) ?></p>
                    </div>
                    <?= $this->Text->truncate($article->contents, 50, ["ellipsis" => "...", "exact" => true, "html" => true]) ?>
                    <div class="uk-grid uk-child-width-1-2 grid-margin-remove ">
                        <div class="uk-text-left">
                            <p class="uk-margin-remove">
                                <?php foreach($article->related_sicknesses as $sickness): ?>
                                    <span class="uk-text-meta"><?= $sickness->sickness->sickness_name ?></span>
                                <?php endforeach ?>
                            </p>
                            <p class="uk-margin-remove">
                                <?php foreach($article->related_symptoms as $symptoms): ?>
                                    <span class="uk-text-meta"><?= $symptoms->symptom->symptoms ?></span>
                                <?php endforeach ?>
                            </p>
                            <p class="uk-margin-remove">
                                <?php foreach($article->related_locations as $location): ?>
                                    <span class="uk-text-meta"><?= $location->location->location ?></span>
                                <?php endforeach ?>
                            </p>
                        </div>

                        <div class="uk-text-right padding-right uk-padding-remove-left">
                            <p class="uk-margin-remove">作成日：<span class="uk-text-meta"><?= h($article->created->format("Y年n月")) ?></span></p>
                            <p class="uk-margin-remove">最終更新日：<span class="uk-text-meta"><?= h($article->modified->format("Y年n月")) ?></span></p>
                            
                        </div>
                    </div>
                    <div class="uk-text-right uk-margin-small-top">
                        <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $article->articles_id], ['confirm' => __('{0} を削除しますか？', $article->title), "class" => "uk-button uk-button-danger"]) ?>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
        <div class="paginator">
            <ul class="uk-pagination" uk-margin>
                <?= $this->Paginator->first(__('<< ')) ?>
                <?= $this->Paginator->numbers(["first" => "First page", "last" => 1]) ?>
                <?= $this->Paginator->last(__(' >>')) ?>
            </ul>
        </div>
    </div>
    <div class="sub uk-width-1-4 uk-padding-remove uk-text-center">
        <ul class="uk-list">
            <li><?= $this->Html->link(__('LOGOUT'), ["controller" => "management_users", 'action' => 'logout'], ['class' => 'uk-button uk-button-primary uk-margin-bottom management-sub-button uk-padding-remove']) ?></li>
            <li class=><?= $this->Html->link(__('戻る'), ["controller" => "management_users", 'action' => 'top'], ['class' => 'uk-button uk-button-primary uk-margin-bottom management-sub-button uk-padding-remove']) ?></li>
        </ul>
    </div>
</div>


