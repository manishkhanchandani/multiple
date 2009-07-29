<?php require_once('Connections/conn.php'); ?>
<?php
mysql_select_db($database_conn, $conn);
$query_rsView = "SELECT * FROM image";
$rsView = mysql_query($query_rsView, $conn) or die(mysql_error());
$row_rsView = mysql_fetch_assoc($rsView);
$totalRows_rsView = mysql_num_rows($rsView);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<table border="1">
  <tr>
    <td><strong>image_id</strong></td>
    <td><strong>image</strong></td>
    <td><strong>user_id</strong></td>
    <td><strong>album_id</strong></td>
    <td><strong>caption</strong></td>
    <td><strong>imagedate</strong></td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_rsView['image_id']; ?></td>
      <td><img src="uploadDir/albums/<?php echo $row_rsView['image']; ?>" width="100" height="100" /></td>
      <td><?php echo $row_rsView['user_id']; ?></td>
      <td><?php echo $row_rsView['album_id']; ?></td>
      <td><?php echo $row_rsView['caption']; ?></td>
      <td><?php echo $row_rsView['imagedate']; ?></td>
    </tr>
    <?php } while ($row_rsView = mysql_fetch_assoc($rsView)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($rsView);
?>
