<?php // Use For Web Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } ?>
<?php
// script will upload file to ------> /upload/cache/
// and move to sub folder     ------> /upload/table-field/xxxxxx
//--------------------------------------------
// Config Example
//--------------------------------------------
/*
$Config_Input_DefaultValue=$Row[$myField];
//--------------------------------------------
$Config_Input_Table=$table; // Update Table
$Config_Input_Field=$myField;  // SET myFiled=Current Value
$Config_Input_FieldUpdateKey=$myFirstField; // WHERE UpdateKey=
$Config_Input_ID=$myID;  // WHERE UpdateKey=ID
//--------------------------------------------
$Config_Input_Key=$myField;
*/
//--------------------------------------------
$Config_Input_Zero = sprintf("%02d", $Config_Input_ID);
$Config_Input_Folder0 = strtolower($Config_Input_Table)."-".strtolower($Config_Input_Field);
$Config_Input_Folder1 = substr($Config_Input_Zero,0,2);
$Config_Input_Folder = SYSTEM_DOC_ROOT."upload/".$Config_Input_Folder0."/".$Config_Input_Folder1."/";
//--------------------------------------------
?>
<div id="id<?php echo $Config_Input_Key; ?>PhotoArea">
<?php DMS_ShowFilePreviewLoad($Config_Input_ID,$Config_Input_Field,$Config_Input_Table,$Config_Input_FieldUpdateKey,$Config_Input_Folder,$Config_Input_DefaultValue); ?>
</div>
<div class="padding-2">
<form id="myUploadForm<?php echo $Config_Input_Key ?>" enctype="multipart/form-data" target="frameInvisibleSubmit" method="POST" action="<?php echo $System_AjaxFileAction; ?>">
<input id="input<?php echo $Config_Input_Key ?>" name="inputFile" type="file">
<input type="hidden" name="myAjaxAction" value="one-photo-upload">
<input type="hidden" name="myAjaxID" value="<?php echo $Config_Input_ID; ?>"><!-- Data ID -->
<input type="hidden" name="myAjaxValue" id="myAjaxValue<?php echo $Config_Input_Key ?>" value="<?php echo $Config_Input_DefaultValue; ?>"><!-- Old FileName -->
<input type="hidden" name="myAjaxKey" id="myAjaxKey<?php echo $Config_Input_Key ?>" value="<?php echo $Config_Input_ID."#".$Config_Input_Table."#".$Config_Input_Field."#".$Config_Input_FieldUpdateKey."#".$Config_Input_Folder; ?>"><!-- All Use Data -->
</form>
</div>
<div class="txtAutoTextResult"><span id="input<?php echo $Config_Input_Key ?>Validate">&nbsp;</span></div>
<div class="txtAutoTextResult"><span id="idAutoSave<?php echo $Config_Input_Key ?>">&nbsp;</span></div>
<script>
$("#input<?php echo $Config_Input_Key ?>").fileinput({
    overwriteInitial: false,
    maxFileSize: <?php echo DMS_CONFIG_MAXFILESIZE; ?>,
    maxFileCount: 1,
    showPreview:false,
    showUpload: false,
    showRemove: false,
    showCaption: false,
    browseClass: "btn btn-primary btn-flat padding-5",
    allowedFileExtensions: [<?php echo DMS_CONFIG_PHOTO_UPLOAD_ALLOW; ?>]
});
$('#input<?php echo $Config_Input_Key ?>').on('change', function() {
    CurrentUsePhoto=$('#id<?php echo $Config_Input_Key; ?>Thumb').attr("src");
    CurrentUseFile='-1';
    $('#id<?php echo $Config_Input_Key; ?>Thumb').attr("src","<?php echo SYSTEM_WEBPATH_ROOT; ?>/img/loading.gif");
    $('#myUploadForm<?php echo $Config_Input_Key ?>').submit();
    showValidPhoto('<?php echo $Config_Input_Key; ?>');
});
</script>