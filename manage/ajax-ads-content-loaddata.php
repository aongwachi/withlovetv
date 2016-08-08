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
if($orderby=='') { $orderby=TABLE_ADS."_ID"; }
if($ascdesc=='') { $ascdesc='ASC'; }
############################################################################
if($myAjaxAction=="set-tags" && $myAjaxID>0) {
	$myselecttags=$myAjaxKey;
	// Load current tags ----------------------------------
	$sql=" SELECT * FROM ".TABLE_ADS." WHERE ".TABLE_ADS."_ID='".$myAjaxID."' LIMIT 0,1 ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$Row = mysql_fetch_array($Query);
	$mytags=$Row[TABLE_ADS."_Cat"];
	if($mytags=="") { $mytags=","; }
	if(strpos(" ".$mytags,",".$myselecttags.",")>0) { // exist , remove
		$tmptags=",";
		$arTmp=explode(",",$mytags);
		for($i=0;$i<=sizeof($arTmp);$i++) {
			if($arTmp[$i]<>"") {
				if($arTmp[$i]==$myselecttags) {
					// skip
				} else {
					$tmptags=$tmptags.$arTmp[$i].",";
				}
				
			}
		}
		$mytags=$tmptags;
		echo 'no';
	} else { // not exist , add
		$mytags=$mytags.$myselecttags.",";
		echo 'yes';
	}
	// Update tags ----------------------------------
	$sql=" UPDATE ".TABLE_ADS." SET ".TABLE_ADS."_Cat='".$mytags."' WHERE ".TABLE_ADS."_ID='".$myAjaxID."' ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	exit;
}
############################################################################
if($myAjaxAction=="data-delete" && $myAjaxID>0) {
	$sql=" DELETE FROM ".TABLE_ADS." WHERE ".TABLE_ADS."_ID='".$myAjaxID."' ";
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
	<h2>คุณต้องการลบ เท็มเพลตี้ แน่ใจหรือไม่?</h2>
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
	$sql=" SELECT * FROM ".TABLE_ADS." WHERE ".TABLE_ADS."_ID='".$myAjaxID."' LIMIT 0,1 ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$Row = mysql_fetch_array($Query);
	// ---------------------------------------
	$myID=$myAjaxID;
	$myTable=TABLE_ADS;
	$myKeyField=TABLE_ADS."_ID";
	?>
	<!-------------------------------------------------------------------------------->
	<div class="form-group width-100">
		<!--------------------------->
		<?php $myField=TABLE_ADS."_Name"; ?>
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
		<?php $myField=TABLE_ADS."_Code"; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">Code1</span>
		</label>
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 custom-text-position">
		<?php
		//--------------------------------------------
		$Config_UniqueID=$myField.$myID;
		$Config_DefaultValue=str_replace("[#[#]","<",str_replace("[#]#]",">",str_replace("[/script]","</script>",str_replace("[script]","<script>",$Row[$myField]))));
		$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
		//--------------------------------------------
		$Config_Width="100%";
		$Config_RowHeight=3;
		$Config_TextAlign="left";
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_textarea_code_save.php");
		?>
		</div>
		<!--------------------------->
		<?php $myField=TABLE_ADS."_Code2"; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">Code2</span>
		</label>
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 custom-text-position">
		<?php
		//--------------------------------------------
		$Config_UniqueID=$myField.$myID;
		$Config_DefaultValue=str_replace("[#[#]","<",str_replace("[#]#]",">",str_replace("[/script]","</script>",str_replace("[script]","<script>",$Row[$myField]))));
		$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
		//--------------------------------------------
		$Config_Width="100%";
		$Config_RowHeight=3;
		$Config_TextAlign="left";
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_textarea_code_save.php");
		?>
		</div>
		<!--------------------------->
		<?php $myField=TABLE_ADS."_Code3"; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">Code3</span>
		</label>
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 custom-text-position">
		<?php
		//--------------------------------------------
		$Config_UniqueID=$myField.$myID;
		$Config_DefaultValue=str_replace("[#[#]","<",str_replace("[#]#]",">",str_replace("[/script]","</script>",str_replace("[script]","<script>",$Row[$myField]))));
		$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
		//--------------------------------------------
		$Config_Width="100%";
		$Config_RowHeight=3;
		$Config_TextAlign="left";
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_textarea_code_save.php");
		?>
		</div>
		<!--------------------------->
		<?php $myField=TABLE_ADS."_Code4"; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">Code4</span>
		</label>
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 custom-text-position">
		<?php
		//--------------------------------------------
		$Config_UniqueID=$myField.$myID;
		$Config_DefaultValue=str_replace("[#[#]","<",str_replace("[#]#]",">",str_replace("[/script]","</script>",str_replace("[script]","<script>",$Row[$myField]))));
		$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
		//--------------------------------------------
		$Config_Width="100%";
		$Config_RowHeight=3;
		$Config_TextAlign="left";
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_textarea_code_save.php");
		?>
		</div>
		<!--------------------------->
		<?php $myField=TABLE_ADS."_Code5"; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">Code5</span>
		</label>
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 custom-text-position">
		<?php
		//--------------------------------------------
		$Config_UniqueID=$myField.$myID;
		$Config_DefaultValue=str_replace("[#[#]","<",str_replace("[#]#]",">",str_replace("[/script]","</script>",str_replace("[script]","<script>",$Row[$myField]))));
		$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
		//--------------------------------------------
		$Config_Width="100%";
		$Config_RowHeight=3;
		$Config_TextAlign="left";
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_textarea_code_save.php");
		?>
		</div>
		<?php if(0) { ?>
		<!--------------------------->
		<?php $myField=TABLE_ADS."_Cat"; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">Category</span>
		</label>
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 custom-text-position">
			<?php
			$myCategory=$Row[$myField];
			$sql1=" SELECT * FROM ".TABLE_CATEGORY." WHERE ".TABLE_CATEGORY."_Name<>'' ORDER BY ".TABLE_CATEGORY."_Ordering ASC ";
			$Query1=MYSQL_QUERY($sql1,$System_Connection1) OR DIE("Error: ".$sql1."<br>\n");
			while($Row1=mysql_fetch_array($Query1)) {
				?>
				<div class="pull-left border-radius-5 cursor <?php if(strpos(" ".$myCategory,",".$Row1[TABLE_CATEGORY."_ID"].",")>0) { echo ' tagsYes '; } else { echo ' tagsNo '; } ?>" id="idTag<?php echo $Row1[TABLE_CATEGORY."_ID"]; ?>" style=" padding-left:15px; padding-right:15px; " onclick="setTags('<?php echo $Row1[TABLE_CATEGORY."_ID"]; ?>','<?php echo $myAjaxID; ?>')">
				<?php echo $Row1[TABLE_CATEGORY."_Name"]; ?>
				</div>
				<?php
			}
			?>
		</div>
		<!--------------------------->
		<?php } ?>
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
	$sql = " UPDATE ".TABLE_ADS." SET ".$myAjaxKey."='".$myAjaxValue."' WHERE ".TABLE_ADS."_ID='".$myAjaxID."' ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	echo " <script> ";
	echo " window.parent.showSave('".$myAjaxID."','".$myAjaxKey."'); ";
	echo " </script> ";
}
############################################################################
if($task=="load-add") {
	// Check uncomplete ------------------
	$sql=" SELECT ".TABLE_ADS."_ID FROM ".TABLE_ADS." WHERE ".TABLE_ADS."_Name='' AND ".TABLE_ADS."_isInContent=1 LIMIT 0,1 ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$Row = mysql_fetch_array($Query);
	$myUnCompleteID=$Row[0];
	// ---------------------------------------
	if($myUnCompleteID>0) { } else{ // insert new 
		$sql=" SELECT MAX(".TABLE_ADS."_ID) FROM ".TABLE_ADS." WHERE 1 ";
		$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
		$Row = mysql_fetch_array($Query);
		$myUnCompleteID=$Row[0]+1;
		$sql=" INSERT INTO ".TABLE_ADS."(".TABLE_ADS."_ID,".TABLE_ADS."_Name,".TABLE_ADS."_Code,".TABLE_ADS."_Code2,".TABLE_ADS."_Code3,".TABLE_ADS."_Code4,".TABLE_ADS."_Code5,".TABLE_ADS."_isInContent) VALUES('".$myUnCompleteID."','','','','','','','1') ";
		$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	}
	// ---------------------------------------
	$sql=" SELECT * FROM ".TABLE_ADS." WHERE ".TABLE_ADS."_ID='".$myUnCompleteID."' LIMIT 0,1 ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$Row = mysql_fetch_array($Query);
	$myUnCompleteID=$Row[TABLE_ADS."_ID"];
	// ---------------------------------------
	$myID=$myUnCompleteID;
	$myTable=TABLE_ADS;
	$myKeyField=TABLE_ADS."_ID";
	?>
	<!-------------------------------------------------------------------------------->
	<div class="form-group width-100">
		<!--------------------------->
		<?php $myField=TABLE_ADS."_Name"; ?>
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
		$Config_MaxChar=200;
		$Config_Width="300px";
		$Config_TextAlign="left";
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_text.php");
		?>
		</div>
		<!--------------------------->
		<?php $myField=TABLE_ADS."_Code"; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">Code1</span>
		</label>
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 custom-text-position">
		<?php
		//--------------------------------------------
		$Config_UniqueID=$myField.$myID;
		$Config_DefaultValue=str_replace("[#[#]","<",str_replace("[#]#]","]",str_replace("[/script]","</script>",str_replace("[script]","<script>",$Row[$myField]))));
		$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
		//--------------------------------------------
		$Config_Width="100%";
		$Config_RowHeight=3;
		$Config_TextAlign="left";
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_textarea_code_save.php");
		?>
		</div>
		<!--------------------------->
		<?php $myField=TABLE_ADS."_Code2"; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">Code2</span>
		</label>
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 custom-text-position">
		<?php
		//--------------------------------------------
		$Config_UniqueID=$myField.$myID;
		$Config_DefaultValue=str_replace("[#[#]","<",str_replace("[#]#]","]",str_replace("[/script]","</script>",str_replace("[script]","<script>",$Row[$myField]))));
		$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
		//--------------------------------------------
		$Config_Width="100%";
		$Config_RowHeight=3;
		$Config_TextAlign="left";
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_textarea_code_save.php");
		?>
		</div>
		<!--------------------------->
		<?php $myField=TABLE_ADS."_Code3"; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">Code3</span>
		</label>
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 custom-text-position">
		<?php
		//--------------------------------------------
		$Config_UniqueID=$myField.$myID;
		$Config_DefaultValue=str_replace("[#[#]","<",str_replace("[#]#]","]",str_replace("[/script]","</script>",str_replace("[script]","<script>",$Row[$myField]))));
		$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
		//--------------------------------------------
		$Config_Width="100%";
		$Config_RowHeight=3;
		$Config_TextAlign="left";
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_textarea_code_save.php");
		?>
		</div>
		<!--------------------------->
		<?php $myField=TABLE_ADS."_Code4"; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">Code4</span>
		</label>
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 custom-text-position">
		<?php
		//--------------------------------------------
		$Config_UniqueID=$myField.$myID;
		$Config_DefaultValue=str_replace("[#[#]","<",str_replace("[#]#]","]",str_replace("[/script]","</script>",str_replace("[script]","<script>",$Row[$myField]))));
		$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
		//--------------------------------------------
		$Config_Width="100%";
		$Config_RowHeight=3;
		$Config_TextAlign="left";
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_textarea_code_save.php");
		?>
		</div>
		<!--------------------------->
		<?php $myField=TABLE_ADS."_Code5"; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">Code5</span>
		</label>
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 custom-text-position">
		<?php
		//--------------------------------------------
		$Config_UniqueID=$myField.$myID;
		$Config_DefaultValue=str_replace("[#[#]","<",str_replace("[#]#]","]",str_replace("[/script]","</script>",str_replace("[script]","<script>",$Row[$myField]))));
		$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
		//--------------------------------------------
		$Config_Width="100%";
		$Config_RowHeight=3;
		$Config_TextAlign="left";
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_textarea_code_save.php");
		?>
		</div>
		<!--------------------------->
		<?php if(0) { ?>
		<?php $myField=TABLE_ADS."_Cat"; ?>
		<label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label">
		<span class="label-main">Category</span>
		</label>
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 custom-text-position">
			<?php
			$myCategory=$Row[$myField];
			$sql1=" SELECT * FROM ".TABLE_CATEGORY." WHERE ".TABLE_CATEGORY."_Name<>'' ORDER BY ".TABLE_CATEGORY."_Ordering ASC ";
			$Query1=MYSQL_QUERY($sql1,$System_Connection1) OR DIE("Error: ".$sql1."<br>\n");
			while($Row1=mysql_fetch_array($Query1)) {
				?>
				<div class="pull-left border-radius-5 cursor <?php if(strpos(" ".$myCategory,",".$Row1[TABLE_CATEGORY."_ID"].",")>0) { echo ' tagsYes '; } else { echo ' tagsNo '; } ?>" id="idTag<?php echo $Row1[TABLE_CATEGORY."_ID"]; ?>" style=" padding-left:15px; padding-right:15px; " onclick="setTags('<?php echo $Row1[TABLE_CATEGORY."_ID"]; ?>')">
				<?php echo $Row1[TABLE_CATEGORY."_Name"]; ?>
				</div>
				<?php
			}
			?>
		</div>
		<!--------------------------->
		<?php } ?>
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
	//----------------------------------------------------------
	$sql1=" SELECT * FROM ".TABLE_CATEGORY." WHERE ".TABLE_CATEGORY."_Name<>'' ORDER BY ".TABLE_CATEGORY."_Ordering ASC ";
	$Query1=MYSQL_QUERY($sql1,$System_Connection1) OR DIE("Error: ".$sql1."<br>\n");
	while($Row1=mysql_fetch_array($Query1)) {
		$arCategoryNameByID[$Row1[TABLE_CATEGORY."_ID"]]=$Row1[TABLE_CATEGORY."_Name"];
	}
	//----------------------------------------------------------
	if($search=='') {
		$sql=" SELECT * FROM ".TABLE_ADS." WHERE ".TABLE_ADS."_Name<>'' AND ".TABLE_ADS."_isInContent=1 ";
	} else {
		$sql=" SELECT * FROM ".TABLE_ADS." WHERE ".TABLE_ADS."_Name LIKE '%".$search."%' AND ".TABLE_ADS."_Name<>'' AND ".TABLE_ADS."_isInContent=1 ";
	}
	$sql.=" ORDER BY ".$orderby." ".$ascdesc." LIMIT ".$recordstart.",".$recordsize." ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	while($Row = mysql_fetch_array($Query)) {
		?>
		<tr
		onclick=" $('#idActionBT<?php echo $Row[TABLE_ADS."_ID"];?>').show(); "
		onmouseover=" $('#idActionBT<?php echo $Row[TABLE_ADS."_ID"];?>').show(); "
		onmouseout=" $('#idActionBT<?php echo $Row[TABLE_ADS."_ID"];?>').hide(); "
		id="idTableRow<?php echo $Row[TABLE_ADS."_ID"];?>">
		<td><?php echo $Row[TABLE_ADS."_ID"];?></td>
		<td><?php echo $Row[TABLE_ADS."_Name"];?></td>
		<td>เฉพาะในบทความ</td>
		<?php if(0) { ?>
		<td><?php 
		$arCat=explode(",",$Row[TABLE_ADS."_Cat"]);
		for($x=0;$x<=sizeof($arCat);$x++) {
			if($arCat[$x]>0) {
				echo '<div class="pull-left padding-5 border-radius-5 tagsYes">&nbsp;&nbsp;'.$arCategoryNameByID[$arCat[$x]].'&nbsp;&nbsp;</div>';
			}
		}
		?></td>
		<?php } ?>
		<td style=" width:100px; padding: 0px; ">
		<div id="idActionBT<?php echo $Row[TABLE_ADS."_ID"];?>"
		style=" height: 30px; padding: 4px; width: 140px; position: absolute; margin-top: -14px; margin-left: -50px; text-align: right; display: none; ">
			<button type="button" class="btn btn-primary btn-flat"
			style=" font-size:10px; padding:2px; padding-left:10px; padding-right: 10px; "
			onclick=" showPopUpWindowEdit(<?php echo $Row[TABLE_ADS."_ID"];?>); "><i class="fa fa-pencil-square-o"></i> Edit</button>
			<button type="button" class="btn btn-danger btn-flat"
			style=" font-size:10px; padding:2px; padding-left:10px; padding-right: 10px; "
			onclick=" showPopUpWindowDelete(<?php echo $Row[TABLE_ADS."_ID"];?>); "><i class="fa fa-times"></i> Delete</button>
		</div>
		</td>
		</tr>
		<?php 
	}
}
############################################################################
if($doaction=="count") {
	if($search=='') {
		$sql=" SELECT COUNT(*) FROM ".TABLE_ADS." WHERE ".TABLE_ADS."_Name<>''AND ".TABLE_ADS."_isInContent=1 ";
	}else{
		$sql=" SELECT COUNT(*) FROM ".TABLE_ADS." WHERE ".TABLE_ADS."_Name LIKE '%".$search."%' AND ".TABLE_ADS."_Name<>''AND ".TABLE_ADS."_isInContent=1 ";
	}
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$Row = mysql_fetch_array($Query);
	echo $Row[0];
}
############################################################################
MYSQL_CLOSE();
?>