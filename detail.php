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
$p=(isset($_GET['p'])?$_GET['p']:null);
$p=trim($p)*1;
if($p=="") { exit; }
####################################################################################
$sql="SELECT * FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_ID=:p LIMIT 0,1 ";
$query=$dbh->prepare($sql);
$query->bindParam(':p', $p, PDO::PARAM_INT);
if($query->execute()) {
    $Row=$query->fetch();
    $mySubject=$Row[TABLE_CONTENT."_Subject"];
    $myID=$Row[TABLE_CONTENT."_ID"];
    if($myID==0 || $myID=="") { exit; }
    $myText=$Row[TABLE_CONTENT."_Text"];
    $myPhoto=$Row[TABLE_CONTENT."_Photo"];
    $myCreateByStaffID=$Row[TABLE_CONTENT."_CreateByStaffID"];
    $myOnlineDate=$Row[TABLE_CONTENT."_OnlineDate"];
    $myCategory=$Row[TABLE_CONTENT."_Category"];
    $myTags=$Row[TABLE_CONTENT."_Tags"];
    $myThumb2=$Row[TABLE_CONTENT."_Thumb2"];
    $myThumbFB=$Row[TABLE_CONTENT."_ThumbFB"];
    for($x=1;$x<=4;$x++) {
        $arRefName[$x]=$Row[TABLE_CONTENT."_RefName".$x];
        $arRefLink[$x]=$Row[TABLE_CONTENT."_RefLink".$x];
    }
    $myAdsSelect=$Row[TABLE_CONTENT."_AdsSelect"];
} else { print_r($query->errorInfo()); }
$System_Title=$mySubject;
//--------------------------------------------
$myIDs=sprintf('%04d',$myID);
$myFolder1=substr($myIDs,strlen($myIDs)-4,2);
$myFolder2=substr($myIDs,strlen($myIDs)-2,2);
if($myThumbFB<>"") {
    $PictureThumbFB="upload/thumbfb/".$myFolder1."/".$myFolder2."/".$myThumbFB;
} else {
    $PictureThumbFB="upload/thumb2/".$myFolder1."/".$myFolder2."/".$myThumb2;
}
//--------------------------------------------
$myTextAll="";
$arText=explode("[#####]",$myText);
for($i=0;$i<sizeof($arText);$i++) {
    if($arText[$i]<>"") {
        if(strpos($arText[$i],"[@@@]")>0) {
            $arText1=explode("[@@@]",$arText[$i]);
            if(trim($arText1[0])=="text") {
                $myTextAll.=" ".$arText1[1];
            }
        }
    }
}
$myTextAll=trim(str_replace('&nbsp;',' ',strip_tags($myTextAll)));
$myTextAll=mb_substr($myTextAll,0,200,'UTF-8');
//--------------------------------------------------------------
$System_HeaderMetaTag='';
$System_HeaderMetaTag.='<meta property="fb:app_id" content="'.CONFIG_APPID.'">';
$System_HeaderMetaTag.='<meta itemprop="description" content="'.htmlentities($myTextAll).'">';
$System_HeaderMetaTag.='<meta itemprop="image" content="'.$PictureThumbFB.'">';
$System_HeaderMetaTag.='<meta itemprop="name" content="'.htmlentities($mySubject).'">';
$System_HeaderMetaTag.='<meta name="author" content="BAABIN">';
$System_HeaderMetaTag.='<meta name="description" itemprop="description" content="'.htmlentities($myTextAll).'">';
$System_HeaderMetaTag.='<meta property="article:author" content="https://www.facebook.com/BaaBinFanpage">';
$System_HeaderMetaTag.='<meta property="article:publisher" content="https://www.facebook.com/BaaBinFanpage">';
$System_HeaderMetaTag.='<meta property="og:locale" content="th_TH">';
$System_HeaderMetaTag.='<meta property="og:site_name" content="'.SYSTEM_WEB_TITLE.'">';
$System_HeaderMetaTag.='<meta property="og:url" content="http://www.baabin.com/'.$p.'/" />';
$System_HeaderMetaTag.='<meta property="og:type" content="article" />';
$System_HeaderMetaTag.='<meta property="og:title" content="'.htmlentities($mySubject).'" />';
$System_HeaderMetaTag.='<meta property="og:description" content="'.htmlentities($myTextAll).'" />';
$System_HeaderMetaTag.='<meta property="og:image" content="'.$PictureThumbFB.'" />';
$System_Title=htmlentities($mySubject);
####################################################################################
$arID=""; $arThumb1=""; $arThumb2=""; $arThumb3=""; $arSubject=""; $loop=1;
//-------------------------------------------------------------
$sql="SELECT * FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_Thumb<>'' AND ".TABLE_CONTENT."_Subject<>'' AND ".TABLE_CONTENT."_Text<>'' AND ".TABLE_CONTENT."_Status='Publish' ORDER BY RAND() LIMIT 0,5 ";
$query=$dbh->prepare($sql);
if($query->execute()) {
    while($Row=$query->fetch()) {
        $myID=$Row[TABLE_CONTENT."_ID"];
        //--------------------------------------------
        $myIDs=sprintf('%04d',$myID);
        $myFolder1=substr($myIDs,strlen($myIDs)-4,2);
        $myFolder2=substr($myIDs,strlen($myIDs)-2,2);
        $Config_Path1="upload/thumb/".$Config_FolderKey1."/".$myFolder1."/".$myFolder2."/";
        $Config_Path2="upload/thumb2/".$Config_FolderKey2."/".$myFolder1."/".$myFolder2."/";
        $Config_Path3="upload/thumb3/".$Config_FolderKey3."/".$myFolder1."/".$myFolder2."/";
        if($Row[TABLE_CONTENT."_Thumb"]=="") {  $PictureThumb1=""; } else { $PictureThumb1=$Config_Path1.$Row[TABLE_CONTENT."_Thumb"]; }
        if($Row[TABLE_CONTENT."_Thumb2"]=="") { $PictureThumb2=""; } else { $PictureThumb2=$Config_Path2.$Row[TABLE_CONTENT."_Thumb2"]; }
        if($Row[TABLE_CONTENT."_Thumb3"]=="") { $PictureThumb3=""; } else { $PictureThumb3=$Config_Path3.$Row[TABLE_CONTENT."_Thumb3"]; }
        //--------------------------------------------
        $arID[$loop]=$Row[TABLE_CONTENT."_ID"];
        $arThumb1[$loop]=$PictureThumb1;
        $arThumb2[$loop]=$PictureThumb2;
        $arThumb3[$loop]=$PictureThumb3;
        $arSubject[$loop]=$Row[TABLE_CONTENT."_Subject"];
        $loop++;
    }
}
####################################################################################
include_once("shared/header".$myThemeKey.".php");
include_once("detail".$myThemeKey.".php");
include_once("shared/footer".$myThemeKey.".php");
####################################################################################
?>