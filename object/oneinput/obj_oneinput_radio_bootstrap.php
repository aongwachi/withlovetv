<?php
/*
//--------------------------------------------
// Object Config Example
//--------------------------------------------
$arDataID=array('1','3','5','6','7');
$arDataText=array('A1','B3','C5','D6','E7');
//--------------------------------------------
$Config_DataSourceArrayID=$arDataID; // your data id array
$Config_DataSourceArrayText=$arDataText; // your data text array
//--------------------------------------------
$Config_UniqueID=$myField.$myID;
$Config_DefaultValue=$Row[$myField];
$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
//--------------------------------------------
$Config_isShowUnselectValue=false;
$Config_BlankID=""; // not select state (set blank '' for not use)
$Config_BlankText=""; // not select state (set blank '' for not use)
//--------------------------------------------
*/
$Config_DBx=System_Encode($Config_DB);
?>
<div class="btn-group" data-toggle="buttons" id="input<?php echo $Config_UniqueID; ?>RadioBox">
<?php if($Config_isShowUnselectValue) { ?>
    <label class="btn btn-default btn-info <?php if($Config_DefaultValue==$Config_BlankID) { echo ' active '; } ?>" onclick="
    <?php echo str_replace("[value]",$Config_BlankID,$Config_OnChangeFunction); ?>
    OneInput_DoSaveText('<?php echo $Config_UniqueID; ?>','<?php echo $Config_DBx; ?>','<?php echo $Config_BlankID; ?>');
    ">
    <input type="radio" name="input<?php echo $Config_UniqueID; ?>" value="<?php echo $Config_BlankID; ?>" <?php if($Config_DefaultValue=="") { echo ' checked="checked" '; } ?>>&nbsp;</label>
<?php } ?>
<?php for($Config_I=0;$Config_I<sizeof($Config_DataSourceArrayID);$Config_I++) { if($Config_DataSourceArrayID[$Config_I]<>"") { ?>
    <label class="btn btn-default btn-info <?php if($Config_DefaultValue==$Config_DataSourceArrayID[$Config_I]) { echo ' active '; } ?>" onclick="
    <?php echo str_replace("[value]",$Config_DataSourceArrayID[$Config_I],$Config_OnChangeFunction); ?>
    OneInput_DoSaveText('<?php echo $Config_UniqueID; ?>','<?php echo $Config_DBx; ?>','<?php echo $Config_DataSourceArrayID[$Config_I]; ?>');
    ">
    <input type="radio" name="input<?php echo $Config_UniqueID; ?>" value="<?php echo $Config_DataSourceArrayID[$Config_I]; ?>"
    <?php if($Config_DefaultValue==$Config_DataSourceArrayID[$Config_I]) { echo ' checked="checked" '; } ?>>
    <?php echo $Config_DataSourceArrayText[$Config_I]; ?>
    </label>
<?php } } ?>
</div>
<div class="txtAutoTextResult"><span id="idAutoSave<?php echo $Config_UniqueID; ?>"></span></div>