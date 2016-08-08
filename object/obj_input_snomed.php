<?php // Use For Web Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php  } ?>
<?php
$Config_SnomedInput_Height=266;
if($Obj_Input_Snomed_FreqUse_Function=="") { $Obj_Input_Snomed_FreqUse_Function="doSnomed_FreqUse"; }
if($Obj_Input_Snomed_Snomed_Function=="") { $Obj_Input_Snomed_Snomed_Function="doSnomed_Snomed"; }
?>
<div class="InputFullRow_Border width-100">
<ul id="id<?php echo $Obj_Input_Snomed_Name; ?>" style="display: none; ">
<li>
        <input class="form-control InputFullRow_Input padding-0" style=" font-weight: normal; font-size: 12px; width:100%; " placeholder="Search for SNOMED Code" autocomplete="off"
        id="id<?php echo $Obj_Input_Snomed_Name; ?>Input" onkeyup="do<?php echo $Obj_Input_Snomed_Name; ?>Search();" />
        <ul class="drop-left border-radius-5" style="z-index: 101; width:100%; height:<?php echo $Config_SnomedInput_Height-18; ?>px; margin-top: -<?php echo $Config_SnomedInput_Height+12; ?>px; background-color: #64c7f2; " id="id<?php echo $Obj_Input_Snomed_Name; ?>Drop">
        <li class="padding-5">
                <div class="row padding-2" style=" padding-left:15px; padding-right: 15px; margin-bottom: -10px; ">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 padding-5 snomedtab snomedtab-active cursor" id="id<?php echo $Obj_Input_Snomed_Name; ?>Tab1" onclick=" do<?php echo $Obj_Input_Snomed_Name; ?>SelectTab(1);">
                        &nbsp;&nbsp;Last Used
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 padding-5 snomedtab snomedtab-inactive cursor" id="id<?php echo $Obj_Input_Snomed_Name; ?>Tab2" onclick=" do<?php echo $Obj_Input_Snomed_Name; ?>SelectTab(2);">
                        &nbsp;&nbsp;SNOMED
                        </div>
                </div>
                <div class="content padding-5" style=" height:<?php echo $Config_SnomedInput_Height-68; ?>px; background-color: #FFFFFF; overflow: auto; overflow-x: hidden; text-align: center; " id="id<?php echo $Obj_Input_Snomed_Name; ?>ResultA">
                ..
                </div>
                <div class="content padding-5" style=" height:<?php echo $Config_SnomedInput_Height-68; ?>px; background-color: #FFFFFF; overflow: auto; overflow-x: hidden; text-align: center; display: none; " id="id<?php echo $Obj_Input_Snomed_Name; ?>ResultB">
                <br><br><br><br>Enter some word to search for SNOMED<br><br><br>
                </div>
        </li>
        </ul>
</li>
</ul>
</div>
<style>
.InputFullRow_Border { -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; background-color: #64c7f2; padding: 0px; height:36px; width: 100%; } 
.InputFullRow_Input { width:250px; padding:2px; text-align: center; background: transparent; border: none; color: #FFFFFF; -moz-placeholder:#FFFFFF; transition : none; -webkit-transition:none; box-shadow:none; -webkit-box-shadow:none; font-weight: normal; }
.InputFullRow_Input::-moz-placeholder { color: #FFFFFF; font-weight: normal; }
.InputFullRow_Input:-ms-input-placeholder { color: #FFFFFF; font-weight: normal; }
.InputFullRow_Input::-webkit-input-placeholder { color: #FFFFFF; font-weight: normal; }
.snomedtab { -webkit-border-top-left-radius: 5px; -webkit-border-top-right-radius: 5px; -moz-border-radius-topleft: 5px; -moz-border-radius-topright: 5px; border-top-left-radius: 5px; }
.snomedtab-active { font-size: 16px; font-weight: bold; height: 40px; color: #000000; background-color: #FFFFFF; }
.snomedtab-inactive { font-size: 16px; font-weight: bold; height: 40px; color: #000000; }
.snomedtag { background-color: #ddefdd; overflow: hidden; height: 42px; padding:3px; padding-left: 10px; padding-right: 10px; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; }
.snomedtag-a { overflow: hidden; height: 18px; color: #666666; text-align: left; font-weight: bold; }
.snomedtag-b { overflow: hidden; height: 18px; color: #999999; text-align: left; }
</style>
<script type="text/javascript">
var is<?php echo $Obj_Input_Snomed_Name; ?>tabuse=1;
var is<?php echo $Obj_Input_Snomed_Name; ?>clicktab=0;
//#################################################################
if (typeof arSNOMEDInputs === 'undefined') { var arSNOMEDInputs = new Array(); }
arSNOMEDInputs.push('<?php echo $Obj_Input_Snomed_Name; ?>');
//#################################################################
$(document).ready(function() {
        //-------------------------------------------------
        $('#id<?php echo $Obj_Input_Snomed_Name; ?>').dropit({
        //-------------------------------------------------
                action: 'click',
                submenuEl: 'ul',
                triggerEl: 'input',
                triggerParentEl: 'li',
                beforeShow: function(){ do<?php echo $Obj_Input_Snomed_Name; ?>HideAll(); },
                afterHide: function(){ do<?php echo $Obj_Input_Snomed_Name; ?>AlwayShow(); }
        });
        $('#id<?php echo $Obj_Input_Snomed_Name; ?>').show();
});
//-------------------------------------------------
function do<?php echo $Obj_Input_Snomed_Name; ?>Search() {
//-------------------------------------------------
        var myvar = $('#id<?php echo $Obj_Input_Snomed_Name; ?>Input').val();
        $.ajax({
                type: "GET",
                url: "ajax-snomed-search.php",
                data: { q: myvar, task : 'load-lastuse', usetype: '<?php echo $Obj_Input_Snomed_UseType; ?>', fun : '<?php echo $Obj_Input_Snomed_FreqUse_Function; ?>' },
                success: function(result) {
                        $('#id<?php echo $Obj_Input_Snomed_Name; ?>ResultA').html(result);					
                }
        });
        if(myvar=='') { } else {
            $.ajax({
                    type: "GET",
                    url: "ajax-snomed-search.php",
                    data: { q: myvar, usetype: '<?php echo $Obj_Input_Snomed_UseType; ?>', fun : '<?php echo $Obj_Input_Snomed_Snomed_Function; ?>' },
                    success: function(result) {
                            $('#id<?php echo $Obj_Input_Snomed_Name; ?>ResultB').html(result);					
                    }
            });
        }
        $('#id<?php echo $Obj_Input_Snomed_Name; ?>Drop').show();
}
//-------------------------------------------------
function do<?php echo $Obj_Input_Snomed_Name; ?>SelectTab(myi) {
//-------------------------------------------------
        is<?php echo $Obj_Input_Snomed_Name; ?>clicktab=1;
        if (myi==2) {
                $('#id<?php echo $Obj_Input_Snomed_Name; ?>Tab2').removeClass('snomedtab-inactive').addClass('snomedtab-active');
                $('#id<?php echo $Obj_Input_Snomed_Name; ?>Tab1').removeClass('snomedtab-active').addClass('snomedtab-inactive');
                $('#id<?php echo $Obj_Input_Snomed_Name; ?>ResultA').hide();
                $('#id<?php echo $Obj_Input_Snomed_Name; ?>ResultB').show();
                is<?php echo $Obj_Input_Snomed_Name; ?>tabuse=2;
        } else {
                $('#id<?php echo $Obj_Input_Snomed_Name; ?>Tab1').removeClass('snomedtab-inactive').addClass('snomedtab-active');
                $('#id<?php echo $Obj_Input_Snomed_Name; ?>Tab2').removeClass('snomedtab-active').addClass('snomedtab-inactive');
                $('#id<?php echo $Obj_Input_Snomed_Name; ?>ResultB').hide();
                $('#id<?php echo $Obj_Input_Snomed_Name; ?>ResultA').show();
                is<?php echo $Obj_Input_Snomed_Name; ?>tabuse=1;                
        }
        $.each(arSNOMEDInputs, function( key, value ) {
                if (value=='<?php echo $Obj_Input_Snomed_Name; ?>') { } else {
                        $('#id'+value+'Drop').hide();
                }
        });
}
//-------------------------------------------------
function do<?php echo $Obj_Input_Snomed_Name; ?>AlwayShow() {
//-------------------------------------------------
        if (is<?php echo $Obj_Input_Snomed_Name; ?>clicktab==1) {
                $('#id<?php echo $Obj_Input_Snomed_Name; ?>Drop').show();
        }
        is<?php echo $Obj_Input_Snomed_Name; ?>clicktab=0;
}
//-------------------------------------------------
function do<?php echo $Obj_Input_Snomed_Name; ?>HideAll() {
//-------------------------------------------------
        $.each(arSNOMEDInputs, function( key, value ) {
                $('#id'+value+'Drop').hide();
        });
}
do<?php echo $Obj_Input_Snomed_Name; ?>Search();
$('#id<?php echo $Obj_Input_Snomed_Name; ?>ResultA').mCustomScrollbar();
$('#id<?php echo $Obj_Input_Snomed_Name; ?>ResultB').mCustomScrollbar();
</script>