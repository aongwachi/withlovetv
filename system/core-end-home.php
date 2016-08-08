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
?>
<?php echo $System_TemplatesFoot; ?>
<!--- Footer Include File -------------->
<script type="text/javascript" src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/system/webtogo.js"></script>
<!-------------------------------------------------------->