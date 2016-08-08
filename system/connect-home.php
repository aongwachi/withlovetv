<?php
################################################################################################
$dbh=new PDO('mysql:host='.SYSTEM_DB_HOSTNAME.';dbname='.SYSTEM_DB_NAME.';charset=utf8',SYSTEM_DB_USERNAME,SYSTEM_DB_PASSWORD);
$dbh->exec("set names utf8");
################################################################################################
