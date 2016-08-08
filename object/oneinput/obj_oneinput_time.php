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
$Config_EndWord=" baht";
//--------------------------------------------
$Config_OnChangeFunction = " doOnChangeFunction(); ";
//--------------------------------------------
*/
$Config_DBx=System_Encode($Config_DB);

//#############################################################################
if($Config_DefaultValue=="00:00:00") {
    $Config_TimeValue=substr(SYSTEM_TIMENOW,0,5); // Time Now
} else {
    $Config_TimeValue=substr($Config_DefaultValue,0,5);
}
//#############################################################################
?>
<div style=" display: table; padding: 0px; " class="width-100">
<div style=" float: none; display: table-cell; vertical-align: top; padding: 0px; width:80px; ">
<input id="input<?php echo $Config_UniqueID; ?>" type="text" class="form-control border-default inputSize" maxlength="5" 
 style=" width:76px; text-align:center; " value="<?php echo $Config_TimeValue; ?>" 
 onchange=" 
 <?php echo $Config_OnChangeFunction; ?>
 OneInput_DoSaveText('<?php echo $Config_UniqueID; ?>','<?php echo $Config_DBx; ?>',$('#input<?php echo $Config_UniqueID; ?>').val());
 " />
<div style=" float: none; display: table-cell; vertical-align: top; text-align: left; padding: 0px; padding-left: 5px; line-height: 45px; "> <?php echo $Config_EndWord; ?> </div>
</div>
<div class="txtAutoTextResult"><span id="idAutoSave<?php echo $Config_UniqueID; ?>">&nbsp;</span></div>
<script>
$("#input<?php echo $Config_UniqueID; ?>").datetimepicker({ 
    todayButton: true,
    datepicker: false,
    timepicker: true,
    step: 1,
    mask:true,
    format: 'H:i'
});
</script>