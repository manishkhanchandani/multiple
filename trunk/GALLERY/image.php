<?php require_once('../Connections/conn.php'); ?>
<?php
$colname_rsImage = "-1";
if (isset($_GET['album_id])) {
  $colname_rsImage = (get_magic_quotes_gpc()) ? $_GET['album_id] : addslashes($_GET['album_id]);
}
mysql_select_db($database_conn, $conn);
$query_rsImage = sprintf("SELECT * FROM image LEFT JOIN album on image.album_id=album.album_id WHERE image.album_id=%s ORDER BY image.imagedate DESC", $colname_rsImage);
$rsImage = mysql_query($query_rsImage, $conn) or die(mysql_error());
$row_rsImage = mysql_fetch_assoc($rsImage);
$totalRows_rsImage = mysql_num_rows($rsImage);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<p><strong>Images:</strong></p>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rsImage);
?>
