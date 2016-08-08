<?php 
// Use For Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } 
?>
<?=SYSTEM_DOCTYPE?>
<html <?=SYSTEM_HTML?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if(!isset($System_Title) || $System_Title=="") { $System_Title=SYSTEM_WEB_TITLE; } echo $System_Title; ?></title>
<script type="text/javascript" src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/js/jquery-ui.1.11.0.min.js"></script>
<script type="text/javascript" src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/js/jquery.tipsy.js"></script>
<script type="text/javascript" src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/js/dropit.js"></script>
<script type="text/javascript" src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/js-pace/pace.min.js"></script>
<script type="text/javascript" src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/js-toastr/toastr.js"></script>
<link rel="stylesheet" href="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/bootstrap/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/bootstrap/bootstrap-theme.css">
<link rel="stylesheet" href="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/bootstrap/bootstrap.theme.icon.more.css">
<link rel="stylesheet" href="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/js-ui-themes/<?php echo SYSTEM_JQUERY_UI_THEME; ?>/jquery-ui.min.css">
<link rel="stylesheet" href="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/js-ui-themes/<?php echo SYSTEM_JQUERY_UI_THEME; ?>/theme.css">
<link rel="stylesheet" href="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/js/dropit.css">
<link rel="stylesheet" href="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/js/tipsy.css">
<link rel="stylesheet" href="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/js/jquery.mCustomScrollbar.css">
<link rel="stylesheet" href="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/js-toastr/toastr.css">
<link rel="stylesheet" href="<?php echo SYSTEM_WEBPATH_ROOT; ?>/system/webtogo.css">
<link rel="stylesheet" href="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/js-pace/<?php echo SYSTEM_JQUERY_PACE_THEME; ?>">
<!-- Bootstrap -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]--><?=$System_TemplatesHead?></head>
<body id="idSystemBody"><?php

// Cut Layout Into Two Piece ------------------------------------
if(strpos(" ".$System_TemplatesBody,'[##area:bodycontent##]')>0) {
	$arSystem_Temp=explode('[##area:bodycontent##]',$System_TemplatesBody);
	$System_TemplatesBodyTop=$arSystem_Temp[0];
	$System_TemplatesBodyFooter=$arSystem_Temp[1];
	// Show Object On Body Top Layout ------------------------------
	if(strpos(" ".$System_TemplatesBodyTop,'[##object:')>0) {
		$arSystem_Temp=explode('[##object:',$System_TemplatesBodyTop);
		echo $arSystem_Temp[0];
		for($SystemI=1;$SystemI<sizeof($arSystem_Temp);$SystemI++) {
			$arSystem_Temp1=explode('##]',$arSystem_Temp[$SystemI]);
			//echo '<div ondblclick=" System_ShowStatus(\'&nbsp;&nbsp;<b>'.$System_LayoutUse.'</b>&nbsp;:&nbsp;'.$arSystem_Temp1[0].'\'); ">';
			@include(SYSTEM_DOC_ROOT."object/".$arSystem_Temp1[0]);
			//echo '</div>';
			echo $arSystem_Temp1[1];
		}
	} else {
		// No Object Include
		echo $System_TemplatesBodyTop;
	}
} else {
	// No Body Content
	$System_TemplatesBodyFooter=$System_TemplatesBody;
}
?>