<?php  if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } ?>
<div class="row" style=" padding-left:20px; padding-right:20px; ">
<!-------------------------------------------------------->
<?php if($myMenuKey=="MyDraft") { $myState="success"; } else { $myState="primary"; } ?>
<div class="col-xs-4 col-sm-3 col-md-3 col-lg-2 padding-2">
<button type="submit" class="btn btn-<?php echo $myState; ?> btn-block btn-flat btn-menu2" onclick=" location.href='allcontent.php'; ">
<span class="glyphicon glyphicon-book"></span> <br class="br-menu2"> <small style="font-size:12px;">ฉบับร่าง <span class="hidden-xs" style="font-size:12px;">ของฉัน</span></small></button>
</div>
<!-------------------------------------------------------->
<?php if($myMenuKey=="MyContent") { $myState="success"; } else { $myState="primary"; } ?>
<div class="col-xs-4 col-sm-3 col-md-3 col-lg-2 padding-2">
<button type="submit" class="btn btn-<?php echo $myState; ?> btn-block btn-flat btn-menu2" onclick=" location.href='allcontent-my.php'; ">
<span class="glyphicon glyphicon-book"></span> <br class="br-menu2"> <small style="font-size:12px;">บทความ <span class="hidden-xs" style="font-size:12px;">ของฉัน</span></small></button>
</div>
<!-------------------------------------------------------->
<?php if($myMenuKey=="AllContent") { $myState="success"; } else { $myState="primary"; } ?>
<div class="col-xs-4 col-sm-3 col-md-3 col-lg-2 padding-2">
<button type="submit" class="btn btn-<?php echo $myState; ?> btn-block btn-flat btn-menu2" onclick=" location.href='allcontent-all.php'; ">
<span class="glyphicon glyphicon-book"></span> <br class="br-menu2"> <small style="font-size:12px;"><span class="hidden-xs" style="font-size:12px;">บทความ</span>ทั้งหมด</small></button>
</div>
<!-------------------------------------------------------->
</div>