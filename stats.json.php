<?php
/*
PROYECTO BERRUGAS
PROGRAMADO POR kRAKARG
*/
require('incs1/MySQL-DB.php');
session_set_cookie_params(1209600);
session_start();
$num = array();
if(isset($_GET['ids'])){
if(!ctype_digit($_GET['ids'])){
$query = mysqli_query($link,"SELECT id,longname FROM schools ORDER BY `schools`.`cantidad`  DESC;");
$fetch = mysqli_fetch_row($query);
$num[0][] = 'todas las escuelas';
$num[1][] = mysqli_num_rows(mysqli_query($link,"SELECT id FROM topics;"));
$num[1][] = 'Total mensajes';
$num[2][] = mysqli_num_rows(mysqli_query($link,"SELECT id  FROM `topics` WHERE `imagen` != ''"));
$num[2][] = 'Imagenes subidas';
$num[3][] = $fetch[1];
$num[3][] = 'Escuela mas popular';
//ESTO SIEMPRE ULTIMO PLIS
if(isset($_SESSION['escuelas'])){
arsort($_SESSION['escuelas']);
$schoolid = list($clave, $valor) = each($_SESSION['escuelas']);
$query = mysqli_query($link,"SELECT longname FROM schools WHERE id='$clave';");
$fetch = mysqli_fetch_row($query);
$num[4][] = $fetch[0];
$num[4][] = 'Tu favorita';
}
}else{
$schoolid = mysqli_real_escape_string($link,$_GET['ids']);
$query = mysqli_query($link,"SELECT id,longname FROM schools WHERE id='$schoolid';");
$fetch = mysqli_fetch_row($query);
$num[0][] = '('.$fetch[1].')';
$num[1][] = mysqli_num_rows(mysqli_query($link,"SELECT id FROM topics WHERE idschool='$schoolid';"));
$num[1][] = 'Cantidad mensajes';
$num[2][] = mysqli_num_rows(mysqli_query($link,"SELECT id  FROM `topics` WHERE `imagen` != '' AND idschool='$schoolid'"));
$num[2][] = 'Imagenes subidas';
if(isset($_SESSION['escuelas'])){
$num[3][] = $_SESSION['escuelas'][$schoolid];
$num[3][] = 'Tus visitas';
}
}
}
echo json_encode($num);
$link->close();
?>