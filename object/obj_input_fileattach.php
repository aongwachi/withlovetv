<?php // Use For Web Editor Set Current Character Set as UTF-8 #################
if(0) { ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-------------------------------------------------------->
<script type="text/javascript" src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/js-fileinput/fileinput.js"></script>
<link rel="stylesheet" href="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/js-fileinput/fileinput.css">
<!-------------------------------------------------------->
<?php } ?>

<div class="row padding-10" style="padding-left:30px; padding-right:30px; ">
	<div class="col-xs-12 col-sm-9 col-md-10 col-lg-10 padding-5">
		<div class="row padding-5" id="id<?php echo $Config_Input_Key; ?>FileArea">..</div>
	</div>
	<div class="col-xs-12 col-sm-3 col-md-2 col-lg-2 padding-5 text-right">			
		<form id="myUploadForm<?php echo $Config_Input_Key; ?>" enctype="multipart/form-data" target="frameInvisibleSubmit" 
		 method="POST" action="<?php echo SYSTEM_WEBPATH_ROOT; ?>/object/obj_input_fileattach-ajax.php">
		<input id="input<?php echo $Config_Input_Key; ?>" name="inputFile" type="file">
		<input type="hidden" name="myAjaxAction" value="new-file-upload">
		<input type="hidden" name="myAjaxKey" value="<?php echo $Config_Input_Key.'#'.$Config_Input_ParentID; ?>">
		</form>
		<script>
		$("#input<?php echo $Config_Input_Key; ?>").fileinput({
			overwriteInitial: false,
			maxFileSize: <?php echo DMS_CONFIG_MAXFILESIZE; ?>,
			maxFileCount: 1,
			showPreview:false,
			showUpload: false,
			showRemove: false,
			showCaption: false,
			browseClass: "btn btn-primary btn-flat padding-5",
			allowedFileExtensions: [<?php echo DMS_CONFIG_FILE_UPLOAD_ALLOW; ?>]
		});
		$('#input<?php echo $Config_Input_Key; ?>').on('change', function() {
			$('#myUploadForm<?php echo $Config_Input_Key; ?>').submit();
		});
		</script>
	</div>
	<div class="row padding-5" id="id<?php echo $Config_Input_Key; ?>PhotoArea">..</div>
</div>
<script>
//------------------------------------------------------------
function doRefresh<?php echo $Config_Input_Key; ?>() {
//------------------------------------------------------------
	$('#myRefreshForm').submit();
}
//------------------------------------------------------------
function doDelete<?php echo $Config_Input_Key; ?>(myID) {
//------------------------------------------------------------
	$.ajax({
		type: "POST",
		url : '<?php echo SYSTEM_WEBPATH_ROOT; ?>/object/obj_input_fileattach-ajax.php',
		data: {
			myAjaxAction: 'delete-file',
			myAjaxKey: '<?php echo $Config_Input_Key.'#'.$Config_Input_ParentID; ?>',
			myAjaxID: myID
		}
	});
	$('#id<?php echo $Config_Input_Key; ?>'+myID).hide();
}
//------------------------------------------------------------
function doLoadFile<?php echo $Config_Input_Key; ?>() {
//------------------------------------------------------------
	$('#id<?php echo $Config_Input_Key; ?>FileArea').html('Loading..');
	$.ajax({
		type: "POST",
		url : '<?php echo SYSTEM_WEBPATH_ROOT; ?>/object/obj_input_fileattach-ajax.php',
		data: {
		    myAjaxAction: 'load-file',
		    myAjaxKey: '<?php echo $Config_Input_Key.'#'.$Config_Input_ParentID; ?>'
		},
		success: function(result) {
		    $('#id<?php echo $Config_Input_Key; ?>FileArea').html(result);
		}
	});
}
//------------------------------------------------------------
function doLoadPhoto<?php echo $Config_Input_Key; ?>() {
//------------------------------------------------------------
	$('#id<?php echo $Config_Input_Key; ?>PhotoArea').html('Loading..');
	$.ajax({
		type: "POST",
		url : '<?php echo SYSTEM_WEBPATH_ROOT; ?>/object/obj_input_fileattach-ajax.php',
		data: {
		    myAjaxAction: 'load-photo',
		    myAjaxKey: '<?php echo $Config_Input_Key.'#'.$Config_Input_ParentID; ?>'
		},
		success: function(result) {
		    $('#id<?php echo $Config_Input_Key; ?>PhotoArea').html(result);
		}
	});
}
doLoadFile<?php echo $Config_Input_Key; ?>();
doLoadPhoto<?php echo $Config_Input_Key; ?>();

</script>