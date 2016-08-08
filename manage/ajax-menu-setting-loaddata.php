<?php 
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php }

## System Start ############################################################
include("../_config/config_system.php");
include_once(SYSTEM_DOC_ROOT."/system/core-start-ajax.php");
if($SystemSession_Staff_ID>0 && $SystemSession_Staff_Level=="Admin") { } else { exit; } // LogIn Name Only
$ModuleConfig_Type="Setting";

############################################################################
$myAjaxAction = trim($_REQUEST['myAjaxAction']);
$myAjaxID = trim($_REQUEST['myAjaxID']);
$myAjaxKey = trim($_REQUEST['myAjaxKey']);
$myAjaxValue = trim($_REQUEST['myAjaxValue']);
############################################################################
$task = addslashes($_GET['task']);
$dataid = addslashes($_GET['dataid']);
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
if($orderby=='') { $orderby=TABLE_MENU."_ID"; }
if($ascdesc=='') { $ascdesc='DESC'; }
############################################################################
$arDataID=array('Public','Staff','Admin');
$arDataText=array('Public','Staff','Admin');
############################################################################
if($task=="change-status" && $dataid>0) {
	$sql=" SELECT * FROM ".TABLE_MENU." WHERE ".TABLE_MENU."_ID='".$dataid."' LIMIT 0,1 ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$Row = mysql_fetch_array($Query);
	if($Row[TABLE_MENU."_Status"]=="Enable") {
		$NewStatus='Disable';
	} else {
		$NewStatus='Enable';
	}
	echo $NewStatus;
	$sql=" UPDATE ".TABLE_MENU." SET ".TABLE_MENU."_Status='".$NewStatus."' WHERE ".TABLE_MENU."_ID='".$dataid."' ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");		
}
############################################################################
if($myAjaxAction=="data-delete" && $myAjaxID>0) {
	$sql=" DELETE FROM ".TABLE_MENU." WHERE ".TABLE_MENU."_ID='".$myAjaxID."' ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	echo " <script> ";
	echo " window.parent.showDelete('".$myAjaxID."'); ";
	echo " </script> ";
}
############################################################################
if($task=="load-confirm" && $myAjaxID>0) {
	?>
	<div class="text-center">
	<br>
	<h2>คุณต้องการลบ เมนูนี้ แน่ใจหรือไม่?</h2>
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
	$sql=" SELECT * FROM ".TABLE_MENU." WHERE ".TABLE_MENU."_ID='".$myAjaxID."' LIMIT 0,1 ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$Row = mysql_fetch_array($Query);
	// ---------------------------------------
	$myID=$myAjaxID;
	$myTable=TABLE_MENU;
	$myKeyField=TABLE_MENU."_ID";
	?>
	<!-------------------------------------------------------------------------------->
	<div class="form-group width-100">
		<!--------------------------->
		<?php $myField=TABLE_MENU."_Icon"; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">Icon</span>
		</label>
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 custom-text-position">
		<?php
		//--------------------------------------------
		$Config_UniqueID=$myField.$myID;
		$Config_DefaultValue=$Row[$myField];
		$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_select_icon.php");
		?>
		</div>
		<!--------------------------->
	</div>
	<div class="form-group width-100">
		<!--------------------------->
		<?php $myField=TABLE_MENU."_Name"; ?>
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
		$Config_MaxChar=100;
		$Config_Width="300px";
		$Config_TextAlign="left";
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_text.php");
		?>
		</div>
		<!--------------------------->
		<?php $myField=TABLE_MENU."_Link"; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">Link</span>
		</label>
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 custom-text-position">
		<?php
		//--------------------------------------------
		$Config_UniqueID=$myField.$myID;
		$Config_DefaultValue=$Row[$myField];
		$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
		//--------------------------------------------
		$Config_MaxChar=100;
		$Config_Width="300px";
		$Config_TextAlign="left";
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_text.php");
		?>
		</div>
		<!--------------------------->
		<?php $myField=TABLE_MENU."_Level"; $myFieldText=""; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">Level</span>
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
		<?php $myField=TABLE_MENU."_Ordering"; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">Order</span>
		</label>
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 custom-text-position">
		<?php
		//--------------------------------------------
		$Config_UniqueID=$myField.$myID;
		$Config_DefaultValue=$Row[$myField];
		$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
		//--------------------------------------------
		$Config_MaxChar=10;
		$Config_Width="50px";
		$Config_TextAlign="center";
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_text.php");
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
	$sql = " UPDATE ".TABLE_MENU." SET ".$myAjaxKey."='".$myAjaxValue."' WHERE ".TABLE_MENU."_ID='".$myAjaxID."' ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	echo " <script> ";
	echo " window.parent.showSave('".$myAjaxID."','".$myAjaxKey."'); ";
	echo " </script> ";
}
############################################################################
if($task=="load-add") {
	// Check uncomplete ------------------
	$sql=" SELECT ".TABLE_MENU."_ID FROM ".TABLE_MENU." WHERE (".TABLE_MENU."_Name='' OR ".TABLE_MENU."_Link='') AND ".TABLE_MENU."_Type='".$ModuleConfig_Type."' LIMIT 0,1 ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$Row = mysql_fetch_array($Query);
	$myUnCompleteID=$Row[0];
	// ---------------------------------------
	if($myUnCompleteID>0) { } else{ // insert new 
		$sql=" SELECT MAX(".TABLE_MENU."_ID) FROM ".TABLE_MENU." WHERE 1 ";
		$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
		$Row = mysql_fetch_array($Query);
		$myUnCompleteID=$Row[0]+1;
		$sql=" INSERT INTO ".TABLE_MENU."(".TABLE_MENU."_ID,".TABLE_MENU."_Ordering,".TABLE_MENU."_Type) VALUES('".$myUnCompleteID."','".$myUnCompleteID."','".$ModuleConfig_Type."') ";
		$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	}
	// ---------------------------------------
	$sql=" SELECT * FROM ".TABLE_MENU." WHERE ".TABLE_MENU."_ID='".$myUnCompleteID."' LIMIT 0,1 ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$Row = mysql_fetch_array($Query);
	$myUnCompleteID=$Row[TABLE_MENU."_ID"];
	// ---------------------------------------
	$myID=$myUnCompleteID;
	$myTable=TABLE_MENU;
	$myKeyField=TABLE_MENU."_ID";
	?>
	<!-------------------------------------------------------------------------------->
	<div class="form-group width-100">
		<!--------------------------->
		<?php $myField=TABLE_MENU."_Icon"; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">Icon</span>
		</label>
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 custom-text-position">
		<?php
		//--------------------------------------------
		$Config_UniqueID=$myField.$myID;
		$Config_DefaultValue=$Row[$myField];
		$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_select_icon.php");
		?>
		</div>
		<!--------------------------->
	</div>
	<div class="form-group width-100">
		<!--------------------------->
		<?php $myField=TABLE_MENU."_Name"; ?>
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
		$Config_MaxChar=100;
		$Config_Width="300px";
		$Config_TextAlign="left";
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_text.php");
		?>
		</div>
		<!--------------------------->
		<?php $myField=TABLE_MENU."_Link"; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">Link</span>
		</label>
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 custom-text-position">
		<?php
		//--------------------------------------------
		$Config_UniqueID=$myField.$myID;
		$Config_DefaultValue=$Row[$myField];
		$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
		//--------------------------------------------
		$Config_MaxChar=100;
		$Config_Width="300px";
		$Config_TextAlign="left";
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_text.php");
		?>
		</div>
		<!--------------------------->
		<?php $myField=TABLE_MENU."_Level"; $myFieldText=""; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">Level</span>
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
		<?php $myField=TABLE_MENU."_Ordering"; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">Order</span>
		</label>
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 custom-text-position">
		<?php
		//--------------------------------------------
		$Config_UniqueID=$myField.$myID;
		$Config_DefaultValue=$Row[$myField];
		$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
		//--------------------------------------------
		$Config_MaxChar=10;
		$Config_Width="50px";
		$Config_TextAlign="center";
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_text.php");
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
		$sql=" SELECT * FROM ".TABLE_MENU." WHERE ".TABLE_MENU."_Name<>'' AND ".TABLE_MENU."_Link<>'' AND ".TABLE_MENU."_Type='".$ModuleConfig_Type."' ";
	}else{		
		$sql=" SELECT * FROM ".TABLE_MENU." WHERE ".TABLE_MENU."_Name LIKE '%".$search."%' AND ".TABLE_MENU."_Name<>'' AND ".TABLE_MENU."_Link<>'' AND ".TABLE_MENU."_Type='".$ModuleConfig_Type."' ";
	}
	$sql.=" ORDER BY ".$orderby." ".$ascdesc." LIMIT ".$recordstart.",".$recordsize." ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	while($Row = mysql_fetch_array($Query)) {
		?>
		<tr
		onclick=" $('#idActionBT<?php echo $Row[TABLE_MENU."_ID"];?>').show(); "
		onmouseover=" $('#idActionBT<?php echo $Row[TABLE_MENU."_ID"];?>').show(); "
		onmouseout=" $('#idActionBT<?php echo $Row[TABLE_MENU."_ID"];?>').hide(); "
		id="idTableRow<?php echo $Row[TABLE_MENU."_ID"];?>">
		<td><?php echo $Row[TABLE_MENU."_ID"];?></td>
		<td style=" width: 40px; font-size: 16px; "><i class="<?php echo $Row[TABLE_MENU."_Icon"];?>"></i></td>
		<td><?php echo $Row[TABLE_MENU."_Name"];?></td>
		<td><?php echo $Row[TABLE_MENU."_Link"];?></td>
		<td><?php echo $Row[TABLE_MENU."_Level"];?></td>
		<td><a href="javascript:void(0)" id="idLinkStatus<?php echo $Row[TABLE_MENU."_ID"];?>" onclick=" doChangeStatus('<?php echo $Row[TABLE_MENU."_ID"];?>'); "><?php echo $Row[TABLE_MENU."_Status"];?></a></td>
		<td><?php echo $Row[TABLE_MENU."_Ordering"];?></td>
		<td style=" width:60px; padding: 0px; ">
		<div id="idActionBT<?php echo $Row[TABLE_MENU."_ID"];?>"
		style=" height: 30px; padding: 4px; width: 140px; position: absolute; margin-top: -14px; margin-left: -80px; text-align: right; display: none; ">
			<button type="button" class="btn btn-primary btn-flat"
			style=" font-size:10px; padding:2px; padding-left:10px; padding-right: 10px; "
			onclick=" showPopUpWindowEdit(<?php echo $Row[TABLE_MENU."_ID"];?>); "><i class="fa fa-pencil-square-o"></i> Edit</button>
			<button type="button" class="btn btn-danger btn-flat"
			style=" font-size:10px; padding:2px; padding-left:10px; padding-right: 10px; "
			onclick=" showPopUpWindowDelete(<?php echo $Row[TABLE_MENU."_ID"];?>); "><i class="fa fa-times"></i> Delete</button>
		</div>
		</td>
		</tr>
		<?php 
	}
}
############################################################################
if($doaction=="count") { 
	if($search=='') {
		$sql=" SELECT COUNT(*) FROM ".TABLE_MENU." WHERE ".TABLE_MENU."_Name<>'' AND ".TABLE_MENU."_Link<>'' AND ".TABLE_MENU."_Type='".$ModuleConfig_Type."' ";
	}else{		
		$sql=" SELECT COUNT(*) FROM ".TABLE_MENU." WHERE ".TABLE_MENU."_Name LIKE '%".$search."%' AND ".TABLE_MENU."_Name<>'' AND ".TABLE_MENU."_Link<>'' AND ".TABLE_MENU."_Type='".$ModuleConfig_Type."' ";
	}
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$Row = mysql_fetch_array($Query);
	echo $Row[0];
}
############################################################################
MYSQL_CLOSE();
?>