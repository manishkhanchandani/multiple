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
  $updateSQL = sprintf("UPDATE wish_lifereminder SET Wishes=%s, Donation=%s, Description=%s, Institution=%s, Contact=%s, Email=%s, Name=%s WHERE id=%s",
                       GetSQLValueString($_POST['Wishes'], "text"),
                       GetSQLValueString($_POST['Donation'], "text"),
                       GetSQLValueString($_POST['Description'], "text"),
                       GetSQLValueString($_POST['Institution'], "text"),
                       GetSQLValueString($_POST['Contact'], "int"),
                       GetSQLValueString($_POST['Email'], "text"),
                       GetSQLValueString($_POST['Name'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($updateSQL, $connection) or die(mysql_error());
}

$colname_Recordseditw = "-1";
if (isset($_GET['id'])) {
  $colname_Recordseditw = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_connection, $connection);
$query_Recordseditw = sprintf("SELECT * FROM wish_lifereminder WHERE id = %s", $colname_Recordseditw);
$Recordseditw = mysql_query($query_Recordseditw, $connection) or die(mysql_error());
$row_Recordseditw = mysql_fetch_assoc($Recordseditw);
$totalRows_Recordseditw = mysql_num_rows($Recordseditw);
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
      <td nowrap align="right">Wishes:</td>
      <td><input type="text" name="Wishes" value="<?php echo $row_Recordseditw['Wishes']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Donation:</td>
      <td><select name="Donation">
        <option value="BodyParts" <?php if (!(strcmp("BodyParts", $row_Recordseditw['Donation']))) {echo "SELECTED";} ?>>BodyParts</option>
        <option value="Money" <?php if (!(strcmp("Money", $row_Recordseditw['Donation']))) {echo "SELECTED";} ?>>Money</option>
        <option value="Others" <?php if (!(strcmp("Others", $row_Recordseditw['Donation']))) {echo "SELECTED";} ?>>Others</option>
      </select>
      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Description:</td>
      <td><input type="text" name="Description" value="<?php echo $row_Recordseditw['Description']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Institution:</td>
      <td><input type="text" name="Institution" value="<?php echo $row_Recordseditw['Institution']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Contact:</td>
      <td><input type="text" name="Contact" value="<?php echo $row_Recordseditw['Contact']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Email:</td>
      <td><input type="text" name="Email" value="<?php echo $row_Recordseditw['Email']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Name:</td>
      <td><input type="text" name="Name" value="<?php echo $row_Recordseditw['Name']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Update record"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="id" value="<?php echo $row_Recordseditw['id']; ?>">
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordseditw);
?>
