
<?php
//投稿
if (!empty($_POST["name"]) and !empty($_POST["coment"]) and empty($_POST["judgenumber"]))
{
$name=$_POST["name"];
$coment=$_POST["coment"];
$filename="mission_3.txt";
$date=date("Y/m/d H:i:s");
touch($filename);
$fp=fopen($filename,"a");
$format=(count(file($filename))+1)."<>".$name."<>".$coment."<>".$date;
fwrite($fp,$format."\n");
fclose($fp);
echo "コメントありがとうございます";
}
?>


<?php
//削除
if (!empty($_POST["deletenumber"]) and $_POST["deletepass"]=="deleteyui")

{$dnum=$_POST["deletenumber"];
$delete=file("mission_3.txt");
$fp=fopen("mission_3.txt","w");
for ($d=0;$d<count($delete);$d++)
{$darray=explode("<>",$delete[$d]);
if ($darray[0]!=$dnum)
{fwrite($fp,$delete[$d]);}

}
fclose($fp);
}
?>


<?php
//編集
if (!empty($_POST["editnumber"]) and$_POST["editpass"]=="edityui")
{$enum=$_POST["editnumber"];
$edit=file("mission_3.txt");
foreach ($edit as $e_array)
{
$e_array=explode("<>",$e_array);
if ($enum==$e_array[0])
{$simedit[1]=$e_array[1];
$simedit[2]=$e_array[2];}
}
}
?>
<?php
//判定
if (!empty($_POST["judgenumber"]))
{$jnum=$_POST["judgenumber"];
$judge=file("mission_3.txt");
$jname=$_POST["name"];
$jcoment=$_POST["coment"];
$jdate=date("Y/m/d H:i:s");

foreach ($judge as $j_array)
{$j_array=explode("<>",$j_array);

if ($jnum==$j_array[0])
{
array_splice($j_array,0,1,$jnum);
array_splice($j_array,1,1,$jname);
array_splice($j_array,2,1,$jcoment);
array_splice($j_array,3,1,$jdate);}

for ($i=1;$i<count($judge);$i++)
{$jitem=implode("<>",$j_array);}

$fp=fopen("mission_3_edit.txt","a");
fwrite($fp,$jitem."\n");
fclose($fp);
}
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>WEB掲示板</title>
</head>
<body>
<form action="mission_3.php" method="post">
<h1>投稿</h1>
<p>名前</p>
<input type="text" name="name" value="<?php if (!empty($_POST["editnumber"])) echo $simedit[1]; ?>"></p>
<p>コメント</p>
<input type="text" name="coment" value="<?php if (!empty($_POST["editnumber"])) echo $simedit[2]; ?>"></p>
<input type="hidden" name="judgenumber" value="<?php if (!empty($_POST["editnumber"])) echo $enum; ?>"></p>
<p><input type="submit" value="送信"></p>
</form>
<form action="mission_3.php" method="post">
<h1>削除</h1>
<p>削除番号</p>
<input type="number" name="deletenumber"></p>
<p>パスワード</p>
<input type="text" name="deletepass"></p>
<p><input type="submit" value="削除"></p>
</form>

<form action="mission_3.php" method="post">
<h1>編集</h1>
<p>編集番号</p>
<input type="number" name="editnumber"></p>
<p>パスワード</p>
<input type="text" name="editpass"></p>
<p><input type="submit" value="編集"></p>
</form>


</body>
</html>
