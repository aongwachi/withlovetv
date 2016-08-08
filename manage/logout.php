<?php
include_once("../_config/config_system.php");
include_once(SYSTEM_DOC_ROOT."system/core-start-ajax.php");
session_destroy();
if (!isset($_SESSION)) @session_start();
$_SESSION[SS.'SystemSession_Staff_ID']=0; 
$_SESSION[SS.'SystemSession_Staff_User']="";
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<body>
Redirecting..
<script type="text/javascript">
location.href='index.php';
</script>
<form name="myRedirectForm" id="myRedirectForm" method="get" action="index.php"></form>
<script language="JavaScript" type="text/JavaScript">
autoSubmitTimer = setTimeout('submitMe()', 1*1000);
function submitMe() { document.myRedirectForm.submit(); }
</script>
</body>
</html>