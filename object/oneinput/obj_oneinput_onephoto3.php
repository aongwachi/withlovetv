<?php
$Config_DBx=System_Encode($Config_DB);
############################################################################
if(!isset($Config_MaxFileSizeKB)) { $Config_MaxFileSizeKB=10*1000; } // 10MB 
if(!isset($Config_FileTypeAllow)) { $Config_FileTypeAllow=" 'jpg' "; }
############################################################################
?>
<div class="padding-0" style=" padding-bottom: 10px;">
    <div id="id<?php echo $Config_UniqueID; ?>AreaFile" class="padding-0 pull-left">
    <?php
    $isRunCropper=0;
    if($Config_DefaultValue<>"") {
        list($myCropWidth,$myCropHeight,$myCropType,$myCropAttr) = getimagesize($Config_Path.$Config_DefaultValue);
        if($myCropWidth>$Config_CropWidth || $myCropHeight>$Config_CropHeight) {
            // Auto Resize if Bigger ---------------------------------
            if($myCropWidth>$Config_CropWidth+100 || $myCropHeight>$Config_CropHeight+100) {
                $arTmp=explode(".",$Config_DefaultValue);
                $myFileType=strtolower($arTmp[sizeof($arTmp)-1]);
                $myRand=mt_rand(111111,999999); 
                $myNewFile=$myID."-".$myRand.".".$myFileType;
                $Config_DefaultPath=isset($Config_DefaultPath)?$Config_DefaultPath:"";
                if($Config_CropHeight>$Config_CropWidth) {
                    doImageResizeH($Config_CropHeight+100,$Config_DefaultPath.$myNewFile,$Config_DefaultPath.$Config_DefaultValue);
                } else {
                    doImageResize($Config_CropWidth+100,$Config_DefaultPath.$myNewFile,$Config_DefaultPath.$Config_DefaultValue);
                }
                $sql = " UPDATE ".$myTable." SET ".$myField."='".$myNewFile."' WHERE ".$myKeyField."='".$myID."' ";
                $Query=MYSQL_QUERY($sql,$System_Connection1) OR DIE("Error: ".$sql."<br>\n");
                $Config_DefaultValue=$myNewFile;
            }
            //----------------------------------------------------------
            $isRunCropper=1;
        }
        @chmod($Config_Path.$Config_DefaultValue,0777);
        ?>
        <img src="<?php echo $Config_Path.$Config_DefaultValue; ?>" id="cropbox<?php echo $Config_UniqueID; ?>" class="pull-left" />
        <input type="hidden" id="idImageValue1<?php echo $Config_UniqueID; ?>" value="<?php echo $Config_DefaultValue; ?>" />
        <?php
    } ?>
    </div>
    <div id="btcropper<?php echo $Config_UniqueID; ?>" style=" display:none; " class="pull-left" > <button class="btn btn-info btn-flat pull-left" style=" margin-top:7px; " onclick="
        $('#idImageValue2<?php echo $Config_UniqueID; ?>').val($('#idImageValue1<?php echo $Config_UniqueID; ?>').val());
        $('#idForm<?php echo $Config_UniqueID; ?>').submit();
    "> <i class="fa fa-scissors"></i> Crop </button> </div>
    
    <!--- File Upload ------------------------------------->
    <div class="padding-0 pull-right" style=" margin-top: -4px;">
        <form id="myUploadForm<?php echo $Config_UniqueID; ?>" enctype="multipart/form-data" target="frameInvisibleSubmit" method="POST" action="<?php echo SYSTEM_WEBPATH_ROOT; ?>/object/oneinput/obj_oneinput-ajax.php">
        <input id="input<?php echo $Config_UniqueID; ?>OneFileUpload" name="inputFile" type="file">
        <input type="hidden" name="myAjaxAction" value="one-photo-upload3">
        <input type="hidden" name="myAjaxID" id="myAjaxID" value="<?php echo $Config_UniqueID; ?>">
        <input type="hidden" name="myAjaxValue" id="myAjaxValue" value="<?php echo $Config_FolderKey; ?>">
        <input type="hidden" name="myAjaxKey" id="myAjaxKey" value="<?php echo $Config_DBx; ?>">
        <input type="hidden" name="Config_CropWidth" value="<?php echo $Config_CropWidth; ?>">
        <input type="hidden" name="Config_CropHeight" value="<?php echo $Config_CropHeight; ?>">
        </form>
    </div>
    <script>
    $("#input<?php echo $Config_UniqueID; ?>OneFileUpload").fileinput({
        overwriteInitial: false,
        maxFileCount: 1,
        showPreview:false,
        showUpload: false,
        showRemove: false,
        showCaption: false,
        maxFileSize: <?php echo $Config_MaxFileSizeKB; ?>,
        <?php if($Config_FileTypeAllow=="") { } else { ' allowedFileExtensions: ['.$Config_FileTypeAllow.'], '; } ?>
        browseClass: "btn btn-primary btn-flat padding-5"
    });
    $('#input<?php echo $Config_UniqueID; ?>OneFileUpload').on('change', function() {
        $('#id<?php echo $Config_UniqueID; ?>AreaFile').html('<img src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/img/loading.gif" >');
        $('#myUploadForm<?php echo $Config_UniqueID; ?>').submit();
    });
    function showSaveFile<?php echo $Config_UniqueID; ?>(myTxt) {
        $('#id<?php echo $Config_UniqueID; ?>AreaFile').html(myTxt);
        //$('#myRefreshForm').submit();
    }
    </script>
    <!--- File Upload ------------------------------------->

    <!--- File Crop ------------------------------------->
    <script>
    function runCropper<?php echo $Config_UniqueID; ?>() {
        $('#cropbox<?php echo $Config_UniqueID; ?>').Jcrop({
            aspectRatio: <?php echo $Config_CropWidth; ?>/<?php echo $Config_CropHeight; ?>,
            onSelect: updateCoords<?php echo $Config_UniqueID; ?>
        });
        $('#btcropper<?php echo $Config_UniqueID; ?>').show();
    }
    function updateCoords<?php echo $Config_UniqueID; ?>(c) { $('#x<?php echo $Config_UniqueID; ?>').val(c.x); $('#y<?php echo $Config_UniqueID; ?>').val(c.y); $('#w<?php echo $Config_UniqueID; ?>').val(c.w); $('#h<?php echo $Config_UniqueID; ?>').val(c.h); };
    function checkCoords<?php echo $Config_UniqueID; ?>() { $('#idTest<?php echo $Config_UniqueID; ?>').val($(document).scrollTop()); if (parseInt($('#w<?php echo $Config_UniqueID; ?>').val())) { $('#btcropper<?php echo $Config_UniqueID; ?>').hide(); return true; } else { $('#btcropper<?php echo $Config_UniqueID; ?>').show(); alert('Please select a crop region then press submit.'); return false; } };
    <?php if($isRunCropper==1) { ?>
    runCropper<?php echo $Config_UniqueID; ?>();
    <?php } ?>
    </script>
    <form action="upload-jcorp1.php" method="post" target="frameInvisibleSubmit" id="idForm<?php echo $Config_UniqueID; ?>" onsubmit="return checkCoords<?php echo $Config_UniqueID; ?>();">
    <input type="hidden" id="x<?php echo $Config_UniqueID; ?>" name="x" />
    <input type="hidden" id="y<?php echo $Config_UniqueID; ?>" name="y" />
    <input type="hidden" id="w<?php echo $Config_UniqueID; ?>" name="w" />
    <input type="hidden" id="h<?php echo $Config_UniqueID; ?>" name="h" />
    <input type="hidden" name="myReturn" value="<?php echo $Config_Return; ?>" />
    <input type="hidden" name="myID" value="<?php echo $myID; ?>" />
    <input type="hidden" name="Config_UniqueID" value="<?php echo $Config_UniqueID; ?>" />
    <input type="hidden" name="myTable" value="<?php echo $myTable; ?>" />
    <input type="hidden" name="myKeyField" value="<?php echo $myKeyField; ?>" />
    <input type="hidden" name="myField" value="<?php echo $myField; ?>" />
    <input type="hidden" name="Config_CropWidth" value="<?php echo $Config_CropWidth; ?>" />
    <input type="hidden" name="Config_CropHeight" value="<?php echo $Config_CropHeight; ?>" />
    <input type="hidden" id="idImagePath2<?php echo $Config_UniqueID; ?>" name="Config_DefaultPath" value="<?php echo $Config_DefaultPath; ?>" />
    <input type="hidden" id="idImageValue2<?php echo $Config_UniqueID; ?>" name="Config_DefaultValue" value="<?php echo $Config_DefaultValue; ?>" />
    <input type="hidden" id="idTest<?php echo $Config_UniqueID; ?>" name="test" value="0" />
    </form>
    <style type="text/css">
    .jcrop-holder div { padding:0px; }
    #target { background-color: #ccc; width: <?php echo $Config_CropWidth; ?>px; height: <?php echo $Config_CropHeight; ?>px; font-size: 24px; display: block; }
    </style>
    <!--- File Crop ------------------------------------->
    
</div>