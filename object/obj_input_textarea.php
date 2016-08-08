<?php // Use For Web Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } ?>
<?php
// script will upload file to ------> /upload/cache/
// and move to sub folder     ------> /upload/table-field/xxxxxx
//--------------------------------------------
// Config Example
//--------------------------------------------
/*
$Config_Input_DefaultValue=$Row[$myField];
//--------------------------------------------
$Config_Input_Table=$table; // Update Table
$Config_Input_Field=$myField;  // SET myFiled=Current Value
$Config_Input_FieldUpdateKey=$myFirstField; // WHERE UpdateKey=
$Config_Input_ID=$myID;  // WHERE UpdateKey=ID
//--------------------------------------------
$Config_Input_Width='440'; // px
$Config_Input_Row=4;
//--------------------------------------------
$Config_Input_Key=$myField;
*/
if($Config_Input_Row=="" || $Config_Input_Row==0) { $Config_Input_Row=4; }
?>
<div id="id<?php echo $Config_Input_Key; ?>TextArea">
<textarea id="input<?php echo $Config_Input_Key; ?>" class="form-control" rows="<?php echo $Config_Input_Row; ?>" style=" width:<?php
 if($Config_Input_Width<>'') { echo $Config_Input_Width."px"; } else { echo "100%"; } ?>; "
 onchange=" autoSave('<?php echo $Config_Input_ID; ?>','<?php echo $Config_Input_Field."#".$Config_Input_Table."#".$Config_Input_FieldUpdateKey; ?>',$('#input<?php echo $Config_Input_Key; ?>').val()); doSave(); "
 ><?php echo $Config_Input_DefaultValue; ?></textarea>
</div>
<div class="txtAutoTextResult"><span id="idAutoSave<?php echo $Config_Input_Key; ?>">&nbsp;</span>
</div>