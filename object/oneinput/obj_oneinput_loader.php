<?php // Use For Web Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } ?>
<script>
//-------------------------------------------
function OneInput_DoSaveDateThai(myUniqueID,myDB,myValue) {
//-------------------------------------------
  $.ajax({
      type: "POST",
      url: "<?php echo SYSTEM_WEBPATH_ROOT; ?>/object/oneinput/obj_oneinput-ajax.php",
      data: { myAjaxAction: 'data-update-date-thai', myAjaxKey: myDB, myAjaxValue: myValue },
      success: function(result) {
        if(result=='') {
          System_Notice('Error : ไม่สามารถบันทึกข้อมูลได้','danger');
        } else {
          $('#idAutoSave'+myUniqueID).html('<font color="#00AA00">'+result+'</font>');
          $('#idAutoSave'+myUniqueID).show("slide", { direction: 'right', easing: 'easeOutCirc' }, 500).delay(1000).fadeOut(1000);
        }
      }
  });
}
//-------------------------------------------
function OneInput_DoSaveTextCodeSave(myUniqueID,myDB,myValue) {
//-------------------------------------------
  var mylink1 = myValue.replace(/</g,"[#[#]");
  var mylink2 = mylink1.replace(/>/g,"[#]#]");
  $.ajax({
      type: "POST",
      url: "<?php echo SYSTEM_WEBPATH_ROOT; ?>/object/oneinput/obj_oneinput-ajax.php",
      data: { myAjaxAction: 'data-update-code-save', myAjaxKey: myDB, myAjaxValue: mylink2 },
      success: function(result) {
        if(result=='') {
          System_Notice('Error : ไม่สามารถบันทึกข้อมูลได้','danger');
        } else {
          $('#idAutoSave'+myUniqueID).html('<font color="#00AA00">'+result+'</font>');
          $('#idAutoSave'+myUniqueID).show("slide", { direction: 'right', easing: 'easeOutCirc' }, 500).delay(1000).fadeOut(1000);
        }
      }
  });
}
//-------------------------------------------
function OneInput_DoSaveTextCode(myUniqueID,myDB,myValue) {
//-------------------------------------------
  var mylink1 = myValue.replace(/</g,"[#[#]");
  var mylink2 = mylink1.replace(/>/g,"[#]#]");
  $.ajax({
      type: "POST",
      url: "<?php echo SYSTEM_WEBPATH_ROOT; ?>/object/oneinput/obj_oneinput-ajax.php",
      data: { myAjaxAction: 'data-update', myAjaxKey: myDB, myAjaxValue: mylink2 },
      success: function(result) {
        if(result=='') {
          System_Notice('Error : ไม่สามารถบันทึกข้อมูลได้','danger');
        } else {
          $('#idAutoSave'+myUniqueID).html('<font color="#00AA00">'+result+'</font>');
          $('#idAutoSave'+myUniqueID).show("slide", { direction: 'right', easing: 'easeOutCirc' }, 500).delay(1000).fadeOut(1000);
        }
      }
  });
}
//-------------------------------------------
function OneInput_DoSaveTextOnOffString(myUniqueID,myDB,myValue,myValue2) {
//-------------------------------------------
  $.ajax({
      type: "POST",
      url: "<?php echo SYSTEM_WEBPATH_ROOT; ?>/object/oneinput/obj_oneinput-ajax.php",
      data: { myAjaxAction: 'data-update-onoff-string', myAjaxKey: myDB, myAjaxValue: myValue , myAjaxValue2: myValue2 },
      success: function(result) {
        if(result=='') {
          System_Notice('Error : ไม่สามารถบันทึกข้อมูลได้','danger');
        } else {
          $('#idAutoSave'+myUniqueID).html('<font color="#00AA00">'+result+'</font>');
          $('#idAutoSave'+myUniqueID).show("slide", { direction: 'right', easing: 'easeOutCirc' }, 500).delay(1000).fadeOut(1000);
        }
      }
  });
}
//-------------------------------------------
function OneInput_DoSaveText(myUniqueID,myDB,myValue) {
//-------------------------------------------
  $.ajax({
      type: "POST",
      url: "<?php echo SYSTEM_WEBPATH_ROOT; ?>/object/oneinput/obj_oneinput-ajax.php",
      data: { myAjaxAction: 'data-update', myAjaxKey: myDB, myAjaxValue: myValue },
      success: function(result) {
        if(result=='') {
          System_Notice('Error : ไม่สามารถบันทึกข้อมูลได้','danger');
        } else {
          $('#idAutoSave'+myUniqueID).html('<font color="#00AA00">'+result+'</font>');
          $('#idAutoSave'+myUniqueID).show("slide", { direction: 'right', easing: 'easeOutCirc' }, 500).delay(1000).fadeOut(1000);
        }
      }
  });
}
//-------------------------------------------
function AjaxUploadFile(myUniqueID,myDB) {
//-------------------------------------------
    var file = $('#input'+myUniqueID)[0].files;
    var data = new FormData();
    data.append('myAjaxAction', "ajax-upload-file");
    data.append('myAjaxKey', myDB);
    data.append('fileData', file[0]);
    $.ajax({
        url: '<?php echo SYSTEM_WEBPATH_ROOT; ?>/object/oneinput/obj_oneinput-ajax.php',
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function(result){
            if(result=='') {
                System_Notice('Error : ไม่สามารถบันทึกข้อมูลได้','danger');
            } else {
                $('#idAutoSave'+myUniqueID).html('<font color="#00AA00">'+result+'</font>');
                $('#idAutoSave'+myUniqueID).show("slide", { direction: 'right', easing: 'easeOutCirc' }, 500).delay(1000).fadeOut(1000);
            }
        }
    });
}
//-------------------------------------------
function OneInput_DoSaveSelect(myUniqueID,myDB,myValue,myValue2) {
//-------------------------------------------
  $.ajax({
      type: "POST",
      url: "<?php echo SYSTEM_WEBPATH_ROOT; ?>/object/oneinput/obj_oneinput-ajax.php",
      data: { myAjaxAction: 'data-update-select', myAjaxKey: myDB, myAjaxValue: myValue , myAjaxValue2: myValue2 },
      success: function(result) {
        if(result=='') {
          System_Notice('Error : ไม่สามารถบันทึกข้อมูลได้','danger');
        } else {
          $('#idAutoSave'+myUniqueID).html('<font color="#00AA00">'+result+'</font>');
          $('#idAutoSave'+myUniqueID).show("slide", { direction: 'right', easing: 'easeOutCirc' }, 500).delay(1000).fadeOut(1000);
        }
      }
  });
}
var OneInputSelectIconDialog;
//-------------------------------------------
function OneInput_ShowSelectIcon(myUniqueID,myDB) {
//-------------------------------------------
    OneInputSelectIconDialog = BootstrapDialog.show({
        title: 'Select icon',
        draggable: true,
        message: $('<div></div>').load('<?php echo SYSTEM_WEBPATH_ROOT; ?>/object/oneinput/obj_oneinput-ajax.php?myAjaxAction=load-icon&myAjaxValue='+myUniqueID+'&myAjaxKey='+myDB)
    });
}
//----------------------------------
function OneInput_SetIcon(myUniqueID,myIcon,myDB) {
//----------------------------------
    $('#inputIcon'+myUniqueID).html('<i class="'+myIcon+'" style=" display:block; margin-top:-1px;"></i>');
    $.ajax({
        type: "POST",
        url: "<?php echo SYSTEM_WEBPATH_ROOT; ?>/object/oneinput/obj_oneinput-ajax.php",
        data: { myAjaxAction: 'data-update-icon', myAjaxKey: myDB, myAjaxValue: myIcon },
        success: function(result) {
          if(result=='') {
            System_Notice('Error : ไม่สามารถบันทึกข้อมูลได้','danger');
          } else {
            OneInputSelectIconDialog.close();
            $('#idAutoSave'+myUniqueID).html('<font color="#00AA00">'+result+'</font>');
            $('#idAutoSave'+myUniqueID).show("slide", { direction: 'right', easing: 'easeOutCirc' }, 500).delay(1000).fadeOut(1000);
          }
        }
    });
}
</script>
<style>
.table { display: table; margin:0px;  }
.td { float: none; display: table-cell; vertical-align: top; padding: 0px; margin:0px; }
</style>