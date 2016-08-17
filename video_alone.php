<?php
include_once("_config/config_system.php");
include_once(SYSTEM_DOC_ROOT."system/core-start-ajax-home.php");
####################################################################################
$sql1=" SELECT ".TABLE_THEME."_Key FROM ".TABLE_THEME." WHERE 1 ORDER BY ".TABLE_THEME."_Selected DESC,".TABLE_THEME."_ID ASC LIMIT 0,1 ";
$query1=$dbh->prepare($sql1);
if($query1->execute()) {
    $Row1=$query1->fetch();
    if($Row1[0]>0) {
        $myThemeKey=$Row1[0];
    } else {
        $myThemeKey=1;
    }
}
####################################################################################
?>
<?php
$url = (isset($_GET['url']) ? $_GET['url'] : "https://www.youtube.com/watch?v=B4z7loNm_kw");
####################################################################################
include_once("shared/header".$myThemeKey.".php");
?>
    <!-- Content -->
    <div class="container container-padding">

        <div class="row">
            <div class="col-xs-12 col-sm-8">
                <div class="box">
                    <div class="title">
                        <br>
                        <h1>ด้วยรัก</h1>
                        <div class="bg"></div>
                    </div>
                    <div class="box-inner bg-darkgray">
                        <div class="item item-pad">
                            <a class="thumb" id="rec_1" onclick="play_rec1()">
                                <img src="./images/thumb1.jpg" id="img_rec1"/>
                                <div id="video_rec1"></div>
                            </a>
                            <script>
                                $('#img_rec1').hide();
                                $('#play_button_rec1').hide();
                                jwplayer("video_rec1").setup({
                                    file: "<?=$url ?>",
                                    width: "100%",
                                    aspectratio: "16:10",
                                    autostart: true,
                                    fallback: false,
                                    skin: {
                                        name: "seven"
                                    }
                                });
                            </script>
                            <div class="desc">
                                <div class="text">
                                    <span class="text-pink">ON AIR</span> : ทุกวันอาทิตย์ , 16:00น. - 17:30น.
                                    <div class="pull-right text-right">
                                        <a data-href="<?php echo $vidRecommend[0]['url']; ?>" class="btn btn-gray btnShare">แชร์</a>
                                    </div>
                                </div>
                                <hr/>
                                <h2><?php echo $vidRecommend[0]['title']; ?></h2>
                                <div class="tags">
                                    <a href="#"><?php echo $vidRecommend[0]['detail']; ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bottom-20"></div>
            </div>
        </div>
        <div class="bottom-20"></div>
    </div>
<?php
include_once("shared/footer".$myThemeKey.".php");
####################################################################################
?>