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
$Config_Width="300px";
$Config_TextAlign="left";
$Config_RowHeight=5;
$Config_Placeholder="Please comment!";
//--------------------------------------------
$Config_OnChangeFunction = " doOnChangeFunction(); ";
//--------------------------------------------
*/
if($Config_RowHeight>0) { } else { $Config_RowHeight=5; }
$Config_DBx=System_Encode($Config_DB);
if($Config_Width=='') { $Config_Width="100%"; }
?>
<div style=" display: table; padding: 0px; " class="width-100">
<div style=" float: none; display: table-cell; vertical-align: top; padding: 0px; width:<?php echo $Config_Width; ?>; ">
    <textarea id="input<?php echo $Config_UniqueID; ?>" placeholder="<?=$Config_Placeholder?>" class="form-control border-default inputSize" rows="<?php echo $Config_RowHeight; ?>" style=" width:<?php echo "100%"; ?>; "
    onchange=" <?php echo $Config_OnChangeFunction; ?> OneInput_DoSaveTextCode('<?php echo $Config_UniqueID; ?>','<?php echo $Config_DBx; ?>',$('#input<?php echo $Config_UniqueID; ?>').val()); " 
    ><?php echo $Config_DefaultValue; ?></textarea>
</div>
</div>

<div class="txtAutoTextResult"><span id="idAutoSave<?php echo $Config_UniqueID; ?>">&nbsp;</span></div>