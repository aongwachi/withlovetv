<?php  if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } 
$System_LayoutUse="layout_manage.html";
$System_AjaxFileAction="ajax-staff-edit-loaddata.php";
$System_ShowAjaxIFrame=0;
include_once("../_config/config_system.php");
include_once(SYSTEM_DOC_ROOT."system/core-start.php");
include_once(SYSTEM_DOC_ROOT."system/core-body.php");
if($SystemSession_Staff_ID>0) {
    $myID=$SystemSession_Staff_ID;
    $myTable=TABLE_STAFF;
    $myKeyField=TABLE_STAFF."_ID";
    //---------------------------------------------
    $sql=" SELECT * FROM ".TABLE_STAFF." WHERE ".TABLE_STAFF."_ID='".$SystemSession_Staff_ID."' LIMIT 0,1 ";
    $Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
    $Row=mysql_fetch_array($Query);
    //---------------------------------------------
    ?>
    <!---###############################################################################--->
    <script type="text/javascript" src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/js-fileinput/fileinput.js"></script>
    <link rel="stylesheet" href="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/js-fileinput/fileinput.css">
    <link  rel="stylesheet" href="croppic/croppic.css">
    <script type="text/javascript" src="croppic/jquery.mousewheel.min.js"></script>
    <script type="text/javascript" src="croppic/croppic.min.js"></script>
    <script src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/jcrop/js/jquery.Jcrop.js"></script>
    <link rel="stylesheet" href="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/jcrop/css/jquery.Jcrop.css" type="text/css" />
    <!---###############################################################################--->
    <div class="row width-100 padding-10" style=" padding-left:20px; padding-top:0px; ">
    <div class="hidden-xs hidden-sm col-md-2 col-lg-2 padding-2"></div>
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 padding-2 text-center">
	<!---###############################################################################--->
	<br>
	    <h1>Change User Profile : <font color="#AA0000"><?php echo $SystemSession_Staff_User; ?></font></h1>
	<br>
	<!---###############################################################################--->
	<div class="form-group width-100">
	    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left" style=" padding-left:0px; ">
	    <b>ชื่อ : </b>
	    </div>
	    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left" style=" padding-left:0px; ">
	    <?php
	    $myField=TABLE_STAFF."_Name";
	    //--------------------------------------------
	    $Config_UniqueID=$myField.$myID;
	    $Config_DefaultValue=htmlentities($Row[$myField]);
	    $Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
	    //--------------------------------------------
	    $Config_MaxChar=50;
	    $Config_Width="100%";
	    $Config_TextAlign="left";
	    $Config_PlaceHolder="ชื่อที่แสดงในหน้าเว็บ";
	    //--------------------------------------------
	    include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_text.php");
	    ?>
	    </div>
	</div>
	<!---###############################################################################--->
	<div class="form-group width-100">
	    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left" style=" padding-left:0px; ">
	    <b>เปลี่ยนรหัสผ่าน : </b>
	    </div>
	    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left" style=" padding-left:0px; ">
	    <?php
	    $myField=TABLE_STAFF."_Pass";
	    //--------------------------------------------
	    $Config_UniqueID=$myField.$myID;
	    $Config_DefaultValue=htmlentities($Row[$myField]);
	    $Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
	    //--------------------------------------------
	    $Config_MaxChar=50;
	    $Config_Width="100%";
	    $Config_TextAlign="left";
	    $Config_PlaceHolder="";
	    //--------------------------------------------
	    include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_text.php");
	    ?>
	    </div>
	</div>
	<!---###############################################################################--->
	    <?php
	    $Config_CropWidth=200;
	    $Config_CropHeight=200;
	    ?><br><br>
	    <div class="form-group width-100" style=" padding-left:0px; ">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left" style=" padding-left:0px; ">
		<b>ภาพแทนตัว : </b> กำหนดให้ใช้ขนาด <?php echo $Config_CropWidth; ?>x<?php echo $Config_CropHeight; ?> pixel
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center" style=" padding-left:20px; padding-top:20px; ">
		<?php
		$myField=TABLE_STAFF."_Picture";
		$myIDs=sprintf('%04d',$myID);
		//--------------------------------------------
		$myFolder1=substr($myIDs,strlen($myIDs)-4,2);
		$myFolder2=substr($myIDs,strlen($myIDs)-2,2);
		//--------------------------------------------
		$Config_FolderKey='staff';
		$Config_UniqueID=$myField.$myID.$Config_FolderKey;
		$Config_DefaultValue=$Row[$myField];
		$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
		$Config_Path="../upload/".$Config_FolderKey."/";
                if(!file_exists($Config_Path)){ mkdir($Config_Path); chmod($Config_Path,0777); }
		$Config_Path="../upload/".$Config_FolderKey."/".$myFolder1."/";
                if(!file_exists($Config_Path)){ mkdir($Config_Path); chmod($Config_Path,0777); }
		$Config_Path="../upload/".$Config_FolderKey."/".$myFolder1."/".$myFolder2."/";
                if(!file_exists($Config_Path)){ mkdir($Config_Path); chmod($Config_Path,0777); }
		$Config_FileTypeAllow=" 'jpg', 'png','gif' ";
		$Config_MaxFileSizeKB=2*1000;
		$Config_Return="staff-edit.php?id=";
		$Config_DefaultPath=$Config_Path;
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_onephoto2.php");
		//--------------------------------------------
		?>
		</div>
		<!-------------------------------------------------------->
	    </div>
	<!---###############################################################################--->
    </div>
    <div class="hidden-xs hidden-sm col-md-2 col-lg-2 padding-2"></div>
    </div>
<script>
//----------------------------------------
function doRefresh() {
//----------------------------------------
    $('#myRefreshForm').submit();
}
</script>
<form name="myRefreshForm" id="myRefreshForm" method="get" action="staff-edit.php">
<input type="hidden" name="cid" id="cid" value="<?php echo $myID; ?>" >
</form>
    <?php
    //----------------------------------------------------------------------------------------------------------------
    include_once(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_loader.php");
    include_once(SYSTEM_DOC_ROOT."system/core-end.php");
} else {
    $myObjectRedirectFormLink=SYSTEM_WEBPATH_ROOT."/manage/index.php";
    include_once(SYSTEM_DOC_ROOT."object/obj_redirect.php");
}
?>