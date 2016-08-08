<?php // Use For Web Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php  } ?>
<?php
//------------------------------------------------------------------------
$sql=" SELECT * FROM ".SYSTEM_TABLE_DEPARTMENT." WHERE 1 ORDER BY name ASC ";
$Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
while($Row = mysql_fetch_array($Query)) {
	$arDepDataID[]=$Row['id'];
	$arDepDataText[]=$Row['name'];
}
//--------------------------------------------
$Config_Input_DataSourceID=0;
$Config_Input_Array_Select_Text=$arDepDataText; // datasource array
$Config_Input_Array_Select_Value=$arDepDataID; // datasource array
//--------------------------------------------
$Config_Input_DefaultValue=$dept_id;
$Config_Input_UnselectValue="";
//--------------------------------------------
$Config_Input_Table=FORM_TABLE_EMR; // Update Table
$Config_Input_Field='dept_id';  // SET myFiled=Current Value
$Config_Input_FieldUpdateKey='id'; // WHERE UpdateKey=
$Config_Input_ID=$inputEMRID;  // WHERE UpdateKey=ID
//--------------------------------------------
$Config_Input_Key='dept_id';
//--------------------------------------------


$Config_Input_Filter_Array_Select_Text=$arTmpName; // datasource array
$Config_Input_Filter_Array_Select_Value=$arTmpValue; // datasource array
//--------------------------------------------
$Config_Input_Filter_DefaultValue=$Row[$myField];
$Config_Input_Filter_UnselectValue="";
//--------------------------------------------
$Config_Input_Filter_Key=$myField;

include(SYSTEM_DOC_ROOT."object/obj_input_filter_select.php");
?>	