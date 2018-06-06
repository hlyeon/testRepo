<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('メニュー') ?></li>
        <li><?= $this->Form->postLink(
                __('削除'),
                ['action' => 'delete', $user->id],
                ['confirm' => __('ユーザー # {0}を削除しますか?', $user->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('ユーザー一覧'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('日報一覧（管理者）'), ['controller' => 'Journals', 'action' => 'listAdmin']) ?> </li>
        <li><?= $this->Html->link(__('ユーザー登録'), ['controller' => 'Users', 'action' => 'signup']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('ユーザー修正') ?></legend>
        <?php
            echo $this->Form->control('email', array('label' => 'Eメール'));
            echo $this->Form->control('name', array('label' => '氏名'));
            echo $this->Form->control('password', array('label' => 'パスワード'));
            echo $this->Form->control('dept', array('label' => '部署'));
            echo $this->Form->control('speciality', array('label' => '特記'));
        ?>
    </fieldset>
    <?= $this->Form->button(__('提出')) ?>
    <?= $this->Form->end() ?>
</div>
