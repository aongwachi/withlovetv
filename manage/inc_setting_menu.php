<?php  if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } ?>
<div class="row" style=" padding-left:20px; padding-right:20px; ">
<!-------------------------------------------------------->
<?php if($myMenuKey=="TagsGroup") { $myState="success"; } else { $myState="primary"; } ?>
<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 padding-2">
<button type="submit" class="btn btn-<?php echo $myState; ?> btn-block btn-flat btn-menu2" onclick=" location.href='tagsgroup-setting.php'; ">
<span class="glyphicon glyphicon-folder-open"></span> <br class="br-menu2"> <small>Tags Group</small></button>
</div>
<!-------------------------------------------------------->
<?php if($myMenuKey=="Tags") { $myState="success"; } else { $myState="primary"; } ?>
<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 padding-2">
<button type="submit" class="btn btn-<?php echo $myState; ?> btn-block btn-flat btn-menu2" onclick=" location.href='tags-setting.php'; ">
<span class="glyphicon glyphicon-tag"></span> <br class="br-menu2"> <small>Tags</small></button>
</div>
<!-------------------------------------------------------->
<?php if($myMenuKey=="Staff") { $myState="success"; } else { $myState="primary"; } ?>
<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 padding-2">
<button type="submit" class="btn btn-<?php echo $myState; ?> btn-block btn-flat btn-menu2" onclick=" location.href='staff.php'; ">
<span class="fa fa-user"></span> <br class="br-menu2"> <small>Staff</small></button>
</div>
</div>