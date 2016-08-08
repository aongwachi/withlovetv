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
	ระบบเครือข่ายฐานข้อมูลโรคมะเร็ง</td>
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
	    <div class="padding-0 width-100 text-center">
		<img src="<?php echo SYSTEM_WEBPATH_TEMPLATES; ?>/img/logo-clound-index.png" class="pull-center" width="152" height="102" />
	    </div>
	    <div class="padding-10 width-100 text-center">
		<img src="<?php echo SYSTEM_WEBPATH_TEMPLATES; ?>/img/logo-text.png" class="img-responsive pull-center" style=" width: 100%; min-width:224px; max-width:533px; " />
		<br>
	    </div>
	    <button type="button" class="btn btn-primary btn-block btn-flat btn-lg" style=" height:80px; background-color: #0085ef; "
		onclick=" $('#idLogin1').hide(); $('#idLogin2').show(); ">เข้าสู่ระบบ</button>
	</div>
	<div style=" padding-bottom: 20px; padding-top: 20px; display: none; " id="idLogin2">
	    <div class="padding-0 width-100 text-center">
		<img src="<?php echo SYSTEM_WEBPATH_TEMPLATES; ?>/img/logo-clound-index.png" class="pull-center" width="152" height="102" />
	    </div>
	    <div class="padding-10 width-100 text-center">
		<img src="<?php echo SYSTEM_WEBPATH_TEMPLATES; ?>/img/logo-text.png" class="img-responsive pull-center" style=" width: 100%; min-width:224px; max-width:533px; " />
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
	    <td height="100" align="center"><h1>เข้าสู่ระบบ</h1> ระบบเครือข่ายฐานข้อมูลโรคมะเร็ง</td>
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
	    <td height="78" align="center"><div style=" margin-top: 14px; "><h1 style="font-size: 18px; ">เข้าสู่ระบบ</h1> ระบบเครือข่ายฐานข้อมูลโรคมะเร็ง</div></td>
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
	<div class="hidden-xs padding-10 logoarea">
	    <img src="<?php echo SYSTEM_WEBPATH_TEMPLATES; ?>/img/logo-text1.png" class="img-responsive" width="621" height="56" style=" width: 100%; max-width:621px; " />
	</div>
	<!--################################################################################-->
	<div class="panel-group width-100" id="accordion" role="tablist" aria-multiselectable="true">
	    <!------------------------------>
	    <div class="panel panel-info" style=" min-width:224px; ">
	    <div class="panel-heading cursor" role="tab" id="headingOne"  data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
	    <h2 class="panel-title text-left panelhead">
	    จำนวนผู้ป่วย ใน CA Care Cloud
	    </h2>
	    </div>
	    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
	    <div class="panel-body">
			<!-----------------------------------> 
			<table class="footable table-easy">
			<tbody>
			<tr class="odd">
			<td class="textlabelbig">ทั้งหมด</td>
			<td class="textvaluebig text-right">10,234</td>
			<td class="textvalue2 text-left">ราย</td>
			</tr>
			<tr>
			<td class="textlabelsmall">นับตั้งแต่ต้นปี 2557</td>
			<td class="textvaluesmall text-right">1,234</td>
			<td class="textvalue2 text-left">ราย</td>
			</tr>
			<tr class="odd">
			<td class="textlabelsmall">เดือนนี้ พ.ย. 2557</td>
			<td class="textvaluesmall text-right">34</td>
			<td class="textvalue2 text-left">ราย</td>
			</tr>
			<tr>
			<td class="textlabelsmall">สัปดาห์นี้</td>
			<td class="textvaluesmall text-right">4</td>
			<td class="textvalue2 text-left">ราย</td>
			</tr>
			<tr class="odd">
			<td class="textlabelsmall">วันนี้</td>
			<td class="textvaluesmall text-right">2</td>
			<td class="textvalue2 text-left">ราย</td>
			</tr>
			</tbody>
			</table>
			<!----------------------------------->
	    </div>
	    </div>
	    </div>
	    <!------------------------------>
	    <div class="panel panel-info" style=" min-width:224px; ">
	    <div class="panel-heading cursor" role="tab" id="headingTwo"  data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
	    <h2 class="panel-title text-left panelhead">
	    จำนวนผู้ป่วย วันนี้ <font color="#6666FF">2 ราย</font>
	    </h2>
	    </div>
	    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
	    <div class="panel-body">
			<!-----------------------------------> 
			<table class="footable table-easy">
			<tbody>
			<tr class="odd">
			<td class="textlabelsmall">ผู้ป่วยใน</td>
			<td class="textvaluesmall text-right">1</td>
			<td class="textvalue2 text-left">ราย</td>
			</tr>
			<tr>
			<td class="textlabelsmall">มาตามนัด</td>
			<td class="textvaluesmall text-right">1</td>
			<td class="textvalue2 text-left">ราย</td>
			</tr>
			<tr class="odd">
			<td class="textlabelsmall">Refer มา</td>
			<td class="textvaluesmall text-right">-</td>
			<td class="textvalue2 text-left">ราย</td>
			</tr>
			<tr>
			<td class="textlabelsmall">Walk-in</td>
			<td class="textvaluesmall text-right">-</td>
			<td class="textvalue2 text-left">ราย</td>
			</tr>
			</tbody>
			</table>
			<!----------------------------------->
	    </div>
	    </div>
	    </div>
	    <!------------------------------>
	    <div class="panel panel-info" style=" min-width:224px; ">
	    <div class="panel-heading cursor" role="tab" id="headingThree"  data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
	    <h2 class="panel-title text-left panelhead">
	    จำนวนผู้ป่วยจำแนกตามหน่วยบริการ
	    </h2>
	    </div>
	    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
	    <div class="panel-body">
			<!----------------------------------->
			<div class="content" style="height:245px;">
			<table class="footable table-easy">
			<thead>
			<tr>
			<th> </th>
			<th class="text-right">ทั้งหมด</th>
			<th class="text-right">ปีนี้</th>
			<th class="text-right">เดือนนี้</th>
			<th class="text-right">วันนี้</th>
			</tr>
			</thead>
			<tbody>
			<tr class="odd footable-disabled">
			<td class="textlabelbold" colspan="5">1. โรงพยาบาลศูนย์​ฯ ขอนแก่น</td>
			</tr>
			<tr>
			<td> </td>
			<td class="textvaluesmall text-right">20,234</td>
			<td class="textvaluesmall text-right">7,234</td>
			<td class="textvaluesmall text-right">834</td>
			<td class="textvaluesmall text-right">23</td>
			</tr>
			<tr class="odd footable-disabled">
			<td class="textlabelbold" colspan="5">2. โรงพยาบาลมะเร็ง อุดร</td>
			</tr>
			<tr>
			<td> </td>
			<td class="textvaluesmall text-right">20,234</td>
			<td class="textvaluesmall text-right">7,234</td>
			<td class="textvaluesmall text-right">834</td>
			<td class="textvaluesmall text-right">23</td>
			</tr>
			<tr class="odd footable-disabled">
			<td class="textlabelbold" colspan="5">3. โรงพยาบาลศรีนครินทร์</td>
			</tr>
			<tr>
			<td> </td>
			<td class="textvaluesmall text-right">20,234</td>
			<td class="textvaluesmall text-right">7,234</td>
			<td class="textvaluesmall text-right">834</td>
			<td class="textvaluesmall text-right">23</td>
			</tr>
			<tr class="odd footable-disabled">
			<td class="textlabelbold" colspan="5">4. โรงพยาบาล A</td>
			</tr>
			<tr>
			<td> </td>
			<td class="textvaluesmall text-right">20,234</td>
			<td class="textvaluesmall text-right">7,234</td>
			<td class="textvaluesmall text-right">834</td>
			<td class="textvaluesmall text-right">23</td>
			</tr>
			<tr class="odd footable-disabled">
			<td class="textlabelbold" colspan="5">5. โรงพยาบาล B</td>
			</tr>
			<tr>
			<td> </td>
			<td class="textvaluesmall text-right">20,234</td>
			<td class="textvaluesmall text-right">7,234</td>
			<td class="textvaluesmall text-right">834</td>
			<td class="textvaluesmall text-right">23</td>
			</tr>
			<tr class="odd footable-disabled">
			<td class="textlabelbold" colspan="5">6. โรงพยาบาล C</td>
			</tr>
			<tr>
			<td> </td>
			<td class="textvaluesmall text-right">20,234</td>
			<td class="textvaluesmall text-right">7,234</td>
			<td class="textvaluesmall text-right">834</td>
			<td class="textvaluesmall text-right">23</td>
			</tr>			
			<tr class="odd footable-disabled">
			<td class="textlabelbold" colspan="5">7. โรงพยาบาล D</td>
			</tr>
			<tr>
			<td> </td>
			<td class="textvaluesmall text-right">20,234</td>
			<td class="textvaluesmall text-right">7,234</td>
			<td class="textvaluesmall text-right">834</td>
			<td class="textvaluesmall text-right">23</td>
			</tr>			
			<tr class="odd footable-disabled">
			<td class="textlabelbold" colspan="5">8. โรงพยาบาล E</td>
			</tr>
			<tr>
			<td> </td>
			<td class="textvaluesmall text-right">20,234</td>
			<td class="textvaluesmall text-right">7,234</td>
			<td class="textvaluesmall text-right">834</td>
			<td class="textvaluesmall text-right">23</td>
			</tr>			
			<tr class="odd footable-disabled">
			<td class="textlabelbold" colspan="5">9. โรงพยาบาล F</td>
			</tr>
			<tr>
			<td> </td>
			<td class="textvaluesmall text-right">20,234</td>
			<td class="textvaluesmall text-right">7,234</td>
			<td class="textvaluesmall text-right">834</td>
			<td class="textvaluesmall text-right">23</td>
			</tr>			
			<tr class="odd footable-disabled">
			<td class="textlabelbold" colspan="5">10. โรงพยาบาล G</td>
			</tr>
			<tr>
			<td> </td>
			<td class="textvaluesmall text-right">20,234</td>
			<td class="textvaluesmall text-right">7,234</td>
			<td class="textvaluesmall text-right">834</td>
			<td class="textvaluesmall text-right">23</td>
			</tr>			
			</tbody>
			</table>
			</div>
			<!----------------------------------->
			<div class="padding-10 text-right" style=" color:#999999; ">จากทั้งหมด <font color="#6666FF">xxx</font> โรงพยาบาล
			<br class="visible-xs"> รวมผู้ป่วย <font color="#6666FF">xxx</font> ราย</div>
	    </div>
	    </div>
	    </div>
	    <!------------------------------>
	</div>
	<!--################################################################################-->	
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