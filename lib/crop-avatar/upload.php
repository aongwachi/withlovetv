<?php
function saveImage($base64img){
    $base64img = str_replace('data:image/jpeg;base64,', '', $base64img);
    $data = base64_decode($base64img);
    $file = 'img/1111.jpg';
    file_put_contents($file, $data);
	chmod($file,0777);
}
saveImage(urldecode($_POST['img']));
?>