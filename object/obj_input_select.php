<?php // Use For Web Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } ?>
<?php
//--------------------------------------------
// Config Example
//--------------------------------------------
/*
$Config_Input_DataSourceID=$myDataSourceID;
//-------------------------------------------- or
$Config_Input_Array_Select_Text=$arTmpName; // datasource array
$Config_Input_Array_Select_Value=$arTmpValue; // datasource array
//--------------------------------------------
$Config_Input_DefaultValue=$Row[$myField];
$Config_Input_UnselectValue="";
$Config_Input_isHideUnselectValue=true;
$Config_Input_Width='220'; // px
//--------------------------------------------
$Config_Input_Table=$table; // Update Table
$Config_Input_Field=$myField;  // SET myFiled=Current Value
$Config_Input_FieldUpdateKey=$myFirstField; // WHERE UpdateKey=
$Config_Input_ID=$myID;  // WHERE UpdateKey=ID
//--------------------------------------------
$Config_Input_Key=$myField;
$Config_Input_OnChangeFunction=" doRecalculate(); ";
*/
if($Config_Input_DataSourceID>0) {
    if(sizeof($Config_Input_DataSource_Array[$Config_Input_DataSourceID])>0) {
        // skip, use old array
    } else {
        // new load
        $Config_Input_DataSource_Array[$Config_Input_DataSourceID]=DMS_LoadDataSourceArray($Config_Input_DataSourceID);
    }
    $arReturn=$Config_Input_DataSource_Array[$Config_Input_DataSourceID];
    $Config_Input_Array_Select_Text=$arReturn['name'];
    $Config_Input_Array_Select_Value=$arReturn['value'];
}
?>
<select id="input<?php echo $Config_Input_Key; ?>" class="form-control select2" form="myEditForm" style=" width:<?php
 if($Config_Input_Width=="") { echo "100%"; } else { echo $Config_Input_Width."px"; } ?>; ">
<?php if($Config_Input_isHideUnselectValue) { } else { ?>
<option value="<?php echo $Config_Input_UnselectValue; ?>" <?php if($Config_Input_DefaultValue==$Config_Input_UnselectValue) { echo ' selected="selected" '; } ?>>-</option>
<?php } ?>
<?php for($Config_Input_i=0;$Config_Input_i<sizeof($Config_Input_Array_Select_Value);$Config_Input_i++) { ?>
<option value="<?php echo $Config_Input_Array_Select_Value[$Config_Input_i]; ?>" <?php if($Config_Input_DefaultValue==$Config_Input_Array_Select_Value[$Config_Input_i]) { echo ' selected="selected" '; } ?>> <?php echo $Config_Input_Array_Select_Text[$Config_Input_i]; ?> </option>
<?php } ?>
</select>
<div class="txtAutoTextResult"><span id="idAutoSave<?php echo $Config_Input_Key; ?>"></span></div>
<script>
//-------------------------------------------
$("#input<?php echo $Config_Input_Key; ?>").select2().on("change", function(e) {
        <?php echo $Config_Input_OnChangeFunction; ?>
        autoSave('<?php echo $Config_Input_ID; ?>','<?php echo $Config_Input_Field."#".$Config_Input_Table."#".$Config_Input_FieldUpdateKey; ?>',$('#input<?php echo $Config_Input_Key; ?>').val()); 
        doSave();
});
//-------------------------------------------
</script>

