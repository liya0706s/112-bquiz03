<?php include_once "db.php";

// 假設一定有$POST id 
foreach($_POST['id'] as $idx => $id){
    // 如果有存在$POST del也跟正在跑的$id一樣在陣列中，就把資料刪除
    if(isset($_POST['del']) && in_array($id,$_POST['del'])){
        $Poster->del($id);
    }else{
        $row=$Poster->find($id);  // 一筆筆做修改
        // id有沒有在checkbox裡面判斷有沒有要刪除和顯示，如果有就要顯示記為1否則為0
        $row['sh']=(isset($_POST['sh']) && in_array($id,$_POST['sh']))?1:0;
        $row['name']=$_POST['name'][$idx];
        $row['ani']=$_POST['ani'][$idx];
        $Poster->save($row);
    }
}

to("../back.php?do=poster")

?>