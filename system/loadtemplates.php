<?php
######################################################
// Load Templates From Layout
######################################################
$arSystem_Templates=System_ShowLayout($System_LayoutUse);
$System_TemplatesBody=$arSystem_Templates['body'];
$System_TemplatesHead=$arSystem_Templates['head'];
$System_TemplatesFoot=$arSystem_Templates['foot'];

######################################################
// Replace Path and Echo Variable on Layout
######################################################
$System_TemplatesBody=str_replace('[##system-webpath-root##]',SYSTEM_WEBPATH_ROOT,$System_TemplatesBody);
$System_TemplatesBody=str_replace('[##system-webpath-templates##]',SYSTEM_WEBPATH_TEMPLATES,$System_TemplatesBody);
// Show Echo Variable On Layout ----------------------------------------------------
if(strpos(" ".$System_TemplatesBody,'[##$')>0) {
	$arSystem_Temp=explode('[##$',$System_TemplatesBody);
	for($SystemI=1;$SystemI<sizeof($arSystem_Temp);$SystemI++) {
		$arSystem_Temp1=explode('##]',$arSystem_Temp[$SystemI]);	
		$System_TemplatesBody=str_replace('[##$'.$arSystem_Temp1[0].'##]',$$arSystem_Temp1[0],$System_TemplatesBody);
	}	
}
?>