<?php require_once('../Connections/conn.php'); ?>
<?php
mysql_select_db($database_conn, $conn);
$query_rsView = "SELECT * FROM album";
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
<form id="form1" name="form1" method="post" action="">
  <p>Album:
    <select name="dd" id="dd">
      <?php
do {  
?>
      <option value="<?php echo $row_rsView['album']?>"<?php if (!(strcmp($row_rsView['album'], 1))) {echo "selected=\"selected\"";} ?>><?php echo $row_rsView['album']?></option>
      <?php
} while ($row_rsView = mysql_fetch_assoc($rsView));
  $rows = mysql_num_rows($rsView);
  if($rows > 0) {
      mysql_data_seek($rsView, 0);
	  $row_rsView = mysql_fetch_assoc($rsView);
  }
?>
      </select>
</p>
  <p><a href="image.php">Submit</a> </p>
</form>
</body>
</html>
<?php
mysql_free_result($rsView);
?>
