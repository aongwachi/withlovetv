<?php 
// Use For Web Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } 

// Get Return Login Failed Variable ################################
$alert=$_REQUEST['alert'];
$inputUserName=$_REQUEST['inputUserName'];
$System_AjaxFileAction=SYSTEM_WEBPATH_ROOT."/login.php";
?>
<br />
<div class="row width-100">
    <div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-1 col-md-4 col-md-offset-1 col-lg-4 col-lg-offset-1 text-center hidden-xs">
	<!--################################################################################-->
	<?php $myKey=1; ?>
	<form id="myForm<?=$myKey?>" method="post" target="frameInvisibleSubmit" action="<?php echo SYSTEM_WEBPATH_ROOT; ?>/login.php"  onsubmit="
	if($('#inputUserName<?=$myKey?>').val()=='') { 
	    System_Notice('Error : กรุณากรอก UserName','danger');
	    return false;
	} 
	if($('#inputPassword<?=$myKey?>').val()=='') { 
	    System_Notice('Error : กรุณากรอก Password','danger');
	    return false;
	} 
	">
	<input type="hidden" name="redirectToYes" value="<?php echo SYSTEM_WEBPATH_ROOT; ?>/index.php"  />
	<input type="hidden" name="redirectToNo" value="<?php echo SYSTEM_WEBPATH_ROOT; ?>/index.php?alert=1"  /> 
	<table width="319" height="513" border="0" align="center" cellpadding="0" cellspacing="0" background="<?php echo SYSTEM_WEBPATH_TEMPLATES; ?>/img/object-login01-bg.png">
	<tr>
	<td height="111" align="center">&nbsp;</td>
	</tr>
	<tr>
	<td height="100" align="center"><h1>ยินดีต้อนรับสู่</h1>
	CASCAP Cloud</td>
	</tr>
	<tr>
	<td height="86" align="center">
	<input type="text" name="inputUserName" id="inputUserName<?=$myKey?>" class="form-control input_obj_login01 fixform-noborder" value="<?php echo $inputUserName; ?>" style="width:180px; " placeholder="USERNAME" />
	</td>
	</tr>
	<tr>
	<td height="85" align="center">
	<input type="password" name="inputPassword" id="inputPassword<?=$myKey?>" class="form-control input_obj_login01 fixform-noborder" value="" style="width:180px; " placeholder="PASSWORD" />
	</td>
	</tr>
	<tr>
	<td align="center">
	<input type="submit" name="button" id="button" value="" class="input_obj_login01_bt" />
	</td>
	</tr>
	</table>
	</form>
	<!--################################################################################-->
    </div>    
    <div class="col-xs-10 col-xs-offset-1 col-sm-5 col-sm-offset-1 col-md-5 col-md-offset-1 col-lg-5 col-lg-offset-1 text-center visible-xs">
	<!--################################################################################-->
	<div style=" padding-bottom: 20px; padding-top: 20px; " id="idLogin1">
	    <div class="padding-10 width-100 text-center">
		<br>
		<img src="<?php echo SYSTEM_WEBPATH_TEMPLATES; ?>/img/logo-clound-index.png" class="pull-center" width="152" height="102" />
		<br>
	    </div>
	    <button type="button" class="btn btn-primary btn-block btn-flat btn-lg" style=" height:80px; background-color: #0085ef; "
		onclick=" $('#idLogin1').hide(); $('#idLogin2').show(); ">เข้าสู่ระบบ</button>
	</div>
	<div style=" padding-bottom: 20px; padding-top: 20px; display: none; " id="idLogin2">
	    <div class="padding-0 width-100 text-center">
		<img src="<?php echo SYSTEM_WEBPATH_TEMPLATES; ?>/img/logo-clound-index.png" class="pull-center" width="152" height="102" />
		<br>
	    </div>
	    <!--################################################################################-->
	    <div id="idLoginBoxBig">
	    <?php $myKey=2; ?>
	    <form id="myForm<?=$myKey?>" method="post" target="frameInvisibleSubmit" action="<?php echo SYSTEM_WEBPATH_ROOT; ?>/login.php"  onsubmit="
	    if($('#inputUserName<?=$myKey?>').val()=='') { 
		System_Notice('Error : กรุณากรอก UserName','danger');
		return false;
	    } 
	    if($('#inputPassword<?=$myKey?>').val()=='') { 
		System_Notice('Error : กรุณากรอก Password','danger');
		return false;
	    } 
	    ">
	    <input type="hidden" name="redirectToYes" value="<?php echo SYSTEM_WEBPATH_ROOT; ?>/index.php"  />
	    <input type="hidden" name="redirectToNo" value="<?php echo SYSTEM_WEBPATH_ROOT; ?>/index.php?alert=1"  /> 
	    <table width="319" height="513" border="0" align="center" cellpadding="0" cellspacing="0" background="<?php echo SYSTEM_WEBPATH_TEMPLATES; ?>/img/object-login01-bg.png">
	    <tr>
	    <td height="111" align="center">&nbsp;</td>
	    </tr>
	    <tr>
	    <td height="100" align="center"><h1>เข้าสู่ระบบ</h1> CASCAP Cloud</td>
	    </tr>
	    <tr>
	    <td height="86" align="center">
	    <input type="text" name="inputUserName" id="inputUserName<?=$myKey?>" class="form-control input_obj_login01 fixform-noborder" value="<?php echo $inputUserName; ?>" style=" width:180px; " placeholder="USERNAME" />
	    </td>
	    </tr>
	    <tr>
	    <td height="85" align="center">
	    <input type="password" name="inputPassword" id="inputPassword<?=$myKey?>" class="form-control input_obj_login01 fixform-noborder" value="" style=" width:180px; " placeholder="PASSWORD" />
	    </td>
	    </tr>
	    <tr>
	    <td align="center">
	    <input type="submit" name="button" id="button" value="" class="input_obj_login01_bt" />
	    </td>
	    </tr>
	    </table>
	    </form>
	    </div>
	    <!--################################################################################-->
	    <div id="idLoginBoxSmall">
	    <?php $myKey=3; ?>
	    <form id="myForm<?=$myKey?>" method="post" target="frameInvisibleSubmit" action="<?php echo SYSTEM_WEBPATH_ROOT; ?>/login.php"  onsubmit="
	    if($('#inputUserName<?=$myKey?>').val()=='') { 
		System_Notice('Error : กรุณากรอก UserName','danger');
		return false;
	    } 
	    if($('#inputPassword<?=$myKey?>').val()=='') { 
		System_Notice('Error : กรุณากรอก Password','danger');
		return false;
	    } 
	    ">
	    <input type="hidden" name="redirectToYes" value="<?php echo SYSTEM_WEBPATH_ROOT; ?>/index.php"  />
	    <input type="hidden" name="redirectToNo" value="<?php echo SYSTEM_WEBPATH_ROOT; ?>/index.php?alert=1"  /> 
	    <table width="223" height="335" border="0" align="center" cellpadding="0" cellspacing="0" background="<?php echo SYSTEM_WEBPATH_TEMPLATES; ?>/img/object-login01-small-bg.png">
	    <tr>
	    <td height="59" align="center">&nbsp;</td>
	    </tr>
	    <tr>
	    <td height="78" align="center"><div style=" margin-top: 14px; "><h1 style="font-size: 18px; ">เข้าสู่ระบบ</h1>
	    CASCAP Cloud</div></td>
	    </tr>
	    <tr>
	    <td height="65" align="center">
	    <input type="text" name="inputUserName" id="inputUserName<?=$myKey?>" class="form-control input_obj_login01 fixform-noborder" value="<?php echo $inputUserName; ?>" style=" width:160px; " placeholder="USERNAME" />
	    </td>
	    </tr>
	    <tr>
	    <td height="65" align="center">
	    <input type="password" name="inputPassword" id="inputPassword<?=$myKey?>" class="form-control input_obj_login01 fixform-noborder" value="" style=" width:160px; " placeholder="PASSWORD" />
	    </td>
	    </tr>
	    <tr>
	    <td align="center">
	    <input type="submit" name="button" id="button" value="" class="input_obj_login01_bt_small" />
	    </td>
	    </tr>
	    </table>
	    </form>
	    </div>
	    <!--################################################################################-->
	</div>
	<!--################################################################################-->
    </div>    
    <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-1 col-md-6 col-md-offset-0 col-lg-6 col-lg-offset-0 text-center">
    	<br />
    	<br />
    	<br />
	<img src="<?php echo SYSTEM_WEBPATH_TEMPLATES; ?>/img/text-big-teleradiology.png" width="364" height="262" class="img-responsive pull-center" />
    </div>    
</div>
<!-------------------------------------------------------->
<link type="text/css" rel="stylesheet" href="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/footable/footable.core.css">
<script type="text/javascript" src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/footable/footable.js"></script>
<!-------------------------------------------------------->
<script type="text/javascript">
//------------------------
function msieversion() {
//------------------------
        var ua = window.navigator.userAgent;
        var msie = ua.indexOf("MSIE ");
        if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
            version=parseInt(ua.substring(msie + 5, ua.indexOf(".", msie)));
	    if (version<=8) {
		$('#System_NoticeBox').removeAttr('class').attr('class', '');
		$('#System_NoticeBox').addClass('system-notice-danger');
		$('#System_NoticeBox').html('<b>CACareCloud.org</b><br>รองรับบราวเซอร์ IE9 ขึ้นไป <br>เราแนะนำให้ใช้ Chrome แทน<br><br>ขออภัยในความไม่สะดวก');
		$('#System_Notice').show('fast');
		return false;
	    }    
	}
	return true;
}
$(document).ready(function() {
	$('.footable').footable();
        $(".content").mCustomScrollbar({ theme:"dark-thick" });
	msieversion();
});
</script>
<br />
<br />