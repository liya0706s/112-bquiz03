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

    .chk {
        position: absolute;
        /* 絕對位置 */
        right: 1px;
        bottom: 2px;
    }
</style>
<div id="room">
    <div class="seats">
        <?php
        // 20個座位
        for ($i = 0; $i < 20; $i++) {
            echo "<div class='seat'>";
            echo "<div class='ct'>";
            echo (floor($i / 5) + 1) . "排";   // 無條件捨去
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
    <button onclick="checkout()">訂購</button>
</div>
</div>

<script>
    // 變數儲存勾選的內容，新的空陣列
    // 宣告一個全域變數seats，用於儲存被勾選的座位，初始為一個空陣列
    let seats = new Array(); // 使用 new Array() 創建一個新的陣列物件(物件帶有方法)

    // 狀態被改變，變成checked
    $(".chk").on("change", function() {
        // 1.座位狀態是有被勾選 2.幾張票 3.能否再勾選
        // 只有在勾選true才要在陣列中;取消勾選時，不增加也要減少
        if ($(this).prop('checked')) {
            if (seats.length + 1 <= 4) {
                seats.push($(this).val())
            } else {
                $(this).prop('checked', false)
                alert("每個人只能勾選四張票")
            }

        } else {
            // 若勾選框被取消勾選，則從陣列中移除該座位
            seats.splice(seats.indexOf($(this).val()), 1)
        }

        // console.log($(this).prop('checked'), $(this).val());
        $("#tickets").text(seats.length) // 計算陣列個數，勾選了幾張票

    });

    // 寫入的參數key是order資料表的欄位
    // 上方按下訂購checkout()
    function checkout() {
        $.post("./api/checkout.php", {
                movie: '<?= $movie['name']; ?>',
                date: '<?= $date; ?>',
                session: '<?= $session; ?>',
                qty: seats.length,
                seats
            },
            (no) => {
                location.href = `?do=result&no=${no}`;
            })

    }
</script>