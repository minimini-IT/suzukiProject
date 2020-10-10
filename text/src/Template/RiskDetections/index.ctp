<nav class="large-3 medium-4 columns" id="actions-sidebar">
  <ul class="side-nav">
    <li class="heading"><?= __('Actions') ?></li>
    <li><?= $this->Html->link(__('TOPへ戻る'), ['controller' => 'Dairy', 'action' => 'index']) ?></li>
  </ul>
</nav>
<div class="cyberAttacks index large-9 medium-8 columns content">
    <h3><?= __('サイバー攻撃等') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Html->link(__('リスク検知'), ['action' => 'risk']) ?></th>
            </tr>
            <tr>
                <th scope="col"><?= $this->Html->link(__('不審メール'), ['action' => 'malmail']) ?></th>
            </tr>
            <tr>
                <th scope="col"><?= $this->Html->link(__('インシデント集計表'), ['action' => 'spreadsheet']) ?></th>
            </tr>
            <tr>
                <th scope="col"><?= $this->Html->link(__('不審メール宛先一覧'), ['action' => 'malmailDestination']) ?></th>
            </tr>
        </thead>
    </table>
</div>
