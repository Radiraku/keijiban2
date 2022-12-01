	<?php
echo 'Welcome ラジオ好き';
?>
<!DOCTYPE html>
<meta charset="UTF-8">
<title>おいす掲示板</title>
<h1>おいす掲示板</h1>
<section>
    <h2>新規投稿</h2>
    <form action="send.php" method="post">
        名前 : <input type="text" name="name" value=""><br>
        投稿内容: <input type="text" name="contents" value=""><br>
        <button type="submit">投稿</button>
    <!--消去の入力フォーム-->
    <input type="text" name="deleteno" value="">
    <input type="submit" name="delete" value="削除">
    </form>
</section>
<!-- 追記１ここから -->
<?php
//DB接続情報を設定します。
$pdo = new PDO(
    "mysql:dbname=sample;host=localhost","root","",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`")
);
//ここで「DB接続NG」だった場合、接続情報に誤りがあります。
if ($pdo) {
    echo "おいす（DB）接続OK";
} else {
    echo "おいす（DB）接続NG";
}
//SQLを実行。
$regist = $pdo->prepare("SELECT * FROM post order by created_at DESC limit 30");
$regist->execute();
//ここで「登録失敗」だった場合、SQL文に誤りがあります。
if ($regist) {
    echo "おいす成功";
} else {
    echo "おいす失敗";
}

?>

  }
<!-- 追記１ここまで -->

 
<!-- 追記２ここから -->
<section>
	<h2>おいす内容一覧</h2>
		<?php foreach($regist as $loop):?>
			<div>No：<?php echo $loop['id']?></div>
			<div>名前：<?php echo $loop['name']?></div>
			<div>投稿内容：<?php echo $loop['contents']?></div>
            <div>投稿時間：<?php echo $loop['created_at']?></div>
			<div>------------------------------------------</div>
		<?php endforeach;?>
	
</section>
<!-- 追記２ここまで -->
