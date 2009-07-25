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
  $updateSQL = sprintf("UPDATE reminder_lifereminder SET Account=%s, AccountNo=%s, Description=%s, Contact=%s, Place=%s, Upload=%s, Email=%s, Name=%s, Phone=%s WHERE id=%s",
                       GetSQLValueString($_POST['Account'], "text"),
                       GetSQLValueString($_POST['AccountNo'], "int"),
                       GetSQLValueString($_POST['Description'], "text"),
                       GetSQLValueString($_POST['Contact'], "text"),
                       GetSQLValueString($_POST['Place'], "text"),
                       GetSQLValueString($_POST['Upload'], "text"),
                       GetSQLValueString($_POST['Email'], "text"),
                       GetSQLValueString($_POST['Name'], "text"),
                       GetSQLValueString($_POST['Phone'], "int"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($updateSQL, $connection) or die(mysql_error());

  $updateGoTo = "reminder(view).php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordseditr = "-1";
if (isset($_GET['id'])) {
  $colname_Recordseditr = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}
mysql_select_db($database_connection, $connection);
$query_Recordseditr = sprintf("SELECT * FROM reminder_lifereminder WHERE id = %s", $colname_Recordseditr);
$Recordseditr = mysql_query($query_Recordseditr, $connection) or die(mysql_error());
$row_Recordseditr = mysql_fetch_assoc($Recordseditr);
$totalRows_Recordseditr = mysql_num_rows($Recordseditr);
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
<h1 align="center" class="style1">EDIT REMINDERS </h1>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right"><span class="style1">Account:</span></td>
      <td><select name="Account">
        <option value="BankAccount" <?php if (!(strcmp("BankAccount", $row_Recordseditr['Account']))) {echo "SELECTED";} ?>>BankAccount</option>
        <option value="Policy" <?php if (!(strcmp("Policy", $row_Recordseditr['Account']))) {echo "SELECTED";} ?>>Policy</option>
        <option value="Will" <?php if (!(strcmp("Will", $row_Recordseditr['Account']))) {echo "SELECTED";} ?>>Will</option>
        <option value="Credit" <?php if (!(strcmp("Credit", $row_Recordseditr['Account']))) {echo "SELECTED";} ?>>Credit</option>
        <option value="Assets" <?php if (!(strcmp("Assets", $row_Recordseditr['Account']))) {echo "SELECTED";} ?>>Assets</option>
      </select>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><span class="style1">AccountNo:</span></td>
      <td><input type="text" name="AccountNo" value="<?php echo $row_Recordseditr['AccountNo']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right" valign="top"><span class="style1">Description:</span></td>
      <td><textarea name="Description" cols="50" rows="5"><?php echo $row_Recordseditr['Description']; ?></textarea>      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><span class="style1">Contact:</span></td>
      <td><input type="text" name="Contact" value="<?php echo $row_Recordseditr['Contact']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><span class="style1">Place:</span></td>
      <td><input type="text" name="Place" value="<?php echo $row_Recordseditr['Place']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><span class="style1">Upload:</span></td>
      <td><input type="text" name="Upload" value="<?php echo $row_Recordseditr['Upload']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><span class="style1">Email:</span></td>
      <td><input type="text" name="Email" value="<?php echo $row_Recordseditr['Email']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><span class="style1">Name:</span></td>
      <td><input type="text" name="Name" value="<?php echo $row_Recordseditr['Name']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><span class="style1">Phone:</span></td>
      <td><input type="text" name="Phone" value="<?php echo $row_Recordseditr['Phone']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Update record"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="id" value="<?php echo $row_Recordseditr['id']; ?>">
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordseditr);
?>
