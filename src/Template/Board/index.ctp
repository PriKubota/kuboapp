<!DOCTYPE html>
<html lang="ja">
<head>
    <?= $this->html->css('board.css') ?>
    <?= $this->html->css('magic.min.css') ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, charset=UTF-8">
    <title><?= $title ?></title>
    <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
    <style>
        h2 {
margin:0;
padding-left:724px; /*アニメーションの範囲*/
display:inline-block; 
white-space:nowrap;
animation-name:title; /*アニメーションのクラス名*/
animation-timing-function:linear;/*アニメーションのタイミング・進行割合の指定*/
animation-duration:10s; /*アニメーションの速度*/
animation-iteration-count:infinite;/*アニメーションの動作回数*/
animation-direction: alternate;
}
@keyframes title {/*動作範囲(上級者向けの設定)*/
  from   { transform: translate(0%);} 
  99%,to { transform: translate(-100%);}
}
    </style>
</head>
<body>
    <header style="background: green;">
    <div style="background-color: lightYellow; border: 1px solid #E6DB55; padding: 10px;">
        <?= $this->Flash->render() ?>
    </div>
    <div>
        <h1 style="font-family: Georgia, 'Times New Roman', Times, serif; color:beige">
            みんなの掲示板&nbsp;<?= $this->Html->image("tenticon.jpeg", array('width'=>'30','height'=>'30')) ?>
        </h1>
    </div>
    <div id="photo" style="display: inline-block; box-shadow: 0px 0px 20px -5px rgba(0, 0, 0, 0.8); vertical-align:bottom;">
        <?= $this->Html->image("campfree.jpeg", array('width'=>'550','height'=>'350')) ?>
    </div>
    </header>
    <h2 class="title" style="font-family: Georgia, 'Times New Roman', Times, serif;">~アウトドアの情報を共有しよう~</h2>
    <article>
    <section>
        <h3>新規投稿</h3>
        <?= $this->Form->create("null", ["type" => "post", "url" => ["controller" => "Board", "action" => "index"]]) ?>
            <div class="name"><span class="label">名前：</span><?= $this->Form->control('name', ['type' => 'text', 'required' => false]) ?></div>
            <div class="honbun"><span class="label">投稿内容：</span><?= $this->Form->control('contents', ['type' => 'textarea', "cols" => "30", "rows" => "5", "maxlength" => "100", "wrap" => "hard", "placeholder" => "100字以内で入力してください", 'required' => false]) ?></div>
        <div class="btn">
            <input type="submit" value="投稿" style="box-shadow: 10px 10px 15px -10px; border:3px groove;">
        </div>
        <?= $this->Form->end() ?>
    </section>
    <section class="toukou">
        <h3>投稿一覧</h3>
        <?php foreach ($board as $boards): ?>
            <div>No.<?= $this->Number->format($boards->id) ?></>
            <div>投稿者：<?= h($boards->name) ?></div>
            <div class="edit" onclick="displayModal(<?= $boards->id ?>)">
            <div style="cursor: pointer;">投稿内容：<?= h($boards->contents) ?></div>
            </div>
            <div class="creatDate">投稿日時：<?= h($boards->created) ?></div>
        
        <div>----------------------------------------------</div>
        <?php if(empty($boards->id)): ?>
        <p>投稿はまだありません</p>
        <?php endif; ?>
        <?php endforeach; ?>
    </section>
    </article>
    <!-- フッター -->
    <footer style="width: 100% ; height: 150px; background-color: #174a5c; color: white; text-align: center;">
　　<ul class="footer-menu">
     <li style="display: inline;">home ｜</li>
     <li style="display: inline;">about ｜</li>
     <li style="display: inline;">service ｜</li>
     <li style="display: inline;">Contact Us</li>
    </ul>
    <p>© All rights reserved by webcampnavi.</p>
  </footer>
</body>
</html>

<!-- 投稿編集モーダル -->
<div id="boardModal" class="modalFade" style="z-index:1; display:none; position:fixed; top:0; left:0; width:100%; height:120%; background-color:rgba(0,0,0,0.75);">
    <div class="modal-contets" style="position:fixed; width: 50%; margin: 1.5em auto 0; padding: 10px 20px; border: 2px solid #aaa; background: #FFFFCC; z-index: 2; border-radius: 10px;">
        <div class="modal-header">
            <h1 class="modal-title">投稿内容編集</h1>
        </div>
        <div class="modal-body">
        <?= $this->Form->create($board, ["id" => "formInput", "type" => "post", "url" => ["controller" => "Board", "action" => "index"]]) ?>
            <?= $this->Form->control("id", ["type" => "hidden", "id" => "id"]); ?>
        <div class="honbun">
            <span class="label">投稿内容：</span><?= $this->Form->control('contents', ['id' => 'contents', 'type' => 'textarea', "cols" => "30", "rows" => "5", "maxlength" => "100", "wrap" => "hard", "placeholder" => "100字以内で入力してください", 'required' => false]) ?></div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="registration">
                登録
            </button>
            <?= $this->Form->end(); ?>
            <button type="submit" class="delete">
                削除
            </button>
            <button type="button" onclick="close()" id="closeModal">
                閉じる
            </button>
        </div>
    </div>
</div>
<script>
    $('#photo').addClass('magictime boingInUp');
</script>
<script type="text/javascript">
$('#boardModal').hide();
function displayModal(id) {
    $('#boardModal').show();
    if(id) {
        console.log(id);
        $.ajax({
            url: '<?= $this->Url->build(['controller' => 'Ajax', 'action' => 'getBoard']); ?>',
            type: 'POST',
            dataType: 'json',
            data: {
                id: id
            }
        })
        .done(function(data) {
            // データ取得成功時
            console.log(data);
            $('#id').val(data.board[0].id);
            $('#contents').val(data.board[0].contents);
        });
    }
}

$('#closeModal').click(function() {
    $('#id').val('');
    $('#contents').val('');
    $('#boardModal').hide();
});

$('.registration').on('click', function() {
    if (confirm('登録しますか？')) {
        $('#formInput').submit();
    } else {
        return false;
    }
});

$('.delete').on('click', function() {
    if (confirm('削除しますか？')) {
        location.href = '<?= $this->Url->build(['action'=>'delete']) ?>/' + $('#id').val(); 
    } else {
        return false;
    }
});

</script>
