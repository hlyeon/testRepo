<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Journal $journal
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Journals'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="journals form large-9 medium-8 columns content">
    <?= $this->Form->create($journal) ?>
    <fieldset>
        <legend><?= __('Add Journal') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('date');
            echo $this->Form->control('loginT', ['empty' => true]);
            echo $this->Form->control('openT', ['empty' => true]);
            echo $this->Form->control('closeT', ['empty' => true]);
            echo $this->Form->control('logoutT', ['empty' => true]);
            echo $this->Form->control('content');
            echo $this->Form->control('comment');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
