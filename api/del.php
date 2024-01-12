<?php
include_once "db.php";
// POST table 從movie scirpt .del-btn來的
$DB=new DB($_POST['table']);
$DB->del($_POST['id']);