<?php  if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php }
//error_reporting(E_ALL ^ E_DEPRECATED);
//ini_set('display_errors', 1);
$System_LayoutUse="layout_manage.html";
$System_AjaxFileAction="ajax-content-loaddata.php";
$System_ShowAjaxIFrame=0;
$act=(isset($_REQUEST['act'])?$_REQUEST['act']:null);
$cid=(isset($_REQUEST['cid'])?$_REQUEST['cid']:null);
$tid=(isset($_REQUEST['tid'])?$_REQUEST['tid']:null);
$test=(isset($_REQUEST['test'])?$_REQUEST['test']:null);
include_once("../_config/config_system.php");
include_once(SYSTEM_DOC_ROOT."system/core-start.php");
include_once(SYSTEM_DOC_ROOT."system/core-body.php");
if($SystemSession_Staff_ID>0) { 
	if($act=="" && $cid=="" && $tid=="") { $act="addnew"; }
    //----------------------------------------------------------------------------------------------------------------
    $index=0;
    $myFirstLayout="ads,video,text";
    $currentLayout="ads,video,text";
    //----------------------------------------------------------------------------------------------------------------
    if($act=="addnew") {
	$sql =" INSERT INTO ".TABLE_CONTENT."(".TABLE_CONTENT."_Text,".TABLE_CONTENT."_OnlineDate,".TABLE_CONTENT."_CreateByStaffID,".TABLE_CONTENT."_Photo,".TABLE_CONTENT."_Layout) ";
	$sql.=" VALUES('','".SYSTEM_DATETIMENOW."','".$SystemSession_Staff_ID."','','".$myFirstLayout."') ";
	$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
	$myID=mysql_insert_id();
	?>
		<form name="myRedirectForm" id="myRedirectForm" method="get" action="content.php">
			<input type="hidden" name="cid" id="cid" value="<?php echo $myID; ?>">
		</form>
		<script language="JavaScript" type="text/JavaScript">
			autoSubmitTimer = setTimeout('submitMe()', 1*1000); function submitMe() { document.myRedirectForm.submit(); }
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
			autoSubmitTimer = setTimeout('submitMe()', 1*1000); function submitMe() { document.myRedirectForm.submit(); }
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
		autoSubmitTimer = setTimeout('submitMe()', 1*1000); function submitMe() { document.myRedirectForm.submit(); }
	</script>
	<?php
	// Clear Caching //////////////////////////////////
	$myCachePath="upload/htmlcaching/";
	//-------------------------------------------------
	$myCahceFile=md5("view.php?p=".$myID).".html";
	$Config_CacheFile=$myCachePath.'cached-'.$myCahceFile;
	if (file_exists("../".$Config_CacheFile)) { unlink("../".$Config_CacheFile); }
	//-------------------------------------------------
	$myCahceFile=md5("index.php?").".html";
	$Config_CacheFile=$myCachePath.'cached-'.$myCahceFile;
	if (file_exists("../".$Config_CacheFile)) { unlink("../".$Config_CacheFile); }
	///////////////////////////////////////////////////
	exit;
    }
    //----------------------------------------------------------------------------------------------------------------
    if($cid>0) {
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
		$myPhoto1=trim($Row[TABLE_CONTENT."_Photo1"]);
		$currentLayout="ads,video,text";
		
		$myCategory=$Row[TABLE_CONTENT."_Category"];
		$myText=$Row[TABLE_CONTENT."_Text"];
		$arText=explode("[#####]",$myText);
		//---------------------------------
		$myTable=TABLE_CONTENT;
		$myKeyField=TABLE_CONTENT."_ID";
		//---------------------------------
		$myPhotoAddText="";
		if($myPhoto1<>"") {
		    //---------------------------------
		    $myIDs=sprintf('%04d',$myID);
		    $myFolder1=substr($myIDs,strlen($myIDs)-4,2);
		    $myFolder2=substr($myIDs,strlen($myIDs)-2,2);
		    $Config_Path="/upload/content/".$myFolder1."/".$myFolder2."/";
		    //---------------------------------
		    $arPhoto1=explode(",",$myPhoto1);
		    for($x=0;$x<sizeof($arPhoto1);$x++) {
			if($arPhoto1[$x]<>"") {
			    $myPhotoAddText.='<br><img src="'.$Config_Path.$arPhoto1[$x].'"><br>';
			}
		    }
		    if($myPhotoAddText<>"") {
			$sql1=" UPDATE ".TABLE_CONTENT." SET ".TABLE_CONTENT."_Photo1='' WHERE ".TABLE_CONTENT."_ID='".$myID."' ";
			$Query1=MYSQL_QUERY($sql1,$System_Connection1) OR DIE("Error: ".$sql1."<br>\n");
			$sql=" SELECT * FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_ID='".$myID."' LIMIT 0,1 ";
			$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
			$Row=mysql_fetch_array($Query);
		    }
		}
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
		<script src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/jcrop/js/jquery.Jcrop.js"></script>
		<link rel="stylesheet" href="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/jcrop/css/jquery.Jcrop.css" type="text/css" />
		<!---###############################################################################--->
		<div class="pull-center padding-0 text-left" style=" max-width:1080px; ">
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
			<!-------------------------------------------------------->
			<div class="form-group width-100" style=" padding-left:0px; ">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left" style=" padding-left:0px; ">
					<b>รายละเอียด : </b>
				</div>
			</div>
			<!-------------------------------------------------------->
			<?php
			$arLayout=explode(",",strtolower($currentLayout));
			for($i=0;$i<=sizeof($arLayout);$i++) {
				if(strpos($arText[$i],"[@@@]")>0) {
					$arDataItem=explode("[@@@]",$arText[$i]);
					$myItemValue=trim($arDataItem[1]);
				} else {
					$myItemValue='';
				}
				$myLayoutCheck=isset($arLayout[$i])?$arLayout[$i]:"";
				if($myLayoutCheck<>"") {
					################################################################################################
					if($arLayout[$i]=="ads") {
					################################################################################################
						if(0) {
						?>
						<div class="form-group width-100" style=" padding-left:0px; ">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left" style=" padding-left:0px; ">
						<?php
						//--------------------------------------------
						$myField=$i;
						$Config_UniqueID=$myField.'of'.$myID;
						if($myItemValue>0) {
							$Config_DefaultValue=$myItemValue;
						} else {
							$Config_DefaultValue=0;
						}
						//--------------------------------------------
						$Config_DataSourceArrayID=$arAdsID;
						$Config_DataSourceArrayText=$arAdsName;
						$Config_Width="100%";
						$Config_TextAlign="left";
						//--------------------------------------------
						?>
						<select id="input<?php echo $Config_UniqueID; ?>" class="form-control select2" width="100%">
							<option value="0">---- เลือกโฆษณา ----</option>
							<?php for($Config_I=0;$Config_I<sizeof($Config_DataSourceArrayID);$Config_I++) { ?>
							<option value="<?php echo $Config_DataSourceArrayID[$Config_I]; ?>" <?php if($Config_DefaultValue==$Config_DataSourceArrayID[$Config_I]) { echo ' selected="selected" '; } ?>>
								<?php echo $Config_DataSourceArrayText[$Config_I]; ?>
							</option>
							<?php } ?>
						</select>
						<div class="txtAutoTextResult"><span id="idAutoSave<?php echo $Config_UniqueID; ?>">&nbsp;</span></div>
						<script>
							//-------------------------------------------
							$("#input<?php echo $Config_UniqueID; ?>").select2(<?php echo " { width: '".$Config_Width."' } "; ?>).on("change", function(e) {
								var selectObj = $('#input<?php echo $Config_UniqueID; ?>');
								var theID = $(selectObj).select2('data').id;
								var theSelection = $(selectObj).select2('data').text;
								doSaveAds('<?php echo $myField; ?>', '<?php echo $Config_UniqueID; ?>', theID);
							});
						</script>
						</div>
						</div>
						<?php
						}
					################################################################################################
					} else if($arLayout[$i]=="video") {
					################################################################################################
						//--------------------------------------------
						$myField=$i;
						$Config_UniqueID=$myField.'of'.$myID;
						$Config_DefaultValue=$myItemValue;
						$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
						//--------------------------------------------
						?>
						<div class="form-group width-100 padding-0">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left padding-0">
							<div style=" display: table; padding: 0px; " class="width-100">
								<div style=" float: none; display: table-cell; vertical-align: top; padding: 0px; width:100%; ">
								<textarea id="input<?php echo $Config_UniqueID; ?>" type="text" class="form-control border-default inputSize" placeholder="ใส่โค้ดวีดีโอ" style=" width:100%; height:100px; text-align:left; " onchange=" doSaveVideo('<?php echo $myField; ?>','<?php echo $Config_UniqueID; ?>',$('#input<?php echo $Config_UniqueID; ?>').val()); " /><?php echo str_replace("[#[#]","<",str_replace("[#]#]",">",$Config_DefaultValue)); ?></textarea>
								</div>
							</div>
							<div class="txtAutoTextResult"><span id="idAutoSave<?php echo $Config_UniqueID; ?>">&nbsp;</span></div>
						</div>
						</div>
						<?php
					################################################################################################
					} else if($arLayout[$i]=="text") {
					################################################################################################
						//--------------------------------------------
						$myField=$i;
						$Config_UniqueID=$myField.'of'.$myID;
						if($myItemValue=="") {
							$Config_DefaultValue="";
						} else {
							$Config_DefaultValue=$myItemValue;
						}
						//--------------------------------------------
						?>
						<div class="form-group width-100 padding-0">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left" style=" padding-left:0px; ">
							<div class="htmleditor padding-0" style=" min-height:300px; ">
								<div class="summernote" id="idhtml<?php echo $Config_UniqueID; ?>"><?php echo $Config_DefaultValue.$myPhotoAddText; ?></div>
								<div class="txtAutoTextResult"><span id="idAutoSave<?php echo $Config_UniqueID; ?>">&nbsp;</span></div>
							</div>
							<script>
							//----------------------------------------
							$(document).ready(function() {
							//----------------------------------------
								$('#idhtml<?php echo $Config_UniqueID; ?>').summernote({
									height: 300,
									toolbar: [
										['style', ['bold', 'italic', 'underline', 'clear']],
										['color', ['color']],
										['para', ['paragraph', 'table']],
										['insert', ['link', 'picture']],
										['view', ['fullscreen', 'codeview']]
									]
								}).on('summernote.blur', function() {
									doSaveHTML('<?php echo $i; ?>', '<?php echo $Config_UniqueID; ?>', '<?php echo $myID; ?>');
								});
								doSaveHTML('<?php echo $i; ?>', '<?php echo $Config_UniqueID; ?>', '<?php echo $myID; ?>');
							});
							</script>
						</div>
						</div>
						<?php
					################################################################################################
					} else {
					################################################################################################
						?>
						<div class="form-group width-100" style=" padding-left:0px; ">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left" style=" padding-left:0px; ">
						<?php
						echo $arLayout[$i]."<br>";
						?>
						</div>
						</div>
						<?php
					################################################################################################
					}
					################################################################################################
				}
			}
			?>
			<!-------------------------------------------------------->
			<?php
			//--------------------------------------------
			$myField=TABLE_CONTENT."_Photo1";
			$Config_FolderKey='content';
			$myIDs=sprintf('%04d',$myID);
			$myFolder1=substr($myIDs,strlen($myIDs)-4,2);
			$myFolder2=substr($myIDs,strlen($myIDs)-2,2);
			//--------------------------------------------
			?>
			<div class="form-group width-100 padding-0">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left padding-0">
					<?php
					$arPhotoList=explode(",",$Row[$myField]);
					for($i=0;$i<=sizeof($arPhotoList);$i++) {
						if($arPhotoList[$i]<>"") { ?>
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
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 padding-0">
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
					include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_multiplephotoupload_big.php");
					?>
				</div>
			</div>
			<!-------------------------------------------------------->
			<?php
			$Config_CropWidth=200;
			$Config_CropHeight=150;
			?>
			<br><br>
			<div class="form-group width-100" style=" padding-left:0px; ">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left" style=" padding-left:0px; ">
					<b>ปกเล็ก: </b> กำหนดให้ใช้ขนาด <?php echo $Config_CropWidth; ?>x<?php echo $Config_CropHeight; ?> pixel / .jpg .jpeg .png
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center" style=" padding-left:20px; padding-top:20px; ">
					<?php
					//--------------------------------------------
					$myField=TABLE_CONTENT."_Thumb";
					$Config_FolderKey='thumb';
					$myIDs=sprintf('%04d',$myID);
					$myFolder1=substr($myIDs,strlen($myIDs)-4,2);
					$myFolder2=substr($myIDs,strlen($myIDs)-2,2);
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
					$Config_Return="content.php?cid=";
					$Config_DefaultPath=$Config_Path;
					//--------------------------------------------
					include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_onephoto2.php");
					//--------------------------------------------
					?>
				</div>
			</div>
			<!-------------------------------------------------------->
			<?php
			$Config_CropWidth=300;
			$Config_CropHeight=450;
			?>
			<br><br>
			<div class="form-group width-100" style=" padding-left:0px; ">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left" style=" padding-left:0px; ">
					<b>ปกแนวตั้ง : </b> กำหนดให้ใช้ขนาด <?php echo $Config_CropWidth; ?>x<?php echo $Config_CropHeight; ?> pixel / .jpg .jpeg .png
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center" style=" padding-left:20px; padding-top:20px; ">
					<?php
					//--------------------------------------------
					$myField=TABLE_CONTENT."_Thumb3";
					$Config_FolderKey='thumb3';
					$myIDs=sprintf('%04d',$myID);
					$myFolder1=substr($myIDs,strlen($myIDs)-4,2);
					$myFolder2=substr($myIDs,strlen($myIDs)-2,2);
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
					$Config_Return="content.php?cid=";
					$Config_DefaultPath=$Config_Path;
					//--------------------------------------------
					include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_onephoto2.php");
					//--------------------------------------------
					?>
				</div>
			</div>
			<!-------------------------------------------------------->
			<?php
			$Config_CropWidth=484;
			$Config_CropHeight=252;
			?>
			<br><br>
			<div class="form-group width-100" style=" padding-left:0px; ">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left" style=" padding-left:0px; ">
					<b>ปกแนวนอน : </b> กำหนดให้ใช้ขนาด <?php echo $Config_CropWidth; ?>x<?php echo $Config_CropHeight; ?> pixel / .jpg .jpeg .png
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center" style=" padding-left:20px; padding-top:20px; ">
					<?php
					//--------------------------------------------
					$myField=TABLE_CONTENT."_Thumb2";
					$Config_FolderKey='thumb2';
					$myIDs=sprintf('%04d',$myID);
					$myFolder1=substr($myIDs,strlen($myIDs)-4,2);
					$myFolder2=substr($myIDs,strlen($myIDs)-2,2);
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
					$Config_Return="content.php?cid=";
					$Config_DefaultPath=$Config_Path;
					//--------------------------------------------
					include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_onephoto2.php");
					//--------------------------------------------
					?>
				</div>
			</div>
			<!-------------------------------------------------------->
			<?php
			$Config_CropWidth=600;
			$Config_CropHeight=400;
			?>
			<br><br>
			<div class="form-group width-100" style=" padding-left:0px; ">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left" style=" padding-left:0px; ">
					<b>ภาพแชร์บน Facebook : </b> กำหนดให้ใช้ขนาด <?php echo $Config_CropWidth; ?>x<?php echo $Config_CropHeight; ?> pixel / .jpg .jpeg .png
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center" style=" padding-left:20px; padding-top:20px; ">
					<?php
					//--------------------------------------------
					$myField=TABLE_CONTENT."_ThumbFB";
					$Config_FolderKey='thumbfb';
					$myIDs=sprintf('%04d',$myID);
					$myFolder1=substr($myIDs,strlen($myIDs)-4,2);
					$myFolder2=substr($myIDs,strlen($myIDs)-2,2);
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
					$Config_Return="content.php?cid=";
					$Config_DefaultPath=$Config_Path;
					//--------------------------------------------
					include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_onephoto2.php");
					//--------------------------------------------
					?>
				</div>
			</div>
			<!-------------------------------------------------------->
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
						<div class="pull-left border-radius-5 cursor <?php if(strpos(" ".$myCategory,",".$Row1[TABLE_CATEGORY."_ID"].",")>0) { echo ' tagsYes '; } else { echo ' tagsNo '; } ?>" id="idTag<?php echo $Row1[TABLE_CATEGORY."_ID"]; ?>" style=" padding-left:15px; padding-right:15px; " onclick="setTags('<?php echo $Row1[TABLE_CATEGORY."_ID"]; ?>')">
						<?php echo $Row1[TABLE_CATEGORY."_Name"]; ?>
						</div>
						<?php
					}
					?>
				</div>
			</div>
			<br>
			<!-------------------------------------------------------->
			<div class="form-group width-100" style=" padding-left:0px; ">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left" style=" padding-left:0px; ">
					<b>เลือกแท็ก : </b>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left" style=" padding-left:0px; ">
					<table width="100%" border="0">
						<tr>
						<td rowspan="2" class="box-sky" width="50%" style="vertical-align:top; padding:5px; text-align:left;" id="idTagsAdded">
							<?php
							//----------------------------------------------------------------------------------------
							$mytags=$Row[TABLE_CONTENT."_Tags"];
							$arTagsAll=explode(",",$mytags);
							$myTagsSQL=" ".TABLE_TAGS."_ID=0 ";
							$myTagsSQLNotIn=" AND ".TABLE_TAGS."_ID>0 ";
							for($x=0;$x<sizeof($arTagsAll);$x++) {
								if($arTagsAll[$x]>0) {
									$myTagsSQL.=" OR ".TABLE_TAGS."_ID='".$arTagsAll[$x]."' ";
									$myTagsSQLNotIn.=" AND ".TABLE_TAGS."_ID<>'".$arTagsAll[$x]."' ";
								}
							}
							//----------------------------------------------------------------------------------------
							$sql1=" SELECT * FROM ".TABLE_TAGS." WHERE ".$myTagsSQL." ORDER BY ".TABLE_TAGS."_Name ASC ";
							$Query1=MYSQL_QUERY($sql1,$System_Connection1) OR DIE("Error: ".$sql1."<br>\n");
							while($Row1=mysql_fetch_array($Query1)) {
								echo '<div class="categoryTags pull-left cursor" onclick=" doRemoveTags('.$Row1[TABLE_TAGS."_ID"].'); ">&nbsp;#'.$Row1[TABLE_TAGS."_Name"].'&nbsp;</div>';
							}
							//----------------------------------------------------------------------------------------
							?>
						</td>
						<td width="50%" style="vertical-align:top; padding:10px; text-align:left; height: 24px; ">
							<form onsubmit=" doAddTags(); return false; ">
							<input id="inputAddNewTags" type="text" class="form-control border-default pull-left" maxlength="50" style=" width:80%; text-align:left; " value="" onchange=" doSearchTags(); " onkeyup=" doSearchTags(); " onblur=" doSearchTags(); "  autocomplete="off" />
							<button type="button" class="btn btn-default btn-success pull-right" style=" width: 19%; " onclick=" doAddNewTags(); "> Add </button>
							</form>
						</td>
						</tr>
						<tr>
						<td width="50%" style="vertical-align:top; padding:5px; text-align:left; height: 100px; " id="idTagsSearchResult">
							<?php
							$myFirstTagsID=0; $myFirstTagsName=""; $index=0;
							$sql1=" SELECT * FROM ".TABLE_TAGS." WHERE ".TABLE_TAGS."_Name<>'' ".$myTagsSQLNotIn." ORDER BY ".TABLE_TAGS."_LastUse DESC LIMIT 0,20 ";
							$Query1=MYSQL_QUERY($sql1,$System_Connection1) OR DIE("Error: ".$sql1."<br>\n");
							while($Row1=mysql_fetch_array($Query1)) {
								if($index==0) {
									echo '<div class="categoryTagsX pull-left cursor" onclick=" doAddTagsClick('.$Row1[TABLE_TAGS."_ID"].'); ">&nbsp;#'.$Row1[TABLE_TAGS."_Name"].'&nbsp;</div>';
								} else {
									echo '<div class="categoryTags pull-left cursor" onclick=" doAddTagsClick('.$Row1[TABLE_TAGS."_ID"].'); ">&nbsp;#'.$Row1[TABLE_TAGS."_Name"].'&nbsp;</div>';
								}
								if($myFirstTagsID==0) {
									$myFirstTagsID=$Row1[TABLE_TAGS."_ID"];
									$myFirstTagsName=$Row1[TABLE_TAGS."_Name"];
								}
								$index++;
							}
							?>
							<input type="hidden" id="inputFirstTagsID" name="inputFirstTagsID" value="<?php echo $myFirstTagsID; ?>" />
							<input type="hidden" id="inputFirstTagsName" name="inputFirstTagsName" value="<?php echo $myFirstTagsName; ?>" />
						</td>
						</tr>
					</table>
				</div>
			</div>
			<!-------------------------------------------------------->
			<br><br>
			<div class="form-group width-100" style=" padding-left:0px; ">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left" style=" padding-left:0px; ">
					<b>ข่าวแนะนำ : </b>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left" style=" padding-left:0px; ">
					<div class="form-group pull-left" style="">
						<!--------------------------->
						<label class="col-xs-6 col-sm-4 col-md-4 col-lg-4 control-label">
							<span class="label-main">แสดงที่ข่าวแนะนำ</span>
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
			</div>
			<!-------------------------------------------------------->
			<br><br>
			<div class="form-group width-100" style=" padding-left:0px; ">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left" style=" padding-left:0px; ">
					<b>แหล่งที่มา : </b>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left" style=" padding-left:0px; ">
				    <div class="form-group width-100" style=" padding-left:0px; ">
					<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 text-left padding-2">
					    <!---------------------------------------->
					    <div class="width-100 text-left padding-2">
						<?php
						$referCount=1;
						$myField=TABLE_CONTENT."_RefName1";
						if($Row[$myField]<>"") { $referCount=1; }
						//--------------------------------------------
						$Config_UniqueID=$myField.$myID;
						$Config_DefaultValue=htmlentities($Row[$myField]);
						$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
						//--------------------------------------------
						$Config_MaxChar=200;
						$Config_Width="100%";
						$Config_TextAlign="left";
						$Config_PlaceHolder="1.Name";
						//--------------------------------------------
						include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_text.php");
						?>
					    </div>
					    <div class="width-100 text-left padding-2">
						<?php
						$myField=TABLE_CONTENT."_RefLink1";
						//--------------------------------------------
						$Config_UniqueID=$myField.$myID;
						$Config_DefaultValue=htmlentities($Row[$myField]);
						$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
						//--------------------------------------------
						$Config_MaxChar=500;
						$Config_Width="100%";
						$Config_TextAlign="left";
						$Config_PlaceHolder="1.Link";
						//--------------------------------------------
						include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_text.php");
						?>
					    </div>
					    <!---------------------------------------->
					</div>
					<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 text-left padding-2" id="idRefer2">
					    <!---------------------------------------->
					    <div class="width-100 text-left padding-2">
						<?php
						$myField=TABLE_CONTENT."_RefName2";
						if($Row[$myField]<>"") { $referCount=2; }
						//--------------------------------------------
						$Config_UniqueID=$myField.$myID;
						$Config_DefaultValue=htmlentities($Row[$myField]);
						$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
						//--------------------------------------------
						$Config_MaxChar=200;
						$Config_Width="100%";
						$Config_TextAlign="left";
						$Config_PlaceHolder="2.Name";
						//--------------------------------------------
						include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_text.php");
						?>
					    </div>
					    <div class="width-100 text-left padding-2">
						<?php
						$myField=TABLE_CONTENT."_RefLink2";
						//--------------------------------------------
						$Config_UniqueID=$myField.$myID;
						$Config_DefaultValue=htmlentities($Row[$myField]);
						$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
						//--------------------------------------------
						$Config_MaxChar=500;
						$Config_Width="100%";
						$Config_TextAlign="left";
						$Config_PlaceHolder="2.Link";
						//--------------------------------------------
						include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_text.php");
						?>
					    </div>
					    <!---------------------------------------->
					</div>
					<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 text-left padding-2" id="idRefer3">
					    <!---------------------------------------->
					    <div class="width-100 text-left padding-2">
						<?php
						$myField=TABLE_CONTENT."_RefName3";
						if($Row[$myField]<>"") { $referCount=3; }
						//--------------------------------------------
						$Config_UniqueID=$myField.$myID;
						$Config_DefaultValue=htmlentities($Row[$myField]);
						$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
						//--------------------------------------------
						$Config_MaxChar=200;
						$Config_Width="100%";
						$Config_TextAlign="left";
						$Config_PlaceHolder="3.Name";
						//--------------------------------------------
						include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_text.php");
						?>
					    </div>
					    <div class="width-100 text-left padding-2">
						<?php
						$myField=TABLE_CONTENT."_RefLink3";
						//--------------------------------------------
						$Config_UniqueID=$myField.$myID;
						$Config_DefaultValue=htmlentities($Row[$myField]);
						$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
						//--------------------------------------------
						$Config_MaxChar=500;
						$Config_Width="100%";
						$Config_TextAlign="left";
						$Config_PlaceHolder="3.Link";
						//--------------------------------------------
						include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_text.php");
						?>
					    </div>
					    <!---------------------------------------->
					</div>
					<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 text-left padding-2" id="idRefer4">
					    <!---------------------------------------->
					    <div class="width-100 text-left padding-2">
						<?php
						$myField=TABLE_CONTENT."_RefName4";
						if($Row[$myField]<>"") { $referCount=4; }
						//--------------------------------------------
						$Config_UniqueID=$myField.$myID;
						$Config_DefaultValue=htmlentities($Row[$myField]);
						$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
						//--------------------------------------------
						$Config_MaxChar=200;
						$Config_Width="100%";
						$Config_TextAlign="left";
						$Config_PlaceHolder="4.Name";
						//--------------------------------------------
						include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_text.php");
						?>
					    </div>
					    <div class="width-100 text-left padding-2">
						<?php
						$myField=TABLE_CONTENT."_RefLink4";
						//--------------------------------------------
						$Config_UniqueID=$myField.$myID;
						$Config_DefaultValue=htmlentities($Row[$myField]);
						$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
						//--------------------------------------------
						$Config_MaxChar=500;
						$Config_Width="100%";
						$Config_TextAlign="left";
						$Config_PlaceHolder="4.Link";
						//--------------------------------------------
						include(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_text.php");
						?>
					    </div>
					    <!---------------------------------------->
					</div>
					<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 text-left padding-2" id="idReferAdd">
					    <div class="width-100 text-left padding-2">
						<button type="button" name="inputSubmit" class="btn btn-info btn-flat" onClick=" doReferAdd(); ">
						<span class="glyphicon glyphicon-plus"></span> </button>
					    </div>
					    <div class="width-100 text-left padding-2">&nbsp;</div>
					</div>
				</div>
			</div>
			<script>
			var referCount=<?php echo $referCount; ?>;
			function doReferAdd() {
			    referCount++;
			    $('#idRefer'+referCount).show();
			    if(referCount==4) {
				$('#idReferAdd').hide();
			    }
			}
			function showReferLink() {
			    if (referCount==1) {
				$('#idRefer2').hide();
				$('#idRefer3').hide();
				$('#idRefer4').hide();
				$('#idReferAdd').show();
			    }
			    if (referCount==2) {
				$('#idRefer2').show();
				$('#idRefer3').hide();
				$('#idRefer4').hide();
				$('#idReferAdd').show();
			    }
			    if (referCount==3) {
				$('#idRefer2').show();
				$('#idRefer3').show();
				$('#idRefer4').hide();
				$('#idReferAdd').show();
			    }
			    if (referCount==4) {
				$('#idRefer2').show();
				$('#idRefer3').show();
				$('#idRefer4').show();
				$('#idReferAdd').hide();
			    }
			}
			showReferLink();
			</script>
			<!-------------------------------------------------------->
			<div class="form-group width-100" style=" padding-left:0px; ">
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-left padding-5">
					<button type="submit" name="inputSubmit" class="btn btn-info btn-block btn-flat" style="height:50px;" onClick=" doSaveDraft(); ">
					<span class="glyphicon glyphicon-inbox"></span> &nbsp; บันทึกฉบับร่าง </button>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-left padding-5">
					<button type="button" name="inputCancel" class="btn btn-success btn-block btn-flat" style="height:50px;" onClick=" doSavePublish(); ">
					<span class="glyphicon glyphicon-ok"></span> &nbsp; เผยแพร่ </button>
				</div>
			</div>
			<!-------------------------------------------------------->
		</div>
		<!---###############################################################################--->
		<style>
		.tagsYes { background-color: #56b156; margin-left: 10px; margin-top: 10px; font-size: 12px; color: #FFFFFF; }
		.tagsNo { background-color: #e2e2e2; margin-left: 10px; margin-top: 10px; font-size: 12px; color: #000000; }
		.htmleditor div { padding: 2px; }
		ul.thumb { float: left; list-style: none; margin: 0; padding: 0px; width: 120px; }
		ul.thumb li.thumbs1 { height: 100px; width: 80px; margin: 0; padding: 0px; float: left; position: relative; }
		ul.thumb li.thumbs3 { width: 30px; margin: 0; padding: 0px; float: right; position: relative; font-size: 18px; font-weight: bold; margin: 0; padding: 0px; padding-top: 2px; text-align: center; height: 30px; margin-top: -10px; margin-right: -9px; }
		.divleft { position: fixed; top: 300px; left: 0; z-index: 102; width: 50px; height:50px; padding:10px; border: 0px; }
		.divright { position: fixed; top: 300px; right: 0; z-index: 102; width: 50px; height:50px; padding:10px; border: 0px; margin-right: 40px; }
		.categoryTags { color:#FFFFFF; background-color:#eb0254; padding:3px; padding-left:10px; padding-right:10px; font-size:12px;  -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; margin-left: 5px; margin-top: 3px; }
		.categoryTagsX { color:#FFFFFF; background-color:#00AA00; padding:3px; padding-left:10px; padding-right:10px; font-size:12px;  -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; margin-left: 5px; margin-top: 3px; }
		</style>
		<?php
		#########################################################################################
		$sql=" SELECT ".TABLE_CONTENT."_ID FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_ID>'".$cid."' ORDER BY ".TABLE_CONTENT."_ID ASC LIMIT 0,1 ";
		$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
		$Row=mysql_fetch_array($Query);
		$myNewerID=$Row[0];
		if($myNewerID>0) {
			?> <div class="divleft"> <button type="button" class="btn btn-default cursor" onclick=" location.href='content.php?cid=<?php echo $myNewerID; ?>'; "> <i class="fa fa-chevron-left"></i> Newer </button> </div> <?php
		}
		#########################################################################################
		$sql=" SELECT ".TABLE_CONTENT."_ID FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_ID<'".$cid."' ORDER BY ".TABLE_CONTENT."_ID DESC LIMIT 0,1 ";
		$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
		$Row=mysql_fetch_array($Query);
		$myOlderID=$Row[0];
		if($myOlderID>0) {
			?> <div class="divright"> <button type="button" class="btn btn-default cursor" onclick=" location.href='content.php?cid=<?php echo $myOlderID; ?>'; "> Older <i class="fa fa-chevron-right"></i> </button> </div> <?php
		}
		#########################################################################################
		?>
		<!---###############################################################################--->
		<script>
		//----------------------------------------
		function doAddNewTags() {
		//----------------------------------------
			var sname=$('#inputAddNewTags').val();
			$.ajax({
				type: "POST",
				url: "<?php echo $System_AjaxFileAction; ?>",
				data: {
					myAjaxAction: 'add-new-tags',
					myAjaxID: '<?php echo $myID; ?>',
					myAjaxKey: sname
				},
				success: function(result) {
					$('#idTagsAdded').html(result);
					$('#inputAddNewTags').val('');
					doSearchTags();
				}
			});
		}
		//----------------------------------------
		function doRemoveTags(myid) {
		//----------------------------------------
			$.ajax({
				type: "POST",
				url: "<?php echo $System_AjaxFileAction; ?>",
				data: {
					myAjaxAction: 'remove-tags',
					myAjaxID: '<?php echo $myID; ?>',
					myAjaxKey: myid
				},
				success: function(result) {
					$('#idTagsAdded').html(result);
					doSearchTags();
				}
			});
		}
		//----------------------------------------
		function doAddTagsClick(myid) {
		//----------------------------------------
			$.ajax({
				type: "POST",
				url: "<?php echo $System_AjaxFileAction; ?>",
				data: {
					myAjaxAction: 'add-tags-click',
					myAjaxID: '<?php echo $myID; ?>',
					myAjaxKey: myid
				},
				success: function(result) {
					$('#idTagsAdded').html(result);
					doSearchTags();
				}
			});
		}
		//----------------------------------------
		function doAddTags() {
		//----------------------------------------
			var sid=$('#inputFirstTagsID').val();
			var sname=$('#inputFirstTagsName').val();
			if (sid>0) {
				$.ajax({
					type: "POST",
					url: "<?php echo $System_AjaxFileAction; ?>",
					data: {
						myAjaxAction: 'add-tags',
						myAjaxID: '<?php echo $myID; ?>',
						myAjaxValue: sname,
						myAjaxKey: sid
					},
					success: function(result) {
						$('#idTagsAdded').html(result);
					}
				});
            } else {
				doAddNewTags();
			}
		}
		//----------------------------------------
		function doSearchTags() {
		//----------------------------------------
			var s=$('#inputAddNewTags').val();
			$.ajax({
				type: "POST",
				url: "<?php echo $System_AjaxFileAction; ?>",
				data: {
					myAjaxAction: 'search-tags',
					myAjaxID: '<?php echo $myID; ?>',
					myAjaxValue: s
				},
				success: function(result) {
					$('#idTagsSearchResult').html(result);
				}
			});
		}
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
		function doDeletePhoto(myid, myfile, myuniqueid, mykey) {
		//----------------------------------------
			$.ajax({
				type: "POST",
				url: "<?php echo $System_AjaxFileAction; ?>",
				data: {
					myAjaxAction: 'delete-photo-list',
					myAjaxKey: myfile,
					myAjaxID: myid,
					myAjaxValue: mykey
				},
				success: function(result) {
					if (result == 'OK') {
						$('#' + myuniqueid).hide();
					} else {
						System_Notice('Error : ไม่สามารถลบข้อมูลได้', 'danger');
					}
				}
			});
		}
		//----------------------------------------
		function doSaveHTML(myi, myuniqueid, theID) {
		//----------------------------------------
			var markup = $('#idhtml' + myuniqueid).summernote('code');
			$.ajax({
				type: "POST",
				url: "<?php echo $System_AjaxFileAction; ?>",
				data: {
					myAjaxAction: 'save-text',
					myAjaxKey: myi,
					myAjaxID: '<?php echo $myID; ?>',
					myAjaxValue: markup
				},
				success: function(result) {
					if (result == '') {
						System_Notice('Error : ไม่สามารถบันทึกข้อมูลได้', 'danger');
					} else {
						$('#idAutoSave' + myuniqueid).html('<font color="#00AA00">' + result + '</font>');
						$('#idAutoSave'+myuniqueid).show("slide", { direction: 'right', easing: 'easeOutCirc' }, 500).delay(1000).fadeOut(1000);
					}
				}
			});
		}
		//----------------------------------------
		function doSaveAds(myi, myuniqueid, theID) {
		//----------------------------------------
			$.ajax({
				type: "POST",
				url: "<?php echo $System_AjaxFileAction; ?>",
				data: {
					myAjaxAction: 'save-ads',
					myAjaxKey: myi,
					myAjaxID: '<?php echo $myID; ?>',
					myAjaxValue: theID
				},
				success: function(result) {
					if (result == '') {
						System_Notice('Error : ไม่สามารถบันทึกข้อมูลได้', 'danger');
					} else {
						$('#idAutoSave' + myuniqueid).html('<font color="#00AA00">' + result + '</font>');
						$('#idAutoSave' + myuniqueid).show("slide", {
							direction: 'right',
							easing: 'easeOutCirc'
						}, 500).delay(1000).fadeOut(1000);
					}
				}
			});
		}
		//----------------------------------------
		function doSaveVideo(myi, myuniqueid, mylink) {
		//----------------------------------------
			var mylink1 = mylink.replace(/</g, "[#[#]");
			var mylink2 = mylink1.replace(/>/g, "[#]#]");
			$.ajax({
				type: "POST",
				url: "<?php echo $System_AjaxFileAction; ?>",
				data: {
					myAjaxAction: 'save-video',
					myAjaxKey: myi,
					myAjaxID: '<?php echo $myID; ?>',
					myAjaxValue: mylink2
				},
				success: function(result) {
					if (result == '') {
						System_Notice('Error : ไม่สามารถบันทึกข้อมูลได้', 'danger');
					} else {
						$('#idAutoSave' + myuniqueid).html('<font color="#00AA00">' + result + '</font>');
						$('#idAutoSave' + myuniqueid).show("slide", {
							direction: 'right',
							easing: 'easeOutCirc'
						}, 500).delay(1000).fadeOut(1000);
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
				data: {
					myAjaxAction: 'set-tags',
					myAjaxKey: mytagsid,
					myAjaxID: '<?php echo $myID; ?>'
				},
				success: function(result) {
					if (result == 'yes') {
						$('#idTag' + mytagsid).switchClass("tagsNo", "tagsYes");
					}
					if (result == 'no') {
						$('#idTag' + mytagsid).switchClass("tagsYes", "tagsNo");
					}
				}
			});
		}
		//----------------------------------
		</script>
		<!---###############################################################################--->
		<form name="myRefreshForm" id="myRefreshForm" method="get" action="content.php">
			<input type="hidden" name="cid" id="cid" value="<?php echo $myID; ?>">
		</form>
		<form name="mySaveDraftForm" id="mySaveDraftForm" method="get" action="content.php">
			<input type="hidden" name="act" id="act" value="draft">
			<input type="hidden" name="cid" id="cid" value="<?php echo $myID; ?>">
		</form>
		<form name="mySavePublishForm" id="mySavePublishForm" method="get" action="content.php">
			<input type="hidden" name="act" id="act" value="publish">
			<input type="hidden" name="cid" id="cid" value="<?php echo $myID; ?>">
		</form>
		<?php
		if($test>0) {
		    ?>
		    <script>
		    $(window).scrollTop(<?php echo $test-50; ?>);
		    </script>
		    <?php
		}
		?>
		<!---###############################################################################--->
		<?php
		// Clear Caching //////////////////////////////////
		define('CONFIG_CACHE_PATH', "upload/htmlcaching/");
		define('CONFIG_CACHE_TIME', 5); // minute
		define('CONFIG_CACHE_FILE',md5("view.php?p=".$myID).".html");
		$Config_CacheFile=CONFIG_CACHE_PATH.'cached-'.CONFIG_CACHE_FILE;
		if (file_exists("../".$Config_CacheFile)) {
		    unlink("../".$Config_CacheFile);
		}
		///////////////////////////////////////////////////
		?>
		<br><br><br><br>
		<?php
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