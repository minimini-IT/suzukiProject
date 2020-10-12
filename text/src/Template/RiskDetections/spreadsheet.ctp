<nav class="large-3 medium-4 columns" id="actions-sidebar">
  <ul class="side-nav">
    <li class="heading"><?= __('Actions') ?></li>
    <li><?= $this->Html->link(__('一覧へ戻る'), ['controller' => 'RiskDetections', 'action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('TOPへ戻る'), ['controller' => 'Dairy', 'action' => 'index']) ?></li>
  </ul>
</nav>
<div class="cyberAttacks index large-9 medium-8 columns content">
    <?php $thisYear = date("Y", strtotime($year)); ?>
    <h3><?= "年度別インシデント件数" ?></h3>
<!--
    <p><?= $this->Html->link(__('<<_前年度'), ['?' => ["year" => date("Y", strtotime("-1 year", strtotime($year)))]]) ?></p>
    <p><?= $this->Html->link(__('次年度_>>'), ['?' => ["year" => date("Y", strtotime("+1 year", strtotime($year)))]]) ?></p>
-->
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th scope="col"><?= __("年度") ?></th>
            <th scope="col"><?= date("Y", strtotime("-4 year", strtotime($year))) ?></th>
            <th scope="col"><?= date("Y", strtotime("-3 year", strtotime($year))) ?></th>
            <th scope="col"><?= date("Y", strtotime("-2 year", strtotime($year))) ?></th>
            <th scope="col"><?= date("Y", strtotime("-1 year", strtotime($year))) ?></th>
            <th scope="col"><?= $thisYear?></th>
        </tr>
        <tr>
            <th scope="col"><?= __("件数") ?></th>
            <th scope="col"><?= $incident[4] ?></th>
            <th scope="col"><?= $incident[3] ?></th>
            <th scope="col"><?= $incident[2] ?></th>
            <th scope="col"><?= $incident[1] ?></th>
            <th scope="col"><?= $incident[0] ?></th>
        </tr>
    </table>
    <h3><?= "年度別マルウェア検出件数" ?></h3>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th scope="col"><?= __("年度") ?></th>
            <th scope="col"><?= date("Y", strtotime("-4 year", strtotime($year))) ?></th>
            <th scope="col"><?= date("Y", strtotime("-3 year", strtotime($year))) ?></th>
            <th scope="col"><?= date("Y", strtotime("-2 year", strtotime($year))) ?></th>
            <th scope="col"><?= date("Y", strtotime("-1 year", strtotime($year))) ?></th>
            <th scope="col"><?= $thisYear?></th>
        </tr>
        <tr>
            <th scope="col"><?= __("件数") ?></th>
            <th scope="col"><?= $malware[4] ?></th>
            <th scope="col"><?= $malware[3] ?></th>
            <th scope="col"><?= $malware[2] ?></th>
            <th scope="col"><?= $malware[1] ?></th>
            <th scope="col"><?= $malware[0] ?></th>
        </tr>
    </table>
    <p>※棒グラフでriksとmalmail出す</p>
</div>
