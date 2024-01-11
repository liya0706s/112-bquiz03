<!-- 從back/poster.php POST來的有file -->
<?php include_once "db.php";
dd($_POST);

// 判斷是否有file name='poster'的file的tmp_name
// 搬移到img資料夾，再重新命名 
// $_FILES['poster']['name']的值
if(isset($_FILES['poster']['tmp_name'])){
move_uploaded_file($_FILES['poster']['tmp_name'],"../img/{$_FILES['poster']['name']}");
$_POST['img']=$_FILES['poster']['name'];
// POST進來資料表 img欄位名稱
}
dd($_POST);

// $_POST['sh']=1;
// $_POST['rank']=$Poster->max('id')+1;
// max('id')是fetchColumn就是那一筆值
// 排序是"交換"的道理
// 用最大的id+1，就知道新的資料是多少
// $_POST['ani']=rand(1,3);


// $Poster->save($_POST);
// to("../back.php?do=poster");
?>