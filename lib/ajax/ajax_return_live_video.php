<?php
include_once("../../_config/config_system.php");
include_once(SYSTEM_DOC_ROOT."system/core-start-ajax-home.php");
$sql_recommend_video = " SELECT * FROM ".TABLE_LIVE." WHERE 1  LIMIT 3 ";
$query_reccommend = $dbh->prepare($sql_recommend_video);
$vidRecommend = [];
if ($query_reccommend->execute()) {
    while ($row = $query_reccommend->fetch()) {
        $res = [];
        $res['title'] = $row[TABLE_LIVE . "_Title"];
        $res['link'] = $row[TABLE_LIVE . "_Link"];
        $res['link_mobile'] = $row[TABLE_LIVE . "_LinkMobile"];
        $res['resolution'] = $row[TABLE_LIVE . "_Resolution"];
        $res['datetime'] = $row[TABLE_LIVE . "_Datetime"];
        $vidRecommend[] = $res;
    }
}
header('Content-Type: application/json');
echo json_encode($vidRecommend);
