<?php require_once('Connections/connection.php'); ?>
<?php
mysql_select_db($database_connection, $connection);
$query_Recordsetfrview = "SELECT * FROM freindlist_lifereminder";
$Recordsetfrview = mysql_query($query_Recordsetfrview, $connection) or die(mysql_error());
$row_Recordsetfrview = mysql_fetch_assoc($Recordsetfrview);
$totalRows_Recordsetfrview = mysql_num_rows($Recordsetfrview);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style2 {color: #8163BE}
.style6 {color: #7150B6}
-->
</style>
</head>

<body bgcolor="#d0d0d0">
<h1 align="center" class="style2">FREINDS VIEW  </h1>
<table border="1" align="center">
  <tr>
    <td><span class="style6">id</span></td>
    <td><span class="style6">Name</span></td>
    <td><span class="style6">Category</span></td>
    <td><span class="style6">EmailId</span></td>
    <td><span class="style6">Delete</span></td>
    <td><span class="style6">Edit</span></td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Recordsetfrview['id']; ?></td>
      <td><?php echo $row_Recordsetfrview['Name']; ?></td>
      <td><?php echo $row_Recordsetfrview['Category']; ?></td>
      <td><?php echo $row_Recordsetfrview['EmailId']; ?></td>
      <td><a href="Frnd(del).php?id=<?php echo $row_Recordsetfrview['id']; ?>">Delete</a></td>
      <td><a href="Frnd(edit).php?id=<?php echo $row_Recordsetfrview['id']; ?>">Edit</a></td>
    </tr>
    <?php } while ($row_Recordsetfrview = mysql_fetch_assoc($Recordsetfrview)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($Recordsetfrview);
?>
