<?php  if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- To use this object , You must include this library first ------------------------>
<script type="text/javascript" src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/js-select2/select2.js"></script>
<link rel="stylesheet" href="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/js-select2/select2.min.css">
<!---------------------------------------------------------------------------------------------->
<?php } ?>
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
$Config_BlankID="0"; // not select state (set blank '' for not use)
$Config_BlankText="-"; // not select state (set blank '' for not use)
//--------------------------------------------
$Config_UniqueID=$myField.$myID;
$Config_DefaultValue=$Row[$myField];
$Config_Width="100px";
//--------------------------------------------
$myFieldText="";
$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=SelectID#".$myFieldText."#=SelectText#WHERE#".$myKeyField."#=#".$myID;
//--------------------------------------------
*/
$Config_DBx=System_Encode($Config_DB);
?>
<select id="input<?php echo $Config_UniqueID; ?>" class="form-control select2" width="100">
<?php if($Config_BlankID=="") { } else { ?><option value="<?php echo $Config_BlankID; ?>"><?php echo $Config_BlankText; ?></option><?php } ?>

<?php for($Config_I=0;$Config_I<sizeof($Config_DataSourceArrayID);$Config_I++) { ?>
<option value="<?php echo $Config_DataSourceArrayID[$Config_I]; ?>"
<?php if($Config_DefaultValue==$Config_DataSourceArrayID[$Config_I]) { echo ' selected="selected" '; } ?>>
<?php echo $Config_DataSourceArrayText[$Config_I]; ?> </option>
<?php } ?>
</select>
<div class="txtAutoTextResult"><span id="idAutoSave<?php echo $Config_UniqueID; ?>">&nbsp;</span></div>
<script>
//-------------------------------------------
$("#input<?php echo $Config_UniqueID; ?>").select2(<?php if($Config_Width=='') { } else { echo " { width: '".$Config_Width."' } "; } ?>).on("change", function(e) {
	<?php echo $Config_OnChangeFunction; ?>
	var selectObj = $('#input<?php echo $Config_UniqueID; ?>');
	var theID = $(selectObj).select2('data').id;
	var theSelection = $(selectObj).select2('data').text;
	OneInput_DoSaveSelect('<?php echo $Config_UniqueID; ?>','<?php echo $Config_DBx; ?>',theID,theSelection);
});
</script>