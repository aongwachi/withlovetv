<?php
header('Content-Type: application/rss+xml; charset=utf-8');
$input='<'.'?'.'xml version="1.0" encoding="utf-8" ?'.'>';
$out = str_replace(array("\n","\r","\t"),"",$input);
echo $out;
include("../_config/config_system.php");
include_once("../system/core-start-ajax-home.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<rss version="2.0">
<channel>
<title>BaaBinz</title>
<link>http://www.baabinz.com/</link>
<description>Fastest news in Thailand, every day.</description>
<language>th-TH</language>
<lastBuildDate><?php echo date('r', time());?></lastBuildDate>
<?php
##########################################################################################
$itemsloop=1; $index=0;
$Config_FolderKey1="thumb";
$Config_FolderKey2="thumb2";
$Config_FolderKey3="thumb3";
$sql="SELECT * FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_Thumb<>'' AND ".TABLE_CONTENT."_Subject<>'' AND ".TABLE_CONTENT."_Text<>''  AND ".TABLE_CONTENT."_Status='Publish' ORDER BY ".TABLE_CONTENT."_OnlineDate DESC LIMIT 0,100 ";
$query=$dbh->prepare($sql);
if($query->execute()) {
while($Row=$query->fetch()) {
	$myID=$Row[TABLE_CONTENT."_ID"];
	$myThumb=$Row[TABLE_CONTENT."_Thumb"];
	$myThumb2=$Row[TABLE_CONTENT."_Thumb2"];
	$myThumb3=$Row[TABLE_CONTENT."_Thumb3"];
	$mySubject=$Row[TABLE_CONTENT."_Subject"];
	$myRefName=""; 
	for($x=1;$x<=10;$x++) {
		if($Row[TABLE_CONTENT."_RefName".$x]<>"" && $myRefName=="") {
			$myRefName=$Row[TABLE_CONTENT."_RefName".$x];
		}
	}
	$myText=$Row[TABLE_CONTENT."_Text"];
	$myOnlineDate=$Row[TABLE_CONTENT."_OnlineDate"];
	$myIDs=sprintf('%04d',$myID);
	$myFolder1=substr($myIDs,strlen($myIDs)-4,2);
	$myFolder2=substr($myIDs,strlen($myIDs)-2,2);
	$Config_Path1=SYSTEM_WEB_CDN_PATH_FULL."/upload/".$Config_FolderKey1."/".$myFolder1."/".$myFolder2."/";
	$Config_Path2=SYSTEM_WEB_CDN_PATH_FULL."/upload/".$Config_FolderKey2."/".$myFolder1."/".$myFolder2."/";
	$Config_Path3=SYSTEM_WEB_CDN_PATH_FULL."/upload/".$Config_FolderKey3."/".$myFolder1."/".$myFolder2."/";
	$PictureThumb1=$Config_Path1.$myThumb;
	$PictureThumb2=$Config_Path2.$myThumb2;
	$PictureThumb3=$Config_Path3.$myThumb3;
	//--------------------------------------------
	$myTextAll="";
	$arText=explode("[#####]",$myText);
	for($i=0;$i<sizeof($arText);$i++) {
		if($arText[$i]<>"") {
			if(strpos($arText[$i],"[@@@]")>0) {
				$arText1=explode("[@@@]",$arText[$i]);
				if(trim($arText1[0])=="text") {
					$myTextAll.=" ".$arText1[1];
				}
			}
		}
	}
	$myTextAll=str_replace('\n','',$myTextAll);
	$myTextAll=str_replace('&nbsp;',' ',$myTextAll);
	for($s=1;$s<=20;$s++) {
		$myTextAll=str_replace('  ',' ',$myTextAll);
		$myTextAll=str_replace('> ','>',$myTextAll);
		$myTextAll=str_replace(' <','<',$myTextAll);
	}
	$myTextAll=str_replace('<p>','',$myTextAll);
	$myTextAll=str_replace('</p>','',$myTextAll);
	$myTextAll=str_replace('</span>','',$myTextAll);
	$myTextAll=str_replace('src="/upload/','src="http://cdn.baabinz.com/upload/',$myTextAll);
	$myTextAll=str_replace('src="//','src="http://',$myTextAll);
	$myTextAll=trim($myTextAll);
	$myTextOnly=strip_tags($myTextAll);
	// <img --------------------------
	if(strpos(" ".$myTextAll,"<img ")>0) {
		$myTextAllImg="";
		$arImg=explode("<img ",$myTextAll);
		for($s=1;$s<sizeof($arImg);$s++) {
			$arLine=explode("/>",$arImg[$s]);
			//------------------------------
			$arTmp1=explode('src="',$arLine[0]);
			$arTmp2=explode('"',$arTmp1[1]);
			$myTextAllImg.='<figure><img src="'.$arTmp2[0].'" />';
			//------------------------------
			if($myRefName<>"") {
				$myTextAllImg.='<figcaption class="op-vertical-center"><h1 class="op-vertical-above op-center">ภาพจาก</h1>';
				$myTextAllImg.='<cite class="op-vertical-below op-right">'.$myRefName.'</cite></figcaption>';
			}
			//------------------------------
			$myTextAllImg.='</figure>';
			//------------------------------
			$arLine[0]="#";
			$arImg[$s]=implode("/>",$arLine);
			$arImg[$s]=str_replace("#/>","",$arImg[$s]);
			$myTextAllImg.=$arImg[$s];
		}
		$myTextAll=$myTextAllImg;
	}
	// <iframe -----------------------
	if(strpos(" ".$myTextAll,"<iframe")>0) {
		$arIFrame=explode("<iframe",$myTextAll);
		$myTextAllIFrame=$arIFrame[0];
		for($s=1;$s<sizeof($arIFrame);$s++) {
			$arLine=explode("</iframe>",$arIFrame[$s]);
			$arLine[0]=str_replace('px"','"',$arLine[0]);
			$myTextAllIFrame.='<figure class="op-social"><iframe'.$arLine[0].'</iframe></figure>';
			$arLine[0]="#";
			$arIFrame[$s]=implode("</iframe>",$arLine);
			$arIFrame[$s]=str_replace("#</iframe>","",$arIFrame[$s]);
			$myTextAllIFrame.=$arIFrame[$s];
		}
		$myTextAll=$myTextAllIFrame;
	}
	// <span -------------------------
	if(strpos(" ".$myTextAll,"<span")>0) {
		$arSpan=explode("<span",$myTextAll);
		$myTextAllSpan=$arSpan[0];
		for($s=1;$s<sizeof($arSpan);$s++) {
			$arLine=explode(">",$arSpan[$s]);
			$arLine[0]="#";
			$arSpan[$s]=implode(">",$arLine);
			$arSpan[$s]=str_replace("#>","",$arSpan[$s]);
			$myTextAllSpan.=$arSpan[$s];
		}
		$myTextAll=$myTextAllSpan;
	}
	//--------------------------------	
	$myTextAlls=strip_tags($myTextAll);
	$myTextDescription=mb_substr($myTextOnly,0,200,'UTF-8');
	?>
	<item>
	<title><?php echo trim($mySubject); ?></title>
	<link><?php echo "http://".SYSTEM_WEB_PATH_FULL."/".$myID."/"; ?></link>
	<guid><?php echo "http://".SYSTEM_WEB_PATH_FULL."/".$myID."/"; ?></guid>
	<pubDate><?php echo date('r',strtotime($myOnlineDate));?></pubDate>
	<author>admin@baabinz.com (BaaBinz)</author>
	<description><?php echo trim($myTextDescription); ?></description>
	<content:encoded><![CDATA[
	<!doctype html>
	<html lang="th" prefix="op: http://media.facebook.com/op#">
	<head>
		<meta charset="utf-8">
		<link rel="canonical" href="<?php echo "http://".SYSTEM_WEB_PATH_FULL."/".$myID."/"; ?>">
		<meta property="op:markup_version" content="v1.0">
		<meta property="fb:article_style" content="Baabinz-1">
		<meta property="fb:use_automatic_ad_placement" content="false">
	</head>
	<body>
	<article>
	<header>
		<time class="op-published" datetime="<?php echo substr($myOnlineDate,0,10); ?>T<?php echo substr($myOnlineDate,11,9); ?>Z"><?php echo System_ShowDateEN(substr($myOnlineDate,0,10)); ?>, <?php echo substr($myOnlineDate,11,5); ?></time>
		<time class="op-modified" datetime="<?php echo substr($myOnlineDate,0,10); ?>T<?php echo substr($myOnlineDate,11,9); ?>Z"><?php echo System_ShowDateEN(substr($myOnlineDate,0,10)); ?>, <?php echo substr($myOnlineDate,11,5); ?></time>
		<figure>
			<img src="<?php echo $PictureThumb2; ?>" />
			<figcaption class="op-vertical-center">
			  <h1><?php echo trim($mySubject); ?></h1>
			</figcaption>				
		</figure>
		<h1><?php echo trim($mySubject); ?></h1>
	</header>
	
	<p><?php echo trim($mySubject); ?></p>
	
	<?php
	echo $myTextAll;
	if(strlen($myTextAlls)>200) {
		//if(0) {
		?>
		<figure class="op-ad">
		<iframe src="http://baabinz.com/ads/ads-mobile-300x250.html" frameborder="0" weight="300" height="250" scrolling="no">
		<p>Your browser does not support iframes.</p>
		</iframe>	
		</figure>
		<?php
		//}
	}
	?>
	
	<figure class="op-tracker">
	<iframe src="http://baabinz.com/facebook_instant_ga_tack.html" frameborder="0" weight="0" height="0" scrolling="no">
	<p>Your browser does not support iframes.</p>
	</iframe>
	</figure>

	<footer>
	<small>© BaaBinz.com</small>
	</footer>
	
	</article>
	</body>
	</html>
	]]></content:encoded>
	</item>
<?php	
//--------------------------------------------
} }
?>
</channel>
</rss>