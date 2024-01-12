<button onclick="location.href='?do=add_movie'">新增電影</button>
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
        padding: 3px;
        box-sizing: border-box;
        margin: 3px 0;
    }

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

<div style="width:100%;height:415px;overflow:auto">
    <?php
    $movies = $Movie->all(" order by rank");
    foreach ($movies as $idx => $movie) {
    ?>

        <div class="item">
            <div>
                <img src="./img/<?= $movie['poster']; ?>" style="width:100%">
            </div>
            <div>
                分級:<img src='./icon/03C0<?= $movie['level']; ?>.png' style='width:25px'>
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
                        上映時間:<?= $movie['ondate']; ?>
                    </div>
                </div>
                <div>
                    <button class='show-btn' data-id="<?= $movie['id']; ?>"><?= ($movie['sh'] == 1) ? '顯示' : '隱蔵'; ?></button>
                    <button class='sw-btn' data-id="<?= $movie['id']; ?>" data-sw="<?= ($idx !== 0) ? $movies[$idx - 1]['id'] : $movie['id']; ?>">往上</button>
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
</div>
<script>
    $(".show-btn").on("click", function() {
        let id = $(this).data('id');
        $.post("./api/show.php", {
            id
        }, () => {
            location.reload()
            //$(this).text(($(this).text()=='顯示')?"隱藏":"顯示");
            /*         switch($(this).text()){
                        case "隱藏":
                            $(this).text("顯示")
                        break;
                        case "顯示":
                            $(this).text("隱藏")
                        break;
                    } */
        })
    })
    $(".sw-btn").on("click", function() {
        let id = $(this).data('id');
        let sw = $(this).data('sw');
        let table = 'movie'
        $.post("./api/sw.php", {
            id,
            sw,
            table
        }, () => {
            location.reload()
        })
    })
    $(".edit-btn").on("click", function() {

    })
    $(".del-btn").on("click", function() {
        let id = $(this).data('id');
        $.post("./api/del.php", {id,table: 'movie'}, () => {
            location.reload();
        })
    })
</script>