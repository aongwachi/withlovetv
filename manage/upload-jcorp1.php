<?php
error_reporting(E_ALL ^ E_DEPRECATED);
ini_set('display_errors', 1);
include("../_config/config_system.php");
include_once(SYSTEM_DOC_ROOT."/system/core-start-ajax.php");
$x=(isset($_POST['x'])?$_POST['x']:null);
$y=(isset($_POST['y'])?$_POST['y']:null);
$w=(isset($_POST['w'])?$_POST['w']:null);
$h=(isset($_POST['h'])?$_POST['h']:null);
$test=(isset($_POST['test'])?$_POST['test']:null);
$myReturn=(isset($_POST['myReturn'])?$_POST['myReturn']:null);
$myID=(isset($_POST['myID'])?$_POST['myID']:null);
$myTable=(isset($_POST['myTable'])?$_POST['myTable']:null);
$myKeyField=(isset($_POST['myKeyField'])?$_POST['myKeyField']:null);
$myField=(isset($_POST['myField'])?$_POST['myField']:null);
$Config_UniqueID=(isset($_POST['Config_UniqueID'])?$_POST['Config_UniqueID']:null);
$Config_CropWidth=(isset($_POST['Config_CropWidth'])?$_POST['Config_CropWidth']:null);
$Config_CropHeight=(isset($_POST['Config_CropHeight'])?$_POST['Config_CropHeight']:null);
$Config_DefaultPath=(isset($_POST['Config_DefaultPath'])?$_POST['Config_DefaultPath']:null);
$Config_DefaultValue=(isset($_POST['Config_DefaultValue'])?$_POST['Config_DefaultValue']:null);
####################################################################
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$src = $Config_DefaultPath.$Config_DefaultValue;
	//-------------------------------------	
	$arTmp=explode(".",$Config_DefaultValue);
	$myFileType=strtolower($arTmp[sizeof($arTmp)-1]);
	$myRand=mt_rand(111111,999999);
	$myNewFile=$myID."-".$myRand.".".$myFileType;
	//-------------------------------------	
	$dest = $Config_DefaultPath.$myNewFile;
	if(file_exists($dest)) { unlink($dest); }
	//-------------------------------------	
	$info = getimagesize($src);
	$mime = $info['mime'];
	switch ($mime) {
		case 'image/jpeg':
			$img_r = imagecreatefromjpeg($src);
			$dst_r = ImageCreateTrueColor($Config_CropWidth,$Config_CropHeight);
			imagecopyresampled($dst_r,$img_r,0,0,$x,$y,$Config_CropWidth,$Config_CropHeight,$w,$h);
			imagejpeg($dst_r,$dest,100);
			break;
		case 'image/png':
			$img_r = imagecreatefrompng($src);
			$dst_r = ImageCreateTrueColor($Config_CropWidth,$Config_CropHeight);
			imagecopyresampled($dst_r,$img_r,0,0,$x,$y,$Config_CropWidth,$Config_CropHeight,$w,$h);
			imagepng($dst_r,$dest,9);
			break;
		default: 
			throw new Exception('Not support image type.');
	}
	$sql = " UPDATE ".$myTable."  SET ".$myField."='".$myNewFile."' WHERE ".$myKeyField."='".$myID."' ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
}
echo " <script> ";
echo " window.parent.showSaveFile".$Config_UniqueID."('";
echo '<img src="'.$Config_DefaultPath.$myNewFile.'" id="cropbox'.$Config_UniqueID.'" class="pull-left" />';
echo "'); "; 
echo " </script> ";
?>