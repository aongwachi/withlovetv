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
if($orderby=='') { $orderby=TABLE_CATEGORY."_ID"; }
if($ascdesc=='') { $ascdesc='ASC'; }
############################################################################
if($myAjaxAction=="data-delete" && $myAjaxID>0) {
	$sql=" DELETE FROM ".TABLE_CATEGORY." WHERE ".TABLE_CATEGORY."_ID='".$myAjaxID."' ";
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
	<h2>คุณต้องการลบ หมวดหมู่นี้ แน่ใจหรือไม่?</h2>
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
	$sql=" SELECT * FROM ".TABLE_CATEGORY." WHERE ".TABLE_CATEGORY."_ID='".$myAjaxID."' LIMIT 0,1 ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$Row = mysql_fetch_array($Query);
	// ---------------------------------------
	$myID=$myAjaxID;
	$myTable=TABLE_CATEGORY;
	$myKeyField=TABLE_CATEGORY."_ID";
	?>
	<!-------------------------------------------------------------------------------->
	<div class="form-group width-100">
		<!--------------------------->
		<?php $myField=TABLE_CATEGORY."_Name"; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">Category Name</span>
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
		<?php $myField=TABLE_CATEGORY."_Folder"; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">Folder</span>
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
		<?php $myField=TABLE_CATEGORY."_Title"; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">Title</span>
		</label>
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 custom-text-position">
		<?php
		//--------------------------------------------
		$Config_UniqueID=$myField.$myID;
		$Config_DefaultValue=$Row[$myField];
		$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
		//--------------------------------------------
		$Config_MaxChar=200;
		$Config_Width="300px";
		$Config_TextAlign="left";
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_text.php");
		?>
		</div>	
		<!--------------------------->
		<?php $myField=TABLE_CATEGORY."_Keyword"; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">Keyword</span>
		</label>
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 custom-text-position">
		<?php
		//--------------------------------------------
		$Config_UniqueID=$myField.$myID;
		$Config_DefaultValue=$Row[$myField];
		$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
		//--------------------------------------------
		$Config_MaxChar=200;
		$Config_Width="300px";
		$Config_TextAlign="left";
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_text.php");
		?>
		</div>	
		<!--------------------------->
		<?php $myField=TABLE_CATEGORY."_Description"; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">Description</span>
		</label>
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 custom-text-position">
		<?php
		//--------------------------------------------
		$Config_UniqueID=$myField.$myID;
		$Config_DefaultValue=$Row[$myField];
		$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
		//--------------------------------------------
		$Config_MaxChar=500;
		$Config_Width="100%";
		$Config_RowHeight=3;
		$Config_TextAlign="left";
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_text.php");
		?>
		</div>			
		<!--------------------------->
		<?php $myField=TABLE_CATEGORY."_Ordering"; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">Menu Order</span>
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
		<?php $myField=TABLE_CATEGORY."_Hotnews"; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">Page Order</span>
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
		<label class="col-xs-6 col-sm-4 col-md-4 col-lg-4 control-label">
		    <span class="label-main">แสดงในเมนูหลัก</span>
		</label>
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 custom-text-position">
		<?php
		$myField=TABLE_CATEGORY."_isMainMenu"; 
		$Config_UniqueID=$myField.$myID;
		$Config_DefaultValue=$Row[$myField];
		$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
		//--------------------------------------------
		$Config_Array_YesNo_Text=array("ON","OFF"); // yes , no
		$Config_Array_YesNo_Value=array("1","0"); // yes , no
		//--------------------------------------------
		$Config_Array_YesNo_Class=array('success','danger'); // yes , no
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_onoff.php");
		?>
		</div>
		<!--------------------------->
		<label class="col-xs-6 col-sm-4 col-md-4 col-lg-4 control-label">
		    <span class="label-main">แสดงในหน้าแรก</span>
		</label>
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 custom-text-position">
		<?php
		$myField=TABLE_CATEGORY."_isHotBox"; 
		$Config_UniqueID=$myField.$myID;
		$Config_DefaultValue=$Row[$myField];
		$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
		//--------------------------------------------
		$Config_Array_YesNo_Text=array("ON","OFF"); // yes , no
		$Config_Array_YesNo_Value=array("1","0"); // yes , no
		//--------------------------------------------
		$Config_Array_YesNo_Class=array('success','danger'); // yes , no
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_onoff.php");
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
	$sql = " UPDATE ".TABLE_CATEGORY." SET ".$myAjaxKey."='".$myAjaxValue."' WHERE ".TABLE_CATEGORY."_ID='".$myAjaxID."' ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	echo " <script> ";
	echo " window.parent.showSave('".$myAjaxID."','".$myAjaxKey."'); ";
	echo " </script> ";
}
############################################################################
if($task=="load-add") {
	// Check uncomplete ------------------
	$sql=" SELECT ".TABLE_CATEGORY."_ID FROM ".TABLE_CATEGORY." WHERE ".TABLE_CATEGORY."_Name='' LIMIT 0,1 ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$Row = mysql_fetch_array($Query);
	$myUnCompleteID=$Row[0];
	// ---------------------------------------
	if($myUnCompleteID>0) { } else{ // insert new 
		$sql=" SELECT MAX(".TABLE_CATEGORY."_ID) FROM ".TABLE_CATEGORY." WHERE 1 ";
		$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
		$Row = mysql_fetch_array($Query);
		$myUnCompleteID=$Row[0]+1;
		$sql=" INSERT INTO ".TABLE_CATEGORY."(".TABLE_CATEGORY."_ID,".TABLE_CATEGORY."_Name) VALUES('".$myUnCompleteID."','') ";
		$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	}
	// ---------------------------------------
	$sql=" SELECT * FROM ".TABLE_CATEGORY." WHERE ".TABLE_CATEGORY."_ID='".$myUnCompleteID."' LIMIT 0,1 ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$Row = mysql_fetch_array($Query);
	$myUnCompleteID=$Row[TABLE_CATEGORY."_ID"];
	// ---------------------------------------
	$myID=$myUnCompleteID;
	$myTable=TABLE_CATEGORY;
	$myKeyField=TABLE_CATEGORY."_ID";
	?>
	<!-------------------------------------------------------------------------------->
	<div class="form-group width-100">
		<!--------------------------->
		<?php $myField=TABLE_CATEGORY."_Name"; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">Category Name</span>
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
		<?php $myField=TABLE_CATEGORY."_Folder"; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">Folder</span>
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
		<?php $myField=TABLE_CATEGORY."_Title"; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">Title</span>
		</label>
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 custom-text-position">
		<?php
		//--------------------------------------------
		$Config_UniqueID=$myField.$myID;
		$Config_DefaultValue=$Row[$myField];
		$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
		//--------------------------------------------
		$Config_MaxChar=200;
		$Config_Width="300px";
		$Config_TextAlign="left";
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_text.php");
		?>
		</div>	
		<!--------------------------->
		<?php $myField=TABLE_CATEGORY."_Keyword"; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">Keyword</span>
		</label>
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 custom-text-position">
		<?php
		//--------------------------------------------
		$Config_UniqueID=$myField.$myID;
		$Config_DefaultValue=$Row[$myField];
		$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
		//--------------------------------------------
		$Config_MaxChar=200;
		$Config_Width="300px";
		$Config_TextAlign="left";
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_text.php");
		?>
		</div>	
		<!--------------------------->
		<?php $myField=TABLE_CATEGORY."_Description"; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">Description</span>
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
		<?php $myField=TABLE_CATEGORY."_Ordering"; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">Menu Order</span>
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
		<?php $myField=TABLE_CATEGORY."_Hotnews"; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">Page Order</span>
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
		<label class="col-xs-6 col-sm-4 col-md-4 col-lg-4 control-label">
		    <span class="label-main">แสดงในเมนูหลัก</span>
		</label>
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 custom-text-position">
		<?php
		$myField=TABLE_CATEGORY."_isMainMenu"; 
		$Config_UniqueID=$myField.$myID;
		$Config_DefaultValue=$Row[$myField];
		$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
		//--------------------------------------------
		$Config_Array_YesNo_Text=array("ON","OFF"); // yes , no
		$Config_Array_YesNo_Value=array("1","0"); // yes , no
		//--------------------------------------------
		$Config_Array_YesNo_Class=array('success','danger'); // yes , no
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_onoff.php");
		?>
		</div>
		<!--------------------------->
		<label class="col-xs-6 col-sm-4 col-md-4 col-lg-4 control-label">
		    <span class="label-main">แสดงในหน้าแรก</span>
		</label>
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 custom-text-position">
		<?php
		$myField=TABLE_CATEGORY."_isHotBox"; 
		$Config_UniqueID=$myField.$myID;
		$Config_DefaultValue=$Row[$myField];
		$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
		//--------------------------------------------
		$Config_Array_YesNo_Text=array("ON","OFF"); // yes , no
		$Config_Array_YesNo_Value=array("1","0"); // yes , no
		//--------------------------------------------
		$Config_Array_YesNo_Class=array('success','danger'); // yes , no
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_onoff.php");
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
		$sql=" SELECT * FROM ".TABLE_CATEGORY." WHERE ".TABLE_CATEGORY."_Name<>'' AND ".TABLE_CATEGORY."_Folder<>'' ";
	} else {
		$sql=" SELECT * FROM ".TABLE_CATEGORY." WHERE ".TABLE_CATEGORY."_Name LIKE '%".$search."%' AND ".TABLE_CATEGORY."_Name<>'' AND ".TABLE_CATEGORY."_Folder<>'' ";
	}
	$sql.=" ORDER BY ".$orderby." ".$ascdesc." LIMIT ".$recordstart.",".$recordsize." ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	while($Row = mysql_fetch_array($Query)) {
		?>
		<tr
		onclick=" $('#idActionBT<?php echo $Row[TABLE_CATEGORY."_ID"];?>').show(); "
		onmouseover=" $('#idActionBT<?php echo $Row[TABLE_CATEGORY."_ID"];?>').show(); "
		onmouseout=" $('#idActionBT<?php echo $Row[TABLE_CATEGORY."_ID"];?>').hide(); "
		id="idTableRow<?php echo $Row[TABLE_CATEGORY."_ID"];?>">
		<td><?php echo $Row[TABLE_CATEGORY."_ID"];?></td>
		<td><?php echo $Row[TABLE_CATEGORY."_Name"];?></td>
		<td><?php echo $Row[TABLE_CATEGORY."_Folder"];?></td>
		<td><?php if($Row[TABLE_CATEGORY."_isMainMenu"]==1) { echo "<font color=#00AA00><b>Yes</b></font>"; } else { echo "<font color=red><b>No</b></font>"; } ?></td>
		<td><?php echo $Row[TABLE_CATEGORY."_Ordering"];?></td>
		<td><?php if($Row[TABLE_CATEGORY."_isHotBox"]==1) { echo "<font color=#00AA00><b>Yes</b></font>"; } else { echo "<font color=red><b>No</b></font>"; } ?></td>
		<td><?php echo $Row[TABLE_CATEGORY."_Hotnews"];?></td>
		<td>
			<b><?php echo $Row[TABLE_CATEGORY."_Title"];?></b><br>
			<?php if($Row[TABLE_CATEGORY."_Keyword"]!=""){ echo "[".$Row[TABLE_CATEGORY."_Keyword"]."]"; } ?><br>
			<?php if($Row[TABLE_CATEGORY."_Description"]!=""){ echo "[".$Row[TABLE_CATEGORY."_Description"]."]"; } ?>
		</td>
		<td style=" width:60px; padding: 0px; ">
		<div id="idActionBT<?php echo $Row[TABLE_CATEGORY."_ID"];?>"
		style=" height: 30px; padding: 4px; width: 140px; position: absolute; margin-top: -14px; margin-left: -80px; text-align: right; display: none; ">
			<button type="button" class="btn btn-primary btn-flat"
			style=" font-size:10px; padding:2px; padding-left:10px; padding-right: 10px; "
			onclick=" showPopUpWindowEdit(<?php echo $Row[TABLE_CATEGORY."_ID"];?>); "><i class="fa fa-pencil-square-o"></i> Edit</button>
			<button type="button" class="btn btn-danger btn-flat"
			style=" font-size:10px; padding:2px; padding-left:10px; padding-right: 10px; "
			onclick=" showPopUpWindowDelete(<?php echo $Row[TABLE_CATEGORY."_ID"];?>); "><i class="fa fa-times"></i> Delete</button>
		</div>
		</td>
		</tr>
		<?php 
	}
}
############################################################################
if($doaction=="count") {
	if($search=='') {
		$sql=" SELECT COUNT(*) FROM ".TABLE_CATEGORY." WHERE ".TABLE_CATEGORY."_Name<>'' AND ".TABLE_CATEGORY."_Folder<>'' ";
	}else{
		$sql=" SELECT COUNT(*) FROM ".TABLE_CATEGORY." WHERE ".TABLE_CATEGORY."_Name LIKE '%".$search."%' AND ".TABLE_CATEGORY."_Name<>'' AND ".TABLE_CATEGORY."_Folder<>'' ";
	}
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$Row = mysql_fetch_array($Query);
	echo $Row[0];
}
############################################################################
MYSQL_CLOSE();
?>