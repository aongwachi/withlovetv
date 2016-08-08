<!DOCTYPE html>
<html lang="en">
<head>
<title>Live Cropping Demo</title>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
<script src="../js/jquery.min.js"></script>
<script src="../js/jquery.Jcrop.js"></script>
<link rel="stylesheet" href="../css/jquery.Jcrop.css" type="text/css" />
<script type="text/javascript">
$(function(){ $('#cropbox').Jcrop({ aspectRatio: 300/450, onSelect: updateCoords }); });
function updateCoords(c) { $('#x').val(c.x); $('#y').val(c.y); $('#w').val(c.w); $('#h').val(c.h); };
function checkCoords() { if (parseInt($('#w').val())) return true; alert('Please select a crop region then press submit.'); return false; };
</script>
<style type="text/css">
#target { background-color: #ccc; width: 500px; height: 330px; font-size: 24px; display: block; }
</style>
</head>
<body>
<?php
// Auto Resize Image Before Show
?>
<!-- This is the image we're attaching Jcrop to -->
<img src="demo_files/a1.jpg" id="cropbox" />
<!-- This is the form that our event handler fills -->
<form action="upload.php" method="post" onsubmit="return checkCoords();">
<input type="hidden" id="x" name="x" />
<input type="hidden" id="y" name="y" />
<input type="hidden" id="w" name="w" />
<input type="hidden" id="h" name="h" />
<br>
<input type="submit" value="Crop" class="btn btn-large btn-inverse" />
</form>

<br><br><br>
<img src="thumb/thumb-a2.jpg">
	
</body>
</html>
