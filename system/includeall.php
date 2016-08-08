<?php 
// Use For Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } 

######################################################
// Load Module Session
######################################################
$System_ArrayFile="";
$System_ArrayFile=System_FileList("_session");
for($SystemI=0;$SystemI<sizeof($System_ArrayFile);$SystemI++) {
	if($System_ArrayFile[$SystemI]<>"session_system.php" && $System_ArrayFile[$SystemI]<>"" &&  strpos($System_ArrayFile[$SystemI],".php")>0) {
		include_once(SYSTEM_DOC_ROOT."_session/".$System_ArrayFile[$SystemI]);
	}
}

######################################################
// MySQL Database Connect
######################################################
include(SYSTEM_DOC_ROOT."system/connect.php");

######################################################
// Load Module Config
######################################################
$System_ArrayFile=System_FileList("_config");
for($SystemI=0;$SystemI<sizeof($System_ArrayFile);$SystemI++) {
	if($System_ArrayFile[$SystemI]<>"config_system.php" && $System_ArrayFile[$SystemI]<>"" &&  strpos($System_ArrayFile[$SystemI],".php")>0) {
		include_once(SYSTEM_DOC_ROOT."_config/".$System_ArrayFile[$SystemI]);
	}
}

######################################################
// Load Module Function 
######################################################
$System_ArrayFile="";
$System_ArrayFile=System_FileList("_function");
for($SystemI=0;$SystemI<sizeof($System_ArrayFile);$SystemI++) {
	if($System_ArrayFile[$SystemI]<>"function_system.php" && $System_ArrayFile[$SystemI]<>"" &&  strpos($System_ArrayFile[$SystemI],".php")>0) {
		include_once(SYSTEM_DOC_ROOT."_function/".$System_ArrayFile[$SystemI]);
	}
}

?>