<?php 
// Use For Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } 

######################################################
// Load System Config and Function
include_once(SYSTEM_DOC_ROOT."_function/function_system.php");
include_once(SYSTEM_DOC_ROOT."_session/session_system.php");

######################################################
// Select Templates Layout
if(!isset($System_LayoutUse) || $System_LayoutUse=="") { $System_LayoutUse=SYSTEM_WEB_TEMPLATE_HOME; }
######################################################
// Load Templaets
include_once(SYSTEM_DOC_ROOT."system/loadtemplates.php");
######################################################
// Load Module Config and Function
include_once(SYSTEM_DOC_ROOT."system/includeall-home.php");
?>