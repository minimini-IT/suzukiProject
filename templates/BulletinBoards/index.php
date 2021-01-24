<?php
$this->assign("title", "掲示板");
?>
<div class="uk-grid">
    <div class="uk-width-3-4@m uk-width-1-1 uk-container uk-position-relative uk-padding-remove-right uk-margin-medium-bottom">
        <div class="uk-padding-small uk-padding-remove-left">
            <?= $this->Html->link(__("スレッド作成"), ["controller" => "bulletin_boards", 'action' => 'add']) ?>
        </div>
        <?php foreach ($bulletinBoards as $bulletinBoard): ?>
            <div class="uk-card uk-card-default uk-padding uk-text-center uk-margin-bottom">
                <?= $this->Html->link(h($bulletinBoard->title), ["controller" => "bulletin_boards", 'action' => 'view', $bulletinBoard->bulletin_boards_id], ["class" => "uk-text-lead"]) ?>
                <div class="uk-text-left">
                    <p class="uk-text-meta uk-margin-remove">作成者：<?= h($bulletinBoard->author) ?></p>
                    <p class="uk-text-meta uk-margin-remove">最終更新時間：<?= empty($bulletinBoard->bulletin_board_comments) ? $bulletinBoard->modified : $bulletinBoard->CommentModified ?></p>
                    <p class="uk-text-meta uk-margin-remove">コメント数：<?= empty($bulletinBoard->bulletin_board_comments) ? 0 : count($bulletinBoard->bulletin_board_comments) ?></p>
                </div>
            </div>
        <?php endforeach; ?>


        <div class="paginator">
            <ul class="uk-pagination" uk-margin>
                <?= $this->Paginator->first(__('<< ')) ?>
                <?= $this->Paginator->numbers(["first" => "First page", "last" => 1]) ?>
                <?= $this->Paginator->last(__(' >>')) ?>
            </ul>
        </div>
    </div>

    <div class="uk-width-1-4@m uk-width-1-1 uk-margin-auto-right uk-padding-remove uk-text-center">
        <div class="medium-padding-right">
            <div class="uk-margin-medium-bottom uk-width-1-1">
                <p class="uk-text-lead uk-text-center@m uk-text-left">最近のインタビュー</p>
<?php $this->start("sidebar") ?>
    <p class="uk-text-left">最近のインタビュー</p>
<?php $this->end(); ?>
                <div class="uk-margin-large-bottom">
                    <?php foreach($recently_patients as $recent_patient): ?>
                        <?php $recent_patient_list = $recent_patient->AttributeList ?>
<?php $this->append("sidebar") ?>
    <p class="padding-left"><?= $this->Html->link(__($recent_patient->pen_name." さん"), ['controller' => 'patients', 'action' => 'view', $recent_patient->patients_id]) ?></p>
<?php $this->end(); ?>
                        <div class="uk-card uk-card-default uk-card-hover uk-margin-right uk-margin-left">
                            <p class="uk-text-center"><?= $this->Html->link(__($recent_patient->pen_name." さん"), ['controller' => 'patients', 'action' => 'view', $recent_patient->patients_id]) ?></p>
                            <p class="uk-margin-small">
                            <?php foreach($recent_patient_list["sickness"] as $sickness): ?>
                                <span class="uk-text-meta"><?= $sickness ?></span>
                            <?php endforeach ?>
                            </p>
                            <p class="uk-margin-small">
                            <?php foreach($recent_patient_list["symptoms"] as $symptoms): ?>
                                <span class="uk-text-meta"><?= $symptoms ?></span>
                            <?php endforeach ?>
                            </p>
                            <p class="uk-margin-small">
                            <?php foreach($recent_patient_list["locations"] as $locations): ?>
                                <span class="uk-text-meta"><?= $locations ?></span>
                            <?php endforeach ?>
                            </p>
                            <p><span class="uk-label"><?= $recent_patient->patient_sex->patient_sex ?></span></p>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="uk-margin-medium-bottom">
                <p class="uk-text-lead uk-text-center@m uk-text-left">最近の記事</p>
<?php $this->append("sidebar") ?>
    <p class="uk-text-left">最近の記事</p>
<?php $this->end() ?>
                <div class="uk-margin-large-bottom">
                    <?php foreach($recently_articles as $recent_article): ?>
                        <?php $recent_article_list = $recent_article->AttributeList ?>
<?php $this->append("sidebar") ?>
    <p class="padding-left"><?= $this->Html->link(__($recent_article->title), ['controller' => 'articles', 'action' => 'view', $recent_article->articles_id]) ?></p>
<?php $this->end() ?>
                        <div class="uk-card uk-card-default uk-card-hover uk-margin-right uk-margin-left">
                            <p class="uk-text-center"><?= $this->Html->link(__($recent_article->title), ['controller' => 'articles', 'action' => 'view', $recent_article->articles_id]) ?></p>
                            <p class="uk-margin-small">
                            <?php foreach($recent_article_list["sickness"] as $sickness): ?>
                                <span class="uk-text-meta"><?= $sickness ?></span>
                            <?php endforeach ?>
                            </p>
                            <p class="uk-margin-small">
                            <?php foreach($recent_article_list["symptoms"] as $symptoms): ?>
                                <span class="uk-text-meta"><?= $symptoms ?></span>
                            <?php endforeach ?>
                            </p>
                            <p class="uk-margin-small">
                            <?php foreach($recent_article_list["locations"] as $locations): ?>
                                <span class="uk-text-meta"><?= $locations ?></span>
                            <?php endforeach ?>
                            </p>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</div>
