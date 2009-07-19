<?php
$conn = @mysql_connect("localhost", "user", "password");
if(!$conn) {
	echo 'not connected';
} else {
	echo 'connected';
}
mysql_select_db('mysql') or die('cannot select db');
?>