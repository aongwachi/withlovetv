<?php // Use For Web Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } ?>
<?php
/*
//--------------------------------------------
// Object Config Example
//--------------------------------------------
$Config_UniqueID=$myField.$myID;
$Config_DefaultValue=$Row[$myField];
//--------------------------------------------
*/
$Config_DefaultValue=substr($Config_DefaultValue,0,10);
if($Config_DefaultValue=="" || $Config_DefaultValue=="0000-00-00") {
    // skip
} else {
    $arTmp=explode("-",$Config_DefaultValue);
    $Config_DefaultValue=($arTmp[0]+543)."-".$arTmp[1]."-".$arTmp[2];
}
?>
<input id="<?php echo $Config_UniqueID; ?>" type="text" class="form-control border-default inputSize" maxlength="10" 
        style=" width:120px; text-align:center; " value="<?php echo $Config_DefaultValue; ?>" />
<script>
$(document).ready(function () {
    $("#<?php echo $Config_UniqueID; ?>").datetimepicker({  
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
