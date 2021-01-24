<?php
$this->assign("title", "掲示板作成");
?>
<div class="uk-grid grid-margin-remove">
    <div class="uk-width-3-4@s medium-margin uk-width-1-1 grid-child">
        <div class="uk-card uk-card-default">
            <?= $this->Form->create($bulletinBoard) ?>
                <div class="grid-next-margin uk-padding uk-padding-remove-bottom">
                    <?php
                        $this->Form->setTemplates(["inputContainer" => "<div class='input {{type}}{{required}} uk-margin-medium-bottom'>{{content}}</div>"]);
                        echo $this->Form->control('title', ["label" => "タイトル：", "class" => "uk-input uk-form-width-medium"]);
                        echo $this->Form->control('author', ["label" => "名前：", "class" => "uk-input uk-form-width-medium"]);
                        $this->Form->setTemplates(["inputContainer" => "<div class='input {{type}}{{required}} uk-margin-medium-bottom'>{{content}}</div>"]);
                        echo "<label>コメント</label>";
                        echo $this->Form->control('contents', ["label" => false,  "class" => "input-textarea", "required" => true]);
                    ?>
                </div>
                <div class="uk-padding uk-padding-remove-top uk-text-right">
                    <?= $this->Form->button(__('作成'), ["class" => "uk-button uk-button-default"]) ?>
                </div>
            <?= $this->Form->end() ?>
        </div>
    </div>

    <div class="uk-width-1-4 uk-padding-remove uk-text-center small-remove">
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
