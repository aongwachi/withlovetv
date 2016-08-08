<?php
if(0) {
## Fix Pre-define Variable ########################################################################
if($_SERVER[HTTP_HOST]=='baabinz.com' || $_SERVER[HTTP_HOST]=='www.baabinz.com'){
	header('Location: http://baabin.com'.$_SERVER[REQUEST_URI]);
}
$System_HeaderMetaTag=null;
##################################################################################################
$isEnableCaching=true;
//$isEnableCaching=false;
if($isEnableCaching) {
    // Loading Time //////////////////////////////////////////////////////////////////////////////
    $Config_LoadingTime=microtime();
    $Config_LoadingTime=explode(' ',$Config_LoadingTime);
    $Config_LoadingTime=$Config_LoadingTime[1]+$Config_LoadingTime[0];
    $Config_LoadingTime_Start=$Config_LoadingTime;

    // Caching Start //////////////////////////////////////////////////////////////////////////////
    define('CONFIG_CACHE_PATH', "/home/baabinz/domains/baabinz.com/public_html/upload/htmlcaching/");
    define('CONFIG_CACHE_TIME', 5); // minute
    define('CONFIG_CACHE_FILE',md5(basename($_SERVER['PHP_SELF']) . "?" . $_SERVER['QUERY_STRING']).".html");
    $Config_CacheFile=CONFIG_CACHE_PATH.'cached-'.CONFIG_CACHE_FILE;
    $Config_CacheTime=5*60; // minute
    if (file_exists($Config_CacheFile) && time() - $Config_CacheTime < filemtime($Config_CacheFile)) {
//if (time()-$Config_CacheTime < @filemtime($Config_CacheFile)) {
        include($Config_CacheFile);
        ?>
        <!--##############################################-->
        <div class="width-100 padding-4 footer-bg2 text-center" style=" height:24px; color:#666666; ">
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
        </body>
        </html>
        <?php
        exit;
    }
    ob_start();
}
}
?>
