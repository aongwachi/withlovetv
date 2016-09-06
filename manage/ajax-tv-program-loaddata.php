<?php
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php }

## System Start ############################################################
include("../_config/config_system.php");
include_once(SYSTEM_DOC_ROOT."/system/core-start-ajax.php");
if($SystemSession_Staff_ID>0 && $SystemSession_Staff_Level=="Admin") { } else { exit; } // LogIn User Only

############################################################################
$myAjaxAction = trim($_REQUEST['myAjaxAction']);
$myAjaxID = trim($_REQUEST['myAjaxID']);
$myAjaxKey = trim($_REQUEST['myAjaxKey']);
$myAjaxValue = trim($_REQUEST['myAjaxValue']);

############################################################################
$task = addslashes($_GET['task']);
############################################################################
$orderby = addslashes($_GET['orderby']);
$ascdesc = addslashes($_GET['ascdesc']);
$recordstart = addslashes($_GET['recordstart']);
$recordsize = addslashes($_GET['recordsize']);
$currentdate = str_replace(".","-",addslashes($_GET['currentdate']));
$search = addslashes(trim($_GET['search']));
$doaction = addslashes(trim($_GET['doaction']));
if($recordstart>0) { } else { $recordstart=0; }
if($recordsize>0) { } else { $recordsize=CONFIG_PAGESIZE; }
if($orderby=='') { $orderby=TABLE_PROGRAM."_ID"; }
if($ascdesc=='') { $ascdesc='DESC'; }
############################################################################
if($myAjaxAction=="data-delete" && $myAjaxID>0) {
	$sql=" DELETE FROM ".TABLE_PROGRAM." WHERE ".TABLE_PROGRAM."_ID='".$myAjaxID."' ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>n");
	echo " <script> ";
	echo " window.parent.showDelete('".$myAjaxID."'); ";
	echo " </script> ";
}
############################################################################
$arDataID=array('1','2');
$arDataText=array('รายการแนะนำ','Most Wanted');
############################################################################
if($task=="load-confirm" && $myAjaxID>0) {

	?>
	<div class="text-center">
	<br>
	<h2>คุณต้องการลบ รายการนี้ แน่ใจหรือไม่?</h2>
	<br>
	<div class="form-group">
	<div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-4 col-lg-offset-2 padding-2">
	<button type="submit" name="inputSubmit" class="btn btn-info btn-block btn-flat" style="height:50px;" onclick=" dialogPopWindow.close(); ">
	<span class="glyphicon glyphicon-ban-circle"></span> ยกเลิก </button>
	</div>
	<div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-5 col-md-offset-0 col-lg-4 col-lg-offset-0 padding-2">
	<button type="button" name="inputCancel" class="btn btn-danger btn-block btn-flat" style="height:50px;" onClick=" doDelete('<?php echo $myAjaxID; ?>'); ">
	<span class="glyphicon glyphicon-trash"></span> ลบ </button>
	</div></div><br></div>
	<?php
}
############################################################################
if($task=="load-edit" && $myAjaxID>0) {
	// ---------------------------------------
	$sql=" SELECT * FROM ".TABLE_PROGRAM." WHERE ".TABLE_PROGRAM."_ID='".$myAjaxID."' LIMIT 0,1 ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$Row = mysql_fetch_array($Query);
	// ---------------------------------------
	$myID=$myAjaxID;
	$myTable=TABLE_PROGRAM;
	$myKeyField=TABLE_PROGRAM."_ID";
	?>
	<!-------------------------------------------------------------------------------->
	<div class="form-group width-100">
		<!--------------------------->
		<?php $myField=TABLE_PROGRAM."_Name"; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">Name</span>
		</label>
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 custom-text-position">
		<?php
		//--------------------------------------------
		$Config_UniqueID=$myField.$myID;
		$Config_DefaultValue=$Row[$myField];
		$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
		//--------------------------------------------
		$Config_MaxChar=500;
		$Config_Width="300px";
		$Config_TextAlign="left";
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_text.php");
		?>
		</div>
		<!--------------------------->
		<?php $myField=TABLE_PROGRAM."_Detail"; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">Detail</span>
		</label>
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 custom-text-position">
		<?php
		//--------------------------------------------
		$Config_UniqueID=$myField.$myID;
		$Config_DefaultValue=$Row[$myField];
		$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
		//--------------------------------------------
		$Config_MaxChar=500;
		$Config_Width="300px";
		$Config_TextAlign="left";
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_text.php");
		?>
		</div>
		<!--------------------------->
		<?php $myField=TABLE_PROGRAM."_Image_Url"; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">Image</span>
		</label>
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 custom-text-position">
		<?php
		//--------------------------------------------
		$Config_UniqueID=$myField.$myID;
		$Config_DefaultValue=$Row[$myField];
		$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
		//--------------------------------------------
		$Config_MaxChar=500;
		$Config_Width="300px";
		$Config_TextAlign="left";
		//--------------------------------------------
		$Config_Type_Input="file";
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_text.php");
		$Config_Type_Input="";
		?>
		</div>
		<!--------------------------->
		<?php $myField=TABLE_PROGRAM."_URL"; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">URL</span>
		</label>
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 custom-text-position">
		<?php
		//--------------------------------------------
		$Config_UniqueID=$myField.$myID;
		$Config_DefaultValue=$Row[$myField];
		$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
		//--------------------------------------------
		$Config_MaxChar=500;
		$Config_Width="300px";
		$Config_TextAlign="center";
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_text.php");
		?>
		</div>
		<!--------------------------->
		<?php $myField=TABLE_PROGRAM."_StartTime"; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">Start Time</span>
		</label>
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 custom-text-position">
		<?php
		//--------------------------------------------
		$Config_UniqueID=$myField.$myID;
		$Config_DefaultValue=$Row[$myField];
		$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
		//--------------------------------------------
		$Config_MaxChar=19;
		$Config_Width="200px";
		$Config_TextAlign="center";
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_datetime.php");
		?>
		</div>
		</div>
		<!--------------------------->
		<?php $myField=TABLE_PROGRAM."_EndTime"; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">End Time</span>
		</label>
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 custom-text-position">
		<?php
		//--------------------------------------------
		$Config_UniqueID=$myField.$myID;
		$Config_DefaultValue=$Row[$myField];
		$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
		//--------------------------------------------
		$Config_MaxChar=19;
		$Config_Width="200px";
		$Config_TextAlign="center";
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_datetime.php");
		?>
		</div>
		</div>
		<!--------------------------->
		<?php $myField=TABLE_PROGRAM."_Type"; $myFieldText=""; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">ประเภทของรายการ</span>
		</label>
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 custom-text-position">
		<?php
		//--------------------------------------------
		$Config_DataSourceArrayID=$arDataID; // your data id array
		$Config_DataSourceArrayText=$arDataText; // your data text array
		$Config_BlankID=""; // not select state (set blank '' for not use)
		$Config_isShowUnselectValue=false;
		//--------------------------------------------
		$Config_UniqueID=$myField.$myID;
		$Config_DefaultValue=$Row[$myField];
		$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_radio_bootstrap.php");
		?>
		</div>
		<!--------------------------->

	</div>
	<div class="form-group width-100">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 padding-2">
	<button type="submit" name="inputSubmit" class="btn btn-success btn-block btn-flat" style="height:50px;" onclick=" isNeedRefresh=1; dialogPopWindow.close(); ">
	<span class="glyphicon glyphicon-ok"></span> OK </button>
	</div>
	<?php
}
############################################################################
if($myAjaxAction=="data-update") {
	$sql = " UPDATE ".TABLE_PROGRAM." SET ".$myAjaxKey."='".$myAjaxValue."' WHERE ".TABLE_PROGRAM."_ID='".$myAjaxID."' ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	echo " <script> ";
	echo " window.parent.showSave('".$myAjaxID."','".$myAjaxKey."'); ";
	echo " </script> ";
}
############################################################################
if($task=="load-add") {
	// Check uncomplete ------------------
	$sql=" SELECT ".TABLE_PROGRAM."_ID FROM ".TABLE_PROGRAM." WHERE ".TABLE_PROGRAM."_URL='' LIMIT 0,1 ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$Row = mysql_fetch_array($Query);
	$myUnCompleteID=$Row[0];
	// ---------------------------------------
	if($myUnCompleteID>0) { } else{ // insert new
		$sql=" SELECT MAX(".TABLE_PROGRAM."_ID) FROM ".TABLE_PROGRAM." WHERE 1 ";
		$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
		$Row = mysql_fetch_array($Query);
		$myUnCompleteID=$Row[0]+1;
		$sql=" INSERT INTO ".TABLE_PROGRAM."(".TABLE_PROGRAM."_ID,".TABLE_PROGRAM."_URL) VALUES('".$myUnCompleteID."','') ";
		$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	}
	// ---------------------------------------
	$sql=" SELECT * FROM ".TABLE_PROGRAM." WHERE ".TABLE_PROGRAM."_ID='".$myUnCompleteID."' LIMIT 0,1 ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$Row = mysql_fetch_array($Query);
	$myUnCompleteID=$Row[TABLE_PROGRAM."_ID"];
	// ---------------------------------------
	$myID=$myUnCompleteID;
	$myTable=TABLE_PROGRAM;
	$myKeyField=TABLE_PROGRAM."_ID";
	?>
	<!-------------------------------------------------------------------------------->
	<div class="form-group width-100">
		<!--------------------------->
		<?php $myField=TABLE_PROGRAM."_Name"; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">Name</span>
		</label>
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 custom-text-position">
		<?php
		//--------------------------------------------
		$Config_UniqueID=$myField.$myID;
		$Config_DefaultValue=$Row[$myField];
		$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
		//--------------------------------------------
		$Config_MaxChar=500;
		$Config_Width="300px";
		$Config_TextAlign="left";
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_text.php");
		?>
		</div>
		<!--------------------------->
		<?php $myField=TABLE_PROGRAM."_Detail"; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">Detail</span>
		</label>
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 custom-text-position">
		<?php
		//--------------------------------------------
		$Config_UniqueID=$myField.$myID;
		$Config_DefaultValue=$Row[$myField];
		$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
		//--------------------------------------------
		$Config_MaxChar=500;
		$Config_Width="300px";
		$Config_TextAlign="left";
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_text.php");
		?>
		</div>
		<!--------------------------->
		<?php $myField=TABLE_PROGRAM."_Image_Url"; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">Image</span>
		</label>
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 custom-text-position">
		<?php
		//--------------------------------------------
		$Config_UniqueID=$myField.$myID;
		$Config_DefaultValue=$Row[$myField];
		$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
		//--------------------------------------------
		$Config_MaxChar=500;
		$Config_Width="300px";
		$Config_TextAlign="left";
		//--------------------------------------------
		$Config_Type_Input="file";
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_text.php");
		$Config_Type_Input="";
		?>
		</div>
		<!--------------------------->
		<?php $myField=TABLE_PROGRAM."_URL"; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">URL</span>
		</label>
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 custom-text-position">
		<?php
		//--------------------------------------------
		$Config_UniqueID=$myField.$myID;
		$Config_DefaultValue=$Row[$myField];
		$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
		//--------------------------------------------
		$Config_MaxChar=500;
		$Config_Width="300px";
		$Config_TextAlign="center";
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_text.php");
		?>
		</div>
		<!--------------------------->
		<?php $myField=TABLE_PROGRAM."_StartTime"; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">Start Time</span>
		</label>
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 custom-text-position">
		<?php
		//--------------------------------------------
		$Config_UniqueID=$myField.$myID;
		$Config_DefaultValue=$Row[$myField];
		$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
		//--------------------------------------------
		$Config_MaxChar=19;
		$Config_Width="200px";
		$Config_TextAlign="center";
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_datetime.php");
		?>
		</div>
		</div>
		<!--------------------------->
		<?php $myField=TABLE_PROGRAM."_EndTime"; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">End Time</span>
		</label>
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 custom-text-position">
		<?php
		//--------------------------------------------
		$Config_UniqueID=$myField.$myID;
		$Config_DefaultValue=$Row[$myField];
		$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
		//--------------------------------------------
		$Config_MaxChar=19;
		$Config_Width="200px";
		$Config_TextAlign="center";
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_datetime.php");
		?>
		</div>
		</div>
		<!--------------------------->
		<?php $myField=TABLE_PROGRAM."_Type"; $myFieldText=""; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">ประเภทของรายการ</span>
		</label>
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 custom-text-position">
		<?php
		//--------------------------------------------
		$Config_DataSourceArrayID=$arDataID; // your data id array
		$Config_DataSourceArrayText=$arDataText; // your data text array
		$Config_BlankID=""; // not select state (set blank '' for not use)
		$Config_isShowUnselectValue=false;
		//--------------------------------------------
		$Config_UniqueID=$myField.$myID;
		$Config_DefaultValue=$Row[$myField];
		$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_radio_bootstrap.php");
		?>
		</div>
		<!--------------------------->

	</div>
	<div class="form-group width-100">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 padding-2">
	<button type="submit" name="inputSubmit" class="btn btn-success btn-block btn-flat" style="height:50px;" onclick=" isNeedRefresh=1; dialogPopWindow.close(); ">
	<span class="glyphicon glyphicon-ok"></span> OK </button>
	</div>
	<?php
}
############################################################################
if($doaction=="result") {
	if($search=='') {
		$sql=" SELECT * FROM ".TABLE_PROGRAM." WHERE ".TABLE_PROGRAM."_Name<>'' ";
	}else{
		$sql=" SELECT * FROM ".TABLE_PROGRAM." WHERE ".TABLE_PROGRAM."_Name LIKE '%".$search."%' OR ".TABLE_PROGRAM."_Detail LIKE '%".$search."%'";
	}
	$sql.=" ORDER BY ".$orderby." ".$ascdesc." LIMIT ".$recordstart.",".$recordsize." ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>n");
	while($Row = mysql_fetch_array($Query)) {
		?>
		<tr
		onclick=" $('#idActionBT<?php echo $Row[TABLE_PROGRAM."_ID"];?>').show(); "
		onmouseover=" $('#idActionBT<?php echo $Row[TABLE_PROGRAM."_ID"];?>').show(); "
		onmouseout=" $('#idActionBT<?php echo $Row[TABLE_PROGRAM."_ID"];?>').hide(); "
		id="idTableRow<?php echo $Row[TABLE_PROGRAM."_ID"];?>">
		<td><?php echo $Row[TABLE_PROGRAM."_ID"];?></td>
		<td><?php echo $Row[TABLE_PROGRAM."_Name"];?></td>
		<td><?php echo $Row[TABLE_PROGRAM."_Detail"];?></td>
		<td><?php echo $Row[TABLE_PROGRAM."_Image_Url"];?></td>
		<td><?php echo $Row[TABLE_PROGRAM."_URL"];?></td>
		<td><?php echo $Row[TABLE_PROGRAM."_StartTime"]; ?></td>
		<td><?php echo $Row[TABLE_PROGRAM."_EndTime"]; ?></td>
		<td><?php echo $Row[TABLE_PROGRAM."_Type"] == 1?'รายการแนะนำ':'Most Wanted'; ?></td>
		<td style=" width:60px; padding: 0px; ">
		<div id="idActionBT<?php echo $Row[TABLE_PROGRAM."_ID"];?>"
		style=" height: 30px; padding: 4px; width: 140px; position: absolute; margin-top: -14px; margin-left: -80px; text-align: right; display: none; ">
			<button type="button" class="btn btn-primary btn-flat"
			style=" font-size:10px; padding:2px; padding-left:10px; padding-right: 10px; "
			onclick=" showPopUpWindowEdit(<?php echo $Row[TABLE_PROGRAM."_ID"];?>); "><i class="fa fa-pencil-square-o"></i> Edit</button>
			<button type="button" class="btn btn-danger btn-flat"
			style=" font-size:10px; padding:2px; padding-left:10px; padding-right: 10px; "
			onclick=" showPopUpWindowDelete(<?php echo $Row[TABLE_PROGRAM."_ID"];?>); "><i class="fa fa-times"></i> Delete</button>
		</div>
		</td>
		</tr>
		<?php
	}
}
############################################################################
if($doaction=="count") {
	if($search=='') {
		$sql=" SELECT COUNT(*) FROM ".TABLE_PROGRAM." WHERE ".TABLE_PROGRAM."_User<>'' AND ".TABLE_PROGRAM."_Pass<>'' ";
	}else{
		$sql=" SELECT COUNT(*) FROM ".TABLE_PROGRAM." WHERE ".TABLE_PROGRAM."_User LIKE '%".$search."%' OR ".TABLE_PROGRAM."_Detail LIKE '%".$search."%'";
	}
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>n");
	$Row = mysql_fetch_array($Query);
	echo $Row[0];
}
############################################################################
MYSQL_CLOSE();
?>