<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>ด้วยรักทีวี.com | LoveTV.com</title>
<link href="assets1/images/icon.png" rel="shortcut icon" />
<link href="assets1/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="assets1/fonts/fonts.css" rel="stylesheet">
<link href="assets1/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="assets1/lib/bxslider-4/jquery.bxslider.css" rel="stylesheet">
<link href="assets1/css/style.css" rel="stylesheet">
<link href="assets1/css/responsive.css" rel="stylesheet">
<script src="assets1/lib/jquery-2.2.3.min.js"></script>
<script src="assets1/lib/bootstrap/js/bootstrap.min.js"></script>
<script src="assets1/lib/bxslider-4/jquery.bxslider-rahisified.min.js"></script>
<script src="assets1/lib/jwplayer/jwplayer.js"></script>
<script type="text/javascript">jwplayer.key="CKjOe06GxAOe3Dj9NaWPCQKtqvqQdyFV8z9wsg==";</script>
<script src="assets1/js/script.js"></script>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body id="top">
<nav class="navbar" role="navigation"><!-- navbar-fixed-top -->
    <div class="container">
	<div class="row">
	    <div class="col-xs-4 col-sm-6">
		<a class="navbar-brand" href="/"><img style="margin-left: -5px;" src="assets1/images/logo.png" /></a>
	    </div>
	    <div class="col-xs-8 col-sm-6">
		<form class="form-inline pull-right">
		    <div class="inner-addon right-addon">
			<input type="text" class="form-control" placeholder="">
			<i class="glyphicon glyphicon-search text-pink"></i>
		    </div>
		    <span class="text-pink hidden-xs">ค้นหารายการทีวี</span>
		</form>
		<div class="navbar-header">
		    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		    </button>
		</div>
	    </div>
	</div>
    </div>
</nav>
<nav class="navbar nav2" role="navigation">
    <div class="container nopadding">
	<div class="collapse navbar-collapse" id="main-nav">
	    <ul class="nav navbar-nav nav-justified">
		<li <?php if($catid==-1) { echo ' class="active" '; } ?>><a href="live.php">Live</a></li>
		<li <?php if($catid==-2) { echo ' class="active" '; } ?>><a href="video.php">ดูย้อนหลัง</a></li>
		<?php
		$index=0; $index1=0;
		$arTopMenuCatID=""; $arTopMenuCatName=""; $arTopMenuCatNameByID="";
		//##########################################################################################
		$sql=" SELECT * FROM ".TABLE_CATEGORY." WHERE ".TABLE_CATEGORY."_Name<>'' AND ".TABLE_CATEGORY."_Folder<>'' ";
		$sql.=" AND ".TABLE_CATEGORY."_isMainMenu='1' ";
		$sql.=" ORDER BY ".TABLE_CATEGORY."_Ordering ASC ";
		$query=$dbh->prepare($sql);
		if($query->execute()) {
			while($Row=$query->fetch()) {
				$arTopMenuCatID[$index]=$Row[TABLE_CATEGORY."_ID"];
				$arTopMenuCatName[$index]=$Row[TABLE_CATEGORY."_Name"];
				$arTopMenuCatNameByID[$Row[TABLE_CATEGORY."_ID"]]=$Row[TABLE_CATEGORY."_Name"];
				?>
				<li <?php if($catid==$Row[TABLE_CATEGORY."_ID"]) { echo ' class="active" '; } ?>><a href="list.php?catid=<?php echo $Row[TABLE_CATEGORY."_ID"]; ?>&page=1"><?php echo $Row[TABLE_CATEGORY."_Name"]; ?></a></li>
				<?php
				$index++;
			}
		}
		//##########################################################################################
		?>
		<li <?php if($catid==-3) { echo ' class="active" '; } ?>><a href="contact.php">ติดต่อเรา</a></li>
	    </ul>
	</div>
    </div>
</nav>
<div class="hashtag-line">
    <div class="bg"></div>
    <div class="container">
	<h1>HASHTAG <span>></span></h1>
	<ul class="list-inline">
	    <?php
	    $sql=" SELECT * FROM ".TABLE_TAGS." WHERE ".TABLE_TAGS."_Name<>'' AND ".TABLE_TAGS."_NoOfUse>0 ";
	    $sql.=" ORDER BY ".TABLE_TAGS."_NoOfUse DESC LIMIT 0,16 ";
	    $query=$dbh->prepare($sql);
	    if($query->execute()) {
		while($Row=$query->fetch()) {
		    ?><li><a href="tags.php?tagid=<?php echo $Row[TABLE_TAGS."_ID"]; ?>">#<?php echo $Row[TABLE_TAGS."_Name"]; ?></a></li><?php
		}
	    } else { print_r($query->errorInfo()); }
	    ?>
	</ul>
	<br class="clear" />
    </div>
    <br class="clear" />
</div>