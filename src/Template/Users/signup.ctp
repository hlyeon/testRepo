<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('メニュー') ?></li>
        <li><?= $this->Html->link(__('ユーザー一覧'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('日報一覧'), ['controller' => 'Journals', 'action' => 'listAdmin']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">




    <?= $this->Form->create($user) ?>
  <fieldset>
    <legend>個人情報</legend>
    <div class="form-group">
      <label for="exampleInputEmail1">Eメール</label>
      <input type="email" class="form-control" id="InputEmail1" name="email" aria-describedby="emailHelp" placeholder="Eメールを入力してください">
      <small id="emailHelp" class="form-text text-muted">Eメールは絶対に公有しないこと。</small>
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">パスワード</label>
      <input type="password" name="password" class="form-control" id="inputPassword" placeholder="パスワード">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">氏名</label>
      <input type="text" name="name" class="form-control" id="inputName" placeholder="氏名を入力してください">
    </div>
  </fieldset>
  </fieldset>
  <fieldset class="form-group">
        <legend>部署</legend>
        <div class="form-check">
          <label class="form-check-label">
            <input type="radio" class="form-check-input" name="dept" id="optionsRadios1" value="営業部" checked="">
            営業部
          </label>
        </div>
        <div class="form-check">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="dept" id="optionsRadios2" value="マーケティング部">
            マーケティング部
          </label>
        </div>
        <div class="form-check">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="dept" id="optionsRadios3" value="購買部">
            購買部
          </label>
        </div>
        <div class="form-check">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="dept" id="optionsRadios4" value="秘書室">
            秘書室
          </label>
        </div>
        <div class="form-check">
        <label class="form-check-label">
            <input type="radio" class="form-check-input" name="dept" id="optionsRadios4" value="ITソルーション事業部">
            ITソルーション事業部
          </label>
        </div>

      </fieldset>

    <fieldset class="form-group">
      <legend>特記</legend>
      <div class="form-check">
        <label class="form-check-label">
          <input class="form-check-input" type="checkbox" name="speciality" value="英語">
          英語
        </label>
        <label class="form-check-label">
          <input class="form-check-input" type="checkbox" name="speciality" value="中国語">
          中国語
        </label>
        <label class="form-check-label">
          <input class="form-check-input" type="checkbox" name="speciality" value="エクセル">
          エクセル
        </label>
        <label class="form-check-label">
          <input class="form-check-input" type="checkbox" name="speciality" value="プレゼンテーション">
          プレゼンテーション
        </label>
        <label class="form-check-label">
          <input class="form-check-input" type="checkbox" name="speciality" value="cakePHP">
          cakePHP
        </label>
      </div>
    </fieldset>
    <button type="reset" class="btn btn-default">キャンセル</button>
    <?= $this->Form->button(__('登録'), ['class'=> 'btn btn-primary']) ?>
  </fieldset>
<?= $this->Form->end() ?>
</div>
