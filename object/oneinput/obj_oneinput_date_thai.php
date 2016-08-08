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
$arTmp=explode("-",$Config_DefaultValue);
$Config_DefaultValue=($arTmp[0]+543)."-".$arTmp[1]."-".$arTmp[2];
//#############################################################################
?>
<div style=" display: table; padding: 0px; " class="width-100">
<div style=" float: none; display: table-cell; vertical-align: top; padding: 0px; width:80px; ">
<input id="input<?php echo $Config_UniqueID; ?>" type="text" class="form-control border-default inputSize" maxlength="10" 
 style=" width:120px; text-align:center; " value="<?php echo $Config_DefaultValue; ?>" 
 onchange=" <?php echo $Config_OnChangeFunction; ?>
 OneInput_DoSaveDateThai('<?php echo $Config_UniqueID; ?>','<?php echo $Config_DBx; ?>',$('#input<?php echo $Config_UniqueID; ?>').val()); 
 " />
<div style=" float: none; display: table-cell; vertical-align: top; text-align: left; padding: 0px; padding-left: 5px; line-height: 45px; "> <?php echo $Config_EndWord; ?> </div>
</div>
<div class="txtAutoTextResult"><span id="idAutoSave<?php echo $Config_UniqueID; ?>">&nbsp;</span></div>
<script>
$(document).ready(function () {
    $("#input<?php echo $Config_UniqueID; ?>").datetimepicker({  
        todayButton: true,
        datepicker: true,
        timepicker: false,
        format: 'Y-m-d',
        mask:true,
        lang:'th',
        onChangeMonth:datetimepicker_ThaiYear,
        onShow:datetimepicker_ThaiYear,
        yearOffset:543,
        closeOnDateSelect:true
    });
});
</script>