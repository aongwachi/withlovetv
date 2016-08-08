<?php
/**
 * Jcrop image cropping plugin for jQuery
 * Example cropping script
 * @copyright 2008-2009 Kelly Hallman
 * More info: http://deepliquid.com/content/Jcrop_Implementation_Theory.html
 */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$targ_w = 300;
	$targ_h = 450;
	$jpeg_quality = 100;
	$src = 'demo_files/a1.jpg';
	$dest = 'thumb/thumb-a2.jpg';
	if(file_exists($dest)) { unlink($dest); }
	$img_r = imagecreatefromjpeg($src);
	$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
	imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],$targ_w,$targ_h,$_POST['w'],$_POST['h']);
	imagejpeg($dst_r,$dest,$jpeg_quality);
}
?>
<br>
<img src="thumb/thumb-a2.jpg">