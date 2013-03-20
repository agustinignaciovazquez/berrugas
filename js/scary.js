/*SO RE INTELIGENTE VO AMIGO*/
function fixform(){
$("#schoolsv").removeAttr("disabled");
}
function mouseover(poronga,css,quehacer,quehacer2){
/*$(poronga).mouseover(function(){
$(this).css(css,quehacer);
}).mouseout(function(){
$(this).css(css,quehacer2);
}); CODIGO DE ABAJO ARREGLA PROBLEMA CON APPEND D:*/
$(poronga).live("mouseover mouseout", function(event) {
if ( event.type == "mouseover" ) {
$(this).css(css,quehacer);
}else{
$(this).css(css,quehacer2);
}
});
}
function showmsg(message){
$("#msg").text(message).fadeIn().fadeOut(5500);
}
function loadschools(ord,color){
$.ajax({
data: "school=fuckyou&ord="+ord,
type: "GET",
dataType: "json",
url: "t.json.php",
success: function(data){
$("#pplarestrange").html('<center id="caps"><b style="margin-left:100px;">Ordernar: | <a id="alf" href="/?ordenar=alf">Alfabeticamente</a> | <a id="visitas" href="/?ordenar=visitas">Tus visitas</a> | <a id="normalito" href="/?ordenar=normalito">Cantidad publicaciones</a> |</b><b style="float:right;font-size:10px;"> Vista: | <a href="/?color=rico" id="rico">Rico</a> | <a href="/?color=pobre" id="pobre">Pobreton</a> |</b></center>');
$('#'+ord).removeAttr('href');
$.each(data,function(index,value){
if(color == true){
$('#rico').removeAttr('href');
$("#pplarestrange").append('<img id="'+data[index][1]+'" class="schools" src="images/cschools/'+data[index][1]+'.png" alt="'+data[index][0]+'" />');
}else{
$('#pobre').removeAttr('href');
$("#pplarestrange").append('<img id="'+data[index][1]+'" class="schools" src="images/schools/'+data[index][1]+'.png" alt="'+data[index][0]+'" />');
}
});
}
});
mouseover(".schools","background-color","#FDF39D","#FFF");
}
function imposeMaxLength(Object, MaxLen)
{
return (Object.value.length <= MaxLen);
}
function loadmsgs(school,todo){
$.ajax({
data: "school="+school,
type: "GET",
dataType: "json",
url: "t.json.php",
success: function(data3){ 
jsonmake(data3,todo);
}
});
} 
function verificar(){
if($('.icantstop textarea').attr('value') == ''){ 
alert('Escribite algo vo');
return false;
}else{
if($('#nombre').val() == '' && $('#nombre').length == '1'){ 
alert('Pone tu nombre amiwo');
return false;
}else{
if($('#captcha').val().length !== 5){
alert('Captcha incorrecto');
return false;
}else{
return true;
}
}
}
}
function moremsgs(pagina,todo){
$.ajax({
data: "school="+school+"&p="+pagina,
type: "GET",
dataType: "json",
url: "t.json.php",
success: function(data2){
$('#more').remove();
makemsgs(data2,ultimol,false,todo);
}
});
}
function makemsgs(data,lastid,before,todo){
var ultimo = false;
$.each(data,function(index,value){
if(data[index][4] == lastid){
ultimo = true;
}
if(before == true){
primerol = numeron;	
ultimateid = data[index][4];
$('#carg').remove();
$(".topic:first").before(contructmsgs(data[index][1],data[index][2],data[index][0],data[index][3],data[index][5],todo,data[index][4]));
}else{
$("#pplarestrange").append(contructmsgs(data[index][1],data[index][2],data[index][0],data[index][3], data[index][5],todo,data[index][4]));
}
});
if(ultimo == false && before !== true){
$("#pplarestrange").append('<div id="more">Ver mas</div>');
}
}
function contructmsgs(autor,texto,fecha,imagen,schoolidn,todos,idc){
if(todos == true){
if(imagen == ''){
return '<div class="topic" id="'+idc+'"><b>'+autor+' publico un comentario:</b><div class="golddust" style="text-align:left;min-width:100px;min-height:100px;"><div class="schoolbg" style="background-image:url(images/bgschools/'+schoolidn+'.png);"></div><div style="clear:none;width:98%;"><span>'+texto+'</span></div></div><div class="golddust" style="text-align:right;border: 1px #000 dashed;border-width:1px 0 0 0;margin:8px 0 3px 0;"><div class="nuevon"><span class="compartime" id="'+idc+'">Compartir publicacion</span></div><div class="eh">kRAK - '+fecha+'</div></div>';
}else{
return '<div class="topic" id="'+idc+'"><b>'+autor+' publico una imagen:</b><div style="margin-top:3px;"><img src="images/bgschools/'+schoolidn+'.png" align="left" style="width:110px;height:110px"/><img src="uploads/'+imagen+'" alt="'+imagen+'" align="right" class="image" /></div><div class="golddust" style="text-align:left;min-width:110px;min-height:110px;padding:0 0 0 4px;"><span>'+texto+'</span></div><div class="golddust" style="text-align:right;border: 1px #000 dashed;border-width:1px 0 0 0;margin:10px 0 3px 0;"><div class="nuevon"><span class="compartime" id="'+idc+'">Compartir publicación</span></div><div class="eh">kRAK - '+fecha+'</div></div></div>';
}
}else{
if(imagen == ''){
return '<div class="topic" id="'+idc+'"><b>'+autor+' publico un comentario:</b><div class="golddust" style="padding:5px 0 0 0;text-aling:center;"><center>'+texto+'</center></div><div class="golddust" style="text-align:right;border: 1px #000 dashed;border-width:1px 0 0 0;margin:0 0 3px 0;"><div class="nuevon"><span class="compartime" id="'+idc+'">Compartir publicacion</span></div><div class="eh">kRAK - '+fecha+'</div></div></div></div>';
}else{
return '<div class="topic" id="'+idc+'"><b>'+autor+' publico una imagen:</b><div style="margin-top:3px;"><img src="uploads/'+imagen+'" alt="'+imagen+'" align="left" class="image" /></div><div class="golddust" style="text-align:left;min-width:110px;min-height:110px;padding:0 0 0 4px;"><span>'+texto+'</span></div><div class="golddust" style="text-align:right;border: 1px #000 dashed;border-width:1px 0 0 0;margin:10px 0 3px 0;"><div class="nuevon"><span class="compartime" id="'+idc+'">Compartir publicación</span></div><div class="eh">kRAK - '+fecha+'</div></div></div>';
}	
}
}
//--------------------------------
function ajaxreload(){
$.ajax({
data: "school="+school+"&lastm="+primerol,
type: "GET",
dataType: "json",
url: "t.json.php",
success: function(data1){
if(cargaraj == true){
numeron = data1[0][0];
tmp = numeron-primerol;
if(tmp !== 0){
$("title").html('('+tmp+') Berrugas - Enterate de todo');	
$('#nuevos').slideUp().remove();
$(".topic:first").before('<div id="nuevos">Mostrar '+tmp+' mensajes nuevos</div>');
}
}
}
});
setTimeout(ajaxreload,10000)
}
//--------------------------------
function ajaxmake(todo){
$.ajax({
data: "school="+school+"&lastm="+ultimateid+"&update=putos",
type: "GET",
dataType: "json",
url: "t.json.php",
success: function(datos){
makemsgs(datos,primerol,true,todo);
cargaraj = true;
$("title").html('Berrugas - Enterate de todo');	
}
});
}
//--------------------------------
function publicidad(){
//window.open('http://87594464.linkbucks.com','popup','width=100,height=200'); LINK PUBLI
setTimeout(publicidad,120000);
}
//--------------------------------
function statsload(s){
$.ajax({
data: "ids="+s,
type: "GET",
dataType: "json",
url: "stats.json.php",
success: function(datacion){
$.each(datacion,function(index,value){
if(index == 0){
$("#stats").html('<b><center>Estadisticas '+datacion[index][0]+'</center></b>');
}else{
$("#stats").append('<span>'+datacion[index][1]+':</span><b>'+datacion[index][0]+'</b><br>');
}
});
}
});
}
//--------------------------------
function loadsearch(texto,school,ps){
$.ajax({
data: "school="+school+"&search="+texto+"&p="+ps,
type: "GET",
dataType: "json",
url: "t.json.php",
success: function(result){
if(ps == 0){
$("#pplarestrange").html('<div style="margin:4px auto 0 auto;font-weight:bolder;text-align:center;border:1px #000 solid;border-radius:9px;width:40%;">Se han encontrado '+result[0][0]+' resultados.</div>');
if(result.length == 0){
$("#pplarestrange").html('<b>No se han encontrado resultados</b>');
}
}
$("#mores").remove();
$.each(result,function(index,value){
if(index !== 0){
$("#pplarestrange").append(contructmsgs(result[index][1],result[index][2],result[index][0],result[index][3],result[index][5],true,result[index][4]));
}
});
if(result.length == 31){
$("#pplarestrange").append('<div id="mores">Ver mas resultados</div>');
}
}
});
}
//--------------------------------
function loadimages(){
$("#pplarestrange").html('<h1>Proximamente guachin</h1>');
}
//--------------------------------
function loaduniq(n){
$.ajax({
data: "idun="+n,
type: "GET",
dataType: "json",
url: "t.json.php",
success: function(unico){
$('#pplarestrange').html('');
makemsgs(unico,1,false,true);
$("#more").remove();
}
});
}
//--------------------------------
function ajaxcompartir(id){
bid = id;
$.ajax({
data: "c=putos&id="+id,
type: "GET",
dataType: "json",
url: "others.json.php",
success: function(compartir){
$('#negrodemierda').fadeIn(500);
$("#"+id).css('background-color','#FEB9B4');
corta = compartir[1];
mensaje = compartir[2]+' ha publicado en Berrugas: '+compartir[0];
$('#larga').attr('value','http://berrugas.com.ar/?id='+id);
$('#corta').attr('value',corta);
}
});
}
//--------------------------------