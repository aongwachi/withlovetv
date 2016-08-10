﻿<?php
####################################################################################
$sql1 = " SELECT * FROM " . TABLE_LIVE . " WHERE 1 ORDER BY RAND() LIMIT 0,1 ";
$query1 = $dbh->prepare($sql1);
if ($query1->execute()) {
    $Row1 = $query1->fetch();
    $myLiveLink = $Row1[TABLE_LIVE . "_Link"];
    $myLiveResolution = $Row1[TABLE_LIVE . "_Resolution"];
}
####################################################################################
$sql_recommend_video = " SELECT * FROM " . TABLE_PROGRAM . " WHERE 1  LIMIT 3 ";
$query_reccommend = $dbh->prepare($sql_recommend_video);
$vidRecommend = [];
if ($query_reccommend->execute()) {
    while ($row = $query_reccommend->fetch()) {
        $res = [];
        $res['url'] = $row[TABLE_PROGRAM . "_URL"];
        $res['title'] = $row[TABLE_PROGRAM . "_Name"];
        $res['detail'] = $row[TABLE_PROGRAM . "_Detail"];
        $vidRecommend[] = $res;
    }
}
####################################################################################
?>
<header class="bg-white">
    <br>
    <div class="container bg-lightgray">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-7 nopadding-right-sm">
                <br>
                <div id="homeVideo"></div>
                <script>
                    jwplayer("homeVideo").setup({
                        sources: [
                            {file: 'http://media1.adventist.no:1935/live/smil:switch.smil/jwplayer.smil'},
                            {file: 'http://media1.adventist.no:1935/live/smil:switch.smil/playlist.m3u8'}
                        ],
                        <?php if(0) { ?>image: "./images/video.png",<?php } ?>
                        width: "100%",
                        autostart: true,
                        aspectratio: "16:10",
                        fallback: false,
                        skin: {
                            name: "seven"
                        }
                    });
                </script>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5 nopadding-left-sm">
                <br>
                <div class="video-info bg-black">
                    <div class="header-title">
                        <h1>AIS Futsal Thailand Leaque 2016</h1>
                        <h4><span class="text-yellow">LIVE!</span> &nbsp;
                            วันที่ <?php echo System_ShowDateLongTh(SYSTEM_DATENOW); ?>
                            เวลา <?php echo substr(SYSTEM_TIMENOW, 0, 5); ?></h4>
                    </div>
                    <div class="desc">
                        <label><span aria-hidden="true" class="glyphicon glyphicon-play text-pink"></span> Auto
                            Play</label> ความละเอียด : <?php echo $myLiveResolution; ?>k
                        <br/>
                    </div>
                </div>
                <div class="video-playlist bg-darkgray">
                    <div class="header-title">
                        <div class="row">
                            <div class="col-xs-5 nopadding-right">
                                <h2>รายการต่อไป</h2>
                            </div>
                            <div class="col-xs-7 nopadding-left text-right">
                                <h3>วันอาทิตย์ที่ 29 พฤษภาคม พ.ศ. 2559</h3>
                            </div>
                        </div>
                    </div>
                    <ul class="list-playlist">
                        <li class="active">
                            <a href="#">
                                <div class="label">
                                    17:58
                                </div>
                                <div class="desc">
                                    Express News
                                </div>
                                <div class="clearfix"></div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="label">
                                    18:00
                                </div>
                                <div class="desc">
                                    เพลงชาติไทยรัฐทีวี
                                </div>
                                <div class="clearfix"></div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="label">
                                    18:01
                                </div>
                                <div class="desc">
                                    เดินหน้าประเทศไทย
                                </div>
                                <div class="clearfix"></div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="label">
                                    18:30
                                </div>
                                <div class="desc">
                                    เจ้าแม่กวนอิม
                                </div>
                                <div class="clearfix"></div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="label">
                                    19:30
                                </div>
                                <div class="desc">
                                    ไทยรัฐ นิวส์โชว์
                                </div>
                                <div class="clearfix"></div>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</header>
<!-- Content -->
<div class="container container-padding">

    <div class="row">
        <div class="col-xs-12 col-sm-8">
            <div class="box">
                <div class="title">
                    <h1>รายการแนะนำ</h1>
                    <div class="bg"></div>
                </div>
                <div class="box-inner bg-darkgray">
                    <div class="item item-pad">
                        <a class="thumb" id="rec_1" onclick="play_rec1()">
                            <img src="./images/thumb1.jpg" id="img_rec1"/>
                            <div id="video_rec1"></div>
                            <div class="img-hover" id="play_button_rec1">PLAY</div>
                        </a>
                        <script>
                            var rec1 = 0;
                            function play_rec1() {
                                rec1++;
                                if (rec1 == 1) {
                                    $('#img_rec1').hide();
                                    $('#play_button_rec1').hide();
                                    jwplayer("video_rec1").setup({
                                        file: "<?php echo $vidRecommend[0]['url']; ?>",
                                        width: "100%",
                                        aspectratio: "16:10",
                                        autostart: true,
                                        fallback: false,
                                        skin: {
                                            name: "seven"
                                        }
                                    });
                                }
                            }
                        </script>
                        <div class="desc">
                            <div class="text">
                                <span class="text-pink">ON AIR</span> : ทุกวันอาทิตย์ , 16:00น. - 17:30น.
                                <div class="pull-right text-right">
                                    <a href="#" class="btn btn-pink">ทั่วไป</a>
                                    <a href="#" class="btn btn-gray">แชร์</a>
                                </div>
                            </div>
                            <hr/>
                            <h2><?php echo $vidRecommend[0]['title'];?></h2>
                            <div class="tags">
                                <a href="#"><?php echo $vidRecommend[0]['detail'];?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom-20"></div>
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <div class="box">
                        <div class="box-inner bg-darkgray">
                            <div class="item">
                                <a class="thumb" onclick="play_rec2()">
                                    <img src="./images/thumb2.jpg" id="img_rec2"/>
                                    <div id="video_rec2"></div>
                                    <div class="img-hover" id="play_button_rec2">PLAY</div>
                                </a>
                                <script>
                                    var rec2 = 0;
                                    function play_rec2() {
                                        rec2++;
                                        if(rec2==1){
                                            $('#img_rec2').hide();
                                            $('#play_button_rec2').hide();
                                            jwplayer("video_rec2").setup({
                                                file: "<?php echo $vidRecommend[1]['url']; ?>",
                                                width: "100%",
                                                aspectratio: "16:10",
                                                autostart: true,
                                                fallback: false,
                                                skin: {
                                                    name: "seven"
                                                }
                                            });
                                        }
                                    }
                                </script>
                                <div class="desc">
                                    <div class="text">
                                        <span class="text-pink">ON AIR</span> : ทุกวันอาทิตย์ , 16:00น. - 17:30น.
                                    </div>
                                    <hr/>
                                    <h2><?php echo $vidRecommend[1]['title'];?></h2>
                                    <div class="tags">
                                        <a href="#"><?php echo $vidRecommend[1]['detail'];?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="box">
                        <div class="box-inner bg-darkgray">
                            <div class="item">
                                <a class="thumb" onclick="play_rec3()">
                                    <img src="./images/thumb3.jpg" id="img_rec3"/>
                                    <div id="video_rec3"></div>
                                    <div class="img-hover" id="play_button_rec3">PLAY</div>
                                </a>
                                <script>
                                    var rec3 = 0;
                                    function play_rec3() {
                                        rec3++;
                                        if(rec3==1)
                                        {
                                            $('#img_rec3').hide();
                                            $('#play_button_rec3').hide();
                                            jwplayer("video_rec3").setup({
                                                file: "<?php echo $vidRecommend[2]['url']; ?>",
                                                width: "100%",
                                                aspectratio: "16:10",
                                                autostart: true,
                                                fallback: false,
                                                skin: {
                                                    name: "seven"
                                                }
                                            });
                                        }
                                    }
                                </script>
                                <div class="desc">
                                    <div class="text">
                                        <span class="text-pink">ON AIR</span> : ทุกวันอาทิตย์ , 16:00น. - 17:30น.
                                    </div>
                                    <hr/>
                                    <h2><?php echo $vidRecommend[2]['title'];?></h2>
                                    <div class="tags">
                                        <a href="#"><?php echo $vidRecommend[2]['detail'];?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-4">
            <div class="box">
                <div class="title">
                    <h1>Most Watched</h1>
                    <div class="bg"></div>
                </div>
                <div class="box-inner bg-lightgray">
                    <div class="item item-pad">
                        <a href="#" class="thumb">
                            <img src="./images/thumb8.jpg"/>
                            <div class="img-hover">PLAY</div>
                        </a>
                        <div class="desc">
                            <div class="text">
                                <div class="tags">
                                    <a href="#">รายการเล่าเส้นเป็นเรื่อง</a>
                                </div>
                                <div class="pull-right text-right">
                                    <a href="#" class="btn btn-pink">ทั่วไป</a>
                                    <a href="#" class="btn btn-gray">แชร์</a>
                                </div>
                            </div>
                            <span class="text-pink">ON AIR</span> : ทุกวันอาทิตย์ , 16:00น. - 17:30น.
                        </div>
                        <hr class="gap"/>
                    </div>
                    <div class="item item-pad">
                        <a href="#" class="thumb">
                            <img src="./images/thumb9.jpg"/>
                            <div class="img-hover">PLAY</div>
                        </a>
                        <div class="desc">
                            <div class="text">
                                <div class="tags">
                                    <a href="#">Club Friday The Series</a>
                                </div>
                                <div class="pull-right text-right">
                                    <a href="#" class="btn btn-pink">ทั่วไป</a>
                                    <a href="#" class="btn btn-gray">แชร์</a>
                                </div>
                            </div>
                            <span class="text-pink">ON AIR</span> : ทุกวันอาทิตย์ , 16:00น. - 17:30น.
                        </div>
                        <hr class="gap"/>
                    </div>
                    <div class="item item-pad">
                        <a href="#" class="thumb">
                            <img src="./images/thumb10.jpg"/>
                            <div class="img-hover">PLAY</div>
                        </a>
                        <div class="desc">
                            <div class="text">
                                <div class="tags">
                                    <a href="#">รายการเล่าเส้นเป็นเรื่อง</a>
                                </div>
                                <div class="pull-right text-right">
                                    <a href="#" class="btn btn-pink">ทั่วไป</a>
                                    <a href="#" class="btn btn-gray">แชร์</a>
                                </div>
                            </div>
                            <span class="text-pink">ON AIR</span> : ทุกวันอาทิตย์ , 16:00น. - 17:30น.
                        </div>
                        <hr class="gap"/>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="bottom-20"></div>
    <?php
    $index = 0;
    $arOnPageCatID = "";
    $arOnPageCatName = "";
    $arOnPageCatNameByID = "";
    //##########################################################################################
    $sql = " SELECT * FROM " . TABLE_CATEGORY . " WHERE " . TABLE_CATEGORY . "_Name<>'' AND " . TABLE_CATEGORY . "_Folder<>'' ";
    $sql .= " AND " . TABLE_CATEGORY . "_isHotBox='1' ";
    $sql .= " ORDER BY " . TABLE_CATEGORY . "_Ordering ASC ";
    $query = $dbh->prepare($sql);
    if ($query->execute()) {
        while ($Row = $query->fetch()) {
            $arOnPageCatID[$index] = $Row[TABLE_CATEGORY . "_ID"];
            $arOnPageCatName[$index] = $Row[TABLE_CATEGORY . "_Name"];
            $arOnPageCatNameByID[$Row[TABLE_CATEGORY . "_ID"]] = $Row[TABLE_CATEGORY . "_Name"];
            $index++;
        }
    }
    ##########################################################################################
    $colcount = 1;
    for ($i = 0; $i < sizeof($arOnPageCatID); $i++) {
        $catid = $arOnPageCatID[$i];
        $arID = "";
        $arThumb1 = "";
        $arThumb2 = "";
        $arThumb3 = "";
        $arSubject = "";
        $loop = 1;
        //-------------------------------------------------------------
        $sql = "SELECT * FROM " . TABLE_CONTENT . " WHERE " . TABLE_CONTENT . "_Category LIKE '%," . $catid . ",%' AND " . TABLE_CONTENT . "_Thumb<>'' AND " . TABLE_CONTENT . "_Subject<>'' AND " . TABLE_CONTENT . "_Text<>'' AND " . TABLE_CONTENT . "_Status='Publish' ORDER BY " . TABLE_CONTENT . "_OnlineDate DESC LIMIT 0,7 ";
        $query = $dbh->prepare($sql);
        if ($query->execute()) {
            while ($Row = $query->fetch()) {
                $myID = $Row[TABLE_CONTENT . "_ID"];
                //--------------------------------------------
                $myIDs = sprintf('%04d', $myID);
                $myFolder1 = substr($myIDs, strlen($myIDs) - 4, 2);
                $myFolder2 = substr($myIDs, strlen($myIDs) - 2, 2);
                $Config_Path1 = "upload/thumb/" . $Config_FolderKey1 . "/" . $myFolder1 . "/" . $myFolder2 . "/";
                $Config_Path2 = "upload/thumb2/" . $Config_FolderKey2 . "/" . $myFolder1 . "/" . $myFolder2 . "/";
                $Config_Path3 = "upload/thumb3/" . $Config_FolderKey3 . "/" . $myFolder1 . "/" . $myFolder2 . "/";
                if ($Row[TABLE_CONTENT . "_Thumb"] == "") {
                    $PictureThumb1 = "";
                } else {
                    $PictureThumb1 = $Config_Path1 . $Row[TABLE_CONTENT . "_Thumb"];
                }
                if ($Row[TABLE_CONTENT . "_Thumb2"] == "") {
                    $PictureThumb2 = "";
                } else {
                    $PictureThumb2 = $Config_Path2 . $Row[TABLE_CONTENT . "_Thumb2"];
                }
                if ($Row[TABLE_CONTENT . "_Thumb3"] == "") {
                    $PictureThumb3 = "";
                } else {
                    $PictureThumb3 = $Config_Path3 . $Row[TABLE_CONTENT . "_Thumb3"];
                }
                //--------------------------------------------
                $arID[$loop] = $Row[TABLE_CONTENT . "_ID"];
                $arThumb1[$loop] = $PictureThumb1;
                $arThumb2[$loop] = $PictureThumb2;
                $arThumb3[$loop] = $PictureThumb3;
                $arSubject[$loop] = $Row[TABLE_CONTENT . "_Subject"];
                $loop++;
            }
        }
        //-------------------------------------------------------------
        if ($colcount == 1) {
            echo '<div class="row">';
        }
        if ($i % 3 == 1) {
            ?>
            <div class="col-xs-12 col-sm-6">
                <div class="box">
                    <div class="title"><h1><?php echo $arOnPageCatName[$i]; ?></h1>
                        <div class="bg"></div>
                    </div>
                    <div class="box-inner bg-gray"><?php $cindex = 1;
                        include("object/obj_items_big.php"); ?></div>
                </div>
                <div class="bottom-20"></div>
                <div class="row">
                    <div class="col-xs-6 col-sm-4">
                        <div class="box">
                            <div class="box-inner bg-white"><?php $cindex = 2;
                                include("object/obj_items_small.php"); ?></div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                        <div class="box">
                            <div class="box-inner bg-white"><?php $cindex = 3;
                                include("object/obj_items_small.php"); ?></div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                        <div class="box">
                            <div class="box-inner bg-white"><?php $cindex = 4;
                                include("object/obj_items_small.php"); ?></div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                        <div class="box">
                            <div class="box-inner bg-white"><?php $cindex = 5;
                                include("object/obj_items_small.php"); ?></div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                        <div class="box">
                            <div class="box-inner bg-white"><?php $cindex = 6;
                                include("object/obj_items_small.php"); ?></div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                        <div class="box">
                            <div class="box-inner bg-white"><?php $cindex = 7;
                                include("object/obj_items_small.php"); ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        } else {
            ?>
            <div class="col-xs-12 col-sm-3">
                <div class="box">
                    <div class="title"><h1><?php echo $arOnPageCatName[$i]; ?></h1>
                        <div class="bg"></div>
                    </div>
                    <div class="bottom-15"></div>
                    <div class="box-inner bg-white"><?php $cindex = 1;
                        include("object/obj_items_basic.php"); ?></div>
                    <div class="bottom-15"></div>
                    <div class="box-inner bg-white"><?php $cindex = 2;
                        include("object/obj_items_basic.php"); ?></div>
                    <div class="bottom-15"></div>
                    <div class="box-inner bg-white"><?php $cindex = 3;
                        include("object/obj_items_basic.php"); ?></div>
                </div>
            </div>
            <?php
        }
        $colcount++;
        if ($colcount > 3) {
            echo '</div>';
            $colcount = 1;
        }
    }
    ##########################################################################################
    if ($colcount <> 1) {
        for ($i = $colcount; $i <= 3; $i++) {
            if ($i % 3 == 2) {
                echo '<div class="col-xs-12 col-sm-6">&nbsp;</div>';
            } else {
                echo '<div class="col-xs-12 col-sm-3">&nbsp;</div>';
            }
            $colcount++;
            if ($colcount > 3) {
                echo '</div>';
                $colcount = 1;
            }
        }
    }
    ##########################################################################################
    ?>
</div>