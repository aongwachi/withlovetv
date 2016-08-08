<?php  if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php }
//--------------------------------------------------------------
include_once("/home/baabinz/domains/baabinz.com/public_html/cache-start.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);
//--------------------------------------------------------------
$p=(isset($_GET['p'])?$_GET['p']:null);
$p=trim($p)*1;
if($p=="") { exit; }
//--------------------------------------------------------------
$System_LayoutUse="layout_view.html";
$System_AjaxFileAction="ajax-index.php";
$System_ShowAjaxIFrame=0;
include_once("_config/config_system.php");
include_once(SYSTEM_DOC_ROOT."system/core-start-ajax-home.php");
//--------------------------------------------------------------
$sql="SELECT * FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_ID=:p LIMIT 0,1 ";
$query=$dbh->prepare($sql);
$query->bindParam(':p', $p, PDO::PARAM_INT);
if($query->execute()) {
    $Row=$query->fetch();
    $mySubject=$Row[TABLE_CONTENT."_Subject"];
    $myID=$Row[TABLE_CONTENT."_ID"];
    if($myID==0 || $myID=="") { exit; }
    $myText=$Row[TABLE_CONTENT."_Text"];
    $myPhoto=$Row[TABLE_CONTENT."_Photo"];
    $myCreateByStaffID=$Row[TABLE_CONTENT."_CreateByStaffID"];
    $myOnlineDate=$Row[TABLE_CONTENT."_OnlineDate"];
    $myCategory=$Row[TABLE_CONTENT."_Category"];
    $myTags=$Row[TABLE_CONTENT."_Tags"];
    $myThumb2=$Row[TABLE_CONTENT."_Thumb2"];
    $myThumbFB=$Row[TABLE_CONTENT."_ThumbFB"];
    for($x=1;$x<=4;$x++) {
        $arRefName[$x]=$Row[TABLE_CONTENT."_RefName".$x];
        $arRefLink[$x]=$Row[TABLE_CONTENT."_RefLink".$x];
    }
    $myAdsSelect=$Row[TABLE_CONTENT."_AdsSelect"];
} else { print_r($query->errorInfo()); }
$System_Title=$mySubject;
//--------------------------------------------
$myIDs=sprintf('%04d',$myID);
$myFolder1=substr($myIDs,strlen($myIDs)-4,2);
$myFolder2=substr($myIDs,strlen($myIDs)-2,2);
if($myThumbFB<>"") {
    $PictureThumbFB=SYSTEM_WEB_CDN_PATH_FULL."/upload/thumbfb/".$myFolder1."/".$myFolder2."/".$myThumbFB;
} else {
    $PictureThumbFB=SYSTEM_WEB_CDN_PATH_FULL."/upload/thumb2/".$myFolder1."/".$myFolder2."/".$myThumb2;
}
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
$myTextAll=trim(str_replace('&nbsp;',' ',strip_tags($myTextAll)));
$myTextAll=mb_substr($myTextAll,0,200,'UTF-8');
//--------------------------------------------------------------
$System_HeaderMetaTag='';
$System_HeaderMetaTag.='<meta property="fb:app_id" content="'.CONFIG_APPID.'">';
$System_HeaderMetaTag.='<meta itemprop="description" content="'.htmlentities($myTextAll).'">';
$System_HeaderMetaTag.='<meta itemprop="image" content="'.$PictureThumbFB.'">';
$System_HeaderMetaTag.='<meta itemprop="name" content="'.htmlentities($mySubject).'">';
$System_HeaderMetaTag.='<meta name="author" content="BAABIN">';
$System_HeaderMetaTag.='<meta name="description" itemprop="description" content="'.htmlentities($myTextAll).'">';
$System_HeaderMetaTag.='<meta property="article:author" content="https://www.facebook.com/BaaBinFanpage">';
$System_HeaderMetaTag.='<meta property="article:publisher" content="https://www.facebook.com/BaaBinFanpage">';
$System_HeaderMetaTag.='<meta property="og:locale" content="th_TH">';
$System_HeaderMetaTag.='<meta property="og:site_name" content="'.SYSTEM_WEB_TITLE.'">';
$System_HeaderMetaTag.='<meta property="og:url" content="http://www.baabin.com/'.$p.'/" />';
$System_HeaderMetaTag.='<meta property="og:type" content="article" />';
$System_HeaderMetaTag.='<meta property="og:title" content="'.htmlentities($mySubject).'" />';
$System_HeaderMetaTag.='<meta property="og:description" content="'.htmlentities($myTextAll).'" />';
$System_HeaderMetaTag.='<meta property="og:image" content="'.$PictureThumbFB.'" />';
$System_Title=htmlentities($mySubject);
//--------------------------------------------------------------
include_once(SYSTEM_DOC_ROOT."system/core-start-home.php");
include_once(SYSTEM_DOC_ROOT."system/core-body-home.php");
##########################################################
/*
function ads_middle_content( $content, $ads_center_code ) {
	$para_count = substr_count($content, "</p>");
	$para_After = floor($para_count/2);
	//$para_After = 2; //Enter number of paragraphs to display ad after.
	$content = explode ( '</p>', $content );
	$new_content = "";
	for ( $i = 0; $i < count ( $content ); $i ++ ) {
		if ( $i == $para_After ) {
      $new_content .= '<br><br><center><iframe width="300" height="300" style="border:0; margin:0;" src="http://baabin.com/ads/pricess300x300.html"></iframe></center>';
			$new_content .= '<br><br><div class="ads_center">';
			$new_content .= $ads_center_code ;
			$new_content .= '</div><br><br>';
		}
		$new_content .= $content[$i] . '</p>';
	}
	return $new_content;
}
*/

function ads_middle_content( $content, $ads_code ) {

  $content = ads_top_content( $content, $ads_code );

	$para_count = substr_count($content, "</p>");
	$para_After = floor($para_count/2);
	//$para_After = 2; //Enter number of paragraphs to display ad after.
	$content = explode ( '</p>', $content );
	$new_content = "";
	for ( $i = 0; $i < count ( $content ); $i ++ ) {
		if ( $i == $para_After ) {
      $new_content .= '<br><br><center><iframe width="300" height="630" style="border:0; margin:0;" src="http://baabin.com/ads/pricess300x300.html"></iframe></center>';
		}
		$new_content .= $content[$i] . '</p>';
	}
	return $new_content;
}

function ads_top_content( $content, $ads_code ) {

	$para_count = substr_count($content, "</p>");
	//$para_After = floor($para_count/2);
	$para_After = 2; //Enter number of paragraphs to display ad after.
	$content = explode ( '</p>', $content );
	$new_content = "";
	for ( $i = 0; $i < count ( $content ); $i ++ ) {
		if ( $i == $para_After ) {
      $new_content .= '<br><br><center> '.$ads_code.' </center>';
		}
		$new_content .= $content[$i] . '</p>';
	}
	return $new_content;
}


$arAdsCodeByID=""; $arAdsCode2ByID=""; $arAdsIDByKey=""; $arAdsCodeByKey=""; $arAdsCode2ByKey=""; $arAdsReplaceKey=""; $arAdsReplaceCode=""; $index=0;
$sql1=" SELECT * FROM ".TABLE_ADS." WHERE ".TABLE_ADS."_Name<>'' AND ".TABLE_ADS."_isInContent='0' ORDER BY ".TABLE_ADS."_ID DESC ";
$query1=$dbh->prepare($sql1);
if($query1->execute()) {
    while($Row1=$query1->fetch()) {
        $arAdsCodeByID[$Row1[TABLE_ADS."_ID"]]=$Row1[TABLE_ADS."_Code"];
        $arAdsCode2ByID[$Row1[TABLE_ADS."_ID"]]=$Row1[TABLE_ADS."_Code2"];
        $arAdsCodeByKey[$Row1[TABLE_ADS."_KeyReplace"]]=str_replace("[#[#]","<",str_replace("[#]#]",">",str_replace("[/script]","</script>",str_replace("[script]","<script>",$Row1[TABLE_ADS."_Code"]))));
        $arAdsCode2ByKey[$Row1[TABLE_ADS."_KeyReplace"]]=str_replace("[#[#]","<",str_replace("[#]#]",">",str_replace("[/script]","</script>",str_replace("[script]","<script>",$Row1[TABLE_ADS."_Code2"]))));
        $arAdsNameByID[$Row1[TABLE_ADS."_ID"]]=$Row1[TABLE_ADS."_Name"];
        $arAdsIDByKey[$Row1[TABLE_ADS."_KeyReplace"]]=$Row1[TABLE_ADS."_ID"];
        if($Row1[TABLE_ADS."_KeyReplace"]<>"") {
            $arAdsReplaceKey[$index]=$Row1[TABLE_ADS."_KeyReplace"];
            if($Row1[TABLE_ADS."_Code"]<>"") {
                $arAdsReplaceCode[$index]=str_replace("[#[#]","<",str_replace("[#]#]",">",str_replace("[/script]","</script>",str_replace("[script]","<script>",$Row1[TABLE_ADS."_Code"]))));
            } else {
                $arAdsReplaceCode[$index]='<br><div class="box-sky text-center padding-20" style=" font-size:10px; ">'.$Row1[TABLE_ADS."_Name"].'</div>';
            }
            $index++;
        }
    }
}
##########################################################
$index=0; $arTopMenuCatID=""; $arTopMenuCatName=""; $arTopMenuCatNameByID="";
$sql1=" SELECT * FROM ".TABLE_CATEGORY." WHERE ".TABLE_CATEGORY."_Name<>'' AND ".TABLE_CATEGORY."_Folder<>'' ";
$sql1.=" ORDER BY ".TABLE_CATEGORY."_Ordering ASC ";
$query1=$dbh->prepare($sql1);
if($query1->execute()) {
    while($Row1=$query1->fetch()) {
        $arTopMenuCatID[$index]=$Row1[TABLE_CATEGORY."_ID"];
        $arTopMenuCatName[$index]=$Row1[TABLE_CATEGORY."_Name"];
        $arTopMenuCatNameByID[$Row1[TABLE_CATEGORY."_ID"]]=$Row1[TABLE_CATEGORY."_Name"];
        $index++;
    }
}
##########################################################
?>
<link rel="stylesheet" href="/templates/bb/css/font.css">
<script>
window.fbAsyncInit = function() { FB.init({ appId : '<?php echo CONFIG_APPID; ?>', xfbml : true, version : 'v2.5' }); };
(function(d, s, id){ var js, fjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) {return;} js = d.createElement(s); js.id = id; js.src = "//connect.facebook.net/en_US/sdk.js"; fjs.parentNode.insertBefore(js, fjs); }(document, 'script', 'facebook-jssdk'));
function doFBShare(myid) { FB.ui({ method: 'share', href: 'http://www.baabin.com/'+myid+'/', }, function(response){}); }
</script>
<!--##############################################-->
<link href="<?php echo SYSTEM_WEB_CDN_PATH_FULL; ?>/lib/custom-share-buttons/css/_pisocials.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo SYSTEM_WEB_CDN_PATH_FULL; ?>/lib/social-buttons.css">
<script src="/lib/custom-share-buttons/dist/_pisocials1.js"></script>
<script src="<?php echo SYSTEM_WEB_CDN_PATH_FULL; ?>/lib/js/jquery.responsiveVideo.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/mobile-detect/1.3.1/mobile-detect.min.js"></script>
<script type="text/javascript" src="http://cdn.baabin.com/lib/js/social-buttons.js"></script>
<link href="http://cdn.baabin.com/lib/css/font-awesome.css" rel="stylesheet">
<style>
	.footer_share_icon {
		width: 100%;
	}

	.share-btn {
		display: inline-block;
		color: #ffffff;
		border: none;
		padding: 0.5em;
		width: 165px;;
		height: 40px;
		opacity: 0.9;
		box-shadow: 0 2px 0 0 rgba(0,0,0,0.2);
		outline: none;
		text-align: center;
		font-size:20px;
	}
	.share-btn:link {
	  color: #ffffff;
	}
	.share-btn:hover {
	  color: #eeeeee;
	}
	.share-btn:active {
	  position: relative;
	  top: 2px;
	  box-shadow: none;
	  color: #e2e2e2;
	  outline: none;
	}
	.share-btn.twitter { background: #55acee; }
	.share-btn.line { background: #00c300; }
	.share-btn.google-plus { background: #dd4b39; }
	.share-btn.facebook { background: #3B5998; }
	.share-btn.stumbleupon { background: #EB4823; }
	.share-btn.reddit { background: #ff5700; }
	.share-btn.linkedin    { background: #4875B4; }
	.share-btn.email { background: #444444; }
</style>


<?php
$isRandomAds=0; $myRandomAdsCount=0; $arAdsIDByIndex="";
$mySQLAds=" ".TABLE_ADS."_ID=0 ";
$arAdsSelect=explode(",",$myAdsSelect);
for($k=0;$k<=sizeof($arAdsSelect);$k++) {
    if($arAdsSelect[$k]>0) {
        $mySQLAds.=" OR ".TABLE_ADS."_ID='".$arAdsSelect[$k]."' ";
        $isRandomAds=1; $myRandomAdsCount++;
		$arAdsIDByIndex[$myRandomAdsCount]=$arAdsSelect[$k];
    }
}
if($isRandomAds==1) {
    $sql1=" SELECT * FROM ".TABLE_ADS." WHERE ".$mySQLAds." ORDER BY RAND() LIMIT 0,1 ";
    $query1=$dbh->prepare($sql1);
    $query1->execute();
    $Row1=$query1->fetch();
    $myRandomAdsCode1=str_replace("[#[#]","<",str_replace("[#]#]",">",str_replace("[/script]","</script>",str_replace("[script]","<script>",$Row1[TABLE_ADS."_Code"]))));
    $myRandomAdsCode2=str_replace("[#[#]","<",str_replace("[#]#]",">",str_replace("[/script]","</script>",str_replace("[script]","<script>",$Row1[TABLE_ADS."_Code2"]))));
    $myRandomAdsCode3=str_replace("[#[#]","<",str_replace("[#]#]",">",str_replace("[/script]","</script>",str_replace("[script]","<script>",$Row1[TABLE_ADS."_Code3"]))));
    $myRandomAdsCode4=str_replace("[#[#]","<",str_replace("[#]#]",">",str_replace("[/script]","</script>",str_replace("[script]","<script>",$Row1[TABLE_ADS."_Code4"]))));
    $myRandomAdsCode5=str_replace("[#[#]","<",str_replace("[#]#]",">",str_replace("[/script]","</script>",str_replace("[script]","<script>",$Row1[TABLE_ADS."_Code5"]))));
}
?>
<!--##############################################-->
<div class="row width-100 paddingbox1" style=" padding-top:0px; margin:0px; width:100%; ">
<div class="hidden-xs hidden-sm col-md-1 col-lg-2 padding-2"></div>
<div class="col-xs-12 col-sm-12 col-md-10 col-lg-8 text-center paddingbox2" style=" margin:0px; ">
	<!--##############################################-->
	<div class="pull-center text-center" style=" width:100%; ">
		<?php
		////////////////////////////////////////////////////////////////////////
		$AdsCode='[ADS-ARTICLE-AREA-01]';
		$myAdsByKeyDesktop=isset($arAdsCodeByKey[$AdsCode])?$arAdsCodeByKey[$AdsCode]:"";
		$myAdsByKeyMobile=isset($arAdsCode2ByKey[$AdsCode])?$arAdsCode2ByKey[$AdsCode]:"";

		$ads_id = base64_encode($AdsCode);
		echo '<div class="'.$ads_id.'" style="height:0px"></div>';
		if($myAdsByKeyMobile<>"") {
		?>
		<script>
			  var md = new MobileDetect(window.navigator.userAgent);
			  var check_desktop = true;
			  if(md.os()=='AndroidOS'){ check_desktop = false; }
			  if(md.is('iPhone')==true){  check_desktop = false; }
			  if(check_desktop==false){
          $(".<?php echo $ads_id?>").height(110);
				  $(".<?php echo $ads_id?>").html('<?php echo $myAdsByKeyMobile?>');
			  }
		</script>
		<?php
		}
		if($myAdsByKeyDesktop<>"") {
		?>
		<script>
			  var md = new MobileDetect(window.navigator.userAgent);
			  var check_desktop = true;
			  if(md.os()=='AndroidOS'){ check_desktop = false; }
			  if(md.is('iPhone')==true){  check_desktop = false; }
			  if(check_desktop==false){
			  }else{
          $(".<?php echo $ads_id?>").height(110);
				  $(".<?php echo $ads_id?>").html('<?php echo $myAdsByKeyDesktop?>');
			 }
		</script>
		<?php
		}
		if(($myAdsByKeyMobile=="") && ($myAdsByKeyDesktop=="")){
			echo '<div class="leaderboardads2 text-left">'.$AdsCode.'</div>';
		}
		?>
	</div>

	<!--##############################################-->
    <table border="0" width="100%" cellpadding="0" cellspacing="0">
        <tr>
        <td style=" vertical-align:top; ">
            <!--##############################################-->
            <div class="border-radius-5 text-left setcontent" style=" font-size:16px; margin:0px; background-color:#FFFFFF; padding-left:10px; padding-right:10px; ">
            <!--##############################################-->
            <!--
			<button type="button" class="btn btn-success btn-block btn-flat padding-10"
                onclick=" location.href='http://line.me/ti/p/@baabinz'; ">
                <a href="http://line.me/ti/p/@baabinz"><font color="#FFFFFF"><b  style=" font-size:20px; ">กดติดตามเราได้ที่ Line@</b></font></a>
            </button>
			-->
            <!--##############################################-->
            <div class="width-100 padding-5 makeBlock">
                <?php
                $arCategory=explode(",",$myCategory);
                $sql1x=" ".TABLE_CATEGORY."_ID='0'";
                for($i=0;$i<sizeof($arCategory);$i++) {
                    if($arCategory[$i]>0) {
                        $sql1x.=" OR ".TABLE_CATEGORY."_ID='".$arCategory[$i]."' ";
                    }
                }
                $myCategoryID=0;
                $sql1=" SELECT * FROM ".TABLE_CATEGORY." WHERE ".TABLE_CATEGORY."_Name<>'' AND ( ".$sql1x." )";
                $sql1.=" AND ".TABLE_CATEGORY."_ID <> 26 ";
				$sql1.=" ORDER BY ".TABLE_CATEGORY."_Name ASC ";
                $query1=$dbh->prepare($sql1);
                if($query1->execute()) {
                    while($Row1=$query1->fetch()) {
                        if($myCategoryID==0) { $myCategoryID=$Row1[TABLE_CATEGORY."_ID"]; }
                        ?>
                        <div class="categoryHashTags"><a href="/category/<?php echo $Row1[TABLE_CATEGORY."_ID"]; ?>/1/" class="categoryHashTagsLink"><?php echo $Row1[TABLE_CATEGORY."_Name"]; ?></a></div>
                        <?php
                    }
                }
                ?>
            </div>
            <h1 class="webfont" style="font-size:32px; padding-left:10px; "><?php echo $mySubject; ?></h1>
            <br>
			<div class="width-100 padding-2 text-left " style=" font-size:11px;color:#999999;margin-left: 10px;  ">วันที่ <?php echo System_ShowDate(substr($myOnlineDate,0,10)); ?> &nbsp; เวลา <?php echo substr($myOnlineDate,11,5); ?></div>
			<br>
            <!--##############################################-->
            <div class="webfont" style="font-size:26px; padding-left:10px; float:left; width:100px; ">แชร์เรื่องนี้</div>
			<div id="socialbt" style="  float:left; width:85%;   "></div>
			<div class="footer_share_icon">
				<div id="socialbt2">
					<!-- Facebook -->
					<a href="http://www.facebook.com/sharer/sharer.php?u=http://baabin.com/<?php echo $p; ?>/" target="_blank" class="share-btn facebook">
						<i class="fa fa-facebook"></i> แชร์ไป Facebook
					</a>

					<!-- LINE -->
					<a href="http://line.me/R/msg/text/?<?php echo $System_Title; ?>%0D%0Ahttp://baabin.com/<?php echo $p; ?>/" target="_blank" class="share-btn line">
						<i class="fa fa-lineme"></i> แชร์ไป LINE
					</a>
				</div>

			</div>
			<div style="clear:both;"></div>
            <br><br>

            <?php
            $AdsCode='[ADS-ARTICLE-TOP]';
            //###########################################################################
            if($isRandomAds==1 && $myRandomAdsCode1<>"") {
              echo '<div class="row width-100 padding-0" style=" margin:0px; ">';
              echo '<center>';
              echo $myRandomAdsCode1;
              echo '</center>';
              echo '</div>';
            //###########################################################################
            } else {
                $myAdsByKey=isset($arAdsCodeByKey[$AdsCode])?$arAdsCodeByKey[$AdsCode]:"";
                $myAdsByKey2=isset($arAdsCode2ByKey[$AdsCode])?$arAdsCode2ByKey[$AdsCode]:"";
                if($myAdsByKey<>"" && $myAdsByKey2<>"") {
                    echo '<div class="row width-100 padding-0" style=" margin:0px; ">';
                    echo '<center>';
                    echo $myAdsByKey;
                    echo '</center>';
                    echo '</div>';
                } else if($myAdsByKey<>"") {
                    echo '<div class="padding-5 width-100">';
                    echo $myAdsByKey;
                    echo '</div>';
                } else {
                    ?>
                    <div class="leaderboardads2 text-left"><?php echo $AdsCode; ?></div>
                    <?php
                }
            }
            //###########################################################################
            ?>


            <?php
            //---------------------------------
            $myText=str_replace('<img','<br><img',$myText);
            $myText=str_replace('<iframe','<br><iframe',$myText);
            $myText=str_replace('</iframe>','</iframe><br>',$myText);
            //---------------------------------
            if(strpos($myText,"[#####]")>0) {
                $arText=explode("[#####]",$myText);
                for($i=0;$i<sizeof($arText);$i++) {
                    if($arText[$i]<>"") {
                        if(strpos($arText[$i],"[@@@]")>0) {
                            $arText1=explode("[@@@]",$arText[$i]);
                            if(trim($arText1[0])=="ads") {
                                /*
                                if(0) {
                                $myAdsID=$arText1[1]*1;
                                if($myAdsID>0) {
                                    if($arAdsCodeByID[$myAdsID]<>"" && $arAdsCode2ByID[$myAdsID]<>"") {
                                        echo '<div class="row width-100 padding-0" style=" margin:0px; ">';
                                        echo '<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">';
                                        echo str_replace("[#[#]","<",str_replace("[#]#]",">",str_replace("[/script]","</script>",str_replace("[script]","<script>",$arAdsCodeByID[$myAdsID]))));
                                        echo '</div>';
                                        echo '<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">';
                                        echo str_replace("[#[#]","<",str_replace("[#]#]",">",str_replace("[/script]","</script>",str_replace("[script]","<script>",$arAdsCode2ByID[$myAdsID]))));
                                        echo '</div>';
                                        echo '</div>';
                                    } else {
                                        echo '<div class="padding-5 width-100">';
                                        echo str_replace("[#[#]","<",str_replace("[#]#]",">",str_replace("[/script]","</script>",str_replace("[script]","<script>",$arAdsCodeByID[$myAdsID]))));
                                        echo '</div>';
                                    }
                                } else {
                                    if($myAdsID>0) {
                                        echo '<br><div class="box-sky text-center padding-20" style=" font-size:10px; ">'.$arAdsNameByID[$myAdsID].'</div>';
                                    } else {
                                        echo '<br><div class="box-sky text-center padding-20" style=" font-size:10px; ">No Ads Code</div>';
                                    }
                                }
                                }
                                */
                            }
                            if(trim($arText1[0])=="text") {
                                $myShowText=$arText1[1];
                                for($x=0;$x<sizeof($arAdsReplaceKey);$x++) {
                                    if($arAdsReplaceKey[$x]<>"" && $arAdsReplaceCode[$x]<>"") {
                                        $myShowText=str_replace($arAdsReplaceKey[$x],$arAdsReplaceCode[$x],$myShowText);
                                    }
                                }

                                $myShowText=str_replace('="/upload/','="'.SYSTEM_WEB_CDN_PATH_FULL.'/upload/',$myShowText);
                                echo '<div class="widht-100" style=" height:20px">&nbsp;</div><div class="widht-100 padding-10">';
                                echo ads_middle_content($myShowText, $myRandomAdsCode2);
                                echo '</div><br><br>';
                            }
                            if(trim($arText1[0])=="video") {
                                if(trim($arText1[1])<>"") {
                                   echo '<br><div style=" padding-left:30px; padding-right:30px; "><div class="videoWrapper">'.str_replace('\\'.'n',' ',trim(str_replace('[#[#]','<',str_replace('[#]#]','>',$arText1[1])))).'</div></div><br>';
                                }
                            }
                        } else {
                            //echo '<br><div class="widht-100 padding-10">';
                            //echo $arText[$i];
                            //echo '</div><br>';
                        }
                    }
                }
            } else {
                echo $myText;
            }
	    /*
            $Config_FolderKey="content";
            $myIDs=sprintf('%04d',$myID);
            $myFolder1=substr($myIDs,strlen($myIDs)-4,2);
            $myFolder2=substr($myIDs,strlen($myIDs)-2,2);
            $Config_Path="upload/".$Config_FolderKey."/".$myFolder1."/".$myFolder2."/";
            $arPhotoList=explode(",",$myPhoto);
            for($i=0;$i<sizeof($arPhotoList);$i++) {
                if($arPhotoList[$i]<>"") {
                    echo "<br>";
                    echo '<img src="/'.$Config_Path.$arPhotoList[$i].'" class="img-responsive" >';
                    echo "<br>";
                }
            }
            */
            ?>
            <!--##############################################-->
            <?php if(sizeof($arRefName)>3) { ?>
            <div class="row width-100 padding-10 text-left" style=" padding-left:20px; padding-right:20px; ">
            <div class="referArea" style=" margin-left: 0px; "> ขอขอบคุณข้อมูลจาก : </div>
            <?php
            for($x=1;$x<=4;$x++) {
                if($arRefName[$x]<>"") {
                    if($arRefLink[$x]=="") {
                        ?>
                        <div class="referArea"><?php echo $arRefName[$x]; ?></div>
                        <?php
                    } else {
                        ?>
                        <div class="referArea"><a href="<?php echo $arRefLink[$x]; ?>" class="referLink"><?php echo $arRefName[$x]; ?></a></div>
                        <?php
                    }
                }
            }
            ?>
            </div>
            <?php } ?>
            <!--##############################################-->
            <?php if($myTags<>"" && $myTags<>",") { ?>
            <div class="row width-100 padding-10 text-left" style=" padding-left:20px; padding-right:20px; ">
            <div class="padding-2 pull-left" style=" margin-top:7px; ">Hashtag : </div>
            <?php
            $SQLAllTags=" ".TABLE_TAGS."_ID='0' ";
            $arTags=explode(",",$myTags);
            for($x=0;$x<sizeof($arTags);$x++) {
                if($arTags[$x]>0) {
                    $SQLAllTags.=" OR ".TABLE_TAGS."_ID='".$arTags[$x]."' ";
                }
            }
            $sql=" SELECT * FROM ".TABLE_TAGS." WHERE ".TABLE_TAGS."_Name<>'' AND ".TABLE_TAGS."_NoOfUse>0 AND (".$SQLAllTags.")";
            $sql.=" ORDER BY ".TABLE_TAGS."_NoOfUse DESC LIMIT 0,9 ";
            $query=$dbh->prepare($sql);
            if($query->execute()) {
            while($Row=$query->fetch()) {
                ?>
                <div class="categoryHashTags"><a href="/hashtags/<?php echo $Row[TABLE_TAGS."_ID"]; ?>/1/" class="categoryHashTagsLink">#<?php echo $Row[TABLE_TAGS."_Name"]; ?></a></div>
                <?php
            }} else { print_r($query->errorInfo()); }
            ?>
            </div>
            <?php } ?>
            <?php
            //-------------------------------------------
            $Config_FolderKey="staff";
            $myIDs=sprintf('%04d',$myCreateByStaffID);
            $myFolder1=substr($myIDs,strlen($myIDs)-4,2);
            $myFolder2=substr($myIDs,strlen($myIDs)-2,2);
            $Config_Path=SYSTEM_WEB_CDN_PATH_FULL."/upload/".$Config_FolderKey."/".$myFolder1."/".$myFolder2."/";
            //-------------------------------------------
            $sql1=" SELECT * FROM ".TABLE_STAFF." WHERE ".TABLE_STAFF."_ID='".$myCreateByStaffID."' LIMIT 0,1 ";
            $query1=$dbh->prepare($sql1);
            $query1->execute();
            $Row1=$query1->fetch();
            ?>
            <div class="width-100 padding-0" style=" height:10px; "> </div>
            <table border="0" width="100%" cellpadding="0" cellspacing="0"><tr>
            <td style=" width:80px; ">
            <?php if($Row1[TABLE_STAFF."_Picture"]<>"") { ?>
            <img src="<?php echo $Config_Path.$Row1[TABLE_STAFF."_Picture"]; ?>" class="img-bordered border-green img-circle pull-center" style=" width:50px; ">
            <?php } else { ?>
            <img src="<?php echo SYSTEM_WEB_CDN_PATH_FULL; ?>/img/persona1.png" class="pull-center" style=" width:50px; ">
            <?php } ?>
            </td>
            <td>
                <div class="width-100 padding-2 text-left " style=" color:#999999; font-size:11px; border-style: solid; border-color: #dfdfdf; border-width: 0px 0px 1px 0px; ">เรียบเรียงโดย <span style=" color:#eb0254; "><?php echo $Row1[TABLE_STAFF."_Name"]; ?></span></div>
                <div class="width-100 padding-2 text-left " style=" font-size:11px; color:#999999; ">วันที่ <?php echo System_ShowDate(substr($myOnlineDate,0,10)); ?> &nbsp; เวลา <?php echo substr($myOnlineDate,11,5); ?></div>
            </td>
            </tr></table>
<br>
            <!--##############################################-->
            <div class="webfont" style="font-size:26px; padding-left:10px; float:left; width:100px; ">แชร์เรื่องนี้</div>
			<div id="socialbt" style="  float:left; width:85%;   "></div>
			<div class="footer_share_icon">
				<div id="socialbt2">
					<!-- Facebook -->
					<a href="http://www.facebook.com/sharer/sharer.php?u=http://baabin.com/<?php echo $p; ?>/" target="_blank" class="share-btn facebook">
						<i class="fa fa-facebook"></i> แชร์ไป Facebook
					</a>

					<!-- LINE -->
					<a href="http://line.me/R/msg/text/?<?php echo $System_Title; ?>%0D%0Ahttp://baabin.com/<?php echo $p; ?>/" target="_blank" class="share-btn line">
						<i class="fa fa-lineme"></i> แชร์ไป LINE
					</a>
				</div>

			</div>
			<div style="clear:both;"></div>
            <!--##############################################-->
            <div class="pull-center text-center" style=" width:100%; ">
                <?php
                ////////////////////////////////////////////////////////////////////////
                $AdsCode='[ADS11]';
                $myAdsByKey=isset($arAdsCodeByKey[$AdsCode])?$arAdsCodeByKey[$AdsCode]:"";
                $myAdsByKey2=isset($arAdsCode2ByKey[$AdsCode])?$arAdsCode2ByKey[$AdsCode]:"";
                if($myAdsByKey<>"" && $myAdsByKey2<>"") {
                    echo '<div class="row width-100 padding-0" style=" margin:0px; ">';
                    echo '<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">';
                    echo $myAdsByKey;
                    echo '</div>';
                    echo '<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">';
                    echo $myAdsByKey2;
                    echo '</div>';
                    echo '</div>';
                } else if($myAdsByKey<>"") {
                    echo '<div class="padding-5 width-100">';
                    echo $myAdsByKey;
                    echo '</div>';
                } else {
                    ?>
                    <div class="leaderboardads2 text-left"><?php echo $AdsCode; ?></div>
                    <?php
                }
                ////////////////////////////////////////////////////////////////////////
                if($arAdsIDByKey[$AdsCode]>0) {
                    $sql1=" UPDATE ".TABLE_ADS." SET ".TABLE_ADS."_Count=".TABLE_ADS."_Count+1 WHERE ".TABLE_ADS."_ID=".$arAdsIDByKey[$AdsCode]." ";
                    $query1=$dbh->prepare($sql1);
                    $query1->execute();
                }
                ////////////////////////////////////////////////////////////////////////
                ?>
            </div>
            <!--##############################################-->
            <div class="pull-center text-center" style=" width:100%; ">
                <?php
                ////////////////////////////////////////////////////////////////////////
                $AdsCode='[ADS-ARTICLE-BOTTOM]';
                $myAdsByKey=isset($arAdsCodeByKey[$AdsCode])?$arAdsCodeByKey[$AdsCode]:"";
                if($myAdsByKey<>"") { echo $myAdsByKey; } else {
                    ?>
                    <div class="leaderboardads2 text-left"><?php echo $AdsCode; ?></div>
                    <?php
                }
                ////////////////////////////////////////////////////////////////////////
                if($arAdsIDByKey[$AdsCode]>0) {
                    $sql1=" UPDATE ".TABLE_ADS." SET ".TABLE_ADS."_Count=".TABLE_ADS."_Count+1 WHERE ".TABLE_ADS."_ID=".$arAdsIDByKey[$AdsCode]." ";
                    $query1=$dbh->prepare($sql1);
                    $query1->execute();
                }
                ////////////////////////////////////////////////////////////////////////
                ?>
            </div>
            <!--##############################################-->
          <!--  <button type="button" class="btn btn-success btn-block btn-flat padding-10"
                onclick=" location.href='http://line.me/ti/p/@baabinz'; ">
                <a href="http://line.me/ti/p/@baabinz"><font color="#FFFFFF"><b  style=" font-size:20px; ">กดติดตามเราได้ที่ Line@</b></font></a>
            </button>
            <br>
          -->
            </div>
            <br>

      <div class="makeBlock width-100 ads-for-mobile" style="display:none;">
				<center>
					<div style="float:left; display:block; margin:0 auto; width:350px;">
						<?php
						////////////////////////////////////////////////////////////////////////
						$AdsCode='[ADS-ARTICLE-FOOTER-01]';
						$myAdsByKey=isset($arAdsCodeByKey[$AdsCode])?$arAdsCodeByKey[$AdsCode]:"";
						$myAdsByKey2=isset($arAdsCode2ByKey[$AdsCode])?$arAdsCode2ByKey[$AdsCode]:"";
						if($myAdsByKey<>"" && $myAdsByKey2<>"") {
							echo '<div class="row width-100 padding-0" style=" margin:0px; ">';
							echo '<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">';
							echo $myAdsByKey;
							echo '</div>';
							echo '<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">';
							echo $myAdsByKey2;
							echo '</div>';
							echo '</div>';
						} else if($myAdsByKey<>"") {
							echo '<div class="padding-5 width-100">';
							echo $myAdsByKey;
							echo '</div>';
						} else {
							?>
							<div class="leaderboardads2 text-left"><?php echo $AdsCode; ?></div>
							<?php
						}
						////////////////////////////////////////////////////////////////////////
						if($arAdsIDByKey[$AdsCode]>0) {
							$sql1=" UPDATE ".TABLE_ADS." SET ".TABLE_ADS."_Count=".TABLE_ADS."_Count+1 WHERE ".TABLE_ADS."_ID=".$arAdsIDByKey[$AdsCode]." ";
							$query1=$dbh->prepare($sql1);
							$query1->execute();
						}
						////////////////////////////////////////////////////////////////////////
						?>
					</div>

				<center>
			</div>

			<div class="makeBlock width-100">
				<br>
				<!--##############################################-->
				<table border="0" width="100%"><tr><td class="headbarbg1"></td><td class="text-right webfont headbar headbarbg2" style=" width:220px; ">เรื่องอื่นๆ ที่เกี่ยวของ</td></tr></table>
				<br>
				<div class="makeBlock width-100">
				<?php
				$itemID="related";
				//--------------------------------------------
				$Config_FolderKey="thumb2"; $itemsloop=1;
				if($myCategoryID>0) {
					$sql="SELECT * FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_Category LIKE '%,".$myCategoryID.",%' AND ".TABLE_CONTENT."_ID<'".$myID."' AND ".TABLE_CONTENT."_Thumb<>'' AND ".TABLE_CONTENT."_Subject<>''  AND ".TABLE_CONTENT."_Text<>''  AND ".TABLE_CONTENT."_Status='Publish' ORDER BY ".TABLE_CONTENT."_OnlineDate DESC LIMIT 0,6 ";
				} else {
					$sql="SELECT * FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_ID<'".$myID."' AND ".TABLE_CONTENT."_Thumb<>'' AND ".TABLE_CONTENT."_Subject<>''  AND ".TABLE_CONTENT."_Text<>''  AND ".TABLE_CONTENT."_Status='Publish' ORDER BY ".TABLE_CONTENT."_OnlineDate DESC LIMIT 0,6 ";
				}
				$query=$dbh->prepare($sql);
				if($query->execute()) {
				while($Row=$query->fetch()) {
					$myID=$Row[TABLE_CONTENT."_ID"];
					$myThumb2=$Row[TABLE_CONTENT."_Thumb2"];
					$mySubject=$Row[TABLE_CONTENT."_Subject"];
					$isVideo=$Row[TABLE_CONTENT."_isVideo"];
					//--------------------------------------------
					$myIDs=sprintf('%04d',$myID);
					$myFolder1=substr($myIDs,strlen($myIDs)-4,2);
					$myFolder2=substr($myIDs,strlen($myIDs)-2,2);
					$Config_Path="upload/".$Config_FolderKey."/".$myFolder1."/".$myFolder2."/";
					$PictureThumb=$Config_Path.$myThumb2;
					//--------------------------------------------

					?>
					<div id="<?php echo $itemID.$itemsloop; ?>">
					<div class="borderpic">
						<div class="row pictureresize" style=" margin:0px; "><a href="/<?php echo $myID; ?>/"><img src="/<?php echo $PictureThumb; ?>" class="pictureresize" style="width:100%;"></a></div>
						<div class="text-left option-area">
							<div class="pull-left categoryTags-hotclipa"><?php echo $arTopMenuCatNameByID[$myCategoryID]; ?></div>
							<div class="fb-share pull-right cursor" onclick=" doFBShare(<?php echo $myID; ?>); "></div>
						</div>
						<div class="text-left subject-area">
						<a href="/<?php echo $myID; ?>/" class="picturelink"><?php echo $mySubject; ?></a>
						</div>
						<div class="text-left end-area"></div>
					</div>
					</div>
					<?php
					$itemsloop++;
				}} else { print_r($query->errorInfo()); }
				?>
				</div>
			</div>
            <br>

            <!--##############################################-->
            <div class="pull-center text-center" style=" width:100%; ">
                <?php
                ////////////////////////////////////////////////////////////////////////
                $AdsCode='[ADS12]';
                $myAdsByKey=isset($arAdsCodeByKey[$AdsCode])?$arAdsCodeByKey[$AdsCode]:"";
                $myAdsByKey2=isset($arAdsCode2ByKey[$AdsCode])?$arAdsCode2ByKey[$AdsCode]:"";
                if($myAdsByKey<>"" && $myAdsByKey2<>"") {
                    echo '<div class="row width-100 padding-0" style=" margin:0px; ">';
                    echo '<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">';
                    echo $myAdsByKey;
                    echo '</div>';
                    echo '<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">';
                    echo $myAdsByKey2;
                    echo '</div>';
                    echo '</div>';
                } else if($myAdsByKey<>"") {
                    echo '<div class="padding-5 width-100">';
                    echo $myAdsByKey;
                    echo '</div>';
                } else {
                    ?>
                    <div class="leaderboardads2 text-left"><?php echo $AdsCode; ?></div>
                    <?php
                }
                ////////////////////////////////////////////////////////////////////////
                if($arAdsIDByKey[$AdsCode]>0) {
                    $sql1=" UPDATE ".TABLE_ADS." SET ".TABLE_ADS."_Count=".TABLE_ADS."_Count+1 WHERE ".TABLE_ADS."_ID=".$arAdsIDByKey[$AdsCode]." ";
                    $query1=$dbh->prepare($sql1);
                    $query1->execute();
                }
                ////////////////////////////////////////////////////////////////////////
                ?>
            </div>
            <!--##############################################-->
            <br>
        </td>
        <td class="padding-20 hidden-xs" style=" width:320px; max-width:320px; min-width:320px; vertical-align:top; padding-top:0px; ">
            <!--##############################################-->
            <br>
            <!--##############################################-->
            <div class="pull-center text-center" style=" width:100%; ">
                <?php
                ////////////////////////////////////////////////////////////////////////
                $AdsCode='[ADS14]';
                $myAdsByKey=isset($arAdsCodeByKey[$AdsCode])?$arAdsCodeByKey[$AdsCode]:"";
                if($myAdsByKey<>"") { echo $myAdsByKey; } else {
                    ?>
                    <div class="leaderboardads2 text-left"><?php echo $AdsCode; ?></div>
                    <?php
                }
                ////////////////////////////////////////////////////////////////////////
                if($arAdsIDByKey[$AdsCode]>0) {
                    $sql1=" UPDATE ".TABLE_ADS." SET ".TABLE_ADS."_Count=".TABLE_ADS."_Count+1 WHERE ".TABLE_ADS."_ID=".$arAdsIDByKey[$AdsCode]." ";
                    $query1=$dbh->prepare($sql1);
                    $query1->execute();
                }
                ////////////////////////////////////////////////////////////////////////
                ?>
            </div>
            <br>

            <table border="0" width="100%"><tr><td class="headbarbg1"></td><td class="text-right webfont headbar headbarbg2" style=" width:140px; ">Top Story</td></tr></table>
            <br>
            <?php
            $Config_PageSize=6; $itemID="topstory";
            include(SYSTEM_DOC_ROOT."object/obj_show_items_topstory.php");
            ?>
            <br>
            <!--##############################################-->
            <div class="pull-center text-center" style=" width:100%; ">
                <?php
                ////////////////////////////////////////////////////////////////////////
                $AdsCode='[ADS15]';
                $myAdsByKey=isset($arAdsCodeByKey[$AdsCode])?$arAdsCodeByKey[$AdsCode]:"";
                if($myAdsByKey<>"") { echo $myAdsByKey; } else {
                    ?>
                    <div class="leaderboardads2 text-left"><?php echo $AdsCode; ?></div>
                    <?php
                }
                ////////////////////////////////////////////////////////////////////////
                if($arAdsIDByKey[$AdsCode]>0) {
                    $sql1=" UPDATE ".TABLE_ADS." SET ".TABLE_ADS."_Count=".TABLE_ADS."_Count+1 WHERE ".TABLE_ADS."_ID=".$arAdsIDByKey[$AdsCode]." ";
                    $query1=$dbh->prepare($sql1);
                    $query1->execute();
                }
                ////////////////////////////////////////////////////////////////////////
                ?>
            </div>
            <br>
            <!--##############################################-->
            <table border="0" width="100%"><tr><td class="headbarbg1"></td><td class="text-right webfont headbar headbarbg2" style=" width:160px; ">คลิปเด่น รูปดัง</td></tr></table>
            <br>
            <div class="makeBlock width-100">
            <?php
            $catid=9; $Config_PageSize=3; $itemID="toppictureandclip";
            include(SYSTEM_DOC_ROOT."object/obj_show_items_toppictureandclip.php");
            $catid=21; $Config_PageSize=3; $itemID="toppictureandclip";
            include(SYSTEM_DOC_ROOT."object/obj_show_items_toppictureandclip.php");
            ?>
            </div>
            <br>
            <!--##############################################-->
        </td>
        </tr>
    </table>
    <!--##############################################-->
</div>

<div class="hidden-xs hidden-sm col-md-1 col-lg-2 padding-2"></div>
</div>
<style>
.itemspanel-hotclipa { padding:0px; background-color:#FFFFFF; -webkit-border-radius: 5px 5px 5px 5px; }
.photoframe-hotclipa { width:100%; padding:0px; }
.categoryTags-hotclipa { color:#FFFFFF; background-color:#eb0254; padding:1px; padding-left:5px; padding-right:5px; font-size:10px; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; }
.tag-hotclipa { text-align:left; padding: 2px; height:22px; }
.boxindent-hotclipa { height:20px; }
.boxindent-hotclipb { height:20px; }
.linkbox-hotclipa { padding:4px; padding-left:8px; padding-right:8px; background-color:#00FF00; height: 138px; overflow: hidden; margin-top: -101px;  }
.bt-playarea-hotclipa { height:99px; margin-top:0px; display:block; }
.bt-play-hotclipa { background: url('<?php echo SYSTEM_WEB_CDN_PATH_FULL; ?>/templates/bb/img/play.png'); width:60px; height:60px; opacity: 0.6; display:inline-block; }
.bt-play-hotclipa:hover { background: url('<?php echo SYSTEM_WEB_CDN_PATH_FULL; ?>/templates/bb/img/play.png'); width:60px; height:60px; opacity: 1; display:inline-block; }
.fb-share { background: url('<?php echo SYSTEM_WEB_CDN_PATH_FULL; ?>/templates/bb/img/bt-fb-shares.png'); width:55px; height:15px; margin-top:0px; }
.fb-share:hover { background: url('<?php echo SYSTEM_WEB_CDN_PATH_FULL; ?>/templates/bb/img/bt-fb-share.png'); width:55px; height:15px; margin-top:0px; }
.borderpic { -webkit-border-radius: 5px 5px 5px 5px; border: 1px solid #e1e3df; padding: 0px; width:100%; height:auto; }
.pictureresize { width:100%; height:auto;  border-radius: 5px 5px 0px 0px; -moz-border-radius: 5px 5px 0px 0px; -webkit-border-radius: 5px 5px 0px 0px; }
.referArea { display: block; float: left!important; padding: 0px; font-size: 16px; margin-left: 6px; margin-top: 10px; }
a.referLink:link { color: #6666AA!important; text-decoration: none; }
a.referLink:visited { color: #6666AA!important; text-decoration: none; }
a.referLink:active { color: #000000!important; text-decoration: none; }
a.referLink:hover { color: #000000!important; text-decoration: none; }
.linkbox2 { padding:5px; padding-top:25px; height:59px; overflow:hidden; text-align:left; font-weight:none; }
.tagbox2 { display:block; position: absolute; text-align:left; margin-left:0px; margin-top:-20px; }
.bt-playarea-topstory { height:99px; margin-top:-99px; display:block; }
.option-area { height:24px; padding:4px; background-color:#FFFFFF; padding-left:10px; padding-right:10px; }
.subject-area { height:33px; overflow:hidden; background-color:#FFFFFF; padding-left:10px; padding-right:10px; }
.end-area { height:10px; background-color:#FFFFFF; border-radius: 0px 0px 5px 5px; -moz-border-radius: 0px 0px 5px 5px; -webkit-border-radius: 0px 0px 5px 5px; }

#related1 { width:32%; height:auto; display: block; float:left!important; padding:0; }
#related2 { width:32%; height:auto; display: block; float:left!important; padding:0; margin-left:6px; }
#related3 { width:32%; height:auto; display: block; float:left!important; padding:0; margin-left:6px; }
#related4 { width:32%; height:auto; display: block; float:left!important; padding:0; margin-top:15px;}
#related5 { width:32%; height:auto; display: block; float:left!important; padding:0; margin-left:6px;  margin-top:15px;}
#related6 { width:32%; height:auto; display: block; float:left!important; padding:0; margin-left:6px;  margin-top:15px;}
/* Extra Small Devices, Phones */
@media only screen and (max-width : 480px) {
    #related1 { width:100%; height:auto; display: block; float:left!important;  margin:0; padding:10px; }
    #related2 { width:100%; height:auto; display: block; float:right!important; margin:0; padding:10px; }
    #related3 { width:100%; height:auto; display: block; float:left!important;  margin:0; padding:10px; }
    #related4 { width:100%; height:auto; display: block; float:left!important;  margin:0; padding:10px; }
    #related5 { width:100%; height:auto; display: block; float:right!important; margin:0; padding:10px; }
    #related6 { width:100%; height:auto; display: block; float:left!important;  margin:0; padding:10px; }
}

/* Floating Footer Ads */

#footer_ads_cover {
    position: fixed;
    bottom: 0;
    width: 100%;
}

#footer_ads {
    line-height: 2;
    text-align: center;
    width: 728px;
	height: 90px;
	margin: 0 auto;
    text-shadow: 0 1px 0 #84BAFF;
    box-shadow: 0 0 15px #00214B
	position: relative;
}

.close_floating_footer {
	color: #fff;
	font: 16px/100% arial, sans-serif;
	margin-top: 70px;
    display: block;
    position: absolute;

}

.close_floating_footer:after {
  content: '✖'; /* UTF-8 symbol */
  background-color:#000;
  color:#fff;
  padding:3px 5px 3px 5px;
  margin-left: 728px;
  cursor:pointer;
}

/* Floating Right Ads */

#right_ads {
    position: fixed;
    right: 0;
    width: 160px;
	height: 600px;
}

.close_floating_right {
  color: #fff;
  font: 16px/100% arial, sans-serif;
}

.close_floating_right:after {
  content: '✖'; /* UTF-8 symbol */
  background-color:#000;
  color:#fff;
  padding:3px 5px 3px 5px;
  margin-left:136px;
  cursor: pointer;
}

/* end floating ads */

iframe {
  max-width: 100%;
}

</style>

<!--##############################################-->
<script>
// Set Responsive Youtube
$(function() {
	$( 'body' ).responsiveVideo();

	$( '.close_floating_footer' ).click(function(){
		$('#footer_ads_cover').hide();
	});

	$( '.close_floating_right' ).click(function(){
		$('#right_ads').hide();
	});

});

// Set Responsive Iframe
function adjustIframes()
{
  $('iframe').each(function(){
    var
    $this       = $(this),
    proportion  = $this.data( 'proportion' ),
    w           = $this.attr('width'),
    actual_w    = $this.width();

    if ( ! proportion )
    {
        proportion = $this.attr('height') / w;
        $this.data( 'proportion', proportion );
    }

    if ( actual_w != w )
    {
        $this.css( 'height', Math.round( actual_w * proportion ) + 'px' );
    }
  });
}

$(window).on('resize load',adjustIframes);


</script>

<script type="text/javascript">var SC_CId = "121299",SC_Domain="n.ads3-adnow.com";SC_Start_121299=(new Date).getTime();</script>
<script type="text/javascript" src="http://st-n.ads3-adnow.com/js/adv_out.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/mobile-detect/1.3.1/mobile-detect.min.js"></script>
<script>
	var md = new MobileDetect(window.navigator.userAgent);
	var rand_number = Math.floor(Math.random() * 3) + 1;
	if(md.mobile()==null){
		  $('.ads-for-mobile').hide();
		//  $('#footer_share_icon').hide();
	}else{
		  //document.write("mobile");
		  $('.ads-for-mobile').show();
		//  $('#footer_share_icon').show();
	}
</script>

<?php
include_once(SYSTEM_DOC_ROOT."system/core-end-home.php");
include_once("cache-end.php");
?>
