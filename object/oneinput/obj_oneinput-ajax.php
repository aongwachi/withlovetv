<?php
if(!ini_get('display_errors')) { ini_set('display_errors', '1'); }
header("Content-type: text/html;  charset=utf-8");  
header("Cache-Control: no-cache");
## System Start #######################
include("../../_config/config_system.php");
include_once(SYSTEM_DOC_ROOT."/system/core-start-ajax.php");
############################################################################
if(isset($_REQUEST['myAjaxAction']) && $_REQUEST['myAjaxAction']<>"") { $myAjaxAction = trim($_REQUEST['myAjaxAction']); }
if(isset($_REQUEST['myAjaxID'])     && $_REQUEST['myAjaxID']<>"") {     $myAjaxID = trim($_REQUEST['myAjaxID']); }
if(isset($_REQUEST['myAjaxKey'])    && $_REQUEST['myAjaxKey']<>"") {    $myAjaxKey = trim($_REQUEST['myAjaxKey']); }
if(isset($_REQUEST['myAjaxValue'])  && $_REQUEST['myAjaxValue']<>"") {  $myAjaxValue = trim($_REQUEST['myAjaxValue']); }
if(isset($_REQUEST['myAjaxValue2']) && $_REQUEST['myAjaxValue2']<>"") { $myAjaxValue2 = trim($_REQUEST['myAjaxValue2']); }
############################################################################
if(!isset($myAjaxAction)) { $myAjaxAction=""; }
if(!isset($myAjaxID)) {     $myAjaxID=""; }
if(!isset($myAjaxKey)) {    $myAjaxKey=""; }
if(!isset($myAjaxValue)) {  $myAjaxValue=""; }
if(!isset($myAjaxValue2)) { $myAjaxValue2=""; }
############################################################################
if($myAjaxAction=="data-update-code-save") { 
	//--------------------------------------------------------
	$myAjaxKeys=System_Decode($myAjaxKey);
	$arTmp=explode("#",$myAjaxKeys);
	$myTable=$arTmp[1];
	$myField=$arTmp[3];
	$myKeyField=$arTmp[6];
	$myID=$arTmp[8];
	//--------------------------------------------------------
	$myAjaxValue1=str_replace("[#[#]","<",str_replace("[#]#]",">",str_replace("[/script]","</script>",str_replace("[script]","<script>",$myAjaxValue))));
	//--------------------------------------------------------
	$filepath="../../upload/ads/".strtolower($myField)."_".$myID.".jstxt";
	$file = fopen($filepath,"w+");
	fwrite($file,$myAjaxValue1);
	fclose($file);
	@chmod($filepath,0777);
	//--------------------------------------------------------
	$sql = " UPDATE ".$myTable." SET ".$myField."='".addslashes($myAjaxValue)."' WHERE ".$myKeyField."='".$myID."' ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	//--------------------------------------------------------
	echo "Save!"; // : ".$myID;
	//--------------------------------------------------------
	exit;
}
############################################################################
if($myAjaxAction=="data-update-onoff-string") {
	//--------------------------------------------------------
	$myAjaxKeys=System_Decode($myAjaxKey);
	$arTmp=explode("#",$myAjaxKeys);
	$myTable=$arTmp[1];
	$myField=$arTmp[3];
	$myKeyField=$arTmp[6];
	$myID=$arTmp[8];
	//--------------------------------------------------------
	$sql = " SELECT ".$myField." FROM ".$myTable." WHERE ".$myKeyField."='".$myID."' ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$Row = mysql_fetch_array($Query);
	$myOldString=$Row[0];
	if($myAjaxValue==0) { // remove
		$myOldString=str_replace(",".$myAjaxValue2.",",",",$myOldString);
	} else { // insert
		if($myOldString=="") {
			$myOldString=",".$myAjaxValue2.",";
		} else {
			$myOldString.=$myAjaxValue2.",";
		}
	}
	//--------------------------------------------------------
	$sql = " UPDATE ".$myTable." SET ".$myField."='".addslashes($myOldString)."' WHERE ".$myKeyField."='".$myID."' ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	//--------------------------------------------------------
	echo "Save!"; // : ".$myID;
	//--------------------------------------------------------
	exit;
}
############################################################################
if($myAjaxAction=="one-photo-upload3") {
	if(isset($_REQUEST['Config_CropWidth']) && $_REQUEST['Config_CropWidth']<>"") { $Config_CropWidth=trim($_REQUEST['Config_CropWidth']); }
	if(!isset($Config_CropWidth)) { $Config_CropWidth=""; }
	if(isset($_REQUEST['Config_CropHeight']) && $_REQUEST['Config_CropHeight']<>"") { $Config_CropHeight=trim($_REQUEST['Config_CropHeight']); }
	if(!isset($Config_CropHeight)) { $Config_CropHeight=""; }
	//--------------------------------------------------------
	$Config_FolderKey=$myAjaxValue;
	//--------------------------------------------------------
	$myAjaxKeys=System_Decode($myAjaxKey);
	$arTmp=explode("#",$myAjaxKeys);
	// "UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
	$myTable=$arTmp[1];
	$myField=$arTmp[3];
	$myKeyField=$arTmp[6];
	$myID=$arTmp[8];
	//--------------------------------------------------------
	$myUploadFileName=$_FILES['inputFile']['name'];
	//--------------------------------------------------------
	$arTmp=explode(".",$myUploadFileName);
	$myFileType=strtolower($arTmp[sizeof($arTmp)-1]);
	$myRand=mt_rand(111111,999999); 
	$myRand2=mt_rand(111111,999999); 
	$myNewFile=$myID."-".$myRand.".".$myFileType;
	$myNewFile2=$myID."-".$myRand2."x.".$myFileType;
	//--------------------------------------------------------
	$myIDs=sprintf('%04d',$myID);
	$myFolder1=substr($myIDs,strlen($myIDs)-4,2);
	$myFolder2=substr($myIDs,strlen($myIDs)-2,2);
	$Config_Path="../../upload/".$Config_FolderKey."/";
	if(!file_exists($Config_Path)){ mkdir($Config_Path); chmod($Config_Path,0775); }
	$Config_Path="../../upload/".$Config_FolderKey."/".$myFolder1."/";
	if(!file_exists($Config_Path)){ mkdir($Config_Path); chmod($Config_Path,0775); }
	$Config_Path="../../upload/".$Config_FolderKey."/".$myFolder1."/".$myFolder2."/";
	$Config_PathX="../upload/".$Config_FolderKey."/".$myFolder1."/".$myFolder2."/";
	if(!file_exists($Config_Path)){ mkdir($Config_Path); chmod($Config_Path,0775); }
	//--------------------------------------------------------
	$target_path=$Config_Path;
	$target_paths = $target_path.$myNewFile;
	$target_paths2 = $target_path.$myNewFile2;
	if(move_uploaded_file($_FILES['inputFile']['tmp_name'], $target_paths)) {
		chmod($target_paths, 0777);
		// Check for Delete File ---------------------------------
		$sql=" SELECT ".$myField." FROM ".$myTable." WHERE ".$myKeyField."='".$myID."' LIMIT 0,1 ";
		$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
		$Row = mysql_fetch_array($Query);
		$myOldFile=$Row[0];
		if($myOldFile<>"") { @unlink($target_path.$myOldFile); }
		//--------------------------------------------------------
		$sql = " UPDATE ".$myTable."  SET ".$myField."='".$myNewFile."' WHERE ".$myKeyField."='".$myID."' ";
		$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
		//--------------------------------------------------------
		list($myCropWidth,$myCropHeight,$myCropType,$myCropAttr)=getimagesize($target_paths);
		if($myCropWidth>$Config_CropWidth || $myCropHeight>$Config_CropHeight) {
			// Auto Resize if Bigger ---------------------------------
			if($myCropWidth>$Config_CropWidth+100 || $myCropHeight>$Config_CropHeight+100) {
				if($Config_CropHeight>$Config_CropWidth) {
					doImageResizeH($Config_CropHeight+100,$target_paths2,$target_paths);
				} else {
					doImageResize($Config_CropWidth+100,$target_paths2,$target_paths);
				}
				//--------------------------------------------------------
				$sql = " UPDATE ".$myTable."  SET ".$myField."='".$myNewFile2."' WHERE ".$myKeyField."='".$myID."' ";
				$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
				//--------------------------------------------------------
				@chmod($target_paths2,0777);
				echo " <script> ";
				echo " window.parent.showSaveFile".$myAjaxID."('";
				echo '<img src="'.$Config_PathX.$myNewFile2.'" id="cropbox'.$myAjaxID.'" class="pull-left" />';
				echo '<input type="hidden" id="idImageValue1'.$myAjaxID.'" value="'.$myNewFile2.'" />';
				echo "'); ";
				echo " window.parent.runCropper".$myAjaxID."(); ";
				echo " </script> ";
				exit;
			}
		}
		echo " <script> ";
		echo " window.parent.showSaveFile".$myAjaxID."('";
		echo '<img src="'.$Config_PathX.$myNewFile.'" id="cropbox'.$myAjaxID.'" class="pull-left" />';
		echo '<input type="hidden" id="idImageValue1'.$myAjaxID.'" value="'.$myNewFile.'" />';
		echo "'); "; 
		echo " window.parent.runCropper".$myAjaxID."(); ";
		echo " </script> ";
		exit;
	} else {
		echo " <script> ";
		echo " window.parent.showSaveFile".$myAjaxID."('<b><font color=red>Upload error!</font></b>'); ";
		echo " </script> ";
		exit;
	}
}
############################################################################
if($myAjaxAction=="multiple-photo-upload-big") {
	$Config_FolderKey=$myAjaxValue;
	//--------------------------------------------------------
	$myAjaxKeys=System_Decode($myAjaxKey);
	$arTmp=explode("#",$myAjaxKeys);
	// "UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
	$myTable=$arTmp[1];
	$myField=$arTmp[3];
	$myKeyField=$arTmp[6];
	$myID=$arTmp[8];
	$arInputFileName=$_FILES['inputFile']['name'];
	$arInputFileTmpName=$_FILES['inputFile']['tmp_name'];
	// Load Current Photo List -------------------------------
	$sql=" SELECT ".$myField." FROM ".$myTable." WHERE ".$myKeyField."='".$myID."' LIMIT 0,1 ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$Row = mysql_fetch_array($Query);
	$myCurrentPhoto=trim($Row[0]);
	if($myCurrentPhoto=="" || $myCurrentPhoto==",") {
		$mycount=0;
	} else {
		//find max count ------------------
		$mycount=0;
		$arCurrentPhoto=explode(",",$myCurrentPhoto);
		for($i=0;$i<=sizeof($arCurrentPhoto);$i++) {
			if($arCurrentPhoto[$i]<>"") {
				$arTemp=explode("-",$arCurrentPhoto[$i]);
				if($arTemp[1]<>"") {
					$mycount=$arTemp[1]*1;
				}
			}
		}
		$mycount++;
	}
	//--------------------------------------------------------
	$myTimeKey=str_replace(" ","",str_replace("-","",str_replace(":","",SYSTEM_DATETIMENOW)));
	//--------------------------------------------------------
	$myIDs=sprintf('%04d',$myID);
	$myFolder1=substr($myIDs,strlen($myIDs)-4,2);
	$myFolder2=substr($myIDs,strlen($myIDs)-2,2);
	$Config_Path="../../upload/".$Config_FolderKey."/";
	if(!file_exists($Config_Path)){ mkdir($Config_Path); chmod($Config_Path,0777); }
	$Config_Path="../../upload/".$Config_FolderKey."/".$myFolder1."/";
	if(!file_exists($Config_Path)){ mkdir($Config_Path); chmod($Config_Path,0777); }
	$Config_Path="../../upload/".$Config_FolderKey."/".$myFolder1."/".$myFolder2."/";
	if(!file_exists($Config_Path)){ mkdir($Config_Path); chmod($Config_Path,0777); }
	//--------------------------------------------------------
	for($i=0;$i<=sizeof($arInputFileName);$i++) {
		if($arInputFileName[$i]<>"") {
			$arTmp=explode(".",$arInputFileName[$i]);
			$myFileType=strtolower($arTmp[sizeof($arTmp)-1]);
			$myNewFile=$myID."-".$mycount."-".$myTimeKey.".".$myFileType;
			$target_paths = $Config_Path.$myNewFile; 
			if(move_uploaded_file($arInputFileTmpName[$i],$target_paths)) {
				chmod($target_paths, 0777);
				if($myCurrentPhoto=="") {
					$myCurrentPhoto=$myNewFile.",";
				} else {
					$myCurrentPhoto.=$myNewFile.",";
				}
			}
			$mycount++;
		}
	}
	$sql = " UPDATE ".$myTable."  SET ".$myField."='".$myCurrentPhoto."' WHERE ".$myKeyField."='".$myID."' ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	echo " <script> ";
	echo " window.parent.doRefresh(); ";
	echo " </script> ";
	exit;
}
############################################################################
if($myAjaxAction=="multiple-photo-upload") {
	$Config_FolderKey=$myAjaxValue;
	//--------------------------------------------------------
	$myAjaxKeys=System_Decode($myAjaxKey);
	$arTmp=explode("#",$myAjaxKeys);
	// "UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
	$myTable=$arTmp[1];
	$myField=$arTmp[3];
	$myKeyField=$arTmp[6];
	$myID=$arTmp[8];
	$arInputFileName=$_FILES['inputFile']['name'];
	$arInputFileTmpName=$_FILES['inputFile']['tmp_name'];
	// Load Current Photo List -------------------------------
	$sql=" SELECT ".$myField." FROM ".$myTable." WHERE ".$myKeyField."='".$myID."' LIMIT 0,1 ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$Row = mysql_fetch_array($Query);
	$myCurrentPhoto=trim($Row[0]);
	if($myCurrentPhoto=="" || $myCurrentPhoto==",") {
		$mycount=0;
	} else {
		//find max count ------------------
		$mycount=0;
		$arCurrentPhoto=explode(",",$myCurrentPhoto);
		for($i=0;$i<=sizeof($arCurrentPhoto);$i++) {
			if($arCurrentPhoto[$i]<>"") {
				$arTemp=explode("-",$arCurrentPhoto[$i]);
				if($arTemp[1]<>"") {
					$mycount=$arTemp[1]*1;
				}
			}
		}
		$mycount++;
	}
	//--------------------------------------------------------
	$myTimeKey=str_replace(" ","",str_replace("-","",str_replace(":","",SYSTEM_DATETIMENOW)));
	//--------------------------------------------------------
	$myIDs=sprintf('%04d',$myID);
	$myFolder1=substr($myIDs,strlen($myIDs)-4,2);
	$myFolder2=substr($myIDs,strlen($myIDs)-2,2);
	$Config_Path="../../upload/".$Config_FolderKey."/";
	if(!file_exists($Config_Path)){ mkdir($Config_Path); chmod($Config_Path,0777); }
	$Config_Path="../../upload/".$Config_FolderKey."/".$myFolder1."/";
	if(!file_exists($Config_Path)){ mkdir($Config_Path); chmod($Config_Path,0777); }
	$Config_Path="../../upload/".$Config_FolderKey."/".$myFolder1."/".$myFolder2."/";
	if(!file_exists($Config_Path)){ mkdir($Config_Path); chmod($Config_Path,0777); }
	//--------------------------------------------------------
	for($i=0;$i<=sizeof($arInputFileName);$i++) {
		if($arInputFileName[$i]<>"") {
			$arTmp=explode(".",$arInputFileName[$i]);
			$myFileType=strtolower($arTmp[sizeof($arTmp)-1]);
			$myNewFile=$myID."-".$mycount."-".$myTimeKey.".".$myFileType;
			$target_paths = $Config_Path.$myNewFile; 
			if(move_uploaded_file($arInputFileTmpName[$i],$target_paths)) {
				chmod($target_paths, 0777);
				if($myCurrentPhoto=="") {
					$myCurrentPhoto=$myNewFile.",";
				} else {
					$myCurrentPhoto.=$myNewFile.",";
				}
			}
			$mycount++;
		}
	}
	$sql = " UPDATE ".$myTable."  SET ".$myField."='".$myCurrentPhoto."' WHERE ".$myKeyField."='".$myID."' ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	echo " <script> ";
	echo " window.parent.doRefresh(); ";
	echo " </script> ";
	exit;
}
############################################################################
if($myAjaxAction=="one-photo-upload") {
	$Config_FolderKey=$myAjaxValue;
	//--------------------------------------------------------
	$myAjaxKeys=System_Decode($myAjaxKey);
	$arTmp=explode("#",$myAjaxKeys);
	// "UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
	$myTable=$arTmp[1];
	$myField=$arTmp[3];
	$myKeyField=$arTmp[6];
	$myID=$arTmp[8];
	//--------------------------------------------------------
	$myUploadFileName=$_FILES['inputFile']['name'];
	//--------------------------------------------------------
	$arTmp=explode(".",$myUploadFileName);
	$myFileType=strtolower($arTmp[sizeof($arTmp)-1]);
	$myRand=mt_rand(111111,999999); 
	$myNewFile=$myID."-".$myRand.".".$myFileType;
	//--------------------------------------------------------
	$myIDs=sprintf('%04d',$myID);
	$myFolder1=substr($myIDs,strlen($myIDs)-4,2);
	$myFolder2=substr($myIDs,strlen($myIDs)-2,2);
	$Config_Path="../../upload/".$Config_FolderKey."/";
	if(!file_exists($Config_Path)){ mkdir($Config_Path); chmod($Config_Path,0775); }
	$Config_Path="../../upload/".$Config_FolderKey."/".$myFolder1."/";
	if(!file_exists($Config_Path)){ mkdir($Config_Path); chmod($Config_Path,0775); }
	$Config_Path="../../upload/".$Config_FolderKey."/".$myFolder1."/".$myFolder2."/";
	if(!file_exists($Config_Path)){ mkdir($Config_Path); chmod($Config_Path,0775); }
	//--------------------------------------------------------
	$target_path=$Config_Path;
	$target_paths = $target_path.$myNewFile;
	if(move_uploaded_file($_FILES['inputFile']['tmp_name'], $target_paths)) {
		chmod($target_paths, 0777);
		// Check for Delete File ---------------------------------
		$sql=" SELECT ".$myField." FROM ".$myTable." WHERE ".$myKeyField."='".$myID."' LIMIT 0,1 ";
		$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
		$Row = mysql_fetch_array($Query);
		$myOldFile=$Row[0];
		if($myOldFile<>"") { @unlink($target_path.$myOldFile); }
		//--------------------------------------------------------
		$sql = " UPDATE ".$myTable."  SET ".$myField."='".$myNewFile."' WHERE ".$myKeyField."='".$myID."' ";
		$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
		//--------------------------------------------------------
		echo " <script> ";
		echo " window.parent.showSaveFile".$myAjaxID."('<b><font color=green>Upload OK!</font></b>'); ";
		echo " </script> ";
		exit;
	} else {
		echo " <script> ";
		echo " window.parent.showSaveFile".$myAjaxID."('<b><font color=red>Upload error!</font></b>'); ";
		echo " </script> ";
		exit;
	}
}
############################################################################
if($myAjaxAction=="one-file-upload") {
	//--------------------------------------------------------
	$myAjaxKeys=System_Decode($myAjaxKey);
	$arTmp=explode("#",$myAjaxKeys);
	// "UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
	$myTable=$arTmp[1];
	$myField=$arTmp[3];
	$myKeyField=$arTmp[6];
	$myID=$arTmp[8];
	//--------------------------------------------------------
	$myUploadFileName=$_FILES['inputFile']['name'];
	//--------------------------------------------------------
	$arTmp=explode(".",$myUploadFileName);
	$myFileType=strtolower($arTmp[sizeof($arTmp)-1]);
	$myRand=mt_rand(111111,999999); 
	$myNewFile=$myID."-".$myRand."-".strtolower($myField).".".$myFileType;
	//--------------------------------------------------------
	$target_path = SYSTEM_DOC_ROOT."upload/".strtolower($myTable)."/";
	if (!is_dir($target_path)) { mkdir($target_path); chmod($target_path, 0777); }
	$target_paths = $target_path.$myNewFile; 
	if(move_uploaded_file($_FILES['inputFile']['tmp_name'], $target_paths)) {
		chmod($target_paths, 0777);
		// Check for Delete File ---------------------------------
		$sql=" SELECT ".$myField." FROM ".$myTable." WHERE ".$myKeyField."='".$myID."' LIMIT 0,1 ";
		$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
		$Row = mysql_fetch_array($Query);
		$myOldFile=$Row[0];
		if($myOldFile<>"") { @unlink($target_path.$myOldFile); }
		//--------------------------------------------------------
		$sql = " UPDATE ".$myTable."  SET ".$myField."='".$myNewFile."' WHERE ".$myKeyField."='".$myID."' ";
		$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
		//--------------------------------------------------------
		echo " <script> ";
		echo " window.parent.showSaveFile".$myAjaxID."('<b><font color=green>Upload OK!</font></b>'); ";
		echo " </script> ";
		exit;
	}
	echo " <script> ";
	echo " window.parent.showSaveFile('<b><font color=red>Upload error!</font></b>'); ";
	echo " </script> ";
	exit;
}
############################################################################
if($myAjaxAction=="data-update-date-thai") {
	$myAjaxKeys=System_Decode($myAjaxKey);
	$arTmp=explode("#",$myAjaxKeys);
	$myTable=$arTmp[1];
	$myField=$arTmp[3];
	$myKeyField=$arTmp[6];
	$myID=$arTmp[8];
	//--------------------------------------------------------
	$arTmp=explode("-",$myAjaxValue);
	$myAjaxValue=($arTmp[0]-543)."-".$arTmp[1]."-".$arTmp[2];
	//--------------------------------------------------------
	$sql = " UPDATE ".$myTable." SET ".$myField."='".addslashes($myAjaxValue)."' WHERE ".$myKeyField."='".$myID."' ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	//--------------------------------------------------------
	echo "Save!"; // : ".$myID;
	//--------------------------------------------------------
	exit;
}
############################################################################
if($myAjaxAction=="data-update-icon") {
	//--------------------------------------------------------
	$myAjaxKeys=System_Decode($myAjaxKey);
	$myAjaxKeys=str_replace("__","#",$myAjaxKeys);
	$arTmp=explode("#",$myAjaxKeys);
	$myTable=$arTmp[1];
	$myField=$arTmp[3];
	$myKeyField=$arTmp[6];
	$myID=$arTmp[8];
	//--------------------------------------------------------
	$sql = " UPDATE ".$myTable." SET ".$myField."='".addslashes($myAjaxValue)."' WHERE ".$myKeyField."='".$myID."' ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	//--------------------------------------------------------
	echo "Save!"; // : ".$myID;
	//--------------------------------------------------------
	exit;
}
############################################################################
if($myAjaxAction=="data-update") {
	//--------------------------------------------------------
	$myAjaxKeys=System_Decode($myAjaxKey);
	$arTmp=explode("#",$myAjaxKeys);
	$myTable=$arTmp[1];
	$myField=$arTmp[3];
	$myKeyField=$arTmp[6];
	$myID=$arTmp[8];
	//--------------------------------------------------------
	$sql = " UPDATE ".$myTable." SET ".$myField."='".addslashes($myAjaxValue)."' WHERE ".$myKeyField."='".$myID."' ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	//--------------------------------------------------------
	echo "Save!"; // : ".$myID;
	//--------------------------------------------------------
	exit;
}
############################################################################
if($myAjaxAction=="data-update-select") {
	//--------------------------------------------------------
	$myAjaxKeys=System_Decode($myAjaxKey);
	$arTmp=explode("#",$myAjaxKeys);
	$myTable=$arTmp[1];
	$myField=$arTmp[3];
	$myFieldText=$arTmp[5];
	$myKeyField=$arTmp[8];
	$myID=$arTmp[10];
	//--------------------------------------------------------
	if($myFieldText=='') {
		$sql = " UPDATE ".$myTable." SET ".$myField."='".addslashes($myAjaxValue)."' WHERE ".$myKeyField."='".$myID."' ";
	} else {
		$sql = " UPDATE ".$myTable." SET ".$myField."='".addslashes($myAjaxValue)."', ".$myFieldText."='".addslashes($myAjaxValue2)."' WHERE ".$myKeyField."='".$myID."' ";
	}
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	//--------------------------------------------------------
	echo "Save!"; // : ".$myID;
	//--------------------------------------------------------
	exit;
}
############################################################################
if($myAjaxAction=="load-icon" && $myAjaxValue<>"" ) {
	 ?>
	<div id="idIconShowPanel" style=" height:400px; overflow-x: scroll; ">
	<?php for($i=0;$i<sizeof($System_ArrayGlyphicon);$i++) { ?>
	<div class="pull-left padding-4" style="width:30px; height:30px; cursor:pointer; " onclick=" OneInput_SetIcon('<?php echo $myAjaxValue; ?>','glyphicon glyphicon-<?php echo $System_ArrayGlyphicon[$i]; ?>','<?php echo $myAjaxKey; ?>'); "><span class="glyphicon glyphicon-<?php echo $System_ArrayGlyphicon[$i]; ?> font-20"></span></div>
	<?php } ?>
	<?php for($i=0;$i<sizeof($System_ArrayFontAwesome);$i++) { ?>
	<div class="pull-left padding-4" style="width:30px; height:30px; cursor:pointer; " onclick=" OneInput_SetIcon('<?php echo $myAjaxValue; ?>','fa fa-<?php echo $System_ArrayFontAwesome[$i]; ?>','<?php echo $myAjaxKey; ?>'); "><span class="fa fa-<?php echo $System_ArrayFontAwesome[$i]; ?> font-20"></span></div>
	<?php } ?>
	</div>
	<script>
	$("#idIconShowPanel").mCustomScrollbar();
	</script>
	<?php
	exit;
}
############################################################################
if($myAjaxAction=="save-icon") {
	echo "OK";
	exit;
}
############################################################################
//MYSQL_CLOSE();
?>