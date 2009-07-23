<?php require_once('Connections/connection.php'); ?>
<?php
mysql_select_db($database_connection, $connection);
$query_Recordsetvieww = "SELECT * FROM wish_lifereminder";
$Recordsetvieww = mysql_query($query_Recordsetvieww, $connection) or die(mysql_error());
$row_Recordsetvieww = mysql_fetch_assoc($Recordsetvieww);
$totalRows_Recordsetvieww = mysql_num_rows($Recordsetvieww);
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
    <td>Wishes</td>
    <td>Donation</td>
    <td>Description</td>
    <td>Institution</td>
    <td>Contact</td>
    <td>Email</td>
    <td>Name</td>
    <td>Edit</td>
    <td>Delete</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Recordsetvieww['id']; ?></td>
      <td><?php echo $row_Recordsetvieww['Wishes']; ?></td>
      <td><?php echo $row_Recordsetvieww['Donation']; ?></td>
      <td><?php echo $row_Recordsetvieww['Description']; ?></td>
      <td><?php echo $row_Recordsetvieww['Institution']; ?></td>
      <td><?php echo $row_Recordsetvieww['Contact']; ?></td>
      <td><?php echo $row_Recordsetvieww['Email']; ?></td>
      <td><?php echo $row_Recordsetvieww['Name']; ?></td>
      <td><a href="wishes(edit).php?id=<?php echo $row_Recordsetvieww['id']; ?>">Edit</a></td>
      <td><a href="wishes(del).php?id=<?php echo $row_Recordsetvieww['id']; ?>">Delete</a></td>
    </tr>
    <?php } while ($row_Recordsetvieww = mysql_fetch_assoc($Recordsetvieww)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($Recordsetvieww);
?>
