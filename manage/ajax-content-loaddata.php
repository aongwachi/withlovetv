<?php 
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php }

## System Start ############################################################
include("../_config/config_system.php");
include_once(SYSTEM_DOC_ROOT."/system/core-start-ajax.php");
############################################################################
$myAjaxAction = trim($_REQUEST['myAjaxAction']);
$myAjaxID = trim($_REQUEST['myAjaxID']);
$myAjaxKey = trim($_REQUEST['myAjaxKey']);
$myAjaxValue = trim($_REQUEST['myAjaxValue']);
############################################################################
if($myAjaxAction=="add-new-tags" && $myAjaxID>0 && $myAjaxKey<>"") {
	$sql1=" SELECT ".TABLE_TAGS."_ID FROM ".TABLE_TAGS." WHERE ".TABLE_TAGS."_Name='".$myAjaxKey."' LIMIT 0,1 ";
	$Query1=MYSQL_QUERY($sql1,$System_Connection1) OR DIE("Error: ".$sql1."<br>\n");
	$Row1=mysql_fetch_array($Query1);
	if($Row1[0]>0) { // existed
		$myAjaxKey=$Row1[0];
	} else { // new
		$sql1=" INSERT INTO ".TABLE_TAGS." (".TABLE_TAGS."_Name) VALUES('".$myAjaxKey."') ";
		$Query1=MYSQL_QUERY($sql1,$System_Connection1) OR DIE("Error: ".$sql1."<br>\n");
		$myAjaxKey=mysql_insert_id();
	}
	// Load current tags ----------------------------------
	$sql=" SELECT * FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_ID='".$myAjaxID."' LIMIT 0,1 ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$Row = mysql_fetch_array($Query);
	$mytags=$Row[TABLE_CONTENT."_Tags"];
	if(strpos(" ".$mytags,",".$myAjaxKey.",")>0) {
		// skip
	} else {
		if($mytags=="") {
			$mytags=",".$myAjaxKey.",";
		} else {
			$mytags.=$myAjaxKey.",";
		}
	}
	$sql=" UPDATE ".TABLE_CONTENT." SET ".TABLE_CONTENT."_Tags='".$mytags."' WHERE ".TABLE_CONTENT."_ID='".$myAjaxID."' ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	//---------------------------------------------------------------------------
	$arTagsAll=explode(",",$mytags);
	$myTagsSQL=" ".TABLE_TAGS."_ID=0 ";
	for($x=0;$x<sizeof($arTagsAll);$x++) {
		if($arTagsAll[$x]>0) {
			$myTagsSQL.=" OR ".TABLE_TAGS."_ID='".$arTagsAll[$x]."' ";
		}
	}
	//---------------------------------------------------------------------------
	$sql1=" SELECT * FROM ".TABLE_TAGS." WHERE ".$myTagsSQL." ORDER BY ".TABLE_TAGS."_Name ASC ";
	$Query1=MYSQL_QUERY($sql1,$System_Connection1) OR DIE("Error: ".$sql1."<br>\n");
	while($Row1=mysql_fetch_array($Query1)) {
		echo '<div class="categoryTags pull-left cursor" onclick=" doRemoveTags('.$Row1[TABLE_TAGS."_ID"].'); ">&nbsp;#'.$Row1[TABLE_TAGS."_Name"]."&nbsp;</div>";
	}
	// Update Last Use Tags // Update Count Tags --------------------------------
	$sql1=" SELECT COUNT(*) FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_Tags LIKE '%,".$myAjaxKey.",%' ";
	$Query1=MYSQL_QUERY($sql1,$System_Connection1) OR DIE("Error: ".$sql1."<br>\n");
	$Row1=mysql_fetch_array($Query1);
	$myTagsCount=$Row1[0];
	$sql1=" UPDATE ".TABLE_TAGS." SET ".TABLE_TAGS."_NoOfUse='".$myTagsCount."', ".TABLE_TAGS."_LastUse='".SYSTEM_DATETIMENOW."' WHERE ".TABLE_TAGS."_ID='".$myAjaxKey."' ";
	$Query1=MYSQL_QUERY($sql1,$System_Connection1) OR DIE("Error: ".$sql1."<br>\n");
	//---------------------------------------------------------------------------
	exit;
}
############################################################################
if($myAjaxAction=="remove-tags" && $myAjaxID>0 && $myAjaxKey>0) {
	// Load current tags ----------------------------------
	$sql=" SELECT * FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_ID='".$myAjaxID."' LIMIT 0,1 ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$Row = mysql_fetch_array($Query);
	$mytags=$Row[TABLE_CONTENT."_Tags"];
	if($mytags==",") { $mytags=""; }
	$mytags=str_replace(','.$myAjaxKey.',',",",$mytags);
	$sql=" UPDATE ".TABLE_CONTENT." SET ".TABLE_CONTENT."_Tags='".$mytags."' WHERE ".TABLE_CONTENT."_ID='".$myAjaxID."' ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	//---------------------------------------------------------------------------
	$arTagsAll=explode(",",$mytags);
	$myTagsSQL=" ".TABLE_TAGS."_ID=0 ";
	for($x=0;$x<sizeof($arTagsAll);$x++) {
		if($arTagsAll[$x]>0) {
			$myTagsSQL.=" OR ".TABLE_TAGS."_ID='".$arTagsAll[$x]."' ";
		}
	}
	//---------------------------------------------------------------------------
	$sql1=" SELECT * FROM ".TABLE_TAGS." WHERE ".$myTagsSQL." ORDER BY ".TABLE_TAGS."_Name ASC ";
	$Query1=MYSQL_QUERY($sql1,$System_Connection1) OR DIE("Error: ".$sql1."<br>\n");
	while($Row1=mysql_fetch_array($Query1)) {
		echo '<div class="categoryTags pull-left cursor" onclick=" doRemoveTags('.$Row1[TABLE_TAGS."_ID"].'); ">&nbsp;#'.$Row1[TABLE_TAGS."_Name"]."&nbsp;</div>";
	}
	// Update Last Use Tags // Update Count Tags --------------------------------
	$sql1=" SELECT COUNT(*) FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_Tags LIKE '%,".$myAjaxKey.",%' ";
	$Query1=MYSQL_QUERY($sql1,$System_Connection1) OR DIE("Error: ".$sql1."<br>\n");
	$Row1=mysql_fetch_array($Query1);
	$myTagsCount=$Row1[0];
	$sql1=" UPDATE ".TABLE_TAGS." SET ".TABLE_TAGS."_NoOfUse='".$myTagsCount."', ".TABLE_TAGS."_LastUse='".SYSTEM_DATETIMENOW."' WHERE ".TABLE_TAGS."_ID='".$myAjaxKey."' ";
	$Query1=MYSQL_QUERY($sql1,$System_Connection1) OR DIE("Error: ".$sql1."<br>\n");
	//---------------------------------------------------------------------------
	exit;
}
############################################################################
if($myAjaxAction=="add-tags-click" && $myAjaxID>0 && $myAjaxKey<>"") {
	// Load current tags ----------------------------------
	$sql=" SELECT * FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_ID='".$myAjaxID."' LIMIT 0,1 ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$Row = mysql_fetch_array($Query);
	$mytags=$Row[TABLE_CONTENT."_Tags"];
	if(strpos(" ".$mytags,",".$myAjaxKey.",")>0) {
		// skip
	} else {
		if($mytags=="") {
			$mytags=",".$myAjaxKey.",";
		} else {
			$mytags.=$myAjaxKey.",";
		}
	}
	$sql=" UPDATE ".TABLE_CONTENT." SET ".TABLE_CONTENT."_Tags='".$mytags."' WHERE ".TABLE_CONTENT."_ID='".$myAjaxID."' ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	//---------------------------------------------------------------------------
	$arTagsAll=explode(",",$mytags);
	$myTagsSQL=" ".TABLE_TAGS."_ID=0 ";
	for($x=0;$x<sizeof($arTagsAll);$x++) {
		if($arTagsAll[$x]>0) {
			$myTagsSQL.=" OR ".TABLE_TAGS."_ID='".$arTagsAll[$x]."' ";
		}
	}
	//---------------------------------------------------------------------------
	$sql1=" SELECT * FROM ".TABLE_TAGS." WHERE ".$myTagsSQL." ORDER BY ".TABLE_TAGS."_Name ASC ";
	$Query1=MYSQL_QUERY($sql1,$System_Connection1) OR DIE("Error: ".$sql1."<br>\n");
	while($Row1=mysql_fetch_array($Query1)) {
		echo '<div class="categoryTags pull-left cursor" onclick=" doRemoveTags('.$Row1[TABLE_TAGS."_ID"].'); ">&nbsp;#'.$Row1[TABLE_TAGS."_Name"]."&nbsp;</div>";
	}
	// Update Last Use Tags // Update Count Tags --------------------------------
	$sql1=" SELECT COUNT(*) FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_Tags LIKE '%,".$myAjaxKey.",%' ";
	$Query1=MYSQL_QUERY($sql1,$System_Connection1) OR DIE("Error: ".$sql1."<br>\n");
	$Row1=mysql_fetch_array($Query1);
	$myTagsCount=$Row1[0];
	$sql1=" UPDATE ".TABLE_TAGS." SET ".TABLE_TAGS."_NoOfUse='".$myTagsCount."', ".TABLE_TAGS."_LastUse='".SYSTEM_DATETIMENOW."' WHERE ".TABLE_TAGS."_ID='".$myAjaxKey."' ";
	$Query1=MYSQL_QUERY($sql1,$System_Connection1) OR DIE("Error: ".$sql1."<br>\n");
	//---------------------------------------------------------------------------
	exit;
}
############################################################################
if($myAjaxAction=="add-tags" && $myAjaxID>0 && $myAjaxValue<>"" && $myAjaxKey<>"") {
	// Load current tags ----------------------------------
	$sql=" SELECT * FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_ID='".$myAjaxID."' LIMIT 0,1 ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$Row = mysql_fetch_array($Query);
	$mytags=$Row[TABLE_CONTENT."_Tags"];
	if(strpos(" ".$mytags,",".$myAjaxKey.",")>0) {
		// skip
	} else {
		if($mytags=="") {
			$mytags=",".$myAjaxKey.",";
		} else {
			$mytags.=$myAjaxKey.",";
		}
	}
	$sql=" UPDATE ".TABLE_CONTENT." SET ".TABLE_CONTENT."_Tags='".$mytags."' WHERE ".TABLE_CONTENT."_ID='".$myAjaxID."' ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	//---------------------------------------------------------------------------
	$arTagsAll=explode(",",$mytags);
	$myTagsSQL=" ".TABLE_TAGS."_ID=0 ";
	for($x=0;$x<sizeof($arTagsAll);$x++) {
		if($arTagsAll[$x]>0) {
			$myTagsSQL.=" OR ".TABLE_TAGS."_ID='".$arTagsAll[$x]."' ";
		}
	}
	//---------------------------------------------------------------------------
	$sql1=" SELECT * FROM ".TABLE_TAGS." WHERE ".$myTagsSQL." ORDER BY ".TABLE_TAGS."_Name ASC ";
	$Query1=MYSQL_QUERY($sql1,$System_Connection1) OR DIE("Error: ".$sql1."<br>\n");
	while($Row1=mysql_fetch_array($Query1)) {
		echo '<div class="categoryTags pull-left cursor" onclick=" doRemoveTags('.$Row1[TABLE_TAGS."_ID"].'); ">&nbsp;#'.$Row1[TABLE_TAGS."_Name"]."&nbsp;</div>";
	}
	// Update Last Use Tags // Update Count Tags --------------------------------
	$sql1=" SELECT COUNT(*) FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_Tags LIKE '%,".$myAjaxKey.",%' ";
	$Query1=MYSQL_QUERY($sql1,$System_Connection1) OR DIE("Error: ".$sql1."<br>\n");
	$Row1=mysql_fetch_array($Query1);
	$myTagsCount=$Row1[0];
	$sql1=" UPDATE ".TABLE_TAGS." SET ".TABLE_TAGS."_NoOfUse='".$myTagsCount."', ".TABLE_TAGS."_LastUse='".SYSTEM_DATETIMENOW."' WHERE ".TABLE_TAGS."_ID='".$myAjaxKey."' ";
	$Query1=MYSQL_QUERY($sql1,$System_Connection1) OR DIE("Error: ".$sql1."<br>\n");
	//---------------------------------------------------------------------------
	exit;
}
############################################################################
if($myAjaxAction=="search-tags") {
	// Load current tags ----------------------------------
	$sql=" SELECT * FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_ID='".$myAjaxID."' LIMIT 0,1 ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$Row = mysql_fetch_array($Query);
	$mytags=$Row[TABLE_CONTENT."_Tags"];
	//------------------------------------------------------------------------------
	$arTagsAll=explode(",",$mytags);
	$myTagsSQLNotIn=" AND ".TABLE_TAGS."_ID>0 ";
	for($x=0;$x<sizeof($arTagsAll);$x++) {
		if($arTagsAll[$x]>0) {
			$myTagsSQLNotIn.=" AND ".TABLE_TAGS."_ID<>'".$arTagsAll[$x]."' ";
		}
	}
	//------------------------------------------------------------------------------
	$index=0; $myFirstTagsID=0; $myFirstTagsName="";
	if($myAjaxValue=="") {
		$sql1=" SELECT * FROM ".TABLE_TAGS." WHERE ".TABLE_TAGS."_Name<>'' ".$myTagsSQLNotIn." ORDER BY ".TABLE_TAGS."_LastUse DESC LIMIT 0,20 ";
	} else {
		$sql1=" SELECT * FROM ".TABLE_TAGS." WHERE ".TABLE_TAGS."_Name LIKE '%".$myAjaxValue."%' ".$myTagsSQLNotIn." ORDER BY ".TABLE_TAGS."_Name ASC LIMIT 0,20 ";
	}
	$Query1=MYSQL_QUERY($sql1,$System_Connection1) OR DIE("Error: ".$sql1."<br>\n");
	while($Row1=mysql_fetch_array($Query1)) {
		if($index==0) {
			echo '<div class="categoryTagsX pull-left cursor" onclick=" doAddTagsClick('.$Row1[TABLE_TAGS."_ID"].'); ">&nbsp;#'.$Row1[TABLE_TAGS."_Name"].'&nbsp;</div>';
		} else {
			echo '<div class="categoryTags pull-left cursor" onclick=" doAddTagsClick('.$Row1[TABLE_TAGS."_ID"].'); ">&nbsp;#'.$Row1[TABLE_TAGS."_Name"].'&nbsp;</div>';
		}
		if($myFirstTagsID==0) {
			$myFirstTagsID=$Row1[TABLE_TAGS."_ID"];
			$myFirstTagsName=$Row1[TABLE_TAGS."_Name"];
		}
		$index++;
	}
	if($index==0) {
		echo " &nbsp;&nbsp;<font color=#AA0000><b>ขออภัย! ไม่พบแท็กที่ค้นหา ( Enter เพื่อเพิ่มใหม่ )</b></font>";
	}
	?>
	<input type="hidden" id="inputFirstTagsID" name="inputFirstTagsID" value="<?php echo $myFirstTagsID; ?>" />
	<input type="hidden" id="inputFirstTagsName" name="inputFirstTagsName" value="<?php echo $myFirstTagsName; ?>" />
	<?php
	exit;	
}
############################################################################
if($myAjaxAction=="set-tags" && $myAjaxID>0) {
	$myselecttags=$myAjaxKey;
	// Load current tags ----------------------------------
	$sql=" SELECT * FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_ID='".$myAjaxID."' LIMIT 0,1 ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$Row = mysql_fetch_array($Query);
	$mytags=$Row[TABLE_CONTENT."_Category"];
	if($mytags=="") { $mytags=","; }
	if(strpos(" ".$mytags,",".$myselecttags.",")>0) { // exist , remove
		$tmptags=",";
		$arTmp=explode(",",$mytags);
		for($i=0;$i<=sizeof($arTmp);$i++) {
			if($arTmp[$i]<>"") {
				if($arTmp[$i]==$myselecttags) {
					// skip
				} else {
					$tmptags=$tmptags.$arTmp[$i].",";
				}
				
			}
		}
		$mytags=$tmptags;
		echo 'no';
	} else { // not exist , add
		$mytags=$mytags.$myselecttags.",";
		echo 'yes';
	}
	// Update tags ----------------------------------
	$sql=" UPDATE ".TABLE_CONTENT." SET ".TABLE_CONTENT."_Category='".$mytags."' WHERE ".TABLE_CONTENT."_ID='".$myAjaxID."' ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	exit;
}
############################################################################
if($myAjaxAction=="delete-photo-list" && $myAjaxID>0) {
	$Config_FolderKey=$myAjaxValue;
	//--------------------------------------------------------
	$myIDs=sprintf('%04d',$myAjaxID);
	$myFolder1=substr($myIDs,strlen($myIDs)-4,2);
	$myFolder2=substr($myIDs,strlen($myIDs)-2,2);
	$Config_Path="../upload/".$Config_FolderKey."/".$myFolder1."/".$myFolder2."/";
	//--------------------------------------------------------
	$sql=" SELECT * FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_ID='".$myAjaxID."' ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$Row = mysql_fetch_array($Query);
	$myText=$Row[TABLE_CONTENT."_Photo"];
	$arPhotoList=explode(",",$myText);
	$myPhotoText="";
	for($i=0;$i<=sizeof($arPhotoList);$i++) {
	    if($arPhotoList[$i]<>"") {
		if($arPhotoList[$i]<>$myAjaxKey) {
			$myPhotoText.=$arPhotoList[$i].",";
		} else {
			unlink($Config_Path.$arPhotoList[$i]);
		}
	    }
	}
	if($myPhotoText==",") { $myPhotoText=""; }
	$sql=" UPDATE ".TABLE_CONTENT." SET ".TABLE_CONTENT."_Photo='".$myPhotoText."' WHERE ".TABLE_CONTENT."_ID='".$myAjaxID."' ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	echo 'OK';
	exit;
}
############################################################################
if($myAjaxAction=="save-video" && $myAjaxID>0) {
	if(trim($myAjaxValue)<>"") {
	   $isVideo=1;
	} else {
	   $isVideo=0;
	}
	//----------------------------------------
	$sql=" SELECT * FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_ID='".$myAjaxID."' ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$Row = mysql_fetch_array($Query);
	$myText=$Row[TABLE_CONTENT."_Text"];
	$myLayout=$Row[TABLE_CONTENT."_Layout"];
	//----------------------------------------
	$arText=explode("[#####]",$myText);
	$arLayout=explode(",",strtolower($myLayout));
	//----------------------------------------
	if($myText=="") {
		$myData="";
		for($i=0;$i<=sizeof($arLayout);$i++) {
			if($arLayout[$i]<>"") {
				if($myAjaxKey==$i) {
					$myData.='video[@@@]'.$myAjaxValue.'[#####]\n';
				} else {
					$myData.=$arLayout[$i].'[@@@][#####]\n';
				}
			}
		}
	} else {
		$arText[$myAjaxKey]='video[@@@]'.$myAjaxValue;
		$myData=implode("[#####]\n",$arText);
	}
	$sql=" UPDATE ".TABLE_CONTENT." SET ".TABLE_CONTENT."_Text='".addslashes($myData)."',".TABLE_CONTENT."_isVideo='".$isVideo."' WHERE ".TABLE_CONTENT."_ID='".$myAjaxID."' ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	echo "Saved!";
	exit;
}
############################################################################
if($myAjaxAction=="save-text" && $myAjaxID>0) {
	$sql=" SELECT * FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_ID='".$myAjaxID."' ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$Row = mysql_fetch_array($Query);
	$myText=$Row[TABLE_CONTENT."_Text"];
	$myLayout=$Row[TABLE_CONTENT."_Layout"];
	//----------------------------------------
	$arText=explode("[#####]",$myText);
	$arLayout=explode(",",strtolower($myLayout));
	//----------------------------------------
	$myAjaxValue=str_replace('src="../lib/tinymce/','src="'.$SYSTEM_WEB_CDN_PATH_FULL.'/lib/tinymce/',$myAjaxValue);
	$myAjaxValue=str_replace('src="../upload/','src="'.$SYSTEM_WEB_CDN_PATH_FULL.'/upload/',$myAjaxValue);
	//----------------------------------------
	if($myText=="") {
		$myData="";
		for($i=0;$i<=sizeof($arLayout);$i++) {
			if($arLayout[$i]<>"") {
				if($myAjaxKey==$i) {
					$myData.='text[@@@]'.$myAjaxValue.'[#####]\n';
				} else {
					$myData.=$arLayout[$i].'[@@@][#####]\n'; 
				}
			}
		}
	} else {
		$arText[$myAjaxKey]='text[@@@]'.$myAjaxValue;
		$myData=implode("[#####]\n",$arText);
	}
	$sql=" UPDATE ".TABLE_CONTENT." SET ".TABLE_CONTENT."_Text='".addslashes($myData)."-:)"."' WHERE ".TABLE_CONTENT."_ID='".$myAjaxID."' ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	echo "Saved!";
	exit;
}
############################################################################
if($myAjaxAction=="save-ads" && $myAjaxID>0) {
	$sql=" SELECT * FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_ID='".$myAjaxID."' ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$Row = mysql_fetch_array($Query);
	$myText=$Row[TABLE_CONTENT."_Text"];
	$myLayout=$Row[TABLE_CONTENT."_Layout"];
	//----------------------------------------
	$arText=explode("[#####]",$myText);
	$arLayout=explode(",",strtolower($myLayout));
	//----------------------------------------
	if($myText=="") {
		$myData="";
		for($i=0;$i<=sizeof($arLayout);$i++) {
			if($arLayout[$i]<>"") {
				if($myAjaxKey==$i) {
					$myData.='ads[@@@]'.$myAjaxValue.'[#####]\n';
				} else {
					$myData.=$arLayout[$i].'[@@@][#####]\n';
				}
			}
		}
	} else {
		$arText[$myAjaxKey]='ads[@@@]'.$myAjaxValue;
		$myData=implode("[#####]\n",$arText);
	}
	$sql=" UPDATE ".TABLE_CONTENT." SET ".TABLE_CONTENT."_Text='".addslashes($myData)."' WHERE ".TABLE_CONTENT."_ID='".$myAjaxID."' ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	echo "Saved!";
	exit;
}
############################################################################
MYSQL_CLOSE();
?>