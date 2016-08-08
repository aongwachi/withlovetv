<?php // Use For Web Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } ?>
<?php
##########################################################################################
$Config_BoxKey="Top"; $index=0; $Config_TabBoxCount=0;
$sql=" SELECT * FROM ".TABLE_CATEGORY." WHERE ".TABLE_CATEGORY."_Name<>'' AND ".TABLE_CATEGORY."_Folder<>'' AND ".TABLE_CATEGORY."_isHotBox='1' ";
$sql.=" ORDER BY ".TABLE_CATEGORY."_Hotnews ASC ";
$query=$dbh->prepare($sql);
if($query->execute()) {
while($Row=$query->fetch()) {
    $arTabNewCatID[$index]=$Row[TABLE_CATEGORY."_ID"];
    $arTabNewCatName[$index]=$Row[TABLE_CATEGORY."_Name"];
    $index++; $Config_TabBoxCount++;
}} else { print_r($query->errorInfo()); }
##########################################################################################
?>
<div class="fb-border row" style="margin:0;">
<div class="width-100 itemspanel-hotnews">
    <?php for($x=0;$x<sizeof($arTabNewCatID);$x++) { ?>
    <div id="idTabNewsBox<?php echo $Config_BoxKey.$x; ?>" class="webfont cursor <?php
    if($x==0) { echo "tabhotnews-active"; } else { echo "tabhotnews"; }
    ?>" onClick=" doSwitchBox<?php echo $Config_BoxKey; ?>(<?php echo $x; ?>);"><?php echo $arTabNewCatName[$x]; ?></div>
    <?php } ?>
</div>
<?php for($x=0;$x<sizeof($arTabNewCatID);$x++) { ?>
<div class="width-100 itemspanel-hotnewsx" id="idTabNewsContent<?php echo $Config_BoxKey.$x; ?>" style="<?php if($x==0) { echo ""; } else { echo " display:none; "; } ?>">
<?php
 $catid=$arTabNewCatID[$x];
##########################################################################################
$itemsloop=1; $index=0;
$Config_FolderKey1="thumb";
$Config_FolderKey2="thumb2";
$Config_FolderKey3="thumb3";
$sql="SELECT * FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_Category LIKE '%,".$catid.",%' AND ".TABLE_CONTENT."_Thumb<>'' AND ".TABLE_CONTENT."_Subject<>'' AND ".TABLE_CONTENT."_Text<>''  AND ".TABLE_CONTENT."_Status='Publish' ORDER BY ".TABLE_CONTENT."_OnlineDate DESC LIMIT 0,".$Config_PageSize." ";
$query=$dbh->prepare($sql);
if($query->execute()) {
while($Row=$query->fetch()) {
    $myID=$Row[TABLE_CONTENT."_ID"];
    $myThumb=$Row[TABLE_CONTENT."_Thumb"];
    $myThumb2=$Row[TABLE_CONTENT."_Thumb2"];
    $myThumb3=$Row[TABLE_CONTENT."_Thumb3"];
    $mySubject=$Row[TABLE_CONTENT."_Subject"];
    $isVideo=$Row[TABLE_CONTENT."_isVideo"];
    //--------------------------------------------
    $myCategory=$Row[TABLE_CONTENT."_Category"];
    $myCategoryID=0;
    if($myCategory<>"" && $myCategory<>",") {
        $arCat=explode(",",$myCategory);
        for($i=0;$i<sizeof($arCat);$i++) {
            if($myCategoryID==0 && $arCat[$i]>0 && $arTopMenuCatNameByID[$arCat[$i]]<>"") { $myCategoryID=$arCat[$i]; break; }
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
        <div class="width-100 padding-0">
            <a href="/<?php echo $myID; ?>/"><img src="<?php echo $PictureThumb2; ?>" title="<?php echo $itemID.$itemsloop; ?>" class="img-light" style="width:100%;"></a>
              <span class="text-center itemspanel-hotnews-text">
                <div class="bt-playarea-hotnews text-center">
                    <?php if($isVideo) { ?>
                    <a href="/<?php echo $myID; ?>/" class="bt-play-hotnews cursor"></a>
                    <?php } else { ?>
                    <a href="/<?php echo $myID; ?>/"><img src="img/blank.png" style=" width:100%; height: 100%; " border="0" /></a>
                    <?php } ?>
                </div>
                <div class="hotnews-textarea">
                <div class="pull-left categoryTags-hotnewsa"><?php echo isset($arTopMenuCatNameByID[$myCategoryID])?$arTopMenuCatNameByID[$myCategoryID]:null; ?></div>
                <a href="/<?php echo $myID; ?>/" class="FeaturedLink"><?php echo $mySubject; ?></a>
                </div>
              </span>
        </div>
        <div class="boxindent-hotnewsa"></div>
        <?php
    //--------------------------------------------
    } else {
        ?>
        <div id="<?php echo $itemID.$itemsloop; ?>">
            <div class="itemspanel-hotnewsall">
                <a href="/<?php echo $myID; ?>/"><img src="<?php echo $PictureThumb2; ?>" title="<?php echo $itemID.$itemsloop; ?>" style="width:100%;"></a>
                <div>
                    <div class="text-center linkbox-hotnews1">
                        <?php if($isVideo) { ?>
                        <a href="/<?php echo $myID; ?>/" class="bt-play-hotnews cursor hotnews-play1"></a>
                        <a href="/<?php echo $myID; ?>/" class="bt-play-hotnews1 cursor hotnews-play2"></a>
                        <?php } else { ?>
                        <a href="/<?php echo $myID; ?>/"><img src="img/blank.png" style=" width:100%; height: 100%; " border="0" /></a>
                        <?php } ?>
                    </div>
                    <div class="tagbox-hotnews">
                        <div class="categoryTags-hotnewsb pull-left"><?php echo isset($arTopMenuCatNameByID[$myCategoryID])?$arTopMenuCatNameByID[$myCategoryID]:null; ?></div>
                        <div class="fb-share pull-right cursor" onclick=" doFBShare(<?php echo $myID; ?>); "></div>
                    </div>
                    <div class="text-left linkbox-hotnews">
                        <a href="/<?php echo $myID; ?>/" class="picturelink"><?php echo $mySubject; ?></a>
                    </div>
                    <div class="text-left endarea-hotnews"></div>
                </div>
            </div>
        </div>
        <?php
    }
    $itemsloop++; $index++;
    //--------------------------------------------
}} else { print_r($query->errorInfo()); }
?>
</div>
<?php } ?>
</div>
<!--################################-->
<script>
function doSwitchBox<?php echo $Config_BoxKey; ?>(myi) {
    for (i=0;i< <?php echo sizeof($arTabNewCatID); ?>;i++) {
        if (myi==i) {
            $("#idTabNewsBox<?php echo $Config_BoxKey; ?>"+i).removeClass('tabhotnews');
            $("#idTabNewsBox<?php echo $Config_BoxKey; ?>"+i).addClass('tabhotnews-active');
            $("#idTabNewsContent<?php echo $Config_BoxKey; ?>"+i).fadeIn('fast');
        } else {
            $("#idTabNewsBox<?php echo $Config_BoxKey; ?>"+i).removeClass('tabhotnews-active');
            $("#idTabNewsBox<?php echo $Config_BoxKey; ?>"+i).addClass('tabhotnews');
            $("#idTabNewsContent<?php echo $Config_BoxKey; ?>"+i).hide();
        }
    }
}
</script>
<!--################################-->