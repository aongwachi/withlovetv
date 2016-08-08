<?php  if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } 
$System_LayoutUse="layout_manage.html";
$System_AjaxFileAction="ajax-htmleditor-loaddata.php";
$System_ShowAjaxIFrame=0;
$page=trim($_REQUEST['page']);
include_once("../_config/config_system.php");
include_once(SYSTEM_DOC_ROOT."system/core-start.php");
include_once(SYSTEM_DOC_ROOT."system/core-body.php");
if($SystemSession_Staff_ID>0) {

	//-----------------------------------------------------------------------------------
	$sql=" SELECT * FROM ".TABLE_HTML." WHERE ".TABLE_HTML."_Page='".$page."' LIMIT 0,1 ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$Row=mysql_fetch_array($Query);
	if($Row[TABLE_HTML."_ID"]>0) { } else {
		$sql =" INSERT INTO ".TABLE_HTML."(".TABLE_HTML."_Page,".TABLE_HTML."_Text) VALUES('".$page."','') ";
		$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	}
	//-----------------------------------------------------------------------------------
	$sql=" SELECT * FROM ".TABLE_HTML." WHERE ".TABLE_HTML."_Page='".$page."' LIMIT 0,1 ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$Row=mysql_fetch_array($Query);
	//---------------------------------
	$myID=$Row[TABLE_HTML."_ID"];
	$myText=$Row[TABLE_HTML."_Text"];
	$myTable=TABLE_HTML;
	$myKeyField=TABLE_HTML."_ID";
	//---------------------------------
	?>
	<!---###############################################################################--->
	<link rel="stylesheet" href="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/summernote/summernote.css">
	<script type="text/javascript" src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/summernote/summernote.js"></script>
	<!---###############################################################################--->
	<div class="pull-center padding-0 text-left" style=" max-width:1080px; ">
		<!-------------------------------------------------------->
		<div class="form-group width-100" style=" padding-left:0px; ">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left" style=" padding-left:0px; ">
				<b>รายละเอียด : </b>
			</div>
		</div>
		<!-------------------------------------------------------->
		<?php
		$myField=$i;
		$Config_UniqueID=$myField.'of'.$myID;
		?>
		<div class="form-group width-100 padding-0">
		<!-------------------------------------------------------->
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left" style=" padding-left:0px; ">
				<div class="htmleditor padding-0" style=" min-height:400px; ">
					<div class="summernote" id="idhtml<?php echo $Config_UniqueID; ?>"><?php echo $myText; ?></div>
					<div class="txtAutoTextResult"><span id="idAutoSave<?php echo $Config_UniqueID; ?>">&nbsp;</span></div>
				</div>
				<script>
				//----------------------------------------
				$(document).ready(function() {
				//----------------------------------------
					$('#idhtml<?php echo $Config_UniqueID; ?>').summernote({
						height: 500,
						toolbar: [
							['style', ['bold', 'italic', 'underline', 'clear']],
							['color', ['color']],
							['para', ['paragraph', 'table']],
							['insert', ['link', 'picture']],
							['view', ['fullscreen', 'codeview']]
						]
					}).on('summernote.blur', function() {
						doSaveHTML('<?php echo $i; ?>', '<?php echo $Config_UniqueID; ?>', '<?php echo $myID; ?>');
					});
				});
				//----------------------------------------
				</script>
			</div>
		</div>
		<!-------------------------------------------------------->
	</div>
	<!---###############################################################################--->
	<style>
	.htmleditor div { padding: 2px; }
	</style>
	<script>
	//----------------------------------------
	function doSaveHTML(myi, myuniqueid, theID) {
	//----------------------------------------
		var markup = $('#idhtml' + myuniqueid).summernote('code');
		$.ajax({
			type: "POST",
			url: "<?php echo $System_AjaxFileAction; ?>",
			data: {
				myAjaxAction: 'save-text',
				myAjaxKey: myi,
				myAjaxID: '<?php echo $myID; ?>',
				myAjaxValue: markup
			},
			success: function(result) {
				if (result == '') {
					System_Notice('Error : ไม่สามารถบันทึกข้อมูลได้', 'danger');
				} else {
					$('#idAutoSave' + myuniqueid).html('<font color="#00AA00">' + result + '</font>');
				}
			}
		});
	}
	//----------------------------------
	</script>
	<!---###############################################################################--->
	<br><br><br><br>
	<?php
    include_once(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_loader.php");
    include_once(SYSTEM_DOC_ROOT."system/core-end.php");
} else {
    $myObjectRedirectFormLink=SYSTEM_WEBPATH_ROOT."/manage/index.php";
    include_once(SYSTEM_DOC_ROOT."object/obj_redirect.php");
}
?>