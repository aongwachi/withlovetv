<?php 
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php }

## System Start ############################################################
include("../_config/config_system.php");
include_once(SYSTEM_DOC_ROOT."/system/core-start-ajax.php");
if($SystemSession_Staff_ID>0 && $SystemSession_Staff_Level=="Admin") { } else { exit; } // LogIn Name Only
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
if($orderby=='') { $orderby=TABLE_TAGS."_ID"; }
if($ascdesc=='') { $ascdesc='ASC'; }
############################################################################
if($myAjaxAction=="data-delete" && $myAjaxID>0) {
	$sql=" DELETE FROM ".TABLE_TAGS." WHERE ".TABLE_TAGS."_ID='".$myAjaxID."' ";
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
	<h2>คุณต้องการลบ แท็กนี้ แน่ใจหรือไม่?</h2>
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
	$sql=" SELECT * FROM ".TABLE_TAGS." WHERE ".TABLE_TAGS."_ID='".$myAjaxID."' LIMIT 0,1 ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$Row = mysql_fetch_array($Query);
	// ---------------------------------------
	$myID=$myAjaxID;
	$myTable=TABLE_TAGS;
	$myKeyField=TABLE_TAGS."_ID";
	?>
	<!-------------------------------------------------------------------------------->
	<div class="form-group width-100">
		<!--------------------------->
		<?php $myField=TABLE_TAGS."_Name"; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">Tags Name</span>
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
	$sql = " UPDATE ".TABLE_TAGS." SET ".$myAjaxKey."='".$myAjaxValue."' WHERE ".TABLE_TAGS."_ID='".$myAjaxID."' ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	echo " <script> ";
	echo " window.parent.showSave('".$myAjaxID."','".$myAjaxKey."'); ";
	echo " </script> ";
}
############################################################################
if($task=="load-add") {
	// Check uncomplete ------------------
	$sql=" SELECT ".TABLE_TAGS."_ID FROM ".TABLE_TAGS." WHERE ".TABLE_TAGS."_Name='' LIMIT 0,1 ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$Row = mysql_fetch_array($Query);
	$myUnCompleteID=$Row[0];
	// ---------------------------------------
	if($myUnCompleteID>0) { } else{ // insert new 
		$sql=" SELECT MAX(".TABLE_TAGS."_ID) FROM ".TABLE_TAGS." WHERE 1 ";
		$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
		$Row = mysql_fetch_array($Query);
		$myUnCompleteID=$Row[0]+1;
		$sql=" INSERT INTO ".TABLE_TAGS."(".TABLE_TAGS."_ID,".TABLE_TAGS."_Name) VALUES('".$myUnCompleteID."','') ";
		$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	}
	// ---------------------------------------
	$sql=" SELECT * FROM ".TABLE_TAGS." WHERE ".TABLE_TAGS."_ID='".$myUnCompleteID."' LIMIT 0,1 ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$Row = mysql_fetch_array($Query);
	$myUnCompleteID=$Row[TABLE_TAGS."_ID"];
	// ---------------------------------------
	$myID=$myUnCompleteID;
	$myTable=TABLE_TAGS;
	$myKeyField=TABLE_TAGS."_ID";
	?>
	<!-------------------------------------------------------------------------------->
	<div class="form-group width-100">
		<!--------------------------->
		<?php $myField=TABLE_TAGS."_Name"; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">Tags Name</span>
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
		$sql=" SELECT * FROM ".TABLE_TAGS." WHERE ".TABLE_TAGS."_Name<>'' ";
	} else {
		$sql=" SELECT * FROM ".TABLE_TAGS." WHERE ".TABLE_TAGS."_Name LIKE '%".$search."%' AND ".TABLE_TAGS."_Name<>'' ";
	}
	$sql.=" ORDER BY ".$orderby." ".$ascdesc." LIMIT ".$recordstart.",".$recordsize." ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	while($Row = mysql_fetch_array($Query)) {
		?>
		<tr
		onclick=" $('#idActionBT<?php echo $Row[TABLE_TAGS."_ID"];?>').show(); "
		onmouseover=" $('#idActionBT<?php echo $Row[TABLE_TAGS."_ID"];?>').show(); "
		onmouseout=" $('#idActionBT<?php echo $Row[TABLE_TAGS."_ID"];?>').hide(); "
		id="idTableRow<?php echo $Row[TABLE_TAGS."_ID"];?>">
		<td><?php echo $Row[TABLE_TAGS."_ID"];?></td>
		<td><?php echo $Row[TABLE_TAGS."_Name"];?></td>
		<td><?php echo $Row[TABLE_TAGS."_NoOfUse"];?></td>
		<td style=" width:60px; padding: 0px; ">
		<div id="idActionBT<?php echo $Row[TABLE_TAGS."_ID"];?>"
		style=" height: 30px; padding: 4px; width: 140px; position: absolute; margin-top: -14px; margin-left: -80px; text-align: right; display: none; ">
			<button type="button" class="btn btn-primary btn-flat"
			style=" font-size:10px; padding:2px; padding-left:10px; padding-right: 10px; "
			onclick=" showPopUpWindowEdit(<?php echo $Row[TABLE_TAGS."_ID"];?>); "><i class="fa fa-pencil-square-o"></i> Edit</button>
			<button type="button" class="btn btn-danger btn-flat"
			style=" font-size:10px; padding:2px; padding-left:10px; padding-right: 10px; "
			onclick=" showPopUpWindowDelete(<?php echo $Row[TABLE_TAGS."_ID"];?>); "><i class="fa fa-times"></i> Delete</button>
		</div>
		</td>
		</tr>
		<?php 
	}
}
############################################################################
if($doaction=="count") {
	if($search=='') {
		$sql=" SELECT COUNT(*) FROM ".TABLE_TAGS." WHERE ".TABLE_TAGS."_Name<>'' ";
	}else{
		$sql=" SELECT COUNT(*) FROM ".TABLE_TAGS." WHERE ".TABLE_TAGS."_Name LIKE '%".$search."%' AND ".TABLE_TAGS."_Name<>'' ";
	}
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$Row = mysql_fetch_array($Query);
	echo $Row[0];
}
############################################################################
MYSQL_CLOSE();
?>