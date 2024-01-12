<?php include_once "db.php";

// 從back/movie.php script來的POST id
$row=$Movie->find($_POST['id']); 
// 方法二:判斷0和1之間切換,關係是+1取餘數
// 2的餘數0或1; 1+1%2=0 ; 0+1%2=1
// $row['sh']=($row['sh']+1)%2;

$row['sh']=($row['sh']==1)?0:1;
$Movie->save($row);


?>