<?php 
// Use For Web Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } 
$alert=$_REQUEST['alert'];
$inputUserName=$_REQUEST['inputUserName'];
$System_AjaxFileAction=SYSTEM_WEBPATH_ROOT."/manage/login.php";
$System_ShowAjaxIFrame=0;
?>
<div class="container-center-vertically" style="width:250px; height:600px; padding-top: 130px; ">
    <div class="bg-white border-radius-5 padding-20 text-center">
	<form id="myForm<?=$myKey?>" method="post" action="<?php echo SYSTEM_WEBPATH_ROOT; ?>/manage/login.php" target="frameInvisibleSubmit" onsubmit="
	if($('#inputUserName<?=$myKey?>').val()=='') { 
	    System_Notice('Error : กรุณากรอก UserName','danger');
	    return false;
	} 
	if($('#inputPassword<?=$myKey?>').val()=='') { 
	    System_Notice('Error : กรุณากรอก Password','danger');
	    return false;
	} 
	">
	<input type="hidden" name="redirectToYes" value="<?php echo SYSTEM_WEBPATH_ROOT; ?>/manage/index.php"  />
	<input type="hidden" name="redirectToNo" value="<?php echo SYSTEM_WEBPATH_ROOT; ?>/manage/index.php?alert=1"  /> 
        <?php if(0) { ?><div class="padding-10"><img src="<?php echo SYSTEM_WEBPATH_TEMPLATES; ?>/img/logos.png"></div><?php } ?>
        <div class="padding-10"><input type="text" name="inputUserName" id="inputUserName" class="form-control text-center obj_login02_input" placeholder="USERNAME" value="<?php echo $inputUserName; ?>" /></div>
        <div class="padding-10"><input type="password" name="inputPassword" id="inputPassword" class="form-control text-center obj_login02_input" placeholder="PASSWORD" value="" /></div>
        <div class="padding-10"><button type="submit" class="btn btn-primary btn-block btn-flat">Staff Login!</button></div>
		</form> 
    </div>
    <br><br><br><br>
</div>
