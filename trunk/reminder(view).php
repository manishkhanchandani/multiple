<?php require_once('Connections/connection.php'); ?>
<?php
mysql_select_db($database_connection, $connection);
$query_Recordsetviewr = "SELECT * FROM reminder_lifereminder";
$Recordsetviewr = mysql_query($query_Recordsetviewr, $connection) or die(mysql_error());
$row_Recordsetviewr = mysql_fetch_assoc($Recordsetviewr);
$totalRows_Recordsetviewr = mysql_num_rows($Recordsetviewr);
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
    <td>Account</td>
    <td>AccountNo</td>
    <td>Description</td>
    <td>Contact</td>
    <td>Place</td>
    <td>Upload</td>
    <td>Email</td>
    <td>Name</td>
    <td>Phone</td>
    <td>Edit</td>
    <td>Delete</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Recordsetviewr['id']; ?></td>
      <td><?php echo $row_Recordsetviewr['Account']; ?></td>
      <td><?php echo $row_Recordsetviewr['AccountNo']; ?></td>
      <td><?php echo $row_Recordsetviewr['Description']; ?></td>
      <td><?php echo $row_Recordsetviewr['Contact']; ?></td>
      <td><?php echo $row_Recordsetviewr['Place']; ?></td>
      <td><?php echo $row_Recordsetviewr['Upload']; ?></td>
      <td><?php echo $row_Recordsetviewr['Email']; ?></td>
      <td><?php echo $row_Recordsetviewr['Name']; ?></td>
      <td><?php echo $row_Recordsetviewr['Phone']; ?></td>
      <td><a href="reminder(edit).php?id=<?php echo $row_Recordsetviewr['id']; ?>">Edit</a></td>
      <td><a href="reminder(del).php?id=<?php echo $row_Recordsetviewr['id']; ?>">Delete</a></td>
    </tr>
    <?php } while ($row_Recordsetviewr = mysql_fetch_assoc($Recordsetviewr)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($Recordsetviewr);
?>