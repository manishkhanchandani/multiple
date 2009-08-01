<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_conn2 = "localhost";
$database_conn2 = "multi1";
$username_conn2 = "root";
$password_conn2 = "";
$conn2 = mysql_pconnect($hostname_conn2, $username_conn2, $password_conn2) or trigger_error(mysql_error(),E_USER_ERROR); 
?>