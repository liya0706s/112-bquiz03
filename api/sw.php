<?php

include_once "db.php";

// POST參數是從poster的script AJAX來的

// $row這一筆資料 ; $sw要交換的資料
// 用$tmp暫存rank值
$DB=new DB($_POST['table']);
$row=$DB->find($_POST['id']);
$sw=$DB->find($_POST['sw']);

// row的rank暫時放到tmp
// sw的rank就可以放到row的rank
// 剛剛的tmp再放回sw的rank
$tmp=$row['rank'];
$row['rank']=$sw['rank'];
$sw['rank']=$tmp;

$DB->save($row);
$DB->save($sw);
?>