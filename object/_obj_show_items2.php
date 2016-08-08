<?php // Use For Web Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } ?>
<?php
$Config_FolderKey="thumb";
$sql="SELECT * FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_Category LIKE '%,".$catid.",%' AND ".TABLE_CONTENT."_Thumb<>'' AND ".TABLE_CONTENT."_Subject<>'' AND ".TABLE_CONTENT."_Text<>''  AND ".TABLE_CONTENT."_Status='Publish' ORDER BY ".TABLE_CONTENT."_OnlineDate DESC LIMIT 0,".$Config_PageSize." ";
$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
while($Row=mysql_fetch_array($Query)) {
    $myID=$Row[TABLE_CONTENT."_ID"];
    $myThumb=$Row[TABLE_CONTENT."_Thumb"];
    $mySubject=$Row[TABLE_CONTENT."_Subject"];
    //--------------------------------------------
    $myIDs=sprintf('%04d',$myID);
    $myFolder1=substr($myIDs,strlen($myIDs)-4,2);
    $myFolder2=substr($myIDs,strlen($myIDs)-2,2);
    $Config_Path="upload/".$Config_FolderKey."/".$myFolder1."/".$myFolder2."/";
    $PictureThumb=$Config_Path.$myThumb;
    //--------------------------------------------
    ?>
        <div class="photoframe2"><a href="view.php?p=<?php echo $myID; ?>"><img src="<?php echo $PictureThumb; ?>" style=" width:100%; "></a></div>
        <div class="text-left linkbox"><a href="view.php?p=<?php echo $myID; ?>" class="picturelink"><?php echo $mySubject; ?></a></div>
        <div class="boxindent1"></div>
        <div class="boxindent2"></div>
    <?php
}
?>