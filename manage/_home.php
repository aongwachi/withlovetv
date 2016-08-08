<?php  if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } 
$System_LayoutUse="layout_manage.html";
$System_AjaxFileAction="ajax-home-loaddata.php";
$System_ShowAjaxIFrame=0;
$tid=trim($_REQUEST['tid']);
include_once("../_config/config_system.php");
include_once(SYSTEM_DOC_ROOT."system/core-start-ajax.php");
if($SystemSession_Staff_ID>0) { 
	//----------------------------------------------------------------------------------------------------------------
	include_once(SYSTEM_DOC_ROOT."system/core-start.php");
	include_once(SYSTEM_DOC_ROOT."system/core-body.php");
	//----------------------------------------------------------------------------------------------------------------
        ?>
	<br>
	<div class="pull-center padding-0 text-center" style=" max-width:1080px; ">
	<h1>โพสวันนี้</h1>
	</div>
	<div class="pull-center padding-10 text-center" style=" max-width:1080px; ">
		xxx
	</div>
        <?php
	//----------------------------------------------------------------------------------------------------------------
        include_once(SYSTEM_DOC_ROOT."object/oneinput/obj_oneinput_loader.php");
	include_once(SYSTEM_DOC_ROOT."system/core-end.php");
} else {
	$myObjectRedirectFormLink=SYSTEM_WEBPATH_ROOT."/manage/index.php";
	include_once(SYSTEM_DOC_ROOT."object/obj_redirect.php");
}
?>