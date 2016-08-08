<?php 
// Use For Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } 

#####################
function file_get_contents_curl($url) {
#####################
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);       

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}

#####################
function isValidEmail($email){ 
#####################
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}
#####################
function getFolderPath($mySKU,$myType) {
#####################
	if($myType=='unm') { $myFilePath = "upload/".FOLDER_UNM; }
	if($myType=='pinkpeach') { $myFilePath = "upload/".FOLDER_PINKPEACH; }
	if($myType=='own') { $myFilePath = "upload/".FOLDER_OWN; }
	if($myType=='DropShop') { $myFilePath = "photo/".FOLDER_DROPSHOP; }
	$fold1=substr($mySKU,0,2);
	$fold2=substr($mySKU,2,2);
	return $myFilePath."/".$fold1."/".$fold2;
}
#####################
function upto9($myval) {
#####################
	$myval=ceil($myval);
	$faction = $myval%10;
	if($faction==0) { return $myval; }
	if($faction<=5) { return $myval-$faction+5; }
	return ceil($myval/10)*10;
}

//#################################################
function System_Encode($myCode) {
//#################################################
	return $myCode;
	//return base64_encode(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5(SYSTEM_CONFIG_KEY), $myCode, MCRYPT_MODE_CBC, md5(md5(SYSTEM_CONFIG_KEY)))));
}
//#################################################
function System_Decode($myCode) {
//#################################################
	return $myCode;
	return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5(SYSTEM_CONFIG_KEY), base64_decode(base64_decode($myCode)), MCRYPT_MODE_CBC, md5(md5(SYSTEM_CONFIG_KEY))), "\0");
}
include_once(SYSTEM_DOC_ROOT."lib/php-classes/color_harmony.class.php");
$System_ColorHarmony=new colorHarmony;
//#################################################
function System_ColorDarker($myColor) {
//#################################################
	$myColor=str_replace('#','',$myColor);
	$myHEX1=substr($myColor,0,2);
	$myHEX2=substr($myColor,2,2);
	$myHEX3=substr($myColor,4,2);
	$myDEC1=hexdec($myHEX1)-12; if($myDEC1>255) { $myDEC1=255; } if($myDEC1<0) { $myDEC1=0; }
	$myDEC2=hexdec($myHEX2)-12; if($myDEC2>255) { $myDEC2=255; } if($myDEC2<0) { $myDEC2=0; }
	$myDEC3=hexdec($myHEX3)-12; if($myDEC3>255) { $myDEC3=255; } if($myDEC3<0) { $myDEC3=0; }
	$myHEX1=dechex($myDEC1); if(strlen($myHEX1)==1) { $myHEX1='0'.$myHEX1; }
	$myHEX2=dechex($myDEC2); if(strlen($myHEX2)==1) { $myHEX2='0'.$myHEX2; }
	$myHEX3=dechex($myDEC3); if(strlen($myHEX3)==1) { $myHEX3='0'.$myHEX3; }
	return strtoupper('#'.$myHEX1.$myHEX2.$myHEX3);
}
//#################################################
function System_ColorLighter($myColor) {
//#################################################
	$myColor=str_replace('#','',$myColor);
	$myHEX1=substr($myColor,0,2);
	$myHEX2=substr($myColor,2,2);
	$myHEX3=substr($myColor,4,2);
	$myDEC1=hexdec($myHEX1); 
	$myDEC2=hexdec($myHEX2); 
	$myDEC3=hexdec($myHEX3); 
	$myDEC1=hexdec($myHEX1)+12; if($myDEC1>255) { $myDEC1=255; } if($myDEC1<0) { $myDEC1=0; }
	$myDEC2=hexdec($myHEX2)+12; if($myDEC2>255) { $myDEC2=255; } if($myDEC2<0) { $myDEC2=0; }
	$myDEC3=hexdec($myHEX3)+12; if($myDEC3>255) { $myDEC3=255; } if($myDEC3<0) { $myDEC3=0; }
	$myHEX1=dechex($myDEC1); if(strlen($myHEX1)==1) { $myHEX1='0'.$myHEX1; }
	$myHEX2=dechex($myDEC2); if(strlen($myHEX2)==1) { $myHEX2='0'.$myHEX2; }
	$myHEX3=dechex($myDEC3); if(strlen($myHEX3)==1) { $myHEX3='0'.$myHEX3; }
	return strtoupper('#'.$myHEX1.$myHEX2.$myHEX3);
}
//#################################################
function System_ChooseContrastColor($myColorBackground,$myColorDark,$myColorLight) {
//#################################################
	$myColorBackground=str_replace('#','',$myColorBackground);
	$myHEX1=substr($myColorBackground,0,2);
	$myHEX2=substr($myColorBackground,2,2);
	$myHEX3=substr($myColorBackground,4,2);
	$myDEC1=hexdec($myHEX1);
	$myDEC2=hexdec($myHEX2);
	$myDEC3=hexdec($myHEX3);
	if(($myDEC1+$myDEC2+$myDEC3)>=385) { // total color is light
		return $myColorDark;
	} else {
		return $myColorLight;
	}
}
########################################
function System_GetTheme($myHEX) { // HEX with # , ex. #FFDD22
########################################
	global $System_ColorHarmony;
	if(strpos(" ".$myHEX,'#')==0) { $myHEX='#'.$myHEX; }
	$RH1=$System_ColorHarmony->Monochromatic(strtolower($myHEX));
	$arReturn = array(strtoupper($RH1[2]),strtoupper($RH1[0]),strtoupper($RH1[1]),strtoupper($RH1[3]));
	return $arReturn;
} 
//#################################################
function System_RandomColor() {
//#################################################
	global $arSystem_ThemeColor; 
	$myrand = rand(1,sizeof($arSystem_ThemeColor)-1);
	$myShuffle=$arSystem_ThemeColor;
	shuffle($myShuffle);
	return $myShuffle[$myrand];
}
########################################
function System_FileList($folder) {
########################################
	$path=SYSTEM_DOC_ROOT.$folder."/";
	$arTmp="";
	if(is_dir($path) && $handle = opendir($path)) {
	while ($file = readdir($handle)) {
	if ($file != "." && $file != "..") { $arTmp[]=$file; } } }
	closedir($handle);
	return $arTmp;
}
########################################
function System_ShowLayout($System_LayoutUse) {
########################################
	$templatespath=SYSTEM_WEBPATH_TEMPLATES.'/';
	$path=SYSTEM_RELATIVEPATH_TEMPLATES."/".$System_LayoutUse;
	$cached=fopen($path,"r");
	$content=fread($cached,filesize($path));
	fclose($cached);
	//- Cut for Head Layout ------------------------------------------------------
	if(strpos(' '.$content,'<!--@@SystemLayoutStart:Head@@-->')>0) {
		$arTmp=explode('<!--@@SystemLayoutStart:Head@@-->',$content);
		$arTmp=explode('<!--@@SystemLayoutEnd:Head@@-->',$arTmp[1]);
		$htmlHead=$arTmp[0];
	}
	$htmlHead=str_replace(' src="',' src="'.$templatespath,$htmlHead);
	$htmlHead=str_replace(' href="',' href="'.$templatespath,$htmlHead);
	$htmlHead=str_replace(' src="'.$templatespath."http",' src="http',$htmlHead);
	$htmlHead=str_replace(' href="'.$templatespath."http",' href="http',$htmlHead);
	//- Cut for Body Layout ------------------------------------------------------
	if(strpos(' '.$content,'<!--@@SystemLayoutStart:Body@@-->')>0) {
		$arTmp=explode('<!--@@SystemLayoutStart:Body@@-->',$content);
		$arTmp=explode('<!--@@SystemLayoutEnd:Body@@-->',$arTmp[1]);
		$htmlBody=$arTmp[0];
	}
	//- Cut for Body Layout ------------------------------------------------------
	if(strpos(' '.$content,'<!--@@SystemLayoutStart:Foot@@-->')>0) {
		$arTmp=explode('<!--@@SystemLayoutStart:Foot@@-->',$content);
		$arTmp=explode('<!--@@SystemLayoutEnd:Foot@@-->',$arTmp[1]);
		$htmlFoot=$arTmp[0];
	}
	$htmlFoot=str_replace(' src="',' src="'.$templatespath,$htmlFoot);
	$htmlFoot=str_replace(' href="',' href="'.$templatespath,$htmlFoot);
	$htmlFoot=str_replace(' src="'.$templatespath."http",' src="http',$htmlFoot);
	$htmlFoot=str_replace(' href="'.$templatespath."http",' href="http',$htmlFoot);
	$arReturn="";
	$arReturn['head']=$htmlHead;
	$arReturn['body']=$htmlBody;
	$arReturn['foot']=$htmlFoot;
	return $arReturn;
}

###############################
function System_getWeekDayNow() {
###############################
	// 0 (for Sunday) through 6 (for Saturday)
	$today1=getdate();
	$Day=$today1['mday'];
	$Month=$today1['mon'];
	$Year=$today1['year'];
	$SS=$today1['seconds'];
	$MM=$today1['minutes'];
	$HH=$today1['hours'];

	$today=getdate(mktime($HH,$MM,$SS,$Month,$Day,$Year));
	$wday=$today['wday'];

	return($wday);
}
###############################
function System_getDateNow() {
###############################
	$today1=getdate();
	$Day=$today1['mday'];
	$Month=$today1['mon'];
	$Year=$today1['year'];
	$SS=$today1['seconds'];
	$MM=$today1['minutes'];
	$HH=$today1['hours'];

	$today=getdate(mktime($HH+CONFIG_ADD_HOUR,$MM,$SS,$Month,$Day,$Year));
	$Day=$today['mday'];
	$Month=$today['mon'];
	$Year=$today['year'];
	$SS=$today['seconds'];
	$MM=$today['minutes'];
	$HH=$today['hours'];

	$DateIs=sprintf("%04d-%02d-%02d",$Year,$Month,$Day);
	return($DateIs);
}
###############################
function System_getTimeNow() {
###############################
	$today1=getdate();
	$Day=$today1['mday'];
	$Month=$today1['mon'];
	$Year=$today1['year'];
	$SS=$today1['seconds'];
	$MM=$today1['minutes'];
	$HH=$today1['hours'];

	$today=getdate(mktime($HH+CONFIG_ADD_HOUR,$MM,$SS,$Month,$Day,$Year));
	$Day=$today['mday'];
	$Month=$today['mon'];
	$Year=$today['year'];
	$SS=$today['seconds'];
	$MM=$today['minutes'];
	$HH=$today['hours'];

	$DateIs=sprintf("%02d:%02d:%02d",$HH,$MM,$SS);
	return($DateIs);
}
##############################################################
define('SYSTEM_WEEKDAYNOW',System_getWeekDayNow());
define('SYSTEM_DATENOW',System_getDateNow());
define('SYSTEM_TIMENOW',System_getTimeNow());
define('SYSTEM_DATETIMENOW',SYSTEM_DATENOW." ".SYSTEM_TIMENOW);
##############################################################

##########################################
function System_DateTimeDiff($myDateTimeFrom,$myDateTimeTo) {
##########################################
	$fromArray = explode(" ",$myDateTimeFrom);
	$fromDateArray = explode("-",$fromArray[0]);
	$fromTimeArray = explode(":",$fromArray[1]);

	$toArray = explode(" ",$myDateTimeTo);
	$toDateArray = explode("-",$toArray[0]);
	$toTimeArray = explode(":",$toArray[1]);

	return ( mktime($fromTimeArray[0]*1,$fromTimeArray[1]*1,$fromTimeArray[2]*1,$fromDateArray[1]*1,$fromDateArray[2]*1,$fromDateArray[0]*1) - 
			 mktime($toTimeArray[0]*1,$toTimeArray[1]*1,$toTimeArray[2]*1,$toDateArray[1]*1,$toDateArray[2]*1,$toDateArray[0]*1)
			)
			/60;
}

##########################################
function System_DateAdd($myDate,$myAddDay) {
##########################################
	return date('Y-m-d',strtotime($myDate)+(24*3600*$myAddDay));
}
###############################
function System_ShowDateTimeEasy($myDateTime) {
###############################
	if($myDateTime<>"") {
			$myMin = floor(System_DateTimeDiff(SYSTEM_DATETIMENOW,$myDateTime));
			if($myMin>=-2 && $myMin<=2) {
				return "ขณะนี้";
			} else if($myMin>0) {
				if($myMin>=(365*60*24)) { 
					$myYear=floor($myMin/(365*60*24));
					return $myYear." ปีก่อน"; 
				} else if($myMin>=(30*60*24)) {
					$myMon=floor($myMin/(30*60*24));
					return $myMon." เดือนก่อน";
				} else if($myMin>=(60*24)) {
					$myDay=floor($myMin/(60*24));
					return $myDay." วันก่อน";
				} else if($myMin>=60) {
					$myHr=floor($myMin/60);
					return $myHr." ชั่วโมงก่อน";
				} else {
					return $myMin." นาทีก่อน";
				}
			} else {
				$myMin=$myMin*-1;
				if($myMin>=(365*60*24)) { 
					$myYear=floor($myMin/(365*60*24));
					return "อีก ".$myYear." ปีจากนี้"; 
				} else if($myMin>=(30*60*24)) {
					$myMon=floor($myMin/(30*60*24));
					return "อีก ".$myMon." เดือนจากนี้";
				} else if($myMin>=(60*24)) {
					$myDay=floor($myMin/(60*24));
					return "อีก ".$myDay." วันจากนี้";
				} else if($myMin>=60) {
					$myHr=floor($myMin/60);
					return "อีก ".$myHr." ชั่วโมงจากนี้";
				} else {
					return "อีก ".$myMin." นาทีจากนี้";
				}
			}
	} else {
			return "&nbsp;";
	}
}
###############################
function System_ShowDateLongTh($myDate) {
###############################
		$myDateArray=explode("-",$myDate);
		$myDay = sprintf("%d",$myDateArray[2]);
		switch($myDateArray[1]) {
			case "01" : $myMonth = "มกราคม";  break;
			case "02" : $myMonth = "กุมภาพันธ์";  break;
			case "03" : $myMonth = "มีนาคม"; break;
			case "04" : $myMonth = "เมษายน"; break;
			case "05" : $myMonth = "พฤษภาคม";   break;
			case "06" : $myMonth = "มิถุนายน";  break;
			case "07" : $myMonth = "กรกฎาคม";   break;
			case "08" : $myMonth = "สิงหาคม";  break;
			case "09" : $myMonth = "กันยายน";  break;
			case "10" : $myMonth = "ตุลาคม";  break;
			case "11" : $myMonth = "พฤศจิกายน";   break;
			case "12" : $myMonth = "ธันวาคม";  break;
		}
		$myYear = sprintf("%d",$myDateArray[0])+543;
        return($myDay . " " . $myMonth . " " . $myYear);
}
###############################
function System_ShowDate($myDate) {
###############################
		$myDateArray=explode("-",$myDate);
		$myDay = sprintf("%d",$myDateArray[2]);
		switch($myDateArray[1]) {
			case "01" : $myMonth = "ม.ค.";  break;
			case "02" : $myMonth = "ก.พ.";  break;
			case "03" : $myMonth = "มี.ค."; break;
			case "04" : $myMonth = "เม.ย."; break;
			case "05" : $myMonth = "พ.ค.";   break;
			case "06" : $myMonth = "มิ.ย.";  break;
			case "07" : $myMonth = "ก.ค.";   break;
			case "08" : $myMonth = "ส.ค.";  break;
			case "09" : $myMonth = "ก.ย.";  break;
			case "10" : $myMonth = "ต.ค.";  break;
			case "11" : $myMonth = "พ.ย.";   break;
			case "12" : $myMonth = "ธ.ค.";  break;
		}
		$myYear = substr(sprintf("%d",$myDateArray[0])+543,2,2);
        return($myDay . " " . $myMonth . " " . $myYear);
}
###############################
function System_ShowDateShort($myDate) {
###############################
		$myDateArray=explode("-",$myDate);
		$myDay = sprintf("%d",$myDateArray[2]);
		switch($myDateArray[1]) {
			case "01" : $myMonth = "ม.ค.";  break;
			case "02" : $myMonth = "ก.พ.";  break;
			case "03" : $myMonth = "มี.ค."; break;
			case "04" : $myMonth = "เม.ย."; break;
			case "05" : $myMonth = "พ.ค.";   break;
			case "06" : $myMonth = "มิ.ย.";  break;
			case "07" : $myMonth = "ก.ค.";   break;
			case "08" : $myMonth = "ส.ค.";  break;
			case "09" : $myMonth = "ก.ย.";  break;
			case "10" : $myMonth = "ต.ค.";  break;
			case "11" : $myMonth = "พ.ย.";   break;
			case "12" : $myMonth = "ธ.ค.";  break;
		}
		$myYear = substr(sprintf("%d",$myDateArray[0])+543,2,2);
        return($myDay . " " . $myMonth);
}
###############################
function System_ShowDateEN($myDate) {
###############################
		$myDateArray=explode("-",$myDate);
		$myDay = sprintf("%d",$myDateArray[2]);
		switch($myDateArray[1]) {
			case "01" : $myMonth = "JAN";  break;
			case "02" : $myMonth = "FEB";  break;
			case "03" : $myMonth = "MAR"; break;
			case "04" : $myMonth = "APR"; break;
			case "05" : $myMonth = "MAY";   break;
			case "06" : $myMonth = "JUN";  break;
			case "07" : $myMonth = "JUL";   break;
			case "08" : $myMonth = "AUG";  break;
			case "09" : $myMonth = "SEP";  break;
			case "10" : $myMonth = "OCT";  break;
			case "11" : $myMonth = "NOV";   break;
			case "12" : $myMonth = "DEC";  break;
		}
		$myYear = $myDateArray[0];
        return($myDay . " " . $myMonth . " " . $myYear);
}

?>