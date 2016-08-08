<?php  if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php }
include_once("cache-start.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);
//--------------------------------------------------------------
$tid=(isset($_GET['tid'])?$_GET['tid']:null);
$tid=trim($tid)*1;
if($tid=="") { exit; }
$page=(isset($_GET['page'])?$_GET['page']:null);
$page=trim($page)*1;
if($page=="") { $page=1; }
//--------------------------------------------------------------
$System_LayoutUse="layout_view.html";
$System_AjaxFileAction="ajax-index.php";
$System_ShowAjaxIFrame=0;
include_once("_config/config_system.php");
include_once(SYSTEM_DOC_ROOT."system/core-start-ajax-home.php");
//--------------------------------------------------------------
$sql="SELECT * FROM ".TABLE_TAGS." WHERE ".TABLE_TAGS."_ID=:tid LIMIT 0,1 ";
$query=$dbh->prepare($sql);
$query->bindParam(':tid', $tid, PDO::PARAM_INT);
if($query->execute()) {
    $Row=$query->fetch();
    $myTagsName=$Row[TABLE_TAGS."_Name"];
} else { print_r($query->errorInfo()); }
$System_Title='#'.$myTagsName;
//--------------------------------------------------------------
include_once(SYSTEM_DOC_ROOT."system/core-start-home.php");
include_once(SYSTEM_DOC_ROOT."system/core-body-home.php");
#########################################################################################################################################################
?>
<link rel="stylesheet" href="/templates/bb/css/font.css">
<script>
  window.fbAsyncInit = function() { FB.init({ appId : '<?php echo CONFIG_APPID; ?>', xfbml : true, version : 'v2.5' }); };
  (function(d, s, id){ var js, fjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) {return;} js = d.createElement(s); js.id = id; js.src = "//connect.facebook.net/en_US/sdk.js"; fjs.parentNode.insertBefore(js, fjs); }(document, 'script', 'facebook-jssdk'));
  function doFBShare(myid) { FB.ui({ method: 'share', href: 'http://www.baabin.com/'+myid+'/', }, function(response){}); }

  function doFBShare2(myid) {
    window.open(
      'https://www.facebook.com/sharer/sharer.php?u=http://www.baabin.com/'+myid+'/',
      '_blank' // <- This is what makes it open in a new window.
    );
  }
</script>
<!--##############################################-->
<div class="pull-center text-center" style=" max-width:960px; ">
    <table border="0" width="100%"><tr><td class="headbarbg1"></td><td class="text-right webfont headbar headbarbg2" style=" width:180px; "> #<?php echo $myTagsName; ?> </td></tr></table>
    <div class="padding-10 border-radius-5 text-left" style=" background-color:#ffffff; font-size:16px; margin-top: 10px; ">
    <!--##############################################-->
    <?php
    $Config_PageSize=32;
    //######################################################################################
    $params = array("%,$tid,%");
    $sql="SELECT COUNT(*) FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_Tags LIKE ? AND ".TABLE_CONTENT."_Thumb<>'' AND ".TABLE_CONTENT."_Subject<>''  AND ".TABLE_CONTENT."_Text<>''  AND ".TABLE_CONTENT."_Status='Publish' ";
    $query=$dbh->prepare($sql);
    $query->execute($params);
    $Row=$query->fetch();
    $TotalRecordCount=$Row[0];
    $RecordStart=($page-1)*$Config_PageSize;
    if($TotalRecordCount>0) {
    //######################################################################################
    ?>
    <div class="row width-100 padding-0" style=" margin:0px; ">
    <?php
    $looper=1;
    //--------------------------------------------
    $Config_FolderKey1="thumb";
    $Config_FolderKey2="thumb2";
    $Config_FolderKey3="thumb3";
    $params = array("%,$tid,%");
    $sql="SELECT * FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_Tags LIKE ? AND ".TABLE_CONTENT."_Thumb<>'' AND ".TABLE_CONTENT."_Subject<>''  AND ".TABLE_CONTENT."_Text<>''  AND ".TABLE_CONTENT."_Status='Publish' ORDER BY ".TABLE_CONTENT."_OnlineDate DESC LIMIT ".$RecordStart.",".$Config_PageSize." ";
    $query=$dbh->prepare($sql);
    if($query->execute($params)) {
    while($Row=$query->fetch()) {
        $myID=$Row[TABLE_CONTENT."_ID"];
        $myThumb=$Row[TABLE_CONTENT."_Thumb"];
        $myThumb2=$Row[TABLE_CONTENT."_Thumb2"];
        $myThumb3=$Row[TABLE_CONTENT."_Thumb3"];
        $mySubject=$Row[TABLE_CONTENT."_Subject"];
        $isVideo=$Row[TABLE_CONTENT."_isVideo"];
		//--------------------------------------------
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
        if($tid==6) { // if movies
			$PictureThumb=$PictureThumb3;
        } else {
			$PictureThumb=$PictureThumb1;
        }
		?>
		<div class="boxsizing" style=" padding-top:25px; ">
			<div class="borderpicmovie borderpic pull-center">
				<a href="/<?php echo $myID; ?>/"><img src="<?php echo $PictureThumb; ?>" class="pictureresize" /></a>
				<div class="makeBlock width-100">
					<?php if($isVideo) { ?>
					<div class="bt-playarea"><div class="bt-play cursor"></div></div>
					<?php } ?>
					<div class="categoryTags-basica pull-left"><?php echo $myTagsName; ?></div>
					<div class="fb-share pull-right cursor" onclick=" doFBShare2(<?php echo $myID; ?>); "></div>
				</div>
				<div class="textsizearea"><a href="/<?php echo $myID; ?>/" class="picturelink"><?php echo $mySubject; ?></a></div>
			</div>
		</div>
		<?php
		$looper++;
    }} else { print_r($query->errorInfo()); }
    ?>
    </div>
    <?php
    $pagepadding=4+1;
    $maxpage=ceil($TotalRecordCount/$Config_PageSize);
    ?>
    <div class="padding-20 text-center">
        <div class="btn-group">
        <button type="button" class="btn btn-default <?php if($page==1) { echo " disabled "; } ?>" onclick=" doPage(1); "><i class="fa fa-chevron-left"></i></button>
        <?php if($page>$pagepadding) { ?>
        <button type="button" class="btn btn-default disabled hidden-xs"><i class="fa fa-ellipsis-h"></i></button>
        <?php } ?>
        <?php for($i=1;$i<=$maxpage;$i++) { ?>
            <?php if($i==$page) { ?>
                <button type="button" class="btn btn-default disabled"><b><?php echo $i; ?></b></button>
            <?php } else { ?>
                <?php if($i>$page-$pagepadding && $i<$page+$pagepadding) { ?>
                <button type="button" class="btn btn-default <?php if($i==$page) { echo ' disabled '; } ?> <?php if($i<$page-2 || $i>$page+2) { echo ' hidden-xs '; } ?>" onclick=" doPage(<?php echo $i; ?>); ">
                <a href="/hashtags/<?php echo $tid; ?>/<?php echo $i; ?>/" class="paginglink"><?php echo $i; ?></a>
                </button>
                <?php } ?>
            <?php } ?>
        <?php } ?>
        <?php if($page<$maxpage-$pagepadding) { ?>
        <button type="button" class="btn btn-default disabled hidden-xs"><i class="fa fa-ellipsis-h"></i></button>
        <?php } ?>
        <button type="button" class="btn btn-default <?php if($page==$maxpage) { echo " disabled "; } ?>" onclick=" doPage(<?php echo $maxpage; ?>); "><i class=" fa fa-chevron-right"></i></button>
        </div>
    </div>
    <!--##############################################-->
    <?php
    } else {
        ?>
        <div class="text-center">
            <br><br><br><br>
            <img src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/img/logo-notfound.png" />
            <br>
                <h1 class="webfont" style=" color:#AAAAAA; ">ขออภัย ไม่พบข้อมูล ที่ต้องการ!</h1>
            <br><br><br><br><br><br>
        </div>
        <?php
    }
    ?>
    <br>
    <!--##############################################-->
    </div>
</div>
<style>
a.paginglink:link { color: #666666!important; text-decoration: none; font-size:14px; }
a.paginglink:visited { color: #666666!important; text-decoration: none; font-size:14px; }
a.paginglink:active { color: #000000!important; text-decoration: none; font-size:14px; }
a.paginglink:hover { color: #000000!important; text-decoration: none; font-size:14px; }
a.paginglinkx:link { color: #FFFFFF!important; text-decoration: none; font-size:14px; }
a.paginglinkx:visited { color: #FFFFFF!important; text-decoration: none; font-size:14px; }
a.paginglinkx:active { color: #FFFFFF!important; text-decoration: none; font-size:14px; }
a.paginglinkx:hover { color: #FFFFFF!important; text-decoration: none; font-size:14px; }

.borderpicmovie { width:100%; height:auto; }
.borderpicmovie1 { width:200px; height:auto; border:0px; border-radius: 5px 5px 0px 0px; -moz-border-radius: 5px 5px 0px 0px; -webkit-border-radius: 5px 5px 0px 0px; }
.borderpicmovie2 { width:200px; height:40px; padding:5px; overflow:hidden; text-align:center; font-size:11px; color:#666666; font-weight:bold; }
.borderpic { -webkit-border-radius: 5px 5px 5px 5px; border: 1px solid #e1e3df; padding: 0px; }

.pictureresize { width:100%; height:auto;  border-radius: 5px 5px 0px 0px; -moz-border-radius: 5px 5px 0px 0px; -webkit-border-radius: 5px 5px 0px 0px; }
.textsizearea { width:100%; height:56px; padding:5px; padding-left:10px; padding-right:10px; overflow:hidden; text-align:left; font-size:11px; color:#666666; }
.boxsizing { width:25%; padding:10px; height:auto; display: block; float:left!important;  } /* pull left */

.headbar { font-size:24px; font-weight:bold; padding:0px; height:40px; }
.headbarbg1 { background: url('<?php echo SYSTEM_WEB_CDN_PATH_FULL; ?>/templates/bb/img/hbar-bgx.png'); height:40px; }
.headbarbg2 { background: url('<?php echo SYSTEM_WEB_CDN_PATH_FULL; ?>/templates/bb/img/hbar-bg1x.png') no-repeat; height:40px; }
.makeBlock { display: inline-block; }
.categoryTags-basica { color: #FFFFFF; background-color: #eb0254; padding: 1px; padding-left: 5px; padding-right: 5px; font-size: 10px; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; margin-left: 3px; margin-top: 4px; }
.fb-share { background: url('<?php echo SYSTEM_WEB_CDN_PATH_FULL; ?>/templates/bb/img/bt-fb-shares.png'); width:55px; height:15px; margin-top:4px; }
.fb-share:hover { background: url('<?php echo SYSTEM_WEB_CDN_PATH_FULL; ?>/templates/bb/img/bt-fb-share.png'); width:55px; height:15px; margin-top:4px; }

.bt-playarea { height:120px; margin-top:-120px; display:block; }
.bt-play { background: url('<?php echo SYSTEM_WEB_CDN_PATH_FULL; ?>/templates/bb/img/play.png'); width:60px; height:60px; opacity: 0.6; display:block; margin-left: auto; margin-right: auto; padding:1px; }
.bt-play:hover { background: url('<?php echo SYSTEM_WEB_CDN_PATH_FULL; ?>/templates/bb/img/play.png'); width:60px; height:60px; opacity: 1; display: block;  margin-left: auto; margin-right: auto; padding:1px; }

/* Medium Devices, Desktops */
@media only screen and (max-width : 992px) {
	.boxsizing { width:33%; padding:4px; height:auto; display: block; float:left!important;  } /* pull left */
}
/* Small Devices, Tablets */
@media only screen and (max-width : 768px) {
	.boxsizing { width:50%; padding:4px; height:auto; display: block; float:left!important;  } /* pull left */
}
/* Extra Small Devices, Phones */
@media only screen and (max-width : 480px) {
	.boxsizing { width:100%; padding:0px; height:auto; display: block; float:left!important;  } /* pull left */
}
</style>
<script>
//-------------------------
function doPage(mypage) {
//-------------------------
    location.href='/hashtags/<?php echo $tid; ?>/'+mypage+'/';
}
</script>
<!--##############################################-->
<?php
include_once(SYSTEM_DOC_ROOT."system/core-end-home.php");
include_once("cache-end.php");
?>
