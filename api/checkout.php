<?php
include_once "db.php";

// $_POST=[movie,date,session,seats,no];
// 這裡預期從前端接收到一個包含 movie, date, session, seats, no 的 $_POST 數組
// 陣列 物件 和檔案不能存入資料表中，只有字串和數字可以
// 陣列序列化serialize()轉成大括號格式可以存入...

sort($_POST['seats']);
// callbyreference 會直接改變陣列內容
$_POST['seats'] = serialize($_POST['seats']);
$id = $Order->max('id') + 1;
// 預計要存進去的id

// 下面的代碼行是關於如何生成訂單編號
$_POST['no'] = date("Ymd") . sprintf("%04d", $id);
// date("Ymd") 生成當前日期的字串，格式為「年月日」
// sprintf("%04d", $id) 生成一個四位數的字串，不足四位數時前面補零
// 結合這兩部分，生成一個獨特的訂單編號，例如 202301011234

$Order->save($_POST);
echo $_POST['no'];  // 給前端
