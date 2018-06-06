<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Journal[]|\Cake\Collection\CollectionInterface $journals
 */
?>
<?php echo $this->Html->script('https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js'); ?>
<?php echo $this->Html->script('https://cdn.datatables.net/1.10.11/js/dataTables.bootstrap.min.js'); ?>


<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('メニュー') ?></li>
        <li><?= $this->Html->link(__('作業開始'), ['action' => 'start']) ?></li>
    </ul>
</nav>
<div class="journals index large-9 medium-8 columns content">
    <h3><?= __('日報一覧') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('氏名') ?></th>
                <th scope="col"><?= $this->Paginator->sort('日付') ?></th>
                <th scope="col"><?= $this->Paginator->sort('報告') ?></th>
                <th scope="col"><?= $this->Paginator->sort('コメント') ?></th>
                <th scope="col" class="actions"><?= __('機能') ?></th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($journals as $journal): ?>
            <tr>
              <td><?= h($auth['User']['name'])?></td>
                <td><?=$this->Time->format($journal->date, 'yyyy/MM/dd') ?></td>
                <td><?= h($journal->content) ?></td>
                <td><?= $journal->has('comment') ? $this->Html->image('cake.icon.png', ['alt' => 'comment'])  : h(''); ?></td>


                <td class="actions">
                    <?= $this->Html->link(__('詳細'), ['action' => 'view', $journal->id]) ?>
                    <?= $this->Html->link(__('修正'), ['action' => 'modify', $journal->id]) ?>
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


<script>
  $(document).ready(function(){
    $('#listPersonal').Datatable();
  });
</script>
