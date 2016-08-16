<?php
####################################################################################
$sql1 = " SELECT * FROM " . TABLE_LIVE . " WHERE 1 ORDER BY RAND() LIMIT 0,1 ";
$query1 = $dbh->prepare($sql1);
if ($query1->execute()) {
    $Row1 = $query1->fetch();
    $myLiveLink = $Row1[TABLE_LIVE . "_Link"];
    $myLiveResolution = $Row1[TABLE_LIVE . "_Resolution"];
}
####################################################################################
$sql_recommend_video = " SELECT * FROM " . TABLE_PROGRAM . " WHERE 1  ORDER BY tv_program_ID DESC LIMIT 3 ";
$query_reccommend = $dbh->prepare($sql_recommend_video);
$vidRecommend = array();
if ($query_reccommend->execute()) {
    while ($row = $query_reccommend->fetch()) {
        $res = array();
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
                    $(window).load(function () {
                        //alert(checkChannelDate('2016-08-15 00:30:00','2016-08-15 01:49:00'));
                        getLiveListVideo();
                    });
                    function getLiveListVideo() {
                        $('.list-playlist').empty();
                        $.ajax({
                            method: "POST",
                            url: "lib/ajax/ajax_return_live_video.php"
                        }).done(function (data) {
                            //set main live
                            var setLive = false;
                            var nextIndex = 0;
                            var nextChannelDate = null;
                            $.each(data, function (i, v) {
                                if (checkChannelDate(v.starttime, v.endtime) && setLive == false) {
                                    jwplayer("homeVideo").setup({
                                        sources: [
                                            {file: v.link},
                                            {file: v.link_mobile}
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
                                    $('.header-title').find('h1').text(v.title);
                                    setLive = true;
                                    nextIndex = i;
                                }
                                var list_live = '<li class="' + '' + '">' +
                                    '<a><div class="label">' +
                                    v.title +
                                    '</div>' +
                                    '<div class="desc">' +
                                    '' +
                                    '</div>' +
                                    '<div class="clearfix"></div>' +
                                    '</a>' +
                                    '</li>';
                                var firstNext = 0;
                                if (setLive && i > nextIndex) {
                                    nextChannelDate = data[nextIndex+1].starttime;
                                    $('.list-playlist').append(list_live);
                                }
                                else if(nowAndNextChannel(v.starttime)){
                                    firstNext++;
                                    if(firstNext==1) nextChannelDate = v.starttime;
                                    $('.list-playlist').append(list_live);
                                }
                            });
                            //blank video
                            if ($('#homeVideo').is(':empty')){
                                $('#homeVideo').prepend('<img id="theImg" src="imgweb/wait.png" />');
                            }
                            //set diff
                            var now = new Date();
                            now = strToDateTime(now.getFullYear() + '-' + (now.getMonth() + 1) + '-' + now.getDate()
                                + ' ' + now.getHours() + ':' + now.getMinutes() + ':' + now.getSeconds());
                            var nextTime = strToDateTime(nextChannelDate);
                            var diffSec = Math.abs((nextTime.getTime() - now.getTime())/1000);
                            var display = $('#time');
                            startTimer(diffSec, display);
                        });
                    }
                    function startTimer(duration, display) {
                        var timer = duration, minutes, seconds;
                        setInterval(function () {
                            minutes = parseInt(timer / 60, 10);
                            seconds = parseInt(timer % 60, 10);

                            minutes = minutes < 10 ? "0" + minutes : minutes;
                            seconds = seconds < 10 ? "0" + seconds : seconds;

                            display.text(minutes + ":" + seconds);

                            if (--timer < 0) {
                                location.reload();
                            }
                        }, 1000);
                    }
                    function checkChannelDate(from, to) {
                        var now = new Date();
                        now = strToDateTime(now.getFullYear() + '-' + (now.getMonth() + 1) + '-' + now.getDate()
                            + ' ' + now.getHours() + ':' + now.getMinutes() + ':' + now.getSeconds());
                        from = strToDateTime(from);
                        to = strToDateTime(to);
                        var returnVal = false;
                        if (now > from && now < to) {
                            returnVal = true;
                        }
                        return returnVal;
                    }
                    function nowAndNextChannel(next)
                    {
                        var now = new Date();
                        now = strToDateTime(now.getFullYear() + '-' + (now.getMonth() + 1) + '-' + now.getDate()
                            + ' ' + now.getHours() + ':' + now.getMinutes() + ':' + now.getSeconds());
                        next = strToDateTime(next);
                        var returnVal = false;
                        if (now < next) {
                            returnVal = true;
                        }
                        return returnVal;
                    }
                    function strToDateTime(dateString) {
                        var dt = dateString.split(/\-|\s/);
                        return new Date(dt.slice(0, 3).join('-') + ' ' + dt[3]);
                    }
                </script>
                <script>
                    window.fbAsyncInit = function() {
                        FB.init({
                            appId      : '1110589729021131',
                            xfbml      : true,
                            version    : 'v2.5'
                        });
                    };

                    (function(d, s, id){
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id)) {return;}
                        js = d.createElement(s); js.id = id;
                        js.src = "//connect.facebook.net/en_US/sdk.js";
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));
                    function postToFeed(title, desc, url, image){
                        var obj = {method: 'feed',link: url, picture: image,name: title,description: desc};
                        function callback(response){}
                        FB.ui(obj, callback);
                    }
                    $(window).load(function () {
                        $('.btnShare').click(function(){
                            elem = $(this);
                            postToFeed('', '', elem.attr('data-href'), '');
                            return false;
                        });
                    });
                </script>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5 nopadding-left-sm">
                <br>
                <div class="video-info bg-black">
                    <div class="header-title">
                        <h1></h1>
                        <h4><span class="text-yellow">LIVE!</span> &nbsp;
                            วันที่ <?php echo System_ShowDateLongTh(SYSTEM_DATENOW); ?>
                            เวลา <?php echo substr(SYSTEM_TIMENOW, 0, 5); ?></h4>
                    </div>
                    <div class="desc">
                        <label><span aria-hidden="true" class="glyphicon glyphicon-play text-pink"></span> Auto
                            Play</label> ความละเอียด : <?php echo $myLiveResolution; ?>k
                        <br/>
                        <div> อีก <span id="time"></span> นาที จะฉายรายการถัดไป
                        </div>
                    </div>
                    <div class="video-playlist bg-darkgray">
                        <div class="header-title">
                            <div class="row">
                                <div class="col-xs-5 nopadding-right">
                                    <h2>รายการต่อไป</h2>
                                </div>
                                <!--                            <div class="col-xs-7 nopadding-left text-right">-->
                                <!--                                <h3>วันอาทิตย์ที่ 29 พฤษภาคม พ.ศ. 2559</h3>-->
                                <!--                            </div>-->
                            </div>
                        </div>
                        <ul class="list-playlist">
                            <li class="active">
                                <a>
                                    <div class="label">
                                        17:58
                                    </div>
                                    <div class="desc">
                                        Express News
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
    <div class="bottom-20"></div>
</div>