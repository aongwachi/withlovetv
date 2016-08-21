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
$searchKey=(isset($_GET['searchKey'])?$_GET['searchKey']:'');
//$catid = 3;
$arrMyCategoryName = [];
$listArContentId = [];
$listArContentSubject = [];
$listArContentThumb = [];
for($i=1;$i<=6;$i++){
    searchContent($dbh,$i,$searchKey,
        $arrMyCategoryName[$i],
        $myFolderName,$listArContentId,
        $listArContentSubject, $listArContentThumb);
}
$videoId = "";
$videoSubject = "";
$videoThumb ="";
$videoUrl = "";
searchVideo($dbh,$searchKey,$videoId,$videoSubject,$videoThumb,$videoUrl);
####################################################################################
include_once("shared/header" . $myThemeKey . ".php");
include_once("searchKey" . $myThemeKey . ".php");
include_once("shared/footer" . $myThemeKey . ".php");
####################################################################################

function searchContent($dbh,$catid,$searchKey,
                       &$myCategoryName,
                       &$myFolderName,&$listArContentId,
                       &$listArContentSubject, &$listArContentThumb
)
{
    $sql = "SELECT * FROM " . TABLE_CATEGORY . " WHERE " . TABLE_CATEGORY . "_ID=".$catid." LIMIT 0,1 ";
    $query = $dbh->prepare($sql);
    if ($query->execute()) {
        $Row = $query->fetch();
        $myCategoryName[] = $Row[TABLE_CATEGORY . "_Name"];
        $myFolderName = $Row[TABLE_CATEGORY . "_Folder"];
    } else {
        print_r($query->errorInfo());
    }
####################################################################################
    $Config_FolderKey2 = "thumb2";
//######################################################################################
    $looper = 1;
    $arContentID = "";
    $arContentSubject = "";
    $arContentThumb = "";
//--------------------------------------------
    $params = array("%,$catid,%");
    $sql =  " SELECT * FROM " . TABLE_CONTENT .
            " WHERE " . TABLE_CONTENT . "_Category LIKE ? AND " . TABLE_CONTENT . "_Thumb<>'' ".
            " AND " . TABLE_CONTENT . "_Subject LIKE '%".$searchKey."%'  AND " . TABLE_CONTENT . "_Text<>''  ".
            " AND " . TABLE_CONTENT . "_Status='Publish' ".
            " ORDER BY " . TABLE_CONTENT . "_Pin DESC , " . TABLE_CONTENT . "_OnlineDate DESC";
    $query = $dbh->prepare($sql);
    if ($query->execute($params)) {
        while ($Row = $query->fetch()) {
            $myID = $Row[TABLE_CONTENT . "_ID"];
            //--------------------------------------------
            $myIDs = sprintf('%04d', $myID);
            $myFolder1 = substr($myIDs, strlen($myIDs) - 4, 2);
            $myFolder2 = substr($myIDs, strlen($myIDs) - 2, 2);
            $Config_Path2 = "upload/" . $Config_FolderKey2 . "/" . $myFolder1 . "/" . $myFolder2 . "/";
            //--------------------------------------------
            $arContentID[$looper] = $Row[TABLE_CONTENT . "_ID"];
            $arContentSubject[$looper] = $Row[TABLE_CONTENT . "_Subject"];
            $arContentThumb[$looper] = $Config_Path2 . $Row[TABLE_CONTENT . "_Thumb2"];
            //--------------------------------------------
            $looper++;
        }
        $listArContentId[] = $arContentID;
        $listArContentThumb[] = $arContentThumb;
        $listArContentSubject[] = $arContentSubject;
    }
}
function searchVideo($dbh,$searchKey,&$videoId,&$videoSubject,&$videoThumb,&$videoUrl)
{
    $sql =  " SELECT * FROM " . TABLE_PROGRAM .
            " WHERE " . TABLE_PROGRAM . "_Name LIKE '%".$searchKey."%' OR " . TABLE_PROGRAM . "_Detail LIKE '%".$searchKey."%'".
            " ORDER BY " . TABLE_PROGRAM . "_StartTime DESC";
    $query = $dbh->prepare($sql);
    $looper = 1;
    $videoId = "";
    $videoSubject = "";
    $videoThumb = "";
    $videoUrl = "";
    if ($query->execute()) {
        while ($Row = $query->fetch()) {
            $videoId[$looper] = $Row[TABLE_PROGRAM . "_ID"];
            $videoSubject[$looper] = $Row[TABLE_PROGRAM . "_Name"];
            $videoThumb[$looper] = $Row[TABLE_PROGRAM . "_Image_Url"];
            $videoUrl[$looper] = $Row[TABLE_PROGRAM . "_URL"];
            //--------------------------------------------
            $looper++;
        }
    }
}
?>