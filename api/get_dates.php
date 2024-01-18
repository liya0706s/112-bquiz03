<?php include_once 'db.php';

//  1.ondate, ondate+1, ondate+2
//  2.上映日，要大於今天，加今天有三天

$movie = $_GET['id'];
$ondate = strtotime($Movie->find($movie)['ondate']);
// 結束日會在三天後
$end = strtotime("+2 days", $ondate);
$today = strtotime(date("Y-m-d"));
// 結束日和今天，差距多少天 (除以一天的秒數) 
$diff = ($end - $today) / (60 * 60 * 24);
// 13 14 15 (15-13=2days) diff最小是0
for ($i = 0; $i <= $diff; $i++) {
    // 從今天開始還可以跑幾天的時間
    $date = date("Y-m-d", strtotime("+$i days"));
    echo "<option value='$date'>$date</option>";


    // for($i=0;$i<$diff;$i++){
    //     // 從今天開始還可以跑幾天的時間
    //     $date=date("Y-m-d",strtotime("+$i days"));
    //     echo "<option value='$date'> $date </option>";
    // }

    // 如果日期$date大於等於今天日期是可以show
    // $date=strtotime("+$i days",strtotime($ondate));
    // if($date>=strtotime($today)){
    //     $str=date("Y-m-d",$date);  //$string
    //     echo "<option value='{$str}'> $str </option>"
    // }
}
