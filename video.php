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


####################################################################################
include_once("shared/header".$myThemeKey.".php");
include_once("video".$myThemeKey.".php");
include_once("shared/footer".$myThemeKey.".php");
####################################################################################