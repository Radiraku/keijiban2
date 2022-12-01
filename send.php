

<!DOCTYPE html>
<meta charset="UTF-8">
<title>おいす掲示板</title>
<h1>おいす掲示板</h1>
<section>
    <h2>投稿完了</h2>
    <button onclick="location.href='index.php'">戻る</button>
</section>
 
<!-- 追記ここから -->
<?php
$id = null;
$name = $_POST["name"];
$contents = $_POST["contents"];
date_default_timezone_set('Asia/Tokyo');
$created_at = date("Y-m-d H:i:s");
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
$regist = $pdo->prepare("INSERT INTO post(id, name, contents, created_at) VALUES (:id,:name,:contents,:created_at)");
$regist->bindParam(":id", $id);
$regist->bindParam(":name", $name);
$regist->bindParam(":contents", $contents);
$regist->bindParam(":created_at", $created_at);
$regist->execute();
//ここで「登録失敗」だった場合、SQL文に誤りがあります。
if ($regist) {
    echo "おいす成功";
} else {
    echo "おいす失敗";
}
?>
<!-- 追記ここまで -->