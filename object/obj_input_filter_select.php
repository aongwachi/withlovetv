<?php // Use For Web Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } ?>
<?php
//--------------------------------------------
// Config Example
//--------------------------------------------
/*
$Config_Input_Filter_Array_Select_Text=$arTmpName; // datasource array
$Config_Input_Filter_Array_Select_Value=$arTmpValue; // datasource array
//--------------------------------------------
$Config_Input_Filter_DefaultValue=$Row[$myField];
$Config_Input_Filter_UnselectValue="";
//--------------------------------------------
$Config_Input_Filter_Key=$myField;
*/
?>
<select id="input<?php echo $Config_Input_Filter_Key; ?>" class="form-control select2">
<option value="<?php echo $Config_Input_Filter_UnselectValue; ?>" <?php if($Config_Input_Filter_DefaultValue==$Config_Input_Filter_UnselectValue) { echo ' selected="selected" '; } ?>><?php echo $Config_Input_Filter_UnselectText; ?></option>
<?php for($Config_Input_Filter_i=0;$Config_Input_Filter_i<sizeof($Config_Input_Filter_Array_Select_Value);$Config_Input_Filter_i++) { ?>
<option value="<?php echo $Config_Input_Filter_Array_Select_Value[$Config_Input_Filter_i]; ?>" <?php if($Config_Input_Filter_DefaultValue==$Config_Input_Filter_Array_Select_Value[$Config_Input_Filter_i]) { echo ' selected="selected" '; } ?>> <?php echo $Config_Input_Filter_Array_Select_Text[$Config_Input_Filter_i]; ?> </option>
<?php } ?>
</select>

<script>
//-------------------------------------------
$("#input<?php echo $Config_Input_Filter_Key; ?>").select2().on("change", function(e) {
    doFunction_<?php echo $Config_Input_Filter_Key; ?>_OnChange();
});
//-------------------------------------------
</script>

