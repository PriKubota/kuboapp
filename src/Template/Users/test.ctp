<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test</title>
</head>
<body>
 <h1>テストです</h1>
 <div>
    <?= $this->Flash->render() ?>
    <?= $this->Form->create() ?>
    <fieldset>
        <legend>ユーザー名とパスワードを入力してください。</legend>
        ユーザー名：<?= $this->Form->control('Users.username') ?>
        パスワード：<?= $this->Form->control('Users.password') ?>
        削除フラグ：<?= $this->Form->control('Users.del_flg') ?>
        権限：<?= $this->Form->control('Users.auth') ?>
    </fieldset>
    <?= $this->Form->button(__('送信')) ?>
    <?= $this->Form->end() ?>
</div>
</body>
</html>