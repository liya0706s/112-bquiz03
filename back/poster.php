<style>
    .item {
        display: flex;
        padding: 3px;
        margin: 3px;
        justify-content: space-between;
        align-items: center;
    }

    .item div {
        width: 23%;
        margin: 0 0.25%;
        text-align: center;
    }
</style>

<div>
    <h3 class="ct">預告片清單</h3>
</div>

<div style="display: flex; justify-content:space-between; margin-bottom:8px">
    <div class="ct" style="width:23%; margin:0 0.25%">預告片海報</div>
    <div class="ct" style="width:23%; margin:0 0.25%">預告片片名</div>
    <div class="ct" style="width:23%; margin:0 0.25%">預告片排序</div>
    <div class="ct" style="width:23%; margin:0 0.25%">操作</div>
</div>

<!-- 傳送修改的路徑 -->
<form action="./api/edit_poster.php" method="post">
<div style="width:100%;height:190px;overflow:auto">
    <?php
    // 後台管理上傳後，資料表中"全部"都要顯示,如果是前台管理才要限定sh 
    // 預設排列由小到大
    $pos = $Poster->all(" order by rank");
    foreach ($pos as $idx => $po) {
    ?>
        <div class="item">
            <div>
                <!-- 圖片在$po的img的位置 -->
                <img src="./img/<?= $po['img']; ?>" style="width:60px; height:80px">
            </div>

            <div><input type="text" name="name[]" id="" value="<?= $po['name']; ?>"></div>
            <!-- 多筆資料一起送出所以name要加中括號陣列 -->
            
            <div>
                <input type="button" value="往上">
                <input type="button" value="往下">
            </div>
            
            <div>
                <!-- 隨便找個地方放hidden id才知道是要改哪筆資料 -->
                <input type="hidden" name="id[]" value="<?= $po['id']; ?>">
                <!-- input:checkbox*2+select>option*3 -->
                <!-- value是$po的id，才知道是哪一筆id被設定為顯示/刪除 -->
                <!-- $po的sh欄位==1代表顯示勾選 -->
                <input type="checkbox" name="sh[]" value="<?= $po['id']; ?>" <?= ($po['sh'] == 1) ? 'checked' : ''; ?>>顯示
                <input type="checkbox" name="del[]" value="<?= $po['id']; ?>">刪除
                <select name="ani" id="">
                    <!-- $po的ani是更改到哪個數字，就是哪個被選擇 -->
                    <option value="1" <?=($po['ani']==1)?'selected':'';?>>淡入淡出</option>
                    <option value="2" <?=($po['ani']==2)?'selected':'';?>>縮收</option>
                    <option value="3" <?=($po['ani']==3)?'selected':'';?>>滑入滑出</option>
                </select>
            </div>
        </div>
    <?php
    }
    ?>
</div>

<div class="ct">
    <input type="submit" value="編輯確定">
    <input type="reset" value="重置">
</div>
</form>
</div>

<hr>

<div>
    <h3 class="ct">新增預告片海報</h3>
    <form action="./api/add_poster.php" method="post" enctype="multipart/form-data">
        <table class="ts">
            <tr>
                <td class="ct">預告片海報</td>
                <td class="ct"><input type="file" name="poster" id=""></td>
                <td class="ct">預告片片名</td>
                <td class="ct"><input type="text" name="name" id=""></td>
            </tr>
        </table>
        <div class="ct">
            <input type="submit" value="新增">
            <input type="reset" value="重置">
        </div>
    </form>
</div>