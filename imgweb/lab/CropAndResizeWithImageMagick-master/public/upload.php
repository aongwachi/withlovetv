<?php
require_once "../include/config.php";
if (isset($_FILES["file"])) {
    $tmpFile = $_FILES["file"]["tmp_name"];

    $ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
    $fileName = uniqid(rand(), true) . "." . $ext;

    list($width, $height) = getimagesize($tmpFile);
    // check if the file is really an image
    if ($width == null && $height == null) {
        header("Location: index.php");
        return;
    }
    // resize if necessary
    if ($width >= 400 && $height >= 400) {
        $image = new Imagick($tmpFile);
        $image->thumbnailImage(400, 400);
        $image->writeImage(UPLOAD_DIR . "/" . $fileName);
    }
    else {
        move_uploaded_file($tmpFile, UPLOAD_DIR . "/" . $fileName);
    }
}
?>
<!DOCTYPE html>
<html>
 <head>
  <title>Crop Image</title>
  <link rel="stylesheet" type="text/css" href="css/imgareaselect-default.css">
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/jquery.imgareaselect.pack.js"></script>
  <script type="text/javascript">
$(document).ready(function () {
    var selection = $('#photo').imgAreaSelect({
        handles: true,
        instance:true
    });

    $("#crop").click(function () {
        var width = selection.getSelection().width;
        var height = selection.getSelection().height;
        var x = selection.getSelection().x1;
        var y = selection.getSelection().y1;
        var image = $("#photo");
        var loader = $("#ajax-loader");

        var request = $.ajax({
            url: "crop.php",
            type: "GET",
            data: {
                x: x,
                y: y,
                height: height,
                width: width,
                image: image.attr("src")
            },
            beforeSend: function () {
                loader.show();
            }
        }).done(function (msg) {
            image.attr("src", msg);
            loader.hide();
            selection.cancelSelection();
        });
    });
});
  </script>
 </head>
 <body>
  <h1>Crop Image</h1>
  <img src="img/<?php echo $fileName; ?>" id="photo"><br>
  <input type="button" id="crop" value="Crop">
  <img src="img/ajax-loader.gif" id="ajax-loader" style="display:none"> 
 </body>
</html>