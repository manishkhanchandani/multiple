<?php require_once('Connections/conn.php'); ?>
<?php
mysql_select_db($database_conn, $conn);
$query_rsview = "SELECT * FROM table1";
$rsview = mysql_query($query_rsview, $conn) or die(mysql_error());
$row_rsview = mysql_fetch_assoc($rsview);
$totalRows_rsview = mysql_num_rows($rsview);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<table border="1">
  <tr>
    <td>id</td>
    <td>name</td>
    <td>Edit</td>
    <td>Delete</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_rsview['id']; ?></td>
      <td><?php echo $row_rsview['name']; ?></td>
      <td><a href="edit.php?id=<?php echo $row_rsview['id']; ?>">Edit</a></td>
      <td><a href="delete.php?id=<?php echo $row_rsview['id']; ?>">Delete</a></td>
    </tr>
    <?php } while ($row_rsview = mysql_fetch_assoc($rsview)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($rsview);
?>
