
<?php
//投稿
$dsn="データベース名";
$user="ユーザー名";
$password="パスワード";
$pdo=new PDO($dsn,$user,$password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
if (!empty($_POST["name"]) and !empty($_POST["comment"]))
{
$sql="CREATE TABLE IF NOT EXISTS tbtest"
."("
."id INT AUTO_INCREMENT PRIMARY KEY,"
."name char(32),"
."comment TEXT"
.");";
$stmt=$pdo->query($sql);
$sql=$pdo->prepare("INSERT INTO tbtest (name,comment) VALUES (:name,:comment)");
$sql->bindParam(":name", $name, PDO::PARAM_STR);
$sql->bindParam(":comment",$comment,PDO::PARAM_STR);
$name=$_POST["name"];
$comment=$_POST["comment"];
$sql->execute();
$sql="SELECT * FROM tbtest";
$stmt=$pdo->query($sql);
$results=$stmt->fetchAll();
foreach ($results as $row)
{echo $row["id"].",";
echo $row["name"].",";
echo $row["comment"]."<br>";
echo "<hr>";
}
}
?>

<?php
//削除
if (!empty($_POST["deletenumber"]))
{
$id=$_POST["deletenumber"];
$sql="delete from tbtest where id=:id";
$stmt=$pdo->prepare($sql);
$stmt->bindParam(":id",$id,PDO::PARAM_INT);
$stmt->execute();
$sql="SELECT * FROM tbtest";
$stmt=$pdo->query($sql);
$results=$stmt->fetchAll();
foreach ($results as $row)
{echo $row["id"].",";
echo $row["name"].",";
echo $row["comment"]."<br>";
echo "<hr>";
}}
?>

<?php
//編集
if (!empty($_POST["editnumber"]))
{
$id=$_POST["editnumber"];
$name=$_POST["editname"];
$comment=$_POST["editcomment"];
$sql="update tbtest set name=:name,comment=:comment where id=:id";
$stmt=$pdo->prepare($sql);
$stmt->bindParam(":name",$name,PDO::PARAM_STR);
$stmt->bindParam(":comment",$comment,PDO::PARAM_STR);
$stmt->bindParam(":id", $id, PDO::PARAM_INT);
$stmt->execute();
$sql="SELECT * FROM tbtest";
$stmt=$pdo->query($sql);
$results=$stmt->fetchAll();
foreach ($results as $row)
{echo $row["id"].",";
echo $row["name"].",";
echo $row["comment"]."<br>";
echo "<hr>";}
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>WEB掲示板</title>
</head>
<body>
<form action=" " method="post">
<p><h1>投稿</h1></p>
<p>名前</p>
<input type="text" name="name" ></p>
<p>コメント</p>
<input type="text" name="comment" ></p>
<p><input type="submit" value="送信"></p>
</form>
<form action="" method="post">
<p><h1>削除</h1></p>
<p>削除番号</p>
<input type="number" name="deletenumber">
<p><input type="submit" value="送信"></p>
</form>
<form action=" " method="post">
<p><h1>編集</h1></p>
<p>編集番号</p>
<input type="number" name="editnumber"></p>
<p>編集名前</p>
<input type="text" name="editname" ></p>
<p>編集コメント</p>
<input type="text" name="editcomment" ></p>
<p><input type="submit" value="編集"></p>
</form>
</body>
</html>
