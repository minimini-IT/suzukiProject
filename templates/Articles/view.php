<?php
$this->assign("title", "記事");
?>
<div class="uk-grid">

    <div class="uk-width-3-4@m uk-width-1-1 uk-container uk-position-relative uk-padding-remove-right uk-margin-medium-bottom">

        <div class="patient-view-top-color div-align-left">
            <p class="uk-margin-remove-bottom uk-text-center uk-padding-small uk-text-lead"><?= h($article->title) ?></>
        </div>

        <div class="uk-margin-medium-bottom div-align-left">

            <div class="uk-grid">
                <div class="uk-width-1-2 uk-text-left">
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

                <div class="uk-width-1-2 uk-text-right">
                    <p class="uk-margin-remove">作成日：<span class="uk-text-meta"><?= h($article->created->format("Y年n月")) ?></span></p>
                    <p class="uk-margin-remove">最終更新日：<span class="uk-text-meta"><?= h($article->modified->format("Y年n月")) ?></span></p>
                </div>

            </div>
        </div>
        <div class="text">
            <div class="uk-card uk-card-default uk-card-body uk-background-muted">
                <section>
                    <?= $article->contents ?>
                </section>
            </div>
        </div>
    </div>

    <div class="uk-width-1-4@m uk-width-1-1 uk-padding-remove uk-text-center">
        <div class="medium-padding">
            <div class="uk-margin-medium-bottom">
                <p class="uk-text-lead uk-text-center@m uk-text-left">関連するインタビュー</p>
<?php $this->start("sidebar") ?>
    <p class="uk-text-left">関連するインタビュー</p>
<?php $this->end(); ?>
                <div class="medium-padding uk-margin-large-bottom">
                    <?php foreach($related_patients as $related): ?>
                        <?php $relatedList = $related->AttributeList ?>
<?php $this->append("sidebar") ?>
    <p class="padding-left"><?= $this->Html->link(__($related->pen_name." さん"), ['controller' => 'patients', 'action' => 'view', $related->patients_id]) ?></p>
<?php $this->end(); ?>
                        <div class="uk-card uk-card-default uk-card-hover uk-margin-right uk-margin-left">
                            <p class="uk-text-center"><?= $this->Html->link(__($related->pen_name." さん"), ['controller' => 'patients', 'action' => 'view', $related->patients_id]) ?></p>
                            <p class="uk-margin-small">
                                <?php foreach($relatedList["sickness"] as $sickness): ?>
                                    <span class="uk-text-meta"><?= $sickness ?></span>
                                <?php endforeach ?>
                            </p>
                            <p class="uk-margin-small">
                                <?php foreach($relatedList["symptoms"] as $symptoms): ?>
                                    <span class="uk-text-meta"><?= $symptoms ?></span>
                                <?php endforeach ?>
                            </p>
                            <p class="uk-margin-small">
                                <?php foreach($relatedList["locations"] as $locations): ?>
                                    <span class="uk-text-meta"><?= $locations ?></span>
                                <?php endforeach ?>
                            </p>
                            <p><span class="uk-label"><?= $related->patient_sex->patient_sex ?></span></p>
                        </div>
                    <?php endforeach ?>

                </div>
            </div>
            <div class="uk-margin-medium-bottom">
                <p class="uk-text-lead uk-text-center@m uk-text-left">関連する記事</p>
<?php $this->append("sidebar") ?>
    <p class="uk-text-left">関連する記事</p>
<?php $this->end() ?>
                <div class="medium-padding">

                    <?php foreach($related_articles as $related): ?>
                        <?php $relatedList = $related->AttributeList ?>
<?php $this->append("sidebar") ?>
    <p class="padding-left"><?= $this->Html->link(__($related->title), ['controller' => 'articles', 'action' => 'view', $related->articles_id]) ?></p>
<?php $this->end() ?>
                        <div class="uk-card uk-card-default uk-card-hover uk-margin-right uk-margin-left">
                            <p class="uk-text-center"><?= $this->Html->link(__($related->title), ['controller' => 'articles', 'action' => 'view', $related->articles_id]) ?></p>
                            <p class="uk-margin-small">
                                <?php foreach($relatedList["sickness"] as $sickness): ?>
                                    <span class="uk-text-meta"><?= $sickness ?></span>
                                <?php endforeach ?>
                            </p>
                            <p class="uk-margin-small">
                                <?php foreach($relatedList["symptoms"] as $symptoms): ?>
                                    <span class="uk-text-meta"><?= $symptoms ?></span>
                                <?php endforeach ?>
                            </p>
                            <p class="uk-margin-small">
                                <?php foreach($relatedList["locations"] as $locations): ?>
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
