<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12">
            <div class="title-playlist">
                <h2 style="margin-top: 5px; margin-bottom: 5px;margin-left: 40%">ผังรายการ</h2>
                <div class="row-1"></div>
                <br class="clear"/>
            </div>
            <?php
                $date = new DateTime();
                $day = !empty($_REQUEST['day'])&&$_REQUEST['day']!=''?$_REQUEST['day']:date("w",strtotime($date))-2;
            ?>
            <div class="title-playlist" style="margin-bottom: 50px">
                <a class="weekDay <?=$day==7?'active':''?>" href="video_schedule.php?day=7">
                    <h3 style="color: white;margin-left: 20px">วันอาทิตย์</h3>
                </a>
                <a class="weekDay <?=$day==1?'active':''?>" href="video_schedule.php?day=1">
                    <h3 style="color: white;margin-left: 20px">วันจันทร์</h3>
                </a>
                <a class="weekDay <?=$day==2?'active':''?>" href="video_schedule.php?day=2">
                    <h3 style="color: white;margin-left: 20px">วันอังคาร</h3>
                </a>
                <a class="weekDay <?=$day==3?'active':''?>" href="video_schedule.php?day=3">
                    <h3 style="color: white;margin-left: 20px">วันพุทธ</h3>
                </a>
                <a class="weekDay <?=$day==4?'active':''?>" href="video_schedule.php?day=4">
                    <h3 style="color: white;margin-left: 20px">วันพฤหัส</h3>
                </a>
                <a class="weekDay <?=$day==5?'active':''?>" href="video_schedule.php?day=5">
                    <h3 style="color: white;margin-left: 20px">วันศุกร์</h3>
                </a>
                <a class="weekDay <?=$day==6?'active':''?>" href="video_schedule.php?day=6">
                    <h3 style="color: white;margin-left: 20px">วันเสาร์</h3>
                </a>
            </div>
            <?php
            if (gettype($videoSubject) == 'array') {
                ?>
                <div class="box-list">
                    <!---------------------------------------------->
                    <?php for ($i = 1; $i <= count($videoSubject); $i++) {
                        if ($videoSubject[$i] <> "") { ?>
                            <div class="row" style="margin-top: 25px">
                                <div class="col-xs-6 col-sm-4 col-md-4">
                                    <div style="width: 123px;height: 23px;border-style: solid;
                                        border-color: grey;background-color: grey;
                                        margin-left: 10px;float: left">
                                        <p style="color: white">
                                            <?=date('g:i a',strtotime($videoDate[$i])).' - '.date('g:i a',strtotime($videoEndDate[$i]))?>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-4 col-md-4">
                                    <div>
                                        <h5 style="margin-top: 0;font-weight: bold;"><?=$videoSubject[$i]?></h5>
                                        <p style="width: 450px;word-wrap: break-word"><?=$videoDetail[$i]?></p>
<!--                                        <a href="video_alone.php?url=--><?php //echo $videoUrl[$i]; ?><!--"> ดูรายการย้อนหลัง</a>-->
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-4 col-md-4">
                                    <img style="height: 100px;width: 160px"
                                         src="<?= !empty($videoThumb[$i])&&$videoThumb[$i]?$videoThumb[$i]:'upload/thumb2/00/30/default-thumbnail.jpg'?>" />
                                </div>
                            </div>
                        <?php }
                    } ?>
                    <!---------------------------------------------->
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <!------------------------------------------------->
</div>
<style>
    .title-playlist {
        margin-bottom: 5px;
    }

    .title-playlist .row-1 {
        margin: 0;
        padding: 0;
        color: #fff;
        height: 10px;
        border-bottom: 0px;
        border-top: 1px solid #555555;
    }

    .weekDay {
        width: 150px;height: 70px;border-style: solid;
        border-color: grey;background-color: #ccc;
        margin-left: 10px;float: left
    }
    .weekDay:hover  {
        cursor: pointer;
    }
    .active {
        background-color: #6E6E6E;
    }
</style>