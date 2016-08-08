<?php 
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php }

## System Start ############################################################
include("../_config/config_system.php");
include_once(SYSTEM_DOC_ROOT."/system/core-start-ajax.php");
//if($SystemSession_Staff_ID>0 && $SystemSession_Staff_Level=="Admin") { } else { exit; } // LogIn Name Only
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
if($orderby=='') { $orderby=TABLE_CONTENT."_ID"; }
if($ascdesc=='') { $ascdesc='ASC'; }
############################################################################
if($myAjaxAction=="data-delete" && $myAjaxID>0) {
	$sql=" DELETE FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_ID='".$myAjaxID."' ";
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
	<h2>คุณต้องการลบ บทความนี้ แน่ใจหรือไม่?</h2>
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
if($doaction=="result") {
	//--------------------------------------------------------
	$myStaffName="";
	$sql1=" SELECT * FROM ".TABLE_STAFF." WHERE 1 ";
	$Query1=MYSQL_QUERY($sql1,$System_Connection1) OR DIE("Error: ".$sql1."<br>\n");
	while($Row1=mysql_fetch_array($Query1)) {
		$myStaffID=$Row1[TABLE_STAFF."_ID"];
		$myStaffName[$myStaffID]=$Row1[TABLE_STAFF."_Name"];
	}
	//--------------------------------------------------------
	if($search=='') {
		$sql=" SELECT * FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_Status='Publish' ";
	} else {
		$sql=" SELECT * FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_Status='Publish' AND ".TABLE_CONTENT."_Subject LIKE '%".$search."%' ";
	}
	$sql.=" ORDER BY ".$orderby." ".$ascdesc." LIMIT ".$recordstart.",".$recordsize." ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	while($Row = mysql_fetch_array($Query)) {
		?>
		<tr
		onclick=" $('#idActionBT<?php echo $Row[TABLE_CONTENT."_ID"];?>').show(); "
		onmouseover=" $('#idActionBT<?php echo $Row[TABLE_CONTENT."_ID"];?>').show(); "
		onmouseout=" $('#idActionBT<?php echo $Row[TABLE_CONTENT."_ID"];?>').hide(); "
		id="idTableRow<?php echo $Row[TABLE_CONTENT."_ID"];?>">
		<td><?php echo $Row[TABLE_CONTENT."_ID"];?></td>
		<td><a href="content.php?cid=<?php echo $Row[TABLE_CONTENT."_ID"];?>"><?php echo $Row[TABLE_CONTENT."_Subject"];?></a><br>By : <?php echo $myStaffName[$Row[TABLE_CONTENT."_CreateByStaffID"]];?></td>
		<td><?php echo $Row[TABLE_CONTENT."_Status"];?></td>
		<td><?php
		if($Row[TABLE_CONTENT."_Status"]=="Publish") {
			echo System_ShowDateTimeEasy($Row[TABLE_CONTENT."_OnlineDate"]);
		} else {
			echo "&nbsp;";
		}
		?></td>
		</tr>
		<?php 
	}
}
############################################################################
if($doaction=="count") {
	if($search=='') {
		$sql=" SELECT COUNT(*) FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_Status='Publish'  ";
	}else{
		$sql=" SELECT COUNT(*) FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_Status='Publish' AND ".TABLE_CONTENT."_Subject LIKE '%".$search."%' ";
	}
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$Row = mysql_fetch_array($Query);
	echo $Row[0];
}
############################################################################
MYSQL_CLOSE();
?>