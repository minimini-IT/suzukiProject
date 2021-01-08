<?php
$this->assign("title", "ユーザ管理");
?>
<div class="uk-grid grid-margin-remove">

    <div class="small-subbar">
        <nav class="uk-navbar-container" uk-navbar>
            <div class="uk-navbar-right">
                <ul class="uk-navbar-nav">
                   <li class="small-subbar-li"><?= $this->Html->link(__('戻る'), ['action' => 'top'], ['class' => 'uk-button uk-button-primary management-sub-button uk-padding-remove small-subbar-height']) ?></li>
                   <li class="small-subbar-li"><?= $this->Html->link(__('LOGOUT'), ['action' => 'logout'], ['class' => 'uk-button uk-button-primary management-sub-button uk-padding-remove small-subbar-height']) ?></li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="uk-width-3-4@s medium-margin uk-width-1-1 grid-child">

        <table class="uk-table uk-table-striped uk-table-small uk-table-middle">
            <tbody>
                <?php foreach ($managementUsers as $managementUser): ?>
                <tr>
                    <td class="uk-text-center uk-width-1-2"><?= h($managementUser->last_name).h($managementUser->first_name) ?></td>
                    <td class="uk-text-center uk-width-1-4">
                        <?= $this->Html->link(__('編集'), ['action' => 'edit', $managementUser->management_users_id], ["class" => "uk-button uk-button-default uk-padding-remove-top uk-padding-remove-bottom"]) ?>
                    </td>
                    <td class="uk-text-center uk-width-1-4">
                        <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $managementUser->management_users_id], ['confirm' => __('{0} さんを削除しますか？', $managementUser->last_name . $managementUser->first_name), "class" => "uk-button uk-button-danger uk-padding-remove"]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="paginator">
            <ul class="uk-pagination" uk-margin>
                <?= $this->Paginator->first(__('<< ')) ?>
                <?= $this->Paginator->numbers(["first" => "First page", "last" => 1]) ?>
                <?= $this->Paginator->last(__(' >>')) ?>
            </ul>
        </div>

    </div>
    <div class="uk-width-1-4 uk-padding-remove uk-text-center small-remove">
        <ul class="uk-list">
            <li><?= $this->Html->link(__('LOGOUT'), ['action' => 'logout'], ['class' => 'uk-button uk-button-primary uk-margin-bottom management-sub-button uk-padding-remove']) ?></li>
            <li><?= $this->Html->link(__('戻る'), ['action' => 'top'], ['class' => 'uk-button uk-button-primary uk-margin-bottom management-sub-button uk-padding-remove']) ?></li>
            <li><?= $this->Html->link(__('ユーザ登録'), ['action' => 'add'], ['class' => 'uk-button uk-button-primary uk-margin-bottom management-sub-button uk-padding-remove']) ?></li>
        </ul>
    </div>
</div>
