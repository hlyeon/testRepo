<?php
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
        <legend><?= __('日報修正') ?></legend>
        <?php
            echo $this->Form->control('content', array('label' => '報告内容'));
        ?>
    </fieldset>
    <?= $this->Form->button(__('提出')) ?>
    <?= $this->Form->end() ?>
</div>
