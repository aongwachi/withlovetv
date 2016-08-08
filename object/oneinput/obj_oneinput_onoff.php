<?php // Use For Web Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } ?>
<?php
//--------------------------------------------
// Object Config Example
//--------------------------------------------
/*
$Config_UniqueID=$myField.$myID;
$Config_DefaultValue=$Row[$myField];
$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
//--------------------------------------------
$Config_Array_YesNo_Text=array($arTmpName[0],$arTmpName[1]); // yes , no
$Config_Array_YesNo_Value=array($arTmpValue[0],$arTmpValue[1]); // yes , no
//--------------------------------------------
$Config_Array_YesNo_Class=array('success','danger'); // yes , no
//--------------------------------------------
*/
$Config_DBx=System_Encode($Config_DB);
if($Config_DefaultValue==$Config_Array_YesNo_Value[0]) {
$isChecked=true; } else { $isChecked=false; }
?>
<input type="checkbox" name="input<?php echo $Config_UniqueID; ?>Switch" id="input<?php echo $Config_UniqueID; ?>Switch" class="bootstrapSwitch" 
 data-size="normal" data-on-text="<?php echo $Config_Array_YesNo_Text[0]; ?>" data-off-text="<?php echo $Config_Array_YesNo_Text[1]; ?>"
 data-on-color="<?php echo $Config_Array_YesNo_Class[0]; ?>" data-off-color="<?php echo $Config_Array_YesNo_Class[1]; ?>"
 <?php if($isChecked) { echo ' checked="checked" '; } ?>>
 <input type="hidden" name="input<?php echo $Config_UniqueID; ?>" id="input<?php echo $Config_UniqueID; ?>"
 value="<?php if($isChecked) { echo $Config_Array_YesNo_Value[0]; } else { echo $Config_Array_YesNo_Value[1]; } ?>" />
<div class="txtAutoTextResult"><span id="idAutoSave<?php echo $Config_UniqueID; ?>">&nbsp;</span></div>
<script>
$('#input<?php echo $Config_UniqueID; ?>Switch').bootstrapSwitch().on('switchChange.bootstrapSwitch', function(event, state) {
    if(state) { $('#input<?php echo $Config_UniqueID; ?>').val('<?php echo $Config_Array_YesNo_Value[0]; ?>');
    } else {    $('#input<?php echo $Config_UniqueID; ?>').val('<?php echo $Config_Array_YesNo_Value[1]; ?>'); }
    OneInput_DoSaveText('<?php echo $Config_UniqueID; ?>','<?php echo $Config_DBx; ?>',$('#input<?php echo $Config_UniqueID; ?>').val());
});
</script>