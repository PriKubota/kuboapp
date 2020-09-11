<?= $this->Html->doctype('html5') ?>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
</head>
<body>
<h1>ようこそへ</h1>
<?= $this->Html->image("login/camp.jpg") ?>
<div>
    <?= $this->Flash->render() ?>
    <?= $this->Form->create() ?>
    <fieldset>
        <legend>ユーザー名とパスワードを入力してください。</legend>
        ユーザー名：<?= $this->Form->control('Users.username') ?>
        パスワード：<?= $this->Form->control('Users.password') ?>
    </fieldset>
    <?= $this->Form->button(__('送信')) ?>
    <?= $this->Form->end() ?>
</div>
</body>
<footer>
    <div>
        <input type="button" value="トップに戻る"　onclick="top()">
    </div>
</footer>
</html>

<script>
    //トップに戻る
    function top() {
        scrollTo(0,0);
    }
    
</script>