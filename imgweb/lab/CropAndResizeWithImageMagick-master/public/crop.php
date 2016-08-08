<?php
require_once "../include/config.php";

$file = basename($_GET["image"]);
$cropped = "cropped_" . $file;
$image = new Imagick(UPLOAD_DIR . "/" . $file);
$image->cropImage($_GET["width"], $_GET["height"], $_GET["x"], $_GET["y"]);
$image->writeImage(UPLOAD_DIR . "/" . $cropped);
echo basename(UPLOAD_DIR) . "/" . $cropped;
