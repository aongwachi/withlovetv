<?php
include_once("_config/config_system.php");
include_once(SYSTEM_DOC_ROOT . "system/core-start-ajax-home.php");
####################################################################################
$sql1 = " SELECT " . TABLE_THEME . "_Key FROM " . TABLE_THEME . " WHERE 1 ORDER BY " . TABLE_THEME . "_Selected DESC," . TABLE_THEME . "_ID ASC LIMIT 0,1 ";
$query1 = $dbh->prepare($sql1);
if ($query1->execute()) {
    $Row1 = $query1->fetch();
    if ($Row1[0] > 0) {
        $myThemeKey = $Row1[0];
    } else {
        $myThemeKey = 1;
    }
}
####################################################################################
$page = (isset($_GET['page']) ? $_GET['page'] : null);
$page = trim($page) * 1;
if ($page == "") {
    $page = 1;
}
####################################################################################
$Config_PageSize = 12;
$Config_FolderKey2 = "thumb2";
$pagepadding = 5;
//######################################################################################
$sql = "SELECT COUNT(*) FROM " . TABLE_PROGRAM;
$query = $dbh->prepare($sql);
$query->execute();
$Row = $query->fetch();
$TotalRecordCount = $Row[0];
$RecordStart = ($page - 1) * $Config_PageSize;
if ($TotalRecordCount > 0) {
    $looper = 1;
    $arContentSubject = "";
    $arContentThumb = "";
    $arContentType = "";
    $arContentDetail = "";
    //--------------------------------------------
    $sql = "SELECT * FROM " . TABLE_PROGRAM . " ORDER BY " . TABLE_PROGRAM . "_ID DESC LIMIT " . $RecordStart . "," . $Config_PageSize . " ";
    $query = $dbh->prepare($sql);
    if ($query->execute($params)) {
        while ($Row = $query->fetch()) {
            $myID = $Row[TABLE_PROGRAM . "_ID"];
            //--------------------------------------------
            $myIDs = sprintf('%04d', $myID);
            $myFolder1 = substr($myIDs, strlen($myIDs) - 4, 2);
            $myFolder2 = substr($myIDs, strlen($myIDs) - 2, 2);
            //--------------------------------------------
            $arContentID[$looper] = $Row[TABLE_PROGRAM . "_URL"];
            $arContentSubject[$looper] = $Row[TABLE_PROGRAM . "_Name"];
            $arContentDetail[$looper] = $Row[TABLE_PROGRAM . "_Detail"];
            $arContentThumb[$looper] = $Row[TABLE_PROGRAM . "_Image_Url"];
            $arContentType[$looper] = $Row[TABLE_PROGRAM . "_Type"];
            //--------------------------------------------
            $looper++;
        }
    }
}
####################################################################################
include_once("shared/header" . $myThemeKey . ".php");
include_once("video" . $myThemeKey . ".php");
include_once("shared/footer" . $myThemeKey . ".php");
####################################################################################
?>