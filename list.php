<?php
include_once("_config/config_system.php");
include_once(SYSTEM_DOC_ROOT."system/core-start-ajax-home.php");
####################################################################################
$sql1=" SELECT ".TABLE_THEME."_Key FROM ".TABLE_THEME." WHERE 1 ORDER BY ".TABLE_THEME."_Selected DESC,".TABLE_THEME."_ID ASC LIMIT 0,1 ";
$query1=$dbh->prepare($sql1);
if($query1->execute()) {
    $Row1=$query1->fetch();
    if($Row1[0]>0) {
        $myThemeKey=$Row1[0];
    } else {
        $myThemeKey=1;
    }
}
####################################################################################
$catid=(isset($_GET['catid'])?$_GET['catid']:null);
$catid=trim($catid)*1;
if($catid=="") { exit; }
$page=(isset($_GET['page'])?$_GET['page']:null);
$page=trim($page)*1;
if($page=="") { $page=1; }
####################################################################################
$sql="SELECT * FROM ".TABLE_CATEGORY." WHERE ".TABLE_CATEGORY."_ID=:catid LIMIT 0,1 ";
$query=$dbh->prepare($sql);
$query->bindParam(':catid', $catid, PDO::PARAM_INT);
if($query->execute()) {
    $Row=$query->fetch();
    $myCategoryName=$Row[TABLE_CATEGORY."_Name"];
    $myFolderName=$Row[TABLE_CATEGORY."_Folder"];
    if($Row[TABLE_CATEGORY."_Title"]!=""){
        $meta_title = $Row[TABLE_CATEGORY."_Title"];
    } else {
        $meta_title = $Row[TABLE_CATEGORY."_Name"];
    }
    if($Row[TABLE_CATEGORY."_Keyword"]!=""){
        $meta_keyword = $Row[TABLE_CATEGORY."_Keyword"];
    } else {
        $meta_keyword = $Row[TABLE_CATEGORY."_Name"];
    }
    if($Row[TABLE_CATEGORY."_Description"]!=""){
        $meta_description = $Row[TABLE_CATEGORY."_Description"];
    } else {
        $meta_description = $meta_keyword;
    }	
} else { print_r($query->errorInfo()); }
$System_Title = $meta_title;
$System_Keyword = $meta_keyword;
$System_Description = $meta_description;
####################################################################################
$Config_PageSize=12; $Config_FolderKey2="thumb2"; $pagepadding=5;
//######################################################################################
$params = array("%,$catid,%");
$sql="SELECT COUNT(*) FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_Category LIKE ? AND ".TABLE_CONTENT."_Thumb<>'' AND ".TABLE_CONTENT."_Subject<>''  AND ".TABLE_CONTENT."_Text<>''  AND ".TABLE_CONTENT."_Status='Publish' ";
$query=$dbh->prepare($sql);
$query->execute($params);
$Row=$query->fetch();
$TotalRecordCount=$Row[0];
$RecordStart=($page-1)*$Config_PageSize;
if($TotalRecordCount>0) {
    $looper=1; $arContentSubject=""; $arContentThumb="";
    //--------------------------------------------
    $params = array("%,$catid,%");
    $sql="SELECT * FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_Category LIKE ? AND ".TABLE_CONTENT."_Thumb<>'' AND ".TABLE_CONTENT."_Subject<>''  AND ".TABLE_CONTENT."_Text<>''  AND ".TABLE_CONTENT."_Status='Publish' ORDER BY ".TABLE_CONTENT."_Pin DESC , ".TABLE_CONTENT."_OnlineDate DESC LIMIT ".$RecordStart.",".$Config_PageSize." ";
    $query=$dbh->prepare($sql);
    if($query->execute($params)) {
        while($Row=$query->fetch()) {
            $myID=$Row[TABLE_CONTENT."_ID"];
            //--------------------------------------------
            $myIDs=sprintf('%04d',$myID);
            $myFolder1=substr($myIDs,strlen($myIDs)-4,2);
            $myFolder2=substr($myIDs,strlen($myIDs)-2,2);
            $Config_Path2="upload/".$Config_FolderKey2."/".$myFolder1."/".$myFolder2."/";
            //--------------------------------------------
            $arContentID[$looper]=$Row[TABLE_CONTENT."_ID"];
            $arContentSubject[$looper]=$Row[TABLE_CONTENT."_Subject"];
            $arContentThumb[$looper]=$Config_Path2.$Row[TABLE_CONTENT."_Thumb2"];
            //--------------------------------------------
            $looper++;
        }
    }
}
####################################################################################  
include_once("shared/header".$myThemeKey.".php");
include_once("list".$myThemeKey.".php");
include_once("shared/footer".$myThemeKey.".php");
####################################################################################
?>