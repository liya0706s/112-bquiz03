<?php $movie=$Movie->find($_GET['id']);?>
<div class="tab rb" style="width:87%;">
  <div style="background:#FFF; width:100%; color:#333; text-align:left">
    <video src="img/<?=$movie['trailer'];?>" width="300px" height="250px" controls="" style="float:right;"></video>
    <font style="font-size:24px">
        <img src="img/<?=$movie['poster'];?>" width="200px" height="250px" style="margin:10px; float:left">
      <p style="margin:3px">影片名稱 ：<?=$movie['name'];?>
        <input type="button" value="線上訂票" onclick="location.href='?do=order&id=<?=$movie['id'];?>'" style="margin-left:50px; padding:2px 4px" class="b2_btu">
      </p>
      <p style="margin:3px">影片分級 ： <img src="icon/03C0<?=$movie['level'];?>.png" style="display:inline-block;">限制級 </p>
      <p style="margin:3px">影片片長 ： <?=$movie['length'];?>分鐘</p>
      <p style="margin:3px">上映日期 ：<?=$movie['ondate'];?></p>
      <p style="margin:3px">發行商 ： <?=$movie['publish'];?></p>
      <p style="margin:3px">導演 ： <?=$movie['director'];?></p>
      <br>
      <br>
      <p style="margin:10px 3px 3px 3px; word-break:break-all"> 劇情簡介：<br>
      <?=$movie['intro'];?>
      </p>
    </font>
    <div class="ct">
        <button onclick="location.href='index.php'">院線片清單</button>
    </div>
  </div>
</div>