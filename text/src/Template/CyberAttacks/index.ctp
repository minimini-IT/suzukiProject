<div class="cyberAttacks index large-9 medium-8 columns content">
    <h3><?= __('サイバー攻撃等') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Html->link(__('リスク検知'), ['controller' => 'RiskDetections', 'action' => 'index']) ?></th>
            </tr>
            <tr>
                <th scope="col"><?= $this->Html->link(__('不審メール'), ['controller' => 'Malmail', 'action' => 'index']) ?></th>
            </tr>
            <tr>
                <th scope="col"><?= $this->Html->link(__('年度インシデント集計表'), ['controller' => '', 'action' => 'index']) ?></th>
            </tr>
            <tr>
                <th scope="col"><?= $this->Html->link(__('部内マルウェア検出数'), ['' => '', 'action' => 'index']) ?></th>
            </tr>
            <tr>
                <th scope="col"><?= $this->Html->link(__('年度不審メール件数'), ['' => '', 'action' => 'index']) ?></th>
            </tr>
            <tr>
                <th scope="col"><?= $this->Html->link(__('不審メール宛先一覧'), ['' => '', 'action' => 'index']) ?></th>
            </tr>
        </thead>
    </table>
</div>
