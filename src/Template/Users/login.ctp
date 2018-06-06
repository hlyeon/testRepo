<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<!-- <nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('メニュー') ?></li>
        <li><?= $this->Html->link(__('日報一覧'), ['action' => 'listPersonal']) ?></li>
        <li><?= $this->Html->link(__('ユーザー登録'), ['controller' => 'Users', 'action' => 'signup']) ?></li>
    </ul>
</nav> -->
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('ログイン') ?></legend>
        <?php
            echo $this->Form->control('email', array('label' => 'Eメール'));
            echo $this->Form->control('password', array('label' => 'パスワード'));
        ?>
    </fieldset>
    <?= $this->Form->button(__('ログイン')) ?>
    <?= $this->Form->end() ?>
</div>
