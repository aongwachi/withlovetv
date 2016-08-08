<?php  if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } ?>
<div class="row" style=" padding-left:20px; padding-right:20px; ">
<!-------------------------------------------------------->
<?php if($myMenuKey=="AdsReplace") { $myState="success"; } else { $myState="primary"; } ?>
<div class="col-xs-4 col-sm-3 col-md-3 col-lg-2 padding-2">
<button type="submit" class="btn btn-<?php echo $myState; ?> btn-block btn-flat btn-menu2" onclick=" location.href='ads.php'; ">
<span class="glyphicon glyphicon-tag"></span> <br class="br-menu2"> <small style="font-size:12px;">โฆษณา</small></button>
</div>
<!-------------------------------------------------------->
<?php if($myMenuKey=="AdsContent") { $myState="success"; } else { $myState="primary"; } ?>
<div class="col-xs-4 col-sm-3 col-md-3 col-lg-2 padding-2">
<button type="submit" class="btn btn-<?php echo $myState; ?> btn-block btn-flat btn-menu2" onclick=" location.href='ads-content.php'; ">
<span class="glyphicon glyphicon-tag"></span> <br class="br-menu2"> <small style="font-size:12px;">โฆษณาในบทความ</small></button>
</div>
<!-------------------------------------------------------->
</div>