<?php
/*
PROYECTO BERRUGAS
PROGRAMADO POR kRAKARG
MODULO AJAX PARA CARGAR TEMAS DE CADA ESCUELA
*/
include('incs1/MySQL-DB.php');
session_set_cookie_params(1209600);
session_start();
$nmsgs = 30;
$jsondata = array();
//PAGINAS VARIABLE
if(isset($_GET['p']) && ctype_digit($_GET['p'])){
$n = $_GET['p'] * $nmsgs;
}else{
$n = 0;
}
//FIN
//ACA SE INICIA SESSION DE LAS VISITAS
$query = $link->query('SELECT id,longname FROM schools;');
$num = mysqli_num_rows($query);
$i = 1;
if(!isset($_SESSION['escuelas'])){
$_SESSION['escuelas'] = array();
while($school = $query->fetch_row()){
$_SESSION['escuelas'][$i] = 0; 
$i++;
}
}elseif(count($_SESSION['escuelas']) !== $num){
while($school = $query->fetch_row()){
if(isset($_SESSION['escuelas'][$i]) && $_SESSION['escuelas'][$i] > 0){
$visitas = $_SESSION['escuelas'][$i];
}else{
$visitas = 0;
}
$_SESSION['escuelas'][$i] = $visitas; 
$i++;
}
}
//FIN
if(isset($_GET['school'],$_GET['ord']) && !ctype_digit($_GET['school']) && $_GET['school'] !== 'todos'){
if($_GET['ord'] == 'normalito'){
$a = $link->query('SELECT longname,id FROM schools ORDER BY `cantidad` DESC;');
}else{
$a = $link->query('SELECT longname,id FROM schools ORDER BY `school` ASC');
}
$i = 0;
if(isset($_SESSION['escuelas']) && $_GET['ord'] == 'visitas'){
arsort($_SESSION['escuelas']);
foreach($_SESSION['escuelas'] as $clave => $visitas){
$jsondata[$i][] = $visitas;
$jsondata[$i][] = $clave;
$i++;
}
}else{
while($topic = $a->fetch_row()){
if($topic[1] !== '1'){
foreach($topic as $row){
$jsondata[$i][] = $row;
}
}
$i++;
}
$jsondata[$i] = array('others','1');
}
}elseif(isset($_GET["lastm"],$_GET['school']) && ctype_digit($_GET['lastm'])){
//ACA CARGAR MENSAJES NUEVOS (AJAX)
$cc = (int) $_GET["lastm"];
if(isset($_GET['update'])){
$i = 0;
if(ctype_digit($_GET['school'])){
$school = (int) $_GET['school'];
$query = mysqli_query($link,"SELECT fecha,autor,mensaje,imagen,id,idschool FROM topics WHERE idschool = '$school' AND `id` > $cc ORDER BY `id` ASC;");
}elseif($_GET['school'] == 'todos'){
$query = mysqli_query($link,"SELECT fecha,autor,mensaje,imagen,id,idschool FROM topics WHERE `id` > $cc ORDER BY `id` ASC;");
}
while($topic = mysqli_fetch_row($query)){
foreach($topic as $row){
$jsondata[$i][] = $row;
}
$i++;
}
}else{
//ACA EL NUMERO DE MENSAJES NUEVOS (AJAX)
if(ctype_digit($_GET['school'])){
$school = (int) $_GET['school'];
$query = mysqli_query($link,"SELECT id FROM `topics` WHERE idschool='$school' ORDER BY `id` ASC;");
}elseif($_GET['school'] == 'todos'){
$query = mysqli_query($link,"SELECT fecha,autor,mensaje,imagen,id,idschool FROM topics ORDER BY `id` ASC;");
}
$ultimon = mysqli_num_rows($query);
$jsondata[0][] = $ultimon;
}
}elseif(isset($_GET['search'],$_GET['school'])){
//ACA BUSQUEDA
$search = mysqli_real_escape_string($link,$_GET['search']);
if(ctype_digit($_GET['school'])){
$school = (int) $_GET['school'];
$query = mysqli_query($link,"SELECT fecha,autor,mensaje,imagen,id,idschool  FROM `topics` WHERE `idschool` = '$school' AND `mensaje` LIKE '%$search%' ORDER BY `id` DESC ;");
$num = mysqli_num_rows($query);
$query = mysqli_query($link,"SELECT fecha,autor,mensaje,imagen,id,idschool  FROM `topics` WHERE `idschool` = '$school' AND `mensaje` LIKE '%$search%' ORDER BY `id` DESC  LIMIT $n,$nmsgs;");
}else{
$query = mysqli_query($link,"SELECT fecha,autor,mensaje,imagen,id,idschool FROM  `topics` WHERE  `mensaje` LIKE  '%$search%' ORDER BY `id` DESC;");
$num = mysqli_num_rows($query);
$query = mysqli_query($link,"SELECT fecha,autor,mensaje,imagen,id,idschool FROM  `topics` WHERE  `mensaje` LIKE  '%$search%' ORDER BY `id` DESC LIMIT $n,$nmsgs;");
}
$jsondata[0][] = $num;
$i = 1;
while($r = mysqli_fetch_row($query)){
foreach($r as $row){
$jsondata[$i][] = $row;
}
$i++;
}
}elseif(isset($_GET['school']) || isset($_GET['idun'])){
//ACA CARGA MENSAJES PRINCIPAL
if(isset($_GET['school'])){
if(ctype_digit($_GET['school'])){
$school = (int) $_GET['school'];
$query = mysqli_query($link,"SELECT fecha,autor,mensaje,imagen,id,idschool FROM topics WHERE idschool = '$school' ORDER BY `id` DESC LIMIT $n,$nmsgs;");
//VERIFICACION SI EXISTE ESCUELA
$num = mysqli_num_rows($query);
if(isset($_SESSION['escuelas']) && $num !== 0){
$_SESSION['escuelas'][$school]++;
}
}elseif($_GET['school'] == 'todos'){
$query = mysqli_query($link,"SELECT fecha,autor,mensaje,imagen,id,idschool FROM topics ORDER BY `id` DESC LIMIT $n,$nmsgs;");
}
}elseif(isset($_GET['idun']) && ctype_digit($_GET['idun'])){
$idun = (int) $_GET['idun'];	
$query = mysqli_query($link,"SELECT fecha,autor,mensaje,imagen,id,idschool FROM topics WHERE id='$idun' LIMIT 0,1;");
}
$i = 0;
while($topic = mysqli_fetch_row($query)){
foreach($topic as $row){
$jsondata[$i][] = $row;
}
$i++;
}
}
echo json_encode($jsondata);
$link->close();
?>
