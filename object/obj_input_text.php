<?php // Use For Web Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } ?>
<?php
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
$Config_Input_MaxChar=$arDMS_MaxChar[$myField];
$Config_Input_Width="300"; //px
$Config_Input_TextPosition=$arDMS_TextPosition[$myField];
//--------------------------------------------
$Config_Input_Key=$myField;
//--------------------------------------------
*/
?>
<input id="input<?php echo $Config_Input_Key; ?>" type="text" class="form-control border-default inputSize"
 maxlength="<?php echo $Config_Input_MaxChar; ?>" 
 style=" width:<?php
   if($Config_Input_Width=='') {
      if($Config_Input_MaxChar<=5) { echo "120"; } 
      else if($Config_Input_MaxChar*13<=250) { echo $Config_Input_MaxChar*13; } 
      else { echo "250"; }
   } else {
      echo $Config_Input_Width;
   }
 ?>px; text-align:<?php echo $Config_Input_TextPosition; ?>; " 
 value="<?php echo $Config_Input_DefaultValue; ?>" 
 onchange="
 autoSave('<?php echo $Config_Input_ID; ?>','<?php echo $Config_Input_Field."#".$Config_Input_Table."#".$Config_Input_FieldUpdateKey; ?>',$('#input<?php echo $Config_Input_Key; ?>').val());
 doSave(); "
/>
 
<div class="txtAutoTextResult"><span id="idAutoSave<?php echo $Config_Input_Key; ?>">&nbsp;</span></div>