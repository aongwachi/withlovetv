<?php // Use For Web Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php  } ?>
<?php 
if($SystemSession_Member_ID>0) { 
	include(SYSTEM_DOC_ROOT."object/obj_menu_main.php");
	?>

<script type="text/javascript">
// Left Bar Control Function ---------------------------
var isLeftBarBig;
var windowsize;
$(document).ready(function() {
	windowsize = $(window).width();
	// do Onload Status
	if (windowsize>579) {
		isLeftBarBig=1;
	} else {
		isLeftBarBig=0;
	}
	$('#idObjectNavBarLeft_LG').switchClass( "Object_NavBarLeftHide_LG", "Object_NavBarLeftShow_LG", 800); // slide in left bar
	$('#idObjectNavBarLeft_SM').switchClass( "Object_NavBarLeftHide_SM", "Object_NavBarLeftShow_SM", 800); // slide in left bar
	$('#idObjectNavBarLeft_SM [title]').tipsy({ trigger: 'hover', gravity: 'w', fade: true });
});
//---------------------------------
$(window).resize(function() {
//---------------------------------
	windowsize = $(window).width();
});
//--------------------------
function doToggleLeftBar() {
//--------------------------
	if (isLeftBarBig==1) {
		$('#idObjectNavBarLeft_SM').show();
		$('#idObjectNavBarLeft_LG').hide();
		$('#idContainerFullpageTop').css('padding-left','37px');
		isLeftBarBig=0;
	} else {
		$('#idObjectNavBarLeft_SM').hide();
		$('#idObjectNavBarLeft_LG').show();
		$('#idContainerFullpageTop').css('padding-left','141px');
		isLeftBarBig=1;
	}
}
</script>

<?php } ?>