<?php include_once "db.php";

// 將資料(back/add_movie.php) 對應資料表中的欄位 都save存進資料庫 和to到下個網頁:
// 資料表中有11個欄位: id, name, level, length, ondate, publish, director, trailer, poster, intro, sh, rank 

if(isset($_FILES['tralier']['tmp_name'])){
    move_uploaded_file($_FILES['trailer']['tmp_name'],"../img/{$_FILES['trailer']['name']}");
    $_POST['trailer']=$_FILES['trailer']['name'];
}

if(isset($_FILES['poster']['tmp_name'])){
    move_uploaded_file($_FILES['poster']['tmp_name'],"../img/{$_FILES['poster']['name']}");
    $_POST['poster']=$_FILES['poster']['name'];
}

// 用一槓存到POST['ondate']
$_POST['ondate']=$_POST['year']."-".$_POST['month']."-".$_POST['date'];
// 可以逗號放三個參數
unset($_POST['year'],$_POST['month'],$_POST['date']);
$_POST['sh']=1;
$_POST['rank']=$Movie->max('id')+1;

$Movie->save($_POST);
to("../back.php?do=movie");


?>

