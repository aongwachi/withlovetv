<?php  if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } 
$System_LayoutUse="layout_manage.html";
$System_AjaxFileAction="ajax-content-loaddata.php";
$System_ShowAjaxIFrame=0;
$act=trim($_REQUEST['act']);
$cid=trim($_REQUEST['cid']);
$tid=trim($_REQUEST['tid']);
$test=trim($_REQUEST['test']);
include_once("../_config/config_system.php");
include_once(SYSTEM_DOC_ROOT."system/core-start.php");
include_once(SYSTEM_DOC_ROOT."system/core-body.php");
if($SystemSession_Staff_ID>0) { 
    if($act=="" && $cid=="" && $tid=="") { $act="addnew"; }
    //----------------------------------------------------------------------------------------------------------------
    $index=0; $myFirstLayout="";
    $sql1=" SELECT * FROM ".TABLE_CONTENT_TEMPLATES." WHERE ".TABLE_CONTENT_TEMPLATES."_Name<>'' ORDER BY ".TABLE_CONTENT_TEMPLATES."_Name ASC ";
    $Query1=MYSQL_QUERY($sql1,$System_Connection1) OR DIE("Error: ".$sql1."<br>\n");
    while($Row1=mysql_fetch_array($Query1)) {
	if($Row1[TABLE_CONTENT_TEMPLATES."_Name"]<>"" && $Row1[TABLE_CONTENT_TEMPLATES."_Set"]<>"") {
	    if($tid>0 && $tid==$Row1[TABLE_CONTENT_TEMPLATES."_ID"]) {
	       $currentLayout=$Row1[TABLE_CONTENT_TEMPLATES."_Set"];
	    }
	    $arTemplateID[$index]=$Row1[TABLE_CONTENT_TEMPLATES."_ID"];
	    $arTemplateText[$index]=$Row1[TABLE_CONTENT_TEMPLATES."_Name"];
	    $arTemplateSet[$index]=$Row1[TABLE_CONTENT_TEMPLATES."_Set"];
	    if($myFirstLayout=="") { $myFirstLayout=$Row1[TABLE_CONTENT_TEMPLATES."_Set"]; }
	    $index++;
	}
    }
    //----------------------------------------------------------------------------------------------------------------
    if($act=="addnew") {
	$sql =" INSERT INTO ".TABLE_CONTENT."(".TABLE_CONTENT."_Text,".TABLE_CONTENT."_OnlineDate,".TABLE_CONTENT."_CreateByStaffID,".TABLE_CONTENT."_Photo,".TABLE_CONTENT."_Layout) ";
	$sql.=" VALUES('','".SYSTEM_DATETIMENOW."','".$SystemSession_Staff_ID."','','".$myFirstLayout."') ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$myID=mysql_insert_id();
	?>
	<form name="myRedirectForm" id="myRedirectForm" method="get" action="content.php">
	<input type="hidden" name="cid" id="cid" value="<?php echo $myID; ?>" >
	</form>
	<script language="JavaScript" type="text/JavaScript">
	autoSubmitTimer = setTimeout('submitMe()', 1*1000);
	function submitMe() { document.myRedirectForm.submit(); }
	</script>			    
	<?php
	exit;
    }
    //----------------------------------------------------------------------------------------------------------------
    if($act=="draft" && $cid>0) {
	$sql=" SELECT * FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_ID='".$cid."' LIMIT 0,1 ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$Row=mysql_fetch_array($Query);
	$myPublishTime=$Row[TABLE_CONTENT."_OnlineDate"];
	$myTimeDiff=System_DateTimeDiff($myPublishTime,SYSTEM_DATETIMENOW);
	if($myTimeDiff<0) { $myPublishTime=SYSTEM_DATETIMENOW; }
	$sql1=" UPDATE ".TABLE_CONTENT." SET ".TABLE_CONTENT."_Status='Draft',".TABLE_CONTENT."_OnlineDate='".$myPublishTime."' WHERE ".TABLE_CONTENT."_ID='".$cid."' ";
	$Query1=MYSQL_QUERY($sql1,$System_Connection1) OR DIE("Error: ".$sql1."<br>\n");
	?>
	<form name="myRedirectForm" id="myRedirectForm" method="get" action="allcontent.php">
	</form>
	<script language="JavaScript" type="text/JavaScript">
	autoSubmitTimer = setTimeout('submitMe()', 1*1000);
	function submitMe() { document.myRedirectForm.submit(); }
	</script>			    
	<?php
	exit;
    }
    //----------------------------------------------------------------------------------------------------------------
    if($act=="publish" && $cid>0) {
	$sql=" SELECT * FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_ID='".$cid."' LIMIT 0,1 ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$Row=mysql_fetch_array($Query);
	$myPublishTime=$Row[TABLE_CONTENT."_OnlineDate"];
	$myTimeDiff=System_DateTimeDiff($myPublishTime,SYSTEM_DATETIMENOW);
	if($myTimeDiff<0) { $myPublishTime=SYSTEM_DATETIMENOW; }
	//,".TABLE_CONTENT."_OnlineDate='".$myPublishTime."' 
	$sql1=" UPDATE ".TABLE_CONTENT." SET ".TABLE_CONTENT."_Status='Publish' WHERE ".TABLE_CONTENT."_ID='".$cid."' ";
	$Query1=MYSQL_QUERY($sql1,$System_Connection1) OR DIE("Error: ".$sql1."<br>\n");
	?>
	<form name="myRedirectForm" id="myRedirectForm" method="get" action="allcontent.php">
	</form>
	<script language="JavaScript" type="text/JavaScript">
	autoSubmitTimer = setTimeout('submitMe()', 1*1000);
	function submitMe() { document.myRedirectForm.submit(); }
	</script>			    
	<?php
	exit;
    }
    //----------------------------------------------------------------------------------------------------------------
    if($act=="setlayout") {
	$sql1=" UPDATE ".TABLE_CONTENT." SET ".TABLE_CONTENT."_Layout='".$currentLayout."',".TABLE_CONTENT."_Text=''  WHERE ".TABLE_CONTENT."_ID='".$cid."' ";
	$Query1=MYSQL_QUERY($sql1,$System_Connection1) OR DIE("Error: ".$sql1."<br>\n");
	?>
	<form name="myRedirectForm" id="myRedirectForm" method="get" action="content.php">
	<input type="hidden" name="cid" id="cid" value="<?php echo $cid; ?>" >
	</form>
	<script language="JavaScript" type="text/JavaScript">
	autoSubmitTimer = setTimeout('submitMe()', 1*1000);
	function submitMe() { document.myRedirectForm.submit(); }
	</script>			    
	<?php
	exit;
    }
    //----------------------------------------------------------------------------------------------------------------
    if($cid>0) {
	//---------------------------------
	$index=0; $arAdsID=""; $arAdsName="";
	$sql1=" SELECT * FROM ".TABLE_ADS." WHERE ".TABLE_ADS."_Name<>'' ORDER BY ".TABLE_ADS."_Name ASC ";
	$Query1=MYSQL_QUERY($sql1,$System_Connection1) OR DIE("Error: ".$sql1."<br>\n");
	while($Row1=mysql_fetch_array($Query1)) {
	    $arAdsID[$index]=$Row1[TABLE_ADS."_ID"];
	    $arAdsName[$index]=$Row1[TABLE_ADS."_Name"];
	    $index++;
	}
	//---------------------------------
	$sql=" SELECT * FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_ID='".$cid."' LIMIT 0,1 ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$Row=mysql_fetch_array($Query);
	$myID=$Row[TABLE_CONTENT."_ID"];
	$currentLayout=$Row[TABLE_CONTENT."_Layout"];
	
	$myCategory=$Row[TABLE_CONTENT."_Category"];
	$myText=$Row[TABLE_CONTENT."_Text"];
	$arText=explode("[#####]",$myText);
	//---------------------------------
	$myTable=TABLE_CONTENT;
	$myKeyField=TABLE_CONTENT."_ID";
	//---------------------------------
        ?>
	<!---###############################################################################--->
        <script type="text/javascript" src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/js-select2/select2.js"></script>
        <link rel="stylesheet" href="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/js-select2/select2.min.css">
	<script type="text/javascript" src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/js/jquery.datetimepicker.js"></script>
	<link rel="stylesheet" href="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/js/jquery.datetimepicker.css">
	<link rel="stylesheet" href="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/summernote/summernote.css">
	<script type="text/javascript" src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/summernote/summernote.js"></script>
	<script type="text/javascript" src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/js-fileinput/fileinput.js"></script>
	<link rel="stylesheet" href="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/js-fileinput/fileinput.css">
        <script type="text/javascript" src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/bootstrap-switch/bootstrap-switch.js"></script>
        <link rel="stylesheet" href="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/bootstrap-switch/bootstrap-switch.min.css">
	<!---###############################################################################--->
	<link  rel="stylesheet" href="croppic/croppic.css">
	<script type="text/javascript" src="croppic/jquery.mousewheel.min.js"></script>
	<script type="text/javascript" src="croppic/croppic.min.js"></script>
	<!---###############################################################################--->
	<div class="row width-100 padding-10" style=" padding-left:20px; padding-top:0px; ">
	<div class="hidden-xs hidden-sm col-md-2 col-lg-2 padding-2"></div>
	<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 padding-2 text-center">
	    <!---###############################################################################--->
	    <div class="form-group" style=" width:300px; ">
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-left">
		<b>เลือกเท็มเพลต : </b>
		</div>
		<div class="hidden-xs col-sm-1 col-md-2 col-lg-2 text-left"></div>
		<div class="col-xs-6 col-sm-5 col-md-4 col-lg-4 text-left">
		<b>กำหนดเวลาออนไลน์ : </b>
		</div>
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-left">
		<?php
		for($i=0;$i<=sizeof($arTemplateID);$i++) {
		    if($currentLayout==$arTemplateSet[$i]) {
			$templatesid=$arTemplateID[$i];
		    }
		}
		//--------------------------------------------
		$Config_DataSourceArrayID=$arTemplateID; // your data id array
		$Config_DataSourceArrayText=$arTemplateText; // your data text array
		//--------------------------------------------
		$Config_UniqueID="tid";
		$Config_DefaultValue=$templatesid;
		$Config_Link="?act=setlayout&cid=".$myID."&tid=";
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_selector.php");
		//--------------------------------------------
		?>
		</div>
		<div class="hidden-xs col-sm-1 col-md-2 col-lg-2 text-left"></div>
		<div class="col-xs-6 col-sm-5 col-md-4 col-lg-4 text-left">
		<?php
		$myField=TABLE_CONTENT."_OnlineDate";
		//--------------------------------------------
		$Config_UniqueID=$myField.$myID;
		$Config_DefaultValue=$Row[$myField];
		$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_datetime.php");
		//--------------------------------------------
		?>
		</div>
		</div>
		<!-------------------------------------------------------->
		<div class="form-group width-100">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left" style=" padding-left:0px; ">
		<b>ชื่อเรื่อง : </b>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left" style=" padding-left:0px; ">
		<?php
		$myField=TABLE_CONTENT."_Subject";
		//--------------------------------------------
		$Config_UniqueID=$myField.$myID;
		$Config_DefaultValue=htmlentities($Row[$myField]);
		$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
		//--------------------------------------------
		$Config_MaxChar=200;
		$Config_Width="100%";
		$Config_TextAlign="left";
		$Config_PlaceHolder="Subject";
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_text.php");
		?>
		</div>
	    </div>
	    <!---###############################################################################--->
	    <div class="form-group width-100" style=" padding-left:0px; ">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left" style=" padding-left:0px; ">
		<b>รายละเอียด : </b>
		</div>
	    </div>
	    <?php
	    $arLayout=explode(",",strtolower($currentLayout));
	    for($i=0;$i<=sizeof($arLayout);$i++) {
		if(strpos($arText[$i],"[@@@]")>0) {
		    $arDataItem=explode("[@@@]",$arText[$i]);
		    $myItemValue=trim($arDataItem[1]);
		} else {
		    $myItemValue='';
		}
		if($arLayout[$i]<>"") {
		    #######################################################
		    if($arLayout[$i]=="ads") {
			?>
			<div class="form-group width-100">
			    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left">
			    <?php
			    $myField=$i;
			    //--------------------------------------------
			    $Config_UniqueID=$myField.'of'.$myID;
			    if($myItemValue>0) {
				$Config_DefaultValue=$myItemValue;
			    } else {
				$Config_DefaultValue=0;
			    }
			    //--------------------------------------------
			    $Config_DataSourceArrayID=$arAdsID;
			    $Config_DataSourceArrayText=$arAdsName;
			    //--------------------------------------------
			    $Config_Width="100%";
			    $Config_TextAlign="left";
			    //--------------------------------------------
			    ?>
			    <select id="input<?php echo $Config_UniqueID; ?>" class="form-control select2" width="100">
			    <option value="0">---- เลือกโฆษณา ----</option>
			    <?php for($Config_I=0;$Config_I<sizeof($Config_DataSourceArrayID);$Config_I++) { ?>
			    <option value="<?php echo $Config_DataSourceArrayID[$Config_I]; ?>" <?php if($Config_DefaultValue==$Config_DataSourceArrayID[$Config_I]) { echo ' selected="selected" '; } ?>>
			    <?php echo $Config_DataSourceArrayText[$Config_I]; ?> </option>
			    <?php } ?>
			    </select>
			    <div class="txtAutoTextResult"><span id="idAutoSave<?php echo $Config_UniqueID; ?>">&nbsp;</span></div>
			    <script>
			    //-------------------------------------------
			    $("#input<?php echo $Config_UniqueID; ?>").select2(<?php echo " { width: '".$Config_Width."' } "; ?>).on("change", function(e) {
				    var selectObj = $('#input<?php echo $Config_UniqueID; ?>');
				    var theID = $(selectObj).select2('data').id;
				    var theSelection = $(selectObj).select2('data').text;
				    doSaveAds('<?php echo $myField; ?>','<?php echo $Config_UniqueID; ?>',theID);
			    });
			    </script>			    
			    </div>
			    <!-------------------------------------------------------->
			</div>
			<?php
		    #######################################################
		    } else if($arLayout[$i]=="video") {
			?>
			<div class="form-group width-100">
			    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left">
			    <?php
			    $myField=$i;
			    //--------------------------------------------
			    $Config_UniqueID=$myField.'of'.$myID;
			    $Config_DefaultValue=$myItemValue;
			    //--------------------------------------------
			    $Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
			    //--------------------------------------------
			    $Config_MaxChar=200;
			    //--------------------------------------------
			    ?>
			    <!-------------------------------------------------------->
			    <div style=" display: table; padding: 0px; " class="width-100">
			    <div style=" float: none; display: table-cell; vertical-align: top; padding: 0px; width:100%; ">
				<textarea id="input<?php echo $Config_UniqueID; ?>" type="text" class="form-control border-default inputSize" placeholder="Add embeded video link code" style=" width:100%; height:200px; text-align:left; " 
				onchange=" doSaveVideo('<?php echo $myField; ?>','<?php echo $Config_UniqueID; ?>',$('#input<?php echo $Config_UniqueID; ?>').val()); " /><?php
				echo str_replace("[#[#]","<",str_replace("[#]#]",">",$Config_DefaultValue)); ?></textarea>
			    </div>
			    </div>
			    <div class="txtAutoTextResult"><span id="idAutoSave<?php echo $Config_UniqueID; ?>">&nbsp;</span></div>
			    <!-------------------------------------------------------->
			    </div>
			</div>
			<?php
		    #######################################################
		    } else if($arLayout[$i]=="text") {
			    $myField=$i;
			    //--------------------------------------------
			    $Config_UniqueID=$myField.'of'.$myID;
			    if($myItemValue=="") {
				$Config_DefaultValue="";
			    } else {
				$Config_DefaultValue=$myItemValue;
			    }
			    ?>
			    <!-------------------------------------------------------->
			    <div class="htmleditor" style="padding-left:10px;  padding-right:10px; min-height:200px; ">
				<div class="summernote" id="idhtml<?php echo $Config_UniqueID; ?>"><?php echo $Config_DefaultValue; ?></div>
				<div class="txtAutoTextResult"><span id="idAutoSave<?php echo $Config_UniqueID; ?>">&nbsp;</span></div>
			    </div>
			    <script>
			    //----------------------------------------
			    $(document).ready(function() {
				$('#idhtml<?php echo $Config_UniqueID; ?>').summernote({
				    height: 500,
				    toolbar: [
					['style', ['bold', 'italic', 'underline', 'clear']],
					['color', ['color']],
					['para', ['paragraph','table']],
					['insert', ['link', 'picture']],
					['view', ['fullscreen', 'codeview']]
				    ]
				}).on('summernote.blur', function() {
				    doSaveHTML('<?php echo $i; ?>','<?php echo $Config_UniqueID; ?>','<?php echo $myID; ?>');
				});
			    });
			    </script>
			    <!-------------------------------------------------------->
			    <?php
		    #######################################################
		    } else {
			echo $arLayout[$i]."<br>";
		    }
		}
	    }
	    ?>
	    <!---###############################################################################--->
	    <?php
	    $Config_CropWidth=200;
	    $Config_CropHeight=150;
	    ?>
	    <div class="form-group width-100" style=" padding-left:0px; ">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left" style=" padding-left:0px; ">
		<b>ภาพขนาดเล็ก Thumb: </b> กำหนดให้ใช้ขนาด <?php echo $Config_CropWidth; ?>x<?php echo $Config_CropHeight; ?> pixel
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center" style=" padding-left:20px; padding-top:20px; ">
		<?php
		$myField=TABLE_CONTENT."_Thumb";
		$myIDs=sprintf('%04d',$myID);
		//--------------------------------------------
		$myFolder1=substr($myIDs,strlen($myIDs)-4,2);
		$myFolder2=substr($myIDs,strlen($myIDs)-2,2);
		//--------------------------------------------
		$Config_FolderKey='thumb';
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
		//$Config_CropWidth=200;
		//$Config_CropHeight=150;
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_onephoto.php");
		?>
		</div>
		<!-------------------------------------------------------->
	    </div>
	    <!---###############################################################################--->
	    <?php
	    $Config_CropWidth=300;
	    $Config_CropHeight=450;
	    ?><br><br>
	    <div class="form-group width-100" style=" padding-left:0px; ">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left" style=" padding-left:0px; ">
		<b>ภาพหน้าแรก Featured: </b> กำหนดให้ใช้ขนาด <?php echo $Config_CropWidth; ?>x<?php echo $Config_CropHeight; ?> pixel
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center" style=" padding-left:20px; padding-top:20px; ">
		<?php
		$myField=TABLE_CONTENT."_Thumb3";
		$myIDs=sprintf('%04d',$myID);
		//--------------------------------------------
		$myFolder1=substr($myIDs,strlen($myIDs)-4,2);
		$myFolder2=substr($myIDs,strlen($myIDs)-2,2);
		//--------------------------------------------
		$Config_FolderKey='thumb3';
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
		//$Config_CropWidth=200;
		//$Config_CropHeight=150;
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_onephoto.php");
		?>
		</div>
		<!-------------------------------------------------------->
	    </div>
	    <!---###############################################################################--->
	    <?php
	    $Config_CropWidth=484;
	    $Config_CropHeight=252;
	    ?><br><br>
	    <div class="form-group width-100" style=" padding-left:0px; ">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left" style=" padding-left:0px; ">
		<b>ภาพสำหรับ FaceBook: </b> กำหนดให้ใช้ขนาด <?php echo $Config_CropWidth; ?>x<?php echo $Config_CropHeight; ?> pixel
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center" style=" padding-left:20px; padding-top:20px; ">
		<?php
		$myField=TABLE_CONTENT."_Thumb2";
		$myIDs=sprintf('%04d',$myID);
		//--------------------------------------------
		$myFolder1=substr($myIDs,strlen($myIDs)-4,2);
		$myFolder2=substr($myIDs,strlen($myIDs)-2,2);
		//--------------------------------------------
		$Config_FolderKey='thumb2';
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
		//$Config_CropWidth=200;
		//$Config_CropHeight=150;
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_onephoto.php");
		?>
		</div>
		<!-------------------------------------------------------->
	    </div>
	    <!---###############################################################################--->
	    <br><br>
	    <div class="form-group width-100" style=" padding-left:0px; ">
		<?php
		//--------------------------------------------
		$myField=TABLE_CONTENT."_Photo";
		$myIDs=sprintf('%04d',$myID);
		$myFolder1=substr($myIDs,strlen($myIDs)-4,2);
		$myFolder2=substr($myIDs,strlen($myIDs)-2,2);
		$Config_FolderKey='content';
		//--------------------------------------------
		?>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left" style=" padding-left:0px; ">
		<b>ภาพเป็นชุด : </b>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left" style=" padding-left:0px; ">
		    <?php
		    $arPhotoList=explode(",",$Row[$myField]);
		    for($i=0;$i<=sizeof($arPhotoList);$i++) {
			if($arPhotoList[$i]<>"") {
			    ?>
			    <div class="pull-left padding-2" style=" height:114px; " id="idPhotoList<?php echo $i; ?>">
			    <div class="padding-2 border-radius-3 border-1 border-gray" style=" height:110px; ">
				<ul class="thumb">
					<li class="thumbs1">
					    <img src="<?php echo "../upload/".$Config_FolderKey."/".$myFolder1."/".$myFolder2."/".$arPhotoList[$i]; ?>" style=" max-height:100px; max-width:120px; ">
					</li>
					<li class="thumbs3">
					    <button type="button" class="btn btn-danger btn-circle" onclick=" doDeletePhoto('<?php echo $myID; ?>','<?php echo $arPhotoList[$i]; ?>','idPhotoList<?php echo $i; ?>','<?php echo $Config_FolderKey; ?>'); "><i class="glyphicon glyphicon-trash"></i></button>
					</li>
				</ul>
			    </div>
			    </div>
			    <?php
			}
		    }
		    ?>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left" style=" padding-left:0px; ">
		<?php
		//--------------------------------------------
		$Config_UniqueID=$myField.$myID;
		$Config_DefaultValue=$Row[$myField];
		$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
		$Config_Path="../upload/".$Config_FolderKey."/";
                if(!file_exists($Config_Path)){ mkdir($Config_Path); chmod($Config_Path,0777); }
		$Config_Path="../upload/".$Config_FolderKey."/".$myFolder1."/";
                if(!file_exists($Config_Path)){ mkdir($Config_Path); chmod($Config_Path,0777); }
		$Config_Path="../upload/".$Config_FolderKey."/".$myFolder1."/".$myFolder2."/";
                if(!file_exists($Config_Path)){ mkdir($Config_Path); chmod($Config_Path,0777); }
		$Config_MaxFileSizeKB=2*1000;
		//--------------------------------------------
		include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_multiplephotoupload.php");
		?>
		</div>
	    </div>
	    <!---###############################################################################--->
	    <div class="form-group width-100" style=" padding-left:0px; ">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left" style=" padding-left:0px; ">
		<b>เลือกหมวดหมู่ : </b>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left" style=" padding-left:0px; ">
		    <?php
		    $sql1=" SELECT * FROM ".TABLE_CATEGORY." WHERE ".TABLE_CATEGORY."_Name<>'' ORDER BY ".TABLE_CATEGORY."_Ordering ASC ";
		    $Query1=MYSQL_QUERY($sql1,$System_Connection1) OR DIE("Error: ".$sql1."<br>\n");
		    while($Row1=mysql_fetch_array($Query1)) {
			?>
			<div class="cursor pull-left border-radius-5 <?php if(strpos(" ".$myCategory,",".$Row1[TABLE_CATEGORY."_ID"].",")>0) { echo ' tagsYes '; } else { echo ' tagsNo '; } ?>"
			id="idTag<?php echo $Row1[TABLE_CATEGORY."_ID"]; ?>" style=" padding-left:15px; padding-right:15px; "
			onclick="setTags('<?php echo $Row1[TABLE_CATEGORY."_ID"]; ?>')" ><?php echo $Row1[TABLE_CATEGORY."_Name"]; ?></div>
			<?php
		    }
		    ?>
		</div>
	    </div>
	    <!---###############################################################################--->
	    <br>
	    <div class="form-group width-100" style=" padding-left:0px; ">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left" style=" padding-left:0px; ">
		<b>การแสดงผล : </b>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left" style=" padding-left:0px; ">
		    <div class="form-group pull-left" style=" width:300px; ">
			    <!--------------------------->
			    <label class="col-xs-6 col-sm-4 col-md-4 col-lg-4 control-label">
				<span class="label-main">Featured</span>
			    </label>
			    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 custom-text-position">
			    <?php
			    $myField=TABLE_CONTENT."_Featured"; 
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
		</div>
	    </div>
	    <!---###############################################################################--->
	    <div class="form-group width-100" style=" padding-left:0px; ">
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-left padding-5">
		    <button type="submit" name="inputSubmit" class="btn btn-info btn-block btn-flat" style="height:50px;" onClick=" doSaveDraft(); ">
		    <span class="glyphicon glyphicon-inbox"></span> &nbsp; Save Draft </button>
		</div>
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-left padding-5">
		    <button type="button" name="inputCancel" class="btn btn-success btn-block btn-flat" style="height:50px;" onClick=" doSavePublish(); ">
		    <span class="glyphicon glyphicon-ok"></span> &nbsp; Publish </button>
		</div>
	    </div>
	    <!---###############################################################################--->
	<br><br><br><br></div>
	<div class="hidden-xs hidden-sm col-md-2 col-lg-2 padding-2"></div>
	</div>
<style>
.tagsYes { background-color: #56b156; margin-left:10px; margin-top:10px; font-size: 12px; color:#FFFFFF; }
.tagsNo { background-color: #e2e2e2; margin-left:10px; margin-top:10px; font-size: 12px; color:#000000; }
.htmleditor div { padding: 2px; }
ul.thumb {
    float: left;
    list-style: none;
    margin: 0;
    padding: 0px;
    width: 120px;
}
ul.thumb li.thumbs1 {
    height: 100px;
    width: 80px;
    margin: 0;
    padding: 0px;
    float: left;
    position: relative;
}
ul.thumb li.thumbs3 {
    width: 30px;
    margin: 0;
    padding: 0px;
    float: right;
    position: relative;
    font-size: 18px;
    font-weight: bold;
    margin: 0;
    padding: 0px;
    padding-top: 2px;
    text-align: center;
    height: 30px;
    margin-top:-10px;
    margin-right:-9px;
}
</style>
<script>
//----------------------------------------
function doSaveDraft() {
//----------------------------------------
    $('#mySaveDraftForm').submit();
} 
//----------------------------------------
function doSavePublish() {
//----------------------------------------
    $('#mySavePublishForm').submit();
}
//----------------------------------------
function doDeletePhoto(myid,myfile,myuniqueid,mykey) {
//----------------------------------------
    $.ajax({
	type: "POST",
	url: "<?php echo $System_AjaxFileAction; ?>",
	data: { myAjaxAction: 'delete-photo-list', myAjaxKey: myfile, myAjaxID: myid , myAjaxValue: mykey },
	success: function(result) {
	    if(result=='OK') {
		$('#'+myuniqueid).hide();
	    } else {
		System_Notice('Error : ไม่สามารถลบข้อมูลได้','danger');
	    }
	}
    });
}
//----------------------------------------
function doSaveHTML(myi,myuniqueid,theID) {
//----------------------------------------
    var markup = $('#idhtml'+myuniqueid).summernote('code');
    $.ajax({
	type: "POST",
	url: "<?php echo $System_AjaxFileAction; ?>",
	data: { myAjaxAction: 'save-text', myAjaxKey: myi, myAjaxID: '<?php echo $myID; ?>', myAjaxValue: markup },
	success: function(result) {
	    if(result=='') {
		System_Notice('Error : ไม่สามารถบันทึกข้อมูลได้','danger');
	    } else {
		$('#idAutoSave'+myuniqueid).html('<font color="#00AA00">'+result+'</font>');
		//$('#idAutoSave'+myuniqueid).show("slide", { direction: 'right', easing: 'easeOutCirc' }, 500).delay(1000).fadeOut(1000);
	    }
	}
    });
}
//----------------------------------------
function doSaveAds(myi,myuniqueid,theID) {
//----------------------------------------
    $.ajax({
	type: "POST",
	url: "<?php echo $System_AjaxFileAction; ?>",
	data: { myAjaxAction: 'save-ads', myAjaxKey: myi, myAjaxID: '<?php echo $myID; ?>', myAjaxValue: theID },
	success: function(result) {
	    if(result=='') {
		System_Notice('Error : ไม่สามารถบันทึกข้อมูลได้','danger');
	    } else {
		$('#idAutoSave'+myuniqueid).html('<font color="#00AA00">'+result+'</font>');
		$('#idAutoSave'+myuniqueid).show("slide", { direction: 'right', easing: 'easeOutCirc' }, 500).delay(1000).fadeOut(1000);
	    }
	}
    });
}
//----------------------------------------
function doSaveVideo(myi,myuniqueid,mylink) {
//----------------------------------------
    var mylink1 = mylink.replace(/</g,"[#[#]");
    var mylink2 = mylink1.replace(/>/g,"[#]#]");
    $.ajax({
	type: "POST",
	url: "<?php echo $System_AjaxFileAction; ?>",
	data: { myAjaxAction: 'save-video', myAjaxKey: myi, myAjaxID: '<?php echo $myID; ?>', myAjaxValue: mylink2 },
	success: function(result) {
	    if(result=='') {
		System_Notice('Error : ไม่สามารถบันทึกข้อมูลได้','danger');
	    } else {
		$('#idAutoSave'+myuniqueid).html('<font color="#00AA00">'+result+'</font>');
		$('#idAutoSave'+myuniqueid).show("slide", { direction: 'right', easing: 'easeOutCirc' }, 500).delay(1000).fadeOut(1000);
	    }
	}
    });
}
//----------------------------------------
function doRefresh() {
//----------------------------------------
    $('#myRefreshForm').submit();
}
//----------------------------------
function setTags(mytagsid) {
//----------------------------------
    $.ajax({
	type: "POST",
	url: "<?php echo $System_AjaxFileAction; ?>",
	data: { myAjaxAction: 'set-tags', myAjaxKey: mytagsid, myAjaxID: '<?php echo $myID; ?>'},
	success: function(result) {
	    if(result=='yes') {
		$('#idTag'+mytagsid).switchClass("tagsNo","tagsYes");
	    }
	    if(result=='no') {
		$('#idTag'+mytagsid).switchClass("tagsYes","tagsNo");
	    }
	}
    });
}
//----------------------------------
</script>
<form name="myRefreshForm" id="myRefreshForm" method="get" action="content.php">
<input type="hidden" name="cid" id="cid" value="<?php echo $myID; ?>" >
</form>
<form name="mySaveDraftForm" id="mySaveDraftForm" method="get" action="content.php">
<input type="hidden" name="act" id="act" value="draft" >
<input type="hidden" name="cid" id="cid" value="<?php echo $myID; ?>" >
</form>
<form name="mySavePublishForm" id="mySavePublishForm" method="get" action="content.php">
<input type="hidden" name="act" id="act" value="publish" >
<input type="hidden" name="cid" id="cid" value="<?php echo $myID; ?>" >
</form>
	<?php
    //----------------------------------------------------------------------------------------------------------------
    } else {
	echo "Data not found : ID=".$cid." ";
    }
    include_once(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_loader.php");
    include_once(SYSTEM_DOC_ROOT."system/core-end.php");
} else {
    $myObjectRedirectFormLink=SYSTEM_WEBPATH_ROOT."/manage/index.php";
    include_once(SYSTEM_DOC_ROOT."object/obj_redirect.php");
}
?>