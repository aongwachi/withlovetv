<?php  if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } 
$System_LayoutUse="layout_manage.html";
$System_AjaxFileAction="ajax-ads-content-loaddata.php";
$System_ShowAjaxIFrame=0;

include_once("../_config/config_system.php");
include_once(SYSTEM_DOC_ROOT."system/core-start-ajax.php");
if($SystemSession_Staff_ID>0 && $SystemSession_Staff_Level=="Admin") { 
	//----------------------------------------------------------------------------------------------------------------
	include_once(SYSTEM_DOC_ROOT."system/core-start.php");
	include_once(SYSTEM_DOC_ROOT."system/core-body.php");
	//----------------------------------------------------------------------------------------------------------------
	// Panel BG
	//----------------------------------------------------------------------------------------------------------------
	$myBGColor='#9ACD32';
	$myBGColorLighter=System_ColorLighter($myBGColor);
	$return=basename(__FILE__, '.php'); // file name for base file .php
	//----------------------------------------------------------------------------------------------------------------
	// 1/5 Setting FooTable Config
	//----------------------------------------------------------------------------------------------------------------
	$FooTableName='idTableMain'; // Key for Multitable
	$FooTableAjaxFile=$System_AjaxFileAction; 
	$FooTablePageSize=CONFIG_PAGESIZE;
	$FooTableASCDESC='ASC';
	$FooTableOrderBy=TABLE_ADS."_Name"; 
	//----------------------------------------------------------------------------------------------------------------
	?><br> 
	<!---###############################################################################--->
	<script type="text/javascript" src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/js-select2/select2.js"></script>
	<link rel="stylesheet" href="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/js-select2/select2.min.css">
	<script type="text/javascript" src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/bootstrap-switch/bootstrap-switch.js"></script>
	<link rel="stylesheet" href="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/bootstrap-switch/bootstrap-switch.min.css">
	<!---###############################################################################--->
	<?php
	$myMenuKey="AdsContent";
	include("inc_ads.php");
	?>
	<div class="row-fluid width-100 padding-5">
            
	<div class="visible-xs" style=" padding-bottom: 5px; ">
	<button type="button" name="inputCancel" class="btn btn-success btn-block btn-flat" style="height:50px;" onclick=" showPopUpWindowAdd(); " >
	<span class="glyphicon glyphicon-plus"></span> เพิ่มโฆษณาใหม่</button>
	</div>
            
	<div class="panel panel-custom" style=" border-width:0px; ">
	<div class="panel-heading panel-custom-heading font-white" style=" background-color:<?php echo $myBGColor; ?>; color:#FFFFFF; text-align:left; height:80px; position:relative; ">
		<i class="glyphicon glyphicon-tag pull-left padding-10" style="font-size:40px; padding-right:20px;"></i>
		<h2 class="font-white"><strong>Ads</strong></h2> <span> โฆษณา</span>
		<div class="pull-right" style=" color:#FFFF00; "><span class="hidden-xs">ค้นพบ</span> 
		<!--------------------------------------------------------------------------------------------->
		<!--- 2/5 Total record will display here ------------------------------------------------------>
		<!--------------------------------------------------------------------------------------------->
		<span id="idFooTableTotalRecord">0</span>
		<!---------------------------------------------------------------------------------------------->
		รายการ
		<div class="hidden-xs pull-right" style=" width:85px; "></div>
		</div>
		<button type="button" class="btn btn-success btn-flat pull-right hidden-xs" style=" position:absolute; top:0px; right:0px; height:80px; width:80px; "
		onclick=" showPopUpWindowAdd(); " >
		<span class="glyphicon glyphicon-plus"></span> เพิ่ม
		</button>
	</div>
	<div class="panel-body panel-custom-body padding-10" style="padding-top:10px; padding-bottom:10px; " id="idTableCalendar"> 
		<form action="?" method="post" id="<?php echo $FooTableName; ?>Form" onsubmit="FooTableLoadAjaxReloadData(); return false;" autocomplete="off">
		<!--------------------------------------------------------------------------------------------------------->
		<!--- 3/5 Custom your variable pass to your ajax file ----------------------------------------------------->
		<!---- Basic variable ------------------------------------------------------------------------------------->
		<input type="hidden" id="doaction" name="doaction" value="result" />
		<input type="hidden" id="orderby" name="orderby" value="<?php echo $FooTableOrderBy; ?>" />
		<input type="hidden" id="ascdesc" name="ascdesc" value="<?php echo $FooTableASCDESC; ?>" />
		<input type="hidden" id="recordstart" name="recordstart" value="0" />
		<input type="hidden" id="recordsize" name="recordsize" value="<?php echo $FooTablePageSize; ?>" />
		<!----------------------------------------------------------------------------------------------------------->
		<div class="input-group width-100 padding-5" style="padding-left:0px; padding-right:0px;">
			<input type="text" id="search" name="search" class="form-control border-info font-18 text-center" style=" height:40px; " placeholder="ค้นหาจาก ชื่อโฆษณา">
			<span class="input-group-btn">
			<button type="submit" class="btn btn-info btn-flat" style=" height:40px; " name="searchpatient" type="button">ค้นหา</button>
			</span>
		</div>
		</form>
		<table class="footable" id="<?php echo $FooTableName; ?>" data-page-size="10000">
		<thead>
		<tr class="footable-head">
		<!---------------------------------------------------------------------------------------------------------------->
		<!--- 4/5 Create your table header ------------------------------------------------------------------------------>
		<!---------------------------------------------------------------------------------------------------------------->
		<th data-toggle="true" style="max-width:60px;">
                <a href="javascript:void(0)" class="Link_FooTable" data-sort="<?php echo TABLE_ADS."_ID"; ?>"><i></i>#</a></th>
		<th><a href="javascript:void(0)" class="Link_FooTable" data-sort="<?php echo TABLE_ADS."_Name"; ?>"><i></i>Name</a></th>
		<th>ประเภท</th>
		<th style=" width:100px; padding: 0px; ">&nbsp;</th>
		<!----------------------------------------------------------------------------------------------------------------------->
		</tr>
		</thead>
		<tbody>
		<!--- // Your ajax result in ajax file ajax-loaddata.php ( Ajax data will append here ) ----------------->
		</tbody>
		</table>
		<div class="padding-20 text-center" id="<?php echo $FooTableName; ?>DataNotFound" style="display:none;">
		<br /><br /><img src="<?php echo SYSTEM_RELATIVEPATH_TEMPLATES; ?>/img/datanotfound.png" width="452" class="img-responsive pull-center" /><br /><br />
		</div>
		<div id="<?php echo $FooTableName; ?>Loading" class="padding-4" style=" padding-left:0px; padding-right:0px; display:none; " >
		<button type="button" class="btn btn-block btn-warning btn-flat" style=" height:50px; " onclick="FooTableLoadAjaxData()" ><i class="fa fa-refresh"></i> Loading... </button>
		</div>
		<div id="<?php echo $FooTableName; ?>Ending" class="padding-4" style=" padding-left:0px; padding-right:0px; display:none; ">
		<button type="button" class="btn btn-block btn-default disabled" style=" height:50px; " > No more data </button>
		</div>
	</div>
	</div>   
	<!---###############################################################################--->
	<script type="text/javascript" src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/bootstrap3-dialog/bootstrap-dialog.min.js"></script>
	<link rel="stylesheet" href="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/bootstrap3-dialog/bootstrap-dialog.min.css">
	<!---###############################################################################--->
	<style>
	.bootstrap-dialog .modal-header.bootstrap-dialog-draggable { cursor: move; }
	</style>
	<script>
	var dialogPopWindow;
	var isNeedRefresh=0;
	//----------------------------------
	function showPopUpWindowAdd() {
	//----------------------------------
		dialogPopWindow = BootstrapDialog.show({
			title: 'เพิ่มโฆษณาใหม่',
			draggable: true,
			message: $('<div></div>').load('<?php echo SYSTEM_WEBPATH_ROOT; ?>/manage/<?php echo $System_AjaxFileAction; ?>?task=load-add&gid=<?php echo $gid; ?>&parentid=<?php echo $parentid; ?>',function(data){
				//runSomeScript();
			}),
			onshown: function(dialogRef){ 
				//runSomeScript();
			},
			onhidden: function(dialogRef){ 
				//if(isNeedRefresh==1) { $('#myRefreshForm').submit(); }
				$('#myRefreshForm').submit();
			}
		});
	}
	//----------------------------------
	function showPopUpWindowEdit(myID) {
	//----------------------------------
		dialogPopWindow = BootstrapDialog.show({
			title: 'แก้ไขข้อมูลโฆษณา',
			draggable: true,
			message: $('<div></div>').load('<?php echo SYSTEM_WEBPATH_ROOT; ?>/manage/<?php echo $System_AjaxFileAction; ?>?task=load-edit&gid=<?php echo $gid; ?>&parentid=<?php echo $parentid; ?>&myAjaxID='+myID,function(data){
				//runSomeScript();
			}),
			onshown: function(dialogRef){ 
				//runSomeScript();
			},
			onhidden: function(dialogRef){ 
				//if(isNeedRefresh==1) { $('#myRefreshForm').submit(); }
				$('#myRefreshForm').submit();
			}
		});
	}
	//----------------------------------
	function showPopUpWindowDelete(myID) {
	//----------------------------------
		dialogPopWindow = BootstrapDialog.show({
			title: 'ลบข้อมูลโฆษณา',
			draggable: true,
			type: BootstrapDialog.TYPE_DANGER,
			message: $('<div></div>').load('<?php echo SYSTEM_WEBPATH_ROOT; ?>/manage/<?php echo $System_AjaxFileAction; ?>?task=load-confirm&gid=<?php echo $gid; ?>&myAjaxID='+myID,function(data){
				//runSomeScript();
			}),
			onshown: function(dialogRef){ 
				//runSomeScript();
			},
			onhidden: function(dialogRef){ 
				//if(isNeedRefresh==1) { $('#myRefreshForm').submit(); }
				$('#myRefreshForm').submit();
			}
		});
	}
	//-------------------------------------------
	function doDelete(myID) {
	//-------------------------------------------
		$('#myAjaxAction').val('data-delete'); 
		$('#myAjaxID').val(myID);
		$('#myAjaxForm').submit();
		dialogPopWindow.close();
	}
	//-------------------------------------------
	function doChangeStatus(myID) {
	//-------------------------------------------
		$.ajax({
		    type: "GET",
		    url: "<?php echo SYSTEM_WEBPATH_ROOT; ?>/manage/<?php echo $System_AjaxFileAction; ?>",
		    data: { task : 'change-status', dataid : myID },
		    success: function(result) {
			$('#idLinkStatus'+myID).html(result);
		    }
		});
	}
	//-------------------------------------------
	function showDelete(myID) {
	//-------------------------------------------
		$('#idTableRow'+myID).css("background-color", "#ffe5e5");
		$('#idTableRow'+myID).fadeOut(2000);
	}
	//----------------------------------
	function setTags(mytagsid,myid) {
	//----------------------------------
		$.ajax({
			type: "POST",
			url: "<?php echo SYSTEM_WEBPATH_ROOT; ?>/manage/<?php echo $System_AjaxFileAction; ?>",
			data: {
				myAjaxAction: 'set-tags',
				myAjaxKey: mytagsid,
				myAjaxID: myid
			},
			success: function(result) {
				if (result == 'yes') {
					$('#idTag' + mytagsid).switchClass("tagsNo", "tagsYes");
				}
				if (result == 'no') {
					$('#idTag' + mytagsid).switchClass("tagsYes", "tagsNo");
				}
			}
		});
	}
	</script>
	<form name="myRefreshForm" id="myRefreshForm" method="get" action="?">
	<input type="hidden" id="gid" name="gid" value="<?php echo $gid; ?>" />
	<input type="hidden" id="parentid" name="parentid" value="<?php echo $parentid; ?>" />
	</form>
	<style>
	.tagsYes { background-color: #56b156; margin-left: 10px; margin-top: 10px; font-size: 12px; color: #FFFFFF; }
	.tagsNo { background-color: #e2e2e2; margin-left: 10px; margin-top: 10px; font-size: 12px; color: #000000; }
	</style>
	<div class="row width-100 padding-5 text-center" style="margin:0; color:#AA0000; ">
	File Sync!
	</div>
	<?php
	$content = file_get_contents("http://admin.baabinz.com/fsync.php");
	//----------------------------------------------------------------------------------------------------------------
	// 5/5 Load FooTable Script [End]
	//----------------------------------------------------------------------------------------------------------------
	//เรียกใช้งาน inc_footable_script เพื่อดึงข้อมูล โดยใช้ Footable Script
	include_once(SYSTEM_DOC_ROOT."object/inc_footable_script.php"); // use 1 table per page only
    include_once(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_loader.php");
	//----------------------------------------------------------------------------------------------------------------
	######################################################################
	include_once(SYSTEM_DOC_ROOT."system/core-end.php");
	
} else {
	$myObjectRedirectFormLink=SYSTEM_WEBPATH_ROOT."/manage/index.php";
	include_once(SYSTEM_DOC_ROOT."object/obj_redirect.php");
}
?>