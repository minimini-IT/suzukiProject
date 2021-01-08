<?php
$this->assign("title", "記事");
$this->Html->script("TopCheckbox.js", ["block" => true]);
?>
<div class="uk-grid">
    <div class="uk-width-3-4@m uk-width-1-1">
        <div class="uk-padding-remove uk-first-column">
            <h3 class="pro-image main-link" id="search_toggle"><?= __('検索') ?></h3>
            <div class="uk-padding-remove uk-width-1-1 uk-margin-medium-top uk-margin-medium-bottom" id="search">
                <div class="uk-padding-remove">
                    <div class="uk-text-center uk-text-left@m">
                        <?= $this->Form->create(null, [
                            "type" => "get",
                            "url" => [
                                "controller" => "articles",
                                "action" => "search"
                            ]
                        ]) ?> 
                            <?php $this->Form->setTemplates(["checkboxWrapper" => "<div class='checkbox uk-margin'>{{label}}</div>" ]); ?>
                            <div class="uk-child-width-1-3" uk-grid>

                                <div>
                                    <?= $this->Form->control("sicknesses_id", [
                                        "label" => "関連する病名", 
                                        "options" => $sicknesses, 
                                        "hiddenField" => false, 
                                        "empty" => true, 
                                        "multiple" => "checkbox", 
                                        "class" => "uk-checkbox"
                                    ]) ?>
                                </div>

                                <div>
                                    <?= $this->Form->control("symptoms_id", [
                                        "label" => "関連する症状", 
                                        "options" => $symptoms, 
                                        "hiddenField" => false, 
                                        "empty" => true, 
                                        "multiple" => "checkbox", 
                                        "class" => "uk-checkbox"
                                    ]) ?>
                                </div>

                                <div>
                                    <?= $this->Form->control("locations_id", [
                                        "label" => "関連する部位", 
                                        "options" => $locations, 
                                        "hiddenField" => false, 
                                        "empty" => true, 
                                        "multiple" => "checkbox", 
                                        "class" => "uk-checkbox"
                                    ]) ?>
                                </div>
                            </div>
                            <div class="uk-padding uk-padding-remove-top uk-text-right">
                                <?= $this->Form->button('検索', ["class" => "uk-button uk-button-primary"]) ?>
                            </div>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="uk-text-center">
            <?php foreach ($articles as $article): ?>
                <div class="uk-card uk-card-default uk-margin-bottom uk-padding">
                    <h3><?= $this->Html->link(h($article->title), ['action' => 'view', $article->articles_id], ['class' => 'button float-right']) ?></h3>
                    <p><?= $this->Text->truncate($article->contents, 30, ["ellipsis" => "...", "exact" => true, "html" => true]) ?></p>
                    <div class="uk-grid uk-child-width-1-2">
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

                        <div class="uk-text-right">
                            <p class="uk-margin-remove">作成日：<span class="uk-text-meta"><?= h($article->created->format("Y年n月")) ?></span></p>
                            <p class="uk-margin-remove">最終更新日：<span class="uk-text-meta"><?= h($article->modified->format("Y年n月")) ?></span></p>
                            
                        </div>
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
    <div class="uk-width-1-4@m uk-width-1-1 uk-margin-auto-right uk-padding-remove uk-text-center">
        <div class="medium-padding">
            <div class="uk-margin-medium-bottom">
                <p class="uk-text-lead uk-text-center@m uk-text-left">最近のインタビュー</p>
                <div class="medium-padding uk-margin-large-bottom">
                    <?php foreach($recently_patients as $recent_patient): ?>
                        <?php $recent_patient_list = $recent_patient->AttributeList ?>
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
                <div class="medium-padding uk-margin-large-bottom">
                    <?php foreach($recently_articles as $recent_article): ?>
                        <?php $recent_article_list = $recent_article->AttributeList ?>
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
