<?php // Use For Web Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } ?>
<?php
//--------------------------------------------
// Config Example
//--------------------------------------------
/*
$Config_Input_DataSourceID=$myDataSourceID;
$Config_Input_DefaultValue=$Row[$myField];
//--------------------------------------------
$Config_Input_Table=$table; // Update Table
$Config_Input_Field=$myField;  // SET myFiled=Current Value
$Config_Input_FieldUpdateKey=$myFirstField; // WHERE UpdateKey=
$Config_Input_ID=$myID;  // WHERE UpdateKey=ID
//--------------------------------------------
$Config_Input_Key=$myField;
*/
?>
<div class="padding-10 border-1 border-gray border-radius-5 pull-left" style=" cursor:pointer; " onclick=" 
 showPopUpWindow('<strong>เลือกข้อมูล</strong>','<?php echo $Config_Input_DataSourceID; ?>:'+$('#myDataID<?php echo $Config_Input_Key; ?>').val(),'<?php echo $Config_Input_Key; ?>'); 
 autoSave('<?php echo $Config_Input_ID; ?>','<?php echo $myField."#".$table."#".$myFirstField; ?>','');
 ">
<div class="padding-10" style=" height:24px; min-width:200px; max-width:250px; overflow:hidden;" id="input<?php echo $Config_Input_Key; ?>HTML">
<?php 
if($Config_Input_DataSourceID>0) {
    DMS_ShowDataSource($Config_Input_DataSourceID,$Config_Input_DefaultValue);
} else {
    echo '<font color=#990000><b>&nbsp;&nbsp;คลิ๊ก เพื่อเลือกข้อมูล</b></font>';
}
?></div>
</div>
<input type="hidden" id="myDataID<?php echo $Config_Input_Key; ?>" value="<?php echo $Config_Input_DefaultValue; ?>"><!-- Data ID --> 
<div class="txtAutoTextResult"><span id="idAutoSave<?php echo $Config_Input_Key; ?>">&nbsp;</span></div>
