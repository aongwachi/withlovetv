<?php
#############################################################################################################################################
$sqlSettingMenu=" FROM ".TABLE_MENU." WHERE ".TABLE_MENU."_Name<>'' AND ".TABLE_MENU."_Link<>'' AND ".TABLE_MENU."_Type='Setting'  AND ".TABLE_MENU."_Status='Enable' ";
if($SystemSession_Staff_ID>0 && $SystemSession_Staff_Level=="Admin") {
    $sqlSettingMenu.=" AND (".TABLE_MENU."_Level='Public' OR ".TABLE_MENU."_Level='Staff' OR ".TABLE_MENU."_Level='Admin') ";
} else if($SystemSession_Staff_ID>0 && $SystemSession_Staff_Level=="Staff") {
    $sqlSettingMenu.=" AND (".TABLE_MENU."_Level='Public' OR ".TABLE_MENU."_Level='Staff') ";
} else {
    $sqlSettingMenu.=" AND ".TABLE_MENU."_Level='Public' ";
}
$sqlSettingMenu.=" ORDER BY ".TABLE_MENU."_Ordering ASC ";
#############################################################################################################################################
$QuerySettingMenu=MYSQL_QUERY(" SELECT COUNT(*) ".$sqlSettingMenu,$System_Connection1) OR DIE("Error: ".$sqlSettingMenu."<br>\n");
$RowSettingMenu=mysql_fetch_array($QuerySettingMenu);
$SettingMenuHeight=($RowSettingMenu[0]*28)+32;
#############################################################################################################################################
?>
<ul class="drop-right Object_NavBarRightDropDown" id="idObject_NavBarRightDrop1Sub" style=" width:220px; height:<?=$SettingMenuHeight?>px; margin-top: 3px; padding: 6px; ">
<div class="padding-3 text-right" style=" font-size: 10px; font-weight: bold; ">Main Menu&nbsp;</div>
<div class="list-group text-left" style="box-shadow : none; margin-bottom: 5px;">
<?php
#############################################################################################################################################
$QuerySettingMenu=MYSQL_QUERY(" SELECT * ".$sqlSettingMenu,$System_Connection1) OR DIE("Error: ".$sqlSettingMenu."<br>\n");
while($RowSettingMenu=mysql_fetch_array($QuerySettingMenu)) {
    ?>
    <a href="<?php echo SYSTEM_WEBPATH_ROOT.$RowSettingMenu[TABLE_MENU."_Link"]; ?>" class="list-group-item text-left padding-5 Object_NavBarSubMenuLink">
    <span style=" padding-left: 10px; padding-right: 5px; " class="<?php echo $RowSettingMenu[TABLE_MENU."_Icon"]; ?>"></span> <?php echo $RowSettingMenu[TABLE_MENU."_Name"]; ?></a>
    <?php
}
#############################################################################################################################################
?>
</div>
</ul>
