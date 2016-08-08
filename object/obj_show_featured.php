<?php // Use For Web Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } ?>
<?php
$Config_FolderKey="thumb3"; $looper=1;
$sql="SELECT * FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_Featured='1' AND ".TABLE_CONTENT."_Thumb3<>'' AND ".TABLE_CONTENT."_Status='Publish' ORDER BY ".TABLE_CONTENT."_OnlineDate DESC LIMIT 0,".$Config_PageSize;
$query=$dbh->prepare($sql);
if($query->execute()) {
while($Row=$query->fetch()) {
    $myID=$Row[TABLE_CONTENT."_ID"];
    $myThumb=$Row[TABLE_CONTENT."_Thumb3"];
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
    $Config_Path="upload/".$Config_FolderKey."/".$myFolder1."/".$myFolder2."/";
    $PictureThumb=$Config_Path.$myThumb;
    //--------------------------------------------
    ?>
    <div class="featuredbox-frame">
        <div class="featuredbox-image" <?php if($looper==4) { ?> style=" padding-left:0px; "<?php } ?>>
            <a href="/<?php echo $myID; ?>/"><img src="<?php echo $PictureThumb; ?>" class="img-light" style=" width: 100%; height: auto; "></a>
            <span class="featuredbox-text cursor">
                <div class="bt-playarea-featured cursor">
                    <?php if($isVideo) { ?>
                    <a href="/<?php echo $myID; ?>/" class="bt-play-featured cursor"></a>
                    <?php } else { ?>
                    <a href="/<?php echo $myID; ?>/"><img src="img/blank.png" style=" width:100%; height: 100%; " border="0" /></a>
                    <?php } ?>
                </div>
                <div class="featuredbox-textarea">
                <div class="featuredbox-categoryTags"><?php echo $arTopMenuCatNameByID[$myCategoryID]; ?></div>
                <a href="/<?php echo $myID; ?>/" class="FeaturedLink"><?php echo $mySubject; ?></a>
                </div>
            </span>
        </div>
    </div>
    <?php
    $looper++;
}} else { print_r($query->errorInfo()); }
?>