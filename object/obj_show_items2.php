<?php // Use For Web Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } ?>
<?php
##########################################################################################
$Config_BoxKey="Top"; $index=0; $Config_TabBoxCount=0;
$sql=" SELECT * FROM ".TABLE_CATEGORY." WHERE ".TABLE_CATEGORY."_Name<>'' AND ".TABLE_CATEGORY."_Folder<>'' AND ".TABLE_CATEGORY."_isHotBox='1' ";
$sql.=" ORDER BY ".TABLE_CATEGORY."_Ordering ASC ";
$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
while($Row=mysql_fetch_array($Query)) {
    $arTabNewCatID[$index]=$Row[TABLE_CATEGORY."_ID"];
    $arTabNewCatName[$index]=$Row[TABLE_CATEGORY."_Name"];
    $index++; $Config_TabBoxCount++;
}
##########################################################################################
?>
<div class="makeBlock width-100">
    <?php for($x=0;$x<sizeof($arTabNewCatID);$x++) { ?>
    <div id="idTabNewsBox<?php echo $Config_BoxKey.$x; ?>" class="webfont cursor <?php
    if($x==0) { echo "tabnews-active"; } else { echo "tabnews"; }
    ?>" onClick=" doSwitchBox<?php echo $Config_BoxKey; ?>(<?php echo $x; ?>);"><?php echo $arTabNewCatName[$x]; ?></div>
    <?php } ?>
</div>
<?php for($x=0;$x<sizeof($arTabNewCatID);$x++) { ?>
<div class="makeBlock width-100" id="idTabNewsContent<?php echo $Config_BoxKey.$x; ?>" style="<?php if($x==0) { echo ""; } else { echo " display:none; "; } ?>">
<?php
 $catid=$arTabNewCatID[$x];
##########################################################################################
$itemsloop=1; $index=0;
$Config_FolderKey1="thumb";
$Config_FolderKey2="thumb2";
$Config_FolderKey3="thumb3";
$sql="SELECT * FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_Category LIKE '%,".$catid.",%' AND ".TABLE_CONTENT."_Featured='1' AND ".TABLE_CONTENT."_Thumb<>'' AND ".TABLE_CONTENT."_Subject<>'' AND ".TABLE_CONTENT."_Text<>''  AND ".TABLE_CONTENT."_Status='Publish' ORDER BY ".TABLE_CONTENT."_OnlineDate DESC LIMIT 0,".$Config_PageSize." ";
$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
while($Row=mysql_fetch_array($Query)) {
    $myID=$Row[TABLE_CONTENT."_ID"];
    $myThumb=$Row[TABLE_CONTENT."_Thumb"];
    $myThumb2=$Row[TABLE_CONTENT."_Thumb2"];
    $myThumb3=$Row[TABLE_CONTENT."_Thumb3"];
    $mySubject=$Row[TABLE_CONTENT."_Subject"];
    //--------------------------------------------
    $myCategory=$Row[TABLE_CONTENT."_Category"];
    $myCategoryID=0;
    if($myCategory<>"" && $myCategory<>",") {
        $arCat=explode(",",$myCategory);
        for($i=0;$i<sizeof($arCat);$i++) {
            if($myCategoryID==0 && $arCat[$i]>0) { $myCategoryID=$arCat[$i]; break; }
        }
    }
    if($myCategoryID==0) { $myCategoryID=7; }
    //--------------------------------------------
    $myIDs=sprintf('%04d',$myID);
    $myFolder1=substr($myIDs,strlen($myIDs)-4,2);
    $myFolder2=substr($myIDs,strlen($myIDs)-2,2);
    $Config_Path1="upload/".$Config_FolderKey1."/".$myFolder1."/".$myFolder2."/";
    $Config_Path2="upload/".$Config_FolderKey2."/".$myFolder1."/".$myFolder2."/";
    $Config_Path3="upload/".$Config_FolderKey3."/".$myFolder1."/".$myFolder2."/";
    $PictureThumb1=$Config_Path1.$myThumb;
    $PictureThumb2=$Config_Path2.$myThumb2;
    $PictureThumb3=$Config_Path3.$myThumb3;
    //--------------------------------------------
    if($index==0) {
        $itemsloop=0;
        ?>
        <div class="makeBlock width-100 padding-0">
            <a href="view.php?p=<?php echo $myID; ?>"><img src="<?php echo $PictureThumb2; ?>" class="img-light" style="width:100%;"></a>
              <span class="photoframe2-text">
                <div class="categoryTags2"><?php echo $arTopMenuCatNameByID[$myCategoryID]; ?></div>
                <?php echo $mySubject; ?>
              </span>
        </div>
        <div class="boxindent22"></div>
        <div class="boxindent22"></div>
        <?php
    //--------------------------------------------
    } else {
        ?>
        <div id="<?php echo $itemID.$itemsloop; ?>">
        <a href="view.php?p=<?php echo $myID; ?>"><img src="<?php echo $PictureThumb2; ?>" style="width:100%;"></a>
        <div class="text-left linkbox2">
            <div class="makeBlock tagbox2"><div class="categoryTags1 pull-left"><?php echo $arTopMenuCatNameByID[$myCategoryID]; ?></div></div>
            <a href="view.php?p=<?php echo $myID; ?>" class="picturelink"><?php echo $mySubject; ?></a>
        </div>
        <div class="boxindent21"></div>
        <div class="boxindent22"></div>
        </div>
        <?php
    }
    $itemsloop++; $index++;
    //--------------------------------------------
}
?>
</div>
<?php } ?>
<!--################################-->
<script>
function doSwitchBox<?php echo $Config_BoxKey; ?>(myi) {
    for (i=0;i< <?php echo sizeof($arTabNewCatID); ?>;i++) {
        if (myi==i) {
            $("#idTabNewsBox<?php echo $Config_BoxKey; ?>"+i).removeClass('tabnews');
            $("#idTabNewsBox<?php echo $Config_BoxKey; ?>"+i).addClass('tabnews-active');
            $("#idTabNewsContent<?php echo $Config_BoxKey; ?>"+i).fadeIn('fast');
        } else {
            $("#idTabNewsBox<?php echo $Config_BoxKey; ?>"+i).removeClass('tabnews-active');
            $("#idTabNewsBox<?php echo $Config_BoxKey; ?>"+i).addClass('tabnews');
            $("#idTabNewsContent<?php echo $Config_BoxKey; ?>"+i).hide();
        }
    }
}
</script>
<!--################################-->