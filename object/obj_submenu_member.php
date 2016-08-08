<?php
#############################################################################################################################################
$arMemberMenuText[]="วิธีการชำระเงิน / แจ้งโอนเงิน";
$arMemberMenuIcon[]="glyphicon glyphicon-bookmark";
$arMemberMenuLink[]="mypayment.php";
//----------------------------
$arMemberMenuText[]="แก้ไขที่อยู่ เพื่อรับสินค้า";
$arMemberMenuIcon[]="fa fa-truck";
$arMemberMenuLink[]="myaddress.php";
//----------------------------
$arMemberMenuText[]="ประวัติ การสั่งซื้อสินค้า";
$arMemberMenuIcon[]="fa fa-archive";
$arMemberMenuLink[]="myorder.php";
//----------------------------
$MemberMenuHeight=((sizeof($arMemberMenuLink)+2)*28)+4;
#############################################################################################################################################
?>
<ul class="drop-right Object_NavBarRightMenuDropDown" id="idObject_NavBarRightMenuDrop1Sub" style=" width:240px; height:<?=$MemberMenuHeight?>px; margin-top: 3px; padding: 6px; ">
<div class="list-group text-left" style="box-shadow : none; margin-bottom: 5px;">
<?php
#############################################################################################################################################
for($i=0;$i<sizeof($arMemberMenuLink);$i++) {
    ?>
    <a href="<?php echo $arMemberMenuLink[$i]; ?>" class="list-group-item text-left padding-5 Object_NavBarSubMenuLink">
    <span style=" padding-left: 10px; padding-right: 5px; " class="<?php echo $arMemberMenuIcon[$i]; ?>"></span> <?php echo $arMemberMenuText[$i]; ?></a>
    <?php
}
#############################################################################################################################################
?>
<?php if($SystemSession_Member_UID<>"" && $SystemSession_Member_UID<>"0") { ?>
<a href="javascript:void(0)" class="list-group-item text-left padding-5 Object_NavBarSubMenuLink" onclick=" facebooklogout(); ">
<span style=" padding-left: 10px; padding-right: 5px; " class="fa fa-power-off"></span> ออกจากระบบ </a>
<?php } else { ?>
<a href="logout.php" class="list-group-item text-left padding-5 Object_NavBarSubMenuLink">
<span style=" padding-left: 10px; padding-right: 5px; " class="fa fa-power-off"></span> ออกจากระบบ </a>
<?php } ?>
</div>
</ul>
