<?php
session_start();
header("Content-type: image/png");
$_SESSION['captcha'] = substr(md5(date("is") * microtime()),27);
$image = imagecreatefrompng('captcha.png');
$color = imagecolorallocate($image,255,0,255);
$font = 'font.ttf';
//imagestring($image,$font,0,0,$_SESSION['captcha'],$color);
imagettftext($image,30,0,2,45,$color,$font,$_SESSION['captcha']);
imagepng($image);
imagedestroy($image);
?>