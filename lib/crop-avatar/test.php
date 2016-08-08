<?php  if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } 
$System_LayoutUse="layout_index.html";
$System_Title="Cropper";

include_once("../../_config/config_system.php");
include_once(SYSTEM_DOC_ROOT."system/core-start.php");
include_once(SYSTEM_DOC_ROOT."system/core-body.php");
################################################################
	?>
    <!--- ################################################# --->
	<link rel="stylesheet" href="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/crop-avatar/cropper.min.css">
	<script src="<?php echo SYSTEM_WEBPATH_ROOT; ?>/lib/crop-avatar/cropper.min.js"></script>
    <div class="text-center"><br /><br />
    <!--- ################################################# --->
	<div style=" display:inline-block; cursor:pointer; ">
    <img src="img/picture-1.jpg" class="img-responsive" style=" max-height:450px; max-width:450px; "  data-toggle="modal" data-target="#bootstrap-modal" />
	</div>
    <!--- ################################################# --->
    <div class="modal fade" id="bootstrap-modal" tabindex="-1" role="dialog" aria-labelledby="bootstrap-modal-label" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-body">
    <!--- Action BT ----------------------------------------------------->
    <div class="btn-group">
            <button class="btn btn-primary" data-method="zoom" data-option="0.1" title="Zoom In" type="button">
                <span class="glyphicon glyphicon-zoom-in"></span>
                </span>
            </button>
            <button class="btn btn-primary" data-method="zoom" data-option="-0.1" title="Zoom Out" type="button">
                <span class="glyphicon glyphicon-zoom-out"></span>
                </span>
            </button>
            <button class="btn btn-primary" data-method="rotate" data-option="-90" title="Rotate" type="button">
                <span class="fa fa-repeat"></span>
                </span>
            </button>
    </div>
    <!--- Action BT ----------------------------------------------------->
    <div class="bootstrap-modal-cropper"><img src="img/picture-1.jpg" class="img-responsive"></div>
    </div>
    <div class="modal-footer">
                <div class="row">
                <div class="col-md-6">
	                <button class="btn btn-danger btn-block btn-flat" style="height:50px;" type="button" data-dismiss="modal">Close</button>
                </div>
                <div class="col-md-6">
                	<button class="btn btn-success btn-block btn-flat avatar-save" style="height:50px;" type="submit" onclick=" doCropMe(); ">Save</button>
	            </div>
                </div>
    </div>
    </div>
    </div>
    </div>
    <!--- ################################################# --->
    </div>
	<script>
    var $modal = $("#bootstrap-modal"),
    $image = $modal.find(".bootstrap-modal-cropper img"), originalData = {};
	$modal.on("shown.bs.modal", function() {
			$image.cropper({
					multiple: true,
					data: originalData,
					done: function(data) {
					}
			});
    }); 
	$(document).on("click", "[data-method]", function () {
			var data = $(this).data();
			data.method && $image.cropper(data.method, data.option);
	});
	//------------------------------------------------------------------------------------
	function doCropMe() {
	//------------------------------------------------------------------------------------
        var dataURL = $image.cropper("getDataURL", "image/jpeg");
		$.ajax({
			type: "POST",
			url: "upload.php",
			data: { img: encodeURIComponent(dataURL) },
			contentType: "application/x-www-form-urlencoded;charset=UTF-8",
			success: function(result) {
				$('#bootstrap-modal').modal('hide');
			}
		});
	}
	//------------------------------------------------------------------------------------
    </script>
    <!--- ################################################# --->
	<?php
################################################################
include_once(SYSTEM_DOC_ROOT."system/core-end.php");
?>