<?php
/*
PROYECTO BERRUGAS
PROGRAMADO POR kRAKARG
*/
session_set_cookie_params(1209600);
session_start();
require('incs1/MySQL-DB.php');
//ASIGNACION COLOR VO
if(isset($_GET['color'])){
if($_GET['color'] == 'rico'){
$_SESSION['color'] = 'true';
}elseif($_GET['color'] == 'pobre'){
$_SESSION['color'] = 'false';
}
}elseif(!isset($_SESSION['color'])){
$_SESSION['color'] = 'true';
}
//ORDENAR VO
if(isset($_GET['ordenar'])){
if($_GET['ordenar'] == 'normalito' || $_GET['ordenar'] == 'visitas'){
$_SESSION['ord'] = $_GET['ordenar'];
}else{
$_SESSION['ord'] = 'alf';	
}
}elseif(!isset($_SESSION['ord'])){
$_SESSION['ord'] = 'alf';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Berrugas - Enterate de todo</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script type="application/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="application/javascript" src="js/scary.js"></script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36065022-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<?php
echo '<meta name="description" content="';
if(isset($_GET['id']) && ctype_digit($_GET['id'])){
$id = (int)$_GET['id'];
$query = mysqli_query($link,"SELECT mensaje,autor,imagen,idschool FROM topics WHERE id='$id';");
$fetch = mysqli_fetch_row($query);
echo $fetch[1].' ha publicado en Berrugas: '.$fetch[0].'" />'."\n";
if($fetch[2] !== ''){
echo '<link rel="image_src" href="uploads/'.$fetch[2].'" />'."\n";
}else{
echo '<link rel="image_src" href="images/bgschools/'.$fetch[3].'.png" />'."\n";
}
}else{
echo 'Red social dedicada unica y exclusivamente a las escuelas - kRAK Production" />'."\n".'<link rel="image_src" href="images/contame.png" />'."\n";
}
?>
<meta name="keywords" content="berrugas, krak, chismes, escuelas, colegios, zona, sur, quilmes, manuel, belgrano, cimdip, buckingham, red, social, anonima" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
</head>
<body>
<div id="negrodemierda"><div id="compartir">Compartir publicacion:<em id="close">[cerrar]</em><table width="95px" style="margin:3px;" border="0">
  <tr>
    <td id="fbc">&nbsp;</td>
  </tr>
  <tr>
    <td id="twc" style="background-position:-95px 0;">&nbsp;</td>
  </tr>
</table>
<div id="link">URL de la publicacion:<br /><input name="" id="larga" type="text" onkeypress="return false;" onkeydown="return false;" /><br />URL acortada:<br /><input name="" onkeypress="return false;" onkeydown="return false;" id="corta" type="text" /></div>
</div></div><div id="head"><div id="fix"><div id="logo"></div><div id="stats">Estadisticas:</div></div><div id="tw" class="social"></div><div class="social" id="fb"></div></div>
<div id="centro"><div style="margin:0 auto 0 auto;width:95%;"><div id="ble"><div class="botones" id="normal"></div><div class="botones" id="ultimos" style="margin-left:38px;"></div><div id="imagenes" class="botones" style="margin-left:74px;"></div></div><div id="buscar"><form action="/" method="get"><input name="search" class="buscar" type="text" /><select id="schoolsb" style="width:35%;" class="buscar" name="schools"><option id="0" value="todos">Todos</option><?php 
$schools = $link->query("SELECT id,longname FROM schools WHERE id >'1' ORDER BY `longname` ASC;");
while($school = $schools->fetch_row()){
echo '<option class="'.$school[0].'" value="'.$school[0].'">'.$school[1].'</option>';
}
?><option class="1" value="1">Otras</option></select><input style="width:27px;height:27px;background-image:url(../images/searchico.png);cursor:pointer;padding-top:2px;border-radius:3px;" class="buscar" name="ok" type="submit" value=" "/></form></div></div><div id="pplarestrange"><img src="images/loading.gif" width="32" height="32" alt="Cargando ..." align="middle"/>
</div></div><div class="abajo" style="border:0 solid #000;border-width:0 1px 1px 1px;"><span>Berrugas, como tambien los dueños del sitio no se haran responsables por los mensajes y/o imagenes publicadas, el autor original de la publicacion en cuestion debera asumir total responsabilidad sobre sus actos.</span></div><!-- Cualquier duda contactarse krakarg@live.com-->
<div id="follow"></div>
<div id="msg">UNDEFINED</div> 
</body>
<script>
var ultimateid,numeron,tmp,jinglebells,alls,schoolb,bg,corta,mensaje,bid,larga;
var cargaraj = true;
var psearch = 0;
var todo = false;
<?php 
if(isset($_GET['idschool']) && ctype_digit($_GET['idschool'])){
$query = mysqli_query($link,"SELECT id FROM `topics` WHERE idschool='".$_GET['idschool']."' ORDER BY `id` ASC;");
$firstid = mysqli_fetch_row($query);
$ultimoid = mysqli_num_rows($query);
$query = mysqli_query($link,"SELECT id FROM `topics` WHERE idschool='".$_GET['idschool']."' ORDER BY `id` DESC;");
$ultimateid = mysqli_fetch_row($query);
echo "\nultimateid = '".$ultimateid[0]."'\nvar ultimol = '".$firstid[0]."';\nvar primerol = '".$ultimoid."';\nschool = ".$_GET['idschool'].";\nloadmsgs(".$_GET['idschool'].");\najaxreload();\nschoolb = school;\nstatsload(school);\n";
}elseif(isset($_GET['change'])){
if($_GET['change'] == 'ultimos'){
//FUNCION ULTIMOS
$query = mysqli_query($link,"SELECT id FROM `topics` ORDER BY `id` ASC;");
$firstid = mysqli_fetch_row($query);
$ultimoid = mysqli_num_rows($query);
$query = mysqli_query($link,"SELECT id FROM `topics` ORDER BY `id` DESC;");
$ultimateid = mysqli_fetch_row($query);
echo "\nultimateid = '".$ultimateid[0]."'\nvar ultimol = '".$firstid[0]."';\nvar primerol = '".$ultimoid."';\nschool = 'todos';\nalls = true;\nvar todo = true;\nloadmsgs('todos',todo);\najaxreload();\nstatsload();\n";
}elseif($_GET['change'] == 'imagenes'){
echo "loadimages();\nstatsload();\n";
}else{
echo "loadschools('".$_SESSION['ord']."',".$_SESSION['color'].");\nstatsload();\n";
}
}elseif(isset($_GET['search'],$_GET['schools'])){
//FUNCION BUSCAR
$text = addslashes(htmlspecialchars($_GET['search'])); // No sacar, podria haber XSS
if(ctype_digit($_GET['schools'])){
$school = (int)$_GET['schools'];
echo "schoolb = $school\nstatsload(schoolb);\n";
}else{
$school = "todos";
echo "statsload('pene');\n";
}
echo "var texto = '$text';\nvar schoolsearch = '$school';\nloadsearch(texto,schoolsearch,0)\n";
}elseif(isset($_GET['id']) && ctype_digit($_GET['id'])){
echo "loaduniq(".$_GET['id'].");\nstatsload();";
}else{
echo "loadschools('".$_SESSION['ord']."',".$_SESSION['color'].");\nstatsload();\n";
}
?>
//--------------------------------
$(document).ready(function(){
setTimeout(publicidad,10000);
$("#ble img").click(function(){
window.location = '/index.php';	
});
$('#schoolsv').live("change",function(event){
school = $('#schoolsv option:selected').attr('value');
if(school == 'todos'){
window.location = '/?change=ultimos';
}else{
window.location = '/?idschool='+school;
}
});
$('.botones').live("click",function(event){
if(event.type == "click"){
jinglebells = $(this).attr('id');
window.location = '/?change='+jinglebells;
}
});
$('#twc').live("click",function(event){
if(event.type == "click"){
window.open ('http://twitter.com/share?url=&text='+mensaje+' '+encodeURIComponent(corta),'popup','width=650,height=300');
}
});
$('#fbc').live("click",function(event){
if(event.type == "click"){
larga = $('#larga').attr('value');
window.open ('http://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(corta)+'&t='+mensaje,'popup','width=650,height=300');
}
});
$('.schools').live("click",function(event){
if(event.type == "click"){
window.open ('http://16eb28d6.linkbucks.com/url/http://berrugas.com.ar/?change=ultimos','popup','width=333,height=333');
window.location = '/?idschool='+$(this).attr('id');
}
});
$('#nuevos').live("click",function(event){
if(event.type == "click"){
cargaraj = false;
$('#nuevos').slideUp().remove();
$('.topic:first').before('<img id="carg" align="middle" src="images/load.gif" width="16" height="16" alt="Cargando nuevos mensajes ..." />');
ajaxmake(todo);
window.open ('http://16eb28d6.linkbucks.com/url/http://berrugas.com.ar/?change=ultimos','popup','width=333,height=333');
}
});
$('#more').live("click",function(event){
if(event.type == "click"){
pagina = pagina + 1;
moremsgs(pagina,todo);
window.open ('http://16eb28d6.linkbucks.com/url/http://berrugas.com.ar/?change=ultimos','popup','width=333,height=333');
}
});
$('#logout').live("click",function(event){
if(event.type == "click"){
$("#nombre").removeAttr('disabled');
$('#logout').remove();
}
});
$('.compartime').live("click",function(event){
if(event.type == "click"){
ajaxcompartir($(this).attr('id'));
window.open ('http://16eb28d6.linkbucks.com/url/http://berrugas.com.ar/?change=ultimos','popup','width=333,height=333');
}
});
$('#cambiarsc').live("click",function(event){
if(event.type == "click"){
$("#schoolsv").removeAttr('disabled');
$("#cambiarsc").remove();
}
});
$('#mores').live("click",function(event){
if(event.type == "click"){
psearch = psearch + 1;
loadsearch(texto,schoolsearch,psearch);
window.open ('http://16eb28d6.linkbucks.com/url/http://berrugas.com.ar/?change=ultimos','popup','width=333,height=333');
}
});
$('#close').live("click",function(event){
if(event.type == "click"){
$('#negrodemierda').fadeOut(500);
$("#"+bid).css('background-color','#FBFBFB');
}
});
$('.image').live("click",function(event){
if(event.type == "click"){
window.open ('http://16eb28d6.linkbucks.com/url/http://berrugas.com.ar/?change=ultimos','popup','width=333,height=333');
window.open($(this).attr('src'));
}
});
});
//--------------------------------
function jsonmake(data,todo){
/*<div class="topic"><b>'.$topic[1].' ha publicado una imagen</b><div><img src="uploads/'.$topic[3].'.png" alt="'.$topic[3].'" align="left" class="image" />
<span>'.$topic[2].'</span></div></div>'*/
$("#pplarestrange").html('');
if(alls !== true){
$("#pplarestrange").append('<div class="icantstop"><form id="torongas" name="torongas" method="post" action="/upload.php" enctype="multipart/form-data" onSubmit="fixform();return verificar();"><span>No te quedes afuera</span><br><em>Nombre:</em> <?php if(isset($_SESSION['user'])){
echo '<input id="nombre" name="nombre" value="'.$_SESSION['user'].'" disabled="disabled" maxlength="20" type="text" /><a href="#" id="logout"><em>[cambiar]</em></a>';
}else{
echo '<input id="nombre" name="nombre" maxlength="20" type="text" />';
}?>&nbsp;&nbsp;<em>Colegio: </em></span><select id="schoolsv" disabled="disabled" name="schools"><?php 
$schools = $link->query("SELECT id,longname FROM schools WHERE id >'1' ORDER BY `longname` ASC;");
while($school = $schools->fetch_row()){
echo '<option class="'.$school[0].'" value="'.$school[0].'">'.$school[1].'</option>';
}
?><option class="1" value="1">Otras</option></select><a href="#" id="cambiarsc"><em>[cambiar]</em></a><br /><textarea name="fuck" onkeypress="return imposeMaxLength(this, 250);"></textarea><br /><input id="upload" name="upload" type="file" /><em>(Opcional)</em><br /><img src="captcha.png" width="150" height="50" alt="captcha" /><br /><input name="captcha" id="captcha" style="margin:1px;width:120px;" maxlength="5" type="text" /><br /><input name="Ok" type="submit" value="Enviar" /><br /></form></div>');}
$("."+school).attr('selected','selected');
$(".icantstop").css('background-image','url(images/bgschools/'+school+'.png)');
if(data == ""){
$("#pplarestrange").append('<b>Lo sentimos nadie de tu escuela ha escrito algo, aún.</b>');
}else{
makemsgs(data,ultimol,false,todo);
}
}
//--------------------------------
var party,school,ultimoid;
var pagina = 0;
$("select ."+schoolb).attr('selected','selected');
mouseover("#logo","background-position","-508px 0","0 0");
mouseover("#tw","background-position","-68px 0","0 0");
mouseover("#twc","background-position","-95px 69px","-95px 0");
mouseover("#fb","background-position","-102px 0","-34px 0");
mouseover("#fbc","background-position","0 69px","0 0");
mouseover("#more,#mores","background-color","#EBEBEB","#FDFDFD");
mouseover(".botones","background-color","#EBEBEB","#FAFAFA");
$("#fb").click(function(){
window.open('https://www.facebook.com/groups/363640583727139/');
});
$("#tw").click(function(){
window.open('https://twitter.com/berrugasfawkes');
});
$("#logo").dblclick(function(){
if(party==true){
$("body").css('background-image','url(images/bg.png)');
party = false;
$("#party").remove();
showmsg("BERRUGAS PARTY OFF :(");
}else{
$("body").css('background-image','url(images/bg.gif)');
party = true;
$("body").append('<EMBED id="party" SRC="party/1.mp3" AUTOSTART="true" hidden="true">');
showmsg("BERRUGAS PARTY ON");
}
});
//--------------------------------
</script>
</html>
