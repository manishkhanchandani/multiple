<?php require_once('Connections/conn.php'); ?>
<?php
$maxRows_rsview = 10;
$pageNum_rsview = 0;
if (isset($_GET['pageNum_rsview'])) {
  $pageNum_rsview = $_GET['pageNum_rsview'];
}
$startRow_rsview = $pageNum_rsview * $maxRows_rsview;

mysql_select_db($database_conn, $conn);
$query_rsview = "SELECT * FROM test";
$query_limit_rsview = sprintf("%s LIMIT %d, %d", $query_rsview, $startRow_rsview, $maxRows_rsview);
$rsview = mysql_query($query_limit_rsview, $conn) or die(mysql_error());
$row_rsview = mysql_fetch_assoc($rsview);

if (isset($_GET['totalRows_rsview'])) {
  $totalRows_rsview = $_GET['totalRows_rsview'];
} else {
  $all_rsview = mysql_query($query_rsview);
  $totalRows_rsview = mysql_num_rows($all_rsview);
}
$totalPages_rsview = ceil($totalRows_rsview/$maxRows_rsview)-1;
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
  </tr>
  <?php do { ?>
      
    <tr>
      <td><?php echo $row_rsview['id']; ?></td>
      <td><?php echo $row_rsview['name']; ?></td>
    </tr>
    <?php } while ($row_rsview = mysql_fetch_assoc($rsview)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($rsview);
?>
