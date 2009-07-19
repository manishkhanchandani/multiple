<?php require_once('../../Connections/conn.php'); ?>
<?php
mysql_select_db($database_conn, $conn);
$query_rsView = "SELECT * FROM test2";
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
<p>heading</p>
<p>&nbsp; </p>

<table border="1">
  <tr>
    <td>id</td>
    <td>name</td>
    <td>gender</td>
    <td>age</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_rsView['id']; ?></td>
      <td><?php echo $row_rsView['name']; ?></td>
      <td><?php echo $row_rsView['gender']; ?></td>
      <td><?php echo $row_rsView['age']; ?></td>
    </tr>
    <?php } while ($row_rsView = mysql_fetch_assoc($rsView)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($rsView);
?>
