<?php  if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- To use this object , You must include this library first ------------------------>
<script type="text/javascript" src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/js-select2/select2.js"></script>
<link rel="stylesheet" href="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/js-select2/select2.min.css">
<!---------------------------------------------------------------------------------------------->
<?php } ?>
<?php
//-------------------------------------------------------
// Config Example
//-------------------------------------------------------
/*
$arDataID=array('1','3','5','6','7');
$arDataText=array('A1','B3','C5','D6','E7');
//-------------------------------------------------------
$Config_Obj_Input_SelectArray_DataSourceArrayID=$arDataID; // your data id array
$Config_Obj_Input_SelectArray_DataSourceArrayText=$arDataText; // your data text array
$Config_Obj_Input_SelectArray_DefaultValue=0; // default value
$Config_Obj_Input_SelectArray_ID=$inputEMRID; // record id to update
//-------------------------------------------------------
$Config_Obj_Input_SelectArray_Table="snomed_emr"; // Update Table
$Config_Obj_Input_SelectArray_UpdateFieldID="departmentid"; // SET Filed = Data ID
$Config_Obj_Input_SelectArray_UpdateFieldText="departmentname"; // SET Filed = Data Text ( if you want )
$Config_Obj_Input_SelectArray_IDField="id"; // Where id
//-------------------------------------------------------
$Config_Obj_Input_SelectArray_BlankID="0"; // not select state (set blank '' for not use)
$Config_Obj_Input_SelectArray_BlankText="-"; // not select state (set blank '' for not use)
//-------------------------------------------------------
$Config_Obj_Input_SelectArray_IDKey=$Config_Obj_Input_SelectArray_ID.$Config_Obj_Input_SelectArray_UpdateFieldID;
*/
?>
<select id="input<?php echo $Config_Obj_Input_SelectArray_IDKey; ?>" class="form-control select2">
<?php if($Config_Obj_Input_SelectArray_BlankID=="") { } else { ?>
<option value="<?php echo $Config_Obj_Input_SelectArray_BlankID; ?>"><?php echo $Config_Obj_Input_SelectArray_BlankText; ?></option>
<?php } ?>
<?php for($y=0;$y<sizeof($Config_Obj_Input_SelectArray_DataSourceArrayID);$y++) { ?>
<option value="<?php echo $Config_Obj_Input_SelectArray_DataSourceArrayID[$y]; ?>"
<?php if($Config_Obj_Input_SelectArray_DefaultValue==$Config_Obj_Input_SelectArray_DataSourceArrayID[$y]) { echo ' selected="selected" '; } ?>>
<?php echo $Config_Obj_Input_SelectArray_DataSourceArrayText[$y]; ?> </option>
<?php } ?>
</select>
<div class="txtAutoTextResult"><span id="idAutoSave<?php echo $Config_Obj_Input_SelectArray_IDKey; ?>">&nbsp;</span></div>
<script>
//-------------------------------------------
$("#input<?php echo $Config_Obj_Input_SelectArray_IDKey; ?>").select2().on("change", function(e) {
	var test = $('#input<?php echo $Config_Obj_Input_SelectArray_IDKey; ?>');
	var theID = $(test).select2('data').id;
	var theSelection = $(test).select2('data').text;
	autoSaveSelectArray('<?php echo $Config_Obj_Input_SelectArray_ID; ?>',
	'<?php echo $Config_Obj_Input_SelectArray_UpdateFieldID."#".$Config_Obj_Input_SelectArray_UpdateFieldText."#".
	$Config_Obj_Input_SelectArray_Table."#".$Config_Obj_Input_SelectArray_IDField; ?>',
	theID,theSelection); 
	doSave();
});
//-------------------------------------------
</script>