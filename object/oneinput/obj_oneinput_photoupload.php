<?php // Use For Web Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } ?>
<?php
// script will upload file to ------> /upload/cache/
// and move to sub folder     ------> /upload/table-field/xxx-filename
//--------------------------------------------
// Config Example
//--------------------------------------------
// $Config_UniqueID=$myField.$myID;
// $Config_DefaultValue=$Row[$myField];
// $Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
// $Config_Path = "upload/".strtolower($myTable)."/";
// $Config_FileTypeAllow=" 'jpg', 'png','gif' "; // use blank to allow all
// $Config_MaxFileSizeKB=10*1000; // 10MB
//------------------------
$Config_DBx=System_Encode($Config_DB);
############################################################################
if(!isset($Config_MaxFileSizeKB)) { $Config_MaxFileSizeKB=10*1000; } // 10MB 
if(!isset($Config_FileTypeAllow)) { $Config_FileTypeAllow=" 'jpg' "; }
############################################################################
?>
<div class="padding-0" style=" padding-bottom: 10px;">

    <div id="id<?php echo $Config_UniqueID; ?>AreaFile" class="padding-0 pull-left">
    <?php if($Config_DefaultValue<>"" && file_exists(SYSTEM_DOC_ROOT.$Config_Path.$Config_DefaultValue)) { ?>
    <div style=" width:250px; height:180px; padding: 0px; ">
        <div id="cropContainerPreload<?php echo $Config_UniqueID; ?>"  style=" width:250px; height:180px; "></div>
    </div>
    <script>
    var croppicContainerPreloadOptions = {
        uploadUrl:'img_save_to_file.php',
        cropData:{
            "myID":"<?=$myID?>",
            "myTable":"<?=$myTable?>",
            "myKeyField":"<?=$myKeyField?>",            
            "myField":"<?=$myField?>"
        },        
        cropUrl:'img_crop_to_file.php',
        loadPicture:'<?="../".$Config_Path.$Config_DefaultValue?>',
        enableMousescroll:true,
        loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> '
    }
    var cropContainerPreload<?php echo $Config_UniqueID; ?> = new Croppic('cropContainerPreload<?php echo $Config_UniqueID; ?>', croppicContainerPreloadOptions);
    </script>
    <?php } ?>
    </div>

    <div class="padding-0 pull-right" style=" margin-top: -4px;">
    <form id="myUploadForm<?php echo $Config_UniqueID; ?>" enctype="multipart/form-data" target="frameInvisibleSubmit" method="POST"
    action="<?php echo SYSTEM_WEBPATH_ROOT; ?>/object/oneinput/obj_oneinput-ajax.php">
    <input id="input<?php echo $Config_UniqueID; ?>OneFileUpload" name="inputFile" type="file">
    <input type="hidden" name="myAjaxAction" value="one-file-upload">
    <input type="hidden" name="myAjaxID" id="myAjaxID" value="<?php echo $Config_UniqueID; ?>">
    <input type="hidden" name="myAjaxKey" id="myAjaxKey" value="<?php echo $Config_DBx; ?>">
    </form>
    </div>

    <script>
    $("#input<?php echo $Config_UniqueID; ?>OneFileUpload").fileinput({
        overwriteInitial: false,
        maxFileCount: 1,
        showPreview:false,
        showUpload: false,
        showRemove: false,
        showCaption: false,
        maxFileSize: <?php echo $Config_MaxFileSizeKB; ?>,
        <?php if($Config_FileTypeAllow=="") { } else { ' allowedFileExtensions: ['.$Config_FileTypeAllow.'], '; } ?>
        browseClass: "btn btn-primary btn-flat padding-5"
    });
    $('#input<?php echo $Config_UniqueID; ?>OneFileUpload').on('change', function() {
        $('#id<?php echo $Config_UniqueID; ?>AreaFile').html('<img src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/img/loading.gif" >');
        $('#myUploadForm<?php echo $Config_UniqueID; ?>').submit();
    });
    function showSaveFile<?php echo $Config_UniqueID; ?>(myTxt) {
        $('#id<?php echo $Config_UniqueID; ?>AreaFile').html(myTxt);
    }
    </script>
    
</div>