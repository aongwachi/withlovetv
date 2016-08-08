<?php 
error_reporting(1);
// Use For Editor Set Current Character Set as UTF-8 #################

//ini_set(session.save_path, $_SERVER["DOCUMENT_ROOT"].'/_session_temp');

date_default_timezone_set("Asia/Bangkok");

if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } 

if (!isset($_SESSION)) @session_start();

## Site Session Definition ###################################################
define('SS','BB'); // Site Session Name , Leave blank for use one session for multi-site
 
## Database Definition #################################################
define('SYSTEM_DB_HOSTNAME','localhost'); // host
define('SYSTEM_DB_USERNAME','root'); // user
define('SYSTEM_DB_PASSWORD','root'); // password
define('SYSTEM_DB_NAME','mydb'); // database name
define('SYSTEM_DB_PREFIX','tv'); // Use for 2 or more website in one database

## Website Config -----------------------------------------------------
define('SYSTEM_WEB_DOMAIN','allfashionthai.com');
define('SYSTEM_WEB_PATH_FULL','www.allfashionthai.com');
define('SYSTEM_WEBPATH_ROOT','/withlovetv'); // default use blank '' 
define('SYSTEM_WEB_TITLE','ด้วยรักทีวี');
define('SYSTEM_WEB_KEYWORD','ด้วยรักทีวี');
define('SYSTEM_WEB_DESCRIPTION','ด้วยรักทีวี');
define('SYSTEM_WEB_CDN_PATH_FULL','http://www.allfashionthai.com');

## Website Template --------------------------------------------------
define('SYSTEM_WEB_TEMPLATE','bb');
define('SYSTEM_WEB_TEMPLATE_HOME','layout_web.html'); 
define('SYSTEM_JQUERY_UI_THEME','cupertino');
define('SYSTEM_JQUERY_PACE_THEME','pace.theme.black.atom.css');

// --------------------------------------------------------------------
define('CONFIG_SESSION_TIMELIMIT',24*60); // Session Time Limit in Minute.
define('CONFIG_PAGESIZE',30); // Show Record per page
define('CONFIG_ADD_HOUR',0); // Show Record per page

$System_RelativePath=Sytem_FindRelativePath();
// Config Path -------------------------------------------------------
define('SYSTEM_DOC_ROOT',$System_RelativePath);
define('SYSTEM_WEBPATH_TEMPLATES',SYSTEM_WEBPATH_ROOT."/templates/".SYSTEM_WEB_TEMPLATE); 
$System_RelativePath_template=str_replace('//','/',SYSTEM_DOC_ROOT.SYSTEM_WEBPATH_TEMPLATES);
if(SYSTEM_WEBPATH_ROOT<>'') { $System_RelativePath_template=str_replace(SYSTEM_WEBPATH_ROOT.'/','/',$System_RelativePath_template); }
if(substr($System_RelativePath_template,0,1)=='/') { $System_RelativePath_template=substr($System_RelativePath_template,1,strlen($System_RelativePath_template)+1); }
define('SYSTEM_RELATIVEPATH_TEMPLATES',$System_RelativePath_template);

// Security -------------------------------------------------------
define('SYSTEM_CONFIG_KEY','2mr7PB38K56M3bu'); // get a new key from StrongPasswordGenerator.com

########################################
function Sytem_FindRelativePath() {
########################################
	$myPath = str_replace("\\","/",str_replace("#".$_SERVER['DOCUMENT_ROOT'],"","#".$_SERVER['SCRIPT_FILENAME']));
	$myPath = str_replace(basename($_SERVER['SCRIPT_FILENAME']),'',$myPath);
	$myPath = str_replace('#'.SYSTEM_WEBPATH_ROOT,'','#'.$myPath);
	$arTmp = explode('/',$myPath);
	$myRelativePath='';
	for($i=2;$i<=(sizeof($arTmp)-1);$i++) { $myRelativePath.='../'; }
	return $myRelativePath;
}
?>
