<?php // Use For Web Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php  } ?>
<form name="myObjectRedirectForm" id="myObjectRedirectForm" method="get" action="<?php echo $myObjectRedirectFormLink; ?>">
</form>
<script language="JavaScript" type="text/JavaScript">
autoSubmitTimer = setTimeout('submitMe()', 2*1000);
function submitMe() { document.myObjectRedirectForm.submit(); }
</script>