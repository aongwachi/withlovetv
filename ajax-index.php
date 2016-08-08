<?php  if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php }
header("Content-type: text/html;  charset=utf-8");  
header("Cache-Control: no-cache");
## System Start #######################
include_once("_config/config_system.php");
include_once(SYSTEM_DOC_ROOT."system/core-start-ajax-home.php");
############################################################################
$Config_FolderKey1="thumb";
$Config_FolderKey2="thumb2";
$Config_FolderKey3="thumb3";
############################################################################
$myAjaxAction = trim($_REQUEST['myAjaxAction']);
$myAjaxID = trim($_REQUEST['myAjaxID']);
$myAjaxKey = trim($_REQUEST['myAjaxKey']);
$myAjaxValue = trim($_REQUEST['myAjaxValue']);
############################################################################
if($myAjaxAction=="show-news" && $myAjaxID>0) {
	$catid=$myAjaxID; $index=1;
	$sql="SELECT * FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_Category LIKE '%,".$catid.",%' AND ".TABLE_CONTENT."_Thumb<>'' AND ".TABLE_CONTENT."_Subject<>'' AND ".TABLE_CONTENT."_Text<>''  AND ".TABLE_CONTENT."_Status='Publish' ORDER BY ".TABLE_CONTENT."_Pin DESC , ".TABLE_CONTENT."_OnlineDate DESC LIMIT 0,11 ";
	$query=$dbh->prepare($sql);
	if($query->execute()) {
		while($Row=$query->fetch()) {
			$myID=$Row[TABLE_CONTENT."_ID"];
			$myThumb=$Row[TABLE_CONTENT."_Thumb"];
			$myThumb2=$Row[TABLE_CONTENT."_Thumb2"];
			$myThumb3=$Row[TABLE_CONTENT."_Thumb3"];
			$arSubject[$index]=$Row[TABLE_CONTENT."_Subject"];
			$isVideo=$Row[TABLE_CONTENT."_isVideo"];
			//--------------------------------------------
			$myIDs=sprintf('%04d',$myID);
			$myFolder1=substr($myIDs,strlen($myIDs)-4,2);
			$myFolder2=substr($myIDs,strlen($myIDs)-2,2);
			$Config_Path1=SYSTEM_WEB_CDN_PATH_FULL."/upload/".$Config_FolderKey1."/".$myFolder1."/".$myFolder2."/";
			$Config_Path2=SYSTEM_WEB_CDN_PATH_FULL."/upload/".$Config_FolderKey2."/".$myFolder1."/".$myFolder2."/";
			$Config_Path3=SYSTEM_WEB_CDN_PATH_FULL."/upload/".$Config_FolderKey3."/".$myFolder1."/".$myFolder2."/";
			$arPictureThumb1[$index]=$Config_Path1.$myThumb;
			$arPictureThumb2[$index]=$Config_Path2.$myThumb2;
			$arPictureThumb3[$index]=$Config_Path3.$myThumb3;
			//--------------------------------------------
			$index++;
		}
	}
	?>
	<!--##############################################-->
	<div class="col-xxs-12 col-xs-5 col-sm-5 col-md-4 col-lg-4 text-center bg-red">
		<img src="<?php echo $arPictureThumb3[1]; ?>" class="img-responsive">
		<br><br><br>
	</div>
	<!--##############################################-->
	<div class="col-xxs-12 col-xs-7 col-sm-7 col-md-8 col-lg-8 text-center bg-green">
		<?php for($i=2;$i<=10;$i++) { ?>
		<img src="<?php echo $arPictureThumb2[$i]; ?>" class="img-responsive"><br>
		<?php } ?>
	</div>
	<!--##############################################-->
	<?php
	exit;
}
############################################################################
MYSQL_CLOSE();
?>