<?php // Use For Web Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } ?>
<?php
/*
//--------------------------------------------
// Object Config Example
//--------------------------------------------
$Config_UniqueID=$myField.$myID;
$Config_DefaultValue=$Row[$myField];
$Config_Input_Row=5;
//--------------------------------------------
*/
if($Config_Input_Row=="" || $Config_Input_Row==0) { $Config_Input_Row=4; }
?>
<textarea id="input<?php echo $Config_UniqueID; ?>" type="text" class="form-control border-default inputSize" rows="<?php echo $Config_Input_Row; ?>" style=" width:100%; "><?php echo $Config_DefaultValue; ?></textarea>