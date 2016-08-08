<?php  if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php }
header("Content-type: text/html;  charset=utf-8");  
header("Cache-Control: no-cache");
## System Start #######################
include("../_config/config_system.php");
include_once(SYSTEM_DOC_ROOT."system/core-start-ajax.php");
############################################################################
$myAjaxAction = trim($_REQUEST['myAjaxAction']);
$myAjaxID = trim($_REQUEST['myAjaxID']);
$myAjaxKey = trim($_REQUEST['myAjaxKey']);
$myAjaxValue = trim($_REQUEST['myAjaxValue']);
############################################################################
if($myAjaxAction=="data-update") {
	$arTmp=explode("#",$myAjaxKey);
	$myAjaxKey=$arTmp[0];
	$table=$arTmp[1];
	$myFirstField=$arTmp[2];
	//--------------------------------------------------------
	$sql = " UPDATE ".$table." SET ".$myAjaxKey."='".addslashes($myAjaxValue)."' WHERE ".$myFirstField."='".$myAjaxID."' ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	//--------------------------------------------------------
	echo "<script> window.parent.showSave('".$myAjaxID."','".$myAjaxKey."'); </script>";
	//--------------------------------------------------------
	exit;
}
############################################################################
if($myAjaxAction=="data-update-select-array") {
	$arTmp=explode("[#]",$myAjaxValue);
	$myUpdateID=$arTmp[0];
	$myUpdateText=$arTmp[1];
	//--------------------------------------------------------
	$arTmp=explode("#",$myAjaxKey);
	$myUpdateFieldID=$arTmp[0];
	$myUpdateFieldText=$arTmp[1];
	$table=$arTmp[2];
	$myFirstField=$arTmp[3];
	//--------------------------------------------------------
	if($myUpdateFieldText=='') {
		$sql = " UPDATE ".$table." SET ".$myUpdateFieldID."='".addslashes($myUpdateID)."' WHERE ".$myFirstField."='".$myAjaxID."' ";
	} else {
		$sql = " UPDATE ".$table." SET ".$myUpdateFieldID."='".addslashes($myUpdateID)."',".$myUpdateFieldText."='".addslashes($myUpdateText)."' WHERE ".$myFirstField."='".$myAjaxID."' ";
	}
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	//--------------------------------------------------------
	echo "<script> window.parent.showSave('".$myAjaxID."','".$myUpdateFieldID."'); </script>";
	//--------------------------------------------------------
	exit;
}
############################################################################
if($myAjaxAction=="data-update-date") {
	$arTmp=explode("-",$myAjaxValue);
	$myAjaxValue=($arTmp[0]-543)."-".$arTmp[1]."-".$arTmp[2];
	//--------------------------------------------------------
	$arTmp=explode("#",$myAjaxKey);
	$myAjaxKey=$arTmp[0];
	$table=$arTmp[1];
	$myFirstField=$arTmp[2];
	//--------------------------------------------------------
	$sql = " UPDATE ".$table." SET ".$myAjaxKey."='".addslashes($myAjaxValue)."' WHERE ".$myFirstField."='".$myAjaxID."' ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	//--------------------------------------------------------
	echo "<script> window.parent.showSave('".$myAjaxID."','".$myAjaxKey."'); </script>";
	//--------------------------------------------------------
	exit;
}
############################################################################
MYSQL_CLOSE();
?>