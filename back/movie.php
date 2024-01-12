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
    // dd($movies);
    foreach ($movies as $idx => $movie) {
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
                分級:<img src="./icon/03C0<?= $movie['level']; ?>.png" style="width:25px">
            </div>
            <div>
                <div style="display:flex;width:100%">
                    <div style="width:33.33%">
                        片名:<?= $movie['name']; ?>
                    </div>
                    <div style="width:33.33%">
                        片長:<?= $movie['length']; ?>
                    </div>
                    <div style="width:33.33%">
                        上映日期:<?= $movie['ondate']; ?>
                    </div>
                </div>
                <!-- 按鈕 -->
                <div>
                    <!--按鈕代表現在的顯示與否狀況，現在顯示的是跟資料庫一樣的 -->
                    <button class="show-btn" data-id="<?= $movie['id']; ?>">
                    <?= ($movie['sh'] == 1) ? '顯示' : '隱藏'; ?></button>
                    <button class="sw-btn" data-id="<?= $movie['id']; ?>" data-sw="<?= ($idx !== 0) ? $movies[$idx - 1]['id'] : $movie['id']; ?>">
                        <!-- 如果idx不是0代表不是在位置第一個，就要將順序往上idx-1,否則就留在原地$movie的id -->
                        往上</button>
                    <button class='sw-btn' data-id="<?= $movie['id']; ?>" data-sw="<?= ((count($movies) - 1) != $idx) ? $movies[$idx + 1]['id'] : $movie['id']; ?>">往下</button>
                    <button class="edit-btn" data-id="<?= $movie['id']; ?>">編輯電影</button>
                    <button class="del-btn" data-id="<?= $movie['id']; ?>">刪除電影</button>
                </div>
                <div>
                    劇情介紹:<?= $movie['intro']; ?>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
    <script>
        // 顯示切換
        $(".show-btn").on("click", function() {
            // 拿到的id
            let id = $(this).data('id');
            // 拿到後端
            $.post("./api/show.php", {
                id
            }, () => {
                location.reload();
                // $(thie).text($(thie).text=='顯示'?'隱藏':'顯示');
                // switch ($(this).text) {
                //     // 這個的文字
                //     case '隱藏': //現在是隱藏要改成顯示
                //         $(this).text('顯示');
                //         break;
                //     case '顯示':
                //         $(this).text('隱藏');
                //         break;
                // }
            })
        })

        // 排序切換功能
        $(".sw-btn").on("click", function() {
            let id = $(this).data('id');
            let sw = $(this).data('sw');
            let table = 'movie'
            // 這個項目的id 和交換的項目的id
            // 還要帶參數table不同頁(電影院線片)都要一起控制
            $.post("./api/sw.php", {
                id,
                sw,
                table
            }, () => {
                location.reload();
            })
        })

        $(".edit-btn").on("click", function() {
            let id=$(this).data('id');
            // 這個的data的id
            location.href=`?do=edit_movie&id=${id}`;
            // 重音符可以混合使用一班字串和變數${id}
        })

        // 刪除院線片功能
        $(".del-btn").on("click", function() {
            let id = $(this).data('id');
            $.post("./api/del.php", {
                id,
                table: 'movie'
            }, () => {
                location.reload();
            })
        })
    </script>