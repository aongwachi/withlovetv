<?php  if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } 
$System_LayoutUse="layout_dms.html";
include_once("../_config/config_system.php");
include_once(SYSTEM_DOC_ROOT."system/core-start-ajax.php");
if($SystemSession_Member_ID>0) {
	include_once(SYSTEM_DOC_ROOT."system/core-start.php");
	include_once(SYSTEM_DOC_ROOT."system/core-body.php");
	######################################################################
	$arTable="";
	$sql = "SHOW TABLES FROM ".SYSTEM_DB_NAME;
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	while($Row = mysql_fetch_array($Query)) {
		if(substr($Row[0],0,strlen(SYSTEM_DB_PREFIX))<>SYSTEM_DB_PREFIX) {
			$arTable[]=$Row[0];
		}
	}
	######################################################################
	$sql = "SELECT * FROM ".DMS_TABLE_CONFIG_SYSTEM." WHERE 1 ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	while($Row = mysql_fetch_array($Query)) {
		$arTableName[$Row[DMS_TABLE_CONFIG_SYSTEM."_Table"]]=$Row[DMS_TABLE_CONFIG_SYSTEM."_Name"];
	}
	######################################################################
	?>
	<div class=" padding-10 "><h1>Show All Table</h1></div>
	<div class="row-fluid width-100 padding-10">
	<?php for($x=0;$x<sizeof($arTable);$x++) { ?>
		<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 padding-5" style=" height:70px;">
		<div class="box-sky" style=" overflow: hidden; ">
			<a href="<?php echo SYSTEM_WEBPATH_ROOT; ?>/dms/index.php?table=<?php echo $arTable[$x]; ?>" target="_blank">
			<?php echo strtolower($arTable[$x]); ?><br>
			<?php echo $arTableName[$arTable[$x]]; ?>
			</a>
		</div>
		</div>
	<?php } ?>
	</div>
	<?php
	######################################################################
	include_once(SYSTEM_DOC_ROOT."system/core-end.php");
} else {
	$myObjectRedirectFormLink=SYSTEM_WEBPATH_ROOT."/index.php";
	include_once(SYSTEM_DOC_ROOT."object/obj_redirect.php");
}
?>