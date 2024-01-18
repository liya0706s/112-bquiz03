<?php include_once 'db.php';
$today = date("Y-m-d");
$ondate = date("Y-m-d", strtotime("-2 days"));
$movies = $Movie->all(" where `ondate`>='$ondate'  && `ondate` <='$today'  && `sh`=1 order by rank");

foreach ($movies as $movie) {
    echo "<option value='{$movie['id']}'>{$movie['name']}</option>";
}
