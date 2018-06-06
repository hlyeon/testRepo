<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Journal $journal
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('メニュー') ?></li>
        <li><?= $this->Form->postLink(__('日報削除'), ['action' => 'delete', $journal->id], ['confirm' => __('日報 # {0}を削除しますか?', $journal->id)]) ?> </li>
        <li><?= $this->Html->link(__('日報一覧（管理者）'), ['action' => 'listAdmin']) ?> </li>
        <li><?= $this->Html->link(__('ユーザー一覧'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('ユーザー登録'), ['controller' => 'Users', 'action' => 'signup']) ?> </li>
    </ul>
</nav>
<div class="journals view large-9 medium-8 columns content">

    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('氏名') ?></th>
            <td><?= $journal->has('user') ? $this->Html->link($journal->user->name, ['controller' => 'Users', 'action' => 'view', $journal->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('社員番号') ?></th>
            <td><?= $this->Number->format($journal->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('日付') ?></th>
            <td><?=$this->Time->format($journal->date, 'yyyy/MM/dd') ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('出社時間') ?></th>
            <td><?=$this->Time->format($journal->loginT, 'HH:mm') ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('作業時間') ?></th>
              <?php $date1 = $journal->openT;
              $date2 = $journal->closeT;
              $result = (strtotime($date2) - strtotime($date1)) / 3600;
              $result = (int)$result;
             ?>
            <td><?=$this->Time->format($result, 'HH:mm') ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('退勤時間') ?></th>
            <td><?=$this->Time->format($journal->logoutT, 'HH:mm') ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('報告') ?></h4>
        <?= $this->Text->autoParagraph(h($journal->content)); ?>
    </div>
    <div class="row">
        <h4><?= __('コメント') ?></h4>
        <?= $this->Text->autoParagraph(h($journal->comment)); ?>
    </div>
    <div class="row">
      <?= $this->Form->create($journal) ?>
          <?php
              echo $this->Form->control('comment', array('label' => 'コメント'));
          ?>
      <?= $this->Form->button(__('提出')) ?>
      <?= $this->Form->end() ?>
    </div>

</div>
