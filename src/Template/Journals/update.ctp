<?php
use Cake\I18n\Time;


      $time = Time::now();
      $time->modify('-1 days');


      // $query = $this->Journals->find()->where(['user_id' => $auth['User']['name']]);
      // ->where(['date' => $time]);
      // $query->select['content'];



/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Journal $journal
 */
//  echo $this->Time->format(
//   $post->loginT,
//   \IntlDateFormatter::FULL,
//   null,
//   $journals->time_zone
// );
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">

    <ul class="side-nav">
        <li class="heading"><?= __('メニュー') ?></li>
        <li><?= $this->Html->link(__('日報一覧'), ['action' => 'listPersonal']) ?></li>
    </ul>
</nav>
<div class="journals form large-9 medium-8 columns content">

    <?= $this->Form->create($journal) ?>
    <fieldset>

        <legend><?= __('作業終了＆日報作成') ?></legend>
        <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('日付') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('予め登録された作業') ?></th>
                  </tr>
              </thead>
              <tbody>
        <?php foreach ($journals00 as $journal): ?>
          <tr>
            <td><?=$this->Time->format($journal->date, 'yyyy/MM/dd') ?></td>
<td><?= h($journal->content) ?></td>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<Br/>
</Br/>
        <?php
            echo $this->Form->control('content', array('label' => '報告内容'));
        ?>

    </fieldset>
    <?= $this->Form->button(__('提出')) ?>
    <?= $this->Form->end() ?>
</div>
