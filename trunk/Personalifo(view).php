<?php require_once('Connections/connection.php'); ?>
<?php
$maxRows_Recordset2 = 10;
$pageNum_Recordset2 = 0;
if (isset($_GET['pageNum_Recordset2'])) {
  $pageNum_Recordset2 = $_GET['pageNum_Recordset2'];
}
$startRow_Recordset2 = $pageNum_Recordset2 * $maxRows_Recordset2;

mysql_select_db($database_connection, $connection);
$query_Recordset2 = "SELECT * FROM personalinformation_lifereminder";
$query_limit_Recordset2 = sprintf("%s LIMIT %d, %d", $query_Recordset2, $startRow_Recordset2, $maxRows_Recordset2);
$Recordset2 = mysql_query($query_limit_Recordset2, $connection) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);

if (isset($_GET['totalRows_Recordset2'])) {
  $totalRows_Recordset2 = $_GET['totalRows_Recordset2'];
} else {
  $all_Recordset2 = mysql_query($query_Recordset2);
  $totalRows_Recordset2 = mysql_num_rows($all_Recordset2);
}
$totalPages_Recordset2 = ceil($totalRows_Recordset2/$maxRows_Recordset2)-1;
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
    <td>Dob</td>
    <td>Identification</td>
    <td>BloodGrp</td>
    <td>Allergy</td>
    <td>Disease</td>
    <td>Disablility</td>
    <td>Email</td>
    <td>Name</td>
    <td>Delete</td>
    <td>Edit</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Recordset2['id']; ?></td>
      <td><?php echo $row_Recordset2['Dob']; ?></td>
      <td><?php echo $row_Recordset2['Identification']; ?></td>
      <td><?php echo $row_Recordset2['BloodGrp']; ?></td>
      <td><?php echo $row_Recordset2['Allergy']; ?></td>
      <td><?php echo $row_Recordset2['Disease']; ?></td>
      <td><?php echo $row_Recordset2['Disablility']; ?></td>
      <td><?php echo $row_Recordset2['Email']; ?></td>
      <td><?php echo $row_Recordset2['Name']; ?></td>
      <td><a href="PersonalIfo(delete).php?id=<?php echo $row_Recordset2['id']; ?>">Delete</a></td>
      <td><a href="PersonalIfo(edit).php?id=<?php echo $row_Recordset2['id']; ?>">Edit</a></td>
    </tr>
    <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($Recordset2);
?>
