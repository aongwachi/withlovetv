<?php // Use For Web Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } ?>
<?php
//--------------------------------------------
// Config Example
//--------------------------------------------
/*
$Config_Input_DataSourceID=$myDataSourceID;
//-------------------------------------------- or
$Config_Input_Array_CheckBox_Text=$arTmpName;
$Config_Input_Array_CheckBox_Value=$arTmpValue;
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
if($Config_Input_DataSourceID>0) {
    if(sizeof($Config_Input_DataSource_Array[$Config_Input_DataSourceID])>0) {
        // skip, use old array
    } else {
        // new load
        $Config_Input_DataSource_Array[$Config_Input_DataSourceID]=DMS_LoadDataSourceArray($Config_Input_DataSourceID);
    }
    $arReturn=$Config_Input_DataSource_Array[$Config_Input_DataSourceID];
    $Config_Input_Array_CheckBox_Text=$arReturn['name'];
    $Config_Input_Array_CheckBox_Value=$arReturn['value'];
}
?>
<div class="btn-group" data-toggle="buttons-checkbox">
<?php for($Config_Input_i=0;$Config_Input_i<sizeof($Config_Input_Array_CheckBox_Value);$Config_Input_i++) { if($Config_Input_Array_CheckBox_Value[$Config_Input_i]<>"") { ?>
<button type="button" class="btn btn-info <?php if(strpos(" ".$Config_Input_DefaultValue,",".$Config_Input_Array_CheckBox_Value[$Config_Input_i].",")>0) { echo ' active '; } ?>"
onclick=" 
    autoSave('<?php echo $Config_Input_ID; ?>','<?php echo $Config_Input_Field."#".$Config_Input_Table."#".$Config_Input_FieldUpdateKey; ?>','<?php echo $Config_Input_Array_CheckBox_Value[$Config_Input_i]; ?>'); 
    doSaveCheckBox(); 
"> <?php echo $Config_Input_Array_CheckBox_Text[$Config_Input_i]; ?> </button>
<?php } } ?>
</div>
<div class="txtAutoTextResult"><span id="idAutoSave<?php echo $Config_Input_Key; ?>">&nbsp;</span></div>
