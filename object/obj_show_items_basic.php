<?php // Use For Web Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } ?>
<?php
$itemsloop=1;
$Config_FolderKey1="thumb";
$Config_FolderKey2="thumb2";
$Config_FolderKey3="thumb3";
if($catid>0) {
    $sql="SELECT * FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_Category LIKE '%,".$catid.",%' AND ".TABLE_CONTENT."_Thumb<>'' AND ".TABLE_CONTENT."_Subject<>'' AND ".TABLE_CONTENT."_Text<>''  AND ".TABLE_CONTENT."_Status='Publish' ORDER BY ".TABLE_CONTENT."_OnlineDate DESC LIMIT 0,".$Config_PageSize." ";
} else {
    $sql="SELECT * FROM ".TABLE_CONTENT." WHERE ( ".TABLE_CONTENT."_Category LIKE '%,3,%' OR ".TABLE_CONTENT."_Category LIKE '%,5,%' OR ".TABLE_CONTENT."_Category LIKE '%,4,%' ) AND ".TABLE_CONTENT."_Thumb<>'' AND ".TABLE_CONTENT."_Subject<>'' AND ".TABLE_CONTENT."_Text<>''  AND ".TABLE_CONTENT."_Status='Publish' ORDER BY ".TABLE_CONTENT."_OnlineDate DESC LIMIT 0,".$Config_PageSize." ";
}
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
            $myCat=isset($arCat[$i])?$arCat[$i]:null;
            $myCatCatName=isset($arTopMenuCatNameByID[$myCategoryID])?$arTopMenuCatNameByID[$myCategoryID]:"";
            if($myCategoryID==0 && $myCat>0 && $myCatCatName<>"") { $myCategoryID=$myCat; break; }
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
    if($itemsloop==1) {
        ?>
        <div class="fb-border" id="<?php echo $itemID.$itemsloop; ?>">
            <div class="width-100 makeBlock itemspanel-basica">
                <div class="photoframe-basica"><a href="/<?php echo $myID; ?>/"><img src="<?php echo $PictureThumb2; ?>" title="<?php echo $itemID.$itemsloop; ?>" style="width:100%;"></a></div>
            </div> 
            <div class="text-left linkbox-basica">
                <div class="bt-playarea-basica text-center" onclick=" location.href='/<?php echo $myID; ?>/'; ">
                    <?php if($isVideo) { ?>
                    <a href="/<?php echo $myID; ?>/" class="bt-play-basica cursor"></a>
                    <?php } else { ?>
                    <a href="/<?php echo $myID; ?>/"><img src="img/blank.png" style=" width:100%; height: 100%; " border="0" /></a>
                    <?php } ?>
                </div>
                <div class="fb-share pull-right cursor" style=" margin-top:-20px; " onclick=" doFBShare(<?php echo $myID; ?>); "></div>
                <div class="pull-left categoryTags-basica tag-basica"><?php echo $arTopMenuCatNameByID[$myCategoryID]; ?></div>
                <a href="/<?php echo $myID; ?>/" class="picturelink"><?php echo $mySubject; ?></a>
            </div>
            <div class="spacearea-<?php echo $itemID; ?>"></div>
        </div>
        <div class="boxindent-basica" id="<?php echo $itemID.$itemsloop; ?>i"></div>
        <?php
    } else {
        ?>
        <div class="fb-border" id="<?php echo $itemID.$itemsloop; ?>">
            <div class="spacearea-<?php echo $itemID; ?>"></div>
            <div class="width-100 row itemspanel-basicax">
                <div class="fb-share pull-right cursor" onclick=" doFBShare(<?php echo $myID; ?>); "></div>
                <div class="bt-playarea-basicax" onclick=" location.href='/<?php echo $myID; ?>/'; ">
                    <?php if($isVideo) { ?>
                    <a href="/<?php echo $myID; ?>/" class="bt-play-basicax cursor"></a>
                    <?php } else { ?>
                    <a href="/<?php echo $myID; ?>/"><img src="img/blank.png" style=" width:100%; height: 100%; " border="0" /></a>
                    <?php } ?>
                </div>
                <div class="photoframe-basicax"><a href="/<?php echo $myID; ?>/"><img src="<?php echo $PictureThumb1; ?>" title="<?php echo $itemID.$itemsloop; ?>" style="width:100%;"></a></div>
                <div class="text-left linkbox-basicax">
                    <div class="makeBlock tagbox-basicax"><div class="categoryTags-basica pull-left"><?php echo $arTopMenuCatNameByID[$myCategoryID]; ?></div></div>
                    <a href="/<?php echo $myID; ?>/" class="picturelink"><?php echo $mySubject; ?></a>
                </div>
            </div> 
            <div class="spacearea-<?php echo $itemID; ?>"></div>
        </div> 
        <div class="boxindent-basicax" id="<?php echo $itemID.$itemsloop; ?>i"></div>
        <?php
    }
    ?>
    <?php
    $itemsloop++;
}} else { print_r($query->errorInfo()); }
?>