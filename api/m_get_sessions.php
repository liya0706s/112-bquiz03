<?php include_once 'db.php';
$movie=$_GET['movie'];
$movieName=$Movie->find($movie)['name'];
$date=$_GET['date'];
$H=date("G");
$start=($H>=14 && $date==date("Y-m-d"))?7-ceil((24-$H)/2):1;

for($i=$start;$i<=5;$i++){
    /***
     * 1. 去資料表撈出電影,日期,場次的訂單
     * 2. 根據訂單,計算座位數
     * 3. 在迴圈使用20-座位數來取得剩餘座位數
     */
    $qt=$Order->sum('qt',['movie'=>$movieName,'date'=>$date,'session'=>$sess[$i]]);
    $lave=20-$qt;
    echo "<option value='{$sess[$i]}'>{$sess[$i]} 剩餘座位 $lave</option>";
}

?>
