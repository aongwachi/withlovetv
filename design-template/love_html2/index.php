<?php 
    include "shared/header.php";
?>
    <!-- Header -->
    <header>
        <div class="container">
            <div class="breadcrumb-wrap">
                <ol class="breadcrumb">
                  <li><a href="#">หน้าหลัก</a></li>
                  <li class="active">ดูรายการสด (Live)</li>
                </ol>
            </div>
            <div class="row">
                <a href="#" class="banner-ads">
                    <img src="./images/ads.jpg" />
                </a>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-7">
                    <div id="homeVideo"></div>
                    <script>
                        jwplayer("homeVideo").setup({
                          file: "rtmp://draco.streamingwizard.com/wizard/_definst_/demo/sample.mp4",
                          image: "./images/video.png",
                          width: "100%",
                          aspectratio: "16:10",
                          skin: {
                            name: "seven"
                          }
                        });
                    </script>


                </div>
                <div class="col-xs-12 col-sm-5">
                    <div class="video-info">
                        <div class="header-title">
                            <h1>AIS Futsal Thailand Leaque 2016</h1>
                            <h4>LIVE Report 29 พฤษภาคม 2559 , 16:00น. - 17:30น.</h4>
                        </div>
                        <div class="desc">
                            <label><span aria-hidden="true" class="glyphicon glyphicon-play text-pink"></span> Auto Play</label>
                            ความละเอียด :  512 k
                            <br />
                            <br />
                            <br />
                            <br />
                        </div>
                    </div>
                    <div class="video-playlist">
                        <div class="header-title">
                            <div class="row">
                                <div class="col-xs-4">
                                    <h2>รายการต่อไป</h2>
                                </div>
                                <div class="col-xs-8 text-right">
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
    <div class="container">

        <div class="row">
            <div class="col-xs-12 col-sm-8">
                <div class="box">
                    <div class="title">
                        <h1>รายการแนะนำ</h1><div class="bg"></div>
                    </div>
                    <div class="box-inner bg-lightgray">
                        <div class="item item-pad">
                            <a href="#" class="thumb">
                                <img src="./images/thumb1.jpg" />
                                <div class="img-hover">PLAY</div>
                            </a>
                            <div class="desc">
                                <div class="text">
                                    <span class="text-pink">ON AIR</span> : ทุกวันอาทิตย์ , 16:00น. - 17:30น.
                                    <div class="pull-right text-right">
                                        <a href="#" class="btn btn-pink">ทั่วไป</a>
                                        <a href="#" class="btn btn-gray">แชร์</a>
                                    </div>
                                </div>
                                <hr />
                                <h2>เมนูเส้นนานาชาติจากร้านพ่อค้า-แม่ค้าสุดแซ่บ</h2>
                                <div class="tags">
                                    <a href="#">รายการเล่าเส้นเป็นเรื่อง</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bottom-20"></div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div class="box">
                            <div class="box-inner bg-lightgray">
                                <div class="item">
                                    <a href="#" class="thumb">
                                        <img src="./images/thumb2.jpg" />
                                        <div class="img-hover">PLAY</div>
                                    </a>
                                    <div class="desc">
                                        <div class="text">
                                            <span class="text-pink">ON AIR</span> : ทุกวันอาทิตย์ , 16:00น. - 17:30น.
                                        </div>
                                        <hr />
                                        <h2>รายการตอบปัญหาทดสอบความจำและการตัดสินใจ</h2>
                                        <div class="tags">
                                            <a href="#">รายการปริศนาฟ้าแลบ</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="box">
                            <div class="box-inner bg-lightgray">
                                <div class="item">
                                    <a href="#" class="thumb">
                                        <img src="./images/thumb3.jpg" />
                                        <div class="img-hover">PLAY</div>
                                    </a>
                                    <div class="desc">
                                        <div class="text">
                                            <span class="text-pink">ON AIR</span> : ทุกวันอาทิตย์ , 16:00น. - 17:30น.
                                        </div>
                                        <hr />
                                        <h2>รายการวาไรตี้ท่องเที่ยงกับสามพิธีกรสุดแซ่บ</h2>
                                        <div class="tags">
                                            <a href="#">รายการเทยเที่ยวไทย</a>
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
                        <h1>Most Watched</h1><div class="bg"></div>
                    </div>
                    <div class="box-inner bg-lightgray">
                        <div class="item item-pad">
                            <a href="#" class="thumb">
                                <img src="./images/thumb8.jpg" />
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
                            <hr class="gap" />
                        </div>
                        <div class="item item-pad">
                            <a href="#" class="thumb">
                                <img src="./images/thumb9.jpg" />
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
                            <hr class="gap" />
                        </div>
                        <div class="item item-pad">
                            <a href="#" class="thumb">
                                <img src="./images/thumb10.jpg" />
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
                            <hr class="gap" />
                        </div>

                    </div>
                </div>
            </div>
        </div>
        
        <div class="bottom-20"></div>

        <div class="row">
            <div class="col-xs-12 col-sm-3">
                <div class="box">
                    <div class="title">
                        <h1>ข่าวล่าสุด</h1><div class="bg"></div>
                    </div>
                    <div class="bottom-15"></div>
                    <div class="box-inner bg-white">
                        <div class="item">
                            <a href="#" class="thumb">
                                <img src="./images/thumb4.jpg" />
                            </a>
                            <div class="desc">
                                <div class="text">
                                    <a href="#" class="btn btn-pink">ทั่วไป</a>
                                    <a href="#" class="btn btn-gray">แชร์</a>
                                </div>
                                <p>
                                สวยยันไส้ “ปุ๊กลุก ฝนทิพย์” เสน่ห์แรง หลังมีข่าวหนุ่มคนนี้ตามจีบ !?! เรียกว่าฮ็อตสุดๆ สำหรับสาปุ๊กลุก ล่าสุดสวยขึ้นจนหนุ่มๆต่อแถวขายขนมจีบ...
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="bottom-15"></div>
                    <div class="box-inner bg-white">
                        <div class="item">
                            <a href="#" class="thumb">
                                <img src="./images/thumb5.jpg" />
                            </a>
                            <div class="desc">
                                <div class="text">
                                    <a href="#" class="btn btn-pink">ทั่วไป</a>
                                    <a href="#" class="btn btn-gray">แชร์</a>
                                </div>
                                <p>
                                สวยยันไส้ “ปุ๊กลุก ฝนทิพย์” เสน่ห์แรง หลังมีข่าวหนุ่มคนนี้ตามจีบ !?! เรียกว่าฮ็อตสุดๆ สำหรับสาปุ๊กลุก ล่าสุดสวยขึ้นจนหนุ่มๆต่อแถวขายขนมจีบ...
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="bottom-15"></div>
                    <div class="box-inner bg-white">
                        <div class="item">
                            <a href="#" class="thumb">
                                <img src="./images/thumb6.jpg" />
                            </a>
                            <div class="desc">
                                <div class="text">
                                    <a href="#" class="btn btn-pink">ทั่วไป</a>
                                    <a href="#" class="btn btn-gray">แชร์</a>
                                </div>
                                <p>
                                สวยยันไส้ “ปุ๊กลุก ฝนทิพย์” เสน่ห์แรง หลังมีข่าวหนุ่มคนนี้ตามจีบ !?! เรียกว่าฮ็อตสุดๆ สำหรับสาปุ๊กลุก ล่าสุดสวยขึ้นจนหนุ่มๆต่อแถวขายขนมจีบ...
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="box">
                    <div class="title">
                        <h1>เรื่องเด่น</h1><div class="bg"></div>
                    </div>
                    <div class="box-inner bg-lightgray">
                        <div class="item item-pad">
                            <a href="#" class="thumb">
                                <img src="./images/thumb7.jpg" />
                            </a>
                            <div class="desc">
                                <div class="text">
                                    <a href="#" class="btn btn-pink">ทั่วไป</a>
                                    <a href="#" class="btn btn-gray">แชร์</a>
                                </div>
                                <p>
                                สวยยันไส้ “ปุ๊กลุก ฝนทิพย์” เสน่ห์แรง หลังมีข่าวหนุ่มคนนี้ตามจีบ !?! เรียกว่าฮ็อตสุดๆ สำหรับสาปุ๊กลุก ล่าสุดสวยขึ้นจนหนุ่มๆต่อแถวขายขนมจีบ...
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bottom-20"></div>
                <div class="row">
                    <div class="col-xs-6 col-sm-4">
                        <div class="box">
                            <div class="box-inner bg-white">
                                <div class="item item-sm">
                                    <a href="#" class="thumb">
                                        <img src="./images/thumb6.jpg" />
                                    </a>
                                    <div class="desc">
                                        <div class="text">
                                            <a href="#" class="btn btn-pink">ทั่วไป</a>
                                            <a href="#" class="btn btn-gray">แชร์</a>
                                        </div>
                                        <p>
                                        สวยยันไส้ “ปุ๊กลุก ฝนทิพย์” เสน่ห์แรง หลังมีข่าวหนุ่มคนนี้ตามจีบ !?! ...
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                        <div class="box">
                            <div class="box-inner bg-white">
                                <div class="item item-sm">
                                    <a href="#" class="thumb">
                                        <img src="./images/thumb6.jpg" />
                                    </a>
                                    <div class="desc">
                                        <div class="text">
                                            <a href="#" class="btn btn-pink">ทั่วไป</a>
                                            <a href="#" class="btn btn-gray">แชร์</a>
                                        </div>
                                        <p>
                                        สวยยันไส้ “ปุ๊กลุก ฝนทิพย์” เสน่ห์แรง หลังมีข่าวหนุ่มคนนี้ตามจีบ !?! ...
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                        <div class="box">
                            <div class="box-inner bg-white">
                                <div class="item item-sm">
                                    <a href="#" class="thumb">
                                        <img src="./images/thumb6.jpg" />
                                    </a>
                                    <div class="desc">
                                        <div class="text">
                                            <a href="#" class="btn btn-pink">ทั่วไป</a>
                                            <a href="#" class="btn btn-gray">แชร์</a>
                                        </div>
                                        <p>
                                        สวยยันไส้ “ปุ๊กลุก ฝนทิพย์” เสน่ห์แรง หลังมีข่าวหนุ่มคนนี้ตามจีบ !?! ...
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                        <div class="box">
                            <div class="box-inner bg-white">
                                <div class="item item-sm">
                                    <a href="#" class="thumb">
                                        <img src="./images/thumb6.jpg" />
                                    </a>
                                    <div class="desc">
                                        <div class="text">
                                            <a href="#" class="btn btn-pink">ทั่วไป</a>
                                            <a href="#" class="btn btn-gray">แชร์</a>
                                        </div>
                                        <p>
                                        สวยยันไส้ “ปุ๊กลุก ฝนทิพย์” เสน่ห์แรง หลังมีข่าวหนุ่มคนนี้ตามจีบ !?! ...
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><div class="col-xs-6 col-sm-4">
                        <div class="box">
                            <div class="box-inner bg-white">
                                <div class="item item-sm">
                                    <a href="#" class="thumb">
                                        <img src="./images/thumb6.jpg" />
                                    </a>
                                    <div class="desc">
                                        <div class="text">
                                            <a href="#" class="btn btn-pink">ทั่วไป</a>
                                            <a href="#" class="btn btn-gray">แชร์</a>
                                        </div>
                                        <p>
                                        สวยยันไส้ “ปุ๊กลุก ฝนทิพย์” เสน่ห์แรง หลังมีข่าวหนุ่มคนนี้ตามจีบ !?! ...
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                        <div class="box">
                            <div class="box-inner bg-white">
                                <div class="item item-sm">
                                    <a href="#" class="thumb">
                                        <img src="./images/thumb6.jpg" />
                                    </a>
                                    <div class="desc">
                                        <div class="text">
                                            <a href="#" class="btn btn-pink">ทั่วไป</a>
                                            <a href="#" class="btn btn-gray">แชร์</a>
                                        </div>
                                        <p>
                                        สวยยันไส้ “ปุ๊กลุก ฝนทิพย์” เสน่ห์แรง หลังมีข่าวหนุ่มคนนี้ตามจีบ !?! ...
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-xs-12 col-sm-3">
                <div class="box">
                    <div class="title">
                        <h1>คลิปดัง</h1><div class="bg"></div>
                    </div>
                    <div class="bottom-15"></div>
                    <div class="box-inner bg-white">
                        <div class="item">
                            <a href="#" class="thumb">
                                <img src="./images/thumb4.jpg" />
                            </a>
                            <div class="desc">
                                <div class="text">
                                    <a href="#" class="btn btn-pink">คลิป</a>
                                    <a href="#" class="btn btn-gray">แชร์</a>
                                </div>
                                <p>
                                สวยยันไส้ “ปุ๊กลุก ฝนทิพย์” เสน่ห์แรง หลังมีข่าวหนุ่มคนนี้ตามจีบ !?! เรียกว่าฮ็อตสุดๆ สำหรับสาปุ๊กลุก ล่าสุดสวยขึ้นจนหนุ่มๆต่อแถวขายขนมจีบ...
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="bottom-15"></div>
                    <div class="box-inner bg-white">
                        <div class="item">
                            <a href="#" class="thumb">
                                <img src="./images/thumb5.jpg" />
                            </a>
                            <div class="desc">
                                <div class="text">
                                    <a href="#" class="btn btn-pink">คลิป</a>
                                    <a href="#" class="btn btn-gray">แชร์</a>
                                </div>
                                <p>
                                สวยยันไส้ “ปุ๊กลุก ฝนทิพย์” เสน่ห์แรง หลังมีข่าวหนุ่มคนนี้ตามจีบ !?! เรียกว่าฮ็อตสุดๆ สำหรับสาปุ๊กลุก ล่าสุดสวยขึ้นจนหนุ่มๆต่อแถวขายขนมจีบ...
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="bottom-15"></div>
                    <div class="box-inner bg-white">
                        <div class="item">
                            <a href="#" class="thumb">
                                <img src="./images/thumb6.jpg" />
                            </a>
                            <div class="desc">
                                <div class="text">
                                    <a href="#" class="btn btn-pink">คลิป</a>
                                    <a href="#" class="btn btn-gray">แชร์</a>
                                </div>
                                <p>
                                สวยยันไส้ “ปุ๊กลุก ฝนทิพย์” เสน่ห์แรง หลังมีข่าวหนุ่มคนนี้ตามจีบ !?! เรียกว่าฮ็อตสุดๆ สำหรับสาปุ๊กลุก ล่าสุดสวยขึ้นจนหนุ่มๆต่อแถวขายขนมจีบ...
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        
    </div>


<?php include "shared/footer.php"; ?>