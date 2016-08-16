<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12">
            <div class="title-playlist">
                <h2 style=" margin-top: 5px; margin-bottom: 5px; "><?php echo $myCategoryName; ?></h2>
                <div class="row-1"></div>
                <br class="clear" />
            </div>
            <div class="box-list">
                <div class="row">
                    <!---------------------------------------------->
                    <?php for($i=1;$i<=12;$i++) { if($arContentSubject[$i]<>"") { ?>
                        <div class="col-xs-6 col-sm-4 col-md-3"><?php $cindex=$i; include("object/obj_items_list.php"); ?></div>
                    <?php } } ?>
                    <!---------------------------------------------->
                </div>
            </div>
        </div>
    </div>
    <!------------------------------------------------->
    <?php
    $maxpage=ceil($TotalRecordCount/$Config_PageSize);
    $pagestart=$page-$pagepadding;
    if($pagestart<1) { $pagestart=1; }
    $pageend=$page+$pagepadding;
    if($pageend>$maxpage) { $pageend=$maxpage; }
    ?>
    <div class="text-right">
        <ul class="pagination">
            <?php if($page>$pagepadding) { ?>
                <li><a href="list.php?catid=<?php echo $catid; ?>&page=<?php echo $page-1; ?>" aria-label="Previous"><i class="fa fa-angle-left"></i></a></li>
            <?php } ?>
            <?php for($i=$pagestart;$i<=$pageend;$i++) { ?>
                <?php if($i==$page) { ?>
                    <li class="active"><a href="list.php?catid=<?php echo $catid; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php } else { ?>
                    <li><a href="list.php?catid=<?php echo $catid; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php } ?>
            <?php } ?>
            <?php if($page<$maxpage-$pagepadding) { ?>
                <li><a href="list.php?catid=<?php echo $catid; ?>&page=<?php echo $maxpage; ?>" aria-label="Next"><i class="fa fa-angle-right"></i></a></li>
            <?php } ?>
        </ul>
    </div>
    <!------------------------------------------------->
</div>
<style>
    .title-playlist { margin-bottom: 5px; }
    .title-playlist .row-1 { margin: 0; padding: 0; color: #fff; height: 10px; border-bottom: 0px; border-top: 1px solid #555555; }
</style>