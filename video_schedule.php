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
$searchKey=(isset($_GET['day'])?$_GET['day']:'');
$searchKey = getDateFromWeekDay($searchKey);
$videoId = "";
$videoSubject = "";
$videoThumb ="";
$videoUrl = "";
$videoDetail = "";
$videoDate = "";
searchVideo($dbh,$searchKey,$videoId,$videoSubject,$videoDetail,$videoDate,$videoThumb,$videoUrl);
####################################################################################
include_once("shared/header" . $myThemeKey . ".php");
include_once("video_schedule_result.php");
include_once("shared/footer" . $myThemeKey . ".php");
####################################################################################
function searchVideo($dbh,$searchKey,&$videoId,&$videoSubject,&$videoDetail,&$videoDate,&$videoThumb,&$videoUrl)
{
    $day = date('Y-m-d',strtotime($searchKey));
    $tomorrow = date('Y-m-d', strtotime($day. ' + 1 days'));
    $sql =  " SELECT * FROM " . TABLE_PROGRAM .
            " WHERE " . TABLE_PROGRAM . "_StartTime >= '".$day."' AND ". TABLE_PROGRAM . "_StartTime < '".$tomorrow."' ".
            " ";
    $query = $dbh->prepare($sql);
    $looper = 1;
    $videoId = "";
    $videoSubject = "";
    $videoDetail = "";
    $videoDate = "";
    $videoThumb = "";
    $videoUrl = "";
    if ($query->execute()) {
        while ($Row = $query->fetch()) {
            $videoId[$looper] = $Row[TABLE_PROGRAM . "_ID"];
            $videoSubject[$looper] = $Row[TABLE_PROGRAM . "_Name"];
            $videoDetail[$looper] = $Row[TABLE_PROGRAM . "_Detail"];
            $videoDate[$looper] = $Row[TABLE_PROGRAM . "_StartTime"];
            $videoThumb[$looper] = $Row[TABLE_PROGRAM . "_Image_Url"];
            $videoUrl[$looper] = $Row[TABLE_PROGRAM . "_URL"];
            //--------------------------------------------
            $looper++;
        }
    }
}
function getDateFromWeekDay($weekDay)
{
    $date = new DateTime();
    $week = $date->format("W");
    $year = $date->format("Y");
    $gendate = new DateTime();
    $gendate->setISODate($year,$week,$weekDay);
    $dateStr = $gendate->format('d-m-Y');
    return $dateStr;
}
?>