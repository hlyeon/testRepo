<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('メニュー') ?></li>
        <li><?= $this->Html->link(__('ユーザー修正'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('ユーザー削除'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('ユーザー一覧'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('ユーザー登録'), ['action' => 'signup']) ?> </li>
        <li><?= $this->Html->link(__('日報一覧（管理者）'), ['controller' => 'Journals', 'action' => 'listAdmin']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Eメール') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('氏名') ?></th>
            <td><?= h($user->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('パスワード') ?></th>
            <td><?= h($user->password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('部署') ?></th>
            <td><?= h($user->dept) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('特記') ?></th>
            <td><?= h($user->speciality) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('社員番号') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('作成した日報') ?></h4>
        <?php if (!empty($user->journals)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('一連番号') ?></th>
                <th scope="col"><?= __('社員番号') ?></th>
                <th scope="col"><?= __('日付') ?></th>
                <th scope="col"><?= __('出社時間') ?></th>
                <th scope="col"><?= __('作業時間') ?></th>
                <th scope="col"><?= __('退勤時間') ?></th>
                <th scope="col"><?= __('報告') ?></th>
                <th scope="col"><?= __('コメント') ?></th>
                <th scope="col" class="actions"><?= __('機能') ?></th>
            </tr>
            <?php foreach ($user->journals as $journals): ?>
            <tr>
              <?php $date1 = $journals->openT;
              $date2 = $journals->closeT;
              $result = (strtotime($date2) - strtotime($date1)) / 3600;
              $result = (int)$result;
             ?>
                <td><?= h($journals->id) ?></td>
                <td><?= h($journals->user_id) ?></td>
                <td><?=$this->Time->format($journals->date, 'yyyy/MM/dd') ?></td>
                <td><?=$this->Time->format($journals->loginT, 'HH:mm') ?></td>
                <td><?= h($result) ?>
                <td><?=$this->Time->format($journals->logoutT, 'HH:mm') ?></td>
                <td><?= h($journals->content) ?></td>
                <td><?= h($journals->comment) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('詳細'), ['controller' => 'Journals', 'action' => 'detailsAdmin', $journals->id]) ?>
                    <!-- <?= $this->Html->link(__('修正'), ['controller' => 'Journals', 'action' => 'edit', $journals->id]) ?> -->
                    <?= $this->Form->postLink(__('削除'), ['controller' => 'Journals', 'action' => 'delete', $journals->id], ['confirm' => __('日報 # {0}を削除しますか?', $journals->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
