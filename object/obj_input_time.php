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
//#############################################################################
if($Config_Input_DefaultValue=="00:00:00") {
    $Config_Input_TimeValue=substr(SYSTEM_TIMENOW,0,5); // Time Now
} else {
    $Config_Input_TimeValue=substr($Config_Input_DefaultValue,0,5);
}
//#############################################################################
?>
<input id="input<?php echo $Config_Input_Key; ?>" type="text" class="form-control border-default inputSize" maxlength="5" 
 style=" width:90px; text-align:center; " value="<?php echo $Config_Input_TimeValue; ?>" 
 onfocus=" autoSaveTime('<?php echo $Config_Input_ID; ?>','<?php echo $Config_Input_Field."#".$Config_Input_Table."#".$Config_Input_FieldUpdateKey; ?>',$('#input<?php echo $Config_Input_Key; ?>').val()); "
 onchange=" autoSaveTime('<?php echo $Config_Input_ID; ?>','<?php echo $Config_Input_Field."#".$Config_Input_Table."#".$Config_Input_FieldUpdateKey; ?>',$('#input<?php echo $Config_Input_Key; ?>').val()); doSave(); "
 />
<div class="txtAutoTextResult"><span id="idAutoSave<?php echo $Config_Input_Key; ?>">&nbsp;</span></div>
<script>
$("#input<?php echo $Config_Input_Key; ?>").datetimepicker({ 
    todayButton: true,
    datepicker: false,
    timepicker: true,
    step: 1,
    mask:true,
    format: 'H:i'
});
</script>