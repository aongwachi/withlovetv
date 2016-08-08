<?php
################################################################################################
$System_Connection1=MYSQL_CONNECT(SYSTEM_DB_HOSTNAME,SYSTEM_DB_USERNAME,SYSTEM_DB_PASSWORD) OR DIE("Error! MySQL Services");
MYSQL_SELECT_DB(SYSTEM_DB_NAME,$System_Connection1) OR DIE("Error! MySQL Connection");
MYSQL_QUERY("SET NAMES UTF8",$System_Connection1);
//ini_set("register_globals","On");
################################################################################################
?>