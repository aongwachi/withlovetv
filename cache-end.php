<?php
if(0) {
$isEnableCaching=true;
//$isEnableCaching=false;
if($isEnableCaching) {
    //////////////////////////////////////////////////////////////////////////////
    $cachedcontent = fopen($Config_CacheFile,'w+');
    fwrite($cachedcontent,ob_get_contents());
    fclose($cachedcontent);
    ob_end_flush();
    //////////////////////////////////////////////////////////////////////////////
    ?>
    <!--##############################################-->
    <div class="width-100 padding-2 footer-bg2 text-center" style=" height:24px; color:#666666; ">
        <?php
        $Config_LoadingTime=microtime();
        $Config_LoadingTime=explode(' ',$Config_LoadingTime);
        $Config_LoadingTime=$Config_LoadingTime[1]+$Config_LoadingTime[0];
        $Config_LoadingTime_Finish=$Config_LoadingTime;
        $Config_LoadingTime_TotalTime=round(($Config_LoadingTime_Finish-$Config_LoadingTime_Start),4);
        echo 'Loading time '.$Config_LoadingTime_TotalTime.' seconds.';
        //echo ' | '.CONFIG_CACHE_FILE.' | ';
        //echo basename($_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']).".html";
        ?>
    </div>
    <!--##############################################-->
<?php
}
}
?>
</body>
</html>