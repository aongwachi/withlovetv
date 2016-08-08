<?php
################################################################################################
$System_Connection2=MYSQL_CONNECT(DROPSHOP_DB_HOSTNAME,DROPSHOP_DB_USERNAME,DROPSHOP_DB_PASSWORD) OR DIE("Error! MySQL Services");
MYSQL_SELECT_DB(DROPSHOP_DB_NAME,$System_Connection2) OR DIE("Error! MySQL Connection 2");
MYSQL_QUERY("SET NAMES UTF8",$System_Connection2);
ini_set("register_globals","On");
################################################################################################
?>