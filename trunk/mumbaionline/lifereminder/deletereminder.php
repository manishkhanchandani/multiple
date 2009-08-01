<?php require_once('../Connections/conn.php'); ?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
$colname_rsdelete = "-1";
if (isset($_GET['reminder_id'])) {
  $colname_rsdelete = (get_magic_quotes_gpc()) ? $_GET['reminder_id'] : addslashes($_GET['reminder_id']);
}
mysql_select_db($database_conn, $conn);
$query_rsdelete = sprintf("SELECT * FROM lifereminder_reminder WHERE reminder_id = %s", $colname_rsdelete);
$rsdelete = mysql_query($query_rsdelete, $conn) or die(mysql_error());
$row_rsdelete = mysql_fetch_assoc($rsdelete);
$totalRows_rsdelete = mysql_num_rows($rsdelete);


if ((isset($_GET['reminder_id'])) && ($_GET['reminder_id'] != "")) {
	@unlink("../uploadDir/lifereminder/".$row_rsdelete['file']);
  $deleteSQL = sprintf("DELETE FROM lifereminder_reminder WHERE reminder_id=%s",
                       GetSQLValueString($_GET['reminder_id'], "int"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($deleteSQL, $conn) or die(mysql_error());

  $deleteGoTo = "viewreminder.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>
<?php
mysql_free_result($rsdelete);
?>
