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
if($orderby=='') { $orderby=TABLE_THEME."_ID"; }
if($ascdesc=='') { $ascdesc='ASC'; }
############################################################################
if($myAjaxAction=="data-change" && $myAjaxID>0) {
	$sql=" UPDATE ".TABLE_THEME." SET ".TABLE_THEME."_Selected='0' WHERE 1 ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$sql=" UPDATE ".TABLE_THEME." SET ".TABLE_THEME."_Selected='1' WHERE ".TABLE_THEME."_ID='".$myAjaxID."' ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	echo " <script> ";
	echo " window.parent.doRefresh(); ";
	echo " </script> ";
}
############################################################################
if($task=="load-edit" && $myAjaxID>0) {
	?>
	<div class="text-center">
	<br>
	<h2>คุณต้องการเปลี่ยนเป็น Theme นี้ แน่ใจหรือไม่?</h2>
	<br>
	<div class="form-group">
	<div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-5 col-md-offset-1 col-lg-4 col-lg-offset-2 padding-2">
	<button type="submit" name="inputSubmit" class="btn btn-info btn-block btn-flat" style="height:50px;" onclick=" dialogPopWindow.close(); ">
	<span class="glyphicon glyphicon-ban-circle"></span> ยกเลิก </button>
	</div>
	<div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-5 col-md-offset-0 col-lg-4 col-lg-offset-0 padding-2">
	<button type="button" name="inputCancel" class="btn btn-success btn-block btn-flat" style="height:50px;" onClick=" doChangeTheme('<?php echo $myAjaxID; ?>'); ">
	<span class="glyphicon glyphicon-ok"></span> ใช่ </button>
	</div></div><br></div>
	<?php
}
############################################################################
if($myAjaxAction=="data-update") {
	$sql = " UPDATE ".TABLE_THEME." SET ".$myAjaxKey."='".$myAjaxValue."' WHERE ".TABLE_THEME."_ID='".$myAjaxID."' ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	echo " <script> ";
	echo " window.parent.showSave('".$myAjaxID."','".$myAjaxKey."'); ";
	echo " </script> ";
}
############################################################################
if($doaction=="result") {
	if($search=='') {
		$sql=" SELECT * FROM ".TABLE_THEME." WHERE ".TABLE_THEME."_Key<>'' ";
	} else {
		$sql=" SELECT * FROM ".TABLE_THEME." WHERE ".TABLE_THEME."_Key LIKE '%".$search."%' AND ".TABLE_THEME."_Key<>'' ";
	}
	$sql.=" ORDER BY ".$orderby." ".$ascdesc." LIMIT ".$recordstart.",".$recordsize." ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	while($Row = mysql_fetch_array($Query)) {
		?>
		<tr
		onclick=" $('#idActionBT<?php echo $Row[TABLE_THEME."_ID"];?>').show(); "
		onmouseover=" $('#idActionBT<?php echo $Row[TABLE_THEME."_ID"];?>').show(); "
		onmouseout=" $('#idActionBT<?php echo $Row[TABLE_THEME."_ID"];?>').hide(); "
		id="idTableRow<?php echo $Row[TABLE_THEME."_ID"];?>">
		<td><?php echo $Row[TABLE_THEME."_ID"];?></td>
		<td>Theme<?php echo $Row[TABLE_THEME."_Key"];?></td>
		<td><?php
		if($Row[TABLE_THEME."_Selected"]==1) {
			echo '<font color="#00AA00"><b>Use</b></font>';
		} else {
			echo '<font color="#999999"><b>Not Use</b></font>';
		}
		?></td>
		<td style=" width:60px; padding: 0px; ">
		<div id="idActionBT<?php echo $Row[TABLE_THEME."_ID"];?>"
		style=" height: 30px; padding: 4px; width: 140px; position: absolute; margin-top: -14px; margin-left: -80px; text-align: right; display: none; ">
			<button type="button" class="btn btn-primary btn-flat"
			style=" font-size:10px; padding:2px; padding-left:10px; padding-right: 10px; "
			onclick=" showPopUpWindowEdit(<?php echo $Row[TABLE_THEME."_ID"];?>); "><i class="fa fa-pencil-square-o"></i> Change</button>
		</div>
		</td>
		</tr>
		<?php 
	}
}
############################################################################
if($doaction=="count") {
	if($search=='') {
		$sql=" SELECT COUNT(*) FROM ".TABLE_THEME." WHERE ".TABLE_THEME."_Key<>'' ";
	}else{
		$sql=" SELECT COUNT(*) FROM ".TABLE_THEME." WHERE ".TABLE_THEME."_Key LIKE '%".$search."%' AND ".TABLE_THEME."_Key<>'' ";
	}
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$Row = mysql_fetch_array($Query);
	echo $Row[0];
}
############################################################################
MYSQL_CLOSE();
?>