<div class="half" style="vertical-align:top;">
  <h1>預告片介紹</h1>
  <div class="rb tab" style="width:95%;">
    <div id="abgne-block-20111227">
      <ul class="lists">
      </ul>
      <ul class="controls">
      </ul>
    </div>
  </div>
</div>

<style>
  .movies {
    display: flex;
    flex-wrap: wrap;
  }

  .movie {
    display: flex;
    flex-wrap: wrap;
    box-sizing: border-box;
    /* 不受到padding的影響 */
    padding: 2px;
    margin: 0.25%;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 49%;
  }
</style>

<div class="half">
  <h1>院線片清單</h1>
  <div class="rb tab" style="width:95%;">
    <div class="movies">
      <!-- 顯示排序過且三天內的前四筆影片 -->
      <?php
      $today = date("Y-m-d");  //今天的日期
      // 開始的時間今天往前算兩天
      $ondate = date("Y-m-d", strtotime("-2 days"));
      $total = $Movie->count(" where `ondate`>='$ondate' && `ondate` <='$today' && `sh`=1");
      $div = 4;
      $pages = ceil($total / $div);
      $now = $_GET['p'] ?? 1;
      $start = ($now - 1) * $div;
      // 顯示排序過且三天內的前四筆影片
      $movies = $Movie->all(" where `ondate`>='$ondate' && `ondate` <='$today' && `sh`=1 order by rank limit $start,$div");
      foreach ($movies as $movie) {
      ?>
        <div class="movie">
          <div style="width:35%">
            <!-- 連結可以看詳細資料帶自己的id -->
            <a href="?do=intro&id=<?= $movie['id']; ?>">
              <img src="./img/<?= $movie['poster']; ?>" style="width:60px;border:3px white">
            </a>
          </div>
          <div style="width:65%">
            <div><?= $movie['name']; ?></div>
            <div style="font-size:13px;">分級:
              <img src="./icon/03C0<?= $movie['level']; ?>.png" style="width:20%">
            </div>
            <div style="font-size:13px;">上映日期:
              <?= $movie['ondate']; ?>
            </div>
          </div>
          <div style="width:100%">
            <button onclick="location.href='?do=intro&id=<?= $movie['id']; ?>'">劇情介紹</button>
            <button onclick="location.href='?do=order&id=<?= $movie['id']; ?>'">線上訂票</button>
          </div>
        </div>
      <?php
      }
      ?>
    </div>
    <div class="ct">
      <?php
      if ($now - 1 > 0) {
        $prev = $now - 1;
        echo "<a href='?p=$prev'> < </a>";
      }

      for ($i = 1; $i <= $pages; $i++) {
        echo "<a href='?p=$i'> $i </a>";
      }

      if ($now + 1 <= $pages) {
        $next = $now + 1;
        echo "<a href='?p=$next'> > </a>";
      }

      ?>
    </div>
  </div>
</div>