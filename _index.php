<?php  if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } 
include_once("cache-start.php");
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
$System_LayoutUse="layout_home.html";
$System_AjaxFileAction="ajax-index.php";
$System_ShowAjaxIFrame=0;
$page=(isset($_GET['page'])?$_GET['page']:null);
if($page=="") { $page=1; }
$catid=1000;
include_once("_config/config_system.php");
include_once(SYSTEM_DOC_ROOT."system/core-start-ajax-home.php");
//--------------------------------------------------------------
$sql="SELECT * FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_Status='Publish' ORDER BY ".TABLE_CONTENT."_DESC LIMIT 0,1 ";
$query=$dbh->prepare($sql);
if($query->execute()) {
    $Row=$query->fetch();
    $myID=$Row[TABLE_CONTENT."_ID"];
    $myThumb2=$Row[TABLE_CONTENT."_Thumb2"];
    $myThumbFB=$Row[TABLE_CONTENT."_ThumbFB"];
}
//--------------------------------------------
$myIDs=sprintf('%04d',$myID);
$myFolder1=substr($myIDs,strlen($myIDs)-4,2);
$myFolder2=substr($myIDs,strlen($myIDs)-2,2);
if($myThumbFB<>"") {
    $PictureThumbFB="http://".SYSTEM_WEB_PATH_FULL."/upload/thumbfb/".$myFolder1."/".$myFolder2."/".$myThumbFB;
} else {
    $PictureThumbFB="http://".SYSTEM_WEB_PATH_FULL."/upload/thumb2/".$myFolder1."/".$myFolder2."/".$myThumb2;
}
//--------------------------------------------
$System_HeaderMetaTag='';
$System_HeaderMetaTag.='<meta property="fb:app_id" content="'.CONFIG_APPID.'">';
$System_HeaderMetaTag.='<meta itemprop="image" content="'.$PictureThumbFB.'">';
$System_HeaderMetaTag.='<meta itemprop="name" content="'.SYSTEM_WEB_TITLE.'">';
$System_HeaderMetaTag.='<meta name="author" content="BAABIN">';
$System_HeaderMetaTag.='<meta property="article:author" content="https://www.facebook.com/BaaBinFanpage">';
$System_HeaderMetaTag.='<meta property="article:publisher" content="https://www.facebook.com/BaaBinFanpage">';
$System_HeaderMetaTag.='<meta property="og:locale" content="th_TH">';
$System_HeaderMetaTag.='<meta property="og:site_name" content="'.SYSTEM_WEB_TITLE.'">';
$System_HeaderMetaTag.='<meta property="og:type" content="website" />';
$System_HeaderMetaTag.='<meta property="og:title" content="'.SYSTEM_WEB_TITLE.'" />';
$System_HeaderMetaTag.='<meta property="og:image" content="'.$PictureThumbFB.'" />';


$System_Title = SYSTEM_WEB_TITLE;
$System_Keyword = SYSTEM_WEB_KEYWORD;
$System_Description = SYSTEM_WEB_DESCRIPTION;

//--------------------------------------------------------------
include_once(SYSTEM_DOC_ROOT."system/core-start-home.php");
include_once(SYSTEM_DOC_ROOT."system/core-body-home.php");
##########################################################
$arAdsCodeByKey="";
$sql1=" SELECT * FROM ".TABLE_ADS." WHERE ".TABLE_ADS."_Name<>'' ORDER BY RAND() ";
$query1=$dbh->prepare($sql1);
if($query1->execute()) {
    while($Row1=$query1->fetch()) {
        $arAdsCodeByKey[$Row1[TABLE_ADS."_KeyReplace"]]=str_replace("[#[#]","<",str_replace("[#]#]",">",str_replace("[/script]","</script>",str_replace("[script]","<script>",$Row1[TABLE_ADS."_Code"]))));
    }
}
##########################################################
?>
<script src="//cdnjs.cloudflare.com/ajax/libs/mobile-detect/1.3.1/mobile-detect.min.js"></script>
<script>
window.fbAsyncInit = function() { FB.init({ appId : '<?php echo CONFIG_APPID; ?>', xfbml : true, version : 'v2.5' }); };
(function(d, s, id){ var js, fjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) {return;} js = d.createElement(s); js.id = id; js.src = "//connect.facebook.net/en_US/sdk.js"; fjs.parentNode.insertBefore(js, fjs); }(document, 'script', 'facebook-jssdk'));
function doFBShare(myid) { FB.ui({ method: 'share', href: 'http://www.baabin.com/'+myid+'/', }, function(response){}); }
</script>
<div class="pull-center padding-0 text-left webfont paddingbox1" style=" max-width:1080px; font-size:30px; height:40px; overflow:hidden; ">
    <div class="hashtaghead">HASTAG &gt;&nbsp;</div>
    <?php
    $sql=" SELECT * FROM ".TABLE_TAGS." WHERE ".TABLE_TAGS."_Name<>'' AND ".TABLE_TAGS."_NoOfUse>0 ";
    $sql.=" ORDER BY ".TABLE_TAGS."_NoOfUse DESC LIMIT 0,9 ";
    $query=$dbh->prepare($sql);
    if($query->execute()) {
        while($Row=$query->fetch()) {
            ?><div class="categoryHashTags"><a href="/hashtags/<?php echo $Row[TABLE_TAGS."_ID"]; ?>/1/" class="categoryHashTagsLink">#<?php echo $Row[TABLE_TAGS."_Name"]; ?></a></div><?php
        }
    } else { print_r($query->errorInfo()); }
    ?>
</div>
<!--##############################################-->
<div class="pull-center text-center paddingbox2" style=" max-width:1104px; ">
        <div class="featuredbox row width-100 pull-center">
        <?php
        $Config_PageSize=4;
        include(SYSTEM_DOC_ROOT."object/obj_show_featured.php");
        ?>
        </div>
</div>
<!--##############################################-->
<div class="pull-center text-center paddingbox3" style=" max-width:1098px; margin-top: 10px; ">
    <?php
    $AdsCode='[ADS01]';
    $myAdsByKey=isset($arAdsCodeByKey[$AdsCode])?$arAdsCodeByKey[$AdsCode]:"";
    if($myAdsByKey<>"") { echo $myAdsByKey; } else { ?>
    <div class="leaderboardads text-left"><?php echo $AdsCode; ?></div>
    <?php } ?>
</div>
<!--##############################################-->
<div class="pull-center text-center" style=" max-width:1098px; ">
    <div class="row width-100 padding-0" style=" margin:0px; width:100%; ">
        <!--##############################################-->
        <div class="col-xs-6 col-sm-4 col-md-3 col-lg-3 col-xxs-12 text-center paddingbox4">
            <table border="0" width="100%"><tr><td class="headbarbg1"></td><td class="text-right webfont headbar headbarbg2" style=" width:120px; ">ข่าวล่าสุด </td></tr></table>
            <?php
            $catid=0; $Config_PageSize=8; $itemID="news";
            include(SYSTEM_DOC_ROOT."object/obj_show_items_basic.php");
            ?>
            <div class="pull-center text-center" style=" width:100%; ">
                <?php
                $AdsCode='[ADS02]';
                $myAdsByKey=isset($arAdsCodeByKey[$AdsCode])?$arAdsCodeByKey[$AdsCode]:"";
                if($myAdsByKey<>"") { echo $myAdsByKey; } else { ?>
                <div class="leaderboardads text-left"><?php echo $AdsCode; ?></div>
                <?php } ?>
            </div>
        </div>
        <!--##############################################-->
        <div class="col-xs-6 col-sm-8 col-md-6 col-lg-6 col-xxs-12 text-center paddingbox5">
            <table border="0" width="100%"><tr><td class="headbarbg1"></td><td class="text-right webfont headbar headbarbg2" style=" width:160px; ">เรื่องเด่นตอนนี้</td></tr></table>
            <?php
            $Config_PageSize=7; $itemID="hotnews";
            include(SYSTEM_DOC_ROOT."object/obj_show_items_hotnews.php");
            ?>
        </div>
        <!--##############################################-->
        <div class="col-xs-6 col-sm-4 col-md-3 col-lg-3 col-xxs-12 text-center paddingbox6">
            <table border="0" width="100%"><tr><td class="headbarbg1"></td><td class="text-right webfont headbar headbarbg2" style=" width:120px; "> คลิปดัง </td></tr></table>
            <?php
            $catid=9; $Config_PageSize=3; $itemID="hotclip";
            include(SYSTEM_DOC_ROOT."object/obj_show_items_hotclip.php");
            ?>
            <div class="pull-center text-center" style=" width:100%; ">
                <?php
                $AdsCode='[ADS03]';
                $myAdsByKey=isset($arAdsCodeByKey[$AdsCode])?$arAdsCodeByKey[$AdsCode]:"";
                if($myAdsByKey<>"") { echo $myAdsByKey; } else { ?>
                <div class="leaderboardads text-left"><?php echo $AdsCode; ?></div>
                <?php } ?>
            </div>
        </div>
        <!--##############################################-->
        <div class="col-xs-6 col-sm-4 col-md-3 col-lg-3 col-xxs-12 text-center paddingbox7">
            <table border="0" width="100%"><tr><td class="headbarbg1"></td><td class="text-right webfont headbar headbarbg2" style=" width:120px; "> การเมือง </td></tr></table>
            <?php
            $catid=4; $Config_PageSize=7; $itemID="politics";
            include(SYSTEM_DOC_ROOT."object/obj_show_items_basic.php");
            ?>
        </div>
        <!--##############################################-->
        <div class="col-xs-6 col-sm-4 col-md-6 col-lg-6 col-xxs-12 text-center paddingbox8">
            <table border="0" width="100%"><tr><td class="headbarbg1"></td><td class="text-right webfont headbar headbarbg2" style=" width:120px; "> บันเทิง </td></tr></table>
            <?php
            $catid=5; $Config_PageSize=6; $itemID="entertainment";
            include(SYSTEM_DOC_ROOT."object/obj_show_items_basic_big.php");
            ?>
            <div class="pull-center text-center" style=" width:100%; ">
                <?php
                $AdsCode='[ADS04]';
                $myAdsByKey=isset($arAdsCodeByKey[$AdsCode])?$arAdsCodeByKey[$AdsCode]:"";
                if($myAdsByKey<>"") { echo $myAdsByKey; } else { ?>
                <div class="leaderboardads text-left"><?php echo $AdsCode; ?></div>
                <?php } ?>
            </div>
        </div>
        <!--##############################################-->
        <div class="col-xs-6 col-sm-4 col-md-3 col-lg-3 col-xxs-12 text-center paddingbox9">
            <table border="0" width="100%"><tr><td class="headbarbg1"></td><td class="text-right webfont headbar headbarbg2" style=" width:120px; "> รูปเด็ด </td></tr></table>
            <?php
            $catid=21; $Config_PageSize=4; $itemID="picture";
            include(SYSTEM_DOC_ROOT."object/obj_show_items_picture.php");
            ?>
        </div>
        <!--##############################################-->
        <div class="col-xs-6 col-sm-4 col-md-3 col-lg-3 col-xxs-12 text-center paddingbox10">
            <table border="0" width="100%"><tr><td class="headbarbg1"></td><td class="text-right webfont headbar headbarbg2" style=" width:120px; "> ท่องเที่ยว </td></tr></table>
            <?php
            $catid=10; $Config_PageSize=7; $itemID="travel";
            include(SYSTEM_DOC_ROOT."object/obj_show_items_basic.php");
            ?>
            <div class="pull-center text-center" style=" width:100%; ">
                <?php
                $AdsCode='[ADS05]';
                $myAdsByKey=isset($arAdsCodeByKey[$AdsCode])?$arAdsCodeByKey[$AdsCode]:"";
                if($myAdsByKey<>"") { echo $myAdsByKey; } else { ?>
                <div class="leaderboardads text-left"><?php echo $AdsCode; ?></div>
                <?php } ?>
            </div>
        </div>
        <!--##############################################-->
        <div class="col-xs-6 col-sm-4 col-md-6 col-lg-6 col-xxs-12 text-center paddingbox11">
            <table border="0" width="100%"><tr><td class="headbarbg1"></td><td class="text-right webfont headbar headbarbg2" style=" width:120px; "> กีฬา </td></tr></table>
            <?php
            $catid=3; $Config_PageSize=7; $itemID="sport";
            include(SYSTEM_DOC_ROOT."object/obj_show_items_basic_big.php");
            ?>
        </div>
        <!--##############################################-->
        <div class="col-xs-6 col-sm-4 col-md-3 col-lg-3 col-xxs-12 text-center paddingbox12">
            <table border="0" width="100%"><tr><td class="headbarbg1"></td><td class="text-right webfont headbar headbarbg2" style=" width:160px; "> ภาพยนตร์ </td></tr></table>
            <?php
            $catid=6; $Config_PageSize=4; $itemID="movies";
            include(SYSTEM_DOC_ROOT."object/obj_show_items_picture.php");
            ?>
            <div id="idbanner06" class="text-center" style=" width:100%; ">
                <?php
                $AdsCode='[ADS06]';
                $myAdsByKey=isset($arAdsCodeByKey[$AdsCode])?$arAdsCodeByKey[$AdsCode]:"";
                if($myAdsByKey<>"") { echo $myAdsByKey; } else { ?>
                <div class="leaderboardads text-left"><?php echo $AdsCode; ?></div>
                <?php } ?>
            </div>
        </div>
        <!--##############################################-->
        <div class="col-xs-6 col-sm-4 col-md-6 col-lg-6 col-xxs-12 text-center paddingbox13">
            <table border="0" width="100%"><tr><td class="headbarbg1"></td><td class="text-right webfont headbar headbarbg2" style=" width:120px; "> ทั่วไป </td></tr></table>
            <?php
            $catid=7; $Config_PageSize=6; $itemID="general";
            include(SYSTEM_DOC_ROOT."object/obj_show_items_basic_big.php");
            ?> 
        </div>
        <!--##############################################-->
        <div class="col-xs-6 col-sm-4 col-md-6 col-lg-6 col-xxs-12 text-center paddingbox14">
            <table border="0" width="100%"><tr><td class="headbarbg1"></td><td class="text-right webfont headbar headbarbg2" style=" width:160px; "> เกร็ดความรู้  </td></tr></table>
            <?php
            $catid=8; $Config_PageSize=6; $itemID="knowledge";
            include(SYSTEM_DOC_ROOT."object/obj_show_items_basic_big.php");
            ?>
        </div>
        <!--##############################################-->
    </div>
</div>
<!--##############################################-->
<br>
<div class="pull-center text-center paddingbox15" style=" max-width:1098px; ">
    <?php
    $AdsCode='[ADS07]';
    $myAdsByKey=isset($arAdsCodeByKey[$AdsCode])?$arAdsCodeByKey[$AdsCode]:"";
    if($myAdsByKey<>"") { echo $myAdsByKey; } else { ?>
    <div class="leaderboardads text-left"><?php echo $AdsCode; ?></div>
    <?php } ?>
</div>
<br>
<!--##############################################-->
<div class="pull-center text-center" style=" max-width:1098px; ">
    <div class="row width-100 padding-0" style=" margin:0px; width:100%; ">
        <!--##############################################-->
        <div class="col-xs-6 col-sm-4 col-md-6 col-lg-6 col-xxs-12 text-center paddingbox13">
            <table border="0" width="100%"><tr><td class="headbarbg1"></td><td class="text-right webfont headbar headbarbg2" style=" width:120px; "> ข่าว PR </td></tr></table>
            <?php
            $catid=24; $Config_PageSize=6; $itemID="general";
            include(SYSTEM_DOC_ROOT."object/obj_show_items_basic_big.php");
            ?> 
        </div>
        <!--##############################################-->
        <div class="col-xs-6 col-sm-4 col-md-6 col-lg-6 col-xxs-12 text-center paddingbox14">
            <table border="0" width="100%"><tr><td class="headbarbg1"></td><td class="text-right webfont headbar headbarbg2" style=" width:160px; "> ข่าว Viral </td></tr></table>
            <?php
            $catid=25; $Config_PageSize=6; $itemID="knowledge";
            include(SYSTEM_DOC_ROOT."object/obj_show_items_basic_big.php");
            ?>
        </div>
        <!--##############################################-->
    </div>
</div>
<!--##############################################-->
<style>
.tabhotnews-active { color:#ea0654; display:block; width:<?php echo floor(100/$Config_TabBoxCount); ?>%; height:40px; text-align:center; float:left!important; font-size:18px; font-weight:bold; }
.tabhotnews { color:#000000; display:block; width:<?php echo floor(100/$Config_TabBoxCount); ?>%; height:40px; text-align:center; float:left!important; font-size:18px; font-weight:bold; }
.itemspanel-hotnews { padding:5px; background-color:#FFFFFF; height: 40px; overflow: hidden; }
.spacearea-news, .spacearea-hotnews, .spacearea-hotclip, .spacearea-politics, .spacearea-entertainment, .spacearea-picture, .spacearea-travel,
.spacearea-sport, .spacearea-movies, .spacearea-general, .spacearea-general, .spacearea-knowledge { background-color:#FFFFFF; }
.boxindent-basica { height:6px; }
.boxindent-basicax { height:6px; }
.boxindent-picturea { height:6px; }
.boxindent-pictureax { height:6px; }
.featuredbox-text { padding: 0px; }
.featuredbox-textarea { padding: 5px; height:80px; background: url('/templates/bb/img/tb.png'); }
.itemspanel-hotnews-text { padding:0px; }
.hotnews-textarea { height:50px; padding: 5px; background: url('/templates/bb/img/tb.png'); overflow:hidden; }

/* ------------------------------------ */
@media only screen and (max-width : 552px) {
    .tabhotnews-active { font-size:13px; height:30px; }
    .tabhotnews { font-size:13px; height:30px; }
    .itemspanel-hotnews { height: 30px; }
}
/* ------------------------------------ */
@media only screen and (max-width : 480px) {
    .tabhotnews-active { font-size:18px; }
    .tabhotnews { font-size:18px; }
    .itemspanel-hotnews { height: 40px; }
}
/* ------------------------------------ */
@media only screen and (max-width : 350px) {
    .tabhotnews-active { font-size:13px; height:30px; }
    .tabhotnews { font-size:13px; height:30px; }
    .itemspanel-hotnews { height: 30px; }
}
</style>
<?php
include_once(SYSTEM_DOC_ROOT."system/core-end-home.php");
include_once("cache-end.php");
?>