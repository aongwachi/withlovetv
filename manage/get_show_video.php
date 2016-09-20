<?php
include_once(SYSTEM_DOC_ROOT."_config/config_system.php");
include_once(SYSTEM_DOC_ROOT . "system/core-start-ajax-home.php");

function getTvShow($dbh)
{
    $sql =  " SELECT * FROM " . TABLE_SHOW;

    $query = $dbh->prepare($sql);
    $showID = array();
    $showName = array();
    $arrShow = array();

    if ($query->execute()) {
        while ($Row = $query->fetch()) {
            $showID[] = $Row[TABLE_SHOW . "_ID"];
            $showName[] = $Row[TABLE_SHOW . "_Name"];
        }
    }
    $arrShow['id'] = $showID;
    $arrShow['name'] = $showName;
    return $arrShow;
}
function getKeyValTvShow($dbh)
{
    $sql =  " SELECT * FROM " . TABLE_SHOW;

    $query = $dbh->prepare($sql);
    $showID = array();

    if ($query->execute()) {
        while ($Row = $query->fetch()) {
            $showID[$Row[TABLE_SHOW . "_ID"]] = $Row[TABLE_SHOW . "_Name"];
        }
    }
    return $showID;
}