<?php // Use For Web Editor Set Current Character Set as UTF-8 #################
include_once("../_config/config_system.php");
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } ?>
<div class="item item-pad">
    <a href="detail.php?p=<?php echo $arID[$cindex]; ?>" class="thumb"><img src="<?php if($arThumb3[$cindex]=="") { echo "img/nopic.png"; } else { echo $arThumb3[$cindex]; } ?>" /></a>
    <div class="desc">
        <div class="text">
            <a data-href="<?php echo 'http://'.SYSTEM_WEB_DOMAIN.SYSTEM_WEBPATH_ROOT.'/';?>detail.php?p=<?php echo $arID[$cindex]; ?>"
               class="btn btn-pink btnShare">แชร์</a>
        </div>
        <div style=" height:27px; overflow:hidden; "><p><?php if($arSubject[$cindex]=="") { echo "ไม่มีข้อมูล"; } else { echo $arSubject[$cindex]; } ?></p></div>
    </div>
</div>
