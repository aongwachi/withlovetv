<?php  if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } 
$System_LayoutUse="layout_manage.html";
$System_AjaxFileAction="ajax-theme-loaddata.php";
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
	$FooTableOrderBy=TABLE_THEME."_ID";
	//----------------------------------------------------------------------------------------------------------------
	?><br>
	<!---###############################################################################--->
        <script type="text/javascript" src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/js-select2/select2.js"></script>
        <link rel="stylesheet" href="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/js-select2/select2.min.css">
	<!---###############################################################################--->
	<div class="row-fluid width-100 padding-5">
           
	<div class="panel panel-custom" style=" border-width:0px; ">
	<div class="panel-heading panel-custom-heading font-white" style=" background-color:<?php echo $myBGColor; ?>; color:#FFFFFF; text-align:left; height:80px; position:relative; ">
		<i class="glyphicon glyphicon-random pull-left padding-10" style="font-size:40px; padding-right:20px;"></i>
		<h2 class="font-white"><strong>Theme</strong></h2> <span> ดีไซน์</span>
		<div class="pull-right" style=" color:#FFFF00; "><span class="hidden-xs">ค้นพบ</span> 
		<!--------------------------------------------------------------------------------------------->
		<!--- 2/5 Total record will display here ------------------------------------------------------>
		<!--------------------------------------------------------------------------------------------->
		<span id="idFooTableTotalRecord">0</span>
		<!---------------------------------------------------------------------------------------------->
		รายการ
		</div>
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
		<div class="input-group width-100 padding-5" style="padding-left:0px; padding-right:0px;">
			<input type="text" id="search" name="search" class="form-control border-info font-18 text-center" style=" height:40px; " placeholder="ค้นหาจาก ชื่อดีไซน์">
			<span class="input-group-btn">
			<button type="submit" class="btn btn-info btn-flat" style=" height:40px; " name="searchpatient" type="button">ค้นหา</button>
			</span>
		</div>
		<!----------------------------------------------------------------------------------------------------------->
		</form>
		<table class="footable" id="<?php echo $FooTableName; ?>" data-page-size="10000">
		<thead>
		<tr class="footable-head">
		<!---------------------------------------------------------------------------------------------------------------->
		<!--- 4/5 Create your table header ------------------------------------------------------------------------------>
		<!---------------------------------------------------------------------------------------------------------------->
		<th data-toggle="true" style="max-width:60px;">
                <a href="javascript:void(0)" class="Link_FooTable" data-sort="<?php echo TABLE_THEME."_ID"; ?>"><i></i>#</a></th>
		<th><a href="javascript:void(0)" class="Link_FooTable" data-sort="<?php echo TABLE_THEME."_Key"; ?>"><i></i>Name</a></th>
		<th>Use</th>
		<th style=" width:60px; padding: 0px; ">&nbsp;</th>
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
	function showPopUpWindowEdit(myID) {
	//----------------------------------
		dialogPopWindow = BootstrapDialog.show({
			title: 'เลือก Theme',
			draggable: true,
			message: $('<div></div>').load('<?php echo $System_AjaxFileAction; ?>?task=load-edit&myAjaxID='+myID,function(data){
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
	function doChangeTheme(myID) {
	//-------------------------------------------
		$('#myAjaxAction').val('data-change'); 
		$('#myAjaxID').val(myID);
		$('#myAjaxForm').submit();
		dialogPopWindow.close();
	}
	//-------------------------------------------
	function doRefresh() {
	//-------------------------------------------
		dialogPopWindow.close();
		$('#myRefreshForm').submit();
	}
	</script>
	<form name="myRefreshForm" id="myRefreshForm" method="get" action="?">
	</form>
	<?php
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