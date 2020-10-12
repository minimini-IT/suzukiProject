<?php 
    $this->assign("title", "不審メール宛先一覧"); 
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
  <ul class="side-nav">
    <li class="heading"><?= __('Actions') ?></li>
    <li><?= $this->Html->link(__('一覧へ戻る'), ['controller' => 'RiskDetections', 'action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('TOPへ戻る'), ['controller' => 'Dairy', 'action' => 'index']) ?></li>
  </ul>
</nav>
<div class="cyberAttacks index large-9 medium-8 columns content">
    <h3><?= "不審メール宛先一覧" ?></h3>
    <p>３件以上の宛先表示</p>
    <table cellpadding="0" cellspacing="0">
        <?php foreach($suspiciousAddresses as $address): ?>
            <tr>
                <td><?= $address["duplicate_count"] ?></td>
                <td><?= $address["destination_address"] ?></td>
            </tr>
        <?php endforeach ?>
    </table>
</div>
