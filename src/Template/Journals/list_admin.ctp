<?php
use Cake\I18n\Time;

$time = Time::now();
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Journal[]|\Cake\Collection\CollectionInterface $journals
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('メニュー') ?></li>
        <li><?= $this->Html->link(__('ユーザー一覧'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('ユーザー登録'), ['controller' => 'Users', 'action' => 'signup']) ?></li>
    </ul>
</nav>
<div class="journals index large-9 medium-8 columns content">
    <h3><?= __('日報一覧（管理者）') ?></h3>
    <?= $this->Form->create("", ['type'=>'get']) ?>

  <?= $this->Form->select('filter', [
    'date' => '日付',
    'name' => '氏名',
    'dept' => '部署'
],['default'=>$this->request->query('filter')]);?>

    <?= $this->Form->control('keyword', array('label' => '検索語'), ['default'=>$this->request->query('keyword')]); ?>
    <button>検索</button>
    <?= $this->Form->end() ?>



    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('氏名') ?></th>
                <th scope="col"><?= $this->Paginator->sort('日付') ?></th>
                <th scope="col"><?= $this->Paginator->sort('出社時間') ?></th>
                <th scope="col"><?= $this->Paginator->sort('作業時間') ?></th>
                <th scope="col"><?= $this->Paginator->sort('退勤時間') ?></th>
                <th scope="col"><?= $this->Paginator->sort('特記') ?></th>
                <th scope="col" class="actions"><?= __('機能') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($journals as $journal): ?>
            <tr>
              <?php $date1 = $journal->openT;
              $date2 = $journal->closeT;
              $result = (strtotime($date2) - strtotime($date1)) / 3600;
              $result = (int)$result;
             ?>
                <td><?= $journal->has('user') ? $this->Html->link($journal->user->name, ['controller' => 'Users', 'action' => 'view', $journal->user->id]) : '' ?></td>
                <td><?=$this->Time->format($journal->date, 'yyyy/MM/dd') ?></td>
                <td><?=$this->Time->format($journal->loginT, 'HH:mm') ?></td>
                <td><?= h($result) ?>
                <td><?=$this->Time->format($journal->logoutT, 'HH:mm') ?></td>
                <td><?= $journal->has('user') ? h($journal->user->speciality) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('報告詳細'), ['action' => 'detailsAdmin', $journal->id]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
          <?= $this->Paginator->first('<< ' . __('最初')) ?>
          <?= $this->Paginator->prev('< ' . __('前')) ?>
          <?= $this->Paginator->numbers() ?>
          <?= $this->Paginator->next(__('次') . ' >') ?>
          <?= $this->Paginator->last(__('最後') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('{{page}}ページ 中{{pages}}, 総{{count}}つのレコーダー中{{current}}表示')]) ?></p>
    </div>
</div>
