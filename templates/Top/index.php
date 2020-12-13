<?php
$this->assign("title", "病気の人の交流サイト");
?>
<div class="uk-grid">
    <div class="uk-width-3-4@m uk-width-1-1 uk-container uk-position-relative uk-padding-remove-right uk-margin-medium-bottom">
        <div class="uk-width-1-1 uk-margin-top medium-padding" id="explanation">
            <h3>当サイトについて</h3>
            <p>お腹が痛いといっても考えられる病気は多種多様に存在します。</p>
            <p>また、医師に診察を受けたところで腹痛の薬を処方されて終わってしまうことが非常に多いです。</p>
            <p>薬が効かず、いったんは自然に治ったり、またはずっとその症状が続いたり、、、。</p>
            <p>当サイトはそんななんとなく腑に落ちない日々を過ごしている方や、不安な日々を過ごされている方々が、症状から考えられる病気を調べて、正しい検査を受けることに少しでも協力できるよう、作成されました。</p>
            <p>また、疾患を持たれている方のご協力のもと、インタビュー結果を掲載して、その病気になるまでの経緯や真贋後の生活用の情報を記録し、少しでも病気に悩む方や、病気かもと不安な日々を過ごされている方々の負担を取り除ければ幸いです。</p>
            <p>皆様が快適な毎日を過ごせますよう、ぜひご活用ください。</p>
        </div>

    </div>

    <div class="uk-width-1-4@m uk-width-1-1 uk-margin-auto-right">
        <div class="medium-padding">
            <div class="uk-margin-medium-bottom">
                <p class="uk-text-lead uk-text-center@m uk-text-left">最近のインタビュー</p>
                <div class="medium-padding">
                    <ul class="uk-list">
                        <?php foreach($patients as $patient): ?>
                            <li class="uk-text-center@m uk-text-left"><?= $this->Html->link(__($patient->pen_name." さん"), ['controller' => 'patients', 'action' => 'view', $patient->patients_id]) ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
            <div class="uk-margin-medium-bottom">
                <p class="uk-text-lead uk-text-center@m uk-text-left">関連する記事</p>
                <div class="medium-padding">
                    <p class="uk-text-normal uk-text-center@m uk-text-left">同じ病気、症状の記事</p>
                    <div class="medium-padding">
                        <ul class="uk-list">
                            <li class="uk-text-center@m uk-text-left"></li>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>




<div class="row">
    <div class="top index content column-responsive column-80" style="padding: 2rem;">
        <div style="margin-bottom: 5rem;">
            <?= $this->Html->link(__('*管理者用* 管理メニュー'), ['controller' => 'ManagementUsers', 'action' => 'top']) ?>
        </div>
    </div>


</div>



