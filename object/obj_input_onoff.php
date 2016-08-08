<?php // Use For Web Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } ?>
<?php
//--------------------------------------------
// Config Example
//--------------------------------------------
/*
$Config_Input_DataSourceID=$myDataSourceID;
//-------------------------------------------- or
$Config_Input_Array_YesNo_Text=array($arTmpName[0],$arTmpName[1]); // yes , no
$Config_Input_Array_YesNo_Value=array($arTmpValue[0],$arTmpValue[1]); // yes , no
//--------------------------------------------
$Config_Input_Array_YesNo_Class=array('success','danger'); // yes , no
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
if($Config_Input_DataSourceID>0) {
    if(sizeof($Config_Input_DataSource_Array[$Config_Input_DataSourceID])>0) {
        // skip, use old array
    } else {
        // new load
        $Config_Input_DataSource_Array[$Config_Input_DataSourceID]=DMS_LoadDataSourceArray($Config_Input_DataSourceID);
    }
    $arReturn=$Config_Input_DataSource_Array[$Config_Input_DataSourceID];
    $Config_Input_Array_YesNo_Text=$arReturn['name'];
    $Config_Input_Array_YesNo_Value=$arReturn['value'];
}
if($Config_Input_DefaultValue==$Config_Input_Array_YesNo_Value[0]) { $isChecked=true; } else { $isChecked=false; }
?>
<input type="checkbox" name="input<?php echo $Config_Input_Key; ?>Switch" id="input<?php echo $Config_Input_Key; ?>Switch" class="bootstrapSwitch" 
 data-size="normal" data-on-text="<?php echo $Config_Input_Array_YesNo_Text[0]; ?>" data-off-text="<?php echo $Config_Input_Array_YesNo_Text[1]; ?>"
 data-on-color="<?php echo $Config_Input_Array_YesNo_Class[0]; ?>" data-off-color="<?php echo $Config_Input_Array_YesNo_Class[1]; ?>"
 <?php if($isChecked) { echo ' checked="checked" '; } ?>>
 <input type="hidden" name="input<?php echo $Config_Input_Key; ?>" id="input<?php echo $Config_Input_Key; ?>"
 value="<?php if($isChecked) { echo $Config_Input_Array_YesNo_Value[0]; } else { echo $Config_Input_Array_YesNo_Value[1]; } ?>" />
<div class="txtAutoTextResult"><span id="idAutoSave<?php echo $Config_Input_Key; ?>">&nbsp;</span></div>
<script>
$('#input<?php echo $Config_Input_Key; ?>Switch').bootstrapSwitch().on('switchChange.bootstrapSwitch', function(event, state) {
    if(state) { $('#input<?php echo $Config_Input_Key; ?>').val('<?php echo $Config_Input_Array_YesNo_Value[0]; ?>');
    } else {    $('#input<?php echo $Config_Input_Key; ?>').val('<?php echo $Config_Input_Array_YesNo_Value[1]; ?>'); }
    autoSave('<?php echo $Config_Input_ID; ?>','<?php echo $Config_Input_Field."#".$Config_Input_Table."#".$Config_Input_FieldUpdateKey; ?>',$('#input<?php echo $Config_Input_Key; ?>').val());
    doSave();
});
</script>