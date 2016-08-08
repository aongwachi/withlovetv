<?php // Use For Web Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } ?>
<?php
// script will upload file to ------> /upload/cache/
// and move to sub folder     ------> /upload/yourkey/00/00/id-randomnumber.jpg
//--------------------------------------------
// Config Example
//--------------------------------------------
/*
$myField=TABLE_CONTENT."_Thumb";
$myIDs=sprintf('%04d',$myID);
//--------------------------------------------
$myFolder1=substr($myIDs,strlen($myIDs)-4,2);
$myFolder2=substr($myIDs,strlen($myIDs)-2,2);
//--------------------------------------------
$Config_FolderKey='content';
$Config_UniqueID=$myField.$myID;
$Config_DefaultValue=$Row[$myField];
$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
$Config_Path="../upload/".$Config_FolderKey."/";
if(!file_exists($Config_Path)){ mkdir($Config_Path); chmod($Config_Path,0777); }
$Config_Path="../upload/".$Config_FolderKey."/".$myFolder1."/";
if(!file_exists($Config_Path)){ mkdir($Config_Path); chmod($Config_Path,0777); }
$Config_Path="../upload/".$Config_FolderKey."/".$myFolder1."/".$myFolder2."/";
if(!file_exists($Config_Path)){ mkdir($Config_Path); chmod($Config_Path,0777); }
$Config_MaxFileSizeKB=2*1000;
*/
//------------------------
$Config_FileTypeAllow=" 'jpg', 'png','gif' ";
$Config_DBx=System_Encode($Config_DB);
if($Config_MaxFileSizeKB>0) { } else { $Config_MaxFileSizeKB=2*1000; } // 10MB
?>
<div id="id<?php echo $Config_UniqueID; ?>AreaFile" class="padding-0 pull-left width-100"></div>
<div class="padding-0 width-100" style=" margin-top: -4px;">
    <form id="myUploadForm<?php echo $Config_UniqueID; ?>" enctype="multipart/form-data" target="frameInvisibleSubmit" method="POST"
    action="<?php echo SYSTEM_WEBPATH_ROOT; ?>/object/oneinput/obj_oneinput-ajax.php">
    <input id="input<?php echo $Config_UniqueID; ?>OneFileUpload" name="inputFile[]" multiple type="file">
    <input type="hidden" name="myAjaxAction" value="multiple-photo-upload-big">
    <input type="hidden" name="myAjaxID" id="myAjaxID" value="<?php echo $Config_UniqueID; ?>">
    <input type="hidden" name="myAjaxKey" id="myAjaxKey" value="<?php echo $Config_DBx; ?>">
    <input type="hidden" name="myAjaxValue" id="myAjaxValue" value="<?php echo $Config_FolderKey; ?>">
    </form>
</div>
<script>
$("#input<?php echo $Config_UniqueID; ?>OneFileUpload").fileinput({
    overwriteInitial: false,
    maxFileCount: 0,
    showPreview: false,
    showUpload: false,
    showRemove: false,
    showCaption: false,
    maxFileSize: <?php echo $Config_MaxFileSizeKB; ?>,
    <?php if($Config_FileTypeAllow=="") { } else { ' allowedFileExtensions: ['.$Config_FileTypeAllow.'], '; } ?>
    browseClass: "btn btn-primary btn-block btn-flat width-100 padding-10 h30"
});
$('#input<?php echo $Config_UniqueID; ?>OneFileUpload').on('change', function() {
    $('#id<?php echo $Config_UniqueID; ?>AreaFile').html('<img src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/img/loading.gif" >');
    $('#myUploadForm<?php echo $Config_UniqueID; ?>').submit();
});
</script>
<style>
.h30 { height:30px; }
</style>