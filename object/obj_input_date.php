<?php // Use For Web Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } ?>
<?php
//--------------------------------------------
// Config Example
//--------------------------------------------
/*
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
//#############################################################################
if($Config_Input_DefaultValue=="0000-00-00") { 
    $myEasyDate="";
    $Config_Input_Value="";
    $myEasyDate="";
} else { 
    $myEasyDate=System_ShowDateTimeEasy($Config_Input_DefaultValue." 00:00:00");
    // Add Date for Buddhist era format
    $arTmp=explode("-",$Config_Input_DefaultValue);
    $Config_Input_Year=$arTmp[0]+543;
    $Config_Input_DateValue=$Config_Input_Year."-".$arTmp[1]."-".$arTmp[2];
} 
//#############################################################################
?>
<input id="input<?php echo $Config_Input_Key; ?>" type="text" class="form-control border-default inputSize" maxlength="10" 
    style=" width:120px; text-align:center; " value="<?php echo $Config_Input_DateValue; ?>"
    onfocus=" autoSaveDate('<?php echo $Config_Input_ID; ?>','<?php echo $Config_Input_Field."#".$Config_Input_Table."#".$Config_Input_FieldUpdateKey; ?>',$('#input<?php echo $Config_Input_Key; ?>').val()); "
    onchange=" autoSaveDate('<?php echo $Config_Input_ID; ?>','<?php echo $Config_Input_Field."#".$Config_Input_Table."#".$Config_Input_FieldUpdateKey; ?>',$('#input<?php echo $Config_Input_Key; ?>').val());
    doSave(); "
    />
<?php if($myEasyDate<>"") { ?>
    <div class="pull-right text-right" style=" width:130px; margin-top:-22px; "><small><?php echo $myEasyDate; ?></small>
    <div class="txtAutoTextResult"><span id="idAutoSave<?php echo $Config_Input_Key; ?>"></span></div>
    </div>
<?php } else { ?>
    <div class="txtAutoTextResult"><span id="idAutoSave<?php echo $Config_Input_Key; ?>"></span></div>
<?php } ?>
<script>
$(document).ready(function () {
    $("#input<?php echo $Config_Input_Key; ?>").datetimepicker({  
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