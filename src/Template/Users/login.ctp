<?= $this->Html->doctype('html5') ?>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0">
    <title><?= $title ?></title>
</head>
<body>
<h1 style="font-family:Georgia, 'Times New Roman', Times, serif; text-align: center;">ようこそ！アウトドアの掲示板へ</h1>
<fieldset>
        <legend>ユーザー名とパスワードを入力してください。</legend>
        ユーザー名：<?= $this->Form->control('username') ?>
        パスワード：<?= $this->Form->control('password') ?>
    </fieldset>

<div>
    <?= $this->Flash->render() ?>
    <?= $this->Form->create() ?>
    <?= $this->Form->button(__('送信')) ?>
    <?= $this->Form->end() ?>
</div>
<?= $this->Html->image("camp.jpg", array('width'=>'100%','height'=>'500')) ?>
</body>
<footer>
</footer>
</html>
<script>
</script>