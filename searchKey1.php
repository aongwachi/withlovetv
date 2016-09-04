<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12">
            <?php
            foreach ($listArContentSubject as $ind => $value)
            {
                if(gettype($listArContentSubject[$ind]) == 'array')
                {
                    ?>
                    <div class="title-playlist">
                        <h2 style=" margin-top: 5px; margin-bottom: 5px; "><?php echo $arrMyCategoryName[$ind+1][0]; ?></h2>
                        <div class="row-1"></div>
                        <br class="clear" />
                    </div>
                    <div class="box-list">
                        <div class="row">
                            <!---------------------------------------------->
                            <?php for($i=1;$i<=count($listArContentSubject[$ind]);$i++) { if($listArContentSubject[$ind][$i]<>"") { ?>
                                <div class="col-xs-6 col-sm-4 col-md-3">
                                    <?php
                                    $cindex=$i;
                                    $arContentID[$cindex] = $listArContentId[$ind][$i];
                                    $arContentThumb[$cindex] = $listArContentThumb[$ind][$i];
                                    $arContentSubject[$cindex] = $listArContentSubject[$ind][$i];
                                    include("object/obj_items_list.php"); ?>
                                </div>
                            <?php } } ?>
                            <!---------------------------------------------->
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
            <?php
            if(gettype($videoSubject) == 'array') {
                ?>
                <div class="title-playlist">
                    <h2 style=" margin-top: 5px; margin-bottom: 5px; ">วิดิโอย้อนหลัง</h2>
                    <div class="row-1"></div>
                    <br class="clear"/>
                </div>
                <div class="box-list">
                    <div class="row">
                        <!---------------------------------------------->
                        <?php for ($i = 1; $i <= count($videoSubject); $i++) {
                            if ($videoSubject[$i] <> "") { ?>
                                <div class="col-xs-6 col-sm-4 col-md-3">
                                    <?php
                                    $cindex = $i;
                                    $arContentID[$cindex] = $videoId[$i];
                                    $arContentThumb[$cindex] = $videoThumb[$i];
                                    $arContentSubject[$cindex] = $videoSubject[$i];
                                    $urlVideo[$cindex] = $videoUrl[$i];
                                    $typeVideo = "video";
                                    include("object/obj_items_list.php");
                                    $typeVideo = "";
                                    ?>
                                </div>
                            <?php }
                        } ?>
                        <!---------------------------------------------->
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <!------------------------------------------------->
</div>
<style>
    .title-playlist { margin-bottom: 5px; }
    .title-playlist .row-1 { margin: 0; padding: 0; color: #fff; height: 10px; border-bottom: 0px; border-top: 1px solid #555555; }
</style>