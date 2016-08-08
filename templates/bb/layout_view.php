<?php

$random_me = rand(); 
//$random_me = "";

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<!--@@SystemLayoutStart:Head@@-->
<link rel="stylesheet" href="css/layout_index.css?v=<?php echo $random_me; ?>">
<link rel="stylesheet" href="css/layout_topmenu2.css">
<link rel="stylesheet" href="css/layout_footer.css">
<!--@@SystemLayoutEnd:Head@@-->
</head>

<body>
<!--@@SystemLayoutStart:Body@@-->
[##object:obj_navbar_home_top.php##]
<div class="content-top-padding"></div>
[##area:bodycontent##]
[##object:obj_footer.php##]
<!--@@SystemLayoutEnd:Body@@-->
<!--@@SystemLayoutStart:Foot@@-->
<!--@@SystemLayoutEnd:Foot@@-->
</body>
</html>