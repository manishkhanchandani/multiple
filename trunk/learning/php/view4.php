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
<table border="1">
  <tr>
    <td><strong>id</strong></td>
    <td><strong>name</strong></td>
    <td><strong>gender</strong></td>
    <td><strong>age</strong></td>
    <td><strong>Edit</strong></td>
    <td><strong>Delete</strong></td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_rsView['id']; ?></td>
      <td><?php echo $row_rsView['name']; ?></td>
      <td><?php echo $row_rsView['gender']; ?></td>
      <td><?php echo $row_rsView['age']; ?></td>
      <td><a href="edit.php?id=<?php echo $row_rsView['id']; ?>">Edit</a></td>
      <td><a href="delete2.php?id=<?php echo $row_rsView['id']; ?>">Delete</a></td>
    </tr>
    <?php } while ($row_rsView = mysql_fetch_assoc($rsView)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($rsView);
?>
