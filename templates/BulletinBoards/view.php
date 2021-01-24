<?php
$this->assign("title", "掲示板：".h($bulletinBoard->title));
?>
<div class="uk-grid">
    <div class="uk-width-3-4@m uk-width-1-1 uk-container uk-position-relative uk-padding-remove-right uk-margin-medium-bottom">
    <p><span class="uk-text-lead"><?= h($bulletinBoard->title) ?></span><?= "　".h($bulletinBoard->author)."：".h($bulletinBoard->created) ?></p>
        <div class="uk-card uk-card-default uk-padding-small uk-margin-bottom auto-paragraph">
            <?= $this->Text->autoParagraph(h($bulletinBoard->contents)); ?>
        </div>
        <div>
<?php
if(is_null($page_number))
{
    $i = 1;
}
else
{
    $i = (int)$page_number * 10;
}
?>
            <?php
//foreach ($bulletinBoard->bulletin_board_comments as $comment): 
             ?>
            <?php foreach ($bulletinBoardComments as $comment): ?>
                <div class="comment" style="margin-bottom: 3rem;">
                    <p><?= $i."：".h($comment->comment_author."　".$comment->created) ?></p>
                    <p class="padding-left"><?= __(h($comment->comment_contents)) ?></p>
                </div>
            <?php $i += 1; ?>
            <?php endforeach; ?>

            <div class="paginator">
                <ul class="uk-pagination" uk-margin>
                    <?= $this->Paginator->first(__('<< ')) ?>
                    <?= $this->Paginator->numbers(["first" => "First page", "last" => 1]) ?>
                    <?= $this->Paginator->last(__(' >>')) ?>
                </ul>
            </div>

            <div class="uk-card uk-card-default uk-padding">
                <?= $this->Form->create($bulletinBoardComment, [
                    "type" => "post",
                    "url" => [
                        "controller" => "bulletin_board_comments",
                        "action" => "add"
                    ]
                ]) ?> 
                    <?php
                        echo $this->Form->control('bulletin_boards_id', ["type" => "hidden", "value" => $bulletinBoard->bulletin_boards_id]);
                        $this->Form->setTemplates(["inputContainer" => "<div class='input {{type}}{{required}} uk-margin-medium-bottom'>{{content}}</div>"]);
                        echo $this->Form->control('comment_author', ["label" => "名前：", "class" => "uk-input uk-form-width-medium", "required" => true]);
                        $this->Form->setTemplates(["inputContainer" => "<div class='input {{type}}{{required}} uk-margin-medium-bottom'>{{content}}</div>"]);
                        echo "<label>コメント</label>";
                        echo $this->Form->control('comment_contents', ["label" => false,  "class" => "input-textarea", "required" => true]);
                    ?>
                    <div class="uk-text-right">
                        <?= $this->Form->button(__('コメントする'), ["class" => "uk-button uk-button-default"]) ?>
                    </div>
                <?= $this->Form->end() ?>
            </div>
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
