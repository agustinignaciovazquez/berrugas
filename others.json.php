<?php
/*
PROYECTO BERRUGAS
PROGRAMADO POR kRAKARG
*/
//OTHERS JSON
require('incs1/MySQL-DB.php');
require('incs1/shortURL.php');
if(isset($_GET['c'],$_GET['id']) && ctype_digit($_GET['id'])){
$id = (int)$_GET['id'];
$query = mysqli_query($link,"SELECT mensaje,autor FROM topics WHERE id='$id';");
$fetch = mysqli_fetch_row($query);
if(strlen($fetch[0]) >= 60){
$jsondata[0] = substr($fetch[0],0,60).'...';
}else{
$jsondata[0] = $fetch[0];
}
$jsondata[] = short_url('http://berrugas.com.ar/?id='.$id);
//$jsondata[] = 'http://berrugas.com.ar/?id='.$id;
$jsondata[] = $fetch[1];
echo json_encode($jsondata);
}
$link->close();
?>