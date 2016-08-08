<?php // Use For Web Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } ?>
<?php
//--------------------------------------------
// Config Example
//--------------------------------------------
/*
$Config_Input_DataSourceID=$myDataSourceID;
//--------------------------------------------
$Config_Input_DefaultValue=$Row[$myField];
//$Config_Input_Array_Tags_Text=$arTmpName;
//$Config_Input_Array_Tags_Value=$arTmpValue;
//--------------------------------------------
$Config_Input_Table=$table; // Update Table
$Config_Input_Field=$myField;  // SET myFiled=Current Value
$Config_Input_FieldUpdateKey=$myFirstField; // WHERE UpdateKey=
$Config_Input_ID=$myID;  // WHERE UpdateKey=ID
//--------------------------------------------
$Config_Input_Key=$myField;
//--------------------------------------------
*/

// if use datasource ###############################################################
if($Config_Input_DataSourceID>0) {
    if(sizeof($Config_Input_DataSource_Array[$Config_Input_DataSourceID])>0) {
        // skip, use old array
    } else {
        // new load
        $Config_Input_DataSource_Array[$Config_Input_DataSourceID]=DMS_LoadDataSourceArray($Config_Input_DataSourceID);
    }
    $arReturn=$Config_Input_DataSource_Array[$Config_Input_DataSourceID];
    $Config_Input_Array_Tags_Text=$arReturn['name'];
    $Config_Input_Array_Tags_Value=$arReturn['value'];
    //-----------------------------------------------
    $Config_Input_DataTags='';
    for($Config_Input_i=0;$Config_Input_i<sizeof($Config_Input_Array_Tags_Value);$Config_Input_i++) {
        if($Config_Input_DataTags=="") {
            $Config_Input_DataTags="{ id: '".$Config_Input_Array_Tags_Value[$Config_Input_i]."', text: '".$Config_Input_Array_Tags_Text[$Config_Input_i]."'} ";
        } else {
            $Config_Input_DataTags.=", { id: '".$Config_Input_Array_Tags_Value[$Config_Input_i]."', text: '".$Config_Input_Array_Tags_Text[$Config_Input_i]."'} ";
        }
    }
    //-----------------------------------------------
    if($Config_Input_DefaultValue<>"") {
            if(strpos($Config_Input_DefaultValue,",")>0) {
                    $arTmp=explode(",",$Config_Input_DefaultValue);
                    $Config_Input_DataValue="";
                    for($Config_Input_i=0;$Config_Input_i<sizeof($arTmp);$Config_Input_i++) {
                            if($Config_Input_i==0) {
                                    $Config_Input_DataValue=$arTmp[$Config_Input_i];
                            } else {
                                    $Config_Input_DataValue.=",".$arTmp[$Config_Input_i];
                            }
                    }	
            } else {
                    $Config_Input_DataValue=$Config_Input_DefaultValue;
            }
    } else {
            $Config_Input_DataValue='';
    }

// if no datasource ###############################################################
} else {

    //-----------------------------------------------
    if($Config_Input_DefaultValue<>"") {
        if(strpos($Config_Input_DefaultValue,",")>0) {
            $arTmp=explode(",",$Config_Input_DefaultValue);
            $Config_Input_DataValue=""; $Config_Input_DataTags="";
            for($Config_Input_i=0;$Config_Input_i<sizeof($arTmp);$Config_Input_i++) {
                if($Config_Input_i==0) {
                    $Config_Input_DataValue=$arTmp[$Config_Input_i];
                } else {
                    $Config_Input_DataValue.=",".$arTmp[$Config_Input_i];
                }
                $Config_Input_DataTags.=',"'.$arTmp[$Config_Input_i].'"';
            }							
        } else {
            $Config_Input_DataValue=$Config_Input_DefaultValue;
            $Config_Input_DataTags=',"'.$Config_Input_DefaultValue.'"';
        }
    } else {
        $Config_Input_DataValue=''; $Config_Input_DataTags='';
    }    
    //-----------------------------------------------

}
?>
<input type="hidden" id="input<?php echo $Config_Input_Key; ?>" class="form-control select2" style="width:90%;" value="<?=$Config_Input_DataValue?>" />
<div class="txtAutoTextResult" style=" z-index: 3000; "><div id="idAutoSave<?php echo $Config_Input_Key; ?>">&nbsp;</div></div>
<script>
$(document).ready(function() {
<?php
// Tag Select with DataSource -- Type to search and select multiple choice
if($Config_Input_DataSourceID>0) {
?>
    $("#input<?php echo $Config_Input_Key; ?>").select2({
        createSearchChoice:function(term, data) { return false; }, 
        multiple: true,
        tags:[<?=$Config_Input_DataTags?>]
    }).on("change", function(e) {
        autoSave('<?php echo $Config_Input_ID; ?>','<?php echo $Config_Input_Field."#".$Config_Input_Table."#".$Config_Input_FieldUpdateKey; ?>',$('#input<?php echo $Config_Input_Key; ?>').val());
        doSave();
    });
<?php
// Tag Select Freestyle -- Type and Enter to add new items multiple
} else {
?>
    $("#input<?php echo $Config_Input_Key; ?>").select2({
        createSearchChoice:function(term, data) { if ($(data).filter(function() { return this.text.localeCompare(term)===0; }).length===0) {return {id:term, text:term};} },
        multiple: true,
        tags:[{ id: '0', text: 'Type your tag and Enter', disabled: true }<?=$Config_Input_DataTags?>]
    }).on("change", function(e) {
        autoSave('<?php echo $Config_Input_ID; ?>','<?php echo $Config_Input_Field."#".$Config_Input_Table."#".$Config_Input_FieldUpdateKey; ?>',$('#input<?php echo $Config_Input_Key; ?>').val());
        doSave();
    });
<?php } ?>
});
</script>