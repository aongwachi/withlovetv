<?php
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } 

header("Cache-Control: no-cache");
set_time_limit(0);

include_once("../_config/config_system.php");
include_once(SYSTEM_DOC_ROOT."system/core-start-ajax.php");

$inputUserName=trim($_POST['inputUserName']);
$inputPassword=trim($_POST['inputPassword']);
$redirectToYes= $_POST['redirectToYes'];
$redirectToNo= $_POST['redirectToNo'];
//------------------------------------------------------------------------------------------------------------
$sql = "SELECT * FROM ".TABLE_STAFF." WHERE ".TABLE_STAFF."_User='".$inputUserName."' ";
$Query=MYSQL_QUERY($sql) OR DIE("Error: $sql<br>\n");
$Row = mysql_fetch_array($Query);
$MID = $Row[TABLE_STAFF."_ID"];

$_SESSION['is_admin_logged'] = false;

if($MID>0) {
	$myPassword=$Row[TABLE_STAFF."_Pass"];
	$myUser=$Row[TABLE_STAFF."_User"];
	$myName=$Row[TABLE_STAFF."_Name"];
	$myLevel=$Row[TABLE_STAFF."_Level"];
	if($inputPassword==$myPassword) { // pass login
			$SystemSession_Staff_ID=$MID;
			$_SESSION[SS.'SystemSession_Staff_ID']=$SystemSession_Staff_ID;
			$SystemSession_Staff_User=$myUser;
			$_SESSION[SS.'SystemSession_Staff_User']=$SystemSession_Staff_User;
			$SystemSession_Staff_Name=$myName;
			$_SESSION[SS.'SystemSession_Staff_Name']=$SystemSession_Staff_Name;
			$SystemSession_Staff_Level=$myLevel;
			$_SESSION[SS.'SystemSession_Staff_Level']=$SystemSession_Staff_Level; 
			$myJumpTo=$redirectToYes;
			
			$_SESSION['is_admin_logged'] = true;
			
	} else { // login failed
		$alert=1;
		$myJumpTo=$redirectToNo;
	}
//------------------------------------------------------------------------------------------------------------
} else { // login failed
	$alert=1;
	$myJumpTo=$redirectToNo;
}
//------------------------------------------------------------------------------------------------------------
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body>
<?php if($alert==1) { ?>
<script> 
window.parent.System_Notice('Error : Username หรือ Password ไม่ถูกต้อง','danger'); 
</script>
<?php } else { ?>
[<?php echo $myJumpTo; ?>]
<form name="myRedirectForm" id="myRedirectForm" target="_top" method="get" action="<?php echo $myJumpTo; ?>"></form>
<script language="JavaScript" type="text/JavaScript">
autoSubmitTimer = setTimeout('submitMe()', 1*1000);
function submitMe() { document.myRedirectForm.submit(); }
</script>
<?php } ?>
</body>
</html>