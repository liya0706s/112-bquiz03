<style>
  .lists {
    position: relative;
    left: 114px;
    width: 200px;
    height: 240px;
    overflow: hidden;
  }

  .item * {
    box-sizing: border-box;
  }

  .item {
    width: 200px;
    height: 240px;
    margin: auto;
    box-sizing: border-box;
    display: none;
    position: absolute;
  }

  .item div img {
    width: 100%;
    height: 220px;
  }

  .item div {
    text-align: center;
  }

  .left,
  .right {
    width: 0;
    border: 20px solid black;
    border-top-color: transparent;
    border-bottom-color: transparent;
  }

  .left {
    border-left-width: 0;
  }

  .right {
    border-right-width: 0;
  }

  .btns {
    width: 360px;
    height: 100px;
    display: flex;
    overflow: hidden;
  }

  .btn img {
    width: 60px;
    height: 80px;
  }

  .btn {
    font-size: 12px;
    text-align: center;
    flex-shrink: 0;
    width: 90px;
    position: relative;
  }

  .controls {
    width: 420px;
    height: 100px;
    position: relative;
    margin-top: 10px;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
</style>
<div class="half" style="vertical-align:top;">
  <h1>預告片介紹</h1>
  <!-- 動畫控制 -->
  <div class="rb tab" style="width:95%;">
    <div class="lists">
      <?php
      // 1.撈資料
      $posters = $Poster->all(['sh' => 1], " order by rank");
      // 2. foreach 
      foreach ($posters as $idx => $poster) {
      ?>
        <div class="item" data-ani="<?= $poster['ani']; ?>">
          <div><img src="./img/<?= $poster['img']; ?>" alt=""></div>
          <div><?= $poster['name']; ?></div>
        </div>
      <?php
      }
      ?>
    </div>

    <div class="controls">
      <div class="left"></div>
      <div class="btns">
        <?php
        foreach ($posters as $idx => $poster) {
        ?>
          <div class="btn">
            <div><img src="./img/<?= $poster['img']; ?>"></div>
            <!-- 圖片 -->
            <div><?= $poster['name']; ?></div>
            <!-- 名稱 -->
          </div>
        <?php

        }
        ?>
      </div>
      <div class="right"></div>
    </div>
  </div>
</div>
<script>
  // 2024-01-15
  // 回乎函式，我做完之後才怎麼樣子

  // eq代表 位置在哪裡
  $(".item").eq(0).show();
  let total = $(".btn").length
  // 指定給一個變數
  let now = 0;
  let next = 0;
  let timer = setInterval(() => {
    slide()
  }, 3000)

  function slide(n) {
    // eq()隱藏全部,eq(1.2.3.4...)顯示按照順序
    let ani = $(".item").eq(now).data("ani");

    if (typeof(n) == 'undefined') {
      next = now + 1;
      if (next >= total) {
        next = 0;
      }
    } else {
      next = n;
    }

    switch (ani) {
      case 1:
        $(".item").eq(now).fadeOut(1000, function() {
          $(".item").eq(next).fadeIn(1000);
        });
        break;
      case 2:
        $(".item").eq(now).hide(1000, function() {
          $(".item").eq(next).show(1000);
        });
        break;
      case 3:
        $(".item").eq(now).slideUp(1000, function() {
          $(".item").eq(next).slideDown(1000);
        });
        break;
    }
    now = next;
  }

  // 全域變數，可以不停被改變
  let p = 0;
  // 限制p的最大值和最小值
  // 判斷p+-1會不會超過上限
  //  往左邊移動，與右邊的距離.. 
  $(".left,.right").on("click", function() {
    let arrow = $(this).attr('class')
    switch (arrow) {
      case "right":
        if (p + 1 <= (total - 4)) {
          p = p + 1;
        }
        break;
      case "left":
        if (p - 1 >= 0) {
          p = p - 1;
        }
        break;
    }
    $(".btn").animate({
      right: 90 * p
    })
  })

  $(".btn").on('click', function() {
    let idx = $(this).index()
    slide(idx);
  })

  $(".btns").hover(
    function() {
      clearInterval(timer)
      // hover in clearInterval(上方的timer變數)
    },
    function() {
      // 三秒後產生動畫
      timer = setInterval(() => {
        slide()
      }, 3000)
    }
  )
</script>

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
    margin: 0.5%;
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
      //今天的日期
      $today = date("Y-m-d");
      // 開始的時間今天往前算兩天
      $ondate = date("Y-m-d", strtotime("-2 days"));
      // 以上兩個變數也要搬到get_movies.php 


      $total = $Movie->count(" where `ondate`>='$ondate'  && `ondate` <='$today'  && `sh`=1");
      $div = 4;
      $pages = ceil($total / $div);
      $now = $_GET['p'] ?? 1;
      $start = ($now - 1) * $div;
      // 顯示排序過且三天內的前四筆影片
      $movies = $Movie->all(" where `ondate`>='$ondate'  && `ondate` <='$today'  && `sh`=1 order by rank limit $start,$div");
      // 以上get_movies.php也有用到
      foreach ($movies as $movie) {
      ?>
        <div class="movie">
          <div style="width:35%">
            <!-- 連結可以看詳細資料帶自己的id -->
            <a href='?do=intro&id=<?= $movie['id']; ?>'>
              <img src="./img/<?= $movie['poster']; ?>" style="width:60px;border:3px solid white">
            </a>
          </div>
          <div style="width:65%">
            <div><?= $movie['name']; ?></div>
            <div style="font-size:13px;">分級: <img src="./icon/03C0<?= $movie['level']; ?>.png" style="width:20px"></div>
            <div style="font-size:13px;">上映日期:<?= $movie['ondate']; ?></div>
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