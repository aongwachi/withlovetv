<?php  if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } ?>
<form id="fileupload" action="//jquery-file-upload.appspot.com/" method="POST" enctype="multipart/form-data">
<div class="formgroup fileupload-buttonbar">
<div class="col-xs-6 col-sm-3 col-md-2 col-lg-2 padding-2">
    <span class="btn btn-success btn-block btn-flat fileinput-button"><span>Add Files</span><input type="file" name="files[]" multiple></span>
</div>
<div class="col-xs-6 col-sm-3 col-md-2 col-lg-2 padding-2">
    <button type="submit" class="btn btn-primary btn-block btn-flat start"><span>Upload All</span></button>
</div>
</div>
<table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
</form>
<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
<tr class="template-upload fade">
    <td>
        <span class="preview"></span>
    </td>
    <td>
        <p class="name">{%=file.name%}</p>
        <strong class="error text-danger"></strong>
    </td>
    <td>
        <p class="size">Processing...</p>
        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
    </td>
    <td>
        {% if (!i && !o.options.autoUpload) { %}
            <button class="btn btn-primary btn-flat start" disabled>
                <i class="glyphicon glyphicon-upload hidden-sm hidden-md hidden-lg"></i>
                <span>Start</span>
            </button>
        {% } %}
        {% if (!i) { %}
            <button class="btn btn-warning btn-flat cancel">
                <i class="glyphicon glyphicon-ban-circle hidden-sm hidden-md hidden-lg"></i>
                <span>Cancel</span>
            </button>
        {% } %}
    </td>
</tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
<tr class="template-download fade">
    <td>
        <span class="preview">
            {% if (file.thumbnailUrl) { %}
                <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
            {% } %}
        </span>
    </td>
    <td>
        <p class="name">
            {% if (file.url) { %}
                <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
            {% } else { %}
                <span>{%=file.name%}</span>
            {% } %}
        </p>
        {% if (file.error) { %}
            <div><span class="label label-danger">Error</span> {%=file.error%}</div>
        {% } %}
    </td>
    <td>
        <span class="size">{%=o.formatFileSize(file.size)%}</span>
    </td>
</tr>
{% } %}
</script>
<link rel="stylesheet" href="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/jquery-file-upload/css/jquery.fileupload.css">
<link rel="stylesheet" href="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/jquery-file-upload/css/jquery.fileupload-ui.css">
<script src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/jquery-file-upload/js/vendor/jquery.ui.widget.js"></script>
<script src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/jquery-file-upload/js/tmpl.min.js"></script>
<script src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/jquery-file-upload/js/load-image.all.min.js"></script>
<script src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/jquery-file-upload/js/canvas-to-blob.min.js"></script>
<script src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/jquery-file-upload/js/jquery.iframe-transport.js"></script>
<script src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/jquery-file-upload/js/jquery.fileupload.js"></script>
<script src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/jquery-file-upload/js/jquery.fileupload-process.js"></script>
<script src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/jquery-file-upload/js/jquery.fileupload-image.js"></script>
<script src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/jquery-file-upload/js/jquery.fileupload-audio.js"></script>
<script src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/jquery-file-upload/js/jquery.fileupload-video.js"></script>
<script src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/jquery-file-upload/js/jquery.fileupload-validate.js"></script>
<script src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/jquery-file-upload/js/jquery.fileupload-ui.js"></script>
<?php
$myTempFilePathUpload = SYSTEM_DOC_ROOT."upload/phpupload";
$myTempFilePathUploadUser = SYSTEM_DOC_ROOT."upload/phpupload/upload".$SystemSession_Staff_ID;
if(!file_exists($myTempFilePathUploadUser)){
mkdir($myTempFilePathUploadUser); chmod($myTempFilePathUploadUser,0777);
copy($myTempFilePathUpload."/index.php",$myTempFilePathUploadUser."/index.php");
copy($myTempFilePathUpload."/UploadHandler.php",$myTempFilePathUploadUser."/UploadHandler.php");
}
?>
<script>
$(function () {
    'use strict';
    $('#fileupload').fileupload({ url: '<?=$myTempFilePathUploadUser?>/' }).bind('fileuploadstop', function (e) {
        doUploadCompleted();
    });
    $('#fileupload').addClass('fileupload-processing');
    $.ajax({
        url: $('#fileupload').fileupload('option', 'url'),
        dataType: 'json',
        context: $('#fileupload')[0]
    }).always(function () {
        $(this).removeClass('fileupload-processing');
    }).done(function (result) {
        $(this).fileupload('option','done').call(this, $.Event('done'), {result: result});
    });
});
</script>