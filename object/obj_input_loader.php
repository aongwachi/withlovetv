<?php // Use For Web Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } ?>
<?php
$System_AjaxInputFileAction=SYSTEM_WEBPATH_ROOT."/object/obj_input_ajax.php";
?>
<!---###############################################################################--->
<script type="text/javascript" src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/bootstrap3-dialog/bootstrap-dialog.min.js"></script>
<link rel="stylesheet" href="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/bootstrap3-dialog/bootstrap-dialog.min.css">
<!---###############################################################################--->
<style>
.bootstrap-dialog .modal-header.bootstrap-dialog-draggable { cursor: move; }
</style>
<!---###############################################################################--->
<script>
var Input_DialogPopWindow;
//----------------------------------
function showPopUpWindow(myheadtxt,mydatasourceid,myfiled) {
//----------------------------------
    Input_DialogPopWindow = BootstrapDialog.show({
        title: myheadtxt,
        draggable: true,
        message: $('<div></div>').load('ajax-dms.php?task=load-datasource&myAjaxID='+mydatasourceid+'&field='+myfiled,function(data){
            //runScript();
        }),
        onshown: function(dialogRef){ 
            //runScript(); 
        },
        onhidden: function(dialogRef){ 
            //$('#myRefreshForm').submit(); 
        }
    });
}
//----------------------------------------
function PopUpWindowLoadAjaxData(mydatalist) {
//----------------------------------------
    $.ajax({
        url : 'ajax-dms.php',
        contentType: "text/html",
        data: mydatalist,
        success : function(returndata) {
            $('#idPopUpWindow').html(returndata);
        },
        error : function(xhr, statusText, error) { 
            System_Notice("Error! Could not retrieve the data.",'danger');
        }
    });
}

var CurrentUseFile;
//-------------------------------------------
function showPreviewFile(myID,myField,myFileName,myKey) {
//-------------------------------------------
    $('#myAjaxInputValue'+myField).val(myFileName); // save for current file name
    $.ajax({
        type: "POST",
        url: "<?php echo $System_AjaxFileAction; ?>",
        data: {
            myAjaxAction: 'load-one-file-upload',
            myAjaxKey: myKey, 
            myAjaxID: myID, 
            myAjaxValue: myFileName
        },
        success: function(result) {
            $('#id'+myField+'AreaFile').html(result);
            $('#id'+myField+'AreaFile').show();
        }
    });
}
//-------------------------------------------
function showValidFile(myIDKey) {
//-------------------------------------------
    //$('#input'+myIDKey+'AreaFile').removeClass('bg-invalid');
}
//-------------------------------------------
function showInvalidFile(myIDKey,myMessage) {
//-------------------------------------------
    if(CurrentUseFile=="-1") { $('#id'+myIDKey+'AreaFile').html(''); }
    else { $('#id'+myIDKey+'AreaFile').html(CurrentUseFile); }
    $('#input'+myIDKey+'Validate').html(myMessage);
    $('#input'+myIDKey+'Validate').show("slide", { direction: 'right', easing: 'easeOutCirc' }, 500).delay(2000).fadeOut(300);
}

var CurrentUsePhoto;
//-------------------------------------------
function showPreviewPhoto(myID,myField,myFileName,myKey) {
//-------------------------------------------
    $('#myAjaxInputValue'+myField).val(myFileName); // save for current file name
    $.ajax({
        type: "POST",
        url: "<?php echo $System_AjaxFileAction; ?>",
        data: {
            myAjaxAction: 'load-one-photo-upload',
            myAjaxKey: myKey, 
            myAjaxID: myID, 
            myAjaxValue: myFileName
        },
        success: function(result) {
            $('#id'+myField+'PhotoArea').html(result);
            $('#id'+myField+'PhotoArea').show();
        }
    });
}
//-------------------------------------------
function showValidPhoto(myIDKey) {
//-------------------------------------------
    //$('#input'+myIDKey+'PhotoArea').removeClass('bg-invalid');
}
//-------------------------------------------
function showInvalidPhoto(myIDKey,myMessage) {
//-------------------------------------------
    if(CurrentUsePhoto=="-1") { $('#id'+myIDKey+'Thumb').attr("src",'<?php echo SYSTEM_WEBPATH_ROOT; ?>/img/blank.png');
    } else { $('#id'+myIDKey+'Thumb').attr("src",CurrentUsePhoto); }
    $('#input'+myIDKey+'Validate').html(myMessage);
    $('#input'+myIDKey+'Validate').show("slide", { direction: 'right', easing: 'easeOutCirc' }, 500).delay(2000).fadeOut(300);
}
//-------------------------------------------
function autoSave(myID,myKey,myValue) {
//-------------------------------------------
    $('#myAjaxInputAction').val('data-update');
    $('#myAjaxInputID').val(myID);
    $('#myAjaxInputKey').val(myKey);
    $('#myAjaxInputValue').val(myValue);
}
//-------------------------------------------
function autoSaveTime(myID,myKey,myValue) {
//-------------------------------------------
    $('#myAjaxInputAction').val('data-update-time');
    $('#myAjaxInputID').val(myID);
    $('#myAjaxInputKey').val(myKey);
    $('#myAjaxInputValue').val(myValue);
}
//-------------------------------------------
function autoSaveDate(myID,myKey,myValue) {
//-------------------------------------------
    $('#myAjaxInputAction').val('data-update-date');
    $('#myAjaxInputID').val(myID);
    $('#myAjaxInputKey').val(myKey);
    $('#myAjaxInputValue').val(myValue);
}
//-------------------------------------------
function doSave() {
//-------------------------------------------
    $('#myAjaxInputForm').submit();
}
//-------------------------------------------
function showSaveByKey(myIDKey) {
//-------------------------------------------
    $('#idAutoSave'+myIDKey).html('<font color="#00AA00">Saved!</font>');
    $('#idAutoSave'+myIDKey).show("slide", { direction: 'right', easing: 'easeOutCirc' }, 500).delay(1000).fadeOut(1000);
}
//-------------------------------------------
function showSave(myID,myKey) {
//-------------------------------------------
    $('#idAutoSave'+myID+myKey).html('<font color="#00AA00">Saved!</font>');
    $('#idAutoSave'+myID+myKey).show("slide", { direction: 'right', easing: 'easeOutCirc' }, 500).delay(1000).fadeOut(1000);
    $('#idAutoSave'+myKey).html('<font color="#00AA00">Saved!</font>');
    $('#idAutoSave'+myKey).show("slide", { direction: 'right', easing: 'easeOutCirc' }, 500).delay(1000).fadeOut(1000);
}
//-------------------------------------------
function doSaveCheckBox() {
//-------------------------------------------
    $('#myAjaxInputAction').val('data-update-checkbox');
    $('#myAjaxInputForm').submit();
}
<?php if($Config_Input_WebColorPicker==1) { ?> 
//-------------------------------------------
function autoSaveWebColor(myID,myKey,myValue) {
//-------------------------------------------
    $('#myAjaxInputAction').val('data-update-webcolor');
    $('#myAjaxInputID').val(myID);
    $('#myAjaxInputKey').val(myKey);
    $('#myAjaxInputValue').val(myValue);
}
//-------------------------------------------
function doSaveWebColor() {
//-------------------------------------------
    myAction=$('#myAjaxInputAction').val();
    if(myAction=='data-update-webcolor') {
        myID=$('#myAjaxInputID').val();
        myKey=$('#myAjaxInputValue').val();
        myValue=$('#input'+myID+myKey).val();
        if(myValue=='') {
            // skip save
        } else {
            $('#myAjaxInputValue').val(myValue);
            $('#myAjaxInputForm').submit();
        }
    }
}
$(document).on('click.bfhcolorpicker.data-api', doSaveWebColor);
<?php } ?>
</script>
<form name="myAjaxInputForm" id="myAjaxInputForm" method="post" target="frameInvisibleSubmit" action="<?php echo $System_AjaxInputFileAction; ?>">
<input type="hidden" id="myAjaxInputID" name="myAjaxID" value="" />
<input type="hidden" id="myAjaxInputKey" name="myAjaxKey" value="" />
<input type="hidden" id="myAjaxInputAction" name="myAjaxAction" value="" />
<input type="hidden" id="myAjaxInputValue" name="myAjaxValue" value="" />
<input type="hidden" id="myAjaxInputValue2" name="myAjaxValue2" value="" />
<input type="hidden" id="myAjaxInputValue3" name="myAjaxValue3" value="" />
</form>
