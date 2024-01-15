<?php include_once 'db.php';
// 得到order ajax來的 movie和date
$movie=$_GET['movie'];
// 找到電影名稱，要計算剩餘座位數
$movieName=$Movie->find($movie)['name'];
$date=$_GET['date'];
$H=date("G");
$start=($H<14 && $date==date("Y-m-d"))?7-ceil((24-$H)/2):1;
// 日期等於今天或大於14

// 無條件進位以後減一知道還有多少場次
// $start和剩餘場次相加是6
// 調整時間，檢查有沒有寫對剩餘場次

// 根據題目有五個場次，寫在db.php裡面
for($i=1;$i<=5;$i++){

    // 1. 去資料表撈出電影,日期,場次的訂單
    // 2. 根據訂單,計算座位數
    // 3. 在迴圈使用20-座位數來取得剩餘座位數
    
    $qty=$Order->sum('qty',['movie'=>$movieName,'date'=>$date,'session'=>$sess[$i]]);
    $remaining=20-$qty;
    echo "<option value='{$sess[$i]}'> {$sess[$i]} 剩餘座位 $remaining </option>";
}

?>