<?php  if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } 
$System_LayoutUse="layout_manage.html";
$System_AjaxFileAction="ajax-allcontent-home-loaddata.php";
$System_ShowAjaxIFrame=0;

include_once("../_config/config_system.php");
include_once(SYSTEM_DOC_ROOT."system/core-start-ajax.php");
if($SystemSession_Staff_ID>0) { 
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
	$FooTablePageSize=5;
	$FooTableASCDESC='DESC';
	$FooTableOrderBy=TABLE_CONTENT."_ID";
	//----------------------------------------------------------------------------------------------------------------
	?>
	<?php
	//--------------------------------------------------------
	$myStaffName="";
	$sql1=" SELECT * FROM ".TABLE_STAFF." WHERE 1 ";
	$Query1=MYSQL_QUERY($sql1,$System_Connection1) OR DIE("Error: ".$sql1."<br>\n");
	while($Row1=mysql_fetch_array($Query1)) {
		$myStaffID=$Row1[TABLE_STAFF."_ID"];
		$myStaffName[$myStaffID]=$Row1[TABLE_STAFF."_Name"];
		$myStaffPicture[$myStaffID]=trim($Row1[TABLE_STAFF."_Picture"]);
	}
	//--------------------------------------------------------
	$sql=" SELECT MAX(".TABLE_CONTENT."_OnlineDate) FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_Status='Publish' LIMIT 0,1 ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$Row=mysql_fetch_array($Query);
	$myOnlineDate=substr($Row[0],0,10);
	//--------------------------------------------------------
	$sql=" SELECT MAX(".TABLE_CONTENT."_OnlineDate) FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_OnlineDate<'".$myOnlineDate."' LIMIT 0,1 ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$Row=mysql_fetch_array($Query);
	$myOnlineDate1=substr($Row[0],0,10);
	//--------------------------------------------------------
	?>
	<br>
	<div class="row width-100">
		<div class="pull-center padding-0 text-center" style=" max-width:1080px; ">
			<h1>โพสวันนี้ <?php echo System_ShowDate($myOnlineDate); ?> </h1>
			<br>
			<table width="100%" border="0"><tr>
			<?php
			$sql1=" SELECT COUNT(*),".TABLE_CONTENT."_CreateByStaffID FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_OnlineDate LIKE '".$myOnlineDate."%' AND ".TABLE_CONTENT."_Status='Publish' GROUP BY ".TABLE_CONTENT."_CreateByStaffID ORDER BY COUNT(*) DESC ";
			$Query1=MYSQL_QUERY($sql1,$System_Connection1) OR DIE("Error: ".$sql1."<br>\n");
			while($Row1=mysql_fetch_array($Query1)) {
				$myID=$Row1[1];
				$myIDs=sprintf('%04d',$myID);
				$myFolder1=substr($myIDs,strlen($myIDs)-4,2);
				$myFolder2=substr($myIDs,strlen($myIDs)-2,2);
				$Config_FolderKey='staff';
				$Config_Path="../upload/".$Config_FolderKey."/".$myFolder1."/".$myFolder2."/";
				if(trim($myStaffPicture[$myID])<>"") {
					?>
					<td class="text-center padding-10">
						<div class="pull-center">
						<img src="<?php echo $Config_Path.$myStaffPicture[$myID]; ?>" class="img-bordered border-green img-circle pull-center" style=" width:50px; height:50px; " />
						</div>
						<b><?php echo $myStaffName[$myID]; ?></b><br>
						<?php echo $Row1[0]; ?> บทความ
					</td>
					<?php
				} else {
					?>
					<td class="text-center padding-10">
						<div class="img-bordered border-green img-circle pull-center" style=" width: 50px; height: 50px; ">&nbsp;</div>
						<b><?php echo $myStaffName[$myID]; ?></b><br>
						<?php echo $Row1[0]; ?> บทความ
					</td>
					<?php
				}
				//echo "User:".$myStaffName[$myID]."/".$Row1[0]."<br>";
			}
			?>
			</tr></table>
		</div>
	</div>
	<br><br>
	<div class="row width-100">
		<div class="pull-center padding-0 text-center" style=" max-width:1080px; ">
			<h1>โพสเมื่อวาน <?php echo System_ShowDate($myOnlineDate1); ?> </h1>
			<br>
			<table width="100%" border="0"><tr>
			<?php
			$sql1=" SELECT COUNT(*),".TABLE_CONTENT."_CreateByStaffID FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_OnlineDate LIKE '".$myOnlineDate1."%' AND ".TABLE_CONTENT."_Status='Publish' GROUP BY ".TABLE_CONTENT."_CreateByStaffID ORDER BY COUNT(*) DESC ";
			$Query1=MYSQL_QUERY($sql1,$System_Connection1) OR DIE("Error: ".$sql1."<br>\n");
			while($Row1=mysql_fetch_array($Query1)) {
				$myID=$Row1[1];
				$myIDs=sprintf('%04d',$myID);
				$myFolder1=substr($myIDs,strlen($myIDs)-4,2);
				$myFolder2=substr($myIDs,strlen($myIDs)-2,2);
				$Config_FolderKey='staff';
				$Config_Path="../upload/".$Config_FolderKey."/".$myFolder1."/".$myFolder2."/";
				if(trim($myStaffPicture[$myID])<>"") {
					?>
					<td class="text-center padding-10">
						<div class="pull-center">
						<img src="<?php echo $Config_Path.$myStaffPicture[$myID]; ?>" class="img-bordered border-green img-circle pull-center" style=" width:50px; height:50px; " />
						</div>
						<b><?php echo $myStaffName[$myID]; ?></b><br>
						<?php echo $Row1[0]; ?> บทความ
					</td>
					<?php
				} else {
					?>
					<td class="text-center padding-10">
						<div class="img-bordered border-green img-circle pull-center" style=" width: 50px; height: 50px; ">&nbsp;</div>
						<b><?php echo $myStaffName[$myID]; ?></b><br>
						<?php echo $Row1[0]; ?> บทความ
					</td>
					<?php
				}
			}
			?>
			</tr></table>
		</div>
	</div>
	<div class="divright">
		<button class="btn btn-danger btn-bigicon" onclick=" location.href='content.php?act=addnew'; ">
		<i class=" glyphicon glyphicon-pencil "></i> Add New
		</button>
		<button class="btn btn-info btn-bigicon" onclick=" location.href='allcontent.php'; " style=" margin-top: 4px;">
		<i class=" glyphicon glyphicon-book "></i> Show All
		</button>
	</div>
	<style>
	.divright { position: fixed; top: 170px; right: 0; z-index: 102; width: 50px; height:120px; padding:10px; border: 0px; margin-right: 40px; }
	</style>
	<br>
	<br>
	<!---###############################################################################--->
	<div class="pull-center padding-10 text-center" style=" max-width:1080px; ">
	<div class="row-fluid width-100 padding-5">            
	<div class="panel panel-custom" style=" border-width:0px; ">
	<div class="panel-heading panel-custom-heading font-white" style=" background-color:<?php echo $myBGColor; ?>; color:#FFFFFF; text-align:left; height:80px; position:relative; ">
		<i class="glyphicon glyphicon-book pull-left padding-10" style="font-size:40px; padding-right:20px;"></i>
		<h2 class="font-white"><strong>Lastest Content</strong></h2> <span> บทความล่าสุด</span>
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
			<input type="text" id="search" name="search" class="form-control border-info font-18 text-center" style=" height:40px; " placeholder="ค้นหาจาก ชื่อบทความ">
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
                <a href="javascript:void(0)" class="Link_FooTable" data-sort="<?php echo TABLE_CONTENT."_ID"; ?>"><i></i>#</a></th>
		<th><a href="javascript:void(0)" class="Link_FooTable" data-sort="<?php echo TABLE_CONTENT."_Subject"; ?>"><i></i>บทความ</a></th>
		<th><a href="javascript:void(0)" class="Link_FooTable" data-sort="<?php echo TABLE_CONTENT."_Status"; ?>"><i></i>สถานะ</a></th>
		<th><a href="javascript:void(0)" class="Link_FooTable" data-sort="<?php echo TABLE_CONTENT."_OnlineDate"; ?>"><i></i>เวลาออนไลน์</a></th>
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
			title: 'เพิ่มบทความใหม่',
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
			title: 'แก้ไขข้อมูลบทความ',
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
			title: 'ลบข้อมูลบทความ',
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
	//-------------------------------------------
	function doEdit(myid) {
	//-------------------------------------------
	    $('#cid').val(myid);
	    $('#myEditForm').submit();
	}
	//-------------------------------------------
	function doAddNew() {
	//-------------------------------------------
	    $('#myAddNewForm').submit();
	}
	</script>
	<form name="myRefreshForm" id="myRefreshForm" method="get" action="?">
	</form>
	<form name="myAddNewForm" id="myAddNewForm" method="get" action="content.php">
	<input type="hidden" id="act" name="act" value="addnew" >
	</form>
	<form name="myEditForm" id="myEditForm" method="get" action="content.php">
	<input type="hidden" id="cid" name="cid" value="0" >
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