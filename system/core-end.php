<?php 
// Use For Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } 

// Show Object On Body Top Layout ------------------------------
if(strpos(" ".$System_TemplatesBodyFooter,'[##object:')>0) {
	$arSystem_Temp=explode('[##object:',$System_TemplatesBodyFooter);
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
	echo $System_TemplatesBodyFooter;
}

// Prepare AjaxFileAction iFrame --------------------------------
if(isset($System_AjaxFileAction) && $System_AjaxFileAction<>"") {
	?>
	<form name="myAjaxForm" id="myAjaxForm" method="post" target="frameInvisibleSubmit" action="<?php echo $System_AjaxFileAction; ?>">
	<input type="hidden" id="myAjaxID" name="myAjaxID" value="" />
	<input type="hidden" id="myAjaxKey" name="myAjaxKey" value="" />
	<input type="hidden" id="myAjaxAction" name="myAjaxAction" value="" />
	<input type="hidden" id="myAjaxValue" name="myAjaxValue" value="" />
	</form>
	<iframe name="frameInvisibleSubmit" id="frameInvisibleSubmit" width="600" height="200" <?php if($System_ShowAjaxIFrame==1) { } else { echo ' style=" display:none; "'; } ?> 
    style=" right:20px; bottom:20px; position:fixed; "></iframe>
	<?php
} 
?>
<?php echo $System_TemplatesFoot; ?>
<!--- Footer Include File -------------->
<script type="text/javascript" src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/system/webtogo.js"></script>
<!--- Invisible Fload Area on the Top Page -------------->
<div class="system-fixalert-bar" id="id-system-fixalert-bar">
	<div id="System_Notice" class="system-bar-notice" style="display:none;">
		<div id="System_NoticeBox" class="system-notice-default"></div>
	</div> 
</div>
<!--- Invisible Fload Area on the Foot Page -------------->
<div class="system-status-bar" id="system-status-bar">&nbsp;</div>
<!-------------------------------------------------------->
</body>
</html>