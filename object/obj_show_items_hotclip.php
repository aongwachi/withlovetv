<?php // Use For Web Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } ?>
<?php
$itemsloop=1;
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
    ?>
    <div class="fb-border" id="<?php echo $itemID.$itemsloop; ?>">
        <div class="width-100 makeBlock itemspanel-hotclipa">
            <div class="photoframe-hotclipa"><a href="/<?php echo $myID; ?>/"><img src="<?php echo $PictureThumb2; ?>" title="<?php echo $itemID.$itemsloop; ?>" style="width:100%;"></a></div>
            <div class="text-left linkbox-hotclipa">
                <div class="bt-playarea-hotclipa text-center">
                    <?php if($isVideo) { ?>
                    <a href="/<?php echo $myID; ?>/" class="bt-play-hotclipa cursor"></a>
                    <?php } else { ?>
                    <a href="/<?php echo $myID; ?>/"><img src="img/blank.png" style=" width:100%; height: 100%; " border="0" /></a>
                    <?php } ?>
                </div>
                <div class="width-100 padding-1 tag-hotclipa">
                    <div class="pull-left categoryTags-hotclipa"><?php echo $arTopMenuCatNameByID[$myCategoryID]; ?></div>
                    <div class="fb-share pull-right cursor" style=" margin-top:2px; " onclick=" doFBShare(<?php echo $myID; ?>); "></div>
                </div>
                <div class="width-100">
                <a href="/<?php echo $myID; ?>/" class="picturelink"><?php echo $mySubject; ?></a>
                </div>
            </div>
            <div class="boxindent-hotclipb"></div>
        </div> 
        <div class="spacearea-<?php echo $itemID; ?>"></div>
    </div>
    <div class="boxindent-hotclipa" id="<?php echo $itemID.$itemsloop; ?>i"></div>
    <?php
    $itemsloop++;
}} else { print_r($query->errorInfo()); }
?>