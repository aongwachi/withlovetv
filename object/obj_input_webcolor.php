<?php // Use For Web Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } ?>
<?php
//--------------------------------------------
// Config Example
//--------------------------------------------
/*
//--------------------------------------------
$Config_Input_DefaultValue=$Row[$myField];
//--------------------------------------------
$Config_Input_Table=$table; // Update Table
$Config_Input_Field=$myField;  // SET myFiled=Current Value
$Config_Input_FieldUpdateKey=$myFirstField; // WHERE UpdateKey=
$Config_Input_ID=$myID;  // WHERE UpdateKey=ID
//--------------------------------------------
$Config_Input_Key=$myField;
//--------------------------------------------
*/
?>
<div class="bfh-colorpicker cursor" data-color="<?php if($Config_Input_DefaultValue=="") { } else { echo $Config_Input_DefaultValue; }?>" 
data-name="input<?php echo $Config_Input_Key; ?>" data-close="false" style="width:160px;" 
onclick=" autoSaveWebColor('<?php echo $Config_Input_ID; ?>','<?php echo $Config_Input_Field."#".$Config_Input_Table."#".$Config_Input_FieldUpdateKey; ?>','<?php echo $Config_Input_Field; ?>'); ">
</div>
<div class="txtAutoTextResult"><span id="idAutoSave<?php echo $Config_Input_Key; ?>">&nbsp;</span></div>