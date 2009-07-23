<?php require_once('Connections/connection.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE freindlist_lifereminder SET Name=%s, Category=%s, EmailId=%s WHERE id=%s",
                       GetSQLValueString($_POST['Name'], "text"),
                       GetSQLValueString($_POST['Category'], "text"),
                       GetSQLValueString($_POST['EmailId'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($updateSQL, $connection) or die(mysql_error());

  $updateGoTo = "Frnd(view).php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordseditf = "-1";
if (isset($_GET['id'])) {
  $colname_Recordseditf = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_connection, $connection);
$query_Recordseditf = sprintf("SELECT * FROM freindlist_lifereminder WHERE id = %s", $colname_Recordseditf);
$Recordseditf = mysql_query($query_Recordseditf, $connection) or die(mysql_error());
$row_Recordseditf = mysql_fetch_assoc($Recordseditf);
$totalRows_Recordseditf = mysql_num_rows($Recordseditf);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">Name:</td>
      <td><input type="text" name="Name" value="<?php echo $row_Recordseditf['Name']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Category:</td>
      <td><select name="Category">
        <option value="Close Freind" <?php if (!(strcmp("Close Freind", $row_Recordseditf['Category']))) {echo "SELECTED";} ?>>Close Freind</option>
        <option value="Others" <?php if (!(strcmp("Others", $row_Recordseditf['Category']))) {echo "SELECTED";} ?>>Others</option>
        <option value="Family Freind" <?php if (!(strcmp("Family Freind", $row_Recordseditf['Category']))) {echo "SELECTED";} ?>>Family Freind</option>
      </select>
      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">EmailId:</td>
      <td><input type="text" name="EmailId" value="<?php echo $row_Recordseditf['EmailId']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Update record"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="id" value="<?php echo $row_Recordseditf['id']; ?>">
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordseditf);
?>
