<?php // Use For Web Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php  } ?>
<!--- Top Bar -------------->
<div class="Object_NavBarTop">
    <a href="javascript:void(0)" class="Object_NavBarRightLink" id="idLogoTop" onclick=" location.href='index.php'; ">
    <span class="navbar-brand cursor"></span></a>
</div>
<!--- Top Bar Right -------------->
<div id="idObject_NavBarRight" class="Object_NavBarRight" style=" width:260px;">    
    <!--------------------------------------------------------->
    <?php if(0) { ?>
    <div style=" padding:6px; padding-left: 3px; padding-right:3px; " class="pull-right">
    <button type="submit" class="btn btn-success btn-flat pull-right" onclick=" location.href='forgot-password.php'; " style=" font-size:16px; ">
    <span class="glyphicon glyphicon-exclamation-sign hidden-xs"></span> <small>ลืมรหัสผ่าน</small></button>
    </div>
    <!--------------------------------------------------------->
    <div style=" padding:6px; padding-left: 3px; padding-right:3px; " class="pull-right">
    <button type="submit" class="btn btn-success btn-flat pull-right" onclick=" location.href='register-member.php'; " style=" font-size:16px; ">
    <span class="fa fa-smile-o hidden-xs"></span> <small>สมัครสมาชิก</small></button>
    </div>
    <?php } ?>
    <!--------------------------------------------------------->    
    <div style=" width: 210px; height: 23px; padding-top:12px; padding-right:18px; " class="pull-right">
    <a href="<?php echo $session_login_url; ?>"><img src="<?php echo SYSTEM_WEBPATH_TEMPLATES; ?>/img/bt-fb-login.png" width="192" height="23" /></a>
    </div>
    <!--------------------------------------------------------->
</div>
