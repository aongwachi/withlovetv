<?php // Use For Web Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } ?>
<?php
$Config_DBx=System_Encode($Config_DB);
if($Config_MaxFileSizeKB>0) { } else { $Config_MaxFileSizeKB=10*1000; } // 10MB
?>
<div class="padding-0" style=" padding-bottom: 10px;">
    <div id="id<?php echo $Config_UniqueID; ?>AreaFile" class="padding-0 pull-left">
        <div style=" width:450px; height:800px; padding: 0px; ">
            <div id="cropContainerPreload<?php echo $Config_UniqueID; ?>"  style=" width:450px; height:800px; "></div>
        </div>
        <script>
        var croppicContainerPreloadOptions = {
            uploadUrl:'img_save_to_file.php',
            cropData:{
                "myID":"<?=$myID?>",
                "myTable":"<?=$myTable?>",
                "myKeyField":"<?=$myKeyField?>",
                "myPic":"<?=$Config_Pic?>",
                "myField":"<?=$myField?>"
            },        
            cropUrl:'img_crop_to_file.php',
            loadPicture:'<?="../".$Config_Path.$Config_DefaultValue?>',
            enableMousescroll:true,
            loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> '
        }
        var cropContainerPreload<?php echo $Config_UniqueID; ?> = new Croppic('cropContainerPreload<?php echo $Config_UniqueID; ?>', croppicContainerPreloadOptions);
        </script>
    </div>
    
</div>