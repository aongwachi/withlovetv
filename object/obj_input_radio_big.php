<?php // Use For Web Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } ?>
<?php
//--------------------------------------------
// Config Example
//--------------------------------------------
/*
//--------------------------------------------
$Config_Input_DefaultValue=$Row[$myField];
$Config_Input_Array_Radio_Text=$arTmpName;
$Config_Input_Array_Radio_Value=$arTmpValue;
//--------------------------------------------
$Config_Input_Table=$table; // Update Table
$Config_Input_Field=$myField;  // SET myFiled=Current Value
$Config_Input_FieldUpdateKey=$myFirstField; // WHERE UpdateKey=
$Config_Input_ID=$myID;  // WHERE UpdateKey=ID
//--------------------------------------------
$Config_Input_Key=$myID.$myField;
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
    $Config_Input_Array_Radio_Text=$arReturn['name'];
    $Config_Input_Array_Radio_Value=$arReturn['value'];
}
?>
<?php for($Config_Input_i=0;$Config_Input_i<sizeof($Config_Input_Array_Radio_Value);$Config_Input_i++) { if($Config_Input_Array_Radio_Value[$Config_Input_i]<>"") { ?>
<?php if(sizeof($Config_Input_Array_Radio_Value)>1) { ?>
<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 padding-2 text-left" style=" text-align:left; ">
<?php } else { ?>
<div class="padding-2 text-left" style=" text-align:left; ">
<?php } ?>
        <input type="radio" class="regular-checkbox" name="input<?php echo $Config_Input_Key; ?>" id="input<?php echo $Config_Input_Key; ?><?php echo $Config_Input_i; ?>" value="<?php echo $Config_Input_Array_Radio_Value[$Config_Input_i]; ?>" style=" cursor:pointer; " 
        <?php if($Config_Input_DefaultValue==$Config_Input_Array_Radio_Value[$Config_Input_i]) { echo ' checked="checked" '; } ?> onclick="
        autoSave('<?php echo $Config_Input_ID; ?>','<?php echo $Config_Input_Field."#".$Config_Input_Table."#".$Config_Input_FieldUpdateKey; ?>','<?php echo $Config_Input_Array_Radio_Value[$Config_Input_i]; ?>');
        doSave();
        " />
        <label class="pull-left" for="input<?php echo $Config_Input_Key; ?><?php echo $Config_Input_i; ?>"></label>
        <div class="pull-left">
        <label for="input<?php echo $Config_Input_Key; ?><?php echo $Config_Input_i; ?>" style=" cursor:pointer; " onclick="
        autoSave('<?php echo $Config_Input_ID; ?>','<?php echo $Config_Input_Field."#".$Config_Input_Table."#".$Config_Input_FieldUpdateKey; ?>','<?php echo $Config_Input_Array_Radio_Value[$Config_Input_i]; ?>');
        doSave();
        "> <sub><?php echo $Config_Input_Array_Radio_Value[$Config_Input_i]; ?></sub>
                <?php echo $Config_Input_Array_Radio_Text[$Config_Input_i]; ?>
        </label>
        </div>
</div>
<?php } } ?>
<div class="txtAutoTextResult"><span id="idAutoSave<?php echo $Config_Input_Key; ?>">&nbsp;</span></div>

<?php if(sizeof($Config_Input_Array_Radio_Value)==1) { ?>
<script> $('#input<?php echo $Config_Input_Key; ?>Labels').hide(); </script>
<?php } ?>
