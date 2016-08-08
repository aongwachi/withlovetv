<?php // Use For Web Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } ?>
<?php
//--------------------------------------------
// Object Config Example
//--------------------------------------------
/*
$Config_UniqueID="";
$Config_DefaultValue="";
$Config_EndWord=" baht";
//--------------------------------------------
*/
//#############################################################################
if($Config_DefaultValue=="00:00:00" || $Config_DefaultValue=="") {
    $Config_TimeValue=substr(SYSTEM_TIMENOW,0,5); // Time Now
} else {
    $Config_TimeValue=substr($Config_DefaultValue,0,5);
}
//#############################################################################
?>
<div style=" float: none; display: table-cell; vertical-align: top; padding: 0px; width:80px; ">
    <input id="<?php echo $Config_UniqueID; ?>" type="text" class="form-control border-default inputSize" maxlength="5" style=" width:76px; text-align:center; " value="<?php echo $Config_TimeValue; ?>" />
    <div style=" float: none; display: table-cell; vertical-align: top; text-align: left; padding: 0px; padding-left: 5px; line-height: 45px; "> <?php echo $Config_EndWord; ?> </div>
</div>
<script>
$("#<?php echo $Config_UniqueID; ?>").datetimepicker({ 
    todayButton: true,
    datepicker: false,
    timepicker: true,
    step: 1,
    mask:true,
    format: 'H:i'
});
</script>