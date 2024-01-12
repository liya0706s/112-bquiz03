<button onclick="location.href='?do=add_movie'">新增電影</button>
<!-- 當前頁傳值$_GET['do'] -->
<hr>
<style>
    .item div {
        box-sizing: border-box;
        color: black;
    }

    .item {
        background-color: white;
        width: 100%;
        display: flex;
        /* 最外圈多padding */
        padding: 3px;
        margin: 3px 0;
        box-sizing: border-box;
    }


    /* .item底下的第一個div(圖片區) */
    .item>div:nth-child(1) {
        width: 15%;
    }

    .item>div:nth-child(2) {
        width: 12%;
    }

    .item>div:nth-child(3) {
        width: 73%;
    }
</style>

<!-- 包在迴圈外層 -->
<div style="width:100%;overflow:auto;height:415px">
    <?php
    // 全部的資料拿出來，照順序排列
    $movies = $Movie->all(" order by rank");
    foreach ($movies as $idx=>$movie) {
        // $idx計算上一筆和下一筆
        // $movie我自己的資料 和 $movies整個陣列的資料
    ?>

        <!-- div.item>div*3 -->
        <!-- 3 1 div*3 -->
        <div class="item">
            <!-- 圖片 -->
            <div>
                <img src="./img/<?= $movie['poster']; ?>" style="width:100%;">
            </div>
            <!-- 分級 -->
            <div>
                分級:
                <img src="./icon/03C0<?= $movie['level']; ?>.png" style="width:25px">
            </div>
            <div>
                <div style="display:flex;width:100%">
                    <div style="width:33.33%">片名:
                        <?= $movie['name']; ?>
                    </div>
                    <div style="width:33.33%">片長:
                        <?= $movie['length']; ?>
                    </div>
                    <div style="width:33.33%">上映日期:
                        <?= $movie['ondate']; ?>
                    </div>
                </div>
                <!-- 按鈕 -->
                <div>
                    <!--按鈕代表現在的狀況，現在顯示的是跟資料庫一樣的 -->
                    
                    <button data-id="<?=$movie['sh'];?>" <?=($movie['show']==1)'顯示':'隱藏';?>> </button>
                    <button>往上</button>
                    <button>往下</button>
                    <button class="" data-id="">編輯電影</button>
                    <button class="" data-id="">刪除電影</button>

                </div>
                <div>
                    劇情介紹:
                    <?= $movie['intro']; ?>
                </div>
            </div>
        </div>
<script>
    $(.)
</script>


    <?php
    }
    ?>