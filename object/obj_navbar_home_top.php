<?php // Use For Web Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php  } ?>
<!--- Top Bar Big -------------->
<div id="idObject_NavBarTop" class="Object_NavBarTop">
    <div class="pull-center padding-0" style=" max-width:1160px;">
    <a href="/"><span class="navbar-brand cursor"></span></a>
    <!---------------------------------------------------------->
    <div class="Object_NavBarLeft pull-left" id="idMainMenuText">
	<table class="header-menu-table"><tr>
	<td class="header-menu-block"><div class="<?php if($catid==1000) { echo ' boxunderline-active '; } else { echo ' boxunderline '; } ?>"><a href="/" class="<?php if($catid==1000) { echo ' header-menu-link-active '; } else { echo ' header-menu-link '; } ?> webfont">ข่าวหน้าหนึ่ง</a></div></td>
	<?php
	$index=0; $arTopMenuCatID=""; $arTopMenuCatName=""; $arTopMenuCatNameByID=""; $Config_TopMenuCount=2;
	$sql=" SELECT * FROM ".TABLE_CATEGORY." WHERE ".TABLE_CATEGORY."_Name<>'' AND ".TABLE_CATEGORY."_Folder<>'' ";
	$sql.=" ORDER BY ".TABLE_CATEGORY."_Ordering ASC ";
	$query=$dbh->prepare($sql);
	if($query->execute()) {
	    while($Row=$query->fetch()) {
		$arTopMenuCatID[$index]=$Row[TABLE_CATEGORY."_ID"];
		$arTopMenuCatName[$index]=$Row[TABLE_CATEGORY."_Name"];
		$arTopMenuCatNameByID[$Row[TABLE_CATEGORY."_ID"]]=$Row[TABLE_CATEGORY."_Name"];
		$index++;
		if($Row[TABLE_CATEGORY."_isMainMenu"]==1) {
		    ?>
		    <td class="header-menu-block"><div class="<?php if($catid==$Row[TABLE_CATEGORY."_ID"]) { echo ' boxunderline-active '; } else { echo ' boxunderline '; } ?>"><a href="/category/<?php echo $Row[TABLE_CATEGORY."_ID"]; ?>/1/" class="<?php if($catid==$Row[TABLE_CATEGORY."_ID"]) { echo ' header-menu-link-active '; } else { echo ' header-menu-link '; } ?>webfont"><?php echo $Row[TABLE_CATEGORY."_Name"]; ?></a></div></td>
		    <?php
		    $Config_TopMenuCount++;
		}
	    }
	} else { print_r($query->errorInfo()); }
	$Config_MenuWidthPercent=floor(100/($Config_TopMenuCount+4));
	?>
	<td class="header-menu-block"><div class="<?php if($catid==1001) { echo ' boxunderline-active '; } else { echo ' boxunderline '; } ?>"><a href="/contactus.php" class="<?php if($catid==1001) { echo ' header-menu-link-active '; } else { echo ' header-menu-link '; } ?> webfont">ติดต่อเรา</a></div></td>
	</tr></table>
    </div>
    <?php
    $Config_MenuWidthPercent=floor(100/11);
    ?>
    <!---------------------------------------------------------->
    <div class="Object_NavBarHideMenuLeft pull-right" id="idMainMenuRight">
		<div class="padding-5 cursor pull-right btmainmenu" style=" font-size:18px; margin-top: -2px; " onclick=" doHideMenuShow(); " id="idMainMenuBT1">
		<i class="menu-hide1 pull-left" style="margin-top: 2px;"></i>
		</div>
		<i class="padding-5 fa fa-search cursor btsearchicon pull-right" style="font-size:22px;" id="idMainMenuBT2"></i>
    </div>
    <!---------------------------------------------------------->
    <div class="Object_NavBarSearchInput pull-right" id="idMainMenuRightSearch" style=" display:none; ">
	<form action="/search.php" target="_top" method="get" onSubmit=" if($('#idSearch').val()=='') { $('#idSearch').focus(); return false; } else { return true; } ">
	<div class="input-group">
	    <input type="text" class="form-control" id="idSearch" name="search" placeholder="ค้นหา">
	    <span class="input-group-btn">
	    <button class="btn btn-default" type="submit">Go!</button>
	    </span>
	</div>
	</form>
    </div>
    <!---------------------------------------------------------->
    </div>
</div>
<!---------------------------------------------------------->
<div id="idObject_NavBarHideMenu" class="Object_NavBarHideMenu" style=" display:none; ">
    <div class="padding-10 Object_HideMenuTopBG">
	<div class="pull-right" style=" padding:0px; margin-top:-4px; ">
	<button type="button" class="btn btn-danger btn-flat" onclick=" doHideMenuClose(); "><i class="glyphicon glyphicon-remove"></i></button>
	</div>
	<span class="navbar-brands cursor">
    </div>
    <div class="padding-20" style="padding-top:0px; ">
	<div class="pull-center Object_NavBarHideMenuArea">
	    <div class="row width-100 padding-10" style="margin: 0; ">
		<div class="Object_NavBarHideMenuRow">
		    <a href="/" class="Object_NavBarHideMenuLink webfont">หน้าแรก</a>
		</div>
		<?php for($i=0;$i<sizeof($arTopMenuCatID);$i++) { ?>
		<div class="Object_NavBarHideMenuRow">
		    <a href="/category/<?php echo $arTopMenuCatID[$i]; ?>/1/" class="Object_NavBarHideMenuLink webfont"><?php echo $arTopMenuCatName[$i]; ?></a>
		</div>
		<?php } ?>
		<div class="Object_NavBarHideMenuRow">
		    <a href="/contactus.php" class="Object_NavBarHideMenuLink webfont">ติดต่อเรา</a>
		</div>
	    </div>
	    <div class="row width-100 padding-10" style="margin: 0; ">
		<form action="/search.php" target="_top" method="get" onSubmit=" if($('#idSearch1').val()=='') { $('#idSearch1').focus(); return false; } else { return true; } ">
		<div class="right-inner-addon">
		    <i class="glyphicon glyphicon-search" style=" margin-top:-3px; "></i>
		    <input type="search" id="idSearch1" name="search" class="form-control" placeholder="ค้นหา" />
		</div>
		</form>
	    </div>
	    <div class="row width-100 padding-10" style=" margin: 0; ">
		    <div class="width-100 webfont" style="font-size: 24px; "><b>Hashtag : </b></div>
		    <div class="width-100 padding-2">
			<?php
			$sql=" SELECT * FROM ".TABLE_TAGS." WHERE ".TABLE_TAGS."_Name<>'' AND ".TABLE_TAGS."_NoOfUse>0 ";
			$sql.=" ORDER BY ".TABLE_TAGS."_NoOfUse DESC LIMIT 0,9 ";
			$query=$dbh->prepare($sql);
			if($query->execute()) {
			    while($Row=$query->fetch()) {
				echo ' <a href="/hashtags.php?tid='.$Row[TABLE_TAGS."_ID"].'" style="font-size:22px;" class="Object_NavBarHideMenuLink webfont">#'.$Row[TABLE_TAGS."_Name"].'</a>  &nbsp; ';
			    }
			} else { print_r($query->errorInfo()); }
			?>
		    </div>
	    </div>
	</div>
    </div>
</div>
<!--- ########################################################################################### -->
<div id="idScrollToTop" class="Object_ScrollToTop2">
<button type="button" id="idScrollToTopBT" class="btn btn-default btn-circle" style=" width:50px; height:50px; font-size:30px; padding-top:0px; ">
<i class="fa fa-chevron-up"></i>
</button>
</div>
<script>
//-----------------------------------
function doHideMenuShow() {
//-----------------------------------
    $('#idObject_NavBarHideMenu').show();
    $('body').addClass('stop-scrolling');
    $('#idScrollToTop').hide();
}
//-----------------------------------
function doHideMenuClose() {
//-----------------------------------
    $('#idObject_NavBarHideMenu').hide();
    $('body').removeClass('stop-scrolling')
    $('#idScrollToTop').show();
}
//-----------------------------------
$(window).scroll(function () {
//-----------------------------------
    var myscrollhigh=$(window).scrollTop()
    if (myscrollhigh>200) {
	$('#idScrollToTop').switchClass("Object_ScrollToTop2","Object_ScrollToTop",1000,"easeInOutQuad");
    } else {
	$('#idScrollToTop').switchClass("Object_ScrollToTop","Object_ScrollToTop2",1000,"easeInOutQuad");
    }
});
//-----------------------------------
$("#idScrollToTopBT").click(function() {
//-----------------------------------
  $("html, body").animate({ scrollTop: 0 }, "slow");
  $("#idScrollToTopBT").blur();
  return false;
});
var checkSearchIsOn=0;
//-----------------------------------
$("#idMainMenuBT2").click(function() {
//-----------------------------------
    if (checkSearchIsOn==0) {
	$('#idMainMenuText').hide();
	$('#idMainMenuRightSearch').show();
	checkSearchIsOn=1;
    } else {
	$('#idMainMenuText').show();
	$('#idMainMenuRightSearch').hide();
	checkSearchIsOn=0;
	
    }
    return false;
});
</script>