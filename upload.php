<?php
/*
PROYECTO BERRUGAS
PROGRAMADO POR kRAKARG
*/
session_set_cookie_params(1209600);
session_start();
?>
<html>
<head>
<title>kRAK uploading</title>
<script type="application/javascript" src="js/jquery-1.7.2.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
body,td,th {
	color: #000;
}
body {
	background-color: #F0EFF0;
	background-image: url(images/bg2.png);
	background-repeat: repeat-x;
	text-align:center;
}
a:link {
	color: #C00;
}
a:visited {
	color: #C00;
}
a:hover {
	color: #C33;
}
a:active {
	color: #C33;
}
</style>
</head>
<body>
<div style="border:1px solid #000;margin:50px auto 0 auto;width:80%;background-color:#FFF;font-size:27px;text-aling:center;">
<?php
/*<div class="icantstop"><form id="form1" name="form1" method="post" action="/upload"><span>DEJA UN MENSAJE $NOMBRE</span><br /><em>Colegio:</em><select name="schools" style="width:125px;"><?php 
?></select><br /><textarea name="fuck" onkeypress="return imposeMaxLength(this, 250);"></textarea><br /><input name="upload" type="file" /><em>(Opcional)</em><br /><img src="captcha.png" width="150" height="50" alt="captcha" /><br /><input name="captcha" style="margin:1px;" type="text" /><br /><input name="Ok" type="submit" value="Enviar je" /><br /></form></div>*/
include('incs1/MySQL-DB.php');
if(isset($_POST['captcha'],$_POST['fuck'],$_POST['schools'],$_SESSION['captcha']) && strtolower($_POST['captcha']) == $_SESSION['captcha'] && ctype_digit($_POST['schools'])){
if(isset($_POST['nombre']) && !empty($_POST['nombre']) && strlen($_POST['nombre']) <= 20){
$_SESSION['user'] = addslashes(htmlspecialchars(mysqli_real_escape_string($link,$_POST['nombre'])));
}elseif(!isset($_SESSION['user'])){
die('Te falto el nombre pa');
}
$text = mysqli_real_escape_string($link,addslashes(htmlspecialchars($_POST['fuck'])));
$school = mysqli_real_escape_string($link,$_POST['schools']);
$ip = $_SERVER['REMOTE_ADDR'];
$name = $_SESSION['user'];
$numsc = mysqli_num_rows(mysqli_query($link,"SELECT school FROM schools WHERE id='$school';"));
if($numsc == 0){die('Esa escuela no existe capo');}
if(strlen($text) >= 251 or empty($text)) die('Por favor corrija su texto.');
if(is_uploaded_file($_FILES['upload']['tmp_name'])){
$image = uniqid();
$ext = strtolower(end(explode('.',$_FILES['upload']['name'])));
if($ext == 'jpg' or $ext == 'jpeg' or $ext == 'png' or $ext == 'gif'){
$image = $image.'.'.$ext;
if(!move_uploaded_file($_FILES['upload']['tmp_name'],"uploads/".$image)){
die('Ha ocurrido un error, intente denuevo');
}
}else{
die('Extension invalida');
}
}else{
$image = '';
}
if($link->query("INSERT INTO `topics` (`id`, `idschool`, `fecha`, `autor`, `mensaje`, `imagen`, `ip`) VALUES (NULL, '$school', CURRENT_TIMESTAMP, '$name', '$text', '$image', inet_aton('$ip'));")){
$link->query("UPDATE schools SET cantidad=cantidad+1 WHERE id = '$school';");
echo "Se ha publicado correctamente $image <a href='/?idschool=".$_POST['schools']."'>haga click aqui para volver!</a>  o espere a ser redireccionado.";
$link->close();
}else{
echo "Ha ocurrido un error, intente denuevo.";
}
unset($_SESSION['captcha']);
}else{
echo "El captcha es incorrecto ";
if(isset($_POST['schools'])){
echo " <a href='/?idschool=".$_POST['schools']."'>haga click aqui para volver</a> o espere a ser redireccionado.";
}
}
?>
</div>
<script type="text/javascript">
function redireccionar(){
window.location=$('a:first').attr('href');
} 
setTimeout ("redireccionar()", 15000); //tiempo expresado en milisegundos
</script>
</body>
</html>