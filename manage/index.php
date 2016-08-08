<?php if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php }
$System_LayoutUse="layout_manage.html";
include_once("../_config/config_system.php");
include_once(SYSTEM_DOC_ROOT."system/core-start.php");
include_once(SYSTEM_DOC_ROOT."system/core-body.php");
if($SystemSession_Staff_ID>0) {
	$myObjectRedirectFormLink=SYSTEM_WEBPATH_ROOT."/manage/home.php";
	include_once(SYSTEM_DOC_ROOT."object/obj_redirect.php");
} else {
	?>
	<div class="width-100 height-100">
	<div class="width-100 container-fullpage-middle">
	<?php include_once(SYSTEM_DOC_ROOT."object/obj_login_basic.php"); ?>
	</div>
	</div>
	<?php
}
include_once(SYSTEM_DOC_ROOT."system/core-end.php");
?>