<?php  if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } 
$System_LayoutUse="layout_index.html";
$System_Title="Car Pool";

include_once("../../_config/config_system.php");
include_once(SYSTEM_DOC_ROOT."system/core-start.php");
include_once(SYSTEM_DOC_ROOT."system/core-body.php");
################################################################
	?>
    <br /><br />
	<link rel="stylesheet" href="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/crop-avatar/cropper.min.css">
	<link rel="stylesheet" href="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/crop-avatar/crop-avatar.css">
    <div class="text-center">
    <!-- ############################################################################ -->
    <h1>Thumbnail 1</h1>
	<?php
	$idCropAvatar=1; $myWidth=150; $myHeight=150;
	include(SYSTEM_DOC_ROOT."object/inc_crop_avatar_picture.php");
	?>
    <br />
    <br />
    <!-- ############################################################################ -->
    <h1>Thumbnail 2</h1>
	<?php
	$idCropAvatar=2; $myWidth=150; $myHeight=150;
	include(SYSTEM_DOC_ROOT."object/inc_crop_avatar_picture.php");
	?>
    <br />
    <br />
    <!-- ############################################################################ -->
	<?php
	include(SYSTEM_DOC_ROOT."object/inc_crop_avatar_script.php");
	?>
    </div>
    <script>
	var idCropAvatar=0;
	//-----------------------------------
	function doCropAvatarEnd(myFile) {
	//-----------------------------------
		alert(idCropAvatar+" : "+myFile);
	}
    </script>
	<?php
################################################################
include_once(SYSTEM_DOC_ROOT."system/core-end.php");
?>