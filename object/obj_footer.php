<?php // Use For Web Editor Set Current Character Set as UTF-8 #################
if(0) { ?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?php } ?>
<!--##############################################-->
<div class="row width-100 padding-10 footer-bg1" style=" padding-left:20px; padding-top:0px; margin:0px; width:100%; ">
<div class="hidden-xs hidden-sm col-md-1 col-lg-2 padding-2"></div>
<div class="col-xs-12 col-sm-6 col-md-3 col-lg-2 padding-2 text-left">
    <div class="footerlogo cursor"></div>
</div>
<div class="hidden-xs hidden-sm col-md-4 col-lg-4 padding-2 text-left footer-border1">
    <span class="webfont">LASTEST NEWS</span>
</div>
<div class="hidden-xs col-sm-6 col-md-3 col-lg-2 padding-2 text-left footer-border1">
    <span class="webfont">POPULAR TAGS</span>
</div>
<div class="hidden-xs hidden-sm col-md-1 col-lg-2 padding-2"></div>
</div>
<!--##############################################-->
<div class="row width-100 padding-10 footer-bg2 hidden-xs" style=" padding-left:20px; padding-top:0px; margin:0px; width:100%; height:230px; ">
<div class="hidden-xs hidden-sm col-md-1 col-lg-2 padding-2"></div>
<div class="col-xs-12 col-sm-6 col-md-3 col-lg-2 padding-2 text-left footer-border2" style=" border:0px; ">
    <table border="0" width="100%">
        <?php if(0) { ?><td class="padding-2 text-left"><a href="/" class="webfont footerlink">หน้าแรก</a></td><?php } ?>
        <?php
        $loopi=0;
        $sql=" SELECT * FROM ".TABLE_CATEGORY." WHERE ".TABLE_CATEGORY."_Name<>'' AND ".TABLE_CATEGORY."_Folder<>'' ";
        $sql.=" ORDER BY ".TABLE_CATEGORY."_Ordering ASC ";
        $query=$dbh->prepare($sql);
        if($query->execute()) {
        while($Row=$query->fetch()) {
            if($loopi==0) { echo '<tr>'; }
            ?>
            <td class="padding-2 text-left"><a href="/category/<?php echo $Row[TABLE_CATEGORY."_ID"]; ?>/1/" class="webfont footerlink"><?php echo $Row[TABLE_CATEGORY."_Name"]; ?></a></td>
            <?php
            $loopi++;
            if($loopi==2) { echo '</tr>'; $loopi=0; }
        }} else { print_r($query->errorInfo()); }
        ?>
        <?php if(0) { ?><td class="padding-2 text-left"><a href="/" class="webfont footerlink">ติดต่อเรา</a></td><?php } ?>
    </table>
    <div class="text-center padding-10" style=" margin-top:-5px; ">
        <a href="https://www.facebook.com/BaaBinz" target="_blank" class="footicon1 pull-left" title="Facebook Link"></a>
        <a href="https://www.youtube.com/channel/UCbQZkz_XJfeNW-tLYkKEBwA/videos" target="_blank" class="footicon2 pull-left" title="YouTube Link"></a>
        <a href="https://www.instagram.com/baabinz/" target="_blank" class="footicon3 pull-left" title="Instragram Link"></a>
    </div>
</div>
<div class="hidden-xs hidden-sm col-md-4 col-lg-4 padding-2 text-left footer-border2">
    <table border="0" width="100%">
        <?php
        $sql="SELECT * FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_Thumb<>'' AND ".TABLE_CONTENT."_Subject<>'' AND ".TABLE_CONTENT."_Text<>'' AND ".TABLE_CONTENT."_Status='Publish' ORDER BY ".TABLE_CONTENT."_OnlineDate DESC LIMIT 0,8 ";
        $query=$dbh->prepare($sql);
        if($query->execute()) {
        while($Row=$query->fetch()) {
            $myID=$Row[TABLE_CONTENT."_ID"];
            $mySubject=mb_substr($Row[TABLE_CONTENT."_Subject"],0,60,'UTF-8');
            ?>
            <tr>
                <td class="padding-2 text-left">
                    <a href="/<?php echo $myID; ?>/" class="webfont footerlink"><?php echo trim($mySubject); ?>..</a>
                </td>
            </tr>
        <?php
        }} else { print_r($query->errorInfo()); }
        ?>
    </table>    
</div>
<div class="hidden-xs col-sm-6 col-md-3 col-lg-2 padding-2 text-left footer-border2">
    <?php
    $sql=" SELECT * FROM ".TABLE_TAGS." WHERE ".TABLE_TAGS."_Name<>'' AND ".TABLE_TAGS."_NoOfUse>0 ";
    $sql.=" ORDER BY ".TABLE_TAGS."_NoOfUse DESC LIMIT 0,11 ";
    $query=$dbh->prepare($sql);
    if($query->execute()) {
    while($Row=$query->fetch()) {
        ?>
        <div class="footertags pull-left border-radius-5"><a href="/hashtags/<?php echo $Row[TABLE_TAGS."_ID"]; ?>/1/" class="webfont footerlink">#<?php echo $Row[TABLE_TAGS."_Name"]; ?></a></div>
        <?php
    }} else { print_r($query->errorInfo()); }
    ?>
</div>
<div class="hidden-xs hidden-sm col-md-1 col-lg-2 padding-2"></div>
</div> 
<!--##############################################-->
<div class="row width-100 padding-10 footer-bg3 hidden-xs" style=" padding-left:20px; margin:0px; width:100%; ">
<div class="hidden-xs hidden-sm col-md-1 col-lg-2 padding-2"></div>
<div class="col-xs-12 col-sm-12 col-md-10 col-lg-8 padding-0">
    <span class="webfont pull-left">COPYRIGHT ALL RIGHT RESERVED 2015</span>
    <span class="webfont pull-right">
        <script>// <![CDATA[
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){ (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m) })(window,document,'script','//www.google-analytics.com/analytics.js','ga'); ga('create', 'UA-63833674-1', 'auto'); ga('send', 'pageview');
        // ]]></script>
        <script src="http://hits.truehits.in.th/data/t0031516.js" type="text/javascript"></script>
        <noscript>
        <a target="_blank" href="http://truehits.net/stat.php?id=t0031516"><img src="http://hits.truehits.in.th/noscript.php?id=t0031516" alt="Thailand Web Stat" border="0" width="14" height="17"/></a>
        <a target="_blank" href="http://truehits.net/">Truehits.net</a>
        </noscript>        
    <b>BAABINZ</b> POWERED BY &nbsp;
    <img src="/img/prototype.png" width="98" height="25" />
    </span>
</div>
<div class="hidden-xs hidden-sm col-md-1 col-lg-2 padding-2"></div>
</div>
<!--##############################################-->