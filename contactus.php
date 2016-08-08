<?php  if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } 
//error_reporting( E_ALL );
//ini_set('display_errors', 1);
include_once("cache-start.php");
//--------------------------------------------------------------
$catid=trim($_REQUEST['catid']);
if($catid==""){ $catid=1;}
$page=trim($_REQUEST['page']);
if($page==""){ $page=1;}
//--------------------------------------------------------------
$System_LayoutUse="layout_view.html";
$System_AjaxFileAction="ajax-index.php";
$System_ShowAjaxIFrame=0;
include_once("_config/config_system.php");
include_once(SYSTEM_DOC_ROOT."system/core-start-ajax.php");
//--------------------------------------------------------------
//AND ".TABLE_CONTENT."_Status='Publish' 
$sql="SELECT * FROM ".TABLE_CATEGORY." WHERE ".TABLE_CATEGORY."_ID='".$catid."' LIMIT 0,1 ";
//$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
$Query=mysqli_query($sql,$System_Connection1);
$Row=mysqli_fetch_array($Query);
$myCategoryName=$Row[TABLE_CATEGORY."_Name"];
$myFolderName=$Row[TABLE_CATEGORY."_Folder"];
$System_Title=$myCategoryName;
//--------------------------------------------------------------
include_once(SYSTEM_DOC_ROOT."system/core-start-home.php");
include_once(SYSTEM_DOC_ROOT."system/core-body-home.php");
#########################################################################################################################################################
?>
<link rel="stylesheet" href="/templates/bb/css/font.css">
<!--##############################################-->
<div class="pull-center text-center" style=" max-width:960px; ">
    <!--##############################################-->
    <div class="padding-10 border-radius-5 text-left" style=" background-color:#ffffff; font-size:16px; ">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="hidden-xs">
        <tr>
            <td class="bigbar1 webfont">CONTACT US</td>
            <td class="bigbar2"></td>
            <td class="bigbar3 webfont">ติดต่อเรา</td>
            <td class="bigbar4"></td>
        </tr>
    </table>
    <div class="width-100 visible-xs bigbar3" style=" text-align:left; padding-left:10px; ">
        <div class="pull-left webfont" style=" font-size:25px; padding-top:5px; ">ติดต่อเรา</div>
        <div class="bigbar4 pull-right"></div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
 <img src="http://cdn.baabin.com/img/contact.jpg" class="pictureresize" style="width:100%;">
    <br>
    <br>
    <br>
    <br>
    <br>
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

.panalwidth { width:25%; }
.borderpic { width:202px; height:182px; padding:0px; border-radius: 5px 5px 5px 5px; -moz-border-radius: 5px 5px 5px 5px; -webkit-border-radius: 5px 5px 5px 5px; border: 1px solid #e1e3df; padding:0px; }
.borderpic1 { width:200px; height:140px; border:0px; border-radius: 5px 5px 0px 0px; -moz-border-radius: 5px 5px 0px 0px; -webkit-border-radius: 5px 5px 0px 0px; }
.borderpic2 { width:200px; height:36px; padding:5px; overflow:hidden; text-align:left; font-size:11px; color:#666666; }

.borderpicmovie { width:202px; height:340px; padding:0px; border-radius: 5px 5px 5px 5px; -moz-border-radius: 5px 5px 5px 5px; -webkit-border-radius: 5px 5px 5px 5px; border: 1px solid #e1e3df; padding:0px; }
.borderpicmovie1 { width:200px; height:auto; border:0px; border-radius: 5px 5px 0px 0px; -moz-border-radius: 5px 5px 0px 0px; -webkit-border-radius: 5px 5px 0px 0px; }
.borderpicmovie2 { width:200px; height:40px; padding:5px; overflow:hidden; text-align:center; font-size:11px; color:#666666; font-weight:bold; }

/* Medium Devices, Desktops */
@media only screen and (max-width : 992px) {
    .panalwidth { width:33% }
}
/* Small Devices, Tablets */
@media only screen and (max-width : 768px) {
    .panalwidth { width:50% }
}
/* Extra Small Devices, Phones */ 
@media only screen and (max-width : 480px) {
    .panalwidth { width:100% }
}
</style>
<script>
$(function() { $("img.lazy").lazyload({ effect : "fadeIn" }); });
//-------------------------
function doPage(mypage) {
//-------------------------
    $('#page').val(mypage);
    $('#myPagingForm').submit();
}
</script>
<form name="myPagingForm" id="myPagingForm" method="get" action="category.php">
<input type="hidden" name="catid" id="catid" value="<?php echo $catid; ?>" >
<input type="hidden" name="page" id="page" value="<?php echo $page; ?>" >
</form>
<!--##############################################-->
<?php
include_once(SYSTEM_DOC_ROOT."system/core-end-home.php");
include_once("cache-end.php");
?>
