<?php
use Cake\I18n\Time;

 $time = Time::now();
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Journal $journal
 */

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
        <legend><?= __('作業開始') ?></legend>
<?php
            echo $this->Form->control('user_id', array('value' => $auth['User']['id'], 'options' => $users, 'label' => '氏名'));
echo $this->Form->control('date', array('label' => '日付'));
?>




    </fieldset>
    <?= $this->Form->button(__('出勤')) ?>
    <?= $this->Form->end() ?>
</div>
