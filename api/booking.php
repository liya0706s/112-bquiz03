<?php
include_once "db.php";
// order movie_id當key 
// $movie_id=$_GET['movie_id'];
$movie = $Movie->find($_GET['movie_id']);
$date = $_GET['date'];
$session = $_GET['session'];



?>

<style>
    #room {
        background-image: url('./icon/03D04.png');
        background-position: center;
        background-repeat: none;
        width: 540px;
        height: 370px;
        margin: auto;
        box-sizing: border-box;
        /* 不會因為padding被影響box-sizing */
        padding: 19px 112px 0 112px;
        /* STAGE的高度19 寬112 上方0 */
    }

    .seat {
        width: 63px;
        height: 85px;
        position: relative;
/* 相對椅子 */
    }

    .seats {
        display: flex;
        flex-wrap: wrap;
    }

    .chk{
        position: absolute;
        /* 絕對位置 */
        right:1px;
        bottom:2px;
    }
</style>
<div id="room">
    <div class="seats">
        <?php
        // 20個座位
        for ($i = 0; $i < 20; $i++) {
            echo "<div class='seat'>";
            echo "<div class='ct'>";
            echo floor($i / 5) + 1 . "排";   // 無條件捨去
            echo (($i % 5) + 1) . "號";
            echo "</div>";
            echo "<div class='ct'>";
            echo "<img src='./icon/03D02.png'>";  // 空座位
            echo "</div>";
            echo "<input type='checkbox' name='chk' value='$i' class='chk'>";  // 用絕對定位讓checkbox放在特定位置
            echo "</div>";
        }
        ?>
    </div>
</div>
<div id="info">
    <div>您選擇的電影是：<?= $movie['name']; ?></div>
    <div>您選擇的時刻是：<?= $date; ?> <?= $session; ?></div>
    <div>您已經勾選<span id='tickets'>0</span>張票，最多可以購買四張票</div>
    <button onclick="$('#select').show();$('#booking').hide()">上一步</button>
    <button>訂購</button>
</div>
</div>