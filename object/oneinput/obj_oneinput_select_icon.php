<?php // Use For Web Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } ?>
<?php if(0) { ?>
<script type="text/javascript" src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/bootstrap3-dialog/bootstrap-dialog.min.js"></script>
<link rel="stylesheet" href="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/bootstrap3-dialog/bootstrap-dialog.min.css">
<style> .bootstrap-dialog .modal-header.bootstrap-dialog-draggable { cursor: move; } </style>
<?php } ?>
<?php
/*
//--------------------------------------------
// Object Config Example
//--------------------------------------------
$Config_UniqueID=$myField.$myID;
$Config_DefaultValue=$Row[$myField];
$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
//--------------------------------------------
*/
$Config_DBx=System_Encode($Config_DB);
if($Config_DefaultValue=="") { $Config_DefaultValue="glyphicon glyphicon-hand-up"; }
?>
<button id="inputIcon<?php echo $Config_UniqueID; ?>" type="button" class="btn btn-info btn-circle pull-left" style=" width:28x; height:28px; "
 onclick=" OneInput_ShowSelectIcon('<?php echo $Config_UniqueID; ?>','<?php echo str_replace("#","__",$Config_DBx); ?>'); ">
 <i class="<?php echo $Config_DefaultValue; ?>" style=" display:block; margin-top:-3px;"></i>
</button>
<div class="txtAutoTextResult"><span id="idAutoSave<?php echo $Config_UniqueID; ?>">&nbsp;</span></div>