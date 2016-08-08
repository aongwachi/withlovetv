<?php
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php }
## System Start ############################################################
include("../_config/config_system.php");
include_once(SYSTEM_DOC_ROOT."/system/core-start-ajax.php");
############################################################################
$imgUrl = $_POST['imgUrl'];
// original sizes
$imgInitW = $_POST['imgInitW'];
$imgInitH = $_POST['imgInitH'];
// resized sizes
$imgW = $_POST['imgW'];
$imgH = $_POST['imgH'];
// offsets
$imgY1 = $_POST['imgY1'];
$imgX1 = $_POST['imgX1'];
// crop box
$cropW = $_POST['cropW'];
$cropH = $_POST['cropH'];
// rotation angle
$angle = $_POST['rotation'];
$jpeg_quality = 100;
############################################################################
$myID = $_POST['myID'];
$myTable = $_POST['myTable'];
$myField = $_POST['myField'];
$myKeyField = $_POST['myKeyField'];
############################################################################
$sql = " SELECT ".$myField." FROM ".$myTable." WHERE ".$myKeyField."='".$myID."' ";
$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
$Row = mysql_fetch_array($Query);
$myNewFileOld=$Row[0];
############################################################################
$myRand=mt_rand(111111,999999);
$myNewFile=$myID."-".$myRand;
############################################################################
$output_filename = dirname($imgUrl). "/".$myNewFile;
$what = getimagesize($imgUrl);
switch(strtolower($what['mime'])) {
    case 'image/png':
        $img_r = imagecreatefrompng($imgUrl);
		$source_image = imagecreatefrompng($imgUrl);
		$type = '.png';
        break;
    case 'image/jpeg':
        $img_r = imagecreatefromjpeg($imgUrl);
		$source_image = imagecreatefromjpeg($imgUrl);
		error_log("jpg");
		$type = '.jpeg';
        break;
    case 'image/gif':
        $img_r = imagecreatefromgif($imgUrl);
		$source_image = imagecreatefromgif($imgUrl);
		$type = '.gif';
        break;
    default: die('image type not supported');
}
############################################################################
//Check write Access to Directory
if(!is_writable(dirname($output_filename))){
    $response = Array(
	"status" => 'error',
	"message" => 'Can`t write cropped File'
    );	
}else{
    // resize the original image to size of editor
    $resizedImage = imagecreatetruecolor($imgW, $imgH);
	imagecopyresampled($resizedImage, $source_image, 0, 0, 0, 0, $imgW, $imgH, $imgInitW, $imgInitH);
    // rotate the rezized image
    $rotated_image = imagerotate($resizedImage, -$angle, 0);
    // find new width & height of rotated image
    $rotated_width = imagesx($rotated_image);
    $rotated_height = imagesy($rotated_image);
    // diff between rotated & original sizes
    $dx = $rotated_width - $imgW;
    $dy = $rotated_height - $imgH;
    // crop rotated image to fit into original rezized rectangle
	$cropped_rotated_image = imagecreatetruecolor($imgW, $imgH);
	imagecolortransparent($cropped_rotated_image, imagecolorallocate($cropped_rotated_image, 0, 0, 0));
	imagecopyresampled($cropped_rotated_image, $rotated_image, 0, 0, $dx / 2, $dy / 2, $imgW, $imgH, $imgW, $imgH);
	// crop image into selected area
	$final_image = imagecreatetruecolor($cropW, $cropH);
	imagecolortransparent($final_image, imagecolorallocate($final_image, 0, 0, 0));
	imagecopyresampled($final_image, $cropped_rotated_image, 0, 0, $imgX1, $imgY1, $cropW, $cropH, $cropW, $cropH);
	// finally output png image
	//imagepng($final_image, $output_filename.$type, $png_quality);
	imagejpeg($final_image, $output_filename.$type, $jpeg_quality);
	$response = Array(
	    "status" => 'success',
	    "url" => $output_filename.$type
    );
}
############################################################################
$output_filename_old = dirname($imgUrl). "/".$myNewFileOld;
if($myNewFileOld<>"") { @unlink($output_filename_old); }
$sql = " UPDATE ".$myTable."  SET ".$myField."='".$myNewFile.$type."' WHERE ".$myKeyField."='".$myID."' ";
$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
############################################################################
print json_encode($response);