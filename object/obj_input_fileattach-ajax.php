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
if($myAjaxAction=="load-photo") {
	//--------------------------------------------------------
	$arTmp=explode("#",$myAjaxKey);
	$Config_Input_Key=$arTmp[0];
	$Config_Input_ParentID=$arTmp[1];

	$myFolder0 = 'file_attach-filename';
	
	$sql=" SELECT * FROM ".DMS_TABLE_INPUT_FILEATTACH." WHERE modulekey='".$Config_Input_Key."' AND parent_id='".$Config_Input_ParentID."' ";
	$sql.=" AND filetype='photo' ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	while($Row = mysql_fetch_array($Query)) {
		
		$myFolder1 = substr($Row['filename'],0,2);
		$target_path = SYSTEM_DOC_ROOT."upload/".$myFolder0."/".$myFolder1."/";
		
		?>
		<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 padding-2" id="id<?php echo $Config_Input_Key.$Row['id']; ?>">
		<a href="<?php echo $target_path.$Row['filename']; ?>" target="_blank">
		<img src="<?php echo $target_path.$Row['filename']; ?>" border="0" class="img-responsive">
		</a>
		<div class="pull-right"><span class="cursor" onClick=" doDelete<?php echo $Config_Input_Key; ?>('<?php echo $Row['id']; ?>'); "><b><font color="#FF0000">x</font></b></span></div>
		</div>
		<?php
	}
	exit;
}
############################################################################
if($myAjaxAction=="load-file") {
	//--------------------------------------------------------
	$arTmp=explode("#",$myAjaxKey);
	$Config_Input_Key=$arTmp[0];
	$Config_Input_ParentID=$arTmp[1];

	$myFolder0 = 'file_attach-filename';
	
	$sql=" SELECT * FROM ".DMS_TABLE_INPUT_FILEATTACH." WHERE modulekey='".$Config_Input_Key."' AND parent_id='".$Config_Input_ParentID."' ";
	$sql.=" AND filetype='file' ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	while($Row = mysql_fetch_array($Query)) {
		
		$myFolder1 = substr($Row['filename'],0,2);
		$target_path = SYSTEM_DOC_ROOT."upload/".$myFolder0."/".$myFolder1."/";
		
		?>
		<div class="col-xs-6 col-sm-4 col-md-2 col-lg-2 padding-2" id="id<?php echo $Config_Input_Key.$Row['id']; ?>">
		<a href="<?php echo $target_path.$Row['filename']; ?>" target="_blank"><b><font color="#AAAAAA"><?php echo $Row['filename']; ?></font></b></a>
		&nbsp; <span class="cursor" onClick=" doDelete<?php echo $Config_Input_Key; ?>('<?php echo $Row['id']; ?>'); "><b><font color="#FF0000">x</font></b></span>
		</div>
		<?php
	}
	exit;
}
############################################################################
if($myAjaxAction=="delete-file") {
	//--------------------------------------------------------
	$arTmp=explode("#",$myAjaxKey);
	$Config_Input_Key=$arTmp[0];
	$Config_Input_ParentID=$arTmp[1];
	//--------------------------------------------------------
	$sql=" SELECT * FROM ".DMS_TABLE_INPUT_FILEATTACH." WHERE id='".$myAjaxID."' ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$Row = mysql_fetch_array($Query);
	$myFolder1 = substr($Row['filename'],0,2);
	$myFolder0 = 'file_attach-filename';
	$target_path = SYSTEM_DOC_ROOT."upload/".$myFolder0."/".$myFolder1."/";
	@unlink($target_path.$Row['filename']);	
	//--------------------------------------------------------
	$sql=" DELETE FROM ".DMS_TABLE_INPUT_FILEATTACH." WHERE id='".$myAjaxID."' ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	//--------------------------------------------------------
	exit;
}
############################################################################
if($myAjaxAction=="new-file-upload") {
	//--------------------------------------------------------
	$arTmp=explode("#",$myAjaxKey);
	$Config_Input_Key=$arTmp[0];
	$Config_Input_ParentID=$arTmp[1];
	//--------------------------------------------------------
	$sql = " INSERT INTO ".DMS_TABLE_INPUT_FILEATTACH."(modulekey,parent_id,createdate,user_id) ";
	$sql .=" VALUES('".$Config_Input_Key."','".$Config_Input_ParentID."','".SYSTEM_DATETIMENOW."','".$SystemSession_Member_ID."') ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$myID=mysql_insert_id();
	//--------------------------------------------------------
	$myUploadFileName=$_FILES['inputFile']['name'];
	//--------------------------------------------------------
	$arTmp=explode(".",$myUploadFileName);
	$myFileType=strtolower($arTmp[sizeof($arTmp)-1]);
	$myRand=mt_rand(111111,999999);
	$myNewFile=$myID."-".$myRand.".".$myFileType;
	if(strpos(DMS_CONFIG_PHOTO_UPLOAD_ALLOW,"'".$myFileType."'")>0) {
		$myType='photo';
	} else if(strpos(DMS_CONFIG_FILE_UPLOAD_ALLOW,"'".$myFileType."'")>0) {
		$myType='file';
	}
	if(strpos(DMS_CONFIG_FILE_UPLOAD_ALLOW,"'".$myFileType."'")>0) { // File Type Support
		//--------------------------------------------------------
		$myIDZero = sprintf("%02d", $myID);
		$myFolder0 = 'file_attach-filename';
		$myFolder1 = substr($myIDZero,0,2);
		//--------------------------------------------------------
		$target_path = SYSTEM_DOC_ROOT."upload/".$myFolder0."/";
		 if (!is_dir($target_path)) { mkdir($target_path); chmod($target_path, 0777); }
		$target_path = SYSTEM_DOC_ROOT."upload/".$myFolder0."/".$myFolder1."/";
		 if (!is_dir($target_path)) { mkdir($target_path);  chmod($target_path, 0777); }
		$target_path = $target_path.$myNewFile; 
		//--------------------------------------------------------
		if(move_uploaded_file($_FILES['inputFile']['tmp_name'], $target_path)) {
			chmod($target_path, 0777);
			//--------------------------------------------------------
			$sql = " UPDATE ".DMS_TABLE_INPUT_FILEATTACH."  SET filename='".$myNewFile."',filetype='".$myType."' WHERE id='".$myID."' ";
			$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
			//--------------------------------------------------------
			echo " <script> ";
			echo " window.parent.doLoadFile".$Config_Input_Key."(); ";
			echo " window.parent.doLoadPhoto".$Config_Input_Key."(); ";
			echo " </script> ";
		}
	} else {
		//echo " <script> ";
		//echo " window.parent.showInvalidFile('".$myField."','File upload not allow!'); ";
		//echo " </script> ";
	}
	exit;
	//--------------------------------------------------------
}
############################################################################
MYSQL_CLOSE();
?>