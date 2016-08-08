<?php
include("../_config/config_system.php");
include_once("../system/core-start-ajax-home.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

function System_DateTimeDelay($myDelaySec) {
	$today1=getdate();
	$Day=$today1['mday'];
	$Month=$today1['mon'];
	$Year=$today1['year'];
	$SS=$today1['seconds'];
	$MM=$today1['minutes'];
	$HH=$today1['hours'];

	$today=getdate(mktime($HH+CONFIG_ADD_HOUR,$MM,$SS-$myDelaySec,$Month,$Day,$Year));
	$Day=$today['mday'];
	$Month=$today['mon'];
	$Year=$today['year'];
	$SS=$today['seconds'];
	$MM=$today['minutes'];
	$HH=$today['hours'];

	$DateIs=sprintf("%04d-%02d-%02d %02d:%02d:%02d",$Year,$Month,$Day,$HH,$MM,$SS);
	return($DateIs);
}

##########################################################################################
$itemsloop=1; $index=0;
$Config_FolderKey1="thumb";
$Config_FolderKey2="thumb2";
$Config_FolderKey3="thumb3";
echo SYSTEM_DATETIMENOW."<br>";
$myDelayTime=System_DateTimeDelay(30*60);
echo $myDelayTime."<br>";
exit;
?>