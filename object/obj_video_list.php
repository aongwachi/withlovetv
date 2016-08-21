<?php // Use For Web Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } ?>
<a href="video_alone.php?url=<?php echo $arContentID[$cindex]; ?>" class="col-item">
<div class="thumb" style="height: 200px"><img src="<?php echo !empty($arContentThumb[$cindex])&&$arContentThumb[$cindex]?$arContentThumb[$cindex]:'upload/thumb2/00/30/default-thumbnail.jpg'; ?>" /></div>
<div style=" padding:1px; height:38px; overflow:hidden; "><h2><?php echo $arContentSubject[$cindex]; ?></h2></div>
</a>