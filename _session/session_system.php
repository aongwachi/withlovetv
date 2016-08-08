<?php
//header('Content-type: text/html; charset=utf-8');
// Set Session Limit --------------------------------
if(CONFIG_SESSION_TIMELIMIT>0) ini_set('session.gc_maxlifetime',60*CONFIG_SESSION_TIMELIMIT); 

// Set Start Session --------------------------------
if (!isset($_SESSION)) @session_start();

if (isset($_SESSION['facebook_access_token'])){	
	$facebook_access_token=$_SESSION['facebook_access_token'];
} else {
	$facebook_access_token=""; $_SESSION['facebook_access_token']="";
}
if (isset($_SESSION['facebook_long_lived_access_token'])){	
	$facebook_long_lived_access_token=$_SESSION['facebook_long_lived_access_token'];
} else {
	$facebook_long_lived_access_token=''; $_SESSION['facebook_long_lived_access_token']=''; 
}

// Load Web User Session ------------------------------
if (isset($_SESSION[SS.'SystemSession_Member_ID'])){	
	$SystemSession_Member_ID=$_SESSION[SS.'SystemSession_Member_ID'];
} else {
	$SystemSession_Member_ID=0; $_SESSION[SS.'SystemSession_Member_ID']=0; 
}
if (isset($_SESSION[SS.'SystemSession_Member_UID'])){	
	$SystemSession_Member_UID=$_SESSION[SS.'SystemSession_Member_UID'];
} else {
	$SystemSession_Member_UID=0; $_SESSION[SS.'SystemSession_Member_UID']=0; 
}
if (isset($_SESSION[SS.'SystemSession_Member_Name'])){	
	$SystemSession_Member_Name=$_SESSION[SS.'SystemSession_Member_Name'];
} else {											
	$SystemSession_Member_Name=""; $_SESSION[SS.'SystemSession_Member_Name']=""; 
}
if (isset($_SESSION[SS.'SystemSession_Member_Email'])){	
	$SystemSession_Member_Email=$_SESSION[SS.'SystemSession_Member_Email'];
} else {											
	$SystemSession_Member_Email=""; $_SESSION[SS.'SystemSession_Member_Email']=""; 
}
if (isset($_SESSION[SS.'SystemSession_Member_AddressID'])){	
	$SystemSession_Member_AddressID=$_SESSION[SS.'SystemSession_Member_AddressID'];
} else {
	$SystemSession_Member_AddressID=0; $_SESSION[SS.'SystemSession_Member_AddressID']=0;
}

// Load Staff Session ------------------------------
if (isset($_SESSION[SS.'SystemSession_Staff_ID'])){	
	$SystemSession_Staff_ID=$_SESSION[SS.'SystemSession_Staff_ID'];
} else {
	$SystemSession_Staff_ID=0; $_SESSION[SS.'SystemSession_Staff_ID']=0; 
}
if (isset($_SESSION[SS.'SystemSession_Staff_Name'])){	
	$SystemSession_Staff_Name=$_SESSION[SS.'SystemSession_Staff_Name'];
} else {
	$SystemSession_Staff_Name=""; $_SESSION[SS.'SystemSession_Staff_Name']="";
}
if (isset($_SESSION[SS.'SystemSession_Staff_User'])){	
	$SystemSession_Staff_User=$_SESSION[SS.'SystemSession_Staff_User'];
} else {
	$SystemSession_Staff_User=""; $_SESSION[SS.'SystemSession_Staff_User']="";
}
if (isset($_SESSION[SS.'SystemSession_Staff_Level'])){	
	$SystemSession_Staff_Level=$_SESSION[SS.'SystemSession_Staff_Level'];
} else {
	$SystemSession_Staff_Level=""; $_SESSION[SS.'SystemSession_Staff_Level']="";
}

// Load Cookies ------------------------------
if (!isset($_COOKIE['facebook_long_lived_access_token'])) { $_COOKIE['facebook_long_lived_access_token']=""; }

// File Man User Foloder Session -------------
if (isset($_SESSION['SESSION_FILEMAN_USERPATH'])){
	$SESSION_FILEMAN_USERPATH=$_SESSION['SESSION_FILEMAN_USERPATH'];
} else {
	$SESSION_FILEMAN_USERPATH=""; $_SESSION['SESSION_FILEMAN_USERPATH']="";
}

?>