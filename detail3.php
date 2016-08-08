<div class="container container-padding" style=" padding-top:10px; ">
    <div class="row">
        <!---------------------------------------------------->
        <div class="col-xs-12 col-sm-8">
            <div class="box">
                <div class="title-playlist">
                    <h2 style=" margin-top: 5px; margin-bottom: 0px; "><?php echo $mySubject; ?></h2>
                    <div class="row-1"></div>
                    <br class="clear" />
                </div>
                <div class="box-inner bg-white text-justify">
                    <div style=" padding:20px; padding-left:50px; padding-right:50px; ">
                        <div class="row">
                            <img src="<?php echo $PictureThumbFB; ?>" class="img-responsive center-block">
                            <br>
                        </div>
                        <?php
                        //---------------------------------
                        $myText=str_replace('\n','',$myText);
                        $myText=str_replace('<img','<br><img',$myText);
                        $myText=str_replace('<iframe','<br><iframe',$myText);
                        $myText=str_replace('</iframe>','</iframe><br>',$myText);
                        //---------------------------------
                        if(strpos($myText,"[#####]")>0) {
                            $arText=explode("[#####]",$myText);
                            for($i=0;$i<sizeof($arText);$i++) {
                                if($arText[$i]<>"") {
                                    if(strpos($arText[$i],"[@@@]")>0) {
                                        $arText1=explode("[@@@]",$arText[$i]);
                                        if(trim($arText1[0])=="text") {
                                            echo $arText1[1];
                                        }
                                        if(trim($arText1[0])=="video") {
                                            if(trim($arText1[1])<>"") {
                                               echo '<br><div style=" padding-left:30px; padding-right:30px; "><div class="videoWrapper">'.str_replace('\\'.'n',' ',trim(str_replace('[#[#]','<',str_replace('[#]#]','>',$arText1[1])))).'</div></div><br>';
                                            }
                                        }
                                    }
                                }
                            }
                        } else {
                            echo $myText;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!---------------------------------------------------->
        <div class="col-xs-12 col-sm-4">
            <div class="box">
                <div class="title">
                    <h1>Recommended</h1><div class="bg"></div>
                </div>
                <div class="box-inner bg-lightgray">
                    <div class="item item-pad"><?php $cindex=1; include("object/obj_items_basic.php"); ?><hr class="gap" /></div>
                    <div class="item item-pad"><?php $cindex=2; include("object/obj_items_basic.php"); ?><hr class="gap" /></div>
                    <div class="item item-pad"><?php $cindex=3; include("object/obj_items_basic.php"); ?><hr class="gap" /></div>
                    <div class="item item-pad"><?php $cindex=4; include("object/obj_items_basic.php"); ?></div>
                </div>
            </div>
        </div>
    </div>
    
</div>
<style>
.title-playlist { margin-bottom: 5px; }
.title-playlist .row-1 { height: 10px; }
.box hr.gap { margin: 0px; padding: 5px; }
.pull-center { display: block; margin-left: auto; margin-right: auto; } /*.center-block; */
.text-justify { text-align:justify; }
</style>