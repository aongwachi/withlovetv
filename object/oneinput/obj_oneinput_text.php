<?php // Use For Web Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } ?>
<?php
/*
//--------------------------------------------
// Object Config Example
//--------------------------------------------
$Config_UniqueID=$myField.$myID;
$Config_DefaultValue=$Row[$myField];
$Config_DB="UPDATE#".$myTable."#SET#".$myField."#=xxx#WHERE#".$myKeyField."#=#".$myID;
//--------------------------------------------
$Config_MaxChar=100;
$Config_Width="300px";
$Config_TextAlign="left";
$Config_EndWord=" baht";
$Config_PlaceHolder="Test";
//--------------------------------------------
$Config_OnChangeFunction = " doOnChangeFunction(); ";
$Config_OnFocusFunction = " doOnFucusFunction(); ";
//--------------------------------------------
*/
if(!isset($Config_MaxChar)) { $Config_MaxChar=100; }
if(!isset($Config_Width)) { $Config_Width="100%"; }
if(!isset($Config_TextAlign)) { $Config_TextAlign="left"; }
if(!isset($Config_EndWord)) { $Config_EndWord=""; }
if(!isset($Config_PlaceHolder)) { $Config_PlaceHolder="Input text"; }
if(!isset($Config_OnChangeFunction)) { $Config_OnChangeFunction=""; }
if(!isset($Config_OnFocusFunction)) { $Config_OnFocusFunction=""; }
$Config_Type_Input=isset($Config_Type_Input)&&$Config_Type_Input=="file"?$Config_Type_Input:"text";
$Config_DBx=System_Encode($Config_DB);
?>
<div style=" display: table; padding: 0px; " class="width-100">
<div style=" float: none; display: table-cell; vertical-align: top; padding: 0px; width:<?php echo $Config_Width; ?>; ">
    <input id="input<?php echo $Config_UniqueID; ?>" type="<?=$Config_Type_Input?>" class="form-control border-default inputSize" placeholder="<?php echo $Config_PlaceHolder; ?>"
    maxlength="<?php echo $Config_MaxChar; ?>" style=" width:<?php echo $Config_Width; ?>; text-align:<?php echo $Config_TextAlign; ?>; " 
    value="<?php echo $Config_DefaultValue; ?>"
    onchange=" <?php if($Config_Type_Input == "text") {?>
                <?php echo $Config_OnChangeFunction; ?> OneInput_DoSaveText('<?php echo $Config_UniqueID; ?>','<?php echo $Config_DBx; ?>',$('#input<?php echo $Config_UniqueID; ?>').val());
               <?php }else{ ?>
                    AjaxUploadFile('<?php echo $Config_UniqueID; ?>','<?php echo $Config_DBx; ?>');
               <?php } ?>
             "
    onfocus=" <?php echo $Config_OnFocusFunction; ?> " 
     />
</div>
<?php if($Config_Width=='100%' || $Config_EndWord=='') { } else { ?> 
<div style=" float: none; display: table-cell; vertical-align: bottom; text-align: left; padding: 0px; padding-left: 5px; line-height: 45px; "> <?php echo $Config_EndWord; ?> </div>
<?php } ?>
</div>

<div class="txtAutoTextResult"><span id="idAutoSave<?php echo $Config_UniqueID; ?>">&nbsp;</span></div>