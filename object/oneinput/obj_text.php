<?php // Use For Web Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } ?>
<?php
//--------------------------------------------
// Object Config Example
//--------------------------------------------
/*
$Config_Width="";
$Config_UniqueID="";
$Config_PlaceHolder="";
$Config_MaxChar="";
$Config_TextAlign="";
$Config_DefaultValue="";
//--------------------------------------------
*/
if($Config_MaxChar=="") { $Config_MaxChar=100; }
if($Config_Width=='') { $Config_Width="100%"; }
?>
<input id="<?php echo $Config_UniqueID; ?>" type="text" class="form-control border-default inputSize" placeholder="<?php echo $Config_PlaceHolder; ?>" 
maxlength="<?php echo $Config_MaxChar; ?>" style=" width:<?php echo $Config_Width; ?>; text-align:<?php echo $Config_TextAlign; ?>; " 
value="<?php echo $Config_DefaultValue; ?>" />
