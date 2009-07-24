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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO reminder_lifereminder (Account, AccountNo, Description, Contact, Place, Upload, Email, Name, Phone) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Account'], "text"),
                       GetSQLValueString($_POST['AccountNo'], "int"),
                       GetSQLValueString($_POST['Description'], "text"),
                       GetSQLValueString($_POST['Contact'], "text"),
                       GetSQLValueString($_POST['Place'], "text"),
                       GetSQLValueString($_POST['Upload'], "text"),
                       GetSQLValueString($_POST['Email'], "text"),
                       GetSQLValueString($_POST['Name'], "text"),
                       GetSQLValueString($_POST['Phone'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($insertSQL, $connection) or die(mysql_error());
}

mysql_select_db($database_connection, $connection);
$query_Recordsetaddr = "SELECT * FROM reminder_lifereminder";
$Recordsetaddr = mysql_query($query_Recordsetaddr, $connection) or die(mysql_error());
$row_Recordsetaddr = mysql_fetch_assoc($Recordsetaddr);
$totalRows_Recordsetaddr = mysql_num_rows($Recordsetaddr);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style1 {color: #7150B6}
-->
</style>
</head>

<body bgcolor="#D0D0D0">
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <h1 align="center" class="style1">REMINDERS</h1>
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right"><span class="style1">Account:</span></td>
      <td><select name="Account">
        <option value="BankAcoount" <?php if (!(strcmp("BankAcoount", ""))) {echo "SELECTED";} ?>>BankAcoount</option>
        <option value="Policy" <?php if (!(strcmp("Policy", ""))) {echo "SELECTED";} ?>>Policy</option>
        <option value="Will" <?php if (!(strcmp("Will", ""))) {echo "SELECTED";} ?>>Will</option>
        <option value="Credits" <?php if (!(strcmp("Credits", ""))) {echo "SELECTED";} ?>>Credits</option>
        <option value="Assets" <?php if (!(strcmp("Assets", ""))) {echo "SELECTED";} ?>>Assets</option>
      </select>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><span class="style1">AccountNo:</span></td>
      <td><input type="text" name="AccountNo" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right" valign="top"><span class="style1">Description:</span></td>
      <td><textarea name="Description" cols="50" rows="5"></textarea>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><span class="style1">Contact:</span></td>
      <td><input type="text" name="Contact" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><span class="style1">Place:</span></td>
      <td><input type="text" name="Place" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><span class="style1">Upload:</span></td>
      <td><input type="text" name="Upload" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><span class="style1">Email:</span></td>
      <td><input type="text" name="Email" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><span class="style1">Name:</span></td>
      <td><input type="text" name="Name" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><span class="style1">Phone:</span></td>
      <td><input type="text" name="Phone" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Insert record"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordsetaddr);
?>
