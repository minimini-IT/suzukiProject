<?php
$this->assign("title", "管理画面");
?>
<div class="small-subbar">
    <nav class="uk-navbar-container" uk-navbar>
        <div class="uk-navbar-right">
            <ul class="uk-navbar-nav">
                <li class="small-subbar-li">
                    <button class="uk-button uk-button-primary management-sub-button uk-padding-remove small-subbar-height" type="button">メニュー</button>
                    <div uk-dropdown>
                        <ul class="uk-nav uk-dropdown-nav">
                            <li class="uk-active">ユーザ管理</li>
                            <li><?= $this->Html->link(__('作成'), ['controller' => 'management_users', 'action' => 'add']) ?></li>
                            <li><?= $this->Html->link(__('編集'), ['controller' => 'management_users', 'action' => 'index']) ?></li>
                            <li class="uk-nav-divider"></li>
                            <li class="uk-active">インタビュー管理</li>
                            <li><?= $this->Html->link(__('作成'), ['controller' => 'patients', 'action' => 'add']) ?></li>
                            <li><?= $this->Html->link(__('編集'), ['controller' => 'patients', 'action' => 'select']) ?></li>
                            <li class="uk-nav-divider"></li>
                            <li class="uk-active">記事管理</li>
                            <li><?= $this->Html->link(__('作成'), ['controller' => 'articles', 'action' => 'add']) ?></li>
                            <li><?= $this->Html->link(__('編集'), ['controller' => 'articles', 'action' => 'select']) ?></li>
                        </ul>
                    </div>
                </li>
                <li class="small-subbar-li"><?= $this->Html->link(__('LOGOUT'), ['action' => 'logout'], ['class' => 'uk-button uk-button-primary management-sub-button uk-padding-remove small-subbar-height']) ?></li>
            </ul>
        </div>
    </nav>
</div>

<div class="uk-grid grid-margin-remove">


    <div class="uk-width-3-4@s uk-width-1-1 grid-child">
        <div class="uk-card uk-card-default uk-padding">
            <div class="padding-left">
                <h3>新着情報</h3>
                <div class="padding-left">
                    <h4>インタビュー</h4>
                    <div class="padding-left">
                        <?php foreach($patients as $patient): ?>
                            <div>
                                <?php if($patient->DateComparison): ?>
                                    <p><?= $patient->created->format("Y-m-d") ?> <span><?= $this->Html->link($patient->pen_name, ["controller" => "patients", 'action' => 'edit', $patient->patients_id]) ?></span> を作成しました</p>
                                <?php else: ?>
                                    <p><?= $patient->modified->format("Y-m-d") ?> <span><?= $this->Html->link($patient->pen_name, ["controller" => "patients", 'action' => 'edit', $patient->patients_id]) ?></span> を更新しました</p>
                                <?php endif ?>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
                <div class="padding-left">
                    <h4>記事</h4>
                    <div class="padding-left">
                        <?php foreach($articles as $article): ?>
                            <div>
                                <?php if($article->DateComparison): ?>
                                    <p><?= $article->created->format("Y-m-d") ?> <span><?= $this->Html->link($article->title, ["controller" => "articles", 'action' => 'edit', $article->articles_id]) ?></span> を作成しました</p>
                                <?php else: ?>
                                    <p><?= $article->modified->format("Y-m-d") ?> <span><?= $this->Html->link($article->title, ["controller" => "articles", 'action' => 'edit', $article->articles_id]) ?></span> を更新しました</p>
                                <?php endif ?>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="uk-width-1-4 uk-padding-remove uk-text-center small-remove">
        <ul class="uk-list">
            <li><?= $this->Html->link(__('LOGOUT'), ['action' => 'logout'], ['class' => 'uk-button uk-button-primary uk-margin-bottom management-sub-button uk-padding-remove']) ?></li>
        </ul>
       <div class="uk-margin uk-margin-right uk-margin-left uk-padding-small uk-background-muted uk-first-column">
           <p class="uk-text-center">ユーザ管理</p>
           <ul class="uk-list uk-list-square">
                <li><?= $this->Html->link(__('作成'), ['controller' => 'management_users', 'action' => 'add']) ?></li>
                <li><?= $this->Html->link(__('編集'), ['controller' => 'management_users', 'action' => 'index']) ?></li>
           </ul>
       </div>

       <div class="uk-margin uk-margin-right uk-margin-left uk-padding-small uk-background-default">
           <p class="uk-text-center">インタビュー</p>
           <ul class="uk-list uk-list-square">
               <li><?= $this->Html->link(__('作成'), ['controller' => 'patients', 'action' => 'add']) ?></li>
               <li><?= $this->Html->link(__('編集'), ['controller' => 'patients', 'action' => 'select']) ?></li>
           </ul>
       </div>

       <div class="uk-margin uk-margin-right uk-margin-left uk-margin-bottom uk-padding-small uk-background-muted">
           <p class="uk-text-center">記事</p>
           <ul class="uk-list uk-list-square">
               <li><?= $this->Html->link(__('作成'), ['controller' => 'articles', 'action' => 'add']) ?></li>
               <li><?= $this->Html->link(__('編集'), ['controller' => 'articles', 'action' => 'select']) ?></li>
           </ul>
       </div>
    </div>
</div>

